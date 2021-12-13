<?php
namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Http\Requests;
use JasperPHP\JasperPHP as JasperPHP;
use SoapBox\Formatter\Formatter;
use Auth;
use File;
use SSH;

class JasperDailyReportController extends Controller {

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
            

            

            return view('reports.invoicereport' , compact('year', 'month'));
        }

      
       public function newclientlist()
        {
            //dd("hello");die;
            return view('reports.clientlist');
        }

        public function DailyReportParameters()
        {
            //dd("hello");die;
            $ordstat = DB::table('order_status')->pluck('status');

            foreach($ordstat as $st){
                $status[] = $st ;
            } 
           
            return view('miscreports.dailyreport', compact('status'));
        }

        public function DailyReportParameters1()
        {
            //dd("hello");die;
            return view('miscreports.dailyreport1');
        }

        public function DailyReportExecute(Request $request)
        {
            // dd("hello");die;

            //dd($request->pfr_dt);

            $pfr_dt =  str_replace('/', '-', $request->pfr_dt);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');

            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            //$output = public_path() . '/report/'.time().'_Daily_Order_Report';
            $output = public_path() . '/report/'. time(). 'Daily_Report';
           //dd($output);die;
            $ext = "pdf";
           
            // $jasper->process(
            //    public_path() . '/report/Daily_Order_Report.jrxml')->execute();   
            
            // $jasper->compile(
             //   public_path() . '/report/hello_world.jrxml')->execute();   

            $jasper->process(
                public_path() . '/report/Daily_Order_Report.jasper',
                $output,
                array($ext),
                array("PFR_DT"=>$pfr_dt),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omsv4', 'username' => 'php', 
                    'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

          // dd($jasper);

           
          
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

        }

         public function DailyReportExecute1(Request $request)
        {
             //dd("hello");die;
           // dd($request->all());
            $pfr_dt =  str_replace('/', '-', $request->pfr_dt1);
            $pfr_dt = Carbon::parse($pfr_dt)->format('Y-m-d');

            $pstatus  = $request->st ;
            foreach($pstatus as $p) {
                $pstat[] = (string)$p;
            }
            //dd($pcompany);
             //$P_company_id = implode(',' , $pcompany );

             $P_status = "'" . implode( "','", $pstat ) . "'" ;



             $P_status = stripslashes($P_status);

             $var1 =   "status IN (" ;
             $var2 =   ")" ;

             $param2  =  '"' . $var1 .  $P_status . $var2 .  '"' ;

            // $param2 = "status in ('QC OK','Completed')";
             $param2   =  stripslashes($param2);

           

            //dd($param2);

            $jasper = new JasperPHP;
            $database = \Config::get('database.connections.mysql');
            //$output = public_path() . '/report/'.time().'_Daily_Order_Report';
            $output = public_path() . '/report/' . time(). 'Daily_Report';
           //dd($output);die;
            $ext = "pdf";

          
            $jasper->process(
                public_path() . '/report/Daily_Order_Report_1.jasper',
                $output,
                array($ext),
                array( 'param2' => $param2 , 'PFR_DT'=>$pfr_dt),
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omsv4_2', 'username' => 'php', 'password' => '4{h}fPvcf4Qyer%--'),
                false,
                false
            )->execute();

            
           // dd($jasper);

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
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 'database' => 'omslaravel56', 'username' => 'root', 'password' => 'root'),
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
                array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
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



      public function printinvoice_monthly(Request $request)
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
            $client_names = DB::table('orders')->select('client_creation_id', 'client_company')
            ->whereYear('order_us_date', $pyear)
            ->whereMonth('order_us_date', $pmonth)
            ->where('status','=', 'Completed')
            ->where('file_price' ,'>', 0)
            ->orderBy('client_company', 'desc')
            ->get();
             
            // dd($client_names);die;

            $client_names = collect($client_names);

            foreach($client_names as $cl) {
                  //dd($cl->client_name);
                 
                if(!empty($cl->client_company)) {
                        $pclient_company =  $cl->client_company;
                        $newcl =  substr($cl->client_company,0,10);
                }
                else {
                        $pclient_company =  $cl->client_name;
                        $newcl =  substr($cl->client_name,0,10);
                }



                 //dd($newcl);
                 $newcl =  preg_replace('/\s+Oâ€™/ ', '_', $newcl);
                 $newcl =  str_replace(' ','_', $newcl);
                 // dd($newcl);die;
                 
                     
               // SSH::run(array('cd $Home'));
                //$output = shell_exec('pwd');
                
                
                $folderPath = public_path() . '/report/' . $yrmon ;
                //mkdir("$folderPath");
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
                                    "P_client_company" =>$pclient_company),
                                   array('driver' => 'mysql', 'host' => 'localhost', 'port' => '3306', 
                                  'database' => 'omslaravel56', 'username' => 'root', 'password' => '' ),
                                   false ,
                                   false
                              )->execute();
                // dd($jasper);

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
            ->get();
             
            // dd($client_names);die;

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
                //mkdir("$folderPath");
                //File::makeDirectory($folderPath);
               // File::makeDirectory($folderPath, $mode = 0777, true, true);

                 // $files = File::allFiles(getcwd());
                 //    foreach ($files as $file)
                 //    {
                 //        echo (string)$file, "\n";
                 //    }
                //$output = public_path() . '/report/'.time().'_Patterns_Invoice_ClientWise';
               
                $output =  public_path() . '/'.$folderPath.'/' . $pclient_id . $newcl;
               // dd($output);die;
         
                $ext = "pdf";

             

          
                  $jasper->process(
                           public_path() . '/report/Patterns_Invoice_CompanyWise.jasper',
                                   $output,
                                   array($ext),
                                   array("PFR_DT"=>$pfr_dt,"PTO_DT"=>$pto_dt,
                                    "P_company_id" =>$pclient_id),
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

    }

