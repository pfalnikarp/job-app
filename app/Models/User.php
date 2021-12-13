<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
     use Notifiable;
     use HasRoleAndPermission;
     use LogsActivity;

     protected static $logName = 'User Detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


public function getname($id)
{
    $name = User::find($id);
    return  $name->name;
}
    

public function roles()
{
    return $this->belongsToMany('App\Models\Role');
    //return $this->belongsTo('App\Note');
}

public function permissions()
{
    
      return $this->belongsToMany('App\Models\Permission');

}



    public function hasDirectPermission($permission){
         $directpermission = DB::table("permission_user")->select('permission_user.permission_id')->where([["permission_user.user_id",$this->attributes["id"]],['permission_user.permission_id',$permission]])->get();
         if(count($directpermission) > 0){
            
             return true;
             //convert into array than send
             //by default it take is array
          }
         else{
             return false;
          }
    }
    public function hasRolePermission($permission){
        $rolepermissions=DB::table('role_user')->select('role_user.role_id')->where('role_user.user_id',$this->attributes["id"])->get();
        foreach ($rolepermissions as $rolepermission) {
            $checkrolepermissions=DB::table('permission_role')->select('permission_role.permission_id')->where([['permission_role.role_id',$rolepermission->role_id],['permission_role.permission_id',$permission]])->get();
        }
        if(count($checkrolepermissions) > 0){
            return true;
        }
        else{
            return false;
        }
     
    }
     public function levelRolepermission($permissionid,$role){
     $gettoles=DB::table("permission_role")->join('roles','permission_role.role_id','=','roles.id')->select('permission_role.role_id','roles.level')->where("permission_role.permission_id",$permissionid)->get();
       
          $checklevel=[];
            foreach ($gettoles as $gettole) {
                 if($gettole->level < $role){
                    $checklevel[]=$gettole->level;
                 }
            }
            if(count($checklevel) > 0){
                  return true;
            }
            else{
                 return false;
            }

    }
    // public function getDirectPermission(){
    //     $directpermissions=DB::table('permission_user')->select('permission_user.permission_id')->where('permission_user.user_id',$this->attributes["id"])->get();
    //     foreach ($directpermissions as $directpermission) {
    //           $getpermission=DB::table('permissions')->select('permissions.name')->where('permission_user.user_id',$this->attributes["id"])->get();
    //     }

    // }
    
 
    protected static $logFillable = true;        

    protected static $logAttributes = ['*'];
     protected static $logAttributesToIgnore = ['password','calendarpassword','created_at','updated_at'];
    protected static $logOnlyDirty = true;


  
}
