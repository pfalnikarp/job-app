<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Userlog extends Model
{
    
    protected $table = 'user_logs';

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
     'status_change_date',
     'created_by', 
     'updated_by',
     'ip_address',
     'company_id',
     'file_count',
     'alloc_id',
     'action',
     'created_nm',
     'updated_nm',
     'bill_dt',
     'old_price',
     'old_status' ,
      'rev_mistake',
      'rev_mistake_reason',
      'client_specific'
 ] ;


}
