<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Order ;
use App\Models\Order_Status ;
use App\Models\Vendor ;
use App\Models\User ;
use App\Models\FailedLoginAttempt ;


use App\Models\Role;

use App\Models\Permission;
//use Ntrust;
use LRedis;

class CreateChartController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    

       public function index()
    {
       
      //    $user1 = Auth::user()->name;
     
      // $user = User::where('name', '=', $user1)->first();

      

      // if (Auth::user()->hasRole('Designer')) {
          
      //           $role = Role::where('name','=', 'Designer')->get();

      //     }
      
      // if (Auth::user()->can(['order-create','order-update','order-delete','order-view'])) 
        

      //     {
            
      //         if(isset($role->id)) {
      //               $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

      //               ->where("permission_role.role_id",$role->id)

      //               ->get();
      //               $rolePermissions = $rolePermissions->toArray();
      //             }

      //     $perms = DB::table('permissions')
      //               ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
      //               ->join('users', function($join)
      //                 {
      //                   $join->on('users.id', '=', 'permission_user.user_id')
      //                   ->where('users.id', '=', Auth::user()->id);
      //                 })
      //                 ->select('permissions.*')
      //                 ->get();  

             

      //         foreach ($perms as $key ) {
                      
      //                 $rights1[] =$key;
      //               }    
                    
      //               if(!empty($rolePermissions))  {
      //               foreach ($rolePermissions as $key ) {
                     
      //                 $rights2[] =$key;
      //               }    
      //             }
                
      //           if(!empty($rights2)) {
      //               $rights = array_merge($rights1, $rights2);
      //              }
      //              else {
      //                     $rights = $rights1 ;
      //              }

                
      //           $users = User::pluck('name', 'name');   
       
      //           $order=Order::first();
               
      //           $status = Order_Status::pluck('status', 'status');  
      //           $vendors = Vendor::pluck('name', 'name');
        
      //           return view('orders.index',compact('order','users',  'status','perms','rights','vendors'));
      //       }

      // else {
             
      //                    return view('errors.403');
      //       }      

        

          $output =  '';

                $us_time = Carbon::now('America/New_York');

                $cdt =  Carbon::now();
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
         
                $cdt =  date_format($cdt, 'Y-m-d');

                $us_time =  date_format($us_time, 'Y-m-d');

                $time_add      = $us_time + (3600*24); //add seconds of one day
 
                $new_date      = date("Y-m-d H:i:s", $time_add);


                $orders = DB::table('orders')
                ->select(DB::raw('DATE_FORMAT(order_us_date, "%Y%m") as name')  , DB::raw('count(*) as data'))
                //->where('bill_dt', '=', $us_time)
                // ->where('bill_dt', '<=', $new_date)
                // ->where('status', '=', 'Completed')
                //->where('file_type', '=', 'Vector')
                ->groupBy('name')
                ->get();

                $orders = collect($orders);
                //dd($orders);
                $i=0;
                foreach ($orders as $value) {
                      $orders1[$i]["name"] = $value->name ;
                      $orders2[$i]["data"] =  array($value->data) ;
                      $i++;
                 }

                 $orders1 = array_column($orders1, 'name');  
                 $orders2 = array_column($orders2, 'data');  
                // dd($orders1);

                
    //            SELECT DISTINCT allocation, sum(file_price) as file_price1   FROM 
    ///`client_access_tab` where  DATE_FORMAT(edt_time, '%Y-%m-%d') between DATE_FORMAT((CURDATE() - INTERVAL 400 DAY), '%Y %m %d') and  DATE_FORMAT(CURDATE(), '%Y %m %d')  and status in ('Completed', 'Allotted','Revision','Approved') and status not in  ('Quote', 'Unapproved','Requote','Followup','Complain','Cancel','On Hold','No Response') and file_type != 'Digitizing' 
    // and file_price <> 0
    //and allocation <> '' group by allocation
                
                //dd(date('Y-m-d', strtotime('-45days'))); 

                $mnthprice = DB::table('orders')
                    ->select(DB::raw('DATE_FORMAT(order_us_date, "%Y%m")  as usdate, sum(file_price) as fprice'))
                    ->where('file_price', '>', 0)
                    ->where('order_date_time', '>=', date('Y-m-d', strtotime('-365days')))
                    ->where('order_date_time', '<=', date('Y-m-d'))
                    ->whereNotIn('status', ['Quote','Unapproved','Requote','Followup','Complain','Cancel','On Hold','No Response'])
                    ->groupBy(DB::raw("DATE_FORMAT(order_us_date, '%Y%m')"))->get();
                   // ->groupBy('DATE_FORMAT(order_us_date, "%Y%m")')->get();


                //dd($mnthprice);die;


                 $allocs = DB::table('orders')
                    ->select(DB::raw('DISTINCT allocation, sum(file_price) as file_price'))
                    ->where('allocation', '<>', '')
                    ->where('order_date_time', '>=', date('Y-m-d', strtotime('-45days')))
                    ->where('order_date_time', '<=', date('Y-m-d'))
                    ->groupBy('allocation')->get();
                     //->sum('file_price')->get();
                     
                if (count($allocs) <= 0  )     
                {
                    // dd($allocs);
                        $allocs = DB::table('orders')
                    ->select(DB::raw('DISTINCT allocation, sum(file_price) as file_price'))
                    ->where('allocation', '<>', '')
                    ->where('order_date_time', '>=', date('Y-m-d', strtotime('-45days')))
                    ->where('order_date_time', '<=', date('Y-m-d'))
                    ->groupBy('allocation')->get();
                
                }

               
                

                $i=0;
                foreach ($allocs as $value) {
                      $allocs1[$i]["name"] =  $value->allocation ;
                      $allocs2[$i]["y"] =  array($value->file_price) ;
                      $i++;
                 }
                 
                // dd(preg_replace(',', '', $allocs1));
                 $allocs1 = array_column($allocs1, 'name');  
                 $allocs2 = array_column($allocs2, 'y');  

                 foreach ($allocs as $value) {
                        $row[0]['name'] = (string)$value->allocation ;
                        $row[1]['y'] =  $value->file_price ;
    
                        $rows[] = $row ;

                        //$chartArray ["series"] [] = array (
                         //  "name" => (string)$value->allocation ,
                         //  "data" => $value->file_price 
                                     //         ); 

                        $chartArray[] = array (
                           "name" => $value->allocation ,
                           "data" => array((int)$value->file_price )); 

                         $chartArraypie[] = array (
                           "name" => $value->allocation ,
                           "y" => (int)$value->file_price ); 

                    }

                 
                // ->select(DB::raw('id,allocation'))
                //-> sum('file_price')
                //->where('allocation','<>', '')
                // '%Y %m %d'))
                //  ->where( DATE_FORMAT('edt_time', '%Y-%m-%d'), '<=', DATE_FORMAT(CURDATE(), '%Y %m %d'))->where( DATE_FORMAT('edt_time', '%Y-%m-%d'), '>=', DATE_FORMAT((CURDATE() - $intv), 
                //->groupBy('id')->get();

                // $chartArray ["chart"] = array (
                //                 "type" => "line" 
                //                 );
                // $chartArray ["title"] = array (
                //         "text" => "Yearly sales" 
                //         );

                // $chartArray ["credits"] = array (
                //             "enabled" => false 
                //         );
                
                // $chartArray ["xAxis"] = array (
                //         "categories" => array () 
                //         );

                // $chartArray ["tooltip"] = array (
                //         "valueSuffix" => "$" 
                // );

             

                // $chartArray ["yAxis"] = array (
                //     "title" => array (
                //     "text" => "Sales ( $ )" 
                //     ) 
                // );

                $neworders = DB::table('orders_view')
                    ->select(DB::raw('DISTINCT client_name, count(*) as totord, sum(file_price) as file_price'))
                    ->where('allocation', '<>', '')
                    ->whereNotIn('status',  ['Completed', 'Allotted','Revision','Approved'])
                    ->where('order_date_time', '>=', date('Y-m-d', strtotime('-10days')))
                    ->where('order_date_time', '<=', date('Y-m-d'))
                    ->groupBy('client_name')->get();       

                 $i=0;
                
                
                $neworders = collect($neworders) ; 
                

                if (count($neworders)>0) {

                foreach ($neworders as $value) {
                      $new1[$i]["name"] =  $value->client_name ;
                      $new2[$i]["data"] =  array($value->file_price) ;
                        $i++;
                      $new3[] = array (
                           "name" => $value->client_name ,
                           "y" => (int)$value->file_price ); 
                    
                 }
                  
                 $new1 = array_column($new1, 'name'); 
                 $new2 = array_column($new2, 'data'); 
             }
                 

          if(isset($new2)) {
              return view('admins.index')->with('orders1', json_encode($orders1,JSON_NUMERIC_CHECK))
                               ->with('orders2', json_encode($orders2,JSON_NUMERIC_CHECK))
                               ->with('allocs1', json_encode($allocs1))
                               ->with('allocs2', json_encode($allocs2,JSON_NUMERIC_CHECK))
                                ->with('new1', json_encode($new1,JSON_NUMERIC_CHECK))
                                ->with('new2', json_encode($new2,JSON_NUMERIC_CHECK))
                                ->with('new3', $new3)
                                ->with('rows', json_encode($rows, JSON_NUMERIC_CHECK))
                                ->with('chartArray', $chartArray)
                                ->with('chartArraypie', $chartArraypie);
            }
        else {

             return view('admins.index')->with('orders1', json_encode($orders1,JSON_NUMERIC_CHECK))
                               ->with('orders2', json_encode($orders2,JSON_NUMERIC_CHECK))
                               ->with('allocs1', json_encode($allocs1))
                               ->with('allocs2', json_encode($allocs2,JSON_NUMERIC_CHECK))
                                ->with('rows', json_encode($rows, JSON_NUMERIC_CHECK))
                                ->with('chartArray', $chartArray)
                                ->with('chartArraypie', $chartArraypie);

        }

    }
    

    public function CreatePieChart()
    {
        
            $neworders = DB::table('orders2017')
                    ->select(DB::raw('DISTINCT client_name, count(*) as totord, sum(file_price) as file_price'))
                    ->where('allocation', '<>', '')
                    ->whereNotIn('status',  ['Completed', 'Allotted','Revision','Approved'])
                    ->where('order_date_time', '>=', date('Y-m-d', strtotime('-30days')))
                    ->where('order_date_time', '<=', date('Y-m-d'))
                    ->groupBy('client_name')->get();       

                 $i=0;
                foreach ($neworders as $value) {
                      $new1[$i]["name"] =  $value->client_name ;
                      $new2[$i]["data"] =  array($value->file_price) ;
                        $i++;
                      $new3[] = array (
                           "name" => $value->client_name ,
                           "y" => (int)$value->file_price ); 
                    
                 }

                $new1 = array_column($new1, 'name');
                $new2 = array_column($new2, 'data'); 


                  return view('mcharts')->with('new1', json_encode($new1,JSON_NUMERIC_CHECK))
                                ->with('new2', json_encode($new2,JSON_NUMERIC_CHECK))
                                ->with('new3', $new3);
                                

    }




     public function searchVector(Request $request = null)
     {
                $output =  '';

                $us_time = Carbon::now('America/New_York');

                $cdt =  Carbon::now();
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
         
                $cdt =  date_format($cdt, 'Y-m-d');

                $us_time =  date_format($us_time, 'Y-m-d');

                $time_add      = $us_time + (3600*24); //add seconds of one day
 
                $new_date      = date("Y-m-d H:i:s", $time_add);


                $orders = DB::table('orders')
                ->select(DB::raw('count(*) as data, order_us_date'))
                ->where('bill_dt', '>=', $us_time)
                ->where('bill_dt', '<=', $new_date)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->groupBy('bill_dt')
                ->get();

                $orders = collect($orders);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                return Response($orders);


     }

     public function DailyTotal(Request $request = null)
     {
               //dd("hello");die;
                $output =  '';

                $us_time = Carbon::yesterday('America/New_York');

                $curr_us_time = Carbon::now('America/New_York');

               // $cdt =  Carbon::today();


               
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
               //  $monthYear = date_format($cdt, 'M-Y');
               

                //$cdt =  date_format($cdt, 'Y-m-d'); removed on 17/05/18 as it is not us date

                $cdt =  date_format($us_time, 'Y-m-d');
                $cdt1 =  $cdt . '%' ;

                $inddt =  Carbon::now('Asia/Kolkata');

                $inddt1 =  date_format($inddt, 'Y-m-d');
                $inddt1 =  $inddt1 . '%' ;

                $curr_us_time1 =  date_format($curr_us_time, 'Y-m-d');
                $curr_us_time1 =  $curr_us_time1 . '%' ;

                // dd($cdt);die;
                  $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;

               
                $dtotvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
                //->where('bill_dt', 'like',$cdt1)
                   ->where('bill_dt', 'like',$cdt1)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get();

                $dtotvectordata = collect($dtotvectordata);

                $appr_ustotvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as appr_us_vect, COALESCE(sum(file_price),0) as appr_us_vectprice'))
                ->where('approval_us_time', 'like',$curr_us_time1)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get();

                  $appr_ustotvectordata = collect($appr_ustotvectordata);

                foreach($appr_ustotvectordata as $key =>$value){
                       $tot11[$key] = $value ;
                }

                $appr_indtotvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as appr_ind_vect, COALESCE(sum(file_price),0) as appr_ind_vectprice'))
                ->where('approval_time', 'like', $inddt1)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat)
                ->get();

                $appr_indtotvectordata = collect($appr_indtotvectordata);

                foreach($appr_indtotvectordata as $key =>$value){
                       $tot12[$key] = $value ;
                }


                $dtotdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt1)  // removed order_us_date on 14/08/19
                ->where('file_type', '=', 'Digitizing')
                ->wherein('status' , $stat)
                ->get();

                $dtotdigitdata = collect($dtotdigitdata);

                 $dtotphotodata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto, COALESCE(sum(file_price),0) as dtotphotoprice'))
                ->where('bill_dt', 'like', $cdt1)  // removed order_us_date on 14/08/19
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat)
                ->get();

                $dtotphotodata = collect($dtotphotodata);

                foreach($dtotvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($dtotdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                foreach($dtotphotodata as $key => $value){
                       $totphoto[$key] = $value ;
                }

                $tot3[] = array('dmonthYear' => $cdt) ;

                 $dtotalloted = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'Alloted')
                ->get();
                //dd($tot);die;
                  
                  foreach($dtotalloted as $key => $value){
                       $tot4[$key] = $value ;
                  }


                  $dtotapproved = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'Approved')
                ->get();

                foreach($dtotapproved as $key => $value){
                       $tot5[$key] = $value ;
                  }

                  $dtotqcpending = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt1 )
                ->where('status', '=', 'QC Pending')
                ->get();

                foreach($dtotqcpending as $key => $value){
                       $tot6[$key] = $value ;
                  }                                                                                                 
                     $dtotqc = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'QC OK')
                ->get();

                foreach($dtotqc as $key => $value){
                       $tot7[$key] = $value ;
                  }                                                                                                   

                     $dtotcompl = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt1)
                            ->where('status', '=', 'Completed')
                ->get();

                foreach($dtotcompl as $key => $value){
                       $tot8[$key] = $value ;
                  }    


             $dcompvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
                foreach($dcompvectordata as $key => $value){
                       $tot9[$key] = $value ;
                  }     

             $dcompdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();                                                      

                 foreach($dcompdigitdata as $key => $value){
                       $tot10[$key] = $value ;
                  }     


                
                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10, $tot11, $tot12,
                 $totphoto);
                //dd($tot);die;
               // $tot = array( 'totdata' => $tot  );
                //dd($totvectordata);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                //return Response($tot);
                return Response()->json($tot);


     }


   /// NEW CONTROLLER FOR DESIGNER
     public function DailyTotal_D(Request $request = null)
     {
               //dd("hello");die;
                $output =  '';

                $us_time = Carbon::yesterday('America/New_York');

                $curr_us_time = Carbon::now('America/New_York');

               // $cdt =  Carbon::today();


               
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
               //  $monthYear = date_format($cdt, 'M-Y');
               

                //$cdt =  date_format($cdt, 'Y-m-d'); removed on 17/05/18 as it is not us date

                $cdt =  date_format($us_time, 'Y-m-d');
                $cdt1 =  $cdt . '%' ;

                $inddt =  Carbon::now('Asia/Kolkata');

                $inddt1 =  date_format($inddt, 'Y-m-d');
                $inddt1 =  $inddt1 . '%' ;

                $curr_us_time1 =  date_format($curr_us_time, 'Y-m-d');
                $curr_us_time1 =  $curr_us_time1 . '%' ;

                 $id1 = array();
                array_push($id1, auth::user()->id);

                // dd($cdt);die;
                  $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending',
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes' , 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed'] ;

               
                $dtotvectordata = DB::table('order_dtls')
                ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotvect, COALESCE(sum(orders.file_price),0) as dtotvectprice'))
                //->where('bill_dt', 'like',$cdt1)
                   ->where('orders.bill_dt', 'like',$cdt1)
                ->where('orders.file_type', '=', 'Vector')
                ->wherein('order_dtls.status' , $stat)
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $dtotvectordata = collect($dtotvectordata);

                $appr_ustotvectordata = DB::table('order_dtls')
                ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as appr_us_vect, COALESCE(sum(orders.file_price),0) as appr_us_vectprice'))
                ->where('orders.approval_us_time', 'like',$curr_us_time1)
                ->where('orders.file_type', '=', 'Vector')
                ->wherein('order_dtls.status' , $stat)
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                  $appr_ustotvectordata = collect($appr_ustotvectordata);

                foreach($appr_ustotvectordata as $key =>$value){
                       $tot11[$key] = $value ;
                }

                $appr_indtotvectordata = DB::table('order_dtls')
                 ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as appr_ind_vect, COALESCE(sum(orders.file_price),0) as appr_ind_vectprice'))
                ->where('orders.approval_time', 'like', $inddt1)
                ->where('orders.file_type', '=', 'Vector')
                ->wherein('order_dtls.status' , $stat)
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $appr_indtotvectordata = collect($appr_indtotvectordata);

                foreach($appr_indtotvectordata as $key =>$value){
                       $tot12[$key] = $value ;
                }


                $dtotdigitdata = DB::table('order_dtls')
                 ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotdigit, COALESCE(sum(orders.file_price),0) as dtotdigitprice'))
                ->where('orders.bill_dt', 'like', $cdt1)  // removed order_us_date on 14/08/19
                ->where('orders.file_type', '=', 'Digitizing')
                ->wherein('order_dtls.status' , $stat)
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $dtotdigitdata = collect($dtotdigitdata);

                 $dtotphotodata = DB::table('order_dtls')
                   ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotphoto, COALESCE(sum(orders.file_price),0) as dtotphotoprice'))
                ->where('orders.bill_dt', 'like', $cdt1)  // removed order_us_date on 14/08/19
                ->where('orders.file_type', '=', 'Photoshop')
                ->wherein('order_dtls.status' , $stat)
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $dtotphotodata = collect($dtotphotodata);

                foreach($dtotvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($dtotdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                foreach($dtotphotodata as $key => $value){
                       $totphoto[$key] = $value ;
                }

                $tot3[] = array('dmonthYear' => $cdt) ;

                 $dtotalloted = DB::table('order_dtls')
                  ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotallot, COALESCE(sum(orders.file_price),0) as dtotallotedprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'Alloted')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();
                //dd($tot);die;
                  
                  foreach($dtotalloted as $key => $value){
                       $tot4[$key] = $value ;
                  }


                  $dtotapproved = DB::table('order_dtls')
                   ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotapprov,COALESCE(sum(orders.file_price),0) as dtotapprovprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'Approved')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotapproved as $key => $value){
                       $tot5[$key] = $value ;
                  }

                  $dtotqcpending = DB::table('order_dtls')
                   ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotqcpend, COALESCE(sum(orders.file_price),0) as dtotqcpendprice'))
                ->where('orders.bill_dt', 'like', $cdt1 )
                ->where('order_dtls.status', '=', 'QC Pending')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotqcpending as $key => $value){
                       $tot6[$key] = $value ;
                  }                                                                                                 
                     $dtotqc = DB::table('order_dtls')
                      ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotqcok, COALESCE(sum(orders.file_price),0) as dtotqcokprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'QC OK')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotqc as $key => $value){
                       $tot7[$key] = $value ;
                  }                                                                                                   

                     $dtotcompl = DB::table('order_dtls')
                      ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompl, COALESCE(sum(orders.file_price),0) as dtotcomplprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                            ->where('order_dtls.status', '=', 'Completed')
                             ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotcompl as $key => $value){
                       $tot8[$key] = $value ;
                  }    


             $dcompvectordata = DB::table('order_dtls')
              ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompvect, COALESCE(sum(orders.file_price),0) as dcompvectprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('order_dtls.status', '=', 'Completed')
                ->where('orders.file_type', '=', 'Vector')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();      
               
                foreach($dcompvectordata as $key => $value){
                       $tot9[$key] = $value ;
                  }     

             $dcompdigitdata = DB::table('order_dtls')
              ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompdigit, COALESCE(sum(orders.file_price),0) as dcompdigitprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('order_dtls.status', '=', 'Completed')
                ->where('orders.file_type', '=', 'Digitizing')
                 ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();                                                      

                 foreach($dcompdigitdata as $key => $value){
                       $tot10[$key] = $value ;
                  }     


                
                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10, $tot11, $tot12,
                 $totphoto);
                //dd($tot);die;
               // $tot = array( 'totdata' => $tot  );
                //dd($totvectordata);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                //return Response($tot);
                return Response()->json($tot);


     }
 ///
   public function DailyTotal_Today(Request $request = null)
     {
               //dd("hello");die;
                $output =  '';

                $us_time = Carbon::now('America/New_York');


                $cdt =  date_format($us_time, 'Y-m-d');
                $cdt1 =  $cdt . '%' ;

            
                $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK',
                'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending', 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed' ,
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes'] ;
                 // Removed quote on  12/09/19 as per instruction of Kulind Sir  
                        
               
                $dtotvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat )
                ->get();

                $dtotvectordata = collect($dtotvectordata);

                                

                $dtotdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('file_type', '=', 'Digitizing')
                ->wherein('status' , $stat )
                ->get();

                $dtotdigitdata = collect($dtotdigitdata);

                $dtotphotodata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotphoto, COALESCE(sum(file_price),0) as dtotphotoprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('file_type', '=', 'Photoshop')
                ->wherein('status' , $stat )
                ->get();

                $dtotphotodata = collect($dtotphotodata);


                foreach($dtotvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($dtotdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                 foreach($dtotphotodata as $key => $value){
                       $totphoto[$key] = $value ;
                }


                $tot3[] = array('dmonthYear' => $cdt) ;

                 $dtotalloted = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'Alloted')
                ->get();
                //dd($tot);die;
                  
                  foreach($dtotalloted as $key => $value){
                       $tot4[$key] = $value ;
                  }


                  $dtotapproved = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'Approved')
                ->get();

                foreach($dtotapproved as $key => $value){
                       $tot5[$key] = $value ;
                  }

                  $dtotqcpending = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt1 )
                ->where('status', '=', 'QC Pending')
                ->get();

                foreach($dtotqcpending as $key => $value){
                       $tot6[$key] = $value ;
                  }                                                                                                 
                     $dtotqc = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt1)
                ->where('status', '=', 'QC OK')
                ->get();

                foreach($dtotqc as $key => $value){
                       $tot7[$key] = $value ;
                  }                                                                                                   

                     $dtotcompl = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt1)
                            ->where('status', '=', 'Completed')
                ->get();

                foreach($dtotcompl as $key => $value){
                       $tot8[$key] = $value ;
                  }    


             $dcompvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
                foreach($dcompvectordata as $key => $value){
                       $tot9[$key] = $value ;
                  }     

             $dcompdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();                                                      

                 foreach($dcompdigitdata as $key => $value){
                       $tot10[$key] = $value ;
                  }     

                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10, $totphoto);
                //dd($tot);die;
               // $tot = array( 'totdata' => $tot  );
                //dd($totvectordata);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                //return Response($tot);
                return Response()->json($tot);


     }    


     public function DailyTotal_Today_D(Request $request = null)
     {
               //dd("hello");die;
                $output =  '';

                $us_time = Carbon::now('America/New_York');


                $cdt =  date_format($us_time, 'Y-m-d');
                $cdt1 =  $cdt . '%' ;
                

                $id1 = array();
                array_push($id1, auth::user()->id);

            
                $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK',
                'Revision'=>'Revision',  'Rev-QC OK'=>'Rev-QC OK' , 'Rev-QC Pending'=>'Rev-QC Pending', 'Ch-Completed' => 'Ch-Completed' ,
                      'Rev-Completed' => 'Rev-Completed' ,
                     'Ch-QC Pending'=>'Ch-QC Pending' , 'Ch-QC OK'=>'Ch-QC OK', 'Changes' => 'Changes'] ;
                 // Removed quote on  12/09/19 as per instruction of Kulind Sir  
                        
               
                $dtotvectordata = DB::table('order_dtls')
                ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotvect, COALESCE(sum(orders.file_price),0) as dtotvectprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('orders.file_type', '=', 'Vector')
                ->wherein('order_dtls.status' , $stat )
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $dtotvectordata = collect($dtotvectordata);

                                

                $dtotdigitdata = DB::table('order_dtls')
                 ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotdigit, COALESCE(sum(orders.file_price),0) as dtotdigitprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('orders.file_type', '=', 'Digitizing')
                ->wherein('order_dtls.status' , $stat )
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                               ->get();

                $dtotdigitdata = collect($dtotdigitdata);

                $dtotphotodata = DB::table('order_dtls')
                ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotphoto, COALESCE(sum(orders.file_price),0) as dtotphotoprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('orders.file_type', '=', 'Photoshop')
                ->wherein('order_dtls.status' , $stat )
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                $dtotphotodata = collect($dtotphotodata);


                foreach($dtotvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($dtotdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                 foreach($dtotphotodata as $key => $value){
                       $totphoto[$key] = $value ;
                }


                $tot3[] = array('dmonthYear' => $cdt) ;

                 $dtotalloted = DB::table('order_dtls')
                 ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotallot, COALESCE(sum(orders.file_price),0) as dtotallotedprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'Alloted')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();
                //dd($tot);die;
                  
                  foreach($dtotalloted as $key => $value){
                       $tot4[$key] = $value ;
                  }


                  $dtotapproved = DB::table('order_dtls')
                  ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotapprov,COALESCE(sum(orders.file_price),0) as dtotapprovprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'Approved')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotapproved as $key => $value){
                       $tot5[$key] = $value ;
                  }

                  $dtotqcpending = DB::table('order_dtls')
                  ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotqcpend, COALESCE(sum(orders.file_price),0) as dtotqcpendprice'))
                ->where('orders.bill_dt', 'like', $cdt1 )
                ->where('order_dtls.status', '=', 'QC Pending')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotqcpending as $key => $value){
                       $tot6[$key] = $value ;
                  }                                                                                                 
                     $dtotqc = DB::table('order_dtls')
                     ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dtotqcok, COALESCE(sum(orders.file_price),0) as dtotqcokprice'))
                ->where('orders.bill_dt', 'like',$cdt1)
                ->where('order_dtls.status', '=', 'QC OK')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotqc as $key => $value){
                       $tot7[$key] = $value ;
                  }                                                                                                   

                     $dtotcompl = DB::table('order_dtls')
                     ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompl, COALESCE(sum(orders.file_price),0) as dtotcomplprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                            ->where('order_dtls.status', '=', 'Completed')
                            ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();

                foreach($dtotcompl as $key => $value){
                       $tot8[$key] = $value ;
                  }    


             $dcompvectordata = DB::table('order_dtls')
             ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompvect, COALESCE(sum(orders.file_price),0) as dcompvectprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('order_dtls.status', '=', 'Completed')
                ->where('orders.file_type', '=', 'Vector')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();      
               
                foreach($dcompvectordata as $key => $value){
                       $tot9[$key] = $value ;
                  }     

             $dcompdigitdata = DB::table('order_dtls')
             ->join('orders', 'order_dtls.master_id', '=', 'orders.id')
                ->select(DB::raw('count(order_dtls.file_name) as dcompdigit, COALESCE(sum(orders.file_price),0) as dcompdigitprice'))
                ->where('orders.bill_dt', 'like', $cdt1)
                ->where('order_dtls.status', '=', 'Completed')
                ->where('orders.file_type', '=', 'Digitizing')
                ->whereRaw("FIND_IN_SET(?, order_dtls.alloc_id) > 0", [$id1])
                ->get();                                                      

                 foreach($dcompdigitdata as $key => $value){
                       $tot10[$key] = $value ;
                  }     

                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10, $totphoto);
                //dd($tot);die;
               // $tot = array( 'totdata' => $tot  );
                //dd($totvectordata);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                //return Response($tot);
                return Response()->json($tot);


     }    
  

  public function PendingOrder()
  {
            
            $curr_mnth_startdt =  Carbon::now()->startOfMonth();

            $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');


            $curr_date    =  Carbon::now() ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');

                  $curr_pend_order = DB::table('order_dtls')
                 ->select('order_id' , 'file_name',  'file_type', 'document_type', 'allocation')
                 ->where('order_us_date', '>=', $curr_mnthdt)
                 ->where('order_us_date', '<=', $curr_dt )
                 ->whereNotIn('status' , ['Completed', 'On Hold', 'Cancel', 'Duplicate Entry', 'No Response', 'Complain', 'Followup'] )
                 ->where('target_completion_time', '<=', $curr_dt)
                 ->get();      

            $redis = LRedis::connection();
            $curr_pend_order = collect($curr_pend_order);

            //dd($curr_pend_order);

            foreach ($curr_pend_order as  $value) {
                   
              $push_note =  $value->order_id . $value->file_name .' is still not completed' . ' by ' . $value->allocation;

              $data = ['message' => $push_note, 'user' =>$value->allocation, 'type' => 'orderchange'];

        
              $redis->publish('message', json_encode($data));
            }
    }


     public function TotalAll(Request $request = null)
     {
               //dd("hello");die;
                $output =  '';

                $us_time = Carbon::now('America/New_York');

                $cdt =  Carbon::now('America/New_York');
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
                 $monthYear = date_format($cdt, 'M-Y');
         
                $cdt =  date_format($cdt, 'Y-m-d');

                $us_time =  date_format($us_time, 'Y-m-d');

                //$new_date =  Carbon::now()->subDays(30);  deduct 30 days

                $curr_dt =  Carbon::now('America/New_York');
                $new_date =  Carbon::now('America/New_York')->startOfMonth();

                $new_date =  date_format($new_date, 'Y-m-d');
                $us_time =  date_format($curr_dt, 'Y-m-d');
               

                //dd($new_date);
 
              //  $new_date      = date("Y-m-d H:i:s", $time_add);


                $totvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('file_type', '=', 'Vector')
                ->whereNotIn('status' , [ 'On Hold', 'Cancel', 'Duplicate Entry', 'No Response', 'Complain', 'Followup'] )
                ->get(); 

                // status 'Completed', removed as wrong data on kulind sir instruct

                $totvectordata = collect($totvectordata);

                $totdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totdigit, sum(file_price) as totdigitprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->whereNotIn('status' , [ 'On Hold', 'Cancel', 'Duplicate Entry', 'No Response', 'Complain', 'Followup'] )
               ->where('file_type', '=', 'Digitizing')
                ->get();


                $totphotodata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totphoto, sum(file_price) as totphotoprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->whereNotIn('status' , [ 'On Hold', 'Cancel', 'Duplicate Entry', 'No Response', 'Complain', 'Followup'] )
               ->where('file_type', '=', 'Photoshop')
                ->get();

                $totphotodata = collect($totphotodata);


                $totdigitdata = collect($totdigitdata);

                foreach($totvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($totdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                 foreach($totphotodata as $key => $value){
                       $tot9[$key] = $value ;
                }


                $tot3[] = array('monthYear' => $monthYear) ;

                 $totalloted = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totallot, sum(file_price) as totallotedprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', 'Alloted')
                ->get();
                //dd($tot);die;
                  
                  foreach($totalloted as $key => $value){
                       $tot4[$key] = $value ;
                  }


                  $totapproved = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totapprov, sum(file_price) as totapprovprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', 'Approved')
                ->get();

                foreach($totapproved as $key => $value){
                       $tot5[$key] = $value ;
                  }

                  $totqcpending = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcpend, sum(file_price) as totqcpendprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', 'QC Pending')
                ->get();

                foreach($totqcpending as $key => $value){
                       $tot6[$key] = $value ;
                  }                                                                                                 
                     $totqc = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totqcok, sum(file_price) as totqcokprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', 'QC OK')
                ->get();

                foreach($totqc as $key => $value){
                       $tot7[$key] = $value ;
                  }                                                                                                   

                     $totcompl = DB::table('orders')
                ->select(DB::raw('sum(file_count) as totcompl, sum(file_price) as totcomplprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', 'Completed')
                ->get();

                foreach($totcompl as $key => $value){
                       $tot8[$key] = $value ;
                  }                                                             


                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9);
                //dd($tot);die;
               // $tot = array( 'totdata' => $tot  );
                //dd($totvectordata);


                // $output  = '<tr>' .'<td>' .$clients->id . '</td>' .
                // '<td>' .$clients->client_name . '</td>' .
                // '<td>' .$clients->client_email_primary . '</td>' .
                // '<td>' .$clients->client_email_secondary. '</td>' .
                // '<td>' .$clients->company . '</td>' 
                // .'</tr>' ;

                //return Response($tot);

            $curr_mnth_startdt =  Carbon::now()->startOfMonth();

            $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');

           // $curr_dt =  date_format($new_date, 'Y-m-d');

            $curr_date    =  Carbon::now('America/New_York') ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');

                  $curr_pend_order = DB::table('order_dtls')
                 ->select('order_id' , 'file_name',  'file_type', 'document_type', 'allocation')
                 ->where('order_us_date', '>=', $curr_mnthdt)
                 ->where('order_us_date', '<=', $curr_dt )
                 ->where('status', '<>', 'Completed')
                 ->where('target_completion_time', '<=', $curr_dt)
                 ->get();      

            // $redis = LRedis::connection();
            // $curr_pend_order = collect($curr_pend_order);

            // foreach ($curr_pend_order as  $value) {
                   
            //   $push_note =  $value->order_id . $value->file_name .' is still not completed' . ' by ' . $value->allocation;

            //   $data = ['message' => $push_note, 'user' =>$value->allocation, 'type' => 'orderchange'];

        
            //   $redis->publish('message', json_encode($data));


            // }
                 
                return Response()->json($tot);


     }

   public function dailysummary(Request $request)
{
                  $search =  $request->search ;   
                $us_time = Carbon::now('America/New_York');

                $cdt =  Carbon::now();
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
                 $monthYear = date_format($cdt, 'M-Y');
         
                $cdt =  date_format($cdt, 'Y-m-d');

                $us_time =  date_format($us_time, 'Y-m-d');

                //$new_date =  Carbon::now()->subDays(30);  deduct 30 days

                $new_date =  Carbon::now()->startOfMonth();

                $new_date =  date_format($new_date, 'Y-m-d');
               
  if( $search == 'Vector' ||  $search == 'Digitizing' || $search == 'Photoshop')
  {
    $totvectordata = DB::table('orders')
                ->select('bill_dt', DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('file_type', '=', $search)
                ->whereNotIn('status' , [ 'On Hold', 'Cancel', 'Duplicate Entry', 'No Response', 'Complain', 'Followup'] )
                ->groupBy('bill_dt')
                ->get(); 

   
       }
     elseif ($search == "Completed")
     {  
        $totvectordata = DB::table('orders')
                ->select('bill_dt', DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->whereIn('status', ['Completed', 'Rev-Completed', 'Ch-Completed'] )
                ->groupBy('bill_dt')
                ->get(); 


     // dd($totvectordata);

   
     }
     else {
           $totvectordata = DB::table('orders')
                ->select('bill_dt', DB::raw('sum(file_count) as totvect, sum(file_price) as totvectprice'))
                ->where('bill_dt', '>=',$new_date)
                ->where('bill_dt', '<=', $us_time )
                ->where('status', '=', $search)
                ->groupBy('bill_dt')
                ->get(); 


     }

      $totvectordata= collect($totvectordata);

     
     $output='' ;

     foreach ( $totvectordata as $key) {
         $output .= '<tr>' ;
         //dd($key);
          foreach ($key as $k=>$value) {
                     //dd($k);
            if ($k =='bill_dt') {
                 $output .=  '<td><a href="#" class="bill">' . $value . '</a></td>' ;
            
            }
            else {
               $output .=  '<td>' . $value . '</td>' ;
           
            }
                   
                  }
              $output .=  '</tr>' ;
           }

           return Response($output);
  }

   public function faillogusers(Request $request){

            if (Auth::user()->hasRole(['admin']) ) {

              $time =  time() - (config('session.lifetime')*60); 

        
                $failedusers = FailedLoginAttempt::orderBy('id','DESC')->paginate(5);

                $logusers = DB::table('users')->join('sessions', 'sessions.user_id', '=', 
                  'users.id')->select('users.id', 'users.name' , 'users.email', 'sessions.ip_address',  'sessions.last_activity', 'sessions.user_agent')->where('sessions.last_activity','>=', $time)->get()->reverse();
                

                    return view('miscreports.logged_users',compact('failedusers', 'logusers'))

                        ->with('i', ($request->input('page', 1) - 1) * 5);


                }

     }
     
}