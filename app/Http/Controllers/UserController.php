<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Assignuser;
use App\Models\FailedLoginAttempt;
use DataTables;
use Carbon\Carbon;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Models\Activity;
use App\Models\GroupMaster;
use App\Models\GroupUser;


class UserController extends Controller
{
    public function index()
    {
          return view('users.viewusers.view');
    }
    public function disableuser()
    {
          return view('users.disableuser.view');
    }
    public function alluser()
    {
          return view('users.alluser.view');
    }
    public function liveuser()
    {
          return view('users.liveuser.view');
    }
    public function anydata()
    { 

        $data =User::query();
         return Datatables::of($data)
        
         ->escapeColumns([])  
         ->make(true);


    } 
//store color data in users table 
    public function setcolortheme(Request $request)
    { 
        $setthemecolor = DB::table('users')
                        ->where('id',auth::user()->id)
                        ->update(['color' => $request->new_color]);
     

    }
//store minimize sidebar data in users table    
    public function maxminsidebar()
    { 
        $setmaxminsidebar=User::find(auth::user()->id);
        if($setmaxminsidebar->ext == ''){

             $setmaxminsidebar->ext='sidebar-mini';
          
        }
        else{
            $setmaxminsidebar->ext='';
        }
        $updatemaxminsidebar = DB::table('users')
                        ->where('id',auth::user()->id)
                        ->update(['ext' => $setmaxminsidebar->ext]);

    }
 //redirect to create user page with role and permission data   
    public function create()
    {
         $roles=Role::all();
         $permissions=Permission::all(); 
         return view('users.adduser.view',compact('roles','permissions'));
       
    }
    
//store newuser data 
    public function store(Request $request)
    {
      $v = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' => 'required|unique:users,email',
                        'password'=>'required'
    
       ]);   

      if( $v->fails()){
              return Redirect::back()->withErrors($v)->withInput();
      }    
        $user=new User;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->login_name=$request->first_name.substr(trim($request->last_name),0,1);
        $user->name =  $request->first_name.' '.$request->last_name;
        $user->email=$request->email;
        $user->designation=$request->designation;
        $user->password=Hash::make($request->password);
        $user->save();
        
          if ($request->has('assignroles')) {
        foreach ($request->input('assignroles') as $key => $value) {
            //dd($value);
            $user->attachRole($value);
                if ($value == 6) {
                   DB::insert('insert into designer (id, name) values (?, ?)',
                     [$user->id, $user->name ]);
                 }

          }

        }


        if ($request->has('assign_permissions')) {
          foreach ($request->input('assign_permissions') as $key => $value) {

            $user->attachPermission($value);

           }
        }
       
        return view('users.viewusers.view');
    
    }
//show user edit data on update form
    public function useredit($id){
         $userdata = User::find($id);
         $roledata=Role::all();
        // $groupdata= GroupMaster::all();
        
         //$groupuser= GroupUser::pluck('group_id', 'group_id')->toArray();
        // dd($groupuser);

         $userRole = $userdata->roles->pluck('id','id')->toArray();
         $RolePermission = DB::table('permission_role')->wherein('role_id', $userRole)->pluck('permission_id','permission_id')->toArray();
         $permissions = Permission::get();
         $user_permission = DB::table('permission_user')->where('user_id', $id)->get();
        $role_p =array();
        if (isset($RolePermission))
        {
            $role_p = $RolePermission;
        }
        
         $user_p =array();
        foreach ($user_permission as $key) {
            # code...
            $user_parray = Permission::where('id', $key->permission_id)->pluck('id','id')->toArray();

            $user_p = array_merge($user_p, $user_parray);
        }

          return view('users.edituserrole.view',compact('userdata','roledata', 'permissions', 'userRole', 'user_permission', 'user_p', 'role_p' ));

    }
//veiw user info role permission  
    public function view($id){
        $userdata = User::find($id);
        $roledata=Role::all();
        $userRole = $userdata->roles->pluck('id','id')->toArray();
        $RolePermission = DB::table('permission_role')->wherein('role_id', $userRole)->pluck('permission_id','permission_id')->toArray();
        $permissions = Permission::get();

        
        $user_permission = DB::table('permission_user')->where('user_id', $id)->get();
        $role_p =array();
        if (isset($RolePermission))
        {
            $role_p = $RolePermission;
        }
        
         $user_p =array();
        foreach ($user_permission as $key) {
            # code...
            $user_parray = Permission::where('id', $key->permission_id)->pluck('id','id')->toArray();

            $user_p = array_merge($user_p, $user_parray);
        }
        $permissions = Permission::get();

        
        $user_permission = DB::table('permission_user')->where('user_id', $id)->get();
        return view('users.showuser.view',compact('userdata','roledata', 'permissions', 'userRole', 'user_permission', 'user_p', 'role_p'));
    }
//user delete     
     public function userdelete(Request $request){
        $userdata=User::findorfail($request->user_id);
        $userdata->Deleted='Y';
        $userdata->flag=auth::user()->name;
        $userdata->password=Hash::make("Deleteduser!@#$^&*(");
        $userdata->update();
    }
//update user info role permission      
    public function userupdate(Request $request){
       
         // dd($request->all());

        $v = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' => 'required|email|unique:users,email,'.$request->id
        ]);

        if( $v->fails()){
              return Redirect::back()->withErrors($v);
        } 

        $userdata=User::findorfail($request->id);
        $userdata->first_name=$request->first_name;
        $userdata->last_name=$request->last_name;
        $userdata->login_name=$request->first_name.substr(trim($request->last_name),0,1);
        $userdata->name =  $request->first_name.' '.$request->last_name;
        if($request->password != ""){
                $userdata->password=Hash::make($request->password);
            }
        $userdata->update();
        $getbeforerole=DB::table('userrole_data')->where('id','=',$userdata->id)->pluck('rolename');
        $getbeforepermission=DB::table('userpermission_data')->where('id','=',$userdata->id)->pluck('permissionname');

       
       if ($request->has('assigngroup'))
       {
             $groupid =  $request->assigngroup;

             foreach ($groupid as $grp) {
               $count =  DB::table('group_user')->where('group_id', $grp)->count();

             if($count == 0)
             {
                GroupUser::create(['group_id'=>$grp , 'user_id'=>$userdata->id]);
             }

             }

            

       }
        // if($request->has('assignnotify')){
        //   // dd($request->assignnotify);
        //     $userdata->syncPermissions($request->assignnotify);
        // }
       
        if ($request->has('assignroles')) 
        { 

                $userdata->syncRoles($request->assignroles);  
        }
        else{
            $userdata->detachAllRoles();
        }
        if($request->has('assignpermissions')){
            // dd($request->assignpermissions);
            $userdata->syncPermissions($request->assignpermissions);
        }
        else{
            $userdata->detachAllPermissions();
        }
         $getafterrole=DB::table('userrole_data')->where('id','=',$userdata->id)->pluck('rolename');
         if( $getbeforerole[0] == $getafterrole[0] ){
           
         }
         else{
              $insertactivity=new Activity;
              $insertactivity->causer_id=Auth::user()->id;
              $insertactivity->subject_type='App\URole';
              $insertactivity->subject_id=$userdata->id;
              $insertactivity->causer_type='App\User';
              $insertactivity->properties=(['attributes' => ['userid'=>$userdata->id,'name'=>$userdata->name,'role'=> $getafterrole[0]],'old'=>['userid'=>$userdata->id,'name'=>$userdata->name,'role'=>$getbeforerole[0]]]);
              $insertactivity->description='update';
              $insertactivity->save();
         }
         $getafterpermission=DB::table('userpermission_data')->where('id','=',$userdata->id)->pluck('permissionname');
          if( $getbeforepermission[0] == $getafterpermission[0] ){
           
         }
         else{
              $insertactivity=new Activity;
              $insertactivity->causer_id=Auth::user()->id;
              $insertactivity->subject_type='App\UPermssion';
              $insertactivity->subject_id=$userdata->id;
              $insertactivity->subject_id=$userdata->id;
              $insertactivity->causer_type='App\User';
              $insertactivity->properties=(['attributes' => ['userid'=>$userdata->id,'name'=>$userdata->name,'permission'=> $getafterpermission[0]],'old'=>['userid'=>$userdata->id,'name'=>$userdata->name,'permission'=>$getbeforepermission[0]]]);
              $insertactivity->description='update';
              $insertactivity->save();
         }

        return redirect()->route('user.index');
    }
//show all user live user disable user failed to login user active user
    public function rolesdata(Request $request){

    if($request->user_info == 'Activeuser'){
      
        $data=DB::table('users')->leftjoin('userrole_data','users.id','=','userrole_data.id')->leftjoin('userpermission_data','users.id','=','userpermission_data.id')->select('users.*','userrole_data.rolename','userpermission_data.permissionname')->where('users.Deleted','<>','Y');
  
       return Datatables::of($data)
        
           ->filterColumn('rolename', function ($query, $keyword) {
                $query->whereRaw("rolename like ?", ["%{$keyword}%"]);
            })
           ->filterColumn('permissionname', function ($query, $keyword) {
                $query->whereRaw("permissionname like ?", ["%{$keyword}%"]);
            })         
            ->addColumn('edit',function($data){
             $edit= route('user.useredit',['id'=> $data->id]);
             return "<a href='{$edit}' class='btn btn-sm btn-fill btn-info'>Edit</a>";

           })
            ->addColumn('view',function($data){
             $view= route('user.view',['id'=> $data->id]);
             return "<a href='{$view}' class='btn btn-sm btn-fill btn-success'>View</a>";

            })
            ->addColumn('delete',function($data){
            
              $btn="<a href='#' class='btn btn-sm btn-fill btn-danger deleteuser' value=1>Deactivate</a>";
                return $btn;

           })
           ->escapeColumns([])  
           ->make(true);
    }
if($request->user_info == 'Disableuser'){
      $data=User::query()->where('Deleted','=','Y');
   
        
       return Datatables::of($data)
           ->escapeColumns([])  
           ->make(true);
    }
if($request->user_info == 'Alluser'){
      $data=User::query();
   
        
       return Datatables::of($data)
           ->escapeColumns([])  
           ->make(true);
    }
    if($request->user_info == 'Liveuser'){
           $time =  time() - (config('session.lifetime')*60); 
    $data = DB::table('userrole_data')->join('role_user', 'role_user.user_id','=', 'userrole_data.id')->join('sessions', 'sessions.user_id', '=','userrole_data.id')->where([['role_user.role_id','<>',2],['sessions.last_activity','>=', $time]])->select('userrole_data.id','userrole_data.name','sessions.last_activity','userrole_data.rolename','sessions.ip_address')->get()->reverse();
        
       return Datatables::of($data)
          ->addColumn('lastact',function($data){
                $datads=Carbon::parse(date("Y-m-d\TH:i:s", $data->last_activity))->diffForHumans();
              
             return $datads;

           })
           ->escapeColumns([])  
           ->make(true);
    }
    if($request->user_info == 'Loginattempt'){
           $data = FailedLoginAttempt::orderBy('id','DESC');
           
             return Datatables::of($data)
              ->addColumn('username',function($data){
                  $username=DB::table('users')->select('name')->where('id','=',$data->user_id)->get();

              
             return $username->implode('name',',');

           })
           ->escapeColumns([])  
           ->make(true);
    }
   
}
//go to password change page
    public function showprofile(){

     
        $userathorityname=User::find(Auth()->user()->id);
        
        return view('profile.view',compact('userathorityname'));

    }
//update password user it self    
     public function updateprofile(Request $request){
        $userdata=User::findorfail(Auth()->user()->id);
         $v = Validator::make($request->all(), [
            'password' =>'required',
          
         ]);   
       
         if( $v->fails()){
              return Redirect::back()->withErrors($v);
         }
        
        if($request->password != ""){

            $userdata->password=Hash::make($request->password);
        }
       
        $userdata->update();
        if($request->password != ""){
                auth()->logout();
                return redirect('/login');
        }
      
         
     }

}
