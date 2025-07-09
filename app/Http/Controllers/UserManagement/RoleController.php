<?php

namespace App\Http\Controllers\UserManagement;

use App\Helpers\ActionsHelper;
use App\Helpers\BreadcrumbHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $menu = 'Role Management';

    public function __construct()
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');  
        $data = Role::whereNot('id', 1);
        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('name', 'ILIKE', '%' . $search . '%');
            });
        }
        $data = $data->get();

        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
            ->addIndexColumn()
            // ->addColumn('menu', fn($row) => $this->renderMenuButton($row))
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'settings.role.edit', $this->menu))
            ->rawColumns(['menu', 'action']); 
            
            return $dataTable->make(true);
        }
    
        return view('user_management.role.index', [
        ]);
    }

    private function renderMenuButton($row)
    {
        return '
            <div class="d-flex">
                <a data-bs-toggle="modal" data-id="' . $row->id . '" data-userid="' . $row->name . '" 
                data-bs-target="#exampleModal" title="Show" 
                class="btn btn-primary btn-active-color-warning btn-sm me-1 lihat-menu">
                    Lihat Menu
                </a>
            </div>';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = new Role();
        $list_permission_checked = '';
        $data_array = [];
        $first_level = DB::table('permissions as a')->where('level', 1)->orderBy('position', 'ASC')->get();
        $list_Hakakses = DB::select('SELECT * from hakakses');
        return view('user_management.role.form', [
            'data' => $data,
            'list_permission_checked' => $list_permission_checked,
            'data_array' => $data_array,
            'first_level' => $first_level,
            'list_Hakakses' => $list_Hakakses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => ['required', 'string', 'unique:roles'],
            'description' => ['nullable', 'string'],
            'permissions' => ['required'],
        ];

        $text = [
            'name.required' => 'Kolom nama role tidak boleh kosong',
            'permissions.required' => 'Permission role tidak boleh kosong',
            'name.unique' => 'Kolom nama menu sudah ada',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            $name = $request->input('name');
            $guard_name = 'web';
            $description = $request->input('description');
            $permissions = json_decode($request->input('permissions'), true);

            $role = new Role();
            $role->name = $name;
            $role->guard_name = $guard_name;
            $role->description = $description;
            $role->save();

            foreach ($permissions as $permission) {
                $permissionId = $permission['permission_id'];
                $hakaksesIds = $permission['hakakses'];

                // Fetch permission by ID
                $permissionObject = Permission::findById($permissionId, $guard_name);

                if (!$permissionObject) {
                    throw new \Exception("Permission with ID $permissionId not found for guard $guard_name.");
                }

                $role->givePermissionTo($permissionObject);

                foreach ($hakaksesIds as $hakaksesId) {
                    DB::table('hakakses_permission')->insert([
                        'permission_id' => $permissionId,
                        'hakakses_id' => $hakaksesId,
                        'role_id' => $role->id,
                    ]);
                }
            }

            DB::commit();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['text' => $e->getMessage()], 500);
        }

        return response()->json(['text' => $status], 200);
    }

    public function show(string $id, $user_id)
    {
        $user = Auth::user();

        $user = DB::table('users')->where('name', 'Super Admin')->first();
        $list_permission = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('permissions.*')
        ->where('role_has_permissions.role_id', $id)
        ->orderBy('position', 'ASC')
        ->get();

        $sub_menu = $list_permission->where('level', 2);

        return response()->json(['success' => true, 'menus' => $list_permission, 'submenus' => $sub_menu,'role' => $user_id]);
        // return view('user_management.role.show', compact('data', 'role','list_permission', 'list_permission_checked', 'data_array', 'list_Hakakses'));
    }

    public function edit($id)
    {
        $data_array = [];
        $data_role = DB::select('SELECT * from roles WHERE id = ? ', [$id]);
        $list_permission_checked = DB::select('SELECT * from hakakses_permission WHERE role_id = ? ', [$id]);
        foreach ($list_permission_checked as $val) {
            $data_array[] = $val->permission_id;
        }
        $first_level = DB::table('permissions as a')->where('level', 1)->orderBy('position', 'ASC')->get();
        $list_Hakakses = DB::table('hakakses')->orderBy('id', 'ASC')->get();
        $data = $data_role;
        return view('user_management.role.form', [
            'data' => $data,
            'first_level' => $first_level,
            'list_permission_checked' => $list_permission_checked,
            'data_array' => $data_array,
            'list_Hakakses' => $list_Hakakses,
        ]);
        
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'permissions' => ['required'],
        ];

        $text = [
            'name.required' => 'Kolom nama role tidak boleh kosong',
            'permissions.required' => 'Permission role tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        try {
            DB::beginTransaction();
            $role = Role::findOrFail($request->input('id'));
            $role->name = $request->input('name');
            $role->guard_name = 'web';
            $role->description = $request->input('description');
            $role->save();

            $role->syncPermissions([]);

            $permissions = json_decode($request->input('permissions'), true);
            $insert = true;

            DB::table('hakakses_permission')
                ->where('role_id', $role->id)
                ->delete();
            foreach ($permissions as $permission) {
                $permissionId = intval($permission['permission_id']);
                $hakaksesIds = $permission['hakakses'];

                $role->givePermissionTo($permissionId);

                foreach ($hakaksesIds as $hakaksesId) {
                    $result = DB::table('hakakses_permission')->insert([
                        'permission_id' => $permissionId,
                        'hakakses_id' => $hakaksesId,
                        'role_id' => $role->id,
                    ]);

                    if (!$result) {
                        $insert = false;
                        break;
                    }
                }

                if (!$insert) {
                    break;
                }
            }

            if ($insert) {
                DB::commit();
                $status = 'success';
            } else {
                DB::rollback();
                $status = 'failed';
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['text' => 'Terjadi kesalahan saat memperbarui role: ' . $e->getMessage()], 500);
        }
        return response()->json(['text' => $status]);
    }

    public function destroy(Request $request)
    {

        $id = $request->id;

        $role = Role::findOrFail($id);
        if (!$role) {
            return response()->json(['text' => 'Data tidak ditemukan'], 404);
        }
        $simpan = $role->delete();
        $role->syncPermissions([]);
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }
    }
}


// <?php

// namespace App\Http\Controllers\UserManagement;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
// use Yajra\DataTables\Facades\DataTables;

// class RoleController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */

//     public function aksesUserManagement($userId, $permissionName, $hakaksesName)
//     {
//         $roleUser = DB::table('role_has_user')->where('user_id', $userId)->first();
//         $roleId = $roleUser->role_id;
//         $aksesAllowed = auth()->user()->can($permissionName);
//         $results = DB::table('hakakses_permission')
//             ->join('permissions', 'hakakses_permission.permission_id', '=', 'permissions.id')
//             ->join('hakakses', 'hakakses_permission.hakakses_id', '=', 'hakakses.id')
//             ->select('permissions.name as permission_name', 'hakakses.name as hakakses_name')
//             ->where('permissions.name', $aksesAllowed ? $permissionName : '')
//             ->where('hakakses_permission.role_id', $roleId)
//             ->get();
//         if ($aksesAllowed && $results->contains('hakakses_name', $hakaksesName)) {
//             return true;
//         }
//     }

//     public function index(Request $request)
//     {
//         $user = Auth::user();
//         $hakAksesIndex = $this->aksesUserManagement($user->id, 'Role Management', 'read');
//         $hakAksesCreate = $this->user->privilage($this->menu, 'create');
//         $hakAksesUpdate = $this->user->privilage($this->menu, 'update');
//         $hakAksesDelete = $this->aksesUserManagement($user->id, 'Role Management', 'delete');

//         if ($hakAksesIndex || $hakAksesCreate || $hakAksesUpdate || $hakAksesDelete )
//         {

//             if ($request->ajax()) {
//                 // $data = DB::select("SELECT * from roles WHERE id <> 1")
//                 $data = Role::whereNot('id', 1)->get();
//                     // dd
//                 $dataTable = DataTables::of($data)
//                     ->addIndexColumn()

//                     ->addColumn('menu', function($row){
//                         $btn = '<div class="d-flex">
//                         <a data-bs-toggle="modal" data-id="'.$row->id.'" data-userid="'.$row->name.'" data-bs-target="#exampleModal" title="Show" class="btn btn-primary btn-active-color-warning btn-sm me-1 lihat-menu">
//                                     Lihat Menu
//                                 </a></div>';
//                         return $btn;
//                     });


//                     $dataTable->addColumn('action', function ($row) {
//                         $user = Auth::user();
//                         // $user_id = $request->input('user_id');
//                         $hakAksesUpdate = $this->user->privilage($this->menu, 'update');
//                         $hakAksesDelete = $this->aksesUserManagement($user->id, 'Role Management', 'delete');
//                         $btn = '';
//                         if ($hakAksesUpdate && $hakAksesDelete)
//                         {
//                             $btn = '<div class="d-flex">

//                                 <a href="' . route('settings.role.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-success btn-active-color-warning btn-sm me-1">
//                                     <i class="ri-pencil-fill"></i>
//                                 </a>

//                                 <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
//                                     <i class="ri-delete-bin-line"></i>
//                                 </button>
//                             </div>';
//                         } elseif ($hakAksesUpdate) {
//                                 $btn = '<div class="justify-content-end">
//                                 <a href="' . route('settings.role.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-primary btn-active-color-warning btn-sm me-1">
//                                     <i class="ri-pencil-fill"></i>
//                                 </a>
//                             </div>';
//                         } elseif ($hakAksesDelete) {
//                                 $btn = '<div class="justify-content-end">
//                                 <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
//                                     <i class="ri-delete-bin-line"></i>
//                                 </button>
//                             </div>';
//                         }
//                         return $btn;
//                     });
//                 // }
//                 return $dataTable->rawColumns(['menu', 'action'])->make(true);
//             }
//             $data = DB::select("SELECT * from roles");
//             return view('user_management.role.index', compact('data','hakAksesIndex','hakAksesCreate','hakAksesUpdate','hakAksesDelete'));
//         } else {
//            return abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
//         }
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         $user = Auth::user();
//         $hakAksesCreate = $this->user->privilage($this->menu, 'create');
//         if($hakAksesCreate)
//         {
//             $data = new Role();
//             $list_permission_checked = '';
//             $list_hakakses_checked = '';
//             $data_array = array();
//             $user = DB::table('users')->where('name','Super Admin')->first();
//             $list_permission = DB::table('permissions as a')
//             ->get();

//             $list_Hakakses = DB::select("SELECT * from hakakses");
//             return view('user_management.role.form', compact('data','list_permission', 'list_permission_checked', 'data_array', 'list_Hakakses'));
//         }
//         else {
//             return abort(403, 'Anda tidak memiliki izin');
//         }

//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $user = Auth::user();
//         $hakAksesCreate = $this->user->privilage($this->menu, 'create');

//         if (!$hakAksesCreate) {
//             return abort(403, 'Anda tidak memiliki izin');
//         }

//         $rules = [
//             'name' => ['required', 'string', 'unique:roles'],
//             'description' => ['nullable', 'string'],
//             'permissions' => ['required'],
//         ];

//         $text = [
//             'name.required' => 'Kolom nama role tidak boleh kosong',
//             'permissions.required' => 'Permission role tidak boleh kosong',
//             'name.unique' => 'Kolom nama menu sudah ada',
//         ];

//         $validasi = Validator::make($request->all(), $rules, $text);

//         if ($validasi->fails()) {
//             return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
//         }

//         DB::beginTransaction();
//         try {
//             $name = $request->input('name');
//             $guard_name = 'web';
//             $description = $request->input('description');
//             $permissions = json_decode($request->input('permissions'), true);

//             $role = New Role();
//             $role->name = $name;
//             $role->guard_name = $guard_name;
//             $role->description = $description;
//             $role->save();
//             foreach ($permissions as $permission) {
//                 $permissionId = $permission['permission_id'];
//                 $hakaksesIds = $permission['hakakses'];

//                 $role->givePermissionTo($permissionId);

//                 foreach ($hakaksesIds as $hakaksesId) {
//                     DB::table('hakakses_permission')->insert([
//                         'permission_id' => $permissionId,
//                         'hakakses_id' => $hakaksesId,
//                         'role_id' => $role->id,
//                     ]);
//                 }
//             }

//             DB::commit();
//             $status = 'success';
//         } catch (\Exception $e) {
//             DB::rollback();
//             return response()->json(['text' => $e->getMessage()]);
//         }

//         return response()->json(['text' => $status], 200);
//     }


//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id, $user_id)
//     {
//         $user = Auth::user();
//         $hakAksesEdit = $this->aksesUserManagement($user->id, 'Role Management', 'read');

//         if (!$hakAksesEdit) {
//             return abort(403, 'Anda tidak memiliki izin');
//         }


//         $user = DB::table('users')->where('name','Super Admin')->first();
//         $list_permission = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
//         ->orderBy('id', 'ASC')
//         ->select('role_has_permissions.', 'permissions.')->where('role_id', $id)
//         ->get();

//         return response()->json(['success' => true, 'list_permission' => $list_permission, 'role' => $user_id]);
//         // return view('user_management.role.show', compact('data', 'role','list_permission', 'list_permission_checked', 'data_array', 'list_Hakakses'));
//     }


//     public function edit($id)
//     {
//         $user = Auth::user();
//         $hakAksesEdit = $this->user->privilage($this->menu, 'update');

//         if (!$hakAksesEdit) {
//             return abort(403, 'Anda tidak memiliki izin');
//         }

//         $data_array = array();
//         $data_role = DB::connection('pgsql')->select("SELECT * from roles WHERE id = ? ", [$id]);
//         $list_permission_checked = DB::select("SELECT * from hakakses_permission WHERE role_id = ? ", [$id]);
//         foreach ($list_permission_checked as $val) {
//             $data_array[] = $val->permission_id;
//         }
//         $user = DB::table('users')->where('name','Super Admin')->first();
//         // if ($user == 'Super Admin') {
//             $list_permission = Permission::orderBy('id', 'ASC')->get();
//         // } else {
//             // $list_permission = DB::select("SELECT * FROM permissions WHERE NOT id = 11");
//         // }
//         $list_Hakakses = DB::table('hakakses')->orderBy('id', 'ASC')->get();
//         $data = $data_role;
//         return view('user_management.role.form', compact('data', 'list_permission', 'list_permission_checked', 'data_array', 'list_Hakakses'));
//     }

//     public function update(Request $request)
//     {
//         $user = Auth::user();
//         $hakAksesUpdate = $this->user->privilage($this->menu, 'update');

//         if (!$hakAksesUpdate) {
//             return abort(403, 'Anda tidak memiliki izin');
//         }

//         $rules = [
//             'name' => ['required', 'string'],
//             'description' => ['nullable', 'string'],
//             'permissions' => ['required'],
//         ];

//         $text = [
//             'name.required' => 'Kolom nama role tidak boleh kosong',
//             'permissions.required' => 'Permission role tidak boleh kosong',
//         ];

//         $validasi = Validator::make($request->all(), $rules, $text);

//         if ($validasi->fails()) {
//             return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
//         }

//         try {
//             DB::beginTransaction();
//             $role = Role::findOrFail($request->input('id'));
//             $role->name = $request->input('name');
//             $role->guard_name = 'web';
//             $role->description = $request->input('description');
//             $role->save();

//             $role->syncPermissions([]);

//             $permissions = json_decode($request->input('permissions'), true);
//             $insert = true;

//             DB::table('hakakses_permission')->where('role_id', $role->id)->delete();
//             foreach ($permissions as $permission) {
//                 $permissionId = $permission['permission_id'];
//                 $hakaksesIds = $permission['hakakses'];

//                 $role->givePermissionTo($permissionId);

//                 foreach ($hakaksesIds as $hakaksesId) {
//                     $result = DB::table('hakakses_permission')->insert([
//                         'permission_id' => $permissionId,
//                         'hakakses_id' => $hakaksesId,
//                         'role_id' => $role->id,
//                     ]);

//                     if (!$result) {
//                         $insert = false;
//                         break;
//                     }
//                 }

//                 if (!$insert) {
//                     break;
//                 }
//             }

//             if ($insert) {
//                 DB::commit();
//                 $status = 'success';
//             } else {
//                 DB::rollback();
//                 $status = 'failed';
//             }
//         } catch (\Exception $e) {
//             DB::rollback();
//             return response()->json(['text' => 'Terjadi kesalahan saat memperbarui role: ' . $e->getMessage()], 500);
//         }
//         return response()->json(['text' => $status]);
//     }



//     public function destroy(Request $request)
//     {
//         $user = Auth::user();
//         $hakAksesDelete = $this->aksesUserManagement($user->id, 'Role Management', 'delete');

//         if (!$hakAksesDelete) {
//             return abort(403, 'Anda tidak memiliki izin');
//         }

//         $id = $request->id;

//         $role = Role::findOrFail($id);
//         if (!$role) {
//             return response()->json(['text' => 'Data tidak ditemukan'], 404);
//         }
//         $simpan = $role->delete();
//         $role->syncPermissions([]);
//         if ($simpan) {
//             return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
//         } else {
//             return response()->json(['text' => 'Data Gagal Dihapus'], 400);
//         }
//     }
// }
