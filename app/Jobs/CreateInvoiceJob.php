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

use App\Models\JobInvoice;


class CreateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $orderlist; 
     public $invoiceInfo; 
     public $clientinfo;
     public $ordersum;
     public $pfr_dt;
     public $pto_dt;
     public $due_dt;
     public $dcount;
     public $output;
     public $path;
     public $userid;
     public $user_dtl;
     public $username;
     public $selectall;
     public $yearmonth;
     public $company_fired;
    

     

    public function __construct($dcount, $orderlist , $invoiceInfo, $clientinfo, $ordersum, $pfr_dt, $pto_dt, $due_dt , $output, $path, $userid, $user_dtl, $username,$selectall, $yearmonth,
     $company_fired )
    {
          $this->orderlist =  $orderlist;
          $this->invoiceInfo = $invoiceInfo;
          $this->clientinfo = $clientinfo;
        
          $this->pfr_dt  =  $pfr_dt;
          $this->pto_dt  = $pto_dt;
          $this->due_dt =  $due_dt ;
          $this->dcount = $dcount;
             $this->ordersum  = $ordersum;
             $this->output = $output;
             $this->path= $path;
             $this->userid= $userid;
             $this->user_dtl = $user_dtl;
             $this->username = $username;
             $this->selectall = $selectall;
             $this->yearmonth = $yearmonth;
             $this->company_fired = $company_fired;
          
          // \Log::info($ordersum);
  

    }

//     public function failed(Exception $exception)
// {
   
//        Log::info($exception->getMessage());
// }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      

        $orderlist =  $this->orderlist;
        $invoiceInfo = $this->invoiceInfo;
        $clientinfo = $this->clientinfo;
        $ordersum = $this->ordersum;
        $pfr_dt  = $this->pfr_dt;
        $pto_dt = $this->pto_dt;
        $due_dt = $this->due_dt;
        $dcount = $this->dcount;
        $output = $this->output;
        $path  =  $this->path;
        $userid = $this->userid;
        $user_dtl = $this->user_dtl;

      
         $username =  $this->username;
         $selectall = $this->selectall;
         $company_fired = $this->company_fired;

         if ($selectall == 1)
          {
            $selectall = 'All Company Selected';
          }
          else
          {
            $selectall = 'Individual Company Selected';
          }

          $yearmonth =  $this->yearmonth;
       

         $pdf = '';
         $invoice = '';

        $jobid =   $this->job->getJobId();

        echo $this->job->getJobId();

       
          JobInvoice::create(['userid'=>$userid, 'username'=>$username, 'company_fired'=>$company_fired,'selectall'=>$selectall ,'year_month' =>$yearmonth, 'jobid'=>$jobid, 'status'=>'Under Process']);

         sleep(10);

        libxml_use_internal_errors(true);

        $totrecords = 0;
        $totrecords = count($orderlist);

  
         if ( $dcount == 0)      
          {
              $invoice = \PDF::loadView('invoices.view-sample', compact('orderlist' ,'invoiceInfo', 'clientinfo', 'ordersum', 'pfr_dt', 'pto_dt', 'due_dt'));
         }
         else {
              $invoice = \PDF::loadView('invoices.view-sample-d', compact('orderlist' ,'invoiceInfo', 'clientinfo',  'ordersum', 'pfr_dt', 'pto_dt', 'due_dt'));
        }
 
        // sleep(2);
          //return $pdf->stream();
         libxml_use_internal_errors(false);

           $invoice->setPaper('A4', 'portrait');

 
           $fileName =  $output ;
            $invoice->save( $path .'/'. $fileName);

           clearstatcache();
       
           unset($invoice);
           unset($pdf);
            
           \Artisan::call('cache:clear');
       \Artisan::call('view:clear');
            
            if ($totrecords > 30)
            {
               sleep(10);
            }
           
            sleep(5);
   
      }

          
       
    
}
