<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Events\OrderEvent;
use LRedis;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

use App\Models\User;


use Notification;
use App\Notifications\OrderStatusNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;



class Order extends Model
{
    
    use LogsActivity;
    
    //protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    

    protected static $logOnlyDirty = true;

    // protected static $ignoreChangedAttributes = ['created_by', 'updated_by','created_at','updated_at', 'status_change_date', 'child_status'];

    protected static $logAttributesToIgnore = ['created_by', 'updated_by' ,'created_at','updated_at', 'status_change_date' , 'child_status' ,'alloc_id', 'old_status' ,'order_completion_time' ,'approval_us_time' , 'allocation', 'approval_time' , 'old_price',
     'status_change_date'];
    
    protected static $submitEmptyLogs = false;



    protected $table = 'orders';

    protected $fillable = ['order_id' ,   
     'client_creation_id' , 
     'client_name' ,
     'client_email_primary' ,    
     'client_company' ,   
     'client_address1' , 
     'client_state' ,  
     'client_contact_1',  
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
      'bill_dt',
      'old_price',
      'child_status',
      'old_status',
      'rev_mistake',
      'rev_mistake_reason',
      'client_specific'
    
     
 ] ;


  public function tapActivity(Activity $activity, string $eventName)
             {
                    $Order =DB::table('orders')->where('id','=', $activity->subject_id)->get();  

                    //dd($Order); //working on debug on update order entry


                    foreach ($Order as $key ) {
                             $order_id =  $key->order_id ;
                             $company  =  'Company:' . $key->client_company ;
                             $client  =  'Client:' . $key->client_name ;
                             $filename = 'Filename:' . $key->file_name;
                             $newstatus =  $key->status;
                             $oldstatus = $key->old_status;
                    }

                    $activity->note = 'Order iD: ' . $order_id;
                      $string = 'Order iD: ' . $order_id;
                      $string = array();

                    $url = 'http://127.0.0.1:8000/orders/'. $activity->subject_id .'/edit';

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
                   $new[] = ' '. $value.'. ';
                }
                             
              } 
              if(isset($activity->properties['old'])){

                  //$string[] =' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $old[] =  $key.'was empty. ';
                         }
                         else{
                                // $old[] = $key.' Old Value was '. $value.'. ';
                                 $old[] = $key.' : '. $value.'. ';
                         }
                  }
              }

                         // dd($new);
            // dd($old);

          // $user = User::find(1);
            // dd($old);

           $done_by_id =  User::find($activity->causer_id);

           $done_by  = $done_by_id->name;

           if (!empty($old)) {

               foreach ($old  as $key=>$value) {
                     //$string  .=  $value . $new[$key];
                     $string   =  [ 'title' => 'Order Id: '. $order_id, 'url' =>$url, 'detail'=> $value . 'Changed to' . $new[$key], 'footer' => '<br>'. 'Modify by:'. $done_by .
                     '<br>' .'at:' . $cdt];

                    //dd($value);
                      
             }

           } else {

                $userid = DB::table('role_user')->join('roles', 'roles.id' ,'=',  'role_user.role_id')->where('roles.slug','=','csr')->pluck('role_user.user_id' , 'role_user.user_id');

               // dd($userid);

                $user = User::wherein('id', $userid)->get();

                
                $string   =  [ 'title' => 'Order Created by:' . $done_by , 'url' =>$url,
                           'detail'=>'Order iD: ' . $order_id . '<br>' .$company . '<br>'. $client, 'footer' => '<br>' .  'Created at:' . $cdt ];

                    // dd($string);
                   Notification::send($user, new OrderStatusNotification($string));
           }
             $x= 1;
            if (!empty($old)){

              foreach ($old as $key=>$value ) {
                $x++;
                //dd($value);
              
                      //dd($value);    
                      // $result =  strpos($value, 'status');
                    if(str_contains($value, 'status')){
                                                       // dd('hello');
                      $this->CompareStatus($value, $string, $filename, $order_id, $done_by);
                      }  
                                             
                    elseif (str_contains($value, 'file_type'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.File.Type');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.File.Type');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     }  
                      elseif (str_contains($value, 'file_price'))
                     {
                        $groupid =  $this->GetNotifyGroup('notify.Misc.Edit.Order.File.Price');
                        $userid1 =  $this->getuser($groupid);
                                    
                        $userid  =  $this->GetPermissionUsers('notify.Misc.Edit.Order.File.Price');
                
                        array_push($userid, 1);
                        //dd($userid);

                        $userid2 = array_merge($userid,$userid1);
                      // dd($userid2);
                        $user = User::wherein('id', $userid2)->get();
                        Notification::send($user, new OrderStatusNotification($string));

                     }  
                       elseif (str_contains($value, 'bill_dt'))
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
            }  // if $new is not empty
           
             }

 //public function CompareStatus($new, $old, $key, $value, $string)  
  public function CompareStatus($result, $string, $filename, $order_id, $done_by)           
 {
               $userid = array();
              
        //  dd($new);

       ///   dd($new[$key] .'VALUE'. $value);
               

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
                           

                             Notification::send($user, new OrderStatusNotification($string));
                          
                    
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

                             Notification::send($user, new OrderStatusNotification($string));
                   
                   }
                 elseif (str_contains($result, 'QC Pending')) {  

                          $groupid =  $this->GetNotifyGroup('notify.BS.QC.Pending');

                          //dd($groupid);

                          $userid1 =  $this->getuser($groupid);

                          $userid  =  $this->GetPermissionUsers('notify.BS.QC.Pending');
                 
                          array_push($userid, 1);
                          $userid2 = array_merge($userid,$userid1);

                 
                          $user = User::wherein('id', $userid2)->get();

                          Notification::send($user, new OrderStatusNotification($string));
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

                        Notification::send($user, new OrderStatusNotification($string));
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

 public static function boot() {



        parent::boot();

       

        static::created(function($order) {
             
           //   OrderEvent::fire('order.created', $order);
           //  event(new OrderEvent($order));
                      

        });



        static::updated(function($order) {

            //OrderEvent::fire('order.updated', $order);
            
           // event(new OrderEvent($order));
            
      
        });


}

}
