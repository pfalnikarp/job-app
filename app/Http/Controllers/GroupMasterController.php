<?php

namespace App\Http\Controllers;

use App\Models\GroupMaster;
use App\Models\GroupUser;
use App\Models\JobInvoice;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Permission;

class GroupMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$groupmaster = GroupMaster::all(['id','name']);

         $groupmaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id','=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->get();

         //dd($groupmaster);
        return response()->json($groupmaster);
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
    public function edit(GroupMaster $groupMaster)
    {
        //
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

          $groupMaster = GroupMaster::find($id);
       //  $groupMaster->fill($request->post())->save();
       //   $groupMaster->update($request->all());   old logic

        $input  = $request->all();

        $group =   $input['group'];
        $users =   $input['users'];

        $groupMaster->update(['name'=>$group['name']]);
       
        
        DB::table('group_user')->where('group_id', $id)->delete();

        foreach ($users as $key ) {
             GroupUser::create(['group_id'=>$id, 'user_id'=>$key['id']]);
        }


        return response()->json([
            'message'=>'groupmaster Updated Successfully!!',
            'groupmaster'=>$groupMaster
        ]);
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
