<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use App\Models\ClientDtl;
use App\Models\Order ;
use App\Models\Order_Status ;
use App\Models\Vendor ;
use App\Models\User ;

//use Entrust;
use App\Models\Role;

use App\Models\Permission;
use App\Models\InvoiceSummary;
use Ntrust;

use Carbon\Carbon;

use JasperPHP\JasperPHP as JasperPHP;
use SoapBox\Formatter\Formatter;
use Auth;
use File;
use SSH;
use ZipArchive;
use Jaspersoft\Client\Client as jaspersoft;

class JasperInvoiceController extends Controller {

     public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Display a listing of the user.
         *
         * @return Response
         */
        public function index()
        {

            $yr = Carbon::now();
            $yr = $yr->year;
           
           // $year[0] = $yr;
            for($i=0; $i<10; $i++) {
                $year[$yr] = $yr;
                $yr--;
            }

            //dd($year);die;
            $month[0] = 'JAN';
            $month[1] = 'FEB';
            $month[2] = 'MAR';
            $month[3] = 'APR';
            $month[4] = 'MAY';
            $month[5] = 'JUN';
            $month[6] = 'JUL';
            $month[7] = 'AUG';
            $month[8] = 'SEP';
            $month[9] = 'OCT';
            $month[10] = 'NOV';
            $month[11] = 'DEC';
            
            // $comp_names = DB::table('orders_view')->select('client_creation_id', 'client_company')
            // ->whereYear('order_us_date', $pyear)
            // ->whereMonth('order_us_date', $pmonth)
            // ->where('status','=', 'Completed')
            // ->where('file_price' ,'>', 0)
            // ->orderBy('client_company', 'desc')
                        // ->get();

             $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            }
            

            return view('reports.invoicereport' , compact('year', 'month','status'));
        }


         public function AllocMonthwise()
        {

            $yr = Carbon::now();
            $yr = $yr->year;
           
           // $year[0] = $yr;
            for($i=0; $i<10; $i++) {
                $year[$yr] = $yr;
                $yr--;
            }

            //dd($year);die;
            $month[0] = 'JAN';
            $month[1] = 'FEB';
            $month[2] = 'MAR';
            $month[3] = 'APR';
            $month[4] = 'MAY';
            $month[5] = 'JUN';
            $month[6] = 'JUL';
            $month[7] = 'AUG';
            $month[8] = 'SEP';
            $month[9] = 'OCT';
            $month[10] = 'NOV';
            $month[11] = 'DEC';
            
          
          return view('reports.allocmonthwise' , compact('year', 'month'));

        }


        public function accountadmin()
        {

            $prv_mnth_startdt = new Carbon('first day of last month', 'America/New_York');
            $prv_mnth_enddt   = new Carbon('last day of last month', 'America/New_York');

        //dd($prv_mnth_enddt);

        $prv_startdt  = date_format($prv_mnth_startdt, "Y-m-d");
        $prv_enddt    = date_format($prv_mnth_enddt, "Y-m-d");
        $prv_month    = date_format($prv_mnth_startdt, "M-Y");

        // Get Role as on 27/04/18
            
        $allroles = Auth::user()->roles()->pluck('name');
              
        $rolenm='';
        foreach ($allroles as  $value) {
            # code...
            $rolenm = $rolenm . $value . ',' ;
        }
        //dd(rtrim($rolenm, ','));

        $rolenm =   rtrim($rolenm, ',');
        
        //$rolenm =  implode(",", $rolenm);

        // Get Role as on 27/04/18


        $curr_mnth_startdt =  Carbon::now('America/New_York')->startOfMonth();

        $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');
        $curr_month    = date_format($curr_mnth_startdt, "M-Y");

        //dd($curr_mnthdt);


           // $curr_dt =  date_format($new_date, 'Y-m-d');

            $curr_date    =  Carbon::now('America/New_York') ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');
        


            //dd($start);die;
            //dd($end);die;
                 // Previous month Vector  and Digitizing

            $allocname =  "Unknown" ; 

            //if (Auth::user()->hasRole('Designer') ) {
           
                 $allocname  =  Auth::user()->name ;
                 $allocname  = '%' . $allocname .'%' ;
                 //dd($allocname);die;
           // }
           
            

             $prv_mnth_vector = DB::table('orders')
                 ->select(DB::raw('sum(file_count) as totvect'))
                 ->where('order_us_date', '>=',$prv_startdt)
                 ->where('order_us_date', '<=', $prv_enddt )
                 ->where('status', '=', 'Completed')
                 ->where('file_type', '=', 'Vector')
                 ->where('allocation', 'like',  $allocname)
                 ->get();
              
              $prv_mnth_vector = collect($prv_mnth_vector);

             $prv_mnth_digit = DB::table('orders')
                 ->select(DB::raw('sum(file_count) as totdigit'))
                 ->where('order_us_date', '>=',$prv_startdt)
                 ->where('order_us_date', '<=', $prv_enddt )
                 ->where('status', '=', 'Completed')
                 ->where('file_type', '=', 'Digitizing')
                 ->where('allocation', 'like',  $allocname)
                 ->get();   


             $curr_mnth_vector = DB::table('orders')
                 ->select(DB::raw('sum(file_count) as totvect'))
                 ->where('order_us_date', '>=',$curr_mnthdt)
                 ->where('order_us_date', '<=', $curr_dt )
                 ->where('status', '=', 'Completed')
                 ->where('file_type', '=', 'Vector')
                 ->where('allocation', 'like',  $allocname)
                 ->get();


             $curr_mnth_digit = DB::table('orders')
                 ->select(DB::raw('sum(file_count) as totdigit'))
                 ->where('order_us_date', '>=',$curr_mnthdt)
                 ->where('order_us_date', '<=', $curr_dt )
                 ->where('status', '=', 'Completed')
                 ->where('file_type', '=', 'Digitizing')
                 ->where('allocation', 'like',  $allocname)
                 ->get();        

            
            // foreach($totdigitdata as $key=>$value) {
            //        dd($value);die;
            // }
            // $topclients = DB::table('orders_view')
            //         ->select(DB::raw('DISTINCT client_name, count(*) as totord, sum(file_price) as file_price'))
            //         ->whereNotIn('status',  ['Completed', 'Allotted','Revision','Approved'])
            //         ->where('order_date_time', '>=', $prv_mnth_startdt)
            //         ->where('order_date_time', '<=', $prv_mnth_enddt)
            //         ->groupBy('client_name')->get(); 

                      
        
           //dd($curr_pend_order);
                  $qblank= '';
            $qzero='0';
            $qadmin='admin';
            $qstatus='Completed';
            
            $designer_revenue =[];

            $designer_revenue_curr =[];
            
            
            $query =   DB::table('orders')
                       ->whereRaw("allocation <>  '$qblank'")
                       ->whereRaw("allocation <>  '$qzero'")
                       ->whereRaw("allocation <>  '$qadmin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->select(DB::raw(' client_company as f1, sum(file_price) as f2'))
                       ->whereRaw("bill_dt >= '$prv_startdt'" )
                       ->whereRaw("bill_dt <= '$prv_enddt'")
                       ->whereRaw("file_type = 'Vector'")
                       ->groupBy('client_company')->tosql();



                     //  dd($query);


             $cur_query =   DB::table('orders')
                       ->whereRaw("allocation <>  '$qblank'")
                       ->whereRaw("allocation <>  '$qzero'")
                       ->whereRaw("allocation <>  '$qadmin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->select(DB::raw(' client_company as f1, sum(file_price) as f2'))
                       ->whereRaw("bill_dt >= '$curr_mnth_startdt'" )
                       ->whereRaw("bill_dt <= '$curr_date'")
                       ->whereRaw("file_type = 'Vector'")
                       ->groupBy('client_company')->tosql();


            //dd($query);die; 
            // old condn           ->whereRaw("order_completion_time >= '$prv_startdt'" )
                //       ->whereRaw("order_completion_time <= '$prv_enddt'")
                       


            $topclients = DB::table(DB::raw("($query) as a"))->orderby('f2', 'desc')
                        ->limit(10)->select('f1','f2')->get();

            //dd($topclients);
            
            $topclients_curr = DB::table(DB::raw("($cur_query) as a"))->orderby('f2', 'desc')
                        ->limit(10)->select('f1','f2')->get();
           


                          //->pluck('f1','f2');     

            //dd($topclients);die;
            //$topclients =  DB::table('orders_view')
            //             ->select('f1', 'f2')
            //             ->from(DB::raw('(SELECT client_name as f1, sum(file_price) as f2  from orders_view   group by f1') as tb )
            //             ->orderBy('f2', 'desc')
            //             ->limit(10)->get();


            //dd($topclients);
           

            $query1 =   DB::table('orders')
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->whereRaw("file_type = 'Vector'")
                       ->select(DB::raw(' client_company as f1, sum(file_count) as f2'))
                       ->whereRaw("bill_dt >= '$prv_startdt'" )
                       ->whereRaw("bill_dt <= '$prv_enddt'")                   
                       ->groupBy('client_company')->tosql();

            //dd($query);die;                      

            $topclientsfilecount = DB::table(DB::raw("($query1) as a"))->orderby('f2', 'desc')
                        ->limit(10)->select('f1','f2')->get();     


             $query1 =   DB::table('orders')
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                        ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                      ->whereRaw("file_type = 'Vector'")
                       ->select(DB::raw(' client_company as f1, sum(file_count) as f2'))
                       ->whereRaw("bill_dt >= '$curr_mnth_startdt'" )
                       ->whereRaw("bill_dt <= '$curr_date'")                   
                       ->groupBy('client_company')->tosql();

            //dd($query);die;                      

            $topclientsfilecount_curr = DB::table(DB::raw("($query1) as a"))->orderby('f2', 'desc')
                        ->limit(10)->select('f1','f2')->get();         
                


            $designer_revenue_query =   DB::table('orders')
                       ->select(DB::raw(' allocation as f1, sum(file_price) as f2'))
                       ->whereRaw("order_us_date >= '$prv_startdt'" )
                       ->whereRaw("order_us_date<= '$prv_enddt'")
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("alloc_id not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->whereRaw("file_type = 'Vector'")
                       ->groupBy('allocation')->get();

            //dd($designer_revenue_query);
             foreach($designer_revenue_query as $value)           
             {
                   $alloc =  explode(',', $value->f1);
                   //dd($alloc);
                   $cnt =  count($alloc);
                   //dd(count($alloc));
                   if ($cnt > 1) {
                       //dd($alloc);
                       $revenue =  ($value->f2)/count($alloc) ;
                       foreach($alloc as $a) {
                            // dd($a);
                            $designer_revenue[] =  array('designer' => (string)$a, 'revenue' =>$revenue );
                       }
                       // dd($designer_revenue);

                   }
                   else {
                        $revenue =   $value->f2 ;
                         $designer_revenue[] =  array('designer' => (string)implode('' ,$alloc), 'revenue' =>$revenue );
                   }

                   
                  
             }    
            
            //dd($designer_revenue);
            
            $design = [];
            foreach($designer_revenue as $val)
            {
                // dd($val['designer']);
                //dd($val);
               if ($val['designer'] <> "")
                {
                $design[] =   $val['designer'];
                }
                //$design[$val['designer']] =   $val['revenue'] ;
                //dd($design);
            }

            $designer = array_unique($design);
            //dd($designer);
            
            $newdesign = [];

            foreach($designer as $dd)
            {
                $revenue = 0 ;
                foreach($designer_revenue as $val)
                {        
                      
                      if ( $val['designer'] == $dd) {
                           $revenue =  $revenue + $val['revenue'] ;
                           $newdesign[$val['designer']] = $revenue ;
                      }

                }


            }
            
        //  file  count
          $designer_filecount = [];

          if (count($newdesign)> 1)  
              arsort($newdesign);
           // dd($newdesign);  Designer Revenue Finish

            //  Designer files count start

               $designer_count_query =   DB::table('orders')
                       ->select(DB::raw(' allocation as f1, sum(file_count) as f2'))
                       ->whereRaw("bill_dt >= '$prv_startdt'" )
                       ->whereRaw("bill_dt <= '$prv_enddt'")
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("alloc_id not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->where('file_type', '=', 'Vector')
                       ->groupBy('allocation')->get();

            //dd($designer_revenue_query);
             foreach($designer_count_query as $value)           
             {
                   $alloc =  explode(',', $value->f1);
                   //dd($alloc);
                   $cnt =  count($alloc);
                   //dd(count($alloc));
                   if ($cnt > 1) {
                       //dd($alloc);
                       $filecount =  ($value->f2)/count($alloc) ;
                       $filecount = round($filecount, 2);
                      // $filecount = 1;  removed on 31/08/17
                       foreach($alloc as $a) {
                            // dd($a);
                            $designer_filecount[] =  array('designer' => (string)$a, 'filecount' =>$filecount );
                       }
                       // dd($designer_revenue);

                   }
                   else {
                        $filecount =   $value->f2 ;
                         $designer_filecount[] =  array('designer' => (string)implode('' ,$alloc), 'filecount' =>$filecount );
                   }

                   
                  
             }   

            $designf = [];
            $newdesignf = [];

            foreach($designer_filecount as $val)
            {
                // dd($val['designer']);
                //dd($val);
                if ($val['designer'] <> "")
                {
                  $designf[] =   $val['designer'];
                }
                //$design[$val['designer']] =   $val['revenue'] ;
                //dd($design);
            }
           

            //dd($designf);

            $designerf = array_unique($designf);
            //dd($designer);
       
            foreach($designerf as $dd)
            {
                $filecount = 0 ;
                foreach($designer_filecount as $val)
                {        
                      
                      if ( $val['designer'] == $dd) {
                           $filecount =  $filecount + $val['filecount'] ;
                           $newdesignf[$val['designer']] = $filecount ;
                      }

                }


            }
            
        arsort($newdesignf);

 
        //  current designer  data
         $designer_revenue_query_c =   DB::table('orders')
                       ->select(DB::raw(' allocation as f1, sum(file_price) as f2'))
                       ->whereRaw("bill_dt >= '$curr_mnth_startdt'" )
                       ->whereRaw("bill_dt <= '$curr_date'")
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("alloc_id not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->whereRaw("file_type = 'Vector'")
                       ->groupBy('allocation')->get();


             //dd($designer_revenue_query);
              $designer_revenue_c = array();
             foreach($designer_revenue_query_c as $value)           
             {
                   $alloc =  explode(',', $value->f1);
                   //dd($alloc);
                   $cnt =  count($alloc);
                   //dd(count($alloc));
                   if ($cnt > 1) {
                       //dd($alloc);
                       $revenue =  ($value->f2)/count($alloc) ;
                       foreach($alloc as $a) {
                            // dd($a);
                            $designer_revenue_c[] =  array('designer' => (string)$a, 'revenue' =>$revenue );
                       }
                       // dd($designer_revenue);

                   }
                   else {
                        $revenue =   $value->f2 ;
                         $designer_revenue_c[] =  array('designer' => (string)implode('' ,$alloc), 'revenue' =>$revenue );
                   }

                   
                  
             }    
            
            //dd($designer_revenue);
            
            $design_c = [];
            foreach($designer_revenue_c as $val)
            {
                // dd($val['designer']);
                //dd($val);
               if ($val['designer'] <> "")
                {
                $design_c[] =   $val['designer'];
                }
                //$design[$val['designer']] =   $val['revenue'] ;
                //dd($design);
            }

            $designer_c = array_unique($design_c);
            //dd($designer);
            
            $newdesign_c = [];

            foreach($designer_c as $dd)
            {
                $revenue = 0 ;
                foreach($designer_revenue_c as $val)
                {        
                      
                      if ( $val['designer'] == $dd) {
                           $revenue =  $revenue + $val['revenue'] ;
                           $newdesign_c[$val['designer']] = $revenue ;
                      }

                }


            }
                      
            ///  current designer file count

           $designer_filecount_c = [];

          if (count($newdesign_c)> 1)  
              arsort($newdesign_c);
           // dd($newdesign);  Designer Revenue Finish

            //  Designer files count start

               $designer_count_query_c =   DB::table('orders')
                       ->select(DB::raw(' allocation as f1, sum(file_count) as f2'))
                       ->whereRaw("bill_dt >= '$curr_mnth_startdt'" )
                       ->whereRaw("bill_dt <= '$curr_date'")
                       ->whereRaw("allocation <> ''")
                       ->whereRaw("allocation not like  '%0%'")
                       ->whereRaw("alloc_id not like  '%0%'")
                       ->whereRaw("allocation <> 'admin'")
                       ->whereRaw("status in ('Completed','Rev-Completed','Ch-Completed')")
                       ->where('file_type', '=', 'Vector')
                       ->groupBy('allocation')->get();

            //dd($designer_revenue_query);
             foreach($designer_count_query_c as $value)           
             {
                   $alloc =  explode(',', $value->f1);
                   //dd($alloc);
                   $cnt =  count($alloc);
                   //dd(count($alloc));
                   if ($cnt > 1) {
                       //dd($alloc);
                       $filecount =  ($value->f2)/count($alloc) ;
                       $filecount = round($filecount, 2);
                      // $filecount = 1;  removed on 31/08/17
                       foreach($alloc as $a) {
                            // dd($a);
                            $designer_filecount_c[] =  array('designer' => (string)$a, 'filecount' =>$filecount );
                       }
                       // dd($designer_revenue);

                   }
                   else {
                        $filecount =   $value->f2 ;
                         $designer_filecount_c[] =  array('designer' => (string)implode('' ,$alloc), 'filecount' =>$filecount );
                   }

                   
                  
             }   

            $designf_c = [];
            $newdesignf_c = [];

            foreach($designer_filecount_c as $val)
            {
                // dd($val['designer']);
                //dd($val);
                if ($val['designer'] <> "")
                {
                  $designf_c[] =   $val['designer'];
                }
                //$design[$val['designer']] =   $val['revenue'] ;
                //dd($design);
            }
           

            //dd($designf);

            $designerf = array_unique($designf_c);
            //dd($designer);
       
            foreach($designerf as $dd)
            {
                $filecount = 0 ;
                foreach($designer_filecount_c as $val)
                {        
                      
                      if ( $val['designer'] == $dd) {
                           $filecount =  $filecount + $val['filecount'] ;
                           $newdesignf_c[$val['designer']] = $filecount ;
                      }

                }


            }
            
        arsort($newdesignf_c);


        return view('reports.dashboardpage' , compact('prv_mnth_vector', 'prv_mnth_digit' , 'curr_mnth_vector' ,  'curr_mnth_digit', 'topclients' , 'topclientsfilecount' ,  'topclients_curr' , 'topclientsfilecount_curr' ,'prv_month', 'curr_month', 'newdesign', 'newdesign_c', 'newdesignf' ,  'newdesignf_c', 'rolenm', 'curr_date'));
           
        }

        public function CheckBoxInv()
        {
            $yr = Carbon::now();
            $yr = $yr->year;
            //$mon = $yr->m;
            $mon = Carbon::now()->format('m');

           // dd($mon);         
           
           // $year[0] = $yr;
            for($i=0; $i<10; $i++) {
                $year[$yr] = $yr;
                $yr--;
            }

            //dd($year);die;
            $month[0] = 'JAN';
            $month[1] = 'FEB';
            $month[2] = 'MAR';
            $month[3] = 'APR';
            $month[4] = 'MAY';
            $month[5] = 'JUN';
            $month[6] = 'JUL';
            $month[7] = 'AUG';
            $month[8] = 'SEP';
            $month[9] = 'OCT';
            $month[10] = 'NOV';
            $month[11] = 'DEC'; 

             $comp = DB::table('orders')->select( 'client_company' )
            ->whereYear('order_us_date', $yr)
            ->whereMonth('order_us_date', $mon)
            //->where('status','=', 'Completed')
            ->where('file_price' ,'>', 0)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            ->get();

            $comp = collect($comp);
            $company = array();
            foreach($comp as $c) {
                $company[]= (string)$c->client_company ;
            }

            $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            }

           //dd($status);

            return view('reports.checkboxinvoice', compact('year', 'month' ,  'company', 'status'));
        }

         public function CheckBoxInv_daterange()
        {
           $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            }

           //dd($status);

            return view('reports.checkboxinvoice_daterange', compact( 'status'));

        }
    
    // NEW VECTOR CORECION L
         public function Invoice_Date_Mc()
        {
           $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            }

           //dd($status);

            return view('reports.multicomp_invoice', compact( 'status'));

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
            $month[0] = 'JAN';
            $month[1] = 'FEB';
            $month[2] = 'MAR';
            $month[3] = 'APR';
            $month[4] = 'MAY';
            $month[5] = 'JUN';
            $month[6] = 'JUL';
            $month[7] = 'AUG';
            $month[8] = 'SEP';
            $month[9] = 'OCT';
            $month[10] = 'NOV';
            $month[11] = 'DEC';



            return view('reports.invoiceyrmonth', compact('year', 'month' , 'company'));
        }

         public function selectorder(Request $request)
        {

           //dd($request->all());
           $year = $request->pyear ;
           $month = $request->pmonth ;
            //dd("hello");die;
           //    $yr = Carbon::now();
           //  $yr = $yr->year;
           
           // // $year[0] = $yr;
           //  for($i=0; $i<10; $i++) {
           //      $year[$yr] = $yr;
           //      $yr--;
           //  }

           //  //dd($year);die;
           //  $month[0] = 'JAN';
           //  $month[1] = 'FEB';
           //  $month[2] = 'MAR';
           //  $month[3] = 'APR';
           //  $month[4] = 'MAY';
           //  $month[5] = 'JUN';
           //  $month[6] = 'JUL';
           //  $month[7] = 'AUG';
           //  $month[8] = 'SEP';
           //  $month[9] = 'OCT';
           //  $month[10] = 'NOV';
           //  $month[11] = 'DEC';

            return view('reports.selectorder', compact('year', 'month'));
        }

          public function istatus()
        {
            //dd("hello");die;
            return view('reports.istatus');
        }

       public function ostatus()
        {
            //dd("hello");die;
            return view('reports.ostatus');
        }


       public function dtlstatus()
        {
            //dd("hello");die;
            return view('reports.dtlstatus');
        }

       public function newclientlist()
        {
            //dd("hello");die;
            return view('reports.clientlist');
        }


       

          public function orderdaterange()
        {
            //dd("hello");die;
            return view('reports.orderrangereport');
        }


        public function AllReport()
        {
            //dd("hello");die;
            $orders = DB::table('orders')
                ->select(DB::raw('DATE_FORMAT(order_us_date, "%Y%m") as yrmonth'))
                 ->where('order_us_date', '>=', '2017-10-01')
                 ->where('status', '=', 'Completed')
                 //->where('file_type', '=', 'Vector')
                ->groupBy('yrmonth')
                ->get();

            $orders = collect($orders)    ;
            //dd($orders);

            $i=0; $j=0;
            $orders1[0]["name"] = "Month" ;
            $orders2[1]["name"] = "Vector" ;
            $orders3[2]["name"] = "Digitizing" ;
            $orders4 = array();

            $category[0]["name"] = "Month" ;
            $series1[1]["name"] = "Vector" ;
            $series2[2]["name"] = "Digitizing" ;


         
            foreach ($orders as $value) {
              $orders1[$j]["data"] = $value->yrmonth ;
              $r['month']   =   $value->yrmonth ;
              $category['data'][] =   $r['month'] ;

              $cat =   $value->yrmonth ;
              $yr  =   substr($cat,0,4);
              $mn  =   substr($cat,4);
              
             
                         $o1 = DB::table('orders')
                            ->select(DB::raw('sum(file_price) as fileprice'))
                            ->whereYear('order_us_date', '=', $yr)
                            ->whereMonth('order_us_date', '=', $mn)
                            ->where('status',    '=', 'Completed')
                            ->where('file_type', '=', 'Vector')
                            ->get();

                  $o1 = collect($o1);

               

                  foreach ($o1 as  $value) {
                    $orders2[$j]["data"] = $value->fileprice ;
                     $r['Vector']       =  $value->fileprice ;
                                 
                  } 
  
                          $o2 = DB::table('orders')
                            ->select(DB::raw('sum(file_price) as fileprice'))
                            ->whereYear('order_us_date', '=', $yr)
                            ->whereMonth('order_us_date', '=', $mn)
                            ->where('status',    '=', 'Completed')
                            ->where('file_type', '=', 'Digitizing')
                            ->get();
                          
                   
                          $o2 = collect($o2); 
                          foreach ($o2 as  $value) {
                                 $orders3[$j]["data"] = $value->fileprice ;
                                  $r['Digitizing']   =  $value->fileprice ;
                                                  
                          }

                          $series1['data'][] = $r['Vector'];
                          $series2['data'][] = $r['Digitizing'];  

                            $o2 = DB::table('orders')
                            ->select(DB::raw('sum(file_price) as fileprice'))
                            ->whereYear('order_us_date', '=', $yr)
                            ->whereMonth('order_us_date', '=', $mn)
                            ->where('status',    '=', 'Completed')
                            ->where('file_type', '=', 'Photoshop')
                            ->get();
                          
                   
                          $o2 = collect($o2); 
                          foreach ($o2 as  $value) {
                                 $orders4[$j]["data"] = $value->fileprice ;
                                  
                                                  
                          }
              

                    
                      $j++;
                 }

                 $orders1 = array_column($orders1, 'data');  
                 $orders2 = array_column($orders2, 'data'); 
                 $orders3 = array_column($orders3, 'data'); 
                 $orders4 = array_column($orders4, 'data');
                // dd($orders1);

           
            return view('allreports.reportmenu')->with('orders1', json_encode($orders1,JSON_NUMERIC_CHECK))
                               ->with('orders2', json_encode($orders2,JSON_NUMERIC_CHECK))
                               ->with('orders3', json_encode($orders3,JSON_NUMERIC_CHECK))
                               ->with('orders4', json_encode($orders4,JSON_NUMERIC_CHECK));
        }

        public function post(Request $request)
        {
            //dd($request->dformat);exit;

         
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Patterns_Invoice';
         
            $ext = "pdf";

            // \JasperPHP::process(
            //     public_path() . '/report/Patterns_Invoice.jasper',
            //     $output,
            //     array($ext),
            //     array(),
            //     array('driver' => 'mysql', 'host' => '127.0.0.1', 'port' => '3306', 'database' => 'patterns', 'username' => 'root', 'password' => ''),
            //     false,
            //     false
            // )->execute();

            //array('driver' => 'mysql', 'host' => '127.0.0.1', 'port' => '3306', 'database' => 'patterns',  'username' => 'root', 'password' => ''),

            $jasper->process(
                public_path() . '/report/Patterns_Invoice.jasper',
                $output,
                array($ext),
                array(),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root'),
                false,
                false
            )->execute();

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }

public function  PrInvComp(Request $request)
{
            //dd($request->all());die;
             if ($request ->has('st')) {
                $stat   =  $request->st ;
            }
            else {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'Status Cannot be Blank, Select Status' );
                //  $request->session()->put('msg', 'Status Cannot be Blank, Select Status');

                return redirect()->back();
            }

            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            // $pcomp  = $request->client_company ;
            // foreach($pcomp as $p) {
            //     $pcompany[] = (string)$p;
            // }
            //dd($pcompany);
             //$P_company_id = implode(',' , $pcompany );

            // $P_company_id = "'" . implode( "','", $pcompany ) . "'" ;

            // $param2  = " and orders.company_id IN" . " (" . $P_company_id . ")";

            $P_status  = "'" . implode( "','", $stat ) . "'" ;
            $param3    = " and orders.status IN" . " (" . $P_status . ")"; 

            $param3   = '"' . $param3 . '"' ;
            $param3   =  stripslashes($param3);

            $pmonth =$pmonth+ 1;


            $mon = $pmonth + 1;
            $new_dt = Carbon::createFromDate($pyear, $pmonth, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth()->format('Y-m-d');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('Y-m-d');
          

            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Patterns_Invoice_CompanyWise';
         
            $ext = "pdf";

                      
            $jasper->process(
                public_path() . '/report/Patterns_Inv_MultiCompanyWise.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,  "Param3" =>  $param3),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();

            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Patterns_Inv_MultiCompanyWise.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

         

}


public function   searchcompany(Request $request)
{
         //  dd($request->all());

            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            $pmonth =$pmonth+ 1;
          //  dd($pyear);die;
            //    $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            // $pto_dt =  str_replace('/', '-', $request->pto_dt);
            // $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            // $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');


    $comp_names = DB::table('orders')->select('company_id', 'client_company' )
            ->whereYear('order_us_date', $pyear)
            ->whereMonth('order_us_date', $pmonth)
            //->where('status','=', 'Completed')
            ->where('file_price' ,'>', 0)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            ->get();

       // $comp_names = collect($comp_names);
          $output ='<select class="form-control clcomp" multiple="multiple" name="client_company[]">';

           foreach ($comp_names as $comp) {
                    # code...
               // dd($comp->company_id);

                // if ( $comp->company_id == 'CO2017070202')
                // {
                //        //dd($comp->company_id);
                // }
                // elseif ( $comp->company_id =='CO2019091866') {
                  
                // }
                // else {
                       $output .= '<option  value='. "'$comp->company_id'". ">" . "$comp->client_company"  .   '</option> ';  
              // }

                

                //     $output .= '<tr>' .'<td>' . $client->id . '</td>' .
                //     '<td>' . $client->client_creation_id . '</td>' .
                // '<td>' . $client->client_name . '</td>' .
                // '<td>' . $client->client_email_primary . '</td>' .
                // // '<td>' . $client->client_email_secondary. '</td>' .
                // '<td>' . $client->client_company . '</td>' .
                // '<td>' . $client->client_note . '</td>' .
                //  '<td>' . $client->company_id . '</td>' 
                // .'</tr>' ;
                }
                $output .= '</select>';
                //dd($output);die;
                return Response($output);



}
 

public function orderreport(Request $request)
        {
             //dd("hello");die;
           // dd($request->all());
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            //$pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d H:i');
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            //$pto_dt = Carbon::parse($pto_dt)->format('Y-m-d H:i');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

            //dd($pfr_dt);


            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            //$output = public_path() . '/report/'.time().'_Daily_Order_Report';
          
           //dd($output);die;
            $ext = "pdf";

         if ($request->dformat == 'Download'){
                 $CsvData=array('Bill Date, Company Name, Client Name, Email, File Type, File Name, Stiches,File Price, Status'); 

               //  dd($CsvData);


        $orderlist = DB::table('orders')->select('bill_dt', 'client_company',  'client_name',
         'client_email_primary',  'file_type', 'file_name', 'stiches_count', 'file_price', 'status')->where('bill_dt','>=', $pfr_dt)->whereIn('orders.status' , ['Completed' , 'Rev-Completed', 'Ch-Completed'])->orderBy('id', 'desc')->get();

       
               $filename=date('Y-m-d').'order-list'.$pfr_dt.'-to-'.$pto_dt.".csv";
       //$filename=date('Y-m-d').'company-who-have-not-order-since'.".csv"; 
       // $file_path=base_path().'/'.$filename;   

        
        foreach ($orderlist as $key) {
                         
                         $CsvData[] =  $key->bill_dt . ','. $key->client_company .','.
  $key->client_name .','.$key->client_email_primary .','.$key->file_type .',' . str_replace(',', ' ' ,$key->file_name) .','. $key->stiches_count .','. $key->file_price .','. $key->status ;

                       }       

                    //   dd($CsvData);  

        $file_path = public_path() . '/report/'. $filename;     

        $file = fopen($file_path,"w+");
        foreach ($CsvData as $exp_data){
          fputcsv($file,explode(',',$exp_data));
        }   
        fclose($file);          
 
        $headers = ['Content-Type' => 'application/csv'];
        return response()->download($file_path,$filename,$headers );

            }     
 
   
 else {
            // dd('hello');
              $output = public_path() . '/report/' .'daily_orders_revenue';
            
            $jasper->process(
                public_path() . '/report/daily_orders_revenue.jasper',
                $output,
                array($ext),
                array("pfr_dt"=>$pfr_dt, "pto_dt"=>$pto_dt),
                //array("PFR_DT"=>"'" .$pfr_dt ."'", "PTO_DT"=>"'" .$pto_dt ."'"),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omsv4', 'username' => 'php', 'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

              //  dd($jasper);die;

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Monthly_Order_Report.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

     }       

  

      if ($request->option1 == '0') {

            $output = public_path() . '/report/' .'Monthly_Order_Report';
            
            $jasper->process(
                public_path() . '/report/Monthly_Order_Report.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>$pfr_dt, "PTO_DT"=>$pto_dt),
                //array("PFR_DT"=>"'" .$pfr_dt ."'", "PTO_DT"=>"'" .$pto_dt ."'"),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omsv4', 'username' => 'php', 'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

           //dd($jasper);die;

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Monthly_Order_Report.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);
          }
          else
             if ($request->option1 == '1')
          {
              $output = public_path() . '/report/' .'Monthly_Order_Report_Approval';
              
              $jasper->process(
                public_path() . '/report/Monthly_Order_Report_Approval.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>"'" .$pfr_dt ."'", "PTO_DT"=>"'" .$pto_dt ."'"),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omsv4', 'username' => 'php', 'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

            //dd($jasper);die;

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Monthly_Order_Report_Approval.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);
          }
      else {
         {
              $output = public_path() . '/report/' .'Monthly_Order_Report_Approval_Us';
              
              $jasper->process(
                public_path() . '/report/Monthly_Order_Report_Approval_Us.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>"'" .$pfr_dt ."'", "PTO_DT"=>"'" .$pto_dt ."'"),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 'database' => 'omsv4_2', 'username' => 'php', 'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

           // dd($jasper);die;

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Monthly_Order_Report_Approval.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);
          }


      }    

        }


         public function printinvoice(Request $request)
        {

            //dd($request->dformat);exit;
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Patterns_Invoice';
         
            $ext = "pdf";

             

          
             $jasper->process(
                public_path() . '/report/Patterns_Invoice.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();
            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }


    public function ReportAllocMonthwise(Request $request)
        {

            //dd($request->dformat);exit;
            $pyear =  $request->pyear;
            $pmonth = $request->pmonth;
           

            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Patterns_Invoice';
         
            $ext = "pdf";

             

          
             $jasper->process(
                public_path() . '/report/main_allocation.jasper',
                $output,
                array($ext),
                array("pyear"=>$pyear,"pmonth"=>$pmonth),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->output();
            dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }



    public function printinvoice_monthly(Request $request)
        {

            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            //dd($pmonth);
            $pmonth =$pmonth+ 1;
            //dd($pyear);die;

            $zip = new ZipArchive();
            
            $mon = $pmonth ;
            $new_dt = Carbon::createFromDate($pyear, $pmonth, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth();
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth();
           

            $mon = str_pad($mon, 2, '0', STR_PAD_LEFT);
            //dd($mon);die;
            $yrmon =  $pyear ."-" . $mon ;

            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereYear('order_us_date', $pyear)
            ->whereMonth('order_us_date', $pmonth)
            ->where('status','=', 'Completed')
            ->where('file_price' ,'>', 0)
            ->orderBy('company_id', 'desc')
            //->limit(4)
            ->get();
             
            // dd($comp_names);die;

            $valid_files=array();

            $comp_names = collect($comp_names);

            foreach($comp_names as $cl) {
                  //dd($cl->client_name);
                 
                    $pcompany_id =  $cl->company_id;
                    $newcl =  substr($cl->client_company,0,10);
              
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                $newcl =  str_replace(' ','_', $newcl);
                // dd($newcl);die;
                 
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                
                
                //$folderPath = public_path() . '/report/' . $yrmon ;
                $folderPath = public_path() . '/' .  $yrmon ;
                //dd($folderPath);
                //mkdir("$folderPath");
                //dd(File::exists($folderPath));
                if(!File::exists($folderPath)) {
                   File::makeDirectory($folderPath);
                   File::makeDirectory($folderPath, $mode = 0777, true, true);
                }

                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
               
                $output =  $folderPath.'/' .  $newcl;
                //dd($output);die;
         
                $ext = "pdf";

  
          
                $jasper->process(
                           public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();
                // dd($jasper);

               
               } 

                //$files = File::allFiles(getcwd());
                 $files = File::allFiles($folderPath .'/');
                   //  foreach ($files as $file)
                    // {
                   //      echo (string)$file, "\n";
                   //  }
                

               $DelFilePath="file1.zip";
               
               $file_path =  $folderPath.'/' ;

               //dd($file_path);
               if(file_exists($file_path.$DelFilePath)) {
                        unlink ($file_path.$DelFilePath);
                    }

                   
                //if not exist then to create zip file
               // dd($file_path . $DelFilePath);
                if ($zip->open($file_path . $DelFilePath, ZipArchive::CREATE) === TRUE) {     
                //if ($zip->open($file_path.$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
                          //  die ("Could not open archive");
              
                //loop on the images/file to add in zip
                   // dd("hello");
               
               foreach (File::files(public_path() . '/' . $yrmon) as $path)
                    {
                         //dd($path);
                        //dd(File::name($path));         // file name (no extension)
                       // dd(File::extension($path));    // file extension
                       
                        // and so on...

                        if (file_exists($path )) {

                           $zip->addFile( $path  , 'new_' . File::name($path) . "." . File::extension($path));
                          // dd("hello");
                        }
                }
               
                // foreach ($files as $file) {

                //            dd($file);
                //         if (file_exists($file )) {

                //            $zip->addFile( $file  , 'new_' . $file );
                //           // dd("hello");
                //         }
                //     }

                   
                    // close and save archive
                    $zip->close();
                  }

                  $headers = array(
                        'Content-Type' => 'application/octet-stream',
                    );
                //opening zip and saving directly on client machine
                if(file_exists($file_path.$DelFilePath)){
                       return response()->download($file_path .$DelFilePath,$DelFilePath,$headers);
                }
               
           
        }


          public function printinvoice_clientwise(Request $request)
        {

            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            $pmonth =$pmonth+ 1;
            //dd($pyear);die;

            
            
            $mon = $pmonth + 1;
            $new_dt = Carbon::createFromDate($pyear, $pmonth, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth();
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth();
           

            $mon = str_pad($mon, 2, '0', STR_PAD_LEFT);
            //dd($mon);die;
            $yrmon =  $pyear ."-" . $mon ;

            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $company_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereYear('order_us_date', $pyear)
            ->whereMonth('order_us_date', $pmonth)
            ->groupBy('company_id', 'desc')
            ->limit(5)
            ->get();
             
             //dd($company_names);die;

            $company_names = collect($company_names);

            foreach($company_names as $cl) {
                  //dd($cl->client_name);
                 $newcl =  substr($cl->client_company,0,10);
                 //dd($newcl);
                 $newcl =  preg_replace('/\s+/', '_', $newcl);
                 // dd($newcl);die;
                 $pcompany_id =  $cl->company_id ;
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                
                
                $folderPath = $yrmon ;
                //$success = File::deleteDirectory($directory);  original syntax
                $success = File::deleteDirectory($folderPath);

                if(!$success)
                {
                    mkdir("$folderPath");
                    File::makeDirectory($folderPath);
                    File::makeDirectory($folderPath, $mode = 0777, true, true);

                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                 //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
                }    
               
                $output =  public_path() . '/'.$folderPath.'/' . $pcompany_id . $newcl;
               // dd($output);die;
         
                $ext = "pdf";

                $jasper->process(
                           public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();
                 //dd($jasper);

               } 
               
              // return;
            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            // $pathToFile = $output.'.'.$ext ;
            // return response()->file($pathToFile);
            // header('Content-Description: File Transfer');
            // header('Content-Type: application/octet-stream');
            // header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice_Monthly.'.$ext);
            // header('Content-Transfer-Encoding: binary');
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($output.'.'.$ext));
            // flush();
            // readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }


         public function invoicestatus(Request $request)
        {


            //dd($request->dformat);exit;
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Flower_Landscape_Table_Based';
         
            $ext = "pdf";

            

          
             $jasper->process(
                public_path() . '/report/Flower_Landscape_Table_Based',
                $output,
                array($ext),
                array("PFR_DT1"=>$pfr_dt),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();
            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }        


        public function orderstatusdetail(Request $request)
        {


            //dd($request->dformat);exit;
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Order_Details';
         
            $ext = "pdf";

            

          
             $jasper->process(
                public_path() . '/report/Order_Details',
                $output,
                array($ext),
                array("pfr_dt"=>$pfr_dt,"pto_dt"=>$pto_dt),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();
            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Order_Details.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }    

      
      public function retenlist(Request $request) 
      {
            //dd($request);
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            
            
                       return view('reports.retenlist');
                     
    

      }


        public function retenlist_d(Request $request) 
      {
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');

           // dd($request->all());

           // dd($request);

             $companies=DB::table('clients')->select('client_company','company_id', 'website','phone', 'client_address1', 'client_state','other_state', 'client_country', 'timezone_type', 'client_source')->whereIn('company_id', function($query) use ($pfr_dt, $pto_dt){
       $query->select('company_id')->from('orders')->whereBetween('order_us_date', [$pfr_dt , $pto_dt ]);
  })->get();

  
  
    $tot_record_found=0;
    if(count($companies)>0){
        $tot_record_found=1;
         
       // $CsvData=array('Email,Last Order Id, Last Order Us Date, Last Client Name, Company, file_type, file name, file price');          

        $CsvData = '';
       
        foreach($companies as $value){              
          

            $lastorder = DB::table('orders')->select('order_id', 'order_us_date', 'client_creation_id', 'client_name', 'client_email_primary', 'client_company',
              'client_contact_1','file_type', 'file_name', 'status', 'file_price')
            ->where('company_id','=', $value->company_id)
            ->orderBy('id', 'desc')->limit(1)->get();

            $company_id   =  $value->company_id;
            $company_name =  str_replace(',', '.', $value->client_company);
            $website      =  str_replace(',', '.', $value->website);
            $phone        =  str_replace(',', '.', $value->phone);
            $address      =  str_replace(',', '.', $value->client_address1);
            $client_state  = str_replace(',', '.', $value->client_state);
            $other_state   = str_replace(',', '.', $value->other_state);
            $country       = str_replace(',', '.', $value->client_country);
            $zone          = str_replace(',', '.', $value->timezone_type);
            $source        = str_replace(',', '.', $value->client_source);
            
       

            foreach($lastorder as $lastdtl) {
                    
                   
             $CsvData .= '<tr><td>' .$lastdtl->client_email_primary .'</td>'.
                         '<td>'. $lastdtl->order_id .'</td>'.
                         '<td>'.$lastdtl->order_us_date .'</td>'. 
                         '<td>'.$lastdtl->client_name .'</td>'. 
                         '<td>'.$lastdtl->client_company .'</td>'.
                         '<td>'.$lastdtl->file_type .'</td>'.
                         '<td>'.str_replace(',','.', $lastdtl->file_name) .'</td>'.
                         '<td>'.$lastdtl->file_price .'</td></tr>' ;
            }

        }
 
      } 

         //return response()->json($CsvData);

          return Response($CsvData);

         // return Datatables::of($CsvData)->make(true);
             
    }


      public function client_list(Request $request)
        {


            //dd($request->dformat);exit;
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            //$output = public_path() . '/report/'.time().'_New_Client_List';
            $output = public_path() . '/report/'.time().'_Companywise_list';
         
            $ext = "pdf";
            if($request->dformat == "Preview" || $request->dformat == "Download") {
                $ext = "pdf";
            }
            else
            {
                $ext = $request->dformat;
            }

            

          if ($ext != 'csv') {
             $jasper->process(
                public_path() . '/report/Companywise_list',
                $output,
                array($ext),
                array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();
         }
           //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            if ($ext == "csv") {
                 //$entitiesArray = $this->entities->toArray();
                $entitiesArray = DB::table('client_dtls')->select('client_id', 'client_creation_id', 'client_name', 'client_email_primary', 'client_company',
                'client_contact_1', 'client_creation_date_time', 'client_note')->where('client_creation_date_time','>=', $pfr_dt)->where('client_creation_date_time','<=', $pto_dt)->get();
                
                 //dd($entitiesArray);die;
                 $entitiesArray = collect($entitiesArray)->map(function($x){ return (array) $x; })->toArray();

                
                 $formatter = Formatter::make($entitiesArray, Formatter::ARR);

                 //dd($formatter);die;

                 $csv = $formatter->toCsv();

                header('Content-Disposition: attachment; filename="export.csv"');
                header("Cache-control: private");
                header("Content-type: application/force-download");
                header("Content-transfer-encoding: binary\n");

                echo $csv;

                exit;
                //   $filename = "New_Client_List.csv";
                //  header("Content-Type: application/force-download");
                // header("Content-Type: application/octet-stream");
                // header("Content-Type: application/download");
                // header('Content-Type: text/x-csv');

                // // disposition / encoding on response body
                //     if (isset($filename) && strlen($filename) > 0)
                //         header("Content-Disposition: attachment;filename={$filename}");
                //         if (isset($filesize))
                //             header("Content-Length: ".$filesize);
                //             header("Content-Transfer-Encoding: binary");
                //             header("Connection: close");

                        }
            else {

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_New_Client_List.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);
            }

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }        

public function anyData(Request $request)
    {
         // dd($request->all());

          $order_dt  =  DB::table('orders_view')->max('order_us_date')  ;
          $pyear = Carbon::parse($order_dt)->format('Y');
          $pmonth = Carbon::parse($order_dt)->format('m');
         // dd($pmonth);

          $pmonth =  $request->pmonth ;
          $pmonth =  $pmonth+ 1;

        if ($request ->has('pyear')) {
          $pyear  =  $request->pyear  ;
          $pmonth =  $request->pmonth ;

          $pmonth =  $pmonth+ 1;
          $pmonth =  str_pad($pmonth, 2, '0', STR_PAD_LEFT);

        } 
        // else {
        //   dd("hello");
        //   $order_dt  =  DB::table('orders_view')->max('order_us_date')  ;
        //   $pyear = Carbon::parse($order_dt)->format('Y');
        //   $pmonth = Carbon::parse($order_dt)->format('m');
        //  // dd($pmonth);

        //   //$pmonth =  $request->pmonth ;
        //   //$pmonth =  $pmonth+ 1;

        // }
         
        // dd($pmonth);
        $keyword =  $pyear . $pmonth ;
        //dd($keyword);
      
         $ord = DB::table('orders_view')->orderBy('id' ,'desc')
               ->whereYear('order_us_date', $pyear)
              ->whereMonth('order_us_date', $pmonth) 
             ->where('status','=', 'Completed')
             ->where('file_price' ,'>', 0)->get();
         $ord = collect($ord);
         //dd($ord);
         return Datatables::of($ord)
            ->addColumn('order_dt', function($model){
                return date('j-M-Y', strtotime($model->order_dt));
              })
               // ->filterColumn('order_us_date', function($query, $keyword) {
               //      $sql = "(orders.order_us_date)  like ?";
               //      $query->whereRaw($sql, ["%{$keyword}%"]);
               //  })
              ->make(true);

    }





    public function completed(Request $request)
        {


            //dd($request->dformat);exit;
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            $output = public_path() . '/report/'.time().'_Order_Completed_Status';
         
            $ext = "pdf";

            

          
             $jasper->process(
                public_path() . '/report/Order_Completed_Status',
                $output,
                array($ext),
                array("PFR_DT1"=>$pfr_dt,"PTO_DT1"=>$pto_dt),
                array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                    'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                  false ,
                  false
            )->execute();
            //dd($jasper);
             //array("PFR_DT"=>"2017-07-01","PTO_DT"=>"2017-07-10")

            $pathToFile = $output.'.'.$ext ;
            return response()->file($pathToFile);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.time().'_Order_Completed_Status'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($output.'.'.$ext));
            flush();
            readfile($output.'.'.$ext);

            
            //return response()->file($pathToFile);
            //unlink($output.'.'.$ext); // deletes the temporary file
         
            //return Redirect::to('reports');
        }       



     public function search(Request $request)
     {   

           //dd($request->all());

        if ($request ->has('pcomp')) {
            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            $pcomp  =  $request->pcomp  ;
           
          
            $mon     = $pmonth + 1;
                    
            $mon     = str_pad($mon, 2, '0', STR_PAD_LEFT);
            //dd($mon);die;
            $yrmon   =  $pyear ."-" . $mon ; 

         // $comp_names = DB::table('orders')
         //    ->join('clients', 'orders.company_id', '=', 'clients.company_id')
         //    ->select('clients.company_id', 'clients.client_company' )
         //    ->whereYear('orders.bill_dt',  $pyear)
         //    ->whereMonth('orders.bill_dt', $mon)
         //     ->where('orders.client_company' ,'like', '%' .$pcomp . '%')
         //    ->groupBy('clients.company_id', 'clients.client_company')
         //    ->distinct()
         //    ->get();   logic change due to sloww query on 12-06-21

             $comp_names = DB::table('orders')
                       ->select('orders.company_id', 'orders.client_company' )
            ->whereYear('orders.bill_dt',  $pyear)
            ->whereMonth('orders.bill_dt', $mon)
            ->where('orders.client_company' ,'like', '%' .$pcomp . '%')
            ->wherein('status', ['Completed', 'Rev-Completed', 'Ch-Completed'])
            ->distinct()
            ->groupBy('orders.company_id', 'orders.client_company')
            ->get();

          
         // dd($comp_names);
            $comp_names = collect($comp_names);
            $output = "";
             if(count($comp_names)==0) {
                $output = "<tr><td>1</td><td>No Records Found</td></tr>" ;
                return Response($output);
            }
            else 
            {
                     foreach ($comp_names as $comp) {
                        //dd($comp->company_id);
                        
                                           $inp   =  "<input type='checkbox' class='chk' name='orderzones[]' value='$comp->company_id' >";

                  
    
                      $output .= '<tr><td>' . $inp . '</td>' .'<td>' . $comp->client_company . '</td>' . '</tr>' ;
                        //dd($output);
                   
                
               }

                    return Response($output);
            }

        }
        else {
            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
           
            //dd($pyear);die;
            //dd($pmonth);
            
            $mon     = $pmonth + 1;
            // $new_dt  = Carbon::createFromDate($pyear, $pmonth, null, null);
            // $new_dt  = new Carbon($new_dt);
            // $new_dt1 = new Carbon($new_dt);
            // $pfr_dt  = $new_dt->startOfMonth();
            //  //dd($pfr_dt);die;
            // $pto_dt  = $new_dt1->endOfMonth();
           
            $mon     = str_pad($mon, 2, '0', STR_PAD_LEFT);
            //dd($mon);die;
            $yrmon   =  $pyear ."-" . $mon ; 
             // logic changed due to slow company
            $comp_names = DB::table('orders')
            //->join('clients', 'orders.company_id', '=', 'clients.company_id')
            ->select('orders.company_id', 'orders.client_company' )
            ->whereYear('orders.bill_dt',  $pyear)
            ->whereMonth('orders.bill_dt', $mon)
            ->wherein('status', ['Completed', 'Rev-Completed', 'Ch-Completed'])
            //->where('orders.file_price' ,'>', 0)
            ->distinct()
            ->groupBy('orders.company_id', 'orders.client_company')
            ->get();

         // $comp_names = DB::table('orders_view')->select('company_id', 'client_company' )
         //    ->whereYear('order_us_date',  $pyear)
         //    ->whereMonth('order_us_date', $mon)
         //    ->where('file_price' ,'>', 0)
         //    ->distinct()
         //    ->groupBy('company_id', 'client_company')
         //    ->get();
          
         // dd($comp_names);
            $comp_names = collect($comp_names);
            $output = "";

            if(count($comp_names)==0) {
                $output = "<tr><td>1</td><td>No Records Found</td></tr>" ;
                return Response($output);
            }
            else {
            
                foreach ($comp_names as $comp) {
                    # code...
                    $inp   =  "<input type='checkbox' class='chk' name='orderzones[]' value='$comp->company_id' >";
    
                    $output .= '<tr><td>' . $inp . '</td>' .'<td>' . $comp->client_company . '</td>' . '</tr>' ;
                    //dd($output);
                }
                
               
                return Response($output);
            }
       }    
      }

// New  invoice date wise

public function search_dt(Request $request)
     {   

           //dd($request->all());
       $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d H:i');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d H:i');

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

        if ($request ->has('pcomp')) {
           

           



         $comp_names = DB::table('orders')
            ->join('clients', 'orders.company_id', '=', 'clients.company_id')
            ->select('clients.company_id', 'clients.client_company' )
            ->whereBetween('orders.order_us_date', [$pfr_dt , $pto_dt ])
            ->where('orders.file_price' ,'>', 0)
            ->where('orders.client_company1' ,'like', '%' .$pcomp . '%')
            ->distinct()
            ->groupBy('clients.company_id')
            ->get();
          
         // dd($comp_names);
            $comp_names = collect($comp_names);
            $output = "";
             if(count($comp_names)==0) {
                $output = "<tr><td>1</td><td>No Records Found</td></tr>" ;
                return Response($output);
            }
            else 
            {
                     foreach ($comp_names as $comp) {
                     # code...
                      $inp   =  "<input type='checkbox' class='chk' name='orderzones[]' value='$comp->company_id' >";
    
                      $output .= '<tr><td>' . $inp . '</td>' .'<td>' . $comp->client_company . '</td>' . '</tr>' ;
                        //dd($output);
                     }
                
               

                    return Response($output);
            }

        }
        else {
           
           
            $comp_names = DB::table('orders')
            ->join('clients', 'orders.company_id', '=', 'clients.company_id')
            ->select('clients.company_id', 'clients.client_company' )
            ->whereBetween('orders.order_us_date', [$pfr_dt , $pto_dt ])
            ->where('orders.file_price' ,'>', 0)
            ->distinct()
            ->groupBy('clients.company_id', 'clients.client_company')
            ->get();

         
            $comp_names = collect($comp_names);
            $output = "";

            if(count($comp_names)==0) {
                $output = "<tr><td>1</td><td>No Records Found</td></tr>" ;
                return Response($output);
            }
            else {
            
                foreach ($comp_names as $comp) {
                    # code...
                    $inp   =  "<input type='checkbox' class='chk' name='orderzones[]' value='$comp->company_id' >";
    
                    $output .= '<tr><td>' . $inp . '</td>' .'<td>' . $comp->client_company . '</td>' . '</tr>' ;
                    //dd($output);
                }
                
               
                return Response($output);
            }
       }    
      }



// New Company not order report

public function CompanyOrderParam()      
{
   return view('reports.company_order');
}

public function CompanyNotOrderParam()      
{
   return view('reports.company_not_order');
}

// company order report

public function  CompanyOrder(Request $request)
{
    //  dd($request->pfr_dt);
   $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d H:i');
            $pfr_dt1 = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d H:i');
            $pto_dt1 = Carbon::parse($pto_dt)->format('Y-m-d');

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

  
  $companies=DB::table('clients')->select('client_company','company_id', 'website','phone', 'client_address1', 'client_state','other_state', 'client_country', 'timezone_type', 'client_source')->whereIn('company_id', function($query) use ($pfr_dt, $pto_dt){
       $query->select('company_id')->from('orders')->
       whereBetween('order_us_date', [$pfr_dt , $pto_dt ]);
  })->get();

  
  
    $tot_record_found=0;
    if(count($companies)>0){
        $tot_record_found=1;
         
        $CsvData=array('Company Id,Company Name,Last Order Id, Last Order Us Date,File Type, File Name, Last Status, Last Client Name, Email, Contact, website,phone,address,state, country, other state,  timezone, source');          
        foreach($companies as $value){              
           // $CsvData[]=$value->company_id.','.$value->client_company;

            $lastorder = DB::table('orders')->select('order_id', 'order_us_date', 'client_creation_id', 'client_name', 'client_email_primary',
              'client_contact_1','file_type', 'file_name', 'status')
            ->where('company_id','=', $value->company_id)
            ->orderBy('id', 'desc')->limit(1)->get();

            $company_id   =  $value->company_id;
            $company_name =  str_replace(',', '.', $value->client_company);
            $website      =  str_replace(',', '.', $value->website);
            $phone        =  str_replace(',', '.', $value->phone);
            $address      =  str_replace(',', '.', $value->client_address1);
            $client_state  = str_replace(',', '.', $value->client_state);
            $other_state   = str_replace(',', '.', $value->other_state);
            $country       = str_replace(',', '.', $value->client_country);
            $zone          = str_replace(',', '.', $value->timezone_type);
            $source        = str_replace(',', '.', $value->client_source);
            
       

            foreach($lastorder as $lastdtl) {
                    
                    $contact_no =  ClientDtl::where('client_creation_id' , $lastdtl->client_creation_id)->pluck('client_contact_1')->toArray();
                    //dd($contact_no[0]);

             $CsvData[]= $company_id. ',' .$company_name.','.$lastdtl->order_id.','.$lastdtl->order_us_date.','.$lastdtl->file_type.','.str_replace(',','.', $lastdtl->file_name) .','.$lastdtl->status.','.$lastdtl->client_name.','.$lastdtl->client_email_primary.','. str_replace(',', '.', $contact_no[0])  .','  .$website.',' .$phone. ',' .$address.',' .$client_state. ',' .$country.','.
                 $other_state. ',' .$zone .','. $source ;
            }

        }
         
        $filename=date('Y-m-d').'company-who-have-order-since'.$pfr_dt1.'-to-'.$pto_dt1.".csv";
       //$filename=date('Y-m-d').'company-who-have-not-order-since'.".csv"; 
       // $file_path=base_path().'/'.$filename;   
        

        $file_path = public_path() . '/report/'. $filename;     

        $file = fopen($file_path,"w+");
        foreach ($CsvData as $exp_data){
          fputcsv($file,explode(',',$exp_data));
        }   
        fclose($file);          
 
        $headers = ['Content-Type' => 'application/csv'];
        return response()->download($file_path,$filename,$headers );
    }
    return view('reports.company_not_order',['record_found' =>$tot_record_found]);  

}

//      Company not order report



// company order report

public function  CompanyNotOrder(Request $request)
{
   //dd($request->all());
   $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d H:i');
            $pfr_dt1 = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d H:i');
            $pto_dt1 = Carbon::parse($pto_dt)->format('Y-m-d');

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

 
  $companies=DB::table('clients')->select('client_company','company_id')->whereNotIn('company_id', function($query) use ($pfr_dt, $pto_dt){
       $query->select('company_id')->from('orders')->
       whereBetween('order_us_date', [$pfr_dt , $pto_dt ]);
  })->get();

//dd($companies);

   $tabledata='';
       $tabledata = '';
    $tot_record_found=0;
    if(count($companies)>0){
        $tot_record_found=1;
         
        // $CsvData=array('Company Name,Last Order Id, Last Order Us Date,File Type, File Name, Last Status, Last Client Name, Email, Contact');        old  
  //  new changes as on 270521
         $CsvData=array('Company Name,Last Order Id, Last Order Us Date,File Type, File Name, Last Status, Last Client Name, Email, Contact, black list, black list reason, cunitno, cstreetname,ccountry,state,city, zipcode,designation, linkedin, specification'); 

        foreach($companies as $value){              
           // $CsvData[]=$value->company_id.','.$value->client_company;

            $lastorder = DB::table('orders')->select('order_id', 'order_us_date', 'client_creation_id', 'client_name', 'client_email_primary', 'file_price',
              'client_contact_1','file_type', 'file_name', 'status' ,'client_company')
            ->where('company_id','=', $value->company_id)
            ->orderBy('id', 'desc')->limit(1)->get();

            $company_name =  str_replace(',', '.', $value->client_company);
            
         

            foreach($lastorder as $lastdtl) {
                    
                  //  $contact_no =  ClientDtl::where('client_creation_id' , $lastdtl->client_creation_id)->pluck('client_contact_1')->toArray();
                    //dd($contact_no[0]);
                $last_creation_id = $lastdtl->client_creation_id;

                $contacts =  DB::table('client_dtls')->select('client_contact_1', 'black_list', 
                     'black_list_reason', 'cunitno' , 'cstreetname' , 'ccountry',  'cstate' ,
'ccity' , 'czipcode' , 'designation',  'linkedin_url',
                    'self_client_specification')->where('client_creation_id' ,'=',  $last_creation_id  )->get();    
                    
                  // dd($contacts);

                     foreach($contacts as $key)
                    {
                        $contact_no = $key->client_contact_1;

                       // dd($contact_no);
                      
                      if ( !empty( $key->black_list))
                      {
                          $black_list = $key->black_list;
                      }
                      else {
                             $black_list  ='' ;
                      }
                     
                       if ( !empty( $key->black_list_reason))
                       {
                         $black_list_reason =$key->black_list_reason;
                       }
                       else {
                             $black_list_reason= '';
                       }


                        if ( !empty( $key->cunitno))
                        {
                           $cunitno = $key->cunitno;
                        }
                        else
                        {
                            $cunitno= '';
                        }
                  
                        if ( !empty( $key->cstreetname))
                        {
                          $cstreetname = $key->cstreetname;
                        }
                        else {
                             $cstreetname = '';
                        }

                         if ( !empty( $key->ccountry))
                        {
                          $ccountry = $key->ccountry;
                        }
                        else {
                             $ccountry = '';
                        }

                           if ( !empty( $key->cstate))
                        {
                          $cstate = $key->cstate;
                        }
                        else {
                             $cstate = '';
                        }

                            if ( !empty( $key->ccity))
                        {
                          $ccity = $key->ccity;
                        }
                        else {
                             $ccity = '';
                        }

                              if ( !empty( $key->czipcode))
                        {
                          $czipcode = $key->czipcode;
                        }
                        else {
                             $czipcode = '';
                        }

                             if ( !empty( $key->designation))
                        {
                          $designation = $key->designation;
                        }
                        else {
                             $designation = '';
                        }

                            if ( !empty( $key->linkedin_url))
                        {
                          $linkedin_url = $key->linkedin_url;
                        }
                        else {
                             $linkedin_url = '';
                        }

                             if ( !empty( $key->self_client_specification))
                        {
                          $self_client_specification = $key->self_client_specification;
                        }
                        else {
                             $self_client_specification = '';
                        }
                 
                    
                    }

                   

                 

               $tabledata .=  '<tr><td>' . $lastdtl->client_email_primary.'</td><td>'.$lastdtl->order_id.'</td><td>'.$lastdtl->order_us_date.'</td><td>'.$lastdtl->client_name.'</td><td>'.$lastdtl->client_company.'</td><td>'.$lastdtl->file_type.'</td><td>'.str_replace(',','.', $lastdtl->file_name) .'</td><td>'.$lastdtl->file_price.'</td></tr>'  ;

             // $CsvData[]= $company_name.','.$lastdtl->order_id.','.$lastdtl->order_us_date.','.$lastdtl->file_type.','.str_replace(',','.', $lastdtl->file_name) .','.$lastdtl->status.','.$lastdtl->client_name.','.$lastdtl->client_email_primary.','. str_replace(',', '.', $contact_no[0]) ;


              $CsvData[]= $company_name.','.$lastdtl->order_id.','.$lastdtl->order_us_date.','.$lastdtl->file_type.','.str_replace(',','.', $lastdtl->file_name) .','.$lastdtl->status.','.$lastdtl->client_name.','.$lastdtl->client_email_primary.','. str_replace(',', '.', $contact_no)
                  .','.  $black_list .','. $black_list_reason.','. $cunitno.','. $cstreetname.','. $ccountry .','.$cstate.','. $ccity.','. $czipcode.','. $designation.','. $linkedin_url.','.$self_client_specification ;

                 // dd($CsvData);
            }

            //dd($CsvData);

        }

      // dd($CsvData);
     //  dd($tabledata);
     

        $filename=date('Y-m-d').'company-who-have-not-order-since'.$pfr_dt1.'-to-'.$pto_dt1.".csv";
       //$filename=date('Y-m-d').'company-who-have-not-order-since'.".csv"; 
       // $file_path=base_path().'/'.$filename;   
        

        if($request->dformat =='Preview'){

            

                       return response($tabledata);
        }
        else 

        {
                $file_path = public_path() . '/report/'. $filename;     

               // dd($filename);

        $file = fopen($file_path,"w+");
        foreach ($CsvData as $exp_data){
          fputcsv($file,explode(',',$exp_data));
        }   
        fclose($file);          
 
        $headers = ['Content-Type' => 'application/csv'];
        return response()->download($file_path,$filename,$headers );


		}
        

       
    }
    return view('reports.company_not_order',['record_found' =>$tot_record_found]);  

}

//      Company not order report

public function printinvoice_option(Request $request)
    {
           // dd($request->all());

            $pyear  =  $request->pyear  ;
            $pmonth =  $request->pmonth ;
            $orderzones = $request->orderzones ;
            $pinvdtoption  = $request->pinvdtoption;

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
           // $P_status    = str_replace('/', '', $P_status);

            //$param2    = " and orders.status IN" . " (" . $P_status . ")";  removed on  260318 as not  working in server 30 php 7.1


            //  $P_status = stripslashes($P_status);

          
            $param2_1    = " and order_dtls.status IN" . " (" . $P_status . ")";  

            $param2    = " and orders.status IN" . " (" . $P_status . ")";   
            //$param2    = "and orders.status in ('Completed')"; 
            // dd($param2);  
         
           // $param2    =  '"' . $param2 . '"' ;  

              $param2 = stripslashes($param2);
	      $param2_1 = stripslashes($param2_1);
              $param2 =   $param2_1 . $param2 ;

          
            
            //dd($pmonth);
            //dd($param2);
            $pmonth =$pmonth+ 1;
            //dd($pyear);die;

            //dd($stat);die;
            $username = Auth::user()->name ; 
            $username = trim($username,'');
            $username = str_replace(" ", "_", $username);
           
            $username = substr($username, 0, 6);
            $username =  str_replace(' ','_', $username);
            
            $zip = new ZipArchive();
            
            $mon = $pmonth ;
            $new_dt = Carbon::createFromDate($pyear, $pmonth, null, null);
            $new_dt = new Carbon($new_dt);
            $new_dt1 = new Carbon($new_dt);
            $pfr_dt = $new_dt->startOfMonth()->format('Y-m-d');
             //dd($pfr_dt);die;
            $pto_dt = $new_dt1->endOfMonth()->format('Y-m-d');
           

            $mon = str_pad($mon, 2, '0', STR_PAD_LEFT);
            //dd($mon);die;
            $yrmon =  $pyear ."-" . $mon ;

            //dd($pfr_dt); die;
            //dd($request->all());die;
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');

if($pinvdtoption=='0')  {         
            $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereYear('bill_dt', $pyear)
            ->whereMonth('bill_dt', $pmonth)
            //->where('file_price' ,'>', 0)  commented on 21-04-20 as per kulind sir
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            //->limit(4)
            ->get();
             
            // dd($comp_names);die;

            if(count($comp_names) < 1) {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No Records for Specified Range' );
                // $request->session()->put('msg', 'No Records for Specified Range');

                return redirect()->back();
            }

            $folderPath = public_path() . '/' . $username ;
            //dd($folderPath);
            //mkdir("$folderPath");
            //dd(File::exists($folderPath));
            $success = File::deleteDirectory($folderPath);
                
            if(!File::exists($folderPath)) {
                File::makeDirectory($folderPath);
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }
            
                      
            $var1=1;
            foreach($comp_names as $cl) {
                  //dd($cl->client_name);
                 
                    $pcompany_id =  $cl->company_id;
                    $newcl =  substr(trim($cl->client_company),0,12);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);
                
                // removed as per instruction of kulind sir on 06/10/18
                   //$newcl = $newcl . $var1 ;
                   //$var1 = $var1 + 1 ;
               //  dd($var1);die;

                         $inv_summary = InvoiceSummary::where('company_id','=', $pcompany_id)
                    ->where('yr_month' ,'=',  $pyear . $mon)->first();

                    $inv_no = '';

                    if(isset($inv_summary->invoice_no))
                    {
                       $inv_no = $inv_summary->invoice_no;
                    }
                 
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                //$folderPath = public_path() . '/report/' . $yrmon ;
               // $folderPath = public_path() . '/' .  $yrmon ;
             
            
                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
               
              // changed below path as per sir instruction on 10/06/18 4 am
                 //$output =  $folderPath.'/' .  $yrmon . time(). $newcl;
                   $output =  $folderPath.'/'. $newcl .  $yrmon . time();
                   // as per instruction of  KULIND SIR PDF FILE NAME CHANGED 
                   //TO   COMPANYNAME+YRMON+COMPANY_ID+ RANDOM NO
                   $output =  $folderPath.'/'. $newcl .  $yrmon .'-'. $pcompany_id .'-'. substr(time(),-4);
                //dd($output);die;
         
                $ext = "pdf";

  
          
                $jasper->process(
                           public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id, "Param2" =>  $param2,"p_invoice_no"=>$inv_no),
                                  //  array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  // 'database' => 'omsv4', 'username' => 'root', 'password' => '4{h}fPvcf4Qyer%**' ),
                                      array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
                                  'database' => 'omsv4', 'username' => 'php', 
                                  'password' => '4{h}fPvcf4Qyer%--' ),
                                   false ,
                                   false
                                       )->execute();
                
            //dd($jasper);
               
               } 

                //$files = File::allFiles(getcwd());
                 //$files = File::allFiles($folderPath .'/');
                   //  foreach ($files as $file)
                    // {
                   //      echo (string)$file, "\n";
                   //  }
                

               $DelFilePath="file1.zip";
               
               $file_path =  $folderPath.'/' ;

               //dd($file_path);
               if(file_exists($file_path.$DelFilePath)) {
                        unlink ($file_path.$DelFilePath);
                    }

                   
                //if not exist then to create zip file
               // dd($file_path . $DelFilePath);
                if ($zip->open($file_path . $DelFilePath, ZipArchive::CREATE) === TRUE) {     
                //if ($zip->open($file_path.$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
                          //  die ("Could not open archive");
              
                //loop on the images/file to add in zip
                   // dd("hello");
               
               foreach (File::files(public_path() . '/' . $username) as $path)
                    {
                         //dd($path);
                        //dd(File::name($path));         // file name (no extension)
                       // dd(File::extension($path));    // file extension
                       
                        // and so on...

                        if (file_exists($path )) {

                           $zip->addFile( $path  , 'in_' . File::name($path) . "." . File::extension($path));
                          // dd("hello");
                        }
                }
               
                // foreach ($files as $file) {

                //            dd($file);
                //         if (file_exists($file )) {

                //            $zip->addFile( $file  , 'new_' . $file );
                //           // dd("hello");
                //         }
                //     }

                   
                    // close and save archive
                    $zip->close();
                  }

                  $headers = array(
                        'Content-Type' => 'application/octet-stream',
                    );
                //opening zip and saving directly on client machine
                if(file_exists($file_path.$DelFilePath)){
                       return response()->download($file_path .$DelFilePath,$DelFilePath,$headers);
                }
               
           
        }


    elseif ($pinvdtoption=='1')
{
 
        $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereYear('approval_time', $pyear)
            ->whereMonth('approval_time', $pmonth)
            ->where('file_price' ,'>', 0)
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            //->limit(4)
            ->get();
             
            // dd($comp_names);

            if(count($comp_names) < 1)
            { 
      
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No Records for Specified Range' );
                              return redirect()->back();
            }

            $folderPath = public_path() . '/' . $username ;
            //dd($folderPath);
            //mkdir("$folderPath");
            //dd(File::exists($folderPath));
            $success = File::deleteDirectory($folderPath);
                
            if(!File::exists($folderPath)) {
                File::makeDirectory($folderPath);
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }
            
                      

            foreach($comp_names as $cl) {
                  //dd($cl->client_name);
                 
                    $pcompany_id =  $cl->company_id;
                    $newcl =  substr($cl->client_company,0,10);
              
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);

                $newcl =  str_replace(' ','_', $newcl);
                // dd($newcl);die;

                            
                         $inv_summary = InvoiceSummary::where('company_id','=', $pcompany_id)
                    ->where('yr_month' ,'=',  $pyear . $mon)->first();

                    $inv_no = '';

                    if(isset($inv_summary->invoice_no))
                    {
                       $inv_no = $inv_summary->invoice_no;
                    }
                 
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                //$folderPath = public_path() . '/report/' . $yrmon ;
               // $folderPath = public_path() . '/' .  $yrmon ;
             
            
                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
               
                $output =  $folderPath.'/' . $newcl .  $yrmon . time();
                //dd($output);die;
         
                $ext = "pdf";

  
          
                $jasper->process(
                           public_path() . '/report/Patterns_InvoiceComp_Appdt.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id, "Param2" =>  $param2,"p_invoice_no"=>$inv_no),
                                  //  array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  // 'database' => 'omslaravel56', 'username' => 'root', 'password' => '4{h}fPvcf4Qyer%**' ),
                                      array('driver' => 'mysql', 'host' => '192.168.0.10', 'port' => '3306', 
                                  'database' => 'omscrm_new', 'username' => 'root', 
                                  'password' => '4{h}fPvcf4Qyer%--' ),
                                   false ,
                                   false
                              )->execute();
                //dd($jasper);

               
               } 

                //$files = File::allFiles(getcwd());
                 //$files = File::allFiles($folderPath .'/');
                   //  foreach ($files as $file)
                    // {
                   //      echo (string)$file, "\n";
                   //  }
                

               $DelFilePath="file1.zip";
               
               $file_path =  $folderPath.'/' ;

               //dd($file_path);
               if(file_exists($file_path.$DelFilePath)) {
                        unlink ($file_path.$DelFilePath);
                    }

                   
                //if not exist then to create zip file
               // dd($file_path . $DelFilePath);
                if ($zip->open($file_path . $DelFilePath, ZipArchive::CREATE) === TRUE) {     
                //if ($zip->open($file_path.$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
                          //  die ("Could not open archive");
              
                //loop on the images/file to add in zip
                   // dd("hello");
               
               foreach (File::files(public_path() . '/' . $username) as $path)
                    {
                         //dd($path);
                        //dd(File::name($path));         // file name (no extension)
                       // dd(File::extension($path));    // file extension
                       
                        // and so on...

                        if (file_exists($path )) {

                           $zip->addFile( $path  ,  File::name($path) . "." . File::extension($path));
                          // dd("hello");
                        }
                }
               
                // foreach ($files as $file) {

                //            dd($file);
                //         if (file_exists($file )) {

                //            $zip->addFile( $file  , 'new_' . $file );
                //           // dd("hello");
                //         }
                //     }

                   
                    // close and save archive
                    $zip->close();
            }

                  $headers = array(
                        'Content-Type' => 'application/octet-stream',
                    );
                //opening zip and saving directly on client machine
                if(file_exists($file_path.$DelFilePath)){
                       return response()->download($file_path .$DelFilePath,$DelFilePath,$headers);
                }
               
  
}
else {
         $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereYear('order_completion_time', $pyear)
            ->whereMonth('order_completion_time', $pmonth)
            ->where('file_price' ,'>', 0)
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            //->limit(4)
            ->get();
             
            // dd($comp_names);die;

            if(count($comp_names) < 1) {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No Records for Specified Range' );
                // $request->session()->put('msg', 'No Records for Specified Range');

                return redirect()->back();
            }

            $folderPath = public_path() . '/' . $username ;
            //dd($folderPath);
            //mkdir("$folderPath");
            //dd(File::exists($folderPath));
            $success = File::deleteDirectory($folderPath);
                
            if(!File::exists($folderPath)) {
                File::makeDirectory($folderPath);
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }
            
                      

            foreach($comp_names as $cl) {
                  //dd($cl->client_name);
                 
                    $pcompany_id =  $cl->company_id;
                    $newcl =  substr($cl->client_company,0,10);

                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);    
              
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                $newcl =  str_replace(' ','_', $newcl);
                // dd($newcl);die;
                 
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                //$folderPath = public_path() . '/report/' . $yrmon ;
               // $folderPath = public_path() . '/' .  $yrmon ;
             
            
                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
               
                $output =  $folderPath.'/'  . $newcl .  $yrmon . time();
                //dd($output);die;
         
                $ext = "pdf";

  
          
                $jasper->process(
                           public_path() . '/report/Patterns_InvoiceComp_Compdt.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id, "Param2" =>  $param2),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();
                // dd($jasper);

               
               } 

                //$files = File::allFiles(getcwd());
                 //$files = File::allFiles($folderPath .'/');
                   //  foreach ($files as $file)
                    // {
                   //      echo (string)$file, "\n";
                   //  }
                

               $DelFilePath="file1.zip";
               
               $file_path =  $folderPath.'/' ;

               //dd($file_path);
               if(file_exists($file_path.$DelFilePath)) {
                        unlink ($file_path.$DelFilePath);
                    }

                   
                //if not exist then to create zip file
               // dd($file_path . $DelFilePath);
                if ($zip->open($file_path . $DelFilePath, ZipArchive::CREATE) === TRUE) {     
                //if ($zip->open($file_path.$DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
                          //  die ("Could not open archive");
              
                //loop on the images/file to add in zip
                   // dd("hello");
               
               foreach (File::files(public_path() . '/' . $username) as $path)
                    {
                         //dd($path);
                        //dd(File::name($path));         // file name (no extension)
                       // dd(File::extension($path));    // file extension
                       
                        // and so on...

                        if (file_exists($path )) {

                           $zip->addFile( $path  ,  File::name($path) . "." . File::extension($path));
                          // dd("hello");
                        }
                }
               
                // foreach ($files as $file) {

                //            dd($file);
                //         if (file_exists($file )) {

                //            $zip->addFile( $file  , 'new_' . $file );
                //           // dd("hello");
                //         }
                //     }

                   
                    // close and save archive
                    $zip->close();
                  }

                  $headers = array(
                        'Content-Type' => 'application/octet-stream',
                    );
                //opening zip and saving directly on client machine
                if(file_exists($file_path.$DelFilePath)){
                       return response()->download($file_path .$DelFilePath,$DelFilePath,$headers);
                }
               
           
        


    }

    }// don't use


public function printinvoice_date_option(Request $request)
    {
           //dd($request->all());

      // This final report used as on 21/10/2018

             $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt1 = Carbon::parse($pfr_dt)->format('Y-m-d H:i');
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pto_dt1 = Carbon::parse($pto_dt)->format('Y-m-d H:i');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');

            
            if ($request ->has('file_type'))
                $pfile_type =  $request->file_type ;

            if ($pfile_type == 'ALL')  
              {
               $param3 = ' and file_type like ' . "'" . '%' ."'" ;
              }
            else  {
                 $param3 =  ' and file_type = ' . "'". $pfile_type ."'";
            }

            // dd($param3);

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

            $yrmon = Carbon::parse($pfr_dt)->format('Y') .  Carbon::parse($pfr_dt)->format('m');

            $orderzones = $request->orderzones ;
            
            $pinvdtoption  = $request->pinvdtoption;

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
            $param2    = $param2 . $param3 ;
            $param2    =  '"' . $param2 . '"' ;    
            $param2    =  stripslashes($param2);
            
            //dd($param2);
            //dd($stat);die;
            $username = Auth::user()->name ; 
            $username = trim($username,'');
            $username = str_replace(" ", "_", $username);
           
            $username = substr($username, 0, 6);
            $username =  str_replace(' ','_', $username);
            
            $zip = new ZipArchive();
            
           
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');

      
            $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereBetween('order_us_date', [$pfr_dt1 , $pto_dt1 ])
            ->where('file_price' ,'>', 0)
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            //->limit(4)
            ->get();
             
           // dd($comp_names);die;

            if(count($comp_names) < 1) {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No Records for Specified Range' );
                // $request->session()->put('msg', 'No Records for Specified Range');

                return redirect()->back();
            }

            $folderPath = public_path() . '/' . $username ;
            //dd($folderPath);
            //mkdir("$folderPath");
            //dd(File::exists($folderPath));
            $success = File::deleteDirectory($folderPath);
                
            if(!File::exists($folderPath)) {
                File::makeDirectory($folderPath);
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }
            
                      
            $var1=1;
            foreach($comp_names as $cl) {
                 
                 
                    $pcompany_id =  $cl->company_id;
                    $newcl =  substr($cl->client_company,0,15);

              $digitcnt =  DB::table('orders')
                ->whereBetween('bill_dt', [$pfr_dt1 , $pto_dt1 ])
                ->where('file_price' ,'>', 0)
                ->where('company_id', $pcompany_id)
                ->where('file_type', 'Digitizing')
                ->whereIn('status', $stat)
                ->count();

               // dd($cnt);
              
                $newcl =  preg_replace('/[^a-zA-Z0-9_.]/', '_', $newcl);
               // dd($newcl);
                //dd($newcl) removed as previously selecting by client name
                $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl); //for removing ascii characters
                //dd($newcl);
                $newcl =  str_replace(' ','_', $newcl);
               // $newcl = $newcl . $var1 ;
               // $var1 = $var1 + 1 ;
            
                $output =  $folderPath.'/' . $newcl .  $yrmon . time();
                //dd($output);die;
         
                $ext = "pdf";

  
                if ($digitcnt > 0) {
                    
                     $jasper->process(
                           public_path() . '/report/Patterns_Invoice_DateWise_Digit.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id, "Param2" =>  $param2),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();

                     //dd($jasper);
               


                }
                else
                  {
                       $jasper->process(
                           public_path() . '/report/Patterns_Invoice_DateWise_Vector.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pcompany_id, "Param2" =>  $param2),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();
                  }
                // dd($jasper);
               
               } 

        
                

               $DelFilePath="file1.zip";
               
               $file_path =  $folderPath.'/' ;

               //dd($file_path);
               if(file_exists($file_path.$DelFilePath)) {
                        unlink ($file_path.$DelFilePath);
                    }

                   
                //if not exist then to create zip file
               // dd($file_path . $DelFilePath);
                if ($zip->open($file_path . $DelFilePath, ZipArchive::CREATE) === TRUE) {     
             
               
               foreach (File::files(public_path() . '/' . $username) as $path)
                    {
                         //dd($path);
                        //dd(File::name($path));         // file name (no extension)
                       // dd(File::extension($path));    // file extension
                       
                        // and so on...

                        if (file_exists($path )) {

                           $zip->addFile( $path  ,  File::name($path) . "." . File::extension($path));
                          // dd("hello");
                        }
                }
               
            
                   
                    // close and save archive
                    $zip->close();
                  }

                  $headers = array(
                        'Content-Type' => 'application/octet-stream',
                    );
                //opening zip and saving directly on client machine
                if(file_exists($file_path.$DelFilePath)){
                       return response()->download($file_path .$DelFilePath,$DelFilePath,$headers);
                }
               


    }


public function MultiCompany(Request $request)
    {
           //dd($request->all());

      // This final report used as on 21/10/2018

             $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt1 = Carbon::parse($pfr_dt)->format('Y-m-d H:i');
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pto_dt =  str_replace('/', '-', $request->pto_dt);
            $pto_dt1 = Carbon::parse($pto_dt)->format('Y-m-d H:i');
            $pto_dt = Carbon::parse($pto_dt)->format('Y-m-d');
            
            $orderzones = $request->orderzones ; 

            $P_COMP2  = "'" . implode( "','", $orderzones ) . "'" ;

           // dd($P_COMP2);
          
           $param1    = " and company_id IN" . " (" . $P_COMP2 . ")";   
           $param1    ='"' . $param1 . '"' ;
           $param1    =  stripslashes($param1); 
            
            if ($request ->has('file_type'))
                $pfile_type =  $request->file_type ;

            if ($pfile_type == 'ALL')  
              {
               $param3 = ' and file_type like ' . "'" . '%' ."'" ;
              }
            else  {
                 $param3 =  ' and file_type = ' . "'". $pfile_type ."'";
            }


            $param3   = '"' . $param3 . '"' ;

            // dd($param3);

            $pfr_dt = (string)($pfr_dt);
            $pto_dt = (string)($pto_dt);

            $yrmon = Carbon::parse($pfr_dt)->format('Y') .  Carbon::parse($pfr_dt)->format('m');

            $pinvdtoption  = $request->pinvdtoption;

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
            $param2   = '"' . $param2 . '"';
             
            $param2    =  stripslashes($param2);
            
            //dd($param2);
            //dd($stat);die;
            $username = Auth::user()->name ; 
            $username = trim($username,'');
            $username = str_replace(" ", "_", $username);
           
            $username = substr($username, 0, 6);
            $username =  str_replace(' ','_', $username);
            
            $zip = new ZipArchive();
            
           
            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');

      
            $comp_names = DB::table('orders')->select('company_id', 'client_company')
            ->whereBetween('order_us_date', [$pfr_dt1 , $pto_dt1 ])
            ->where('file_price' ,'>', 0)
            ->whereIn('company_id', $orderzones)
            ->whereIn('status', $stat)
            ->distinct()
            ->groupBy('company_id', 'client_company')
            //->limit(4)
            ->get();
             
           // dd($comp_names);die;

            if(count($comp_names) < 1) {
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'No Records for Specified Range' );
                // $request->session()->put('msg', 'No Records for Specified Range');

                return redirect()->back();
            }

            $folderPath = public_path() . '/' . $username ;
            
                      
            $var1=1;
           

              // $digitcnt =  DB::table('orders')
              //   ->whereBetween('bill_dt', [$pfr_dt1 , $pto_dt1 ])
              //   ->where('file_price' ,'>', 0)
              //   ->where('company_id', $pcompany_id)
              //   ->where('file_type', 'Digitizing')
              //   ->whereIn('status', $stat)
              //   ->count();

               // dd($cnt);
               $output = public_path() . '/report/'. date("dmY"). 'Inv_Report';
           //dd($output);die;
            
                $ext = "html";

                $jasper->process(
                           public_path() . '/report/Invoice_DateWise_Server_3.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "param1"=>$param1, "param2"=>$param2, 
                                    "param3"=>$param3),
                                   array('driver' => 'mysql', 'host' => '192.168.0.30', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root' ),
                                   false ,
                                   false
                              )->execute();
               
                // dd($jasper);
            
                               
              
                  // $headers = array(
                  //       'Content-Type' => 'application/octet-stream',
                  //   );

                  $headers = array(
                        'Content-Type' => 'text/html',
                    );
            
               $pathToFile = $output.'.'.$ext ;

            //return redirect()->away('http://www.google.com');  

           $file = file_get_contents($pathToFile);

           return view('reports.viewreport')->withExternal($file);

//           if (File::isFile($pathToFile))
// {
//     $file = File::get($pathToFile);
//     $response = Response::make($file, 200);
   
//     $response->header('Content-Type', 'application/octet-stream');

//     return $response;
// }
     

      //     return redirect()->away($pathToFile);  

            
            // return response()->file($pathToFile);
            // header('Content-Description: File Transfer');
            // header('Content-Type: application/octet-stream');
            // header('Content-Disposition: attachment; filename='.time().'_Patterns_Invoice.'.$ext);
            // header('Content-Transfer-Encoding: binary');
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($output.'.'.$ext));
            // flush();
            // readfile($output.'.'.$ext);



    }




  

}