<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Notification;
use App\Notifications\OrderStatusNotification;
use Carbon\Carbon;



class OrderDtl extends Model
{
    use LogsActivity;
    
   // protected static $logFillable = true;
    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    //protected static $ignoreChangedAttributes = ['created_by', 'updated_by' ,'created_at','updated_at', 'status_change_date' , 'child_status'];
    
    protected static $logAttributesToIgnore = ['created_by', 'updated_by' ,'created_at','updated_at', 'status_change_date' , 'child_status' , 'alloc_id' , 'old_status' ,'order_completion_time' ,'approval_us_time' , 'approval_time' , 'old_price',
      'status_change_date', 'file_count'];
    

    protected static $submitEmptyLogs = false;



    protected $table = 'order_dtls';

    protected $fillable = [ 'master_id',
         'order_id' ,   
    	 'client_creation_id' , 
     	 'client_name' ,
     	 'client_email_primary' ,    
     	 'client_company' ,   
     	 'client_address1' , 
     	 'client_state' ,  
     	 'client_contact_1',  
     	 'client_contact_2', 
     	 'other_contact',
     	 'client_note',    
     	 'file_name' , 
     	 'file_type' ,  
     	 'vendor',
     	 'digit_rate' ,  
     	 'stiches_count' , 
     	 'file_price' , 
     	 'vendor_digit_rate' ,  
     	 'vendor_digit_price', 
     	 'order_date_time' , 
     	 'order_dt' , 
     	 'order_us_date' ,
     	 'target_completion_time' ,  
     	 'allocation' , 
     	 'status' ,  
     	 'document_type' , 
     	 'note' ,  
     	 'unit_price' ,
     	 'order_completion_time',
     	 'approval_time',
         'approval_us_time',
     	 'status_change_date',
     	 'created_by', 
     	 'updated_by',
     	 'ip_address',
     	 'company_id',
     	 'file_count',
         'alloc_id',
         'old_price',
         'deleted_flag',
         'old_status',
          'rev_mistake',
            'rev_mistake_reason'
    
 	] ;

   
  public function tapActivity(Activity $activity, string $eventName)
             {
                    $Order =DB::table('order_dtls')->where('id','=', $activity->subject_id)->get();  
                  
                    foreach ($Order as $key ) {
                          $order_id =  $key->order_id ;
                          $company  =  'Company:' . $key->client_company ;
                          $client_name   =  'Client:' . $key->client_name ;
                          $filename = 'Filename:' . trim($key->file_name);
                          $filename =  substr($filename, 0,30);
                         
                    }

                    $activity->note = 'Child-Dtl: '. $client_name .'line'. $activity->subject_id;

                  
                    $string = array();

                    $url = 'http://127.0.0.1:8000/orders/'. $activity->subject_id .'/edit?'.'id='.  $activity->subject_id;
                   

                    $cdt =  Carbon::now('Asia/Kolkata');
                    $cdt =  date_format($cdt, 'd-m-Y H:i:s');


                     $new= array(); $old=array();

              foreach($activity->properties['attributes'] as $key=>$value)
              {

                if($value == null)
                {
                   $new[] =  $key.' is empty. ';
                }
                else{
                   //$new[] = $key.' New Value is '. $value.'. ';
                   $new[] = $key.': '. $value.'. ';
                }
                             
              } 
              if(isset($activity->properties['old'])){

                  //$string[] =' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $old[] =  $key.'was empty. ';
                         }
                         else{
                               //$old[] = $key.' Old Value was '. $value.'. ';
                               $old[] = $key.' :'. $value.'. ';
                         }
                  }
              }

                         // dd($new);

           $user = User::find(1);

           $done_by_id =  User::find($activity->causer_id);

           $done_by  = $done_by_id->name;

           if (!empty($old)) {


               foreach ($old  as $key=>$value) {
                     //   dd($value);
                     //$string  .=  $value . $new[$key];
                     $string   =  [ 'title' =>  'Order Lines modified: '. $order_id, 'url' =>$url, 'detail'=> $value . '<br>' . $new[$key], 'footer' => '<br>' . ' modified by: '.$done_by.' at:' . $cdt];

                    // dd($string);
                       if(str_contains($value, 'status')){
                                                       // dd('hello');
                             $string   =  [ 'title' => 'Order Lines modified: '. $order_id, 'url' =>$url, 'detail'=> $value . 'Changed to' . $new[$key], 'footer' => '<br>'. 'Modify by:'. $done_by . '<br>' .'at:' . $cdt];

                            $this->CompareStatus($value, $string, $filename, $order_id, $done_by);
                      } 
                      elseif (str_contains($value, 'file_price')) {

                              $string   =  [ 'title' => 'Order Lines modified: '. $order_id, 'url' =>$url, 'detail'=> $value . 'Changed to' . $new[$key], 'footer' => '<br>'. 'Modify by:'. $done_by . '<br>' .'at:' . $cdt];
                         
                            Notification::send($user, new OrderStatusNotification($string));
                       }
                            elseif (str_contains($value, 'document_type'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.Bill.Date');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.Bill.Date');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                        elseif (str_contains($value, 'deleted_flag'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.misc.order.line.deleted.flag');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.misc.order.line.deleted.flag');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();

                         $string   =  [ 'title' =>  'Order Lines Deleted: '. $order_id, 'url' =>$url, 'detail'=> $filename, 'footer' => '<br>' . 'Deleted by: '.$done_by.' at:' . $cdt];

                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                       elseif (str_contains($value, 'document_type'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Order.Doc.Type');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Order.Doc.Type');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                       elseif (str_contains($value, 'file_name'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.File.Name');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.File.Name');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                      elseif (str_contains($value, 'note'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.File.Notes');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.File.Notes');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                              
                        elseif (str_contains($value, 'allocation'))
                     {
                        $groupid =  $this->GetNotifyGroup(' notify.order.alloc.change');

                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers(' notify.order.alloc.change');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
                      elseif (str_contains($value, 'target_completion_time'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.Target.Time');

                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.Target.Time');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     } 
              
             }

           } else {
                     
                   $string   =  [ 'title' => 'Order Lines Added: '. $order_id  , 'url' =>$url,
                          'detail'=>'Company: ' . $company ,  'footer' => '<br>' .'created by:' . $done_by .'  at:' . $cdt ];

                    // dd($string);
                          Notification::send($user, new OrderStatusNotification($string));
                          
           
             }
           

 
}


 public function CompareStatus($result, $string, $filename, $order_id, $done_by)           
 {
               $userid = array();
              
        //  dd($new);

       ///   dd($new[$key] .'VALUE'. $value);
                $delay = now()->addMinutes(2);
               

       if(str_contains($result, 'Approved'))
       {
                    //dd($result);
                      //$group  =  DB::table('group_notification')->join('permissions', 'permissions.id','=', 'group_notification.notification_id')->where("permissions.slug",
                      //  "=","notify.Order.Approved")->select('group_notification.group_id')->get();
                    
                      // dd($group);
                     // foreach ($group as $key ) {
                     //      $groupid[] =  $key->group_id;
                    //  }

                  
                      $groupid =  $this->GetNotifyGroup('notify.BS.Order.Approved');

                     //dd($groupid);
                      
                     // $groupuser = new GroupUser;

                      $userid1 =  $this->getuser($groupid);
                    //dd($userid1);
                      
                      $userid  =  $this->GetPermissionUsers('notify.BS.Order.Approved');
                
                       array_push($userid, 1);

                              //dd($userid);

                          $userid2 = array_merge($userid,$userid1);

                         // dd($userid2);

                           $user = User::wherein('id', $userid2)->get();
                           
                        $delay = now()->addMinutes(2);

                        foreach ($user as $key ) {
                           $key->notify((new OrderStatusNotification($string))->delay($delay));
                        }

                       
                         //    Notification::send($user, new OrderStatusNotification($string));
                          
                    
                  }
               elseif (str_contains($result, 'Alloted')) {
                            $groupid =  $this->GetNotifyGroup('notify.BS.Order.Alloted');

                            // dd($groupid);

                            $userid1 =  $this->getuser($groupid);

                            //dd($userid1);


                             $userid  =  $this->GetPermissionUsers('notify.BS.Order.Alloted');
                   
                        //       $userid =  DB::table('permission_user')->join('permissions', 'permissions.id','=', 'permission_user.permission_id')->where("permissions.slug",
                        // "=","notify.Order.Allotted")->pluck("permission_user.user_id", 
                        // "permission_user.user_id");

                            //  dd($userid1);
                              array_push($userid, 1);
                              $userid2 = array_merge($userid,$userid1);

                         //dd($userid2);

                           $user = User::wherein('id', $userid2)->get();
                          $delay = now()->addMinutes(2);

                       foreach ($user as $key ) {
                           $key->notify((new OrderStatusNotification($string))->delay($delay));
                        }
                   
                   }
                 elseif (str_contains($result, 'QC Pending')) {  

                          $groupid =  $this->GetNotifyGroup('notify.BS.QC.Pending');

                          //dd($groupid);

                          $userid1 =  $this->getuser($groupid);

                          $userid  =  $this->GetPermissionUsers('notify.BS.QC.Pending');
                 
                          array_push($userid, 1);
                          $userid2 = array_merge($userid,$userid1);

                          $user = User::wherein('id', $userid2)->get();
                          $delay = now()->addMinutes(2);

                        foreach ($user as $key ) {
                           $key->notify((new OrderStatusNotification($string))->delay($delay));
                        }
                 }
                 elseif (str_contains($result, 'QC OK')) {  
                           
                        $groupid =  $this->GetNotifyGroup('notify.BS.QC.OK');

                          // dd($groupid);

                        $userid1 =  $this->getuser($groupid);

                          //dd($userid1);

                        $userid  =  $this->GetPermissionUsers('notify.BS.QC.OK');
                         array_push($userid, 1);

                        $userid2 = array_merge($userid,$userid1);

                        $user = User::wherein('id', $userid2)->get();

                         foreach ($user as $key ) {
                           $key->notify((new OrderStatusNotification($string))->delay($delay));
                        }
                  }
                  elseif (str_contains($result, 'Completed')) {  
                               
                          $groupid =  $this->GetNotifyGroup('notify.BS.Order.Completed');

                          $userid1 =  $this->getuser($groupid);

                           $userid  =  $this->GetPermissionUsers('notify.BS.Order.Completed');
                            array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                             Notification::send($user, new OrderStatusNotification($string));
                 }
                   elseif (str_contains($result, 'Revision')) {  
                           $groupid =  $this->GetNotifyGroup('notify.Order.Status.Revision');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         

                            $string   =  [ 'title' => 'Revision:' , 'url' => "",
                                             'detail'=> $filename .'of' . $order_id . 'is marked Revision by'. $done_by , 'footer' => '' ];

                           $userid  =  $this->GetPermissionUsers('notify.Order.Status.Revision');

                            array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                             $user = User::wherein('id', $userid2)->get();
                         
                            Notification::send($user, new OrderStatusNotification($string));
                 }
                elseif (str_contains($result, 'Rev-Alloted')) {  
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.Rev-Alloted');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Rev-Alloted');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                             $user = User::wherein('id', $userid2)->get();
                          Notification::send($user, new OrderStatusNotification($string));
                }
                elseif (str_contains($result, 'Rev-QC Pending')) {  
                          $groupid =  $this->GetNotifyGroup('notify.Order.Rev-QC-Pending');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Order.Rev-QC-Pending');

                          $userid2 = array_merge($userid,$userid1);  

                           array_push($userid, 1);

                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));
                 }
                 elseif (str_contains($result, 'Rev-QC OK')) {  
                      
                           $groupid =  $this->GetNotifyGroup('notify.Order.Rev-QC-OK');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Order.Rev-QC-OK');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                           Notification::send($user, new OrderStatusNotification($string));
                   }
                   elseif (str_contains($result, 'Rev-Completed')) {  
                           $groupid =  $this->GetNotifyGroup('notify.Status.Order.Rev-Completed');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Rev-Completed');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();
                      
                           Notification::send($user, new OrderStatusNotification($string));
                        }
                  elseif (str_contains($result, 'Changes')) {  
                         
                           $groupid =  $this->GetNotifyGroup('notify.Status.Order.Changes');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Changes');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                            Notification::send($user, new OrderStatusNotification($string));
                     }       
                  elseif (str_contains($result, 'Ch-Alloted')) {  
                        
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.Ch-Alloted');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Ch-Alloted');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                             Notification::send($user, new OrderStatusNotification($string));
                }
                 elseif (str_contains($result, 'Ch-QC Pending')) {
                
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.Change.QC.Pending');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Change.QC.Pending');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));

                  }
                   elseif (str_contains($result, 'Ch-QC OK')) {
                           
                             $groupid =  $this->GetNotifyGroup('notify.Status.Order.Change.QC.OK');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Change.QC.OK');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();
                           

                          Notification::send($user, new OrderStatusNotification($string));
                     }
                   elseif (str_contains($result, 'Ch-Completed')) {  
                 
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.Change.Completed');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Change.Completed');

                           array_push($userid, 1);

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));
                   }
                   
                 elseif (str_contains($result, 'Cancel')) { 
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.Cancel');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.Cancel');
                            array_push($userid, 1);


                          $userid2 = array_merge($userid,$userid1);  


                          $user = User::wherein('id', $userid2)->get();


                          Notification::send($user, new OrderStatusNotification($string));

                   }
                    elseif (str_contains($result, 'On Hold')) { 
                 
                          $groupid =  $this->GetNotifyGroup('notify.Status.Order.On.Hold');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.On.Hold');

                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));

                  }
                      elseif (str_contains($result, 'No Response')) { 
                 
                        $groupid =  $this->GetNotifyGroup('notify.Status.Order.No.Response');

                          $userid1 =  $this->getuser($groupid);
                          //dd($userid1);
                         
                          $userid  =  $this->GetPermissionUsers('notify.Status.Order.No.Response');

                            array_push($userid, 1);


                          $userid2 = array_merge($userid,$userid1);  

                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));

                   }                
                 // default:
                 //   # code...
                 //   break;
              // }

              
               //dd($key . $value);
             
               
           

 }


 public function GetNotifyGroup($slug)
  {
                  $groupid = array();
                 $group  =  DB::table('group_notification')->join('permissions', 'permissions.id','=', 'group_notification.notification_id')->where("permissions.slug",
                        "=", $slug)->select('group_notification.group_id')->get();

                 foreach ($group as $key ) {
                           $groupid[] =  $key->group_id;
                      }
                   
                  // dd($groupid);
                return $groupid;

  }


    public  function  GetPermissionUsers($slug)
    {
             $userid =  DB::table('permission_user')->join('permissions', 'permissions.id','=', 'permission_user.permission_id')->where("permissions.slug","=",$slug)->pluck("permission_user.user_id")->toArray();

             return $userid;
        
    }


     public  function getuser($groupid)
    { 

     $userid =  DB::table('users')->join('group_user', 'group_user.user_id','=', 'users.id')->wherein('group_user.group_id',  $groupid)->select('users.id')->get()->toArray();
           
           $uid = array();
       foreach ($userid as $key ) {
           $uid[] = $key->id;
       }

        return  $uid ;
        //return  User::whereIn('id',$uid)->get();

     


      }
}
