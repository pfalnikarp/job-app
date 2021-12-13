<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
// use Dompdf\Dompdf ;
use PDF;
 use Storage;
 use Session;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CreateInvoiceJob120621 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $pyear; 
     public $pmonth; 
     public $pbutton;
     public $orderzones;
  
     


    public function __construct($pyear, $pmonth, $pbutton, $orderzones )
    {
        $this->pyear = $pyear;
         $this->pmonth = $pmonth;
          $this->pbutton = $pbutton;
          $this->orderzones = $orderzones;

                


    }

    public function failed(Exception $exception)
{
   
       Log::info($exception->getMessage());
}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      

       

  // $pdf = app('dompdf.wrapper');
  // $invoice = new Dompdf();

  $pbutton =  $this->pbutton;
  $pyear=   $this->pyear ;
   $pmonth =      $this->pmonth ;
   $orderzones =  $this->orderzones;

   if ($pbutton == '1' ||  $pbutton== '2') 
   { //  for  new records

                           
            if ($pbutton == '2') {

                

                         DB::table('invoice_summary')
            ->where('yr_month', '=' , $pyear.$pmonth)
             // ->where('company_id'  , '>=', 'CO2020100743')
            //->where('company_id'  , '<=', 'CO2020100743')
            ->whereIn('company_id', $orderzones)
                            ->delete();

              DB::table('invoice')
               //->where('company_id'  , '>=', 'CO2020100743')
              ->whereIn('company_id', $orderzones)
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
                            where delete_flag = 'N'
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
            // ->where('company_id'  , '>=', 'CO2020100743')
            //->where('company_id'  , '<=', 'CO2020100743')
             ->whereIn('company_id', $orderzones)
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

        $invoice_order['created_by'] = 1;

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
          
          // $psuccess = DB::table('invoice')->insert($insert_data);  temp comment below on 08-06-21
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
           //  ->where('company_id'  , '>=', 'CO2020100743')
           // ->where('company_id'  , '<=', 'CO2020100743')
           ->whereIn('company_id', $orderzones)
                            ->groupBy('company_id', 'client_company')
          ->get();
                // ->toarray() ;DB::raw("(DATE_FORMAT(bill_dt,'%Y%m'))")

          //dd($invoice_copy);

          // date create logic
         $count= 0;

                $folderPath = public_path() ;
                //date creation
                    $new_dt = Carbon::createFromDate($year, $month, null, null);
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

             $path = public_path() .'/' . $yearmonth;
  if (!file_exists($path)) {
    mkdir(public_path() .'/' .$yearmonth);
}


          // date logic

            //dd($createTempTables);
           // dd($invoice_copy);

             
        foreach($invoice_copy->chunk(10) as $chunk ) {
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
                'invoice_dt' => $today_dt,
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

         
  //$pdf = app('dompdf.wrapper');
  //$invoice = new Dompdf();
  $pdf = '';
  $invoice = '';
  sleep(10);

   libxml_use_internal_errors(true);

  if ( $dcount == 0)      
  {
       $invoice = \PDF::loadView('invoices.view-sample', compact('orderlist' ,'invoiceInfo', 'clientinfo','pdf', 'ordersum' ,'pfr_dt', 'pto_dt', 'due_dt'));
  }
  else {
     $invoice = \PDF::loadView('invoices.view-sample-d', compact('orderlist' ,'invoiceInfo', 'clientinfo', 'pdf', 'ordersum', 'pfr_dt', 'pto_dt', 'due_dt'));
  }
 
  sleep(2);
   //return $pdf->stream();
    libxml_use_internal_errors(false);

  $invoice->setPaper('A4', 'portrait');

 
    $fileName =  $output ;
    $invoice->save( $path .'/'. $fileName);

    clearstatcache();
       
            $count++;
           unset($invoice);
           unset($pdf);
            
           
        }
      }

          
       
      
      }

   

    }




}
