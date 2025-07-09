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

class PermissionController extends Controller
{
    private $menu = 'Menu Management';

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
        
        $data = Permission::orderBy('group', 'ASC');

        if ($search) {
            $data->where(function ($query) use ($search) {
                $query->where('name', 'ILIKE', '%' . $search . '%');
                    //   ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $data = $data->get();
        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'settings.permission.edit', $this->menu))
            ->rawColumns(['action']); 
            
            return $dataTable->make(true);
        }
    
        return view('user_management.menu.index', [
        ]);
    }

    public function create()
    {
        return view('user_management.menu.form',[
            'data' => new Permission(),
            'roles' => Role::whereNot('name', 'superadmin')->get(),
            'groups' => Permission::where('type', 'dropdown')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'unique:permissions'],
            'guard_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'level' => ['required'],
            'position' => ['required'],
            'roles' => ['required'],
        ];

        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }
        DB::beginTransaction();
        try {
            $permission = new Permission();
            $superadmin = Role::where('name', 'admin_qc')->first();
            $level = intval($request->level);
            $permission->name = $request->name;
            $permission->route = $request->route ? $request->route : 'default';
            $permission->guard_name = 'web';
            $permission->icon = $request->icon;
            $permission->level = $level;
            $permission->position = $request->position;
            $permission->type = $request->type;
            $permission->description = $request->description;
            $permission->assignRole($superadmin);
            if (!blank($request->roles)) {
                $permission->assignRole($request->roles);
            }
            $hakaksesIds = DB::table('hakakses')->pluck('id');
            $permissions = Permission::where('name', $permission->name)->get();
            $request_roles = array_map('intval', $request->roles);
            $roles = array_merge([$superadmin->id], $request_roles ?? []);

            foreach ($permissions as $permission) {
                foreach ($hakaksesIds as $hakaksesId) {
                    foreach ($roles as $roleId) {
                        DB::table('hakakses_permission')->insert([
                            'permission_id' => $permission->id,
                            'hakakses_id' => $hakaksesId,
                            'role_id' => $roleId,
                        ]);
                    }
                }
            }
            $permission->save();
            switch ($level) {
                case 1:
                    $permission->group = $permission->id;
                    break;
                case 2:
                    $permission->group = $request->menu_group_id;
                    break;
                default:
                    throw new \Exception('Invalid level provided');
            }
            $save = $permission->save();
            DB::commit();
            if($save){
                return response()->json(['text' => 'Success'], 200);
            }else{
                return response()->json(['text' => 'Failed'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['text' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user_management.menu.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Permission::findOrFail($id);
        return view('user_management.menu.form',[
            'data' => $data,
            'roles' => Role::whereNot('name', 'superadmin')->get(),
            'groups' => Permission::where('type', 'dropdown')->get(),
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $rules = [
            'name' => ['required', 'string'],
            'guard_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'level' => ['required'],
            'position' => ['required'],
            'roles' => ['required'],
        ];

        if ($request->name != $permission->name) {
            $rules['name'][] = 'unique:users';
        }

        $validasi = Validator::make($request->all(), $rules);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }
        try {
            $superadmin = Role::where('name', 'admin_qc')->first();
            if ($permission) {

                $level = intval($request->level);
                $permission->name = $request->name;
                $permission->route = $request->route ? $request->route : 'default';
                $permission->guard_name = 'web';
                $permission->icon = $request->icon;
                $permission->position = $request->position;
                $permission->level = $level;
                switch ($level) {
                    case 1:
                        $permission->group = $permission->id;
                        break;
                    case 2:
                        $permission->group = $request->menu_group_id;
                        break;
                    default:
                        throw new \Exception('Invalid level provided');
                }
                $permission->type = $request->type;
                $permission->description = $request->description;

                if (!blank($request->roles)) {
                    $permission->syncRoles($request->roles);
                }

                $permission->assignRole([$superadmin]);
                $save = $permission->save();
                if($save){
                    return response()->json(['text' => 'Success'], 200);
                }else{
                    return response()->json(['text' => 'Failed'], 200);
                }
            }
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['text' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::findOrFail($id);
        if (!$permission) {
            return response()->json(['text' => 'Data tidak ditemukan'], 404);
        }
        if ($permission->delete()) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }

    }
}
