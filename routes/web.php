<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/t', function () {
    event(new \App\Events\SendMessage());
    dd('Event Run Successfully.');
});

// Route::get('group', function () {
//     return view('app');
//   });

  Route::get('groupmenu', function(){
           return view('groups.index');
    });

// group notification

 Route::get('groupnotification', 'GroupNotificationController@index')->name('groupnotification.index');
 Route::get('groupnotification/{id}/edit', 'GroupNotificationController@edit')->name('groupnotification.edit');

 Route::PUT('groupnotification/{id}', 'GroupNotificationController@update')->name('groupnotification.update');

//group notification

Route::get('jobinvoice', function () {
    return view('invoices.invoiceyrmonth');
  });

//search compeany  for given month checkbox company criteria
Route::get('jasper/search', 'JasperInvoiceController@search');


Route::get('send', 'Home1Controller@sendNotification');


Route::get('/home1', [App\Http\Controllers\Home1Controller::class, 'index'])->name('home1');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/save-token', [App\Http\Controllers\Home1Controller::class, 'saveToken'])->name('save-token');

Route::post('/send-notification', [App\Http\Controllers\Home1Controller::class, 'sendNotification'])->name('send.notification');

Auth::routes();


// Route::get('{any}', function () {
//     return view('welcome');
// })->where('any', '.*');


//orders
 Route::get('orders', ['uses'=>'OrderController@index', 'as'=>'orders.index']);

   Route::get('coins', ['uses'=>'OrderController@coin']);
   Route::get('curr_mnth_data', ['uses'=>'OrderController@curr_mnth_data']);

        Route::get('orders/{id}/edit', ['uses'=>'OrderController@edit', 'as'=>'orders.edit']);

        Route::post('orders/{id}/editdtl',  'OrderController@editdtl')->name('orders.editdtl');
        Route::get('orders/create', 'OrderController@create')->name('orders.create');
		Route::post('orders/updatenotes', 'OrderController@updatenotes')
                ->name('orders.updatenotes');
    Route::post('orders/delete_child', 'OrderController@delete_child');

Route::patch('orders/updatedtl', 'OrderController@updatedtl');Route::post('orders/orderdtlstatus', 'OrderController@orderdtlstatus');


// individual order alloc
Route::post('orders/updatealloc', 'OrderController@updatealloc')
                ->name('orders.updatealloc');

// multiple order allocation on 28/08/17
Route::post('orders/multipleorderalloc', 'OrderController@multipleorderalloc')
                ->name('orders.multipleorderalloc');
Route::get('orders/search', 'OrderController@search');
// added below on 31-05-20
//Route::get('orders/getfile/{orders}', 'OrderController@GetFile')->name('orders.getfile');
  Route::post('orders/updatechildfile', 'OrderController@UpdateChildFile');
               // ->name('orders.updatenotes');


//  added below on 26-05-20


Route::get('orders/getnotes', 'OrderController@getnotes');

Route::get('orders/getdesign', 'OrderController@getdesign');


Route::post('orders/updateorderstatus', 'OrderController@updateorderstatus');

Route::get('/delayedordersv', 'OrderController@DelayedOrdersv');Route::get('/delayedordersd','OrderController@DelayedOrdersd');Route::get('/delayedordersp', 'OrderController@DelayedOrdersp'); Route::get('/todayordcomp', 'OrderController@TodayOrdComp');Route::post('/searchordcomp', 'OrderController@SearchOrdComp');

  //  timer routes
  Route::post('orders/updatetimer', 'OrderController@updatetimer')
                ->name('orders.updatetimer');
  Route::post('orders/stoptimer', 'OrderController@stoptimer')
                ->name('orders.stoptimer');



Route::get('orders/getfiles', 'OrderController@getfiles');
Route::get('getdelayvalue', 'OrderController@getdelayvalue')->name('order.getdelayvalue');
Route::post('orders/updateordermisc', 'OrderController@updateordermisc')->name('orders.updateordermisc');
  // timer routes

//  above code added on 26-05-20
Route::resource('orders', 'OrderController');


//orders

//invoice  routes addeed on 05-08-21

Route::get('invoiceyrmonth', 'InvoiceController@InvYrMonth')->middleware('permission:generate.invoice');

Route::post('postinvyrmonth', 'InvoiceController@GenInvoice_new');

//  invoice summary

Route::get('invoice-summary/{yr_month}', array('middleware' => 'auth', 'uses' => 'InvoiceSummaryController@SummarygetIndex'))->name('invoice-summary.summarygetindex');

// new route for testing direct editing
// added on 12-11-18

Route::post('invoice-summary/{id}/editdtl',  'InvoiceSummaryController@editdtl')->name('invoices-summary.editdtl');


Route::get('invoice-summary/{id}/addpay',  'InvoiceSummaryController@InvoiceAddPay')->name('invoices-summary.addpay');


Route::get('invoice-summary/{id}/editpay',  'InvoiceSummaryController@InvoiceEditPay')->name('invoices-summary.editpay');

Route::patch('invoice-summary/updatepay/{id}',  'InvoiceSummaryController@UpdatePay')->name('invoices-summary.updatepay');




Route::get('invoice-summary/{id}/edit',  'InvoiceSummaryController@edit')->name('invoice-summary.edit');

Route::PATCH('invoice-summary/updatedtls/{id}',  'InvoiceSummaryController@UpdateDtls')->name('invoices-summary.updatedtls');


Route::get('invoice-summary-data1', array('middleware' => 'auth', 'uses' => 'InvoiceSummaryController@SummaryanyData1'))->name('invoices-summary.data1');



Route::get('invoice-summary1', array('middleware' => 'auth', 'uses' => 'InvoiceSummaryController@SummarygetIndex1'))->name('invoice-summary.summarygetindex1');


Route::get('invoicevectorprint',  'InvoiceController@InvoiceVectorPrint')->name('invoice.print');

Route::get('invoicedigitprint',  'InvoiceController@InvoiceDigitPrint');


Route::get('invoicesendemail',  'InvoiceController@InvoiceSendEmail')->name('invoice.sendemail');

Route::post('invoicesendemail',  'InvoiceController@StoreSendEmail')->name('mail.store');


Route::get('invoicepay',  'InvoiceController@InvoicePay')->name('invoice.pay');



// invoice sumary



//invoice

//users
Route::get('users', ['uses'=>'UserController@index', 'as'=>'user.index'])->middleware('permission:user.show');
Route::get('disableusers', ['uses'=>'UserController@disableuser', 'as'=>'user.disableuser'])->middleware('permission:user.show');
Route::get('allusers', ['uses'=>'UserController@alluser', 'as'=>'user.alluser'])->middleware('permission:user.show');
Route::get('liveusers', ['uses'=>'UserController@liveuser', 'as'=>'user.liveuser'])->middleware('permission:user.show');
Route::get('changeuserpassword', ['uses'=>'UserController@changeuserpassword', 'as'=>'user.changeuserpassword'])->middleware('permission:user.update');
Route::post('updaterequestuserpassword', ['uses'=>'UserController@updaterequestuserpassword', 'as'=>'user.updaterequestuserpassword'])->middleware('permission:user.update');
Route::get('userview/{id}', ['uses'=>'UserController@view', 'as'=>'user.view'])->middleware('permission:user.show');
Route::get('adduser', ['uses'=>'UserController@create', 'as'=>'user.create'])->middleware('permission:user.create');
Route::post('storeuser', ['uses'=>'UserController@store', 'as'=>'user.store']);
Route::get('userselect', ['uses'=>'UserController@select', 'as'=>'user.select']);

Route::get('userroledata',['uses'=>'UserController@rolesdata','as'=>'user.rolesdata']);
Route::get('userdata/{id}',['uses'=>'UserController@useredit','as'=>'user.useredit'])->middleware('permission:user.update');
Route::get('userdelete',['uses'=>'UserController@userdelete','as'=>'user.userdelete']);
Route::post('userupdatedata',['uses'=>'UserController@userupdate','as'=>'user.userupdate']);
Route::post('updatepass', 'UserController@updatepassword')->name('users.changepass');


//show profile
Route::get('showprofile',['uses'=>'UserController@showprofile','as'=>'user.showprofile']);
Route::post('updateprofile',['uses'=>'UserController@updateprofile','as'=>'user.updateprofile']);


//users

//company clients routes
Route::get('clients/data/{id}', 'ClientController@anyData')->name('clients.data');
Route::get('clients',  'ClientController@getIndex')->name('clients.index')->middleware('permission:client.create');


Route::get('clients/{clients}/showcompany', ['uses'=>'ClientController@showcompany', 'as'=>'client.showcompany'])->middleware('permission:print.invoice');

Route::get('clients/create',  'ClientController@create')->name('clients.create')->middleware('permission:client.create');


Route::post('clients', 'ClientController@store')->name('clients.store');


Route::get('clients/{id}/edit',  'ClientController@edit')->name('clients.edit')->middleware('permission:client.update');
Route::get('clients/{id}/show',  'ClientController@show')->name('clients.show');

Route::patch('clients/{id}', 'ClientController@update')->name('clients.update');

Route::get('clients/{id}/updateclientdtl', 'ClientController@UpdateClientDtl')->name('clients.updateclientdtl');

Route::get('clients/getcompanynm', 'ClientController@GetCompanyNm');
Route::get('clients/getrelatedcomp', 'ClientController@GetRelatedComp');
Route::get('clients/getemailforupd', 'ClientController@getemailforupd');
Route::post('clients/getemail', 'ClientController@getemail');
Route::post('clients/getphone', 'ClientController@getphone');
Route::post('getstatename', ['uses'=>'ClientController@statename', 'as'=>'get.statename']);
Route::post('getcityname', ['uses'=>'ClientController@cityname', 'as'=>'get.cityname']);
Route::post('clients/compdtl', 'ClientController@compdtl');

Route::get('clientrelatedtocompany/{id}', ['uses'=>'ClientController@relatedclients', 'as'=>'company.relatedclients']);
Route::get('workseatrelatedtocompany/{id}', ['uses'=>'ClientController@relatedworkseat', 'as'=>'company.relatedworkseat']);
//clientdtl
Route::post('addnewclient', ['uses'=>'ClientController@addnewclient', 'as'=>'clients.addnewclient']);
Route::get('showclient/{id}', ['uses'=>'ClientController@showclient', 'as'=>'clientdtl.showclient']);
Route::get('editclient/{id}', ['uses'=>'ClientController@editclient', 'as'=>'clientdtl.editclient']);

Route::post('updateclient', ['uses'=>'ClientController@updateclient', 'as'=>'clientdtl.updateclient']);
//workseat route
Route::get('createworkseat/{id}',['uses'=>'ClientController@createworkseat','as'=>'workseat.createworkseat']);
Route::post('workseatstore', ['uses'=>'ClientController@workseatstore', 'as'=>'workseat.workseatstore']);
Route::get('editworkseat/{id}',['uses'=>'ClientController@editworkseat','as'=>'workseat.editworkseat']);
Route::get('showworkseat/{id}',['uses'=>'ClientController@showworkseat','as'=>'workseat.showworkseat']);
Route::post('updateworkseat', ['uses'=>'ClientController@updateworkseat', 'as'=>'workseat.updateworkseat']);
Route::post('deleteworkseat', ['uses'=>'ClientController@deleteworkseat', 'as'=>'workseat.deleteworkseat']);


// company clients routes

// roles and permission
//role
Route::get('role', ['uses'=>'RoleController@index', 'as'=>'role.index'])->middleware('permission:role.list');
Route::post('storerole', ['uses'=>'RoleController@store', 'as'=>'role.store']);
Route::get('roledata', ['uses'=>'RoleController@anydata', 'as'=>'role.anydata']);
Route::get('addrole', ['uses'=>'RoleController@create', 'as'=>'role.create'])->middleware('permission:role.create');
Route::get('editroledata/{id}', ['uses'=>'RoleController@edit', 'as'=>'role.edit'])->middleware('permission:role.modify');
Route::post('updaterole', ['uses'=>'RoleController@update', 'as'=>'role.update']);
Route::get('deleterole', ['uses'=>'RoleController@destroy', 'as'=>'role.destroy']);
Route::get('viewroledata/{id}', ['uses'=>'RoleController@view', 'as'=>'role.view'])->middleware('permission:role.list');
//permission
Route::get('permission', ['uses'=>'PermissionController@index', 'as'=>'permission.index'])->middleware('permission:role.list');
Route::get('permissiondata', ['uses'=>'PermissionController@anydata', 'as'=>'permission.anydata']);
Route::post('storepermission', ['uses'=>'PermissionController@store', 'as'=>'permission.store'])->middleware('permission:role.create');
Route::post('updatepermission',['uses'=>'PermissionController@update','as'=>'permission.update'])->middleware('permission:role.modify');
Route::get('deletepermission', ['uses'=>'PermissionController@destroy', 'as'=>'permission.destroy']);



// roles and permission

// payments route follows

  Route::get('payments/create', 'PaymentController@create')->name('payments.create');
  Route::get('payments/{id}/edit', 'PaymentController@edit')->name('payments.edit');

  Route::get('payments', 'PaymentController@index')->name('payments.index');

  Route::post('payments', 'PaymentController@store')->name('payments.store');

  Route::get('payments/searchinvoice', 'PaymentController@searchinvoice');



//payments route  end here
