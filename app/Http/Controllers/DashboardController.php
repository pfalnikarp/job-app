<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
  public function weeklydashboard(){
    $date=Carbon::today('America/New_York');
    $now = Carbon::today('America/New_York');
    $weekStartDate = $date->startOfWeek();
    $weekEndDate = $now->endOfWeek();

    $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
    $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
    $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
    $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];

     $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->get();
    
     $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();
     for($i=0; $i < 7; $i++){
      $vfilecount=0;
      $vfileprice=0;
      $dfilecount=0;
      $dfileprice=0;
      $pfilecount=0;
      $pfileprice=0;
      $allotedfilecount=0;
      $allotedfileprice=0;
      $qcokfilecount=0;
      $qcokfileprice=0;
      $qcpendingfilecount=0;
      $qcpendingfileprice=0;
      $completedfilecount=0;
      $completedfileprice=0;
      $changecount=0;
      $revesioncount=0;
         $weekdate=$weekEndDate->subDays($i);
         $weekdate1=$weekdate->toDateString();
         foreach ($alls as $al) {
             
             if($al->file_type == 'Vector' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
               $vfilecount=$vfilecount+$al->file_count;
               $vfileprice=$vfileprice+$al->file_price;   
             }
             if($al->file_type == 'Digitizing' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
                 $dfilecount=$dfilecount+$al->file_count;
                 $dfileprice=$dfileprice+$al->file_price;   
              }
            if($al->file_type == 'Photoshop' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
               $pfilecount=$pfilecount+$al->file_count;
               $pfileprice=$pfileprice+$al->file_price;   
            }
            if($al->status == 'Alloted' && $al->bill_dt == $weekdate1){
              $allotedfilecount=$allotedfilecount+$al->file_count;
              $allotedfileprice=$allotedfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcok) && $al->bill_dt == $weekdate1){
              $qcokfilecount=$qcokfilecount+$al->file_count;
              $qcokfileprice=$qcokfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcpending) && $al->bill_dt == $weekdate1){
               $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
               $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
            }
            if(in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
              $completedfilecount=$completedfilecount+$al->file_count;
              $completedfileprice=$completedfileprice+$al->file_price;   
            }

         }
         $totalrevesion[]=$revesioncount;
         $totalchange[]=$changecount;
         $completedfile_count[]=$completedfilecount;
         $completedfile_price[]=$completedfileprice;
         $qcpendingfile_count[]=$qcpendingfilecount;
         $qcpendingfile_price[]=$qcpendingfileprice;
         $qcokfile_count[]=$qcokfilecount;
         $qcokfile_price[]=$qcokfileprice;
         $allotedfile_count[]=$allotedfilecount;
         $allotedfile_price[]=$allotedfileprice;
         $pfile_count[]=$pfilecount;
         $pfile_price[]=$pfileprice;
         $dfile_count[]=$dfilecount;
         $dfile_price[]=$dfileprice;
         $vfile_count[]=$vfilecount;
         $vfile_price[]=$vfileprice;

         $showdate[]=$weekdate->toDateString();
         $showdatename[]=$weekdate->format('l');
         $weekEndDate = $now->endOfWeek();

     }
    
    return view('dashboard.showweeklydashboard.view',compact('completedfile_count','completedfile_price','qcpendingfile_count','qcpendingfile_price','qcokfile_count','qcokfile_price','allotedfile_count','allotedfile_price','pfile_count','pfile_price','dfile_count','dfile_price','vfile_count','vfile_price','totalrevesion','totalchange','showdate','showdatename')); 
  }
  public function monthdashboard(){
   
$stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
$completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
$qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
$qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];
       
    //monthly dashboard card show data
   	   $us_time =Carbon::now('America/New_York');
       $year =Carbon::now('America/New_York')->format('Y');
       
        $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereYear('orders.bill_dt','=',$year)->get();
     $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();

$vfile_count=[];
$vfile_price=[];
$dfile_count=[];
$dfile_price=[];
$pfile_count=[];
$pfile_price=[];
$time_start = microtime(true); 
for($i=1;$i<13;$i++){
           $month=$i;
$vfilecount=0;
$vfileprice=0;
$dfilecount=0;
$dfileprice=0;
$pfilecount=0;
$pfileprice=0;
$allotedfilecount=0;
$allotedfileprice=0;
$qcokfilecount=0;
$qcokfileprice=0;
$qcpendingfilecount=0;
$qcpendingfileprice=0;
$completedfilecount=0;
$completedfileprice=0;
$changecount=0;
$revesioncount=0;
foreach ($alls as $al) {
 
          $byear = substr($al->bill_dt, 0, 4);
         $bmonth = substr($al->bill_dt, 5, 2);
        
       
         

   if($al->file_type == 'Vector' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $vfilecount=$vfilecount+$al->file_count;
            $vfileprice=$vfileprice+$al->file_price;   
     }

   
   if($al->file_type == 'Digitizing' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $dfilecount=$dfilecount+$al->file_count;
            $dfileprice=$dfileprice+$al->file_price;   
     }
   if($al->file_type == 'Photoshop' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $pfilecount=$pfilecount+$al->file_count;
            $pfileprice=$pfileprice+$al->file_price;   
     }
    if($al->status == 'Alloted' && $byear == $year && $bmonth == $month){
            $allotedfilecount=$allotedfilecount+$al->file_count;
            $allotedfileprice=$allotedfileprice+$al->file_price;   
     }
    if(in_array($al->status, $qcok) && $byear == $year && $bmonth == $month){
            $qcokfilecount=$qcokfilecount+$al->file_count;
            $qcokfileprice=$qcokfileprice+$al->file_price;   
     }
    if(in_array($al->status, $qcpending) && $byear == $year && $bmonth == $month){
            $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
            $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
     }
     if(in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $completedfilecount=$completedfilecount+$al->file_count;
            $completedfileprice=$completedfileprice+$al->file_price;   
     }

   }
   
   foreach($totalrevesions as $totalrevesionss){
     $revesionmonth = substr($totalrevesionss->bill_dt, 5, 2);
      if($revesionmonth == $month ) {
        $revesioncount=$revesioncount+1;
      }
     }
   // $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();

   foreach($totalchanges as $totalchangess){
     $changemonth = substr($totalchangess->bill_dt, 5, 2);
      if($changemonth == $month ) {
        $changecount=$changecount+1;
      }
     }
     
// ->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')
   // $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
   $totalrevesion[$i-1]=$revesioncount;
   $totalchange[$i-1]=$changecount;
   $completedfile_count[$i-1]=$completedfilecount;
   $completedfile_price[$i-1]=$completedfileprice;
   $qcpendingfile_count[$i-1]=$qcpendingfilecount;
   $qcpendingfile_price[$i-1]=$qcpendingfileprice;
   $qcokfile_count[$i-1]=$qcokfilecount;
   $qcokfile_price[$i-1]=$qcokfileprice;
   $allotedfile_count[$i-1]=$allotedfilecount;
   $allotedfile_price[$i-1]=$allotedfileprice;
   $pfile_count[$i-1]=$pfilecount;
   $pfile_price[$i-1]=$pfileprice;
   $dfile_count[$i-1]=$dfilecount;
   $dfile_price[$i-1]=$dfileprice;
   $vfile_count[$i-1]=$vfilecount;
   $vfile_price[$i-1]=$vfileprice;
}
    // $time_end = microtime(true);
    // $execution_time = ($time_end - $time_start);
    // dd($execution_time*1000);    
         $monthtitle=[];
         $monthtitle=['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];

        
   	return view('dashboard.showmonthlydashboard.view',compact('completedfile_count','completedfile_price','qcpendingfile_count','qcpendingfile_price','qcokfile_count','qcokfile_price','allotedfile_count','allotedfile_price','pfile_count','pfile_price','dfile_count','dfile_price','vfile_count','vfile_price','totalrevesion','totalchange','monthtitle','year'));
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
    $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereYear('orders.bill_dt','=',$year)->get();
     $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();

$vfile_count=[];
$vfile_price=[];
$dfile_count=[];
$dfile_price=[];
$pfile_count=[];
$pfile_price=[];
$time_start = microtime(true); 
for($i=1;$i<13;$i++){
           $month=$i;
$vfilecount=0;
$vfileprice=0;
$dfilecount=0;
$dfileprice=0;
$pfilecount=0;
$pfileprice=0;
$allotedfilecount=0;
$allotedfileprice=0;
$qcokfilecount=0;
$qcokfileprice=0;
$qcpendingfilecount=0;
$qcpendingfileprice=0;
$completedfilecount=0;
$completedfileprice=0;
$changecount=0;
$revesioncount=0;
foreach ($alls as $al) {
 
          $byear = substr($al->bill_dt, 0, 4);
         $bmonth = substr($al->bill_dt, 5, 2);
        
       
         

   if($al->file_type == 'Vector' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $vfilecount=$vfilecount+$al->file_count;
            $vfileprice=$vfileprice+$al->file_price;   
     }

   
   if($al->file_type == 'Digitizing' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $dfilecount=$dfilecount+$al->file_count;
            $dfileprice=$dfileprice+$al->file_price;   
     }
   if($al->file_type == 'Photoshop' && in_array($al->status, $stat) && $byear == $year && $bmonth == $month){
            $pfilecount=$pfilecount+$al->file_count;
            $pfileprice=$pfileprice+$al->file_price;   
     }
    if($al->status == 'Alloted' && $byear == $year && $bmonth == $month){
            $allotedfilecount=$allotedfilecount+$al->file_count;
            $allotedfileprice=$allotedfileprice+$al->file_price;   
     }
    if(in_array($al->status, $qcok) && $byear == $year && $bmonth == $month){
            $qcokfilecount=$qcokfilecount+$al->file_count;
            $qcokfileprice=$qcokfileprice+$al->file_price;   
     }
    if(in_array($al->status, $qcpending) && $byear == $year && $bmonth == $month){
            $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
            $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
     }
     if(in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $completedfilecount=$completedfilecount+$al->file_count;
            $completedfileprice=$completedfileprice+$al->file_price;   
     }

   }
   
   foreach($totalrevesions as $totalrevesionss){
     $revesionmonth = substr($totalrevesionss->bill_dt, 5, 2);
      if($revesionmonth == $month ) {
        $revesioncount=$revesioncount+1;
      }
     }
   // $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();

   foreach($totalchanges as $totalchangess){
     $changemonth = substr($totalchangess->bill_dt, 5, 2);
      if($changemonth == $month ) {
        $changecount=$changecount+1;
      }
     }
     
// ->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')
   // $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
   $totalrevesion[$i-1]=$revesioncount;
   $totalchange[$i-1]=$changecount;
   $completedfile_count[$i-1]=$completedfilecount;
   $completedfile_price[$i-1]=$completedfileprice;
   $qcpendingfile_count[$i-1]=$qcpendingfilecount;
   $qcpendingfile_price[$i-1]=$qcpendingfileprice;
   $qcokfile_count[$i-1]=$qcokfilecount;
   $qcokfile_price[$i-1]=$qcokfileprice;
   $allotedfile_count[$i-1]=$allotedfilecount;
   $allotedfile_price[$i-1]=$allotedfileprice;
   $pfile_count[$i-1]=$pfilecount;
   $pfile_price[$i-1]=$pfileprice;
   $dfile_count[$i-1]=$dfilecount;
   $dfile_price[$i-1]=$dfileprice;
   $vfile_count[$i-1]=$vfilecount;
   $vfile_price[$i-1]=$vfileprice;
}
         $monthtitle=[];
         $monthtitle=['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];
         $mothdashboard="";
         for($i=0;$i<12;$i++){
         	$mothdashboard.="<div class='col-md-3'><div class='card'><table id='dashboardtab'><b align='center'>".$monthtitle[$i+1]." ".$year."</b>";
        if (auth()->user()->hasPermission('file.price.dashboard')) { 
         	$mothdashboard.="<tr><td><td>File</td><td>Revenue</td></tr><tr><td>Vector<td>".$vfile_count[$i]."</td><td>".$vfile_price[$i]."</td></tr><tr><td>Digitize<td>".$dfile_count[$i]."</td><td>".$dfile_price[$i]."</td></tr><tr><td>Image Editing<td>".$pfile_count[$i]."</td><td>".$pfile_price[$i]."</td></tr> <tr><td>Alloted<td>".$allotedfile_count[$i]."</td><td>".$allotedfile_price[$i]."</td></tr><tr><td>QC-Pending <td>".$qcpendingfile_count[$i]."</td><td>".$qcpendingfile_price[$i]."</td></tr><tr><td>QC-OK<td>".$qcokfile_count[$i]." </td><td>".$qcokfile_price[$i]."</td></tr><tr><td>Completed<td>".$completedfile_count[$i]."</td><td>".$completedfile_price[$i]."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$totalchange[$i]."</td><td></td></tr></table></div></div>";
        }
        else{
            $mothdashboard.="<tr><td><td>File</td></tr><tr><td>Vector<td>".$vfile_count[$i]."</td></tr><tr><td>Digitize<td>".$dfile_count[$i]."</td></tr><tr><td>Image Editing<td>".$pfile_count[$i]."</td></tr> <tr><td>Alloted<td>".$allotedfile_count[$i]."</td></tr><tr><td>QC-Pending <td>".$qcpendingfile_count[$i]."</td></tr><tr><td>QC-OK<td>".$qcokfile_count[$i]." </td></tr><tr><td>Completed<td>".$completedfile_count[$i]."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
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
    $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereYear('orders.bill_dt','=',$year)->get();
    if($type == "Changes"){
     $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
    }
    if($type == "Revision"){
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();
    }

$vfile_count=[];
$vfile_price=[];
$dfile_count=[];
$dfile_price=[];
$pfile_count=[];
$pfile_price=[];
$time_start = microtime(true); 
for($i=1;$i<13;$i++){
           $month=$i;
$vfilecount=0;
$vfileprice=0;
$dfilecount=0;
$dfileprice=0;
$pfilecount=0;
$pfileprice=0;
$allotedfilecount=0;
$allotedfileprice=0;
$qcokfilecount=0;
$qcokfileprice=0;
$qcpendingfilecount=0;
$qcpendingfileprice=0;
$completedfilecount=0;
$completedfileprice=0;
$changecount=0;
$revesioncount=0;
foreach ($alls as $al) {
 
          $byear = substr($al->bill_dt, 0, 4);
         $bmonth = substr($al->bill_dt, 5, 2);
        
       
         

   if($al->file_type == 'Vector' && in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $vfilecount=$vfilecount+$al->file_count;
            $vfileprice=$vfileprice+$al->file_price;   
     }

   
   if($al->file_type == 'Digitizing' && in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $dfilecount=$dfilecount+$al->file_count;
            $dfileprice=$dfileprice+$al->file_price;   
     }
   if($al->file_type == 'Photoshop' && in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $pfilecount=$pfilecount+$al->file_count;
            $pfileprice=$pfileprice+$al->file_price;   
     }
 if($type == "Alloted"){
    if($al->status == 'Alloted' && $byear == $year && $bmonth == $month){
            $allotedfilecount=$allotedfilecount+$al->file_count;
            $allotedfileprice=$allotedfileprice+$al->file_price;   
     }
 }
    if(in_array($al->status, $qcok) && $byear == $year && $bmonth == $month){
            $qcokfilecount=$qcokfilecount+$al->file_count;
            $qcokfileprice=$qcokfileprice+$al->file_price;   
     }
 if($type == "QC-Pending"){
    if(in_array($al->status, $qcpending) && $byear == $year && $bmonth == $month){
            $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
            $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
     }
 }
 if($type == "Completed" || $type == "All" ){
     if(in_array($al->status, $completed) && $byear == $year && $bmonth == $month){
            $completedfilecount=$completedfilecount+$al->file_count;
            $completedfileprice=$completedfileprice+$al->file_price;   
     }
 }

   }
if($type == "Revision"){
   foreach($totalrevesions as $totalrevesionss){
     $revesionmonth = substr($totalrevesionss->bill_dt, 5, 2);
      if($revesionmonth == $month ) {
        $revesioncount=$revesioncount+1;
      }
     }
 }
   // $totalrevesion[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Revision')->count();
if($type == "Changes"){
   foreach($totalchanges as $totalchangess){
     $changemonth = substr($totalchangess->bill_dt, 5, 2);
      if($changemonth == $month ) {
        $changecount=$changecount+1;
      }
     }
} 
// ->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')
   // $totalchange[]=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereYear('orders.bill_dt','=',$year)->whereMonth('orders.bill_dt','=',$month)->where('file_reason.last_status','=','Changes')->count();
   $totalrevesion[$i-1]=$revesioncount;
   $totalchange[$i-1]=$changecount;
   $completedfile_count[$i-1]=$completedfilecount;
   $completedfile_price[$i-1]=$completedfileprice;
   $qcpendingfile_count[$i-1]=$qcpendingfilecount;
   $qcpendingfile_price[$i-1]=$qcpendingfileprice;
   $qcokfile_count[$i-1]=$qcokfilecount;
   $qcokfile_price[$i-1]=$qcokfileprice;
   $allotedfile_count[$i-1]=$allotedfilecount;
   $allotedfile_price[$i-1]=$allotedfileprice;
   $pfile_count[$i-1]=$pfilecount;
   $pfile_price[$i-1]=$pfileprice;
   $dfile_count[$i-1]=$dfilecount;
   $dfile_price[$i-1]=$dfileprice;
   $vfile_count[$i-1]=$vfilecount;
   $vfile_price[$i-1]=$vfileprice;
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
           
           
            if($type == "All"){
             	if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].','.$dfile_count[$i].','.$dfile_price[$i].','.$pfile_count[$i].','.$pfile_price[$i].','.$completedfile_count[$i].','.$completedfile_price[$i].']'; 
                 }
                 else{

                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].','.$dfile_count[$i].','.$dfile_price[$i].','.$pfile_count[$i].','.$pfile_price[$i].','.$completedfile_count[$i].','.$completedfile_price[$i].'],'; 
                 	 
                 }
            }
            if($type == "Vector"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].']'; 
                 }
                 else{

                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].'],'; 
                    
                 }
            }
            if($type == "Digitize"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].','.$dfile_price[$i].','.$dfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].','.$dfile_price[$i].','.$dfile_price[$i].'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].','.$allotedfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].','.$allotedfile_price[$i].'],';   
                 }
            }
            if($type == "QC-Pending"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].','.$qcpendingfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].','.$qcpendingfile_price[$i].'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 11){
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].','.$qcokfile_price[$i].']';  
                 }
                 else{
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].','.$qcokfile_price[$i].'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 11){
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].','.$completedfile_price[$i].']'; 
                 }
                 else{
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].','.$completedfile_price[$i].'],';  
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
            
            if($type == "All"){
                if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$dfile_count[$i].','.$pfile_count[$i].']'; 
                 }
                 else{
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$dfile_count[$i].','.$pfile_count[$i].'],';  
                 }
            }
            if($type == "Vector"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].'],';  
                 }
            }
            if($type == "Digitize"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].'],';  
                 }
            }
            if($type == "QC-Pending"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 11){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].'],';  
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
    $now =Carbon::today('America/New_York');
    $date=$date->subDays($date->dayOfWeek);
    $now=$now->subDays($now->dayOfWeek);
    $weekStartDate = $date->startOfWeek();
    $weekEndDate = $now->endOfWeek();
   }
   if($request->week == "Current Week"){
    $date =Carbon::today('America/New_York');
    $now = Carbon::today('America/New_York');
    $weekStartDate = $date->startOfWeek();
    $weekEndDate = $now->endOfWeek();
  }

    //weekly dashboard card show
        $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
    $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
    $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
    $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];

    $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->get();

    $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();
     for($i=0; $i < 7; $i++){
      
      $vfilecount=0;
      $vfileprice=0;
      $dfilecount=0;
      $dfileprice=0;
      $pfilecount=0;
      $pfileprice=0;
      $allotedfilecount=0;
      $allotedfileprice=0;
      $qcokfilecount=0;
      $qcokfileprice=0;
      $qcpendingfilecount=0;
      $qcpendingfileprice=0;
      $completedfilecount=0;
      $completedfileprice=0;
      $changecount=0;
      $revesioncount=0;
       $weekdate=$weekEndDate->subDays($i);
       $weekdate1=$weekdate->toDateString();
         foreach ($alls as $al) {
             
             if($al->file_type == 'Vector' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
               $vfilecount=$vfilecount+$al->file_count;
               $vfileprice=$vfileprice+$al->file_price;   
             }
             if($al->file_type == 'Digitizing' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
                 $dfilecount=$dfilecount+$al->file_count;
                 $dfileprice=$dfileprice+$al->file_price;   
              }
            if($al->file_type == 'Photoshop' && in_array($al->status, $stat) && $al->bill_dt == $weekdate1){
               $pfilecount=$pfilecount+$al->file_count;
               $pfileprice=$pfileprice+$al->file_price;   
            }
            if($al->status == 'Alloted' && $al->bill_dt == $weekdate1){
              $allotedfilecount=$allotedfilecount+$al->file_count;
              $allotedfileprice=$allotedfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcok) && $al->bill_dt == $weekdate1){
              $qcokfilecount=$qcokfilecount+$al->file_count;
              $qcokfileprice=$qcokfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcpending) && $al->bill_dt == $weekdate1){
               $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
               $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
            }
            if(in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
              $completedfilecount=$completedfilecount+$al->file_count;
              $completedfileprice=$completedfileprice+$al->file_price;   
            }

         }
         $totalrevesion[]=$revesioncount;
         $totalchange[]=$changecount;
         $completedfile_count[]=$completedfilecount;
         $completedfile_price[]=$completedfileprice;
         $qcpendingfile_count[]=$qcpendingfilecount;
         $qcpendingfile_price[]=$qcpendingfileprice;
         $qcokfile_count[]=$qcokfilecount;
         $qcokfile_price[]=$qcokfileprice;
         $allotedfile_count[]=$allotedfilecount;
         $allotedfile_price[]=$allotedfileprice;
         $pfile_count[]=$pfilecount;
         $pfile_price[]=$pfileprice;
         $dfile_count[]=$dfilecount;
         $dfile_price[]=$dfileprice;
         $vfile_count[]=$vfilecount;
         $vfile_price[]=$vfileprice;

        $showdate[]=$weekdate->toDateString();
         $showdatename[]=$weekdate->format('l');
         $weekEndDate = $now->endOfWeek();

     }
    $weekdashboard="";
   
        for($i=6;$i>=0;$i--){
          $weekdashboard.="<div class='col-md-3'><div class='card'><table id='dashboardtab'><b align='center'>".$showdate[$i]." (".$showdatename[$i].")</b>";
          if (auth()->user()->hasPermission('file.price.dashboard')) { 
   

                 $weekdashboard.="<tr><td><td>File</td><td>Revenue</td></tr><tr><td>Vector<td>".$vfile_count[$i]."</td><td>".$vfile_price[$i]."</td></tr><tr><td>Digitize<td>".$dfile_count[$i]."</td><td>".$dfile_price[$i]."</td></tr><tr><td>Image Editing<td>".$pfile_count[$i]."</td><td>".$pfile_price[$i]."</td></tr> <tr><td>Alloted<td>".$allotedfile_count[$i]."</td><td>".$allotedfile_price[$i]."</td></tr><tr><td>QC-Pending <td>".$qcpendingfile_count[$i]."</td><td>".$qcpendingfile_price[$i]."</td></tr><tr><td>QC-OK<td>".$qcokfile_count[$i]." </td><td>".$qcokfile_price[$i]."</td></tr><tr><td>Completed<td>".$completedfile_count[$i]."</td><td>".$completedfile_price[$i]."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$totalchange[$i]."</td><td></td></tr></table></div></div>";
        }
        else{
            $weekdashboard.="<tr><td><td>File</td></tr><tr><td>Vector<td>".$vfile_count[$i]."</td></tr><tr><td>Digitize<td>".$dfile_count[$i]."</td></tr><tr><td>Image Editing<td>".$pfile_count[$i]."</td></tr> <tr><td>Alloted<td>".$allotedfile_count[$i]."</td></tr><tr><td>QC-Pending <td>".$qcpendingfile_count[$i]."</td></tr><tr><td>QC-OK<td>".$qcokfile_count[$i]." </td></tr><tr><td>Completed<td>".$completedfile_count[$i]."</td></tr><tr><td>Revision<td>".$totalrevesion[$i]."</td><td> </td></tr>
            <tr><td>Changes<td>".$totalchange[$i]."</td><td></td></tr></table></div></div>";
        }

         }
    
    
 
      return $weekdashboard; 
   }
   public function graphweeklydashboard(Request $request){
    $type=$request->type;
    $weekname=$request->week;
     if($request->week == "Last Week"){
    $date =Carbon::today('America/New_York');
    $now =Carbon::today('America/New_York');
    $date=$date->subDays($date->dayOfWeek);
    $now=$now->subDays($now->dayOfWeek);
    $weekStartDate = $date->startOfWeek();
    $weekEndDate = $now->endOfWeek();
   }
   if($request->week == "Current Week"){
    $date =Carbon::today('America/New_York');
    $now = Carbon::today('America/New_York');
    $weekStartDate = $date->startOfWeek();
    $weekEndDate = $now->endOfWeek();

   
   }
   
  

    //weekly dashboard card show
        $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;
    $completed=['Completed' =>'Completed','Ch-Completed' => 'Ch-Completed','Rev-Completed' => 'Rev-Completed'];
    $qcok=['QC OK'=>'QC OK','Rev-QC OK'=>'Rev-QC OK','Ch-QC OK'=>'Ch-QC OK'];
    $qcpending=['QC Pending' =>'QC Pending','Rev-QC Pending'=>'Rev-QC Pending','Ch-QC Pending'=>'Ch-QC Pending'];
 
    $alls=DB::table('orders')->select('file_count','file_price','file_type','status','bill_dt')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->get();

    $totalchanges=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Changes')->select('bill_dt')->get();
     $totalrevesions=DB::table('file_reason')->leftJoin('orders','file_reason.order_id','=','orders.order_id')->whereBetween('orders.bill_dt', [$weekStartDate->toDateString(),$weekEndDate->toDateString()])->where('file_reason.last_status','=','Revision')->select('bill_dt')->get();
     
     for($i=6; $i >= 0; $i--){
      
      $vfilecount=0;
      $vfileprice=0;
      $dfilecount=0;
      $dfileprice=0;
      $pfilecount=0;
      $pfileprice=0;
      $allotedfilecount=0;
      $allotedfileprice=0;
      $qcokfilecount=0;
      $qcokfileprice=0;
      $qcpendingfilecount=0;
      $qcpendingfileprice=0;
      $completedfilecount=0;
      $completedfileprice=0;
      $changecount=0;
      $revesioncount=0;
         $weekdate=$weekEndDate->subDays($i);
         $weekdate1=$weekdate->toDateString();
         foreach ($alls as $al) {
             
             if($al->file_type == 'Vector' && in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
               $vfilecount=$vfilecount+$al->file_count;
               $vfileprice=$vfileprice+$al->file_price;   
             }
             if($al->file_type == 'Digitizing' && in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
                 $dfilecount=$dfilecount+$al->file_count;
                 $dfileprice=$dfileprice+$al->file_price;   
              }
            if($al->file_type == 'Photoshop' && in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
               $pfilecount=$pfilecount+$al->file_count;
               $pfileprice=$pfileprice+$al->file_price;   
            }
            if($al->status == 'Alloted' && $al->bill_dt == $weekdate1){
              $allotedfilecount=$allotedfilecount+$al->file_count;
              $allotedfileprice=$allotedfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcok) && $al->bill_dt == $weekdate1){
              $qcokfilecount=$qcokfilecount+$al->file_count;
              $qcokfileprice=$qcokfileprice+$al->file_price;   
            }
            if(in_array($al->status, $qcpending) && $al->bill_dt == $weekdate1){
               $qcpendingfilecount=$qcpendingfilecount+$al->file_count;
               $qcpendingfileprice=$qcpendingfileprice+$al->file_price;   
            }
            if(in_array($al->status, $completed) && $al->bill_dt == $weekdate1){
              $completedfilecount=$completedfilecount+$al->file_count;
              $completedfileprice=$completedfileprice+$al->file_price;   
            }

         }
         $totalrevesion[]=$revesioncount;
         $totalchange[]=$changecount;
         $completedfile_count[]=$completedfilecount;
         $completedfile_price[]=$completedfileprice;
         $qcpendingfile_count[]=$qcpendingfilecount;
         $qcpendingfile_price[]=$qcpendingfileprice;
         $qcokfile_count[]=$qcokfilecount;
         $qcokfile_price[]=$qcokfileprice;
         $allotedfile_count[]=$allotedfilecount;
         $allotedfile_price[]=$allotedfileprice;
         $pfile_count[]=$pfilecount;
         $pfile_price[]=$pfileprice;
         $dfile_count[]=$dfilecount;
         $dfile_price[]=$dfileprice;
         $vfile_count[]=$vfilecount;
         $vfile_price[]=$vfileprice;

        $showdate[]=$weekdate->toDateString();
        $showdatename[]=$weekdate->format('l');
        $weekEndDate = $now->endOfWeek();

     }
     
    $monthtitle=[];
         $monthtitle=['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'];

    if (auth()->user()->hasPermission('file.price.dashboard')) {      
         if($type == "All"){
            $monthgraphdata='[["Week","Vector Completed File","Vector Completed Revenue","Digitize Completed File","Digitize Completed Revenue","Image Editing Completed File","Image Editing Completed Revenue","Completed File","Completed Revenue"],';
          }
        
          if($type == "Vector"){
             $monthgraphdata='[["Week","Vector Completed File","Vector Completed Revenue"],';
          }
          if($type == "Digitize"){
             $monthgraphdata='[["Week","Digitize Completed File","Digitize Completed Revenue","Vendor Completed File Cost"],';
          }
          if($type == "Alloted"){
             $monthgraphdata='[["Week","Alloted File","Alloted Revenue"],';
          }
          if($type == "QC-Pending"){
             $monthgraphdata='[["Week","QC-Pending File","QC-Pending Revenue"],';
          }
          if($type == "QC-OK"){
             $monthgraphdata='[["Week","QC-Ok File","QC-OK Revenue"],';
          }
          if($type == "Completed"){
             $monthgraphdata='[["Week","Completed File","Completed Revenue"],';
          }
          if($type == "Revision"){
             $monthgraphdata='[["Week","Revision File"],';
          }
          if($type == "Changes"){
             $monthgraphdata='[["Week","Changes File"],';
          }
                
                  
              
           for($i=0;$i<7;$i++){
           
           
            if($type == "All"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].','.$dfile_count[$i].','.$dfile_price[$i].','.$pfile_count[$i].','.$pfile_price[$i].','.$completedfile_count[$i].','.$completedfile_price[$i].']'; 
                 }
                 else{

                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].','.$dfile_count[$i].','.$dfile_price[$i].','.$pfile_count[$i].','.$pfile_price[$i].','.$completedfile_count[$i].','.$completedfile_price[$i].'],'; 
                   
                 }
            }

            if($type == "Vector"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].']'; 
                 }
                 else{

                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$vfile_price[$i].'],'; 
                    
                 }
            }
            if($type == "Digitize"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].','.$dfile_price[$i].','.$dfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].','.$dfile_price[$i].','.$dfile_price[$i].'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].','.$allotedfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].','.$allotedfile_price[$i].'],';   
                 }
            }
            if($type == "QC-Pending"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].','.$qcpendingfile_price[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].','.$qcpendingfile_price[$i].'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 6){
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].','.$qcokfile_price[$i].']';  
                 }
                 else{
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].','.$qcokfile_price[$i].'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 6){
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].','.$completedfile_price[$i].']'; 
                 }
                 else{
                    $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].','.$completedfile_price[$i].'],';  
                 }
            }
            if($type == "Revision"){
               if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].'],';  
                 }
            }
            if($type == "Changes"){
               if($i == 6){
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
            $monthgraphdata='[["Week","Vector File","Digitize File","Completed File"],';
          }
          if($type == "Vector"){
             $monthgraphdata='[["Week","Vector File"],';
          }
          if($type == "Digitize"){
             $monthgraphdata='[["Week","Digitize File"],';
          }
          if($type == "Alloted"){
             $monthgraphdata='[["Week","Alloted File"],';
          }
          if($type == "QC-Pending"){
             $monthgraphdata='[["Week","QC-Pending File"],';
          }
          if($type == "QC-OK"){
             $monthgraphdata='[["Week","QC-Ok File"],';
          }
          if($type == "Completed"){
             $monthgraphdata='[["Week","Completed File"],';
          }
          if($type == "Revision"){
             $monthgraphdata='[["Week","Revision File"],';
          }
          if($type == "Changes"){
             $monthgraphdata='[["Week","Changes File"],';
          }
                
                  
              
           for($i=0;$i<7;$i++){
            
            if($type == "All"){
                if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$dfile_count[$i].','.$pfile_count[$i].']'; 
                 }
                 else{
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].','.$dfile_count[$i].','.$pfile_count[$i].'],';  
                 }
            }
            if($type == "Vector"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$vfile_count[$i].'],';  
                 }
            }
            if($type == "Digitize"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$dfile_count[$i].'],';  
                 }
            }
            if($type == "Alloted"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$allotedfile_count[$i].'],';  
                 }
            }
            if($type == "QC-Pending"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcpendingfile_count[$i].'],';  
                 }
            }
            if($type == "QC-OK"){
              if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$qcokfile_count[$i].'],';  
                 }
            }
            if($type == "Completed"){
              if($i == 7){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$completedfile_count[$i].'],';  
                 }
            }
            if($type == "Revision"){
               if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalrevesion[$i].'],';  
                 }
            }
            if($type == "Changes"){
               if($i == 6){
                     $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].']'; 
                 }
                 else{
                   $monthgraphdata.='["'.$monthtitle[$i+1].'",'.$totalchange[$i].'],';  
                 }
            }
            
            } 
        }
                
               $monthgraphdata.=']';
           
            return Response([[$monthgraphdata],[$type],[$weekname]]); 

   }
}
