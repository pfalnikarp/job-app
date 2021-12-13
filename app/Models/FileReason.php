<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FileReason extends Model
{
    
    protected $table = 'file_reason';

    protected $fillable = [ 'target_date', 'old_notes', 'new_notes', 'mistake_by', 'reason', 'order_id',  'order_master_id', 'order_child_id',  'last_status', 'user_id', 'user_name',
         'designer' , 'teamleader'] ;

     
}
