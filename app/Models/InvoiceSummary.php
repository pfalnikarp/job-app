<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class InvoiceSummary extends Model
{
    
    protected $table = 'invoice_summary';

    protected $fillable = [   
     'company_id' ,   
     'client_company' , 
     'invoice_no',
     'invoice_dt',
     'yr_month',
     'inv_amount',
     'amt_paid_usd',
     'amt_received_inr',
     'net_amt',
     'created_by',
       'remarks',
      'file_url',
      'discount',
      'discount_reason',
      'status'
  
     
 ] ;


}
