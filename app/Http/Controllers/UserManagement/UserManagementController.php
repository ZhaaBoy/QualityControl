<?php

namespace App\Http\Controllers\UserManagement;

use App\Helpers\ActionsHelper;
use App\Helpers\BreadcrumbHelper;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Schema;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    private $menu = 'User Management';

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
        
        $data = User::orderBy('id', 'ASC');

        if ($search) {
            $columns = Schema::getColumnListing('users'); 

            $data->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        }

        $data = $data->get();
        

        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('roles', fn($row) => $this->renderRole($row))
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'settings.user.edit', $this->menu))
            ->rawColumns(['roles', 'action']); 
            
            return $dataTable->make(true);
        }
    
        return view('user_management.user.index', [
        ]);
    }

    private function renderRole($row)
    {
        $btn = '';
        $data = DB::select("SELECT b.name FROM role_has_user a
            LEFT JOIN roles b ON a.role_id = b.id WHERE user_id = ?", [$row->id]);
        foreach ($data as $val) {
            $btn .= '<span class="h-20px badge text-center badge-light-primary">'. $val->name .'</span>';
        }
        return $btn;
    }

    public function create()
    {
        return view('user_management.user.form',[
            'data' => new User(),
            'roles' => DB::select("SELECT * from roles WHERE name <> 'superadmin'"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users'],
            'description' => ['nullable', 'string'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required'],
            'role' => ['required'],
        ];

        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'name.unique' => 'Kolom nama sudah ada',
            'email.email' => 'Format email tidak valid',
            'email.required' => 'Kolom email tidak boleh kosong',
            'email.unique' => 'Kolom email sudah ada',
            'password.required' => 'Kolom password tidak boleh kosong',
            'role.required' => 'Kolom role tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            $name = $request->input('name');
            $username = $request->input('username');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');
            $email = $request->input('email');
            $role = $request->input('role');
            if ($password !== $confirm_password) {
                return response()->json(['success' => 0, 'text' => 'Password tidak cocok'], 422);
            }

            $user = new User();
            $user->name = $name;
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->email_verified_at = now();
            $user->save();
            $user->assignRole([$role]);

            DB::commit();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $status = $errorMessage;
        }

        return response()->json(['text' => $status], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = DB::select("SELECT roles.name FROM roles WHERE name <> 'superadmin'");
        $data = User::findOrFail($id);
        return view('user_management.user.form',[
            'data' => $data,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user_management = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'role' => ['required'],
        ];
        
        if ($request->name != $user_management->name) {
            $rules['name'][] = 'unique:users';
        }
        if ($request->email != $user_management->email) {
            $rules['email'][] = 'unique:users';
        }
        

        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.required' => 'Kolom email tidak boleh kosong',
            'role.required' => 'Kolom role tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            
            $name = $request->input('name');
            $username = $request->input('username');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');
            $email = $request->input('email');
            $role = $request->input('role');

            if ($password) {
                if ($password !== $confirm_password) {
                    return response()->json(['success' => 0, 'text' => 'Password tidak cocok'], 422);
                }
                $user_management->name = $name;
                $user_management->username = $username;
                $user_management->email = $email;
                $user_management->password = $password;
                $user_management->email_verified_at = now();
                $user_management->update();
                $user_management->syncRoles([$role]);
            }else {
                $user_management->name = $name;
                $user_management->username = $username;
                $user_management->email = $email;
                $user_management->password = $user_management->password;
                $user_management->email_verified_at = now();
                $user_management->update();
                $user_management->syncRoles([$role]);
            }
            DB::commit();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $status = $errorMessage;
        }

        return response()->json(['text' => $status], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        $id = $request->id;

        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['text' => 'Data tidak ditemukan'], 404);
        }
        $simpan = $user->delete();
        $user->syncRoles([]);
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
