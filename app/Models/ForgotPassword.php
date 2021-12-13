<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ForgotPassword extends Model
{
    
    protected $table = 'forgot_password';

    protected $fillable = [  'fname',  'floginname', 'fuser_id' , 'fip'] ;

     
}
