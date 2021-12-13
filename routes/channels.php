<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


//  added below  on 31-july-21 by prashant

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('users.{id}', function ($user, $id) {
    return true;
}, ['guards' => ['web', 'auth']]);



Broadcast::channel('events', function ($user) {
    return true;
});


 // Broadcast::channel('groups.{group}', function ($user, Group $group) {
 //      return $group->hasUser($user->id);

      
 //   });

Broadcast::channel('groups.{group}', function ($user,  $group) {
    //  return $group->hasUser(int($user->id));
       return true;
      
   });