<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Support\Facades\DB;


//use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupUser extends Model
{
    // use HasFactory;

     protected $table = 'group_user';

   protected $fillable = ['group_id', 'user_id'];

   public function users()
    {
        //return $this->belongsToMany(User::class)->withTimestamps();

        return $this->belongsToMany(User::class);
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user) {
            if($user->id == $user_id) {
                return true;
            }
        }
    }


   

   

}
