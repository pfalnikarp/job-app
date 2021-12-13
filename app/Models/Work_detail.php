<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;


use Notification;
use App\Notifications\ClientStatusNotification;
use App\Models\User;

class Work_detail extends Model
{
    use LogsActivity;
    protected static $logName = 'Work Detail';
	protected $table = 'work_details';
	  protected $fillable = [
        'client_id','department','seattype','seattype','noofhours','wcountry','wtimezone','billing','invoice','currency','amount','days','hours','worktime','work_created_user_id','work_updated_user_id','csr1','csr2','emp1','emp2'
    ];
      protected static $logOnlyDirty = true;
          protected static $logFillable = true;  



     public function tapActivity(Activity $activity, string $eventName)
             {
                    $Order =DB::table('work_details')->where('id','=', $activity->subject_id)->get();  

                    $order_id = ''; $user_id='';$user_nm='';

                    foreach ($Order as $key ) {
                        $order_id =  $key->client_id ;
                     
                    }
                    
                    $activity->note = 'Client id : '. $order_id;

                       $user_id  = $activity->causer_id;

                    $user =  User::find($user_id);

                    $user_nm =  $user->name;


                    $string = array();

                    $url = 'http://127.0.0.1:8000/clients/'. $activity->subject_id .'/show';


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


           $user = User::find(1);

           foreach ($old  as $key=>$value) {
                     //$string  .=  $value . $new[$key];
                     $string   =  [ 'title' => 'Work Detail Modify by:'. $user_nm, 'url' =>$url, 'detail'=> $value . '<br>' . $new[$key]];
              Notification::send($user, new ClientStatusNotification($string));
           }

        


             }


}
