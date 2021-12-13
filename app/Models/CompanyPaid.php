<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CompanyPaid extends Model
{
    
    protected $table = 'company_paid';

    protected $fillable = [   
    'remarks' ,
  'payment_date' ,
  'pay_option',
  'invoices',
  'client_company' ,
  'company_id' ,
  'conv_rate',
  'pay_channel' ,
  'amt_paid_usd' ,
  'amt_received_inr' ,
  'net_amt' ,
  'bank_charges' ,
  'tran_id' ,
  'status',
  'created_at',
  'updated_at',
  'currency'
  
     
 ] ;


}
