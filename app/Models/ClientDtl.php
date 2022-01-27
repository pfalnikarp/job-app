<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;



use App\Models\User;
use Notification;
use App\Notifications\ClientStatusNotification;
use Carbon\Carbon;





class ClientDtl extends Model
{

    use LogsActivity;
    
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    

   protected static $logOnlyDirty = true;

    protected static $ignoreChangedAttributes = ['created_by', 'updated_by','created_at','updated_at', 'status_change_date', 'child_status'];

    protected static $logAttributesToIgnore = ['created_by', 'updated_by' ,'created_at','updated_at'];
    
    protected static $submitEmptyLogs = false;
    
    protected $table = 'client_dtls';

    protected $fillable = [ 'client_id',  'first_name', 'last_name', 'client_name',  'client_email_primary',    'client_contact_1',  'client_note' , 'client_company', 'delete_flag' , 'black_list' , 'black_list_reason'] ;

    public function tapActivity(Activity $activity, string $eventName)
             {
                    $Order =DB::table('client_dtls')->where('id','=', $activity->subject_id)->get();  

                    //dd($Order);

                    foreach ($Order as $key ) {
                        $client_name =  $key->client_name ;
                        $client_company = $key->client_company;
                    }

                    $activity->note = 'Client-Dtl : '. $client_name . 'line'. $activity->subject_id;


                      $string = array();

                    $url = 'http://127.0.0.1:8000/clients/'. $activity->subject_id .'/edit?'.'id='.  $activity->subject_id;

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
                  $new[] = $key.' New Value is '. $value.'. ';
                }
                             
              } 
              if(isset($activity->properties['old'])){

                  //$string[] =' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $old[] =  $key.'was empty. ';
                         }
                         else{
                               $old[] = $key.' Old Value was '. $value.'. ';
                         }
                  }
              }

                         // dd($new);

            $userid = DB::table('role_user')->join('roles', 'roles.id' ,'=',  'role_user.role_id')->where('roles.slug','=','csr')->pluck('role_user.user_id' , 'role_user.user_id');

               // dd($userid);
                 array_push($userid, 1);

                $user = User::wherein('id', $userid)->get();   

           

            $done_by_id =  User::find($activity->causer_id);

            $done_by  = $done_by_id->name;

           if (!empty($old)) {

               foreach ($old  as $key=>$value) {
                     //$string  .=  $value . $new[$key];
                     $string   =  [ 'title' => 'Clt-Dtl line Modified: ', 'url' =>$url, 'detail'=> $value . '<br>' . $new[$key], 'footer' => '<br>'. 'By'.$done_by.'at:' . $cdt];

                    // dd($string);
              Notification::send($user, new ClientStatusNotification($string));
             }

           } else {

                         $string   =  [ 'title' => 'Clt-Dtl line Created: ' , 'url' =>$url,  'detail'=>'Client Name: ' . $client_name . '<br>' .$client_company , 'footer' => '<br>' .  'By'.$done_by. 'at:' . $cdt ];

                 //    dd($string);
              Notification::send($user, new ClientStatusNotification($string));
           }
           
             }


}
