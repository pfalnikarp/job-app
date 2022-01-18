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


use App\Models\Role;

use App\Models\Permission;
//use Ntrust;
use LRedis;

class PrvMonthController extends Controller
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
                ->select(DB::raw('DATE_FORMAT(bill_dt, "%Y%m") as name')  , DB::raw('count(*) as data'))
                //->where('order_us_date', '=', $us_time)
                // ->where('order_us_date', '<=', $new_date)
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
                ->where('order_us_date', '>=', $us_time)
                ->where('order_us_date', '<=', $new_date)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->groupBy('order_us_date')
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
                    $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision', 'Quote' =>'Quote'] ;

               
                $dtotvectordata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
                //->where('order_us_date', 'like',$cdt1)  // removed on 15-08-19 as per instruction of  Kulind sIR
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
                ->where('approval_time', 'like',$inddt1)
                ->where('file_type', '=', 'Vector')
                  ->wherein('status' , $stat)
                ->get();

                $appr_indtotvectordata = collect($appr_indtotvectordata);

                foreach($appr_indtotvectordata as $key =>$value){
                       $tot12[$key] = $value ;
                }


                $dtotdigitdata = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt1)
                ->where('file_type', '=', 'Digitizing')
                  ->wherein('status' , $stat)
                ->get();

                $dtotdigitdata = collect($dtotdigitdata);

                foreach($dtotvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($dtotdigitdata as $key => $value){
                       $tot2[$key] = $value ;
                }

                $tot3[] = array('dmonthYear' => $cdt) ;

                 $dtotalloted = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                //->where('order_us_date', 'like',$cdt1)
                ->where('bill_dt', 'like', $cdt1)
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

                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10, $tot11, $tot12);
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

   public function MonthlyTotal(Request $request = null)
     {
               //dd("hello");die;
            $today =  Carbon::now()->subDays(60);

           // dd($today);

            $beforedays30 =  $today->addDays(-30);
              
            $today =  date_format($today, 'Y-m-d');
              

            $beforedays30 =  date_format($beforedays30, 'Y-m-d');
              

            $us_time = Carbon::now('America/New_York')->addDays(-30);

            $cdt =  date_format($us_time, 'Y-m-d');
           // dd($cdt);
            $cdt30 =  $cdt . '%' ;

         //   $cdt30 = '2017-12-01'  . '%' ;

               $stat =  ['Completed' =>'Completed', 'Approved' =>'Approved', 'Alloted' =>'Alloted', 'QC Pending' =>'QC Pending', 'QC OK'=>'QC OK', 'Revision'=>'Revision'] ;

            $dtotvectordata30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
                ->where('bill_dt' , 'like', $cdt30 )
                ->where('file_type', '=', 'Vector')
                ->wherein('status' , $stat )
               // ->groupby(DB::raw('date_format("order_us_date", "Y-m-d")'))
                ->get();

            $dtotvectordata30 = collect($dtotvectordata30);
           //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt30)
                  ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata30 = collect($dtotdigitdata30);

            // foreach($dtotvectordata as $key =>$value){
            //            $tot1[$key] = $value ;
            // }
                
                //dd($tot);die;
                // foreach($dtotdigitdata as $key => $value){
                //        $tot2[$key] = $value ;
                // }

                // $tot3[] = array('dmonthYear' => $cdt) ;

          $dtotalloted30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt30)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted30 = collect($dtotalloted30);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt30)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved30 = collect($dtotapproved30); 
                // foreach($dtotapproved as $key => $value){
                //        $tot5[$key] = $value ;
                //   }

          $dtotqcpending30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt30 )
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending30 = collect($dtotqcpending30); 
                // foreach($dtotqcpending as $key => $value){
                //        $tot6[$key] = $value ;
                //   }                                                                                                 
          $dtotqc30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt30)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc30 = collect($dtotqc30);   
                // foreach($dtotqc as $key => $value){
                //        $tot7[$key] = $value ;
                //   }                                                                                                   

          $dtotcompl30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt30)
                            ->where('status', '=', 'Completed')
                ->get();

                // foreach($dtotcompl as $key => $value){
                //        $tot8[$key] = $value ;
                //   }    
          $dtotcompl30 = collect($dtotcompl30);      


          $dcompvectordata30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt30)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
                // foreach($dcompvectordata as $key => $value){
                //        $tot9[$key] = $value ;
                //   }   
          $dcompvectordata30 = collect($dcompvectordata30);   

          $dcompdigitdata30 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt30)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata30 = collect($dcompdigitdata30);

        // 30  days completed                                                      

          // foreach($dcompdigitdata as $key => $value){
          //              $tot10[$key] = $value ;
          //         }     

               // $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8, $tot9, $tot10);  this logic removed on 28/05/18 to print whole month data
               
       
        //return Response()->json($tot);
        //dd($tot);   29th date

        $us_time = Carbon::now('America/New_York')->addDays(-29);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt29 =  $cdt . '%' ;

        //$cdt29 = '2017-12-02'  . '%' ;

               
        $dtotvectordata29 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt29)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata29 = collect($dtotvectordata29);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt29)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata29 = collect($dtotdigitdata29);

           
          $dtotalloted29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt29)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted29 = collect($dtotalloted29);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt29)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved29 = collect($dtotapproved29); 
            
          $dtotqcpending29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt29 )
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending29 = collect($dtotqcpending29); 
                                                                                                        
          $dtotqc29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt29)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc29 = collect($dtotqc29);   
                                                         

          $dtotcompl29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt29)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl29 = collect($dtotcompl29);      


          $dcompvectordata29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt29)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata29 = collect($dcompvectordata29);   

          $dcompdigitdata29 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt29)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata29 = collect($dcompdigitdata29);
    
        // 29th date  

  // 28th date    

  $us_time = Carbon::now('America/New_York')->addDays(-28);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt28 =  $cdt . '%' ;

        //$cdt28 = '2017-12-02'  . '%' ;

               
        $dtotvectordata28 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt28)
             ->wherein('status' , $stat )
            ->where('file_type', '=', 'Vector')
                 ->get();

            $dtotvectordata28 = collect($dtotvectordata28);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt28)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata28 = collect($dtotdigitdata28);

           
          $dtotalloted28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt28)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted28 = collect($dtotalloted28);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt28)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved28 = collect($dtotapproved28); 
            
          $dtotqcpending28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt28 )
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending28 = collect($dtotqcpending28); 
                                                                                                        
          $dtotqc28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt28)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc28 = collect($dtotqc28);   
                                                         

          $dtotcompl28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt28)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl28 = collect($dtotcompl28);      


          $dcompvectordata28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt28)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata28 = collect($dcompvectordata28);   

          $dcompdigitdata28 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt28)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata28 = collect($dcompdigitdata28);
    
        // 28th date  

   // 27th date    

  $us_time = Carbon::now('America/New_York')->addDays(-27);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt27 =  $cdt . '%' ;

        //$cdt27 = '2017-12-02'  . '%' ;

               
        $dtotvectordata27 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt27)
            ->where('file_type', '=', 'Vector')
              ->wherein('status' , $stat )
                   ->get();

            $dtotvectordata27 = collect($dtotvectordata27);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt27)
                ->where('file_type', '=', 'Digitizing')
                  ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata27 = collect($dtotdigitdata27);

           
          $dtotalloted27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt27)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted27 = collect($dtotalloted27);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt27)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved27 = collect($dtotapproved27); 
            
          $dtotqcpending27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt27)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending27 = collect($dtotqcpending27); 
                                                                                                        
          $dtotqc27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt27)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc27 = collect($dtotqc27);   
                                                         

          $dtotcompl27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt27)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl27 = collect($dtotcompl27);      


          $dcompvectordata27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt27)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata27 = collect($dcompvectordata27);   

          $dcompdigitdata27 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt27)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata27 = collect($dcompdigitdata27);
    
        // 27th date  
                
   // 26th date    

    $us_time = Carbon::now('America/New_York')->addDays(-26);

    $cdt =  date_format($us_time, 'Y-m-d');
    $cdt26 =  $cdt . '%' ;

       // $cdt26 = '2017-12-02'  . '%' ;

               
        $dtotvectordata26 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt26)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
            //->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata26 = collect($dtotvectordata26);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt26)
                ->where('file_type', '=', 'Digitizing')
                  ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata26 = collect($dtotdigitdata26);

           
          $dtotalloted26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt26)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted26 = collect($dtotalloted26);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt26)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved26 = collect($dtotapproved26); 
            
          $dtotqcpending26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt26)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending26 = collect($dtotqcpending26); 
                                                                                                        
          $dtotqc26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt26)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc26 = collect($dtotqc26);   
                                                         

          $dtotcompl26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt26)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl26 = collect($dtotcompl26);      


          $dcompvectordata26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt26)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata26 = collect($dcompvectordata26);   

          $dcompdigitdata26 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt26)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata26 = collect($dcompdigitdata26);
    
        // 26th date  

   // 25th date    

  $us_time = Carbon::now('America/New_York')->addDays(-25);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt25 =  $cdt . '%' ;

       // $cdt25 = '2017-12-02'  . '%' ;

               
        $dtotvectordata25 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt25)
            ->where('file_type', '=', 'Vector')
              ->wherein('status' , $stat )
                        ->get();

            $dtotvectordata25 = collect($dtotvectordata25);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt25)
                ->where('file_type', '=', 'Digitizing')
                  ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata25 = collect($dtotdigitdata25);

           
          $dtotalloted25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt25)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted25 = collect($dtotalloted25);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt25)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved25 = collect($dtotapproved25); 
            
          $dtotqcpending25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt25)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending25 = collect($dtotqcpending25); 
                                                                                                        
          $dtotqc25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt25)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc25 = collect($dtotqc25);   
                                                         

          $dtotcompl25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt25)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl25 = collect($dtotcompl25);      


          $dcompvectordata25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt25)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata25 = collect($dcompvectordata25);   

          $dcompdigitdata25 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt25)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata25 = collect($dcompdigitdata25);
    
        // 25th date  

   // 24th date    

  $us_time = Carbon::now('America/New_York')->addDays(-24);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt24 =  $cdt . '%' ;

       // $cdt24 = '2017-12-02'  . '%' ;

               
        $dtotvectordata24 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt24)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
            //->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata24 = collect($dtotvectordata24);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt24)
                ->where('file_type', '=', 'Digitizing')
                ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata24 = collect($dtotdigitdata24);

           
          $dtotalloted24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt24)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted24 = collect($dtotalloted24);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt24)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved24 = collect($dtotapproved24); 
            
          $dtotqcpending24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt24)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending24 = collect($dtotqcpending24); 
                                                                                                        
          $dtotqc24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt24)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc24 = collect($dtotqc24);   
                                                         

          $dtotcompl24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt24)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl24 = collect($dtotcompl24);      


          $dcompvectordata24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt24)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata24 = collect($dcompvectordata24);   

          $dcompdigitdata24 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt24)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata24 = collect($dcompdigitdata24);
    
        // 24th date  

 // 23th date    

           $us_time = Carbon::now('America/New_York')->addDays(-23);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt23 =  $cdt . '%' ;

      //  $cdt23 = '2017-12-02'  . '%' ;

               
        $dtotvectordata23 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt23)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->get();

            $dtotvectordata23 = collect($dtotvectordata23);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt23)
                ->where('file_type', '=', 'Digitizing')
                ->wherein('status' , $stat )                
                ->get();

          $dtotdigitdata23 = collect($dtotdigitdata23);

           
          $dtotalloted23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt23)
                ->where('status', '=', 'Alloted')
                 ->wherein('status' , $stat )
                ->get();

          $dtotalloted23 = collect($dtotalloted23);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt23)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved23 = collect($dtotapproved23); 
            
          $dtotqcpending23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt23)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending23 = collect($dtotqcpending23); 
                                                                                                        
          $dtotqc23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt23)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc23 = collect($dtotqc23);   
                                                         

          $dtotcompl23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt23)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl23 = collect($dtotcompl23);      


          $dcompvectordata23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt23)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata23 = collect($dcompvectordata23);   

          $dcompdigitdata23 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt23)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata23 = collect($dcompdigitdata23);
    
        // 23th date  

 // 22th date    

    $us_time = Carbon::now('America/New_York')->addDays(-22);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt22 =  $cdt . '%' ;

       // $cdt22 = '2017-12-02'  . '%' ;

               
        $dtotvectordata22 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt22)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->get();

            $dtotvectordata22 = collect($dtotvectordata22);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt22)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata22 = collect($dtotdigitdata22);

           
          $dtotalloted22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt22)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted22 = collect($dtotalloted22);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt22)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved22 = collect($dtotapproved22); 
            
          $dtotqcpending22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt22)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending22 = collect($dtotqcpending22); 
                                                                                                        
          $dtotqc22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt22)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc22 = collect($dtotqc22);   
                                                         

          $dtotcompl22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt22)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl22 = collect($dtotcompl22);      


          $dcompvectordata22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt22)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata22 = collect($dcompvectordata22);   

          $dcompdigitdata22 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt22)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata22 = collect($dcompdigitdata22);
    
        // 22th date  

 // 21th date    

           $us_time = Carbon::now('America/New_York')->addDays(-21);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt21 =  $cdt . '%' ;

        //$cdt21 = '2017-12-02'  . '%' ;

               
        $dtotvectordata21 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt21)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->get();

            $dtotvectordata21 = collect($dtotvectordata21);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt21)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata21 = collect($dtotdigitdata21);

           
          $dtotalloted21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt21)
                ->where('status', '=', 'Alloted')
                       ->get();

          $dtotalloted21 = collect($dtotalloted21);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt21)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved21 = collect($dtotapproved21); 
            
          $dtotqcpending21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt21)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending21 = collect($dtotqcpending21); 
                                                                                                        
          $dtotqc21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt21)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc21 = collect($dtotqc21);   
                                                         

          $dtotcompl21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt21)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl21 = collect($dtotcompl21);      


          $dcompvectordata21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt21)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata21 = collect($dcompvectordata21);   

          $dcompdigitdata21 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt21)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata21 = collect($dcompdigitdata21);
    
        // 21th date  
    
 // 20th date    

           $us_time = Carbon::now('America/New_York')->addDays(-20);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt20 =  $cdt . '%' ;

       // $cdt20 = '2017-12-02'  . '%' ;

               
        $dtotvectordata20 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt20)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->get();

            $dtotvectordata20 = collect($dtotvectordata20);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt20)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata20 = collect($dtotdigitdata20);

           
          $dtotalloted20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt20)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted20 = collect($dtotalloted20);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt20)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved20 = collect($dtotapproved20); 
            
          $dtotqcpending20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt20)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending20 = collect($dtotqcpending20); 
                                                                                                        
          $dtotqc20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt20)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc20 = collect($dtotqc20);   
                                                         

          $dtotcompl20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt20)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl20 = collect($dtotcompl20);      


          $dcompvectordata20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt20)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata20 = collect($dcompvectordata20);   

          $dcompdigitdata20 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt20)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata20 = collect($dcompdigitdata20);
    
        // 20th date  
       // 19th date    

  $us_time = Carbon::now('America/New_York')->addDays(-19);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt19 =  $cdt . '%' ;

        //$cdt19 = '1917-12-02'  . '%' ;

               
        $dtotvectordata19 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt19)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata19 = collect($dtotvectordata19);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt19)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata19 = collect($dtotdigitdata19);

           
          $dtotalloted19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt19)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted19 = collect($dtotalloted19);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt19)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved19 = collect($dtotapproved19); 
            
          $dtotqcpending19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt19)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending19 = collect($dtotqcpending19); 
                                                                                                        
          $dtotqc19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt19)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc19 = collect($dtotqc19);   
                                                         

          $dtotcompl19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt19)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl19 = collect($dtotcompl19);      


          $dcompvectordata19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt19)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata19 = collect($dcompvectordata19);   

          $dcompdigitdata19 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt19)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata19 = collect($dcompdigitdata19);
    
        // 19th date  

 // 18th date    

    $us_time = Carbon::now('America/New_York')->addDays(-18);

    $cdt =  date_format($us_time, 'Y-m-d');
    $cdt18 =  $cdt . '%' ;

        //$cdt18 = '1817-12-02'  . '%' ;

               
        $dtotvectordata18 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt18)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata18 = collect($dtotvectordata18);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt18)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata18 = collect($dtotdigitdata18);

           
          $dtotalloted18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt18)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted18 = collect($dtotalloted18);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt18)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved18 = collect($dtotapproved18); 
            
          $dtotqcpending18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt18)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending18 = collect($dtotqcpending18); 
                                                                                                        
          $dtotqc18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt18)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc18 = collect($dtotqc18);   
                                                         

          $dtotcompl18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt18)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl18 = collect($dtotcompl18);      


          $dcompvectordata18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt18)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata18 = collect($dcompvectordata18);   

          $dcompdigitdata18 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt18)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata18 = collect($dcompdigitdata18);
    
        // 18th date  
 // 17th date    

  $us_time = Carbon::now('America/New_York')->addDays(-17);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt17 =  $cdt . '%' ;

       // $cdt17 = '1717-12-02'  . '%' ;

               
        $dtotvectordata17 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt17)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata17 = collect($dtotvectordata17);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt17)
                ->where('file_type', '=', 'Digitizing')
                  ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata17 = collect($dtotdigitdata17);

           
          $dtotalloted17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt17)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted17 = collect($dtotalloted17);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt17)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved17 = collect($dtotapproved17); 
            
          $dtotqcpending17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt17)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending17 = collect($dtotqcpending17); 
                                                                                                        
          $dtotqc17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt17)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc17 = collect($dtotqc17);   
                                                         

          $dtotcompl17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt17)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl17 = collect($dtotcompl17);      


          $dcompvectordata17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt17)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata17 = collect($dcompvectordata17);   

          $dcompdigitdata17 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt17)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata17 = collect($dcompdigitdata17);
    
        // 17th date  
  
 // 16th date    

  $us_time = Carbon::now('America/New_York')->addDays(-16);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt16 =  $cdt . '%' ;

  //      $cdt16 = '1616-12-02'  . '%' ;

               
        $dtotvectordata16 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt16)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata16 = collect($dtotvectordata16);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt16)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata16 = collect($dtotdigitdata16);

           
          $dtotalloted16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt16)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted16 = collect($dtotalloted16);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt16)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved16 = collect($dtotapproved16); 
            
          $dtotqcpending16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt16)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending16 = collect($dtotqcpending16); 
                                                                                                        
          $dtotqc16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt16)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc16 = collect($dtotqc16);   
                                                         

          $dtotcompl16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt16)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl16 = collect($dtotcompl16);      


          $dcompvectordata16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt16)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata16 = collect($dcompvectordata16);   

          $dcompdigitdata16 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt16)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata16 = collect($dcompdigitdata16);
    
        // 16th date  

 // 15th date    

  $us_time = Carbon::now('America/New_York')->addDays(-15);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt15 =  $cdt . '%' ;

       // $cdt15 = '1515-12-02'  . '%' ;

               
        $dtotvectordata15 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt15)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata15 = collect($dtotvectordata15);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt15)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata15 = collect($dtotdigitdata15);

           
          $dtotalloted15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt15)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted15 = collect($dtotalloted15);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt15)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved15 = collect($dtotapproved15); 
            
          $dtotqcpending15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt15)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending15 = collect($dtotqcpending15); 
                                                                                                        
          $dtotqc15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt15)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc15 = collect($dtotqc15);   
                                                         

          $dtotcompl15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt15)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl15 = collect($dtotcompl15);      


          $dcompvectordata15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt15)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata15 = collect($dcompvectordata15);   

          $dcompdigitdata15 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt15)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata15 = collect($dcompdigitdata15);
    
        // 15th date  
  
   // 14th date    

  $us_time = Carbon::now('America/New_York')->addDays(-14);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt14 =  $cdt . '%' ;

        //$cdt14 = '1414-12-02'  . '%' ;

               
      $dtotvectordata14 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt14)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata14 = collect($dtotvectordata14);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt14)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata14 = collect($dtotdigitdata14);

           
          $dtotalloted14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt14)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted14 = collect($dtotalloted14);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt14)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved14 = collect($dtotapproved14); 
            
          $dtotqcpending14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt14)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending14 = collect($dtotqcpending14); 
                                                                                                        
          $dtotqc14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt14)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc14 = collect($dtotqc14);   
                                                         

          $dtotcompl14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt14)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl14 = collect($dtotcompl14);      


          $dcompvectordata14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt14)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata14 = collect($dcompvectordata14);   

          $dcompdigitdata14 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt14)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata14 = collect($dcompdigitdata14);
    
        // 14th date  

 // 13th date    

  $us_time = Carbon::now('America/New_York')->addDays(-13);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt13 =  $cdt . '%' ;

        //$cdt13 = '1313-12-02'  . '%' ;

               
        $dtotvectordata13 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt13)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata13 = collect($dtotvectordata13);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt13)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata13 = collect($dtotdigitdata13);

           
          $dtotalloted13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt13)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted13 = collect($dtotalloted13);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt13)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved13 = collect($dtotapproved13); 
            
          $dtotqcpending13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt13)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending13 = collect($dtotqcpending13); 
                                                                                                        
          $dtotqc13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt13)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc13 = collect($dtotqc13);   
                                                         

          $dtotcompl13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt13)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl13 = collect($dtotcompl13);      


          $dcompvectordata13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt13)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata13 = collect($dcompvectordata13);   

          $dcompdigitdata13 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt13)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata13 = collect($dcompdigitdata13);
    
        // 13th date  
   // 12th date    

  $us_time = Carbon::now('America/New_York')->addDays(-12);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt12 =  $cdt . '%' ;

   //     $cdt12 = '1212-12-02'  . '%' ;

               
  $dtotvectordata12 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt12)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata12 = collect($dtotvectordata12);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt12)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata12 = collect($dtotdigitdata12);

           
          $dtotalloted12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt12)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted12 = collect($dtotalloted12);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt12)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved12 = collect($dtotapproved12); 
            
          $dtotqcpending12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt12)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending12 = collect($dtotqcpending12); 
                                                                                                        
          $dtotqc12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt12)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc12 = collect($dtotqc12);   
                                                         

          $dtotcompl12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt12)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl12 = collect($dtotcompl12);      


          $dcompvectordata12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt12)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata12 = collect($dcompvectordata12);   

          $dcompdigitdata12 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt12)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata12 = collect($dcompdigitdata12);
    
        // 12th date  

 // 11th date    

  $us_time = Carbon::now('America/New_York')->addDays(-11);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt11 =  $cdt . '%' ;

       // $cdt11 = '1111-11-02'  . '%' ;

               
        $dtotvectordata11 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt11)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
            ->get();

            $dtotvectordata11 = collect($dtotvectordata11);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt11)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata11 = collect($dtotdigitdata11);

           
          $dtotalloted11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt11)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted11 = collect($dtotalloted11);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt11)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved11 = collect($dtotapproved11); 
            
          $dtotqcpending11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt11)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending11 = collect($dtotqcpending11); 
                                                                                                        
          $dtotqc11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt11)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc11 = collect($dtotqc11);   
                                                         

          $dtotcompl11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt11)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl11 = collect($dtotcompl11);      


          $dcompvectordata11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt11)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata11 = collect($dcompvectordata11);   

          $dcompdigitdata11 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt11)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata11 = collect($dcompdigitdata11);
    
        // 11th date  
  
 // 10th date    

  $us_time = Carbon::now('America/New_York')->addDays(-10);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt10 =  $cdt . '%' ;

      //  $cdt10 = '1010-10-02'  . '%' ;

               
        $dtotvectordata10 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt10)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata10 = collect($dtotvectordata10);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt10)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata10 = collect($dtotdigitdata10);

           
          $dtotalloted10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt10)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted10 = collect($dtotalloted10);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt10)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved10 = collect($dtotapproved10); 
            
          $dtotqcpending10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt10)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending10 = collect($dtotqcpending10); 
                                                                                                        
          $dtotqc10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt10)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc10 = collect($dtotqc10);   
                                                         

          $dtotcompl10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt10)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl10 = collect($dtotcompl10);      


          $dcompvectordata10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt10)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata10 = collect($dcompvectordata10);   

          $dcompdigitdata10 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt10)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata10 = collect($dcompdigitdata10);
    
        // 10th date  
  
 // 09th date    

  $us_time = Carbon::now('America/New_York')->addDays(-9);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt09 =  $cdt . '%' ;

      //  $cdt09 = '0909-09-02'  . '%' ;

               
        $dtotvectordata09 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt09)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata09 = collect($dtotvectordata09);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt09)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata09 = collect($dtotdigitdata09);

           
          $dtotalloted09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt09)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted09 = collect($dtotalloted09);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt09)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved09 = collect($dtotapproved09); 
            
          $dtotqcpending09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt09)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending09 = collect($dtotqcpending09); 
                                                                                                        
          $dtotqc09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt09)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc09 = collect($dtotqc09);   
                                                         

          $dtotcompl09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt09)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl09 = collect($dtotcompl09);      


          $dcompvectordata09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt09)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata09 = collect($dcompvectordata09);   

          $dcompdigitdata09 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt09)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata09 = collect($dcompdigitdata09);
    
        // 09th date  
  
  
   // 08th date    

  $us_time = Carbon::now('America/New_York')->addDays(-8);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt08 =  $cdt . '%' ;

      //  $cdt08 = '0808-08-02'  . '%' ;
  
               
        $dtotvectordata08 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt08)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata08 = collect($dtotvectordata08);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt08)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata08 = collect($dtotdigitdata08);

           
          $dtotalloted08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt08)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted08 = collect($dtotalloted08);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt08)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved08 = collect($dtotapproved08); 
            
          $dtotqcpending08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt08)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending08 = collect($dtotqcpending08); 
                                                                                                        
          $dtotqc08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt08)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc08 = collect($dtotqc08);   
                                                         

          $dtotcompl08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt08)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl08 = collect($dtotcompl08);      


          $dcompvectordata08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt08)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata08 = collect($dcompvectordata08);   

          $dcompdigitdata08 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt08)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata08 = collect($dcompdigitdata08);
    
        // 08th date  
  
  
   // 07th date    

  $us_time = Carbon::now('America/New_York')->addDays(-7);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt07 =  $cdt . '%' ;

       // $cdt07 = '0707-07-02'  . '%' ;

               
        $dtotvectordata07 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt07)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
             ->get();

            $dtotvectordata07 = collect($dtotvectordata07);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt07)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata07 = collect($dtotdigitdata07);

           
          $dtotalloted07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt07)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted07 = collect($dtotalloted07);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt07)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved07 = collect($dtotapproved07); 
            
          $dtotqcpending07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt07)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending07 = collect($dtotqcpending07); 
                                                                                                        
          $dtotqc07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt07)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc07 = collect($dtotqc07);   
                                                         

          $dtotcompl07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt07)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl07 = collect($dtotcompl07);      


          $dcompvectordata07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt07)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata07 = collect($dcompvectordata07);   

          $dcompdigitdata07 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt07)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata07 = collect($dcompdigitdata07);
    
        // 07th date  
  

 // 06th date    

  $us_time = Carbon::now('America/New_York')->addDays(-6);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt06 =  $cdt . '%' ;

     //   $cdt06 = '0606-06-02'  . '%' ;

  //dd($cdt06);

               
        $dtotvectordata06 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt06)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
            //->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata06 = collect($dtotvectordata06);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt06)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata06 = collect($dtotdigitdata06);

           
          $dtotalloted06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt06)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted06 = collect($dtotalloted06);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt06)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved06 = collect($dtotapproved06); 
            
          $dtotqcpending06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt06)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending06 = collect($dtotqcpending06); 
                                                                                                        
          $dtotqc06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt06)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc06 = collect($dtotqc06);   
                                                         

          $dtotcompl06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt06)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl06 = collect($dtotcompl06);      


          $dcompvectordata06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt06)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata06 = collect($dcompvectordata06);   

          $dcompdigitdata06 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt06)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata06 = collect($dcompdigitdata06);
    
        // 06th date  
  
  
 // 05th date    

  $us_time = Carbon::now('America/New_York')->addDays(-5);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt05 =  $cdt . '%' ;

      //  $cdt05 = '0505-05-02'  . '%' ;

               
        $dtotvectordata05 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt05)
            ->where('file_type', '=', 'Vector')
             ->wherein('status' , $stat )
           // ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata05 = collect($dtotvectordata05);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt05)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata05 = collect($dtotdigitdata05);

           
          $dtotalloted05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt05)
                ->where('status', '=', 'Alloted')
                 ->wherein('status' , $stat )
                ->get();

          $dtotalloted05 = collect($dtotalloted05);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt05)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved05 = collect($dtotapproved05); 
            
          $dtotqcpending05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt05)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending05 = collect($dtotqcpending05); 
                                                                                                        
          $dtotqc05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt05)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc05 = collect($dtotqc05);   
                                                         

          $dtotcompl05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt05)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl05 = collect($dtotcompl05);      


          $dcompvectordata05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt05)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata05 = collect($dcompvectordata05);   

          $dcompdigitdata05 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt05)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata05 = collect($dcompdigitdata05);
    
        // 05th date  
  

 // 04th date    

  $us_time = Carbon::now('America/New_York')->addDays(-4);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt04 =  $cdt . '%' ;

        //$cdt04 = '0404-04-02'  . '%' ;

               
        $dtotvectordata04 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt04)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
           // ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata04 = collect($dtotvectordata04);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt04)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata04 = collect($dtotdigitdata04);

           
          $dtotalloted04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt04)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted04 = collect($dtotalloted04);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt04)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved04 = collect($dtotapproved04); 
            
          $dtotqcpending04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt04)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending04 = collect($dtotqcpending04); 
                                                                                                        
          $dtotqc04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt04)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc04 = collect($dtotqc04);   
                                                         

          $dtotcompl04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt04)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl04 = collect($dtotcompl04);      


          $dcompvectordata04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt04)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata04 = collect($dcompvectordata04);   

          $dcompdigitdata04 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt04)
               ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata04 = collect($dcompdigitdata04);
    
        // 04th date  

 // 03th date    

  $us_time = Carbon::now('America/New_York')->addDays(-3);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt03 =  $cdt . '%' ;

       // $cdt03 = '0303-03-02'  . '%' ;

               
        $dtotvectordata03 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt03)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
           // ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata03 = collect($dtotvectordata03);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt03)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata03 = collect($dtotdigitdata03);

           
          $dtotalloted03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt03)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted03 = collect($dtotalloted03);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt03)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved03 = collect($dtotapproved03); 
            
          $dtotqcpending03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt03)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending03 = collect($dtotqcpending03); 
                                                                                                        
          $dtotqc03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt03)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc03 = collect($dtotqc03);   
                                                         

          $dtotcompl03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt03)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl03 = collect($dtotcompl03);      


          $dcompvectordata03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt03)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata03 = collect($dcompvectordata03);   

          $dcompdigitdata03 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt03)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata03 = collect($dcompdigitdata03);
    
        // 03th date  
  
  
   // 02th date    

  $us_time = Carbon::now('America/New_York')->addDays(-2);

        $cdt =  date_format($us_time, 'Y-m-d');
        $cdt02 =  $cdt . '%' ;

       // $cdt02 = '0202-02-02'  . '%' ;

               
        $dtotvectordata02 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt02)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
           // ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata02 = collect($dtotvectordata02);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt02)
                 ->wherein('status' , $stat )
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dtotdigitdata02 = collect($dtotdigitdata02);

           
          $dtotalloted02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt02)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted02 = collect($dtotalloted02);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt02)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved02 = collect($dtotapproved02); 
            
          $dtotqcpending02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt02)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending02 = collect($dtotqcpending02); 
                                                                                                        
          $dtotqc02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt02)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc02 = collect($dtotqc02);   
                                                         

          $dtotcompl02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt02)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl02 = collect($dtotcompl02);      


          $dcompvectordata02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt02)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata02 = collect($dcompvectordata02);   

          $dcompdigitdata02 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt02)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata02 = collect($dcompdigitdata02);
    
        // 02th date  
  
 // 01th date    

  $us_time = Carbon::now('America/New_York')->addDays(-1);

  $cdt =  date_format($us_time, 'Y-m-d');
  $cdt01 =  $cdt . '%' ;

       // $cdt01 = '0101-01-01'  . '%' ;

               
        $dtotvectordata01 = DB::table('orders')
            ->select(DB::raw('sum(file_count) as dtotvect, COALESCE(sum(file_price),0) as dtotvectprice'))
            ->where('bill_dt', 'like',$cdt01)
            ->where('file_type', '=', 'Vector')
            ->wherein('status' , $stat )
           // ->groupby(DB::raw('date_format("bill_dt", "Y-m-d")'))
            ->get();

            $dtotvectordata01 = collect($dtotvectordata01);
            //dd($dtotvectordata30);

               // $tot =  collect($dtotvectordata);

            $dtotdigitdata01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotdigit, COALESCE(sum(file_price),0) as dtotdigitprice'))
                ->where('bill_dt', 'like', $cdt01)
                ->where('file_type', '=', 'Digitizing')
                 ->wherein('status' , $stat )
                ->get();

          $dtotdigitdata01 = collect($dtotdigitdata01);

           
          $dtotalloted01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotallot, COALESCE(sum(file_price),0) as dtotallotedprice'))
                ->where('bill_dt', 'like',$cdt01)
                ->where('status', '=', 'Alloted')
                ->get();

          $dtotalloted01 = collect($dtotalloted01);      
              //  dd($tot);die;
                  
                  // foreach($dtotalloted as $key => $value){
                  //      $tot4[$key] = $value ;
                  // }


          $dtotapproved01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotapprov,COALESCE(sum(file_price),0) as dtotapprovprice'))
                ->where('bill_dt', 'like',$cdt01)
                ->where('status', '=', 'Approved')
                ->get();

          $dtotapproved01 = collect($dtotapproved01); 
            
          $dtotqcpending01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcpend, COALESCE(sum(file_price),0) as dtotqcpendprice'))
                ->where('bill_dt', 'like', $cdt01)
                ->where('status', '=', 'QC Pending')
                ->get();

          $dtotqcpending01 = collect($dtotqcpending01); 
                                                                                                        
          $dtotqc01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dtotqcok, COALESCE(sum(file_price),0) as dtotqcokprice'))
                ->where('bill_dt', 'like',$cdt01)
                ->where('status', '=', 'QC OK')
                ->get();

          $dtotqc01 = collect($dtotqc01);   
                                                         

          $dtotcompl01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompl, COALESCE(sum(file_price),0) as dtotcomplprice'))
                ->where('bill_dt', 'like', $cdt01)
                            ->where('status', '=', 'Completed')
                ->get();

            
          $dtotcompl01 = collect($dtotcompl01);      


          $dcompvectordata01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompvect, COALESCE(sum(file_price),0) as dcompvectprice'))
                ->where('bill_dt', 'like', $cdt01)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Vector')
                ->get();      
               
            
          $dcompvectordata01 = collect($dcompvectordata01);   

          $dcompdigitdata01 = DB::table('orders')
                ->select(DB::raw('sum(file_count) as dcompdigit, COALESCE(sum(file_price),0) as dcompdigitprice'))
                ->where('bill_dt', 'like', $cdt01)
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

          $dcompdigitdata01 = collect($dcompdigitdata01);
    
        // 01th date  
    
   



        return view("layouts.monthlyadmin" , compact('dtotvectordata30',
         'dtotdigitdata30' , 'dtotalloted30', 'dtotapproved30', 'dtotqcpending30', 'dtotqc30' , 'dtotcompl30', 'dcompvectordata30',      'dcompdigitdata30' , 'cdt30' , 'dtotvectordata29',
         'dtotdigitdata29' , 'dtotalloted29', 'dtotapproved29', 'dtotqcpending29', 'dtotqc29' , 'dtotcompl29', 'dcompvectordata29',      'dcompdigitdata29' , 'cdt29' ,
         'dtotvectordata28',
         'dtotdigitdata28' , 'dtotalloted28', 'dtotapproved28', 'dtotqcpending28', 'dtotqc28' , 'dtotcompl28', 'dcompvectordata28',      'dcompdigitdata28' , 'cdt28' ,
         'dtotvectordata27',
         'dtotdigitdata27' , 'dtotalloted27', 'dtotapproved27', 'dtotqcpending27', 'dtotqc27' , 'dtotcompl27', 'dcompvectordata27',      'dcompdigitdata27' , 'cdt27' ,
          'dtotvectordata26',
         'dtotdigitdata26' , 'dtotalloted26', 'dtotapproved26', 'dtotqcpending26', 'dtotqc26' , 'dtotcompl26', 'dcompvectordata26',      'dcompdigitdata26' , 'cdt26' ,
           'dtotvectordata25',
         'dtotdigitdata25' , 'dtotalloted25', 'dtotapproved25', 'dtotqcpending25', 'dtotqc25' , 'dtotcompl25', 'dcompvectordata25',      'dcompdigitdata25' , 'cdt25',
          'dtotvectordata24',
         'dtotdigitdata24' , 'dtotalloted24', 'dtotapproved24', 'dtotqcpending24', 'dtotqc24' , 'dtotcompl24', 'dcompvectordata24',      'dcompdigitdata24' , 'cdt24',
          'dtotvectordata23',
         'dtotdigitdata23' , 'dtotalloted23', 'dtotapproved23', 'dtotqcpending23', 'dtotqc23' , 'dtotcompl23', 'dcompvectordata23',      'dcompdigitdata23' , 'cdt23', 'dtotvectordata22',
         'dtotdigitdata22' , 'dtotalloted22', 'dtotapproved22', 'dtotqcpending22', 'dtotqc22' , 'dtotcompl22', 'dcompvectordata22',      'dcompdigitdata22' , 'cdt22',
   'dtotvectordata21',
         'dtotdigitdata21' , 'dtotalloted21', 'dtotapproved21', 'dtotqcpending21', 'dtotqc21' , 'dtotcompl21', 'dcompvectordata21',      'dcompdigitdata21' , 'cdt21',
          'dtotvectordata20',
         'dtotdigitdata20' , 'dtotalloted20', 'dtotapproved20', 'dtotqcpending20', 'dtotqc20' , 'dtotcompl20', 'dcompvectordata20',      'dcompdigitdata20' , 'cdt20',
          'dtotvectordata19',
         'dtotdigitdata19' , 'dtotalloted19', 'dtotapproved19', 'dtotqcpending19', 'dtotqc19' , 'dtotcompl19', 'dcompvectordata19',      'dcompdigitdata19' , 'cdt19',
         'dtotvectordata18',
         'dtotdigitdata18' , 'dtotalloted18', 'dtotapproved18', 'dtotqcpending18', 'dtotqc18' , 'dtotcompl18', 'dcompvectordata18',      'dcompdigitdata18' , 'cdt18',
          'dtotvectordata17',
         'dtotdigitdata17' , 'dtotalloted17', 'dtotapproved17', 'dtotqcpending17', 'dtotqc17' , 'dtotcompl17', 'dcompvectordata17',      'dcompdigitdata17' , 'cdt17',
        'dtotvectordata16',
         'dtotdigitdata16' , 'dtotalloted16', 'dtotapproved16', 'dtotqcpending16', 'dtotqc16' , 'dtotcompl16', 'dcompvectordata16',      'dcompdigitdata16' , 'cdt16',
          'dtotvectordata15',
         'dtotdigitdata15' , 'dtotalloted15', 'dtotapproved15', 'dtotqcpending15', 'dtotqc15' , 'dtotcompl15', 'dcompvectordata15',      'dcompdigitdata15' , 'cdt15',
          'dtotvectordata14',
         'dtotdigitdata14' , 'dtotalloted14', 'dtotapproved14', 'dtotqcpending14', 'dtotqc14' , 'dtotcompl14', 'dcompvectordata14',      'dcompdigitdata14' , 'cdt14',
      'dtotvectordata13',
         'dtotdigitdata13' , 'dtotalloted13', 'dtotapproved13', 'dtotqcpending13', 'dtotqc13' , 'dtotcompl13', 'dcompvectordata13',      'dcompdigitdata13' , 'cdt13',
         'dtotvectordata12',
         'dtotdigitdata12' , 'dtotalloted12', 'dtotapproved12', 'dtotqcpending12', 'dtotqc12' , 'dtotcompl12', 'dcompvectordata12',      'dcompdigitdata12' , 'cdt12',
         'dtotvectordata11',
         'dtotdigitdata11' , 'dtotalloted11', 'dtotapproved11', 'dtotqcpending11', 'dtotqc11' , 'dtotcompl11', 'dcompvectordata11',      'dcompdigitdata11' , 'cdt11',
          'dtotvectordata10',
         'dtotdigitdata10' , 'dtotalloted10', 'dtotapproved10', 'dtotqcpending10', 'dtotqc10' , 'dtotcompl10', 'dcompvectordata10',      'dcompdigitdata10' , 'cdt10',
          'dtotvectordata09',
         'dtotdigitdata09' , 'dtotalloted09', 'dtotapproved09', 'dtotqcpending09', 'dtotqc09' , 'dtotcompl09', 'dcompvectordata09',      'dcompdigitdata09' , 'cdt09',
          'dtotvectordata08',
         'dtotdigitdata08' , 'dtotalloted08', 'dtotapproved08', 'dtotqcpending08', 'dtotqc08' , 'dtotcompl08', 'dcompvectordata08',      'dcompdigitdata08' , 'cdt08',
          'dtotvectordata07',
         'dtotdigitdata07' , 'dtotalloted07', 'dtotapproved07', 'dtotqcpending07', 'dtotqc07' , 'dtotcompl07', 'dcompvectordata07',      'dcompdigitdata07' , 'cdt07',
          'dtotvectordata06',
         'dtotdigitdata06' , 'dtotalloted06', 'dtotapproved06', 'dtotqcpending06', 'dtotqc06' , 'dtotcompl06', 'dcompvectordata06',      'dcompdigitdata06' , 'cdt06',
 'dtotvectordata05',
         'dtotdigitdata05' , 'dtotalloted05', 'dtotapproved05', 'dtotqcpending05', 'dtotqc05' , 'dtotcompl05', 'dcompvectordata05',      'dcompdigitdata05' , 'cdt05',
      'dtotvectordata04',
         'dtotdigitdata04' , 'dtotalloted04', 'dtotapproved04', 'dtotqcpending04', 'dtotqc04' , 'dtotcompl04', 'dcompvectordata04',      'dcompdigitdata04' , 'cdt04',
      'dtotvectordata03',
         'dtotdigitdata03' , 'dtotalloted03', 'dtotapproved03', 'dtotqcpending03', 'dtotqc03' , 'dtotcompl03', 'dcompvectordata03',      'dcompdigitdata03' , 'cdt03',
      'dtotvectordata02',
         'dtotdigitdata02' , 'dtotalloted02', 'dtotapproved02', 'dtotqcpending02', 'dtotqc02' , 'dtotcompl02', 'dcompvectordata02',      'dcompdigitdata02' , 'cdt02',
       'dtotvectordata01',
         'dtotdigitdata01' , 'dtotalloted01', 'dtotapproved01', 'dtotqcpending01', 'dtotqc01' , 'dtotcompl01', 'dcompvectordata01',      'dcompdigitdata01' , 'cdt01'
     
         ));


     }    

  public function PendingOrder()
  {
            
            $curr_mnth_startdt =  Carbon::now()->startOfMonth();

            $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');


            $curr_date    =  Carbon::now() ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');

                  $curr_pend_order = DB::table('order_dtls')
                 ->select('order_id' , 'file_name',  'file_type', 'document_type', 'allocation')
                 ->where('bill_dt', '>=', $curr_mnthdt)
                 ->where('bill_dt', '<=', $curr_dt )
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

                $cdt =  Carbon::now();
                //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' 
                 $monthYear = date_format($cdt, 'M-Y');
         
                $cdt =  date_format($cdt, 'Y-m-d');

                $us_time =  date_format($us_time, 'Y-m-d');

                //$new_date =  Carbon::now()->subDays(30);  deduct 30 days

                $new_date =  Carbon::now()->startOfMonth();

                $new_date =  date_format($new_date, 'Y-m-d');
               

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
                ->where('status', '=', 'Completed')
                ->where('file_type', '=', 'Digitizing')
                ->get();

                $totdigitdata = collect($totdigitdata);

                foreach($totvectordata as $key =>$value){
                       $tot1[$key] = $value ;
                }
                
                //dd($tot);die;
                foreach($totdigitdata as $key => $value){
                       $tot2[$key] = $value ;
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


                $tot = array_merge($tot1, $tot2,$tot3, $tot4, $tot5, $tot6, $tot7, $tot8);
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

            $curr_date    =  Carbon::now() ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');

                  $curr_pend_order = DB::table('order_dtls')
                 ->select('order_id' , 'file_name',  'file_type', 'document_type', 'allocation')
                 ->where('bill_dt', '>=', $curr_mnthdt)
                 ->where('bill_dt', '<=', $curr_dt )
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
}