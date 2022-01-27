<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('group',App\Http\Controllers\GroupMasterController::class);


Route::middleware('api')->get('/jobinvoice', 'GroupMasterController@jobinvoice');



Route::middleware('api')->group(function () {
    Route::resource('group', GroupMasterController::class);
     Route::get('user/{query}', 'GroupMasterController@SearchUser');
    

      Route::get('listnotification', 'GroupMasterController@ListNotification');
     
      Route::get('bell', 'BellController@create');
      Route::get('getnote/{query}', 'NotificationController@GetNote');
    
      Route::resource('notifications', NotificationController::class);

});

