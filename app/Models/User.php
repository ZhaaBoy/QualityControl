<?php

namespace App\Models;

use App\Traits\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'role_has_user');
    }

    public function scopeGetFirstRoute(){
        $route_get = DB::table('role_has_user as a')
                    ->select('c.name', 'c.route')
                    ->join('role_has_permissions as b', 'a.role_id', '=', 'b.role_id')
                    ->join('permissions as c', 'b.permission_id', '=', 'c.id')
                    ->where('a.user_id',  Auth::user()->id);
        return $route_get;
    }

    public function privilage($permissionName, $hakaksesName){
        $user = Auth::user();
        $roleUser = DB::table('role_has_user')->where('user_id', $user->id)->first();
        $roleId = $roleUser->role_id;
        $aksesAllowed = auth()->user()->can($permissionName);
        $results = DB::table('hakakses_permission')
            ->join('permissions', 'hakakses_permission.permission_id', '=', 'permissions.id')
            ->join('hakakses', 'hakakses_permission.hakakses_id', '=', 'hakakses.id')
            ->select('permissions.name as permission_name', 'hakakses.name as hakakses_name')
            ->where('permissions.name', $aksesAllowed ? $permissionName : '')
            ->where('hakakses_permission.role_id', $roleId)
            ->get();
        if ($aksesAllowed && $results->contains('hakakses_name', $hakaksesName)) {
            return true;
        }
        return false;
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }
}
