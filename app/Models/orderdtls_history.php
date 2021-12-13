<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class orderdtls_history extends Model
{
    
    protected $table = 'order_dtls_history';

    protected $fillable = [ 'master_id',
         'child_id' ,
         'order_id' ,   
    	 'client_creation_id' , 
     	 'client_name' ,
     	 'client_email_primary' ,    
     	 'client_company' ,   
     	 'client_state' ,  
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
         'action',
         'old_price',
         'deleted_flag',
         'old_status' ,
         'rev_mistake',
         'rev_mistake_reason'
    
 	] ;

}
