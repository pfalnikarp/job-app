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



class Client extends Model
{

	use LogsActivity;
    
    protected static $logFillable = true;
   protected static $logAttributes = ['*'];
    

   protected static $logOnlyDirty = true;

    protected static $ignoreChangedAttributes = ['created_by', 'updated_by','created_at','updated_at', 'status_change_date', 'child_status'];

   protected static $logAttributesToIgnore = ['created_by', 'updated_by' ,'created_at','updated_at'];
    
   protected static $submitEmptyLogs = false;

    
    protected $table = 'clients';

    protected $fillable = [  'client_company',  'website', 'phone' , 'client_address1', 'client_state', 'client_country', 'timezone_type', 'unit_price', 'digit_rate', 'store_type' , 'created_by', 'updated_by', 'other_state' , 'client_source', 'csr_person', 'client_specific' , 'csr_personid', 'red_list', 'red_list_details','email','unitno','client_address_line2','city','zipcode','about_company','industry'
       ] ;

     public function tapActivity(Activity $activity, string $eventName)
             {
                    $Order =DB::table('clients')->where('id','=', $activity->subject_id)->get();  

                    foreach ($Order as $key ) {
                        $order_id =  $key->client_company ;
                    }
                    $activity->note = 'Company : '. $order_id;

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

            $done_by_id =  User::find($activity->causer_id);

           $done_by  = $done_by_id->name;

              if (!empty($old)) {

                       foreach ($old  as $key=>$value) {
                        //$string  .=  $value . $new[$key];
                            $string   =  [ 'title' => 'Client Modify by:'   . $done_by , 'url' =>$url, 'detail'=> $value . '<br>' . $new[$key]];
                      
                        }
              }

              else {

                      $string   =  [ 'title' => 'Client Created by:'   . $done_by , 'url' =>$url, 'detail'=> 'Company : '. $order_id ];
                       
              }
                     //dd($string);
                   Notification::send($user, new ClientStatusNotification($string));

             }


    public function clientdtls()
    {
        return $this->hasMany('App\Models\ClientDtl');
    }
     
}
