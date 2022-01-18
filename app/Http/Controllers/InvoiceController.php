<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use Session;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use App\Models\Order ;
use App\Models\Invoice ;

use App\Models\InvoiceSummary ;
use App\Models\Order_Status ;
use App\Models\Vendor ;
use App\Models\User ;

use App\Models\Client ;

//use Entrust;
use App\Models\Role;

use App\Models\Permission;
use App\Models\JobInvoice;
use Ntrust;
use Carbon\Carbon;

use JasperPHP\JasperPHP as JasperPHP;
 //use Konekt\PdfInvoice\InvoicePrinter;
//use Dompdf\Dompdf ;
use PDF;
 use Storage;

use Mail;

use App\Jobs\CreateInvoiceJob;
use App\Jobs\CreateInvoiceJobSecond;
use Illuminate\Support\Facades\Redirect;



class InvoiceController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    

    public function getIndex(Request $request = null)
    {
       // return view('datatables.index');
       //$id = Auth::id();
     // dd('hello you are in getindex');
      $newid = 10;
      if(isset($request->newid)) {
          $newid = $request->newid ;
      }
      
       $nowdt =  Carbon::now('Asia/Kolkata')->toDateTimeString();
       $nowdt_ymd =  Carbon::now('Asia/Kolkata')->format('Y-m-d');

            
       $nowdt1 =  Carbon::now()->toDateTimeString();
       $nowdt_ymd1 =  Carbon::now()->format('Y-m-d');

   
      $user1 = Auth::user()->name;
      //dd($user1);die;
      $user = User::where('name', '=', $user1)->first();

      $vendors = Vendor::pluck('name', 'name');

      $roleid = [] ;
                $role = DB::table('role_user')->where('user_id', Auth::user()->id)->get();
                //dd($role);
                foreach ($role as $key) {
                  # code...
                     $roleid[] = $key->role_id ;
                }
                
                //dd($roleid);

                if(empty($roleid)) {
                      return view('errors.403');
                }
              
        //  }

            $roleusers = DB::table('role_user')
                    ->whereIn('role_id', [6,7])
                    ->get();
                 $roleusers = $roleusers->toArray();

                foreach($roleusers as $rv)
                {
                   $designer[] = $rv->user_id ; 
                }
                //dd($designer);die;
                 $users = DB::table('designer')->pluck( 'name' , 'id');
                 $user_names = DB::table('designer')->pluck( 'name' , 'name');
                 
              
      
      if (Auth::user()->hasOnePermission(['order.create','order.update','order.delete','order.view'])) 
        


          {
            // dd("hello permission granted");
            $rolePermissions =[];
             
                    $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

                    ->whereIn("permission_role.role_id",$roleid)
                    ->select("slug")
                    ->get();
                    $rolePermissions = $rolePermissions->toArray();

                    
                   // dd($rolePermissions);
    

          $perms = DB::table('permissions')
                    ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
                    ->join('users', function($join)
                      {
                        $join->on('users.id', '=', 'permission_user.user_id')
                        ->where('users.id', '=', Auth::user()->id);
                      })
                      ->select('permissions.slug')
                      ->get()->toArray();  

             // dd($perms);die;  Below Code change on 31/03/18 for Laravel 5.6 permission
              $rights1= [];
              $rights2= [];
              foreach ($perms as $key ) {
                      # code...
                      $rights1[] =$key->slug;
                    }    
                    
                    //dd($rights1);

                    if(!empty($rolePermissions))  {
                    foreach ($rolePermissions as $key=>$value ) {
                      # code...
                      $rights2[] = $value["slug"];
                    }    
                  }

                  // dd($rights2); Above Code change on 31/03/18 for Laravel 5.6 permission
                
                if(!empty($rights2)) {
                    $rights = array_merge($rights1, $rights2);
                   }
                   else {
                          $rights = $rights1 ;
                   }

                // dd($rights);
               
               
       
                $order=Invoice::first();
               
                //dd($order);

                $status = Order_Status::pluck('status', 'status');  
                $vendors = Vendor::pluck('name', 'name');
        
                return view('invoices.index',compact('order','users',  'status','perms','rights','vendors', 'newid' , 'user_names' ));
              
            }

      else {
              # code...
                         return view('errors.403');
            }      
        
    }

//  script added for  invoice summary on 01-nov-2018
 public function SummarygetIndex(Request $request = null)
    {
       // return view('datatables.index');
       //$id = Auth::id();
     // dd('hello you are in getindex');
      $newid = 10;
      if(isset($request->newid)) {
          $newid = $request->newid ;
      }
      
       $nowdt =  Carbon::now('Asia/Kolkata')->toDateTimeString();
       $nowdt_ymd =  Carbon::now('Asia/Kolkata')->format('Y-m-d');

            
       $nowdt1 =  Carbon::now()->toDateTimeString();
       $nowdt_ymd1 =  Carbon::now()->format('Y-m-d');

   
      $user1 = Auth::user()->name;
      //dd($user1);die;
      $user = User::where('name', '=', $user1)->first();

      $vendors = Vendor::pluck('name', 'name');

      $roleid = [] ;
                $role = DB::table('role_user')->where('user_id', Auth::user()->id)->get();
                //dd($role);
                foreach ($role as $key) {
                  # code...
                     $roleid[] = $key->role_id ;
                }
                
                //dd($roleid);

                if(empty($roleid)) {
                      return view('errors.403');
                }
              
        //  }

            $roleusers = DB::table('role_user')
                    ->whereIn('role_id', [6,7])
                    ->get();
                 $roleusers = $roleusers->toArray();

                foreach($roleusers as $rv)
                {
                   $designer[] = $rv->user_id ; 
                }
                //dd($designer);die;
                 $users = DB::table('designer')->pluck( 'name' , 'id');
                 $user_names = DB::table('designer')->pluck( 'name' , 'name');
                 
              
      
      if (Auth::user()->hasOnePermission(['order.create','order.update','order.delete','order.view'])) 
        


          {
            // dd("hello permission granted");
            $rolePermissions =[];
             
                    $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

                    ->whereIn("permission_role.role_id",$roleid)
                    ->select("slug")
                    ->get();
                    $rolePermissions = $rolePermissions->toArray();

                    
                   // dd($rolePermissions);
    

          $perms = DB::table('permissions')
                    ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
                    ->join('users', function($join)
                      {
                        $join->on('users.id', '=', 'permission_user.user_id')
                        ->where('users.id', '=', Auth::user()->id);
                      })
                      ->select('permissions.slug')
                      ->get()->toArray();  

             // dd($perms);die;  Below Code change on 31/03/18 for Laravel 5.6 permission
              $rights1= [];
              $rights2= [];
              foreach ($perms as $key ) {
                      # code...
                      $rights1[] =$key->slug;
                    }    
                    
                    //dd($rights1);

                    if(!empty($rolePermissions))  {
                    foreach ($rolePermissions as $key=>$value ) {
                      # code...
                      $rights2[] = $value["slug"];
                    }    
                  }

                  // dd($rights2); Above Code change on 31/03/18 for Laravel 5.6 permission
                
                if(!empty($rights2)) {
                    $rights = array_merge($rights1, $rights2);
                   }
                   else {
                          $rights = $rights1 ;
                   }

                // dd($rights);
               
               
       
                $order=InvoiceSummary::first();
               
                //dd($order);

                $status = Order_Status::pluck('status', 'status');  
                $vendors = Vendor::pluck('name', 'name');
        
                return view('invoices_summary.index',compact('order','users',  'status','perms','rights','vendors', 'newid' , 'user_names' ));
              
            }

      else {
              # code...
                         return view('errors.403');
            }      
        
    }


/* *  script change on  01-nov-2018
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
       // return Datatables::of(Customer::query())->make(true);
       //  dd('ok');die;
      if (Auth::user()->hasRole('Designer') && Auth::user()->level() <=1) { //added on 04-04-18 second condition of level
           // dd('ok designer');die;
                $dname =  Auth::user()->name ;  // old logic
                $allotedid = [];
                array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
                $dname = '%'. $dname . '%' ;
               //dd($name);die;
               // $name1 =  '%' . $name . '%' ;
                //dd($name1);
                $role = Role::where('name','=', 'Designer')->get();
                     return Datatables::of(Invoice::query())
          ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status])->render();
              })
            ->addColumn('action', function ($user) {
                // return  view('partials.datatablesorders', ['id' => $user->id])->render();

                    return  view('partials.invoicecheckbox', ['id' => $user->id, 'status' => $user->status])->render();
                   
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
             ->addColumn('order_id', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                  
                return  view('partials.datatableseditorder', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'file_count' => $user->file_count,  'vendors'=> $vendors])->render();
            })
            ->addColumn('order_dt', function($model){
                return date('j-M-Y', strtotime($model->order_dt));
              })
            ->where(function ($query) {
                 $dname =  Auth::user()->name ;  // old logic
                $allotedid = [];
                array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
                $dname = '%'. $dname . '%' ;
                $query->wherein('alloc_id' , $allotedid)
                      ->orWhere('allocation', 'like', $dname);
            })
            ->where('order_date_time' ,'>=', '2017-06-01')
            ->make(true);


          }
     
      else  {
          
          //dd('ok admin');die;
          
         return Datatables::of(Invoice::query())
          ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status])->render();
              })
            ->addColumn('action', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                // return  view('partials.datatablesorders', ['id' => $user->id])->render();

                    return  view('partials.invoicecheckbox', ['id' => $user->id, 'status' => $user->status, ])->render();
                // return  view('partials.datatablesorders', ['id' => $user->id, 'vendors'=> $vendors])->render();
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
              ->addColumn('order_id', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                  
                return  view('partials.datatableseditorder', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'file_count' => $user->file_count,  'vendors'=> $vendors])->render();
            })
           ->addColumn('order_dt', function($model){
                return date('j-M-Y', strtotime($model->order_dt));
              })
           
          
         
            ->make(true);

        }

   }

//  SUMMARY INVOICE TABLES DATA  
 /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function SummaryanyData()
    {
       // return Datatables::of(Customer::query())->make(true);
         //dd('ok');die;
      return Datatables::of(InvoiceSummary::query())
           ->addColumn('action', function ($user) {
            
                    return  view('partials.invoicecheckbox', ['id' => $user->id, 'status' => $user->status])->render();
                   
                       
            })
            
            ->make(true);

 
   }   

public function CreateInvoice()
{
           $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            }

           //dd($status);

            return view('reports.create_invoice', compact( 'status'));

}   

public function InvoiceProcess(Request $request) {

         // dd($request->all());
            $pfr_dt         =  $request->pfr_dt  ;
            $pto_dt        =  $request->pto_dt ;
            //$pfile_type    =  $request->file_type ;
            $orderzones    =  $request->orderzones ;
            //$pinvdtoption  =  $request->pinvdtoption;

            if ($request ->has('st')) {
                $stat   =  $request->st ;
            }
            else {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'Status Cannot be Blank, Select Status' );
                //  $request->session()->put('msg', 'Status Cannot be Blank, Select Status');

                return redirect()->back();
            }
            
            $P_status  = "'" . implode( "','", $stat ) . "'" ;
            //$param2    = " and orders.status IN" . " (" . $P_status . ")";  removed on  260318 as not  working in server 30 php 7.1

            $param2    = " and status IN" . " (" . $P_status . ")";   
            $param2    =  '"' . $param2 . '"' ;    
            $param2    =  stripslashes($param2);


            $order_copy = DB::table('orders')
            ->where('bill_dt', '>=' , $pfr_dt)
            ->where('bill_dt', '<=' , $pto_dt)
            ->where('file_price' ,'>', 0)
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->get()->toArray();

    // dd($order_copy);
    foreach($order_copy as $key=>$value) {
          // dd($key);
          //dd($order_copy[$key]->order_id);
          // $logy[] = collect($order_copy[$key])->toArray();
        $invoice_order['order_id'] = $order_copy[$key]->order_id;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_creation_id;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_company'] = $order_copy[$key]->client_company;
        $invoice_order['client_address1'] = $order_copy[$key]->client_address1;
        $invoice_order['client_state'] = $order_copy[$key]->client_state ;
        $invoice_order['client_contact_1'] = $order_copy[$key]->client_contact_1;
        $invoice_order['other_contact'] = $order_copy[$key]->other_contact;
        $invoice_order['client_note'] = $order_copy[$key]->client_note;
        $invoice_order['file_name'] = $order_copy[$key]->file_name;
        $invoice_order['file_type'] = $order_copy[$key]->file_type;
        $invoice_order['vendor'] = $order_copy[$key]->vendor;
        $invoice_order['digit_rate'] = $order_copy[$key]->digit_rate;
        $invoice_order['stiches_count'] = $order_copy[$key]->stiches_count;
        $invoice_order['file_price'] = $order_copy[$key]->file_price;
        $invoice_order['vendor_digit_rate'] = $order_copy[$key]->vendor_digit_rate;
        $invoice_order['vendor_digit_price'] = $order_copy[$key]->vendor_digit_price;
        $invoice_order['order_date_time'] = $order_copy[$key]->order_date_time;
        $invoice_order['order_dt'] = $order_copy[$key]->order_dt;
        $invoice_order['target_completion_time'] = $order_copy[$key]->target_completion_time;

        $invoice_order['allocation'] = $order_copy[$key]->allocation;

        $invoice_order['status'] = $order_copy[$key]->status;
        $invoice_order['document_type'] = $order_copy[$key]->document_type;
        $invoice_order['note'] = $order_copy[$key]->note;
        $invoice_order['unit_price'] = $order_copy[$key]->unit_price;
        $invoice_order['order_us_date'] = $order_copy[$key]->order_us_date;
          
          DB::table('invoice')->insert($invoice_order);
       }
             
   
           //DB::table('invoice')->insert($order_copy);
               
            //dd($logy);   
            //DB::table('invoice')->insert($logy[0]);
            //return \Redirect::route('invoices');   
          //  self::getIndex();
            return view('invoices.index');
}

// order details edit mode

//public function edit1(Order $order, Request $request = null)
public function edit1($id)
      {  
           // dd($id);

          //dd($request->input('id'));die;
            //dd($request->input('order_id')); exit;
          //  abort(403, 'Unauthorized action.'); 
           
            $users = User::pluck('name', 'name');
            $status = Order_Status::pluck('status', 'status'); 

            
            //$order=Invoice::find($request->input('id'));
            $order=Invoice::find($id);

             ///return view('customers.edit',compact('customer'));
            //dd($order);
             
            $created_by  = $order->created_by;
            $updated_by = $order->updated_by ;
            $cby_name =  User::find($created_by);
            $uby_name =  User::find($updated_by);
             //dd($cby_name);
            
            $created_byname =  $cby_name->name ;
            $updated_byname =  $uby_name->name ;
           
      $logusers =  DB::table('user_logs')->where('order_id' ,'=', $order->order_id)->orderby('id','desc')
                    ->limit(2)->get();
       

      foreach($logusers as $key=>$value) {
          $logy[] = collect($logusers[$key])->toArray();
       }
      
      $diffcolumns = "" ;

      if( count($logy)> 1)
      {
            $diffcol =  array_diff($logy[1], $logy[0]);
            $diffcol =array_slice($diffcol, 0, 2);
            
            foreach($diffcol as $key=>$value)  
            {
                $diffcolumns .= $key .":" . $value  . ",";
            }


            
      }
      //dd($diffcolumns);

 
      

      // $logusers1 = collect($logusers[1]);
      // $result    = array_diff($logusers , $logusers1);
      // dd($result);


   return view('orderdtls.edit',compact('order','users','status'));


  if ($request->ajax()) {
                // $alloc =  explode(',', $order->allocation);
                 $breaks = array("<br />","<br>","<br/>");  
           $note = str_ireplace($breaks, "\r\n", $order->note );
           $client_note = str_ireplace($breaks, "\r\n", $order->client_note );

          // dd($order->allocation);
                 
    $response = array(
           'id'  => $order->id,
           'order_id'  => $order->order_id,
           'client_creation_id' => $order->client_creation_id,
           'client_name' => $order->client_name,
           'client_company' => $order->client_company,
           'client_email_primary' => $order->client_email_primary,
           'client_address1' => $order->client_address1,
           'client_state' => $order->client_state,
           'client_contact_1' => $order->client_contact_1,
           'file_name' => $order->file_name,
           'file_type' => $order->file_type,
           'file_price' => $order->file_price,
           'stiches_count' => $order->stiches_count,
           'vendor_digit_rate' => $order->vendor_digit_rate,
           'vendor_digit_price' => $order->vendor_digit_price,
           'order_date_time' => $order->order_date_time,
           'order_completion_date_time' => $order->order_completion_date_time,
           'allocation' => $order->allocation,
           'unit_price' => $order->unit_price,
           'status' => $order->status,
           'order_us_date' => $order->order_us_date,
           'note'   => $note,
           'client_note' => $client_note,
           'document_type' => $order->document_type,
           'approval_time' => $order->approval_time,
           'target_completion_time' => $order->target_completion_time,
           'status_change_date' => $order->status_change_date,
           'file_count'      => $order->file_count,
           'created_byname'  => $created_byname,
           'updated_byname'  => $updated_byname,
           'diffcolumns'    => $diffcolumns,
           'status1'        => $status1

                     );
                
             
                  //return response()->json([$response]);
                  return view('orderdtls.edit',compact('order','users','status'));
            }
                
            else
            {
                 
                  return view('invoices.index',compact('order','users','status'));
            }



  }


// order details edit mode   above 
public function edit(Order $order, Request $request = null)
      {  
           // dd("hello");
           //dd($request->input('id'));die;
            //dd($request->input('order_id')); exit;
          //  abort(403, 'Unauthorized action.'); 
           
            $users = User::pluck('name', 'name');
            $status = Order_Status::pluck('status', 'status'); 

            $order=Invoice::find($request->input('id'));
             ///return view('customers.edit',compact('customer'));
            //dd($order);
             
            $created_by  = $order->created_by;
            $updated_by = $order->updated_by ;
            $cby_name =  User::find($created_by);
            $uby_name =  User::find($updated_by);
             //dd($cby_name);
            
            $created_byname =  $cby_name->name ;
            $updated_byname =  $uby_name->name ;
           
      $logusers =  DB::table('user_logs')->where('order_id' ,'=', $order->order_id)->orderby('id','desc')
                    ->limit(2)->get();
       

      foreach($logusers as $key=>$value) {
          $logy[] = collect($logusers[$key])->toArray();
       }
      
      $diffcolumns = "" ;

      if( count($logy)> 1)
      {
            $diffcol =  array_diff($logy[1], $logy[0]);
            $diffcol =array_slice($diffcol, 0, 2);
            
            foreach($diffcol as $key=>$value)  
            {
                $diffcolumns .= $key .":" . $value  . ",";
            }


            
      }
      //dd($diffcolumns);

 
      

      // $logusers1 = collect($logusers[1]);
      // $result    = array_diff($logusers , $logusers1);
      // dd($result);





  if ($request->ajax()) {
                // $alloc =  explode(',', $order->allocation);
                 $breaks = array("<br />","<br>","<br/>");  
           $note = str_ireplace($breaks, "\r\n", $order->note );
           $client_note = str_ireplace($breaks, "\r\n", $order->client_note );
                 
    $response = array(
           'id'  => $order->id,
           'order_id'  => $order->order_id,
           'client_creation_id' => $order->client_creation_id,
           'client_name' => $order->client_name,
           'client_company' => $order->client_company,
           'client_email_primary' => $order->client_email_primary,
           'client_address1' => $order->client_address1,
           'client_state' => $order->client_state,
           'client_contact_1' => $order->client_contact_1,
           'file_name' => $order->file_name,
           'file_type' => $order->file_type,
           'file_price' => $order->file_price,
           'stiches_count' => $order->stiches_count,
           'vendor_digit_rate' => $order->vendor_digit_rate,
           'vendor_digit_price' => $order->vendor_digit_price,
           'order_date_time' => $order->order_date_time,
           'order_completion_date_time' => $order->order_completion_date_time,
           'allocation' => $order->allocation,
           'unit_price' => $order->unit_price,
           'status' => $order->status,
           'order_us_date' => $order->order_us_date,
           'note'   => $note,
           'client_note' => $client_note,
           'document_type' => $order->document_type,
           'approval_time' => $order->approval_time,
           'target_completion_time' => $order->target_completion_time,
           'status_change_date' => $order->status_change_date,
           'created_byname'  => $created_byname,
           'updated_byname'  => $updated_byname,
           'diffcolumns'    => $diffcolumns
                     );
                
                  return response()->json([$response]);
            }
            else
            {
                 
                  return view('invoices.index',compact('order'));
            }


  }

  public function InvYrMonth()
        {
            //dd("hello");die;
              $yr = Carbon::now();
            $yr = $yr->year;
           
           // $year[0] = $yr;
            for($i=0; $i<10; $i++) {
                $year[$yr] = $yr;
                $yr--;
            }

            //dd($year);die;
            // $month[01] = 'JAN';
            // $month[02] = 'FEB';
            // $month[03] = 'MAR';
            // $month[04] = 'APR';
            // $month[05] = 'MAY';
            // $month[06] = 'JUN';
            // $month[07] = 'JUL';
            // $month[08] = 'AUG';
            // $month[09] = 'SEP';
            // $month[10] = 'OCT';
            // $month[11] = 'NOV';
            // $month[12] = 'DEC';

            $month =  array('01'=>'JAN',  '02'=>'FEB', '03'=>'MAR','04'=>'APR','05'=>'MAY','06'=>'JUN',
              '07'=>'JUL','08'=>'AUG','09'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');

               $company= array();


            return view('invoices.invoiceyrmonth', compact('year', 'month' , 'company'));
        }



    public  function  GenInvoice_konetk(Request $request)
{
     

  $invoice = new InvoicePrinter('Letter Legal',  '$', 'en');
  
  /* Header settings */
  $invoice->setLogo("img/patterns-logo-50x50.png");   //logo image path
  $invoice->setColor("#007fff");      // pdf color scheme
  $invoice->setType("Invoice");    // Invoice Type
  $invoice->setReference("INV-55033645");   // Reference
  $invoice->setDate(date('M dS ,Y',time()));   //Billing Date
  $invoice->setTime(date('h:i:s A',time()));   //Billing Time
  $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));    // Due Date
  $invoice->setFrom(array("Seller Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  $invoice->setTo(array("Purchaser Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));


   $orderlist = DB::table('orders')->select('bill_dt', 'order_id', 'client_company',  'client_name',
         'client_email_primary',  'file_type', 'file_name', 'file_count', 'stiches_count', 'file_price', 'status')->where('bill_dt','>=', '2021-01-01')->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->where('company_id','=', 'CO2017070013')->orderBy('id', 'desc')->get()->toArray();

       // dd($orderlist);
   foreach ($orderlist as $key ) {
                  $order_id  =  $key->order_id;
                  $desc =  $key->file_name;
                  $filetype = $key->file_type;
                  $filecount = $key->file_count;
                   $stiches = $key->stiches_count;
                    $fileprice = $key->file_price;
                    $discount = 0 ;
                    $total =    $key->file_price;
                    $invoice->addItem($order_id, $desc, $filetype, $filecount, $stiches, $discount, $fileprice);

   }

  
  
  // $invoice->addItem("AMD Athlon X2DC-7450","2.4GHz/1GB/160GB/SMP-DVD/VB",6,0,580,0,3480);
  // $invoice->addItem("PDC-E5300","2.6GHz/1GB/320GB/SMP-DVD/FDD/VB",4,0,645,0,2580);
  
  
  $invoice->addTotal("Total",9460);
  $invoice->addTotal("VAT 21%",1986.6);
  $invoice->addTotal("Total due",11446.6,true);
  
  //$invoice->addBadge("Payment Paid");
  
  $invoice->addTitle("Important Notice");
  
  $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
  
  $invoice->setFooternote("My Company Name Here");
  
  $invoice->render('example1.pdf','I'); 
  /* I => Display on browser, D => Force Download, F => local path save, S => return document as string */

}

    public function GenInvoice_jasper(Request $request)  
    {
       //dd($request->all());

        $pyear   =  $request->pyear;
        $pmonth  =  $request->pmonth;
        $pbutton =  $request->pbutton;

          $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');

       

        // if($pbutton == "1" && $inv_count > 0) {
           
        //     Session::flash('alert-warning', 'warning');
        //         Session::flash('flash_message1', 'Already Process for this Month', 'Select Again' );
               
        //         return redirect()->back();

        // }

               //   dd($pbutton);

        //dd($pyear.$pmonth);

    if ($pbutton == '1' ||  $pbutton== '2')   { //  for  new records

                           
            if ($pbutton == '2') {

                         DB::table('invoice_summary')
            ->where('yr_month', '=' , $pyear.$pmonth)
                                  ->delete();

              DB::table('invoice')
            ->whereYear('bill_dt', '>=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
                       ->delete();

                

               }

        $inv_count =  DB::table('invoice')
            ->whereYear('bill_dt', '>=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
            ->where('file_price' ,'>', 0)
            //->whereIn('company_id', $orderzones)
            ->where('status', 'Completed')
            ->count();

        //dd($inv_count);




        $order_copy = DB::table('orders')
            ->whereYear('bill_dt', '>=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
            //->where('file_price' ,'>', 0)
            //->whereIn('company_id', $orderzones)
            ->whereIn('status', ['Completed' , 'Rev-Completed', 'Rev-Completed'])
            ->orderby('company_id', 'asc')
            ->get()->toArray();

     //dd($order_copy);
    foreach($order_copy as $key=>$value) {
          // dd($key);
          //dd($order_copy[$key]->order_id);
          // $logy[] = collect($order_copy[$key])->toArray();
        $invoice_order['order_id'] = $order_copy[$key]->order_id;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_creation_id;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_company'] = $order_copy[$key]->client_company;
        $invoice_order['client_address1'] = $order_copy[$key]->client_address1;
        $invoice_order['client_state'] = $order_copy[$key]->client_state ;
        $invoice_order['client_contact_1'] = $order_copy[$key]->client_contact_1;
        $invoice_order['other_contact'] = $order_copy[$key]->other_contact;
        $invoice_order['client_note'] = $order_copy[$key]->client_note;
        $invoice_order['file_name'] = $order_copy[$key]->file_name;
        $invoice_order['file_type'] = $order_copy[$key]->file_type;
        $invoice_order['vendor'] = $order_copy[$key]->vendor;
        $invoice_order['digit_rate'] = $order_copy[$key]->digit_rate;
        $invoice_order['stiches_count'] = $order_copy[$key]->stiches_count;
        $invoice_order['file_price'] = $order_copy[$key]->file_price;
        $invoice_order['vendor_digit_rate'] = $order_copy[$key]->vendor_digit_rate;
        $invoice_order['vendor_digit_price'] = $order_copy[$key]->vendor_digit_price;
        $invoice_order['order_date_time'] = $order_copy[$key]->order_date_time;
        $invoice_order['order_dt'] = $order_copy[$key]->order_dt;
        $invoice_order['target_completion_time'] = $order_copy[$key]->target_completion_time;

        $invoice_order['allocation'] = $order_copy[$key]->allocation;

        $invoice_order['status'] = $order_copy[$key]->status;
        $invoice_order['document_type'] = $order_copy[$key]->document_type;
        $invoice_order['note'] = $order_copy[$key]->note;
        $invoice_order['unit_price'] = $order_copy[$key]->unit_price;
        $invoice_order['order_us_date'] = $order_copy[$key]->order_us_date;
        $invoice_order['bill_dt'] = $order_copy[$key]->bill_dt;
        $invoice_order['order_completion_time'] = $order_copy[$key]->order_completion_time;
        $invoice_order['approval_time'] = $order_copy[$key]->approval_time;
        $invoice_order['approval_us_time'] = $order_copy[$key]->approval_us_time;

        $invoice_order['status_change_date'] = $order_copy[$key]->status_change_date;


        $invoice_order['ip_address'] = $order_copy[$key]->ip_address;
   
        $invoice_order['company_id'] = $order_copy[$key]->company_id;

        $invoice_order['file_count'] = $order_copy[$key]->file_count;

        $invoice_order['alloc_id'] = $order_copy[$key]->alloc_id;

        $invoice_order['bill_dt'] = $order_copy[$key]->bill_dt;           

        $invoice_order['created_by'] = Auth::user()->id ;

        $timestemp =   strtotime($order_copy[$key]->bill_dt); 

        //$year  = Carbon::createFromFormat('Y-m-d', $timestemp)->year;
        //$month = Carbon::createFromFormat('Y-m-d', $timestemp)->month;
        $yearmonth =  date('Ym', $timestemp );

        $year    = date('Y', $timestemp);
        $month   = date('m', $timestemp);

       //   dd($yearmonth);

        $invoice_order['bill_yr_month'] =  (int)($yearmonth);
        $yearmonth  = (int)($yearmonth);
 
          $insert_data[] = $invoice_order;
         // $psuccess = DB::table('invoice')->insert($invoice_order);
       }
          
          // $psuccess = DB::table('invoice')->insert($insert_data);
         foreach (array_chunk($insert_data,500) as $t) {

                               DB::table('invoice')->insert($t);


                            }
    

      $invoice_copy = DB::table('invoice')
          ->select('company_id' , 'client_company',  DB::raw('SUM(file_price) as inv_amount') , DB::raw('SUM(inv_paid_amt) as paid_amt'),
              DB::raw('SUM(inv_out_amt) as out_amt' ))
          ->where('bill_yr_month' , '=', $yearmonth)
          ->groupBy('company_id', 'client_company')
          ->get()->toarray(); 
                //DB::raw("(DATE_FORMAT(bill_dt,'%Y%m'))")


           // dd($invoice_copy);

               $count= 0;
        foreach($invoice_copy as $key=>$value) {
                
                
                //$newinvoice_copy =array();
                $company_id = $invoice_copy[$key]->company_id;
                //$file_type  = $invoice_copy[$key]->file_type;
                $inv_amount = $invoice_copy[$key]->inv_amount ;
                $paid_amt   = $invoice_copy[$key]->paid_amt ;
                $out_amt    = $invoice_copy[$key]->inv_amount ;
                $comp_name =  $invoice_copy[$key]->client_company;

                $folderPath = public_path() ;
                //  company-name without spaces
                $newcl =  substr(trim($comp_name),0,12);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);

                 $output =   $newcl . '.pdf' ;
                 //  generate   invoice
                  
                   $new_dt = Carbon::createFromDate($year, $month, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth()->format('Y-m-d');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('Y-m-d');
           
                 //date creation above;

                 $stat =  array('Completed', 'Rev-Completed', 'Ch-Completed');

                 $P_status  = "'" . implode( "','", $stat ) . "'" ;
                  
           // $param2_1    = " and order_dtls.status IN" . " (" . $P_status . ")";  

           // $param2    = " and orders.status IN" . " (" . $P_status . ")";   
             $param2    = " and orders.status IN ('Completed', 'Rev-Completed', 'Ch-Completed')"; 
            $param2 = stripslashes($param2);
           // $param2_1 = stripslashes($param2_1);
            //$param2 =   $param2_1 . $param2 ;

            $ext = 'pdf';

                    $jasper->process(
                           public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$company_id),
                                  //  array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  // 'database' => 'omsv4', 'username' => 'root', 'password' => '4{h}fPvcf4Qyer%**' ),
                                      array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
                                  'database' => 'omsv4test', 'username' => 'php', 
                                  'password' => '4{h}fPvcf4Qyer%--' ),
                                   false ,
                                   false
                                       )->execute();

                         // dd($jasper);
                //  generate invoice



              $newinvoice_copy =
           [ 'company_id' => $company_id,
             'client_company' => $comp_name,
            // 'file_type'    =>  $file_type,
              'inv_amount'  => (int)$inv_amount,
               'amt_paid_usd' =>   (int)$paid_amt,
               'net_amt' =>   (int)$out_amt,
               'yr_month' =>   $yearmonth,
                'invoice_no' =>  $yearmonth.'-'.'001' ,
                'file_url'  => $output    ] ; 

                // 'invoice_no' =>  'INV'.$company_id.'#'.$yearmonth.'-'.'001' 
           
          
            $psuccess1 = DB::table('invoice_summary')->insert($newinvoice_copy);  

            
       
            $count++;
      
           
        }

          
        // dd($invoice_copy);
        // return redirect()->action(
        //        'InvoiceSummaryController@SummarygetIndex', ['yrmn'
        //         => $yearmonth ]
        //       );  not working removed 15/11/18
       Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created, Go to Invoice Summary' );
               
                return redirect()->back();

      
      }

      // if ($pbutton == 2) {

      //         $del_flag = DB::table('invoice')
      //       ->whereYear('bill_dt', '>=' , $pyear)
      //       ->whereMonth('bill_dt', '=' , $pmonth)
      //       ->where('file_price' ,'>', 0)
      //       ->where('status', 'Completed')
      //       ->delete();

      // }


       // if ($pbutton == 3) {

       //        $invoice_copy = DB::table('invoice')
       //          ->whereYear('bill_dt', '>=' , $pyear)
       //          ->whereMonth('bill_dt', '=' , $pmonth)
       //          ->where('file_price' ,'>', 0)
       //           ->where('status', 'Completed')
       //           ->select('order_id')
       //           ->pluck('order_id')
       //           ->toArray();

                               
       //         $order_copy = DB::table('orders')
       //          ->whereYear('bill_dt', '>=' , $pyear)
       //          ->whereMonth('bill_dt', '=' , $pmonth)
       //          ->where('file_price' ,'>', 0)
       //           ->where('status', 'Completed')
       //           ->whereNotIn('order_id' , $invoice_copy)
       //           ->get()->toArray();
                 

       //           $psuccess = DB::table('invoice')->insert($invoice_order);
                
       //     }

        //   return view('invoices_summary.index');
           Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created', 'Go to Invoice Summary' );
               
                return redirect()->back();
         

  }      

 //new geninvoice with  dompdf 
  public function GenInvoice_new020621(Request $request)  
    {
       //dd($request->all());


        $pyear   =  $request->pyear;
        $pmonth  =  $request->pmonth;
        $pbutton =  $request->pbutton;

          $pmonth = str_pad($pmonth,  2 ,'0', STR_PAD_LEFT);

          $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');

       

  $pdf = app('dompdf.wrapper');
  $invoice = new Dompdf();

         $inv_count =  DB::table('invoice')
            ->whereYear('bill_dt', '=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
            ->where('file_price' ,'>', 0)
            //->whereIn('company_id', $orderzones)
            ->where('status', 'Completed')
            ->count();

        if($pbutton == "1" && $inv_count > 0) {
           
            Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'Already Process for this Month', 'Select Again' );
               
                return redirect()->back();

        }


         $ord_count =  DB::table('orders')
            ->whereYear('bill_dt', '=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
            ->where('file_price' ,'>', 0)
            //->whereIn('company_id', $orderzones)
            ->wherein('status', ['Completed', 'Rev-Completed', 'Ch-Completed'])
            ->count();
            
        if($ord_count == 0) {
           
            Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No records for given selection' );
               
                return redirect()->back();

        }


               //   dd($pbutton);

        //dd($pyear.$pmonth);

    if ($pbutton == '1' ||  $pbutton== '2')   { //  for  new records

                           
            if ($pbutton == '2') {

                

                         DB::table('invoice_summary')
            ->where('yr_month', '=' , $pyear.$pmonth)
                                  ->delete();

              DB::table('invoice')
            ->whereYear('bill_dt', '>=' , $pyear)
            ->whereMonth('bill_dt', '=' , $pmonth)
                       ->delete();

                

               }

        // $inv_count =  DB::table('invoice')
        //     ->whereYear('bill_dt', '>=' , $pyear)
        //     ->whereMonth('bill_dt', '=' , $pmonth)
        //     ->where('file_price' ,'>', 0)
        //                ->where('status', 'Completed')
        //     ->count();

        // dd($inv_count);


               //client temp creation
                  $dropTempTables = DB::unprepared(
    DB::raw("
        DROP TABLE IF EXISTS table_client_b ;
       
    ")
);

            $createTempTables = DB::unprepared(
    DB::raw("
        CREATE TEMPORARY TABLE table_client_b 
                        AS (
                            SELECT *
                            FROM clients
                            order by company_id
                           
                            );
                       

    ")
);

               // client temp creation

               $dropTempTables = DB::unprepared(
    DB::raw("
        DROP TABLE IF EXISTS table_temp_b ;
       
    ")
);

            $createTempTables = DB::unprepared(
    DB::raw("
        CREATE TEMPORARY TABLE table_temp_b 
                        AS (
                            SELECT *
                            FROM orders
                            WHERE YEAR(bill_dt) = $pyear
              and  MONTH(bill_dt)  = $pmonth
              and  status in ('Completed' , 'Rev-Completed', 'Ch-Completed')
              order by company_id, file_type desc, client_name desc
                           
                            );
                       

    ")
);




        $order_copy = DB::table('table_temp_b')
            //->whereYear('bill_dt', '>=' , $pyear)
            //->whereMonth('bill_dt', '=' , $pmonth)
            //->where('file_price' ,'>', 0)
            //->whereIn('company_id', $orderzones)
            //->whereIn('status', ['Completed' , 'Rev-Completed', 'Rev-Completed'])
            ->orderby('company_id', 'asc')
            ->get()->toArray();

     //dd($order_copy);
    foreach($order_copy as $key=>$value) {
          // dd($key);
          //dd($order_copy[$key]->order_id);
          // $logy[] = collect($order_copy[$key])->toArray();
        $invoice_order['order_id'] = $order_copy[$key]->order_id;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_creation_id;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_creation_id'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_name'] = $order_copy[$key]->client_name;
        $invoice_order['client_email_primary'] = $order_copy[$key]->client_email_primary;
        $invoice_order['client_company'] = $order_copy[$key]->client_company;
        $invoice_order['client_address1'] = $order_copy[$key]->client_address1;
        $invoice_order['client_state'] = $order_copy[$key]->client_state ;
        $invoice_order['client_contact_1'] = $order_copy[$key]->client_contact_1;
        $invoice_order['other_contact'] = $order_copy[$key]->other_contact;
        $invoice_order['client_note'] = $order_copy[$key]->client_note;
        $invoice_order['file_name'] = $order_copy[$key]->file_name;
        $invoice_order['file_type'] = $order_copy[$key]->file_type;
        $invoice_order['vendor'] = $order_copy[$key]->vendor;
        $invoice_order['digit_rate'] = $order_copy[$key]->digit_rate;
        $invoice_order['stiches_count'] = $order_copy[$key]->stiches_count;
        $invoice_order['file_price'] = $order_copy[$key]->file_price;
        $invoice_order['vendor_digit_rate'] = $order_copy[$key]->vendor_digit_rate;
        $invoice_order['vendor_digit_price'] = $order_copy[$key]->vendor_digit_price;
        $invoice_order['order_date_time'] = $order_copy[$key]->order_date_time;
        $invoice_order['order_dt'] = $order_copy[$key]->order_dt;
        $invoice_order['target_completion_time'] = $order_copy[$key]->target_completion_time;

        $invoice_order['allocation'] = $order_copy[$key]->allocation;

        $invoice_order['status'] = $order_copy[$key]->status;
        $invoice_order['document_type'] = $order_copy[$key]->document_type;
        $invoice_order['note'] = $order_copy[$key]->note;
        $invoice_order['unit_price'] = $order_copy[$key]->unit_price;
        $invoice_order['order_us_date'] = $order_copy[$key]->order_us_date;
        $invoice_order['bill_dt'] = $order_copy[$key]->bill_dt;
        $invoice_order['order_completion_time'] = $order_copy[$key]->order_completion_time;
        $invoice_order['approval_time'] = $order_copy[$key]->approval_time;
        $invoice_order['approval_us_time'] = $order_copy[$key]->approval_us_time;

        $invoice_order['status_change_date'] = $order_copy[$key]->status_change_date;


        $invoice_order['ip_address'] = $order_copy[$key]->ip_address;
   
        $invoice_order['company_id'] = $order_copy[$key]->company_id;

        $invoice_order['file_count'] = $order_copy[$key]->file_count;

        $invoice_order['alloc_id'] = $order_copy[$key]->alloc_id;

        $invoice_order['bill_dt'] = $order_copy[$key]->bill_dt;           

        $invoice_order['created_by'] = Auth::user()->id ;

        $timestemp =   strtotime($order_copy[$key]->bill_dt); 

        //$year  = Carbon::createFromFormat('Y-m-d', $timestemp)->year;
        //$month = Carbon::createFromFormat('Y-m-d', $timestemp)->month;
        $yearmonth =  date('Ym', $timestemp );

        $year    = date('Y', $timestemp);
        $month   = date('m', $timestemp);

       //   dd($yearmonth);

        $invoice_order['bill_yr_month'] =  (int)($yearmonth);
        $yearmonth  = (int)($yearmonth);
 
          $insert_data[] = $invoice_order;
         // $psuccess = DB::table('invoice')->insert($invoice_order);
       }
          
          // $psuccess = DB::table('invoice')->insert($insert_data);
         foreach (array_chunk($insert_data,500) as $t) {

                               DB::table('invoice')->insert($t);


                            }
    
          //  old logic
      // $invoice_copy = DB::table('invoice')
      //     ->select('company_id' , 'client_company',  DB::raw('SUM(file_price) as inv_amount') , DB::raw('SUM(inv_paid_amt) as paid_amt'),
      //         DB::raw('SUM(inv_out_amt) as out_amt' ))
      //     ->where('bill_yr_month' , '=', $yearmonth)
      //     ->groupBy('company_id', 'client_company')
      //     ->get()->toArray();

             // new logic as  total amount 
           $invoice_copy = DB::table('invoice')
          ->select('company_id' , 'client_company',  DB::raw('SUM(file_price) as inv_amount'))
          ->where('bill_yr_month' , '=', $yearmonth)
          ->groupBy('company_id', 'client_company')
          ->get();
                // ->toarray() ;DB::raw("(DATE_FORMAT(bill_dt,'%Y%m'))")

          // date create logic
         $count= 0;

                $folderPath = public_path() ;
                //date creation
                    $new_dt = Carbon::createFromDate($year, $month, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth()->format('Y-m-d');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('Y-m-d');
           
                 //date creation above;

             $path = public_path() .'/' . $yearmonth;
  if (!file_exists($path)) {
    mkdir(public_path() .'/' .$yearmonth);
}


          // date logic

            //dd($createTempTables);
           // dd($invoice_copy);

             
        foreach($invoice_copy->chunk(40) as $chunk ) {
        foreach($chunk as $key=>$value) {
                
                
                //$newinvoice_copy =array();
                $company_id = $chunk[$key]->company_id;
                
                $inv_amount = $chunk[$key]->inv_amount ;
                $paid_amt   = 0 ;
                $out_amt    = 0 ;
                $comp_name =  $chunk[$key]->client_company;

               
                //  company-name without spaces
                $newcl =  substr(trim($comp_name),0,12);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);

                 $output =   $newcl . '.pdf' ;
                 //  generate   invoice
                  
               

                
            ///

  // $company_id =  $request->company_id;
  // $yrmonth = $request->yr_month;

              $newinvoice_copy =
           [ 'company_id' => $company_id,
             'client_company' => $comp_name,
            // 'file_type'    =>  $file_type,
              'inv_amount'  => (int)$inv_amount,
               'amt_paid_usd' =>   (int)$paid_amt,
               'net_amt' =>   (int)$out_amt,
               'yr_month' =>   $yearmonth,
               'discount' => 0,
                'invoice_no' =>  $yearmonth.'-'. $count ,
                'invoice_dt' => $pfr_dt,
                'file_url'  => $output    ] ; 

                 
            $psuccess1 = DB::table('invoice_summary')->insert($newinvoice_copy);  

            
  
 // $pdf='';
  
  $invoiceInfo =[];

  $clientinfo = [];
   
  $clientinfo =DB::table('table_client_b')->select('client_company', 'phone', 'client_address1',
      'client_state', 'website', 'client_country')->where('company_id','=', $company_id)->get()->toArray();

   $invoiceInfo =DB::table('invoice_summary')->select('invoice_no', 'invoice_dt', 'discount',
      'discount_reason')->where('company_id','=', $company_id)->where('yr_month', $yearmonth)->get()->toArray();

  //dd($invoiceInfo);

       // $ordersum = DB::table('table_temp_a')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('bill_dt','>=', $pfr_dt)->where('bill_dt','<=', $pto_dt)->where('company_id','=',
       //  $company_id)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->GroupBy('file_type')->get();


        $ordersum = DB::table('table_temp_b')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('company_id','=', $company_id)->GroupBy('file_type')->get();

      // dd($ordersum);

       $isvector = false;

       $dcount =0;

       foreach ($ordersum as $key) {
           if ($key->file_type == 'Vector')
           {
            $isvector = true;
            
           }

            if ($key->file_type == 'Digitizing')
           {
            $isvector = false;
           $dcount =1;
           }
       }

        // $orderlist = DB::table('orders')->select('bill_dt', 'order_us_date', 'client_company',  'client_name',
        //  'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 
        //  'file_price', 'status')->where('bill_dt','>=', $pfr_dt)->where('bill_dt','<=', $pto_dt)->where('company_id','=',  $company_id)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();


         $orderlist = DB::table('table_temp_b')->select('bill_dt', 'order_us_date', 'client_company',  'client_name', 'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 'file_price', 'status')->where('company_id','=',  $company_id)->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();

       // dd($orderlist);

  // $invoice = PDF::loadView('invoices.invoicepdf', compact('orderlist' ,'invoiceInfo','pdf'));

  if ( $dcount == 0)      
  {
       $invoice = \PDF::loadView('invoices.view-sample', compact('orderlist' ,'invoiceInfo', 'clientinfo','pdf', 'ordersum'));
  }
  else {
     $invoice = \PDF::loadView('invoices.view-sample-d', compact('orderlist' ,'invoiceInfo', 'clientinfo', 'pdf', 'ordersum'));
  }
 
   //return $pdf->stream();
  $invoice->setPaper('A4', 'portrait');

  
    $fileName =  $output ;
    $invoice->save( $path .'/'. $fileName);

  //$invoice->download('view-sample.pdf');



            ///  NEW LOGIC  ADDED  

                    // $jasper->process(
                    //        public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                    //                $output,
                    //                array($ext),
                    //                array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                    //                 "P_company_id" =>$company_id),
                               
                    //                   array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
                    //               'database' => 'omsv4test', 'username' => 'php', 
                    //               'password' => '4{h}fPvcf4Qyer%--' ),
                    //                false ,
                    //                false
                    //                    )->execute();

                         // dd($jasper);
                //  generate invoice




                // 'invoice_no' =>  'INV'.$company_id.'#'.$yearmonth.'-'.'001' 
           
          
       
            $count++;
           

           
        }
      }

          
        // dd($invoice_copy);
        // return redirect()->action(
        //        'InvoiceSummaryController@SummarygetIndex', ['yrmn'
        //         => $yearmonth ]
        //       );  not working removed 15/11/18
       Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created, Go to Invoice Summary' );
               
                return redirect()->back();

      
      }

    
        //   return view('invoices_summary.index');
           Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created', 'Go to Invoice Summary' );
               
                return redirect()->back();
         

  }      
      
 
//new geninvoice with  barrydh dompdf 
  public function GenInvoice_new(Request $request)  
    {
        // dd($request->all());


        $pyear   =  $request->pyear;
        $pmonth  =  $request->pmonth;
        $pbutton =  $request->pbutton;
        $orderzones = $request->orderzones;
        $selectall =  $request->select_all;


        $userid = Auth()->user()->id;
          $username = Auth()->user()->name;

          $company_names1 =  Client::wherein('company_id', $orderzones)->pluck('client_company');

         // dd($company_names1);
        $result ='';
          foreach ($company_names1 as $key => $value) {
  $result .=  $value .','  ;
}

//dd($result);

$company_fired =  rtrim($result,',');

$company_fired = explode(',', $company_fired);



   
        $pmonth = str_pad($pmonth,  2 ,'0', STR_PAD_LEFT);
        $yearmonth =  $pyear.$pmonth;
    
        

    
   // return redirect()->back();

        //dd($selectall);

         // $inv_count =  DB::table('invoice')
         //    ->whereYear('bill_dt', '=' , $pyear)
         //    ->whereMonth('bill_dt', '=' , $pmonth)
         //    ->where('file_price' ,'>', 0)
           
         //    ->where('status', 'Completed')
         //    ->count();

          $count = count($orderzones);

          if( ($count ==1) ){
             Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'Select atleast two company' );
               
                return redirect()->back();
          }

          if( ($count > 10)  &&  ($selectall == null) ){
             Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'More than 20 selected ', 'Select Again' );
               
                return redirect()->back();
          }

         
         $jobid =  DB::table('jobinvoice')->where('year_month', $yearmonth)->wherein('company_fired', $company_fired)->count();

         //dd($jobid);

           $cnt = 0;
           $cnt = $jobid;

           // if(!($jobid->isEmpty()))
           // {
           //              foreach ($jobid as $key ) {
           //                      $count =  DB::table('jobs')->where('id', $key->jobid)->count();
           //                      $cnt .= $cnt+$count;                         
           //              }
                         
           // }
                   
            
                   
                 
       

        // dd($count);

         if ($cnt> 0)
         {
           Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'This Job is Already Submitted ', 'Select After Some time' );
               
                return redirect()->back();

         }


         

        // if($pbutton == "1" && $inv_count > 0) {
           
        //     Session::flash('alert-warning', 'warning');
        //         Session::flash('flash_message1', 'Already Process for this Month', 'Select Again' );
               
        //         return redirect()->back();

        // }


        //  $ord_count =  DB::table('orders')
        //     ->whereYear('bill_dt', '=' , $pyear)
        //     ->whereMonth('bill_dt', '=' , $pmonth)
        //     ->whereIn('company_id', $orderzones)
        //     ->wherein('status', ['Completed', 'Rev-Completed', 'Ch-Completed'])
        //     ->count();
            
        // if($ord_count == 0) {
           
        //     Session::flash('alert-warning', 'warning');
        //         Session::flash('flash_message1', 'No records for given selection' );
               
        //         return redirect()->back();

        // }



               //client temp creation
                  $dropTempTables = DB::unprepared(
    DB::raw("
        DROP TABLE IF EXISTS table_client_b ;
       
    ")
);

            $createTempTables = DB::unprepared(
    DB::raw("
        CREATE TEMPORARY TABLE table_client_b 
                        AS (
                            SELECT *
                            FROM clients
                            where delete_flag = 'N'
                            order by company_id
                           
                            );
                       

    ")
);

               // client temp creation

            //   order temp table creation

                     $dropTempTables = DB::unprepared(
    DB::raw("
        DROP TABLE IF EXISTS table_temp_b ;
       
    ")
);

            $createTempTables = DB::unprepared(
    DB::raw("
        CREATE TEMPORARY TABLE table_temp_b 
                        AS (
                            SELECT *
                            FROM orders
                            WHERE YEAR(bill_dt) = $pyear
              and  MONTH(bill_dt)  = $pmonth
                            and  status in ('Completed' , 'Rev-Completed', 'Ch-Completed')
              order by company_id, file_type desc, client_name desc
                           
                            );
                       

    ")
);

            // order temp table creation

            // FILE LOGIC CREATION

                 $count= 0;

                $folderPath = public_path() ;
                //date creation
                    $new_dt = Carbon::createFromDate($pyear, $pmonth, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth()->format('d-M-Y');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('d-M-Y');

            //$due_dt =  $new_dt1->addMonth()->format('d-M-Y');

            $today_dt = Carbon::now();
             $today_dt1 = Carbon::now();

            $due_dt = $today_dt1->subDays(-10)->format('d-M-Y');
           
                 //date creation above;

             $path = public_path() .'/files/1/' . $yearmonth;
             if (!file_exists($path)) {
                  mkdir(public_path() .'/files/1/' .$yearmonth);
              }
            //FILE LOGIC CREATION




       
       if($selectall == "1" )
        {
            //dd('hello');

            //              DB::table('invoice_summary')
            // ->where('yr_month', '=' , $pyear.$pmonth)
            //                            ->delete();   remove to avoid overwrite on 09-07-21
            //dd($orderzones);
            $orderzones1 = $orderzones ;
            //dd($orderzones1);
            foreach (array_chunk($orderzones1,5) as $t)
            {
               //dd($t);
               //$orderzones = $t;
               $orderzones =array();
               $orderzones = $t;
              // dd($orderzones);
              // sleep(60);


            //   order copy  company wise  creation   

                     // new logic as  total amount 
           $invoice_copy = DB::table('table_temp_b')
          ->select('company_id' , 'client_company',  DB::raw('SUM(file_price) as inv_amount'))
          ->whereIn('company_id', $orderzones)
                            ->groupBy('company_id', 'client_company')
          ->get();

            //  order copy company wise  creation

          //  ACTUAL LOGIC  FOR PDF START HERE  

        foreach($invoice_copy->chunk(2) as $chunk ) {
        foreach($chunk as $key=>$value) {
                
                
                //$newinvoice_copy =array();
                $company_id = $chunk[$key]->company_id;
                
                $inv_amount = $chunk[$key]->inv_amount ;
                $paid_amt   = 0 ;
                $out_amt    = 0 ;
                $comp_name =  $chunk[$key]->client_company;

               
                //  company-name without spaces
                //$newcl =  substr(trim($comp_name),0,12);
                 $newcl =  trim($comp_name);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);


                 $output =   $newcl . $pmonth . $pyear . '.pdf' ;
                 //  generate   invoicep
                  
               

                
            ///

  // $company_id =  $request->company_id;
  // $yrmonth = $request->yr_month;

              $newinvoice_copy =
           [ 'company_id' => $company_id,
             'client_company' => $comp_name,
            // 'file_type'    =>  $file_type,
              'inv_amount'  => (int)$inv_amount,
               'amt_paid_usd' =>   (int)$paid_amt,
               'net_amt' =>   (int)$inv_amount,
               'yr_month' =>   $yearmonth,
               'discount' => 0,
                'invoice_no' =>  $yearmonth.'-'. $count ,
                'invoice_dt' => $today_dt,
                'file_url'  => $output    ] ; 

                $record_count = DB::table('invoice_summary')->where('company_id', '=', $company_id)->where('yr_month','=', $yearmonth)->count();

                  if ($record_count >=1 )
                  {
                     $record_count = 0 ;
                  }
                  else {
                            $psuccess1 = DB::table('invoice_summary')->insert($newinvoice_copy);
                  }
                 
           

            
  
 // $pdf='';
  
       $invoiceInfo =[];

       $clientinfo = [];
   
       $clientinfo =DB::table('table_client_b')->select('client_company', 'phone', 'client_address1',
      'client_state', 'website', 'client_country')->where('company_id','=', $company_id)->get()->toArray();

        $invoiceInfo =DB::table('invoice_summary')->select('invoice_no', 'invoice_dt', 'discount',
      'discount_reason')->where('company_id','=', $company_id)->where('yr_month', $yearmonth)->get()->toArray();

  //dd($invoiceInfo);

       // $ordersum = DB::table('table_temp_a')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('bill_dt','>=', $pfr_dt)->where('bill_dt','<=', $pto_dt)->where('company_id','=',
       //  $company_id)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->GroupBy('file_type')->get();


        $ordersum = DB::table('table_temp_b')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('company_id','=', $company_id)->GroupBy('file_type')->get();

      // dd($ordersum);

       $isvector = false;

       $dcount =0;

       foreach ($ordersum as $key) {
           if ($key->file_type == 'Vector')
           {
            $isvector = true;
            
           }

            if ($key->file_type == 'Digitizing')
           {
            $isvector = false;
           $dcount =1;
           }
       }

    

         $orderlist = DB::table('table_temp_b')->select('bill_dt', 'order_us_date', 'client_company',  'client_name', 'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 'file_price', 'status')->where('company_id','=',  $company_id)->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();

       // dd($orderlist);

  // $invoice = PDF::loadView('invoices.invoicepdf', compact('orderlist' ,'invoiceInfo','pdf'));

         
  //$pdf = app('dompdf.wrapper');
  //$invoice = new Dompdf();
            $userid = Auth()->user()->id ;
            $username = Auth()->user()->name ;
            $user_dtl = "userid=".$userid;
 

                $delay = \DB::table('jobs')->count()*10;
              // CreateInvoiceJob::dispatch($pyear, $pmonth, $pbutton, $orderzones)->delay(now()->addMinutes(1));

               if ($count < 200 ||  $count > 400) {
                    CreateInvoiceJob::dispatch( $dcount, $orderlist , $invoiceInfo, $clientinfo, 
                  $ordersum, $pfr_dt, $pto_dt, $due_dt, $output, $path,$userid, $user_dtl, $username,$selectall, $yearmonth, $comp_name)->delay($delay);
               }
               else {
                     
                       CreateInvoiceJobSecond::dispatch( $dcount, $orderlist , $invoiceInfo, $clientinfo, 
                  $ordersum, $pfr_dt, $pto_dt, $due_dt, $output, $path,$userid, $user_dtl, $username,$selectall, $yearmonth, $comp_name)->delay($delay);
               }
               
             $count++;
           
        }
      }

 
            }

        }
      

       else{

                
            //              DB::table('invoice_summary')
            // ->where('yr_month', '=' , $pyear.$pmonth)
            //            ->whereIn('company_id', $orderzones)
            //                 ->delete();

              
            //   order copy  company wise  creation   

                     // new logic as  total amount 
           $invoice_copy = DB::table('table_temp_b')
          ->select('company_id' , 'client_company',  DB::raw('SUM(file_price) as inv_amount'))
          ->whereIn('company_id', $orderzones)
                            ->groupBy('company_id', 'client_company')
          ->get();

            //  order copy company wise  creation
      foreach($invoice_copy->chunk(2) as $chunk ) {
        foreach($chunk as $key=>$value) {
                
                
                //$newinvoice_copy =array();
                $company_id = $chunk[$key]->company_id;
                
                $inv_amount = $chunk[$key]->inv_amount ;
                $paid_amt   = 0 ;
                $out_amt    = 0 ;
                $comp_name =  $chunk[$key]->client_company;

               
                //  company-name without spaces
                //$newcl =  substr(trim($comp_name),0,12);
                 $newcl =  trim($comp_name);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);


                 $output =   $newcl . $pmonth . $pyear . '.pdf' ;
                 //  generate   invoicep
                  
               

                
            ///

  // $company_id =  $request->company_id;
  // $yrmonth = $request->yr_month;

              $newinvoice_copy =
           [ 'company_id' => $company_id,
             'client_company' => $comp_name,
            // 'file_type'    =>  $file_type,
              'inv_amount'  => (int)$inv_amount,
               'amt_paid_usd' =>   (int)$paid_amt,
               'net_amt' =>   (int)$inv_amount,
               'yr_month' =>   $yearmonth,
               'discount' => 0,
                'invoice_no' =>  $yearmonth.'-'. $count ,
                'invoice_dt' => $today_dt,
                'file_url'  => $output    ] ; 

             $record_count = DB::table('invoice_summary')->where('company_id', '=', $company_id)->where('yr_month','=', $yearmonth)->count();

                  if ($record_count >=1 )
                  {
                     $record_count = 0 ;
                  }
                  else {
                            $psuccess1 = DB::table('invoice_summary')->insert($newinvoice_copy);
                  }
                 
            
  
 // $pdf='';
  
       $invoiceInfo =[];

       $clientinfo = [];
   
       $clientinfo =DB::table('table_client_b')->select('client_company', 'phone', 'client_address1',
      'client_state', 'website', 'client_country')->where('company_id','=', $company_id)->get()->toArray();

        $invoiceInfo =DB::table('invoice_summary')->select('invoice_no', 'invoice_dt', 'discount',
      'discount_reason')->where('company_id','=', $company_id)->where('yr_month', $yearmonth)->get()->toArray();

  


        $ordersum = DB::table('table_temp_b')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('company_id','=', $company_id)->GroupBy('file_type')->get();

      // dd($ordersum);

       $isvector = false;

       $dcount =0;

       foreach ($ordersum as $key) {
           $filetype =  $key->file_type;
           $ordersumfp  = $key->file_price;
           if ($key->file_type == 'Vector')
           {
            $isvector = true;
            
           }

            if ($key->file_type == 'Digitizing')
           {
            $isvector = false;
           $dcount =1;
           }
       }

      //  dd($dcount);

         $orderlist = DB::table('table_temp_b')->select('bill_dt', 'order_us_date', 'client_company',  'client_name', 'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 'file_price', 'status')->where('company_id','=',  $company_id)->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();

         // dd(count($orderlist));

  // $invoice = PDF::loadView('invoices.invoicepdf', compact('orderlist' ,'invoiceInfo','pdf'));

         
  //$pdf = app('dompdf.wrapper');
  //$invoice = new Dompdf();
                     $userid = Auth()->user()->id ;
                     $username = Auth()->user()->name ;
        $user_dtl = "userid=".$userid;

                $delay = \DB::table('jobs')->count()*10;
              // CreateInvoiceJob::dispatch($pyear, $pmonth, $pbutton, $orderzones)->delay(now()->addMinutes(1));
             CreateInvoiceJob::dispatch($dcount, $orderlist , $invoiceInfo, $clientinfo, 
                  $ordersum,  $pfr_dt, $pto_dt, $due_dt, $output, $path, $userid, $user_dtl, $username,$selectall, $yearmonth, $comp_name)->delay($delay);

          

              $count++;
           
        }
      }

 
       }


    
        //   return view('invoices_summary.index');
           Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created', 'Go to Invoice Summary' );
               
                return redirect()->back();
         

  }      
      

  
//new geninvoice with  dompdf 
  public function GenInvoice_new_work120621(Request $request)  
    {
       //dd($request->all());


        $pyear   =  $request->pyear;
        $pmonth  =  $request->pmonth;
        $pbutton =  $request->pbutton;
        $orderzones = $request->orderzones;
        $selectall =  $request->select_all;

        //dd($selectall);

          $pmonth = str_pad($pmonth,  2 ,'0', STR_PAD_LEFT);

    
         // $inv_count =  DB::table('invoice')
         //    ->whereYear('bill_dt', '=' , $pyear)
         //    ->whereMonth('bill_dt', '=' , $pmonth)
         //    ->where('file_price' ,'>', 0)
           
         //    ->where('status', 'Completed')
         //    ->count();

          $count = count($orderzones);

          if( ($count > 20)  &&  ($selectall == null) ){
             Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'More than 20 selected ', 'Select Again' );
               
                return redirect()->back();
          }

         

        if($pbutton == "1" && $inv_count > 0) {
           
            Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'Already Process for this Month', 'Select Again' );
               
                return redirect()->back();

        }


        //  $ord_count =  DB::table('orders')
        //     ->whereYear('bill_dt', '=' , $pyear)
        //     ->whereMonth('bill_dt', '=' , $pmonth)
        //     ->whereIn('company_id', $orderzones)
        //     ->wherein('status', ['Completed', 'Rev-Completed', 'Ch-Completed'])
        //     ->count();
            
        // if($ord_count == 0) {
           
        //     Session::flash('alert-warning', 'warning');
        //         Session::flash('flash_message1', 'No records for given selection' );
               
        //         return redirect()->back();

        // }

       
       if($selectall == "1" )
        {
            //dd('hello');
            //dd($orderzones);
            $orderzones1 = $orderzones ;
            //dd($orderzones1);
            foreach (array_chunk($orderzones1,5) as $t)
            {
               //dd($t);
               //$orderzones = $t;
               $orderzones =array();
               $orderzones = $t;
              // dd($orderzones);
              // sleep(60);
                $delay = \DB::table('jobs')->count()*60;
              // CreateInvoiceJob::dispatch($pyear, $pmonth, $pbutton, $orderzones)->delay(now()->addMinutes(1));
                CreateInvoiceJob::dispatch($pyear, $pmonth, $pbutton, $orderzones)->delay($delay);
            }

        }
      

       else{
                 CreateInvoiceJob::dispatch($pyear, $pmonth, $pbutton, $orderzones);
       }




               //   dd($pbutton);

        //dd($pyear.$pmonth);

    
        //   return view('invoices_summary.index');
           Session::flash('alert-success', 'success');
                Session::flash('flash_message1', 'Successfully Created', 'Go to Invoice Summary' );
               
                return redirect()->back();
         

  }      
      





     public function search(Request $request = null)
          {

            $clients = DB::table('clients')
            ->where('client_name', 'like', '%'.$request->search.'%' )
            ->get();
            $output="";
            $output = '<tr>'.
                '<td>'. $clients->id . '</td>' .
                '<td>'. $clients->client_name . '</td>'.
                '<td>'. $clients->client_email_primary . '</td>'.
                '<td>'. $clients->client_email_secondary . '</td>'.
                '<td>'. $clients->client_company . '</td>'.
                '</tr>' ;
            return response($output);


     }


public function  InvoiceVectorPrint(Request $request)
{

  //dd($request->all());

  $company_id =  $request->company_id;
  $yrmonth = $request->yr_month;

  $frdt =  substr($request->yr_month,0,4) .'-'. substr($request->yr_month,4,2).'-'.'01';
  
   $todt =  substr($request->yr_month,0,4) .'-'. substr($request->yr_month,4,2).'-'.'31';
  
    $year  =  substr($request->yr_month,0,4);
    $month =  substr($request->yr_month,4,2);

    $month = str_pad($month,  2 ,'0', STR_PAD_LEFT);
 
          $new_dt = Carbon::createFromDate($year, $month, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);

            $pfr_dt = $new_dt->startOfMonth()->format('d-M-Y');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('d-M-Y');

            $due_dt =  $new_dt1->addMonth()->format('d-M-Y');
           
 

  //$pdf = app('dompdf.wrapper');
  //$invoice = new Dompdf();
  $pdf='';
  $invoice= '';

  global $_dompdf_warnings;
$_dompdf_warnings = array();
global $_dompdf_show_warnings;
$_dompdf_show_warnings = false;
  
  $invoiceInfo =[];

  $clientinfo = [];
   
  $clientinfo =DB::table('clients')->select('client_company', 'phone', 'client_address1',
      'client_state', 'website', 'client_country')->where('company_id','=', $company_id)->get()->toArray();

   $invoiceInfo =DB::table('invoice_summary')->select('invoice_no', 'invoice_dt', 'discount',
      'discount_reason')->where('company_id','=', $company_id)->where('yr_month', $yrmonth)->get()->toArray();



       $ordersum = DB::table('orders')->select(DB::raw('DISTINCT file_type, sum(file_price) as file_price'))->where('bill_dt','>=', $frdt)->where('bill_dt','<=', $todt)->where('company_id','=',
        $company_id)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->GroupBy('file_type')->get();

       //dd($ordersum);

       $isvector = false;

       $dcount =0;

       foreach ($ordersum as $key) {
           if ($key->file_type == 'Vector')
           {
            $isvector = true;
            
           }

            if ($key->file_type == 'Digitizing')
           {
            $isvector = false;
           $dcount =1;
           }
       }

        $orderlist = DB::table('orders')->select('bill_dt', 'order_us_date', 'client_company',  'client_name',
         'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 
         'file_price', 'status')->where('bill_dt','>=', $frdt)->where('bill_dt','<=', $todt)->where('company_id','=',  $company_id)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();

        //dd($orderlist);

  // $invoice = PDF::loadView('invoices.invoicepdf', compact('orderlist' ,'invoiceInfo','pdf'));
 libxml_use_internal_errors(true);
  if ( $dcount == 0)      
  {
       $invoice = \PDF::loadView('invoices.view-sample', compact('orderlist' ,'invoiceInfo', 'clientinfo','pdf', 'ordersum' ,'pfr_dt', 'pto_dt', 'due_dt'));
  }
  else {
     $invoice = \PDF::loadView('invoices.view-sample-d', compact('orderlist' ,'invoiceInfo', 'clientinfo', 'pdf', 'ordersum' ,'pfr_dt', 'pto_dt', 'due_dt'));
  }
 
   //return $pdf->stream();
   //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
  $invoice->setPaper('A4', 'portrait');

  
  libxml_use_internal_errors(false);

  foreach ($clientinfo as $key ) {
    $comp_name =  $key->client_company;
  }

 $newcl =  trim($comp_name);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);


                 $output =   $newcl . $month . $year . '.pdf' ;

  $path = public_path() .'/files/1/' . $yrmonth;
  if (!file_exists($path)) {
    mkdir(public_path() .'/files/1/' . $yrmonth);
}

    $fileName =  $output ;
    $invoice->save( $path .'/'. $fileName);
    //file_put_contents($path, $invoice->output()); 
  // return $invoice->download($fileName);
  // Storage::put('public/pdf/view-sample.pdf', $pdf->output()); 
  // return $invoice->download('view-sample.pdf');

//     header('Content-type: text/plain');
// var_dump($_dompdf_warnings);
// die();
   return $invoice->stream();

}


public function InvoiceDigitPrint()
{
 
  $pdf = app('dompdf.wrapper');
  $invoice = new Dompdf();
 // $pdf='';
    $invoiceInfo =[];
   
    $invoiceInfo =DB::table('clients')->select('client_company', 'phone', 'client_address1',
      'client_state', 'website', 'client_country')->where('company_id','=', 'CO2019021573')->get()->toArray();

        $orderlist = DB::table('orders')->select('bill_dt', 'order_us_date', 'client_company',  'client_name',
         'client_email_primary', 'order_id', 'file_type', 'file_name', 'file_count', 'stiches_count', 
         'file_price', 'status')->where('bill_dt','>=', '2021-01-01')->where('bill_dt','<=', '2021-05-31')->where('company_id','=', 'CO2019021573')->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->orderByRaw('file_type DESC, client_name ASC')->get()->toArray();

       // dd($orderlist);

  // $invoice = PDF::loadView('invoices.invoicepdf', compact('orderlist' ,'invoiceInfo','pdf'));
  $invoice = \PDF::loadView('invoices.view-sample-d', compact('orderlist' ,'invoiceInfo','pdf'));
   //return $pdf->stream();
  $invoice->setPaper('A4', 'portrait');
    return $invoice->stream();

}


public function InvoicePay(Request $request)
{

  
   $year =  (int)substr($request->yr_month, 0,4);

    $month =  (int)substr($request->yr_month, 4,2);
     
     $month = str_pad($month,  2 ,'0', STR_PAD_LEFT);

     $company_id =  $request->company_id;



     $invpay =  InvoiceSummary::where('company_id','=',$company_id)->where('yr_month',$request->yr_month)->get();


     foreach ($invpay as $key ) {
       $inv_amt =  $key->inv_amount;
        $status  =  $key->status;
     }

    

     if ($status == null)
     {

        InvoiceSummary::where('company_id','=',$company_id)->where('yr_month',$request->yr_month)->update(['status'=>'Paid', 'amt_paid_usd'=>$inv_amt]);
     }
     else {
                 InvoiceSummary::where('company_id','=',$company_id)->where('yr_month',$request->yr_month)->update(['status'=>'UnPaid', 'amt_paid_usd'=>0]);
     }

     return Redirect::back();
}

public function InvoiceSendEmail(Request $request)
{
   
   $year =  (int)substr($request->yr_month, 0,4);

    $month =  (int)substr($request->yr_month, 4,2);
     
     $month = str_pad($month,  2 ,'0', STR_PAD_LEFT);

     $company_id =  $request->company_id;
    //dd($year.$month);

   $emaillist = DB::table('orders')->select('client_email_primary', 'client_company')->where('company_id','=',  $company_id)->whereYear('bill_dt','=', $year)->whereMonth('bill_dt','=', $month)->distinct()->get();
  // dd($emaillist);cie
    $company_name = '';
   foreach($emaillist as $key)
   {
    $company_name = $key->client_company;
   }

   $fileurl =  DB::table('invoice_summary')->where('company_id','=',  $company_id)->where('yr_month','=', $year.$month)->select('file_url')->get();

   //dd($fileurl);

  return view('invoices.email', compact('emaillist', 'fileurl', 'company_name', 'company_id', 'year', 'month'));

}


public function StoreSendEmail(Request $request)
{
      //dd($request->all());

        $this->validate($request, [

          
            'toemail' => 'required',
         
        ]);

       $year = $request->year;

    $month =  $request->month;
     
     $month = str_pad($month,  2 ,'0', STR_PAD_LEFT);

     $toemail = implode(',', $request->toemail);
          
       //   dd($toemail);    

     $toemail =  array('php@patternsindia.com');

     $frusernm = 'hello@patternsindia.com';

     $tousernm = $request->company_name;

     $subject=  'INVOICE';

     $fileurl = $request->fileurl;



        Mail::send('emails.sample', ['toemail' => $toemail, 'frusernm' =>$frusernm, 'tousernm'=>$tousernm, 'subject'=>$subject ,'year'=>$year, 
          'month'=>$month , 'fileurl'=> $fileurl], function ($m) use ($frusernm, $toemail, $tousernm, $subject , $year, $month , $fileurl) {

            $rurl = public_path() . '/img/Regular.jpg' ;

             $rurl = public_path() . '/' .$year.$month .'/' . $fileurl ;
           
            
            //$m->from('tallin@patternsindia.com', $frusernm);
            $m->from('hello@patterns247.com', $frusernm);
            //$m->to($user->email, $user->name)->subject('Your Reminder!');
            $m->to($toemail, $tousernm )->subject($subject);
            $m->attach($rurl);
            //$m->attach($othurl);

            
        });

         if (Mail::failures()) {
             Session::flash("message","Email not sent and has errors");
             $response = array(
                    'status' => 'errors',
                    'msg' => 'Errors in Email'

                  );
              //return response()->json([$response]);
            //return Redirect::back();
          }
         else {
               
            //   EmailMessage::find($msg->id)->update(['send' => 'Y']);
            $response = array(
                    'status' => 'success',
                    'msg' => 'Email Sent Successfully'

                  );
               
             Session::flash("message","Email sent successfully");
              //return response()->json([$response]);
               // return Redirect::back();
         }
 return Redirect::back();
 // dd($request->all());
}


public function UpdateEmailStatus(Request $request)
    {
        //$user = User::findOrFail($id);
        //http_response_code(500);
        //dd("hello");
        //dd($request->all());
        //dd($request->id);
        //return Redirect::back();

        //dd($request->id);
    
       
        $email=EmailMessage::find($request->id);

        $toemail  = $email->toemail;
        $frusernm = $email->frusernm;
        $tousernm = $email->tousernm;
        $subject  = $email->subject;

        //$request["user_id"] =  Auth::user()->id ;
        //$request["message"] = "";
       // $request["send"]  = "Y" ;
            //$msg = EmailMessage::create($request->all());
        //http_response_code(500);
       // dd($msg->id); 
        
        Session::flash("message","Email sent Successfully");
        
        $email->update(["send" => 'Y']);

       
        Mail::send('emails.sample', ['toemail' => $toemail, 'frusernm' =>$frusernm, 'tousernm'=>$tousernm, 'subject'=>$subject ], function ($m) use ($frusernm, $toemail, $tousernm, $subject) {

            $rurl = public_path() . '/img/Regular.jpg' ;
           
            
            //$m->from('tallin@patternsindia.com', $frusernm);
            $m->from('hello@patterns247.com', $frusernm);
            //$m->to($user->email, $user->name)->subject('Your Reminder!');
            $m->to($toemail, $tousernm )->subject($subject);
            $m->attach($rurl);
            //$m->attach($othurl);

            
        });

         if (Mail::failures()) {
             Session::flash("message","Email not sent and has errors");
             $response = array(
                    'status' => 'errors',
                    'msg' => 'Errors in Email'

                  );
              return response()->json([$response]);
            //return Redirect::back();
          }
         else {
               
            //   EmailMessage::find($msg->id)->update(['send' => 'Y']);
            $response = array(
                    'status' => 'success',
                    'msg' => 'Email Sent Successfully'

                  );
               
             Session::flash("message","Email sent successfully");
              return response()->json([$response]);
            //return view('emails.index');
         }

    }



}