<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order_Status extends Model
{
    
    protected $table = 'order_status';

    protected $fillable = [  'status'  ] ;


}
