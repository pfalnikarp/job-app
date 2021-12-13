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
use Ntrust;
use Carbon\Carbon;
use App\Models\CompanyPaid;

class InvoiceSummaryController extends Controller
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
// public function SummarygetIndex(Request $request = null, $yrmn) changed on  15-nov-18 for
 //public function SummarygetIndex($yrmn) not working with parameters as are stuck in datatables queries

public function SummarygetIndex(Request $request,$id = null)
    {

      $newid = 10;
       $nowdt =  Carbon::now('Asia/Kolkata')->toDateTimeString();
       $nowdt_ymd =  Carbon::now('Asia/Kolkata')->format('Y-m-d');


       $nowdt1 =  Carbon::now()->toDateTimeString();
       $nowdt_ymd1 =  Carbon::now()->format('Y-m-d');


      $user1 = Auth::user()->name;
      //dd($user1);die;
      $user = User::where('name', '=', $user1)->first();


      $roleid = [] ;


        if ($request->ajax()) {
                  return Datatables::of(InvoiceSummary::query())
           ->addColumn('action', function ($user) {

                   $edit= route('invoice-summary.edit',['id'=> $user->id ]);

                   return "<a href='{$edit}' class='glyphicon fa fa-edit' ></a> ";


            })
              ->addColumn('file1', function ($user) {

              return  '<a href="' .$user->yr_month .'/' .$user->file_url.'" > '. $user->file_url .' </a>';

                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;
            })
               ->addColumn('file2', function ($user) {

                   $edit= route('invoice.print',['company_id'=> $user->company_id ,'yr_month'=>$user->yr_month]);

                   return "<a href='{$edit}' class='glyphicon fa fa-edit' ></a> ";


            })
               ->addColumn('sendemail', function ($user) {

                   $edit= route('invoice.sendemail',['company_id'=> $user->company_id ,'yr_month'=>$user->yr_month]);

                   return "<a href='{$edit}' class='glyphicon fa fa-edit' ></a> ";


            })
            //       ->addColumn('status', function ($user) {

            //        $pay= route('invoice.pay',['company_id'=> $user->company_id ,'yr_month'=>$user->yr_month]);

            //        if ($user->status=='Paid'){
            //               return "<a href='{$pay}' class='fa fa-paypal' ><img class='paidclass' src='img/paid.jpg' id ='pimg'></a> ";
            //        }
            //        else {
            //              return "<a href='{$pay}'  ><img class='paidclass' src='img/unpaid.jpg' id ='pimg'></a> ";
            //        }



            // })

                           ->addColumn('addpay', function ($user) {

                   $pay= route('invoices-summary.addpay',['id'=> $user->id ]);


                          return "<a href='{$pay}' class='fa fa-plus' ></a> ";


            })
            ->escapeColumns([])
            ->make(true);


          }
          else {

                return view('invoices_summary.index',compact('id'));

          }




    }


public function SummarygetIndex1(Request $request)
{



   if ($request->ajax()) {
        $query = DB::table('invoice_summary')->select('yr_month', DB::raw(' count(*) as tot_inv, sum(inv_amount) as tot_inv_amt, sum(amt_paid_usd) as tot_rec, sum(net_amt) as pend_amt'))->groupBy('yr_month');



     //   dd($query);


      return Datatables::of($query)
            ->addColumn('yrmon', function ($user) {

              return  '<a href="invoice-summary"</a>';

                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;
            })

             ->escapeColumns([])
            ->make(true);

      }
      else {

             return view('invoices_summary.index2');
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

          dd('ok admin');die;

         return Datatables::of(Invoice::query())
          ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status])->render();
              })
            ->addColumn('action', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                // return  view('partials.datatablesorders', ['id' => $user->id])->render();

                    return  view('partials.invoicecheckbox', ['id' => $user->id, 'status' => $user->status, ])->render();

                      return  view('partials.datatablesinvoicesummary', ['id' => $user->id, 'status' => $user->status, ])->render();
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
        // dd('ok');die;
      return Datatables::of(InvoiceSummary::query())
           ->addColumn('action', function ($user) {

          //  return  view('partials.datatablesinvoicesummary', ['id' => $user->id, 'status' => $user->status])->render();



           $edit= route('invoice-summary.edit',['id'=> $user->id ]);

           return "<a href='{$edit}' class='glyphicon fa fa-edit' ></a> ";


            })
            ->escapeColumns([])
            ->make(true);


   }


 public function SummaryanyData1()
    {
       // return Datatables::of(Customer::query())->make(true);
        // dd('ok');die;
        $query = DB::table('invoice_summary')->select('yr_month', DB::raw(' count(*) as tot_inv, sum(inv_amount) as tot_inv_amt, sum(amt_paid_usd) as tot_rec, sum(net_amt) as pend_amt'))->groupBy('yr_month')->get();



     //   dd($query);


      return Datatables::of($query)
            ->addColumn('yrmon', function ($user) {

              return  '<a href="invoice-summary/'.$user->yr_month.'" > '. $user->yr_month .' </a>';

                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;
            })
             ->escapeColumns([])
            ->make(true);


   }


public  function editdtl($id)
{
       //dd($id);
      $summary = InvoiceSummary::find($id);

      $sum1  =  array( 'id'=> $summary->id,  'client_company' =>$summary->client_company , 'yr_month' => $summary->yr_month,
        'inv_amount' => $summary->inv_amount,
        'paid_amt' => $summary->paid_amt,
        'out_amt' => $summary->out_amt,
        'bank_charges' => $summary->bank_charges,
        'paid_dt' => $summary->paid_dt );

      //dd($sum1);
      return response()->json([$sum1]);
       // return view('pages.invoice-summary.modals.edit.edit-invoice-summary' , compact('summary'));


}


public function AddPay(Request $request, $id)
{



      $invoice =  InvoiceSummary::find($id);


       $invoice_no = $invoice->invoice_no;
       $company_id = $invoice->company_id;
       $inv_amount =  $invoice->inv_amount;
       $discount   = $invoice->discount;
       $inv_paidamt = $invoice->amt_paid_usd;

  // dd($invoice);
  //validation


       $diffamt = $inv_amount- $discount- $inv_paidamt;

       if ($diffamt - $request['amt_paid_usd'] < 0)
       {

           return back()->withErrors(['errors' => ['Invalid Amount Paid']])->withInput();
       }

   //validation above


  $result = DB::transaction(function() use ($request, $id) {
   try {


  $input = $request->all();

  $input['amt_received_inr']= floatval($request->amt_received_inr);

  $amt_paid_usd = $request->amt_paid_usd;

  //dd($input);

  $invoice =  InvoiceSummary::where('id', $input['id'])->get();

  foreach ($invoice as $key ) {
       $invoice_no = $key->invoice_no;
       $company_id = $key->company_id;
       $inv_amount =  $key->inv_amount;
       $discount   = $key->discount;
       $inv_paidamt = $key->amt_paid_usd;

  }

    $netamt  =  $inv_amount - $discount;
 $diffamt = $inv_amount- $discount- $inv_paidamt;

 //dd($diffamt);

  $maxorderid = DB::table('company_paid')->max('id');


//  dd($maxorderid);

       if( is_null($maxorderid)) {
          $max_id = 0;

         }
        else
            {
                    $max_id = $maxorderid;
                    $max_id = substr($max_id, -4);
            }


           $max_id = (int)($max_id + 1) ;


           $input['tran_id'] = 'PY' .  str_pad($max_id, 4, "0", STR_PAD_LEFT);

           $input['payment_date'] = Carbon::parse($input['payment_date'])->format('Y-m-d');

           $invoices='';




         $input['invoices']=  $invoice_no ;
         $input['company_id']  = $company_id;



     //  dd($input);

       CompanyPaid::create($input);


       //dd($amtpaid1->amt_paid_usd);
      // dd($diffamt);

         DB::table('invoice_summary')->where('id', $id)->update(['amt_paid_usd'=> $inv_paidamt +
          $amt_paid_usd , 'net_amt'=> $netamt ]);

   }
    catch (Exception $e) {
      DB::rollBack();
      Redirect::back()->withErrors(['errors' => $e->getMessage()]);
      // echo 'Caught //exception: ',  $e->getMessage(), "\n";
}


}); // result output


       return redirect()->action('InvoiceSummaryController@SummarygetIndex', ['newid'=>$id]);

}


public function UpdatePay(Request $request, $id)
{

  $input = $request->all();

  //dd($input);

  $invoice =  InvoiceSummary::where('id', $input['id'])->get();

  foreach ($invoice as $key ) {
       $invoice_no = $key->invoice_no;
       $company_id = $key->company_id;

  }
   // dd($invoice_no);

  $maxorderid = DB::table('company_paid')->max('tran_id');

       if( is_null($maxorderid)) {
          $max_id = 0;

         }
        else
            {
                    $max_id = $maxorderid;
                    $max_id = substr($max_id, -4);
            }

      $max_id = (int)($max_id + 1) ;
      //$new_dt  = $us_time2 ;

      $input['tran_id'] = 'PY' .  str_pad($max_id, 4, "0", STR_PAD_LEFT);

      $ord_id1 =  'PY'  . str_pad($max_id, 4, "0", STR_PAD_LEFT);

      // if(is_array($input['allocation'])) {
      //       $input['allocation'] =  join(',', $input['allocation']);
      //     }
         $input['payment_date'] = Carbon::parse($input['payment_date'])->format('Y-m-d');

        $invoices='';

        // if ($input['pay_option']<>'Direct')
        // {

        //            $invoices = $input['invoices'];


        // if (is_array($invoices)) {
        //      $input['invoices']= implode(',', $invoices);
        // }


        // }




         //dd($input);()
        $amt_paid_usd = 0;

            $amt_paid =  CompanyPaid::where('company_id', '=',  $company_id)->select('amt_paid_usd')->get();

            foreach ($amt_paid as $key ) {
             $amt_paid_usd = $key->amt_paid_usd;
            }

          if ($amt_paid_usd == 0){
                   //   CompanyPaid::where('company_id', '=',  $company_id)->where('invoice_no', '=', $invoice_no)->create([$input]);
          }
          else {
              CompanyPaid::where('company_id', '=',  $company_id)->where('invoice_no', '=', $invoice_no)
           ->update([$input]);

          }


          // DB::table('invoices_summary')->where('id', $request->id)->update([$input]);
      return redirect()->action('InvoiceSummaryController@SummarygetIndex', ['newid'=>$id]);



}

public function UpdateDtls(Request $request, $id)
{
   //dd($request->all());
  $updated_val =  $request->all();

  $remain_amt = $request->net_amt;

 // dd($remain_amt);

  $this->validate($request, [
          //'client_company' => 'bail|alpha_spaces|required|max:255',

          // 'amt_received_inr'    => 'required',
          // 'paid_dt'  => 'required'

    ]);

  //$id = $request->id ;

  // $paid_dt  =  $request->paid_dt;

  // $paid_dt  = date('Y-m-d', strtotime($paid_dt));

  $discount =  $request->discount;


  if ($discount >0 ){
     $netamt  =   ($request->inv_amount - $discount);
  }
  else
  {
    $netamt = $request->inv_amount;
  }



  $updated = array('discount'=> $discount, 'discount_reason'=> $request->discount_reason,
                     'net_amt'=>$netamt);


  // $updated = array('pay_channel'=> $request->pay_channel,'amt_received_inr'=> $request->amt_received_inr,am
  //        'net_amt'=> $remain_amt,'amt_paid_usd'=> $request->amt_paid_usd, 'bank_charges'=>$request->bank_charges,
  //    'conv_rate'=> $request->conv_rate,  'paid_dt'=> $paid_dt, 'tran_id' => $request->tran_id,
  //     'remarks' => $request->remarks);

  DB::table('invoice_summary')->where('id', $id)->update($updated);


  //  PAYMENT SECTION  *************

  $input = $request->all();




  // return view('invoice_summary.index');
  return redirect()->action('InvoiceSummaryController@SummarygetIndex', ['newid'=>$id]);


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
public function edit($id)
      {


            $invoicesummary=InvoiceSummary::find($id);

                  return view('invoices_summary.edit',compact('invoicesummary'));



  }

  public function InvoiceEditPay($id)
      {


            $invoicesummary=InvoiceSummary::find($id);

                  return view('invoices_summary.editpay',compact('invoicesummary'));



  }

   public function InvoiceAddPay($id)
      {


            $invoicesummary=InvoiceSummary::find($id);

                  return view('invoices_summary.addpay',compact('invoicesummary'));



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
            $month[1] = 'JAN';
            $month[2] = 'FEB';
            $month[3] = 'MAR';
            $month[4] = 'APR';
            $month[5] = 'MAY';
            $month[6] = 'JUN';
            $month[7] = 'JUL';
            $month[8] = 'AUG';
            $month[9] = 'SEP';
            $month[10] = 'OCT';
            $month[11] = 'NOV';
            $month[12] = 'DEC';



            return view('reports.invoiceyrmonth', compact('year', 'month' , 'company'));
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


}
