<?php

namespace App\Http\Controllers;

use App\Models\GroupMaster;
use App\Models\GroupUser;
use App\Models\JobInvoice;
use DB;


use Session;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDtl;
use App\Models\Vendor;
use App\Models\Order_Status ;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use App\Models\Userlog;
use App\Models\orderdtls_history;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Models\UserAllocationLog;
use App\Models\FileReason;
use App\Models\Timer;
use App\Models\Project;

use Spatie\Activitylog\Models\Activity;

use Notification;
use App\Notifications\OrderStatusNotification;
use App\Models\GroupNotification;



class GroupNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //      //$groupmaster = GroupMaster::all(['id','name']);

    //      $groupmaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id','=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->get();

    //      //dd($groupmaster);
    //     return response()->json($groupmaster);
    // }

         public function index(Request $request)
    {
         //  dd('hello');
     // $cnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%client%')->where('slug', 'not like', '%status%')->get();

     // $notification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%')->where('slug', 'not like', '%status%')->where('slug', 'not like', '%notify%client%')->get();

     // $notification1 = Permission::select('id as value', 'name as text')->where('slug', 'not like', '%notify%client%')->where('slug', 'like', '%notify%status%')->get();

         if ($request->ajax()) {    

             // $q1=DB::raw("(SELECT GROUP_CONCAT(group_notification.notification_desc) FROM group_notification, group_master WHERE group_notification.group_id = group_master.id  GROUP BY group_master.id ) as notify"); 

                // $q2=DB::raw("(SELECT group_concat(users.name) FROM users, group_user , group_master WHERE group_user.user_id = users.id  and group_master.id = group_user.group_id GROUP BY users.id ) as names"); 
                 
                  $ids =  GroupNotification::pluck('group_id')->toArray();

                $first = DB::table('group_user')->join('group_master', 'group_master.id', 'group_user.group_id')->select('group_master.id as groupid', 'group_master.name as groupname' , DB::raw('0 as notify'))->whereNotin('group_user.group_id', $ids);

               

        $groupmaster = DB::table('group_notification')->join('group_master', 'group_master.id', 'group_notification.group_id')->select('group_notification.group_id as groupid', 'group_master.name as groupname',
           DB::raw('group_concat(notification_desc) as  notify')
    )->groupBy('group_notification.group_id' ,'group_master.name' )->union($first)->get();
         // dd($groupmaster);

                    return Datatables::of($groupmaster)
                    ->addColumn('edit',function($data){

             $edit= route('groupnotification.edit',['id'=> $data->groupid]);
             return "<a href='{$edit}' class='btn btn-sm btn-fill btn-info'>Edit</a>";

           })
                    ->addColumn('names', function($query){
                       $q2 =  DB::table('users')->select(DB::raw('group_concat(name) as names'))->leftjoin('group_user', 'group_user.user_id', 'users.id')->where('group_user.group_id','=',$query->groupid)->GroupBy('users.id')->get();

                           $unames = '';
                         foreach ($q2 as $key ) {
                             //  dd($key->names);
                               $unames .= $key->names .',';
                         }
                                  $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($q2 as $key) {
                     
                          $fname =  $key->names;
                                            
           //$btnmenu.="<a href='#'><li class='link1'>$key[$i]</li></a>";
           $btnmenu.="<a href='#'><li class='link1'>$fname</li></a>";
           
                     // $btn[]=$result;
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;     
                            //return $unames;
                    })
                    ->editColumn('notify', function($query){
                            $files = explode(',' , $query->notify);
                            $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  str_replace('Notify', '', $key);
                       

                     
           //$btnmenu.="<a href='#'><li class='link1'>$key[$i]</li></a>";
           $btnmenu.="<a href='#'><li class='link1'>$fname</li></a>";
           
                     // $btn[]=$result;
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;     
                    })
                 
                     ->escapeColumns([])
                      ->rawColumns(['action'])
                    ->make(true); 

          //  dd($groupmaster);
          }

         return view('groupnotifications.index');

    }

     public function notifyindex()
    {
         //$groupmaster = GroupMaster::all(['id','name']);

        $groupmaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id','=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->get();

         //dd($groupmaster);
        return response()->json($groupmaster);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $groupmaster = GroupMaster::create($request->post());
        return response()->json([
            'message'=>'Group Created Successfully!!',
            'groupmaster'=>$groupmaster
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupMaster  $groupMaster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //$groupMaster = GroupMaster::find($id);  old logic
         $groupMaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id','=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->where('group_master.id', '=', $id)->get();
      //  $users   = User::select('id', 'name')->get();
       //return response()->json($groupMaster);
        // dd($groupMaster);
       return response()->json(['groupmaster'=>$groupMaster]);
    }


      public function SearchUser($name)
    {
       // $groupMaster = GroupMaster::find($id);
        //dd($name);
        // if(!empty($name)){
        //        dd('hello');
        //         $users   = DB::table('users')->where('name', 'like', '%'.$name.'%')->pluck('id', 'name');
        //  }
         //else{
                  $users   = User::select('id', 'name')->get();


        

       //return response()->json($groupMaster);
      return response()->json(['users'=>$users]);
       // dd($users);
       //return  response($users);
    }

    public function ListNotification()
    {

     $cnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%client%')->where('slug', 'not like', '%status%')->get();

     $notification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%')->where('slug', 'not like', '%status%')->where('slug', 'not like', '%notify%client%')->get();

     $notification1 = Permission::select('id as value', 'name as text')->where('slug', 'not like', '%notify%client%')->where('slug', 'like', '%notify%status%')->get();

         return response()->json(['cnotification'=>$cnotification, 'notification'=>$notification, 'notification1'=>$notification1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupMaster  $groupMaster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
              // dd($id);

                 $groupMaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id','=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as group', DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->where('group_master.id', '=', $id)->get();
       // dd('hello');
      $cnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%client%')->where('slug', 'not like', '%status%')->get();

     $snotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%BS%')->get();

      $revnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%rev%')->get();

      $chnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%ch%')->get();

      $miscnotification = Permission::select('id as value', 'name as text')->where('slug', 'like', '%notify%Misc%')->get();

     $notification1 = Permission::select('id as value', 'name as text')->where('slug', 'not like', '%notify%client%')->where('slug', 'like', '%notify%status%')->get();

     $groupnotification =  GroupNotification::where('group_id', '=', $id)->pluck('notification_id', 'notification_id')->toArray();
     
      // dd($notification);
       //$groupname = array();
        foreach ($groupMaster as $key) {
            $groupid   =  $key->groupid;
            $groupname =  $key->group;
           // dd($groupname);
            $usernames = $key->names;
        }

             $total   = explode(',', $usernames);
             $ucount =  count($total);
             $utotal  =  implode('-', $total);
                  
           return view('groupnotifications.edit' , compact('groupid','groupname', 'usernames', 'ucount', 'utotal' , 'snotification', 'revnotification','chnotification', 'miscnotification', 'groupnotification'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupMaster  $groupMaster
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
    //dd($request->all());
        //dd($id);

          $groupMaster = GroupMaster::find($id);
       //  $groupMaster->fill($request->post())->save();
       //   $groupMaster->update($request->all());   old logic

        $grpname  = $request->groupname;


        
        $groupMaster->update(['name'=>$grpname ]);
       
         
        $selected_notify =  $request->sel ;

       // GroupNotification::where('group_id' , $id)->delete();

        foreach ($selected_notify as $key ) {
               
                //dd($key);
                $name = Permission::find($key)->name;
               // dd($name);

               GroupNotification::where('group_id', $id)->updateorCreate(['notification_id'=>$key, 'notification_desc'=> $name , 'group_id' =>$id ]);
        }

        
                return view('groupnotifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupMaster  $groupMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $groupMaster = GroupMaster::find($id);
            //$groupMaster->delete();
        return response()->json([
            'message'=>'groupMaster Deleted Successfully!!'
        ]);
    }

    /** jobinvoice  submitted invoice index
    */

    public function jobinvoice()
    {
        $groupmaster = JobInvoice::all();
        //dd($groupmaster);
        return response()->json($groupmaster);
    }
}
