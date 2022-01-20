<?php

namespace App\Http\Controllers;

use App\Models\GroupMaster;
use App\Models\JobInvoice;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    *
    *  Constructor
    */

    // public function __construct()
    // {
    //     $this->middleware('auth');

        
    //  }


   public function  index()
   {

   }


    public function GetNote($id)
    {
        // $groupmaster = GroupMaster::all(['id','name']);
       
        //dd($id);

        $user = User::find($id);
        //dd($user);

        $notifications= array();

        $unread_count =  DB::table('notifications')->where('notifiable_id', $id)->whereNull('read_at')->count();

         if($unread_count > 0) 
         {
                 foreach ($user->unreadNotifications as $notification) {
                  // echo $notification->type;
                       $breaks = array("<br />","<br>","<br/>");  
                       $data1 =  str_ireplace($breaks, "\r\n", $notification->data);
                   array_push($notifications,  $data1 );
                 }
          // dd($notifications);   
         }
         

        return response()->json($notifications);
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
        $groupMaster = GroupMaster::find($id);
       return response()->json($groupMaster);
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
         // $groupMaster = GroupMaster::find($id);
       // dd($request->all());
        $id1 = $request->id1;

        DB::table('notifications')->where('id', $id1)->update(['read_at'=>Carbon::now('Asia/Kolkata')]);
       //  $groupMaster->fill($request->post())->save();
         

         // $notifications= array();

         //  foreach ($user->unreadNotifications as $notification) {
         //                $breaks = array("<br />","<br>","<br/>");  
         //                $data1 =  str_ireplace($breaks, "\r\n", $notification->data);
         //           array_push($notifications,  $data1 );
         //         }

         //          return response()->json($notifications);

         return response()->json([
            'message'=>'Notification mark as read Successfully!!'
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
       $groupMaster->delete();
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
