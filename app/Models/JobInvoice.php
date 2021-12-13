<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB;


class JobInvoice extends Model
{
    // use HasFactory;

     protected $table = 'jobinvoice';

   protected $fillable = ['userid', 'username', 'company_fired','year_month', 'selectall', 'jobid', 
   'status'];


   

}
