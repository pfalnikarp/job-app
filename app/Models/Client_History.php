<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Client_History extends Model
{
    
    protected $table = 'clients_history';

    protected $fillable = [  'client_company',  'website', 'phone' , 'client_address1', 'client_state', 'client_country', 'timezone_type', 'unit_price', 'digit_rate', 'store_type' , 'created_by', 'updated_by',    'other_state' , 'client_source', 'csr_person' ,
       'client_specific' , 'csr_personid' ,'red_list', 'red_list_details'
       ] ;

     
}
