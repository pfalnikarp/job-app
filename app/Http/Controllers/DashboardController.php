<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
   public function monthdashboard(){

    $createTempTables = DB::unprepared(
    DB::raw("
        CREATE TEMPORARY TABLE table_temp_orders 
                        AS (
                            SELECT *
                            FROM orders
                                                      
                            );
                       

    ")
);
   
    $date=Carbon::today('America/New_York');
$now = Carbon::today('America/New_York');
$weekStartDate = $now->startOfWeek();
$weekEndDate = $now->endOfWeek();

    //weekly dashboard card show
        $weektotvectordata=[];
        $weektotdigitdata=[];
        $weektotalloted=[];
        $weektotqcpending=[]; 
        $weektotqc=[]; 
        $weektotcompl=[];
        $weektotalrevesion=[];
        $weektotalchange=[];
        $showdate=[];
        $showdatename=[];
        $weekphotodata=[];
$stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
$completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
$qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
$qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];

for($i=0; $i < 7; $i++){
    $weekdate=$weekEndDate->subDays($i);


        $weektotvectordata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereDate('bill_dt','=',  $weekdate)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get(); 

        $weektotdigitdata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice'))
                 ->whereDate('bill_dt','=',$weekdate)
                ->where('file_type', '=', 'Digitizing')
                ->wherein('status' , $stat)
                ->get();

        $weekphotodata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as dtotphoto, sum(file_price) as dtotphotoprice'))
               ->whereDate('bill_dt','=', $weekdate)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();
         
        $weektotalloted[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                 ->whereDate('bill_dt','=', $weekdate)
                ->where('status', '=', 'Alloted')
                ->get();

        $weektotqcpending[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->whereDate('bill_dt','=',$weekdate)
                ->wherein('status' , $qcpending)
                ->get();
          
        $weektotqc[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                 ->whereDate('bill_dt','=', $weekdate)
                 ->wherein('status' , $qcok)
                ->get();
        $weektotcompl[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->whereDate('bill_dt','=',$weekdate)
                ->wherein('status' , $completed)
                ->get();

        $weektotalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereDate('bill_dt','=', $weekdate)->where('file_reason.last_status','=','Revision')->count();

        $weektotalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereDate('bill_dt','=',  $weekdate)->where('file_reason.last_status','=','Changes')->count();
        $showdate[]=$weekdate->toDateString();
         $showdatename[]=$weekdate->format('l');
         $weekEndDate = $now->endOfWeek();
        // $date=Carbon::today('America/New_York');
    }


       
    //monthly dashboard card show data
   	   $us_time =Carbon::now('America/New_York');
       $year =Carbon::now('America/New_York')->format('Y');
       $month=Carbon::now('America/New_York')->format('m');
        $totvectordata=[];
        $totdigitdata=[];
        $totalloted=[];
        $totqcpending=[]; 
        $totqc=[]; 
        $totcompl=[];
        $totalrevesion=[];
        $totalchange=[];
        $totphotodata=[];
        for($i=1;$i<13;$i++){
        	$month=$i;
        $totvectordata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereYear('bill_dt','=',$year)
                ->whereMonth('bill_dt','=',$month)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get(); 

       // $totvectordata = collect($totvectordata);
        
        $totdigitdata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->wherein('status' , $stat)
                ->where('file_type', '=', 'Digitizing')
                ->get();
        $totphotodata[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as dtotphoto,sum(file_price) as dtotphotoprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();
    
         $totalloted[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->where('status', '=', 'Alloted')
                ->get();
         
          $totqcpending[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcpending)
                ->get();
          
           $totqc[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcok)
                ->get();
            
             $totcompl[] = DB::table('table_temp_orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $completed)
                ->get();
             $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();

             $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
            
            
           
         }
        
         $monthtitle=[];
         $monthtitle=['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];

        
   	return view('dashboard.showmonthlydashboard.view',compact('totvectordata','totdigitdata','totphotodata','totalloted','totqcpending','totqc','totcompl','totalrevesion','totalchange','weektotvectordata','weektotdigitdata','weektotalloted','weektotqcpending','weektotqc','weektotcompl','weektotalrevesion','weektotalchange','weekphotodata','monthtitle','year','showdate','showdatename'));
   }

   public function ajaxmonthdashboard(Request $request){
   	    $year=$request->year;
   	    $totvectordata=[];
        $totdigitdata=[];
        $totalloted=[];
        $totqcpending=[]; 
        $totqc=[]; 
        $totcompl=[];
        $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
        $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
        $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
        $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];             
        for($i=1;$i<13;$i++){
        	$month=$i;
        $totvectordata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereYear('bill_dt','=',$year)
                ->whereMonth('bill_dt','=',$month)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get(); 

       // $totvectordata = collect($totvectordata);
        
        $totdigitdata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->wherein('status' , $stat)
                ->where('file_type', '=', 'Digitizing')
                ->get();
         
         $totalloted[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->where('status', '=', 'Alloted')
                ->get();

        $totphotodata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto,sum(file_price) as dtotphotoprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();
         
          $totqcpending[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcpending)
                ->get();
          
           $totqc[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcok)
                ->get();
            
             $totcompl[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $completed)
                ->get();
             $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();

             $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
         }
         $monthtitle=[];
         $monthtitle=['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];
         $mothdashboard="";
         for($i=0;$i<12;$i++){
         	$mothdashboard.="<div class='col-md-3'><div class='card'><table id='dashboardtab'><b align='center'>".$monthtitle[$i+1]." ".$year."</b>";
        if (auth()->user()->hasPermission('file.price.dashboard')) { 
         	$mothdashboard.="<tr><td><td>File</td><td>Revenue</td></tr><tr><td>Vector<td>".$totvectordata[$i][0]->totvect."</td><td>".$totvectordata[$i][0]->totvectprice."</td></tr><tr><td>Digitize<td>".$totdigitdata[$i][0]->totdigit."</td><td>".$totdigitdata[$i][0]->totdigitprice."</td></tr><tr><td>Image Editing<td>".$totphotodata[$i][0]->dtotphoto."</td><td>".$totphotodata[$i][0]->dtotphotoprice."</td></tr> <tr><td>Alloted<td>".$totalloted[$i][0]->totallot."</td><td>".$totalloted[$i][0]->totallotedprice."</td></tr><tr><td>QC-Pending <td>".$totqcpending[$i][0]->totqcpend."</td><td>".$totqcpending[$i][0]->totqcpendprice."</td></tr><tr><td>QC-OK<td>".$totqc[$i][0]->totqcok." </td><td>".$totqc[$i][0]->totqcokprice."</td></tr><tr><td>Completed<td>".$totcompl[$i][0]->totcompl."</td><td>".$totcompl[$i][0]->totcomplprice."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$totalchange[$i]."</td><td></td></tr></table></div></div>";
        }
        else{
            $mothdashboard.="<tr><td><td>File</td></tr><tr><td>Vector<td>".$totvectordata[$i][0]->totvect."</td></tr><tr><td>Digitize<td>".$totdigitdata[$i][0]->totdigit."</td></tr><tr><td>Image Editing<td>".$totphotodata[$i][0]->dtotphoto."</td></tr> <tr><td>Alloted<td>".$totalloted[$i][0]->totallot."</td></tr><tr><td>QC-Pending <td>".$totqcpending[$i][0]->totqcpend."</td></tr><tr><td>QC-OK<td>".$totqc[$i][0]->totqcok." </td></tr><tr><td>Completed<td>".$totcompl[$i][0]->totcompl."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$totalchange[$i]."</td><td></td></tr></table></div></div>";
        }    

         }
        return $mothdashboard;
   }
   public function graphmonthdashboard(Request $request){
   	$year=$request->year;
   	$type=$request->type;
    $totvectordata=[];
    $totdigitdata=[];
    $totalloted=[];
    $totqcpending=[]; 
    $totqc=[]; 
    $totcompl=[];
    $totphotodata=[];
    $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
     $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
     $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
     $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];               
        for($i=1;$i<13;$i++){
        	$month=$i;
        $totvectordata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereYear('bill_dt','=',$year)
                ->whereMonth('bill_dt','=',$month)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get(); 
        $cototvectordata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereYear('bill_dt','=',$year)
                ->whereMonth('bill_dt','=',$month)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $completed)
                ->get(); 

       // $totvectordata = collect($totvectordata);
        
        $totdigitdata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice,sum(vendor_digit_price) as vendordigitprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->wherein('status' , $stat)
                ->where('file_type', '=', 'Digitizing')
                ->get();

        $cototdigitdata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice,sum(vendor_digit_price) as vendordigitprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->wherein('status' , $completed)
                ->where('file_type', '=', 'Digitizing')
                ->get();
         
         $totalloted[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->where('status', '=', 'Alloted')
                ->get();

        $totphotodata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto,sum(file_price) as dtotphotoprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();

        $cototphotodata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto,sum(file_price) as dtotphotoprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $completed)
                ->get();
         
          $totqcpending[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcpending)
                ->get();

          
           $totqc[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $qcok)
                ->get();
            
             $totcompl[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->whereYear('bill_dt', '=',$year)
                ->whereMonth('bill_dt', '=', $month )
                ->wherein('status' , $completed)
                ->get();
            $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();

            $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
            }   

             $monthtitle=[];
         $monthtitle=['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];
    if (auth()->user()->hasPermission('file.price.dashboard')) {      
         if($type == "All"){
            $monthgraphdata='[["Month","Vector Completed File","Vector Completed Revenue","Digitize Completed File","Digitize Completed Revenue","Image Editing Completed File","Image Editing Completed Revenue","Completed File","Completed Revenue"],';
          }
          if($type == "Vector"){
             $monthgraphdata='[["Month","Vector Completed File","Vector Completed Revenue"],';
          }
          if($type == "Digitize"){
             $monthgraphdata='[["Month","Digitize Completed File","Digitize Completed Revenue","Vendor Completed File Cost"],';
          }
          if($type == "Alloted"){
             $monthgraphdata='[["Month","Alloted File","Alloted Revenue"],';
          }
          if($type == "QC-Pending"){
             $monthgraphdata='[["Month","QC-Pending File","QC-Pending Revenue"],';
          }
          if($type == "QC-OK"){
             $monthgraphdata='[["Month","QC-Ok File","QC-OK Revenue"],';
          }
          if($type == "Completed"){
             $monthgraphdata='[["Month","Completed File","Completed Revenue"],';
          }
          if($type == "Revision"){
             $monthgraphdata='[["Month","Revision File"],';
          }
          if($type == "Changes"){
             $monthgraphdata='[["Month","Changes File"],';
          }
                
                  
              
           for($i=0;$i<12;$i++){
           	if($totvectordata[$i][0]->totvect == null){
           		$totvectordata[$i][0]->totvect =0;
           	}
            if($totvectordata[$i][0]->totvectprice == null){
           		$totvectordata[$i][0]->totvectprice =0;
           	}
            if($cototvectordata[$i][0]->totvect == null){
                $cototvectordata[$i][0]->totvect =0;
            }
            if($cototvectordata[$i][0]->totvectprice == null){
                $cototvectordata[$i][0]->totvectprice =0;
            }
           	if($totdigitdata[$i][0]->totdigit == null){
           		$totdigitdata[$i][0]->totdigit =0;
           	}
           	if($totdigitdata[$i][0]->totdigitprice == null){
           		$totdigitdata[$i][0]->totdigitprice =0;
           	}
            if($totdigitdata[$i][0]->vendordigitprice == null){
              $totdigitdata[$i][0]->vendordigitprice =0;
            }
            if($cototdigitdata[$i][0]->totdigit == null){
                $cototdigitdata[$i][0]->totdigit =0;
            }
            if($cototdigitdata[$i][0]->totdigitprice == null){
                $cototdigitdata[$i][0]->totdigitprice =0;
            }
            if($cototdigitdata[$i][0]->vendordigitprice == null){
                $cototdigitdata[$i][0]->vendordigitprice =0;
            }
            if($totphotodata[$i][0]->dtotphoto == null){
              $totphotodata[$i][0]->dtotphoto =0;
            }
            if($totphotodata[$i][0]->dtotphotoprice == null){
              $totphotodata[$i][0]->dtotphotoprice =0;
            }
            if($cototphotodata[$i][0]->dtotphoto == null){
              $cototphotodata[$i][0]->dtotphoto =0;
            }
            if($cototphotodata[$i][0]->dtotphotoprice == null){
              $cototphotodata[$i][0]->dtotphotoprice =0;
            }
            if($totalloted[$i][0]->totallot == null){
           		$totalloted[$i][0]->totallot =0;
           	}
           	if($totalloted[$i][0]->totallotedprice == null){
           		$totalloted[$i][0]->totallotedprice =0;
           	}
            if($totqcpending[$i][0]->totqcpend == null){
              $totqcpending[$i][0]->totqcpend =0;
            }
            if($totqcpending[$i][0]->totqcpendprice == null){
              $totqcpending[$i][0]->totqcpendprice =0;
            }
            if($totqc[$i][0]->totqcok == null){
              $totqc[$i][0]->totqcok =0;
            }
            if($totqc[$i][0]->totqcokprice == null){
              $totqc[$i][0]->totqcokprice =0;
            }
            if($totcompl[$i][0]->totcompl == null){
              $totcompl[$i][0]->totcompl =0;
            }
            if($totcompl[$i][0]->totcomplprice == null){
              $totcompl[$i][0]->totcomplprice =0;
            }
           
            if($type == "All"){
             	if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototvectordata[$i][0]->totvect.','.$cototvectordata[$i][0]->totvectprice.','.$cototdigitdata[$i][0]->totdigit.','.$cototdigitdata[$i][0]->totdigitprice.','.$cototphotodata[$i][0]->dtotphoto.','.$cototphotodata[$i][0]->dtotphotoprice.','.$totcompl[$i][0]->totcompl.','.$totcompl[$i][0]->totcomplprice.']'; 
                 }
                 else{
                 	 $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototvectordata[$i][0]->totvect.','.$cototvectordata[$i][0]->totvectprice.','.$cototdigitdata[$i][0]->totdigit.','.$cototdigitdata[$i][0]->totdigitprice.','.$cototphotodata[$i][0]->dtotphoto.','.$cototphotodata[$i][0]->dtotphotoprice.','.$totcompl[$i][0]->totcompl.','.$totcompl[$i][0]->totcomplprice.'],';  
                 }
            }
            if($type == "Vector"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototvectordata[$i][0]->totvect.','.$cototvectordata[$i][0]->totvectprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototvectordata[$i][0]->totvect.','.$cototvectordata[$i][0]->totvectprice.'],';  
                 }
            }
            if($type == "Digitize"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototdigitdata[$i][0]->totdigit.','.$totdigitdata[$i][0]->totdigitprice.','.$totdigitdata[$i][0]->vendordigitprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$cototdigitdata[$i][0]->totdigit.','.$cototdigitdata[$i][0]->totdigitprice.','.$cototdigitdata[$i][0]->vendordigitprice.'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalloted[$i][0]->totallot.','.$totalloted[$i][0]->totallotedprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalloted[$i][0]->totallot.','.$totalloted[$i][0]->totallotedprice.'],';  
                 }
            }
            if($type == "QC-Pending"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqcpending[$i][0]->totqcpend.','.$totqcpending[$i][0]->totqcpendprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqcpending[$i][0]->totqcpend.','.$totqcpending[$i][0]->totqcpendprice.'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqc[$i][0]->totqcok.','.$totqc[$i][0]->totqcokprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqc[$i][0]->totqcok.','.$totqc[$i][0]->totqcokprice.'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totcompl[$i][0]->totcompl.','.$totcompl[$i][0]->totcomplprice.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totcompl[$i][0]->totcompl.','.$totcompl[$i][0]->totcomplprice.'],';  
                 }
            }
            if($type == "Revision"){
               if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].'],';  
                 }
            }
            if($type == "Changes"){
               if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].'],';  
                 }
            }
            
            } 
        }
        else{
            if($type == "All"){
            $monthgraphdata='[["Month","Vector File","Digitize File","Completed File"],';
          }
          if($type == "Vector"){
             $monthgraphdata='[["Month","Vector File"],';
          }
          if($type == "Digitize"){
             $monthgraphdata='[["Month","Digitize File"],';
          }
          if($type == "Alloted"){
             $monthgraphdata='[["Month","Alloted File"],';
          }
          if($type == "QC-Pending"){
             $monthgraphdata='[["Month","QC-Pending File"],';
          }
          if($type == "QC-OK"){
             $monthgraphdata='[["Month","QC-Ok File"],';
          }
          if($type == "Completed"){
             $monthgraphdata='[["Month","Completed File"],';
          }
          if($type == "Revision"){
             $monthgraphdata='[["Month","Revision File"],';
          }
          if($type == "Changes"){
             $monthgraphdata='[["Month","Changes File"],';
          }
                
                  
              
           for($i=0;$i<12;$i++){
            if($totvectordata[$i][0]->totvect == null){
                $totvectordata[$i][0]->totvect =0;
            }
           
            if($totdigitdata[$i][0]->totdigit == null){
                $totdigitdata[$i][0]->totdigit =0;
            }
        
            if($totalloted[$i][0]->totallot == null){
                $totalloted[$i][0]->totallot =0;
            }
            
            if($totqcpending[$i][0]->totqcpend == null){
              $totqcpending[$i][0]->totqcpend =0;
            }
            
            if($totqc[$i][0]->totqcok == null){
              $totqc[$i][0]->totqcok =0;
            }
           
            if($totcompl[$i][0]->totcompl == null){
              $totcompl[$i][0]->totcompl =0;
            }
            
           
            if($type == "All"){
                if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totvectordata[$i][0]->totvect.','.$totdigitdata[$i][0]->totdigit.','.$totcompl[$i][0]->totcompl.']'; 
                 }
                 else{
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totvectordata[$i][0]->totvect.','.$totdigitdata[$i][0]->totdigit.','.$totcompl[$i][0]->totcompl.'],';  
                 }
            }
            if($type == "Vector"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totvectordata[$i][0]->totvect.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totvectordata[$i][0]->totvect.'],';  
                 }
            }
            if($type == "Digitize"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totdigitdata[$i][0]->totdigit.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totdigitdata[$i][0]->totdigit.'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalloted[$i][0]->totallot.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalloted[$i][0]->totallot.'],';  
                 }
            }
            if($type == "QC-Pending"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqcpending[$i][0]->totqcpend.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqcpending[$i][0]->totqcpend.'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqc[$i][0]->totqcok.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totqc[$i][0]->totqcok.'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totcompl[$i][0]->totcompl.']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totcompl[$i][0]->totcompl.'],';  
                 }
            }
            if($type == "Revision"){
               if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].'],';  
                 }
            }
            if($type == "Changes"){
               if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].'],';  
                 }
            }
            
            } 
        }
                
               $monthgraphdata.=']';
           
            return Response([[$monthgraphdata],[$type],[$year]]); 

   }
   public function ajaxweekdashboard(Request $request){
   if($request->week == "Last Week"){
    $date =Carbon::today('America/New_York');
    $lastweekend=$date->subDays($date->dayOfWeek - 1);
   }
   if($request->week == "Current Week"){
    $date =Carbon::today('America/New_York');
    $lastweekend = $date->endOfWeek();
   
   }


    //weekly dashboard card show
        $weektotvectordata=[];
        $weektotdigitdata=[];
        $weektotalloted=[];
        $weektotqcpending=[]; 
        $weektotqc=[]; 
        $weektotcompl=[];
        $weektotalrevesion=[];
        $weektotalchange=[];
        $showdate=[];
        $showdatename=[];
        $weekphotodata=[];
        $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
        $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
        $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
        $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];

for($i=0; $i < 7; $i++){
    if($request->week == "Last Week"){
            $weekdate=$lastweekend->subDays(1);
    }
    else{
         $weekdate=$lastweekend->subDays($i);
    }


        $weektotvectordata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->whereDate('bill_dt','=',  $weekdate)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get(); 

        $weektotdigitdata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice'))
                 ->whereDate('bill_dt','=',$weekdate)
                 ->wherein('status' , $stat)
                ->where('file_type', '=', 'Digitizing')
                ->get();
        $weekphotodata[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto, sum(file_price) as dtotphotoprice'))
               ->whereDate('bill_dt','=', $weekdate)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();
         
        $weektotalloted[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                 ->whereDate('bill_dt','=',$weekdate)
                ->where('status', '=', 'Alloted')
                ->get();

        $weektotqcpending[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->whereDate('bill_dt','=',$weekdate)
                ->wherein('status' , $qcpending)
                ->get();
          
        $weektotqc[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                 ->whereDate('bill_dt','=',$weekdate)
                ->wherein('status' , $qcok)
                ->get();
        $weektotcompl[] = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->whereDate('bill_dt','=',$weekdate)
                ->wherein('status' , $completed)
                ->get();

        $weektotalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereDate('bill_dt','=', $weekdate)->where('file_reason.last_status','=','Revision')->count();

        $weektotalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereDate('bill_dt','=',$weekdate)->where('file_reason.last_status','=','Changes')->count();
        $showdate[]=$weekdate->toDateString();
         $showdatename[]=$weekdate->format('l');
        if($request->week == "Current Week"){
          $weekEndDate = $date->endOfWeek();
        }
     
    }
    $weekdashboard="";
   
        for($i=6;$i>=0;$i--){
          $weekdashboard.="<div class='col-md-3'><div class='card'><table id='dashboardtab'><b align='center'>".$showdate[$i]." (".$showdatename[$i].")</b>";
          if (auth()->user()->hasPermission('file.price.dashboard')) { 
   

                 $weekdashboard.="<tr><td><td>File</td><td>Revenue</td></tr><tr><td>Vector<td>".$weektotvectordata[$i][0]->totvect."</td><td>".$weektotvectordata[$i][0]->totvectprice."</td></tr><tr><td>Digitize<td>".$weektotdigitdata[$i][0]->totdigit."</td><td>".$weektotdigitdata[$i][0]->totdigitprice."</td></tr><tr><td>Image Editing<td>".$weekphotodata[$i][0]->dtotphoto."</td><td>".$weekphotodata[$i][0]->dtotphotoprice."</td></tr> <tr><td>Alloted<td>".$weektotalloted[$i][0]->totallot."</td><td>".$weektotalloted[$i][0]->totallotedprice."</td></tr><tr><td>QC-Pending <td>".$weektotqcpending[$i][0]->totqcpend."</td><td>".$weektotqcpending[$i][0]->totqcpendprice."</td></tr><tr><td>QC-OK<td>".$weektotqc[$i][0]->totqcok." </td><td>".$weektotqc[$i][0]->totqcokprice."</td></tr><tr><td>Completed<td>".$weektotcompl[$i][0]->totcompl."</td><td>".$weektotcompl[$i][0]->totcomplprice."</td></tr><tr><td>Revision<td>".$weektotalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$weektotalchange[$i]."</td><td></td></tr></table></div></div>";
        }
        else{
            $weekdashboard.="<tr><td><td>File</td></tr><tr><td>Vector<td>".$weektotvectordata[$i][0]->totvect."</td></tr><tr><td>Digitize<td>".$weektotdigitdata[$i][0]->totdigit."</td></tr><tr><td>Image Editing<td>".$weekphotodata[$i][0]->dtotphoto."</td></tr> <tr><td>Alloted<td>".$weektotalloted[$i][0]->totallot."</td></tr><tr><td>QC-Pending <td>".$weektotqcpending[$i][0]->totqcpend."</td></tr><tr><td>QC-OK<td>".$weektotqc[$i][0]->totqcok." </td><td>".$weektotqc[$i][0]->totqcokprice."</td></tr><tr><td>Completed<td>".$weektotcompl[$i][0]->totcompl."</td></tr><tr><td>Revision<td>".$weektotalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$weektotalchange[$i]."</td><td></td></tr></table></div></div>";
        }

         }
    
    
 
      return $weekdashboard; 
   }
}
