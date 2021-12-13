<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientDtl_History extends Model
{
    
    protected $table = 'client_dtls_history';

    protected $fillable = [ 'client_id',  'first_name', 'last_name', 'client_name',  'client_email_primary',    'client_contact_1',  'client_note' , 'client_company', 'delete_flag' , 'black_list' ,  'black_list_reason'] ;


}
