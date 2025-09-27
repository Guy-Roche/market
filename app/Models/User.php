<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    // Get Permission Groups
    public static function getPermissionGroup(){

        $permission_groups = Permission::select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }//end method

    // Get Permissions by Group Name
    public static function getPermissionsByGroupName($group_name){

        $permissions = Permission::select('name', 'id')->where('group_name', $group_name)->get();
        return $permissions;
    }//end method

    // Check User Has Role and Permission
    public static function hasRoleAndPermission($role, $permissions){  
        //
        $hasPermission = true; 
        // Check if the role has the required permissions
        foreach ($permissions as $permission){
            // If the role doesn't have the permission, return false
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        }
        // If the role has all the required permissions, return true
        return $hasPermission;
    }//end method   

}