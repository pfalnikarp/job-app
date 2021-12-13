<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserAllocationLog extends Model
{
    
    protected $table = 'user_allocation_log';

    protected $fillable = [ 'user_id', 'username', 'order_id', 'order_master_id', 'order_dtls_id', 'status', 'action' , 'alloc_person', 'alloc_person_id'] ;


     
}
