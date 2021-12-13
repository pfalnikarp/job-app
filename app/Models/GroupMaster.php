<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB;


class GroupMaster extends Model
{
    // use HasFactory;

     protected $table = 'group_master';

   protected $fillable = ['name'];


   public function groupuser(){


   	       return $this->hasMany('App\Models\GroupUser', 'group_id');
   	     
   }
   

}
