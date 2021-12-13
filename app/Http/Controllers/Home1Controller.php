<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
//use App\Notifications\MyEventNotification;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

use App\Models\User;

use App\Models\GroupMaster;

use App\Models\GroupUser;


use DB;
use App\Models\Client;
use App\Notifications\OrderStatusNotification;

use App\Notifications\ClientStatusNotification;

class Home1Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  //  public function index()
  //  {
   //     return view('layouts.tabledashboard');
   // }

public function index()
    {
        //return view('dashboard');

      //dd('hello');

       // auth()->login(User::first()); to log as first user

        $user = User::orderBy('name', 'asc')->get();
        //return view('home', compact('user'));
        return view('welcome', compact('user'));
    }


      public function index1(REQUEST $request)
    {
           $req_data = $request->all();
         // dd($req_data);
        // $topfivecustomer_data=DB::select($topfivecustomer_sql);

        // $stat_sql="SELECT (SELECT COUNT(*) FROM order_headers WHERE AmountDue IS NOT NULL $wherebranch $wheredate) as SalesOrder, (SELECT COALESCE(SUM(CashDiscountAmount),0) FROM order_headers WHERE AmountDue IS NOT NULL AND CashDiscountAmount > 0 $wherebranch $wheredate) as DiscountOrder, (SELECT COALESCE(SUM(GSTAmountUsed),0) FROM order_headers WHERE AmountDue IS NOT NULL AND GSTAmountUsed > 0 $wherebranch $wheredate) as TaxOrder ";
        // $stat_data=DB::select($stat_sql);
        // //echo "<pre>",print_r($stat_data),"</pre>";die;



        $company_list = Client::where('created_at', '>=', '2019-01-01')->pluck('client_company', 'company_id')->toArray();

             $from_date= '2020-01-01 04:00';
            $to_date='2020-03-31 04:00';
        if ( $request->has('from_date') && $request->has('to_date')) {
             $from_date=date('Y-m-d H:i',strtotime($req_data['from_date']));
             $to_date=date('Y-m-d H:i',strtotime($req_data['to_date']));
        }


          $wheredate=" where orders.bill_dt >= '".$from_date."' AND orders.bill_dt <= '".$to_date."' ";
        //dd($company_list);

            $stat_sql="SELECT (SELECT COUNT(*) FROM orders $wheredate) SalesOrder"  ;
         $stat_data=DB::select($stat_sql);

         //dd($stat_data);

          $wherecompleted=" AND orders.status ='Completed' ";
          $whererevcompleted=" AND orders.status ='Rev-Completed' ";

          $wherechcompleted=" AND orders.status ='Ch-Completed' ";


          $totalSalesSql="SELECT (select SUM(file_price) FROM orders $wheredate)  SalesTotal ,(SELECT COUNT(DISTINCT company_id) FROM orders  $wheredate)  TotalCustomer, (SELECT COUNT(*) FROM orders  $wheredate) as SalesOrder, (SELECT COUNT(*) FROM orders  $wheredate $wherecompleted)  Completed,  (SELECT COUNT(*) FROM orders  $wheredate $whererevcompleted)  RevCompleted, (SELECT COUNT(*) FROM orders  $wheredate $wherechcompleted)  ChCompleted" ;

           $sales_data=DB::select($totalSalesSql);



             $topfivefranchises_sql="SELECT  SUM(file_price) as total_amount,COUNT(orders.order_id) as total_order,clients.client_company FROM orders  inner join clients on clients.company_id=orders.company_id ".$wheredate." GROUP BY clients.client_company ORDER BY total_amount DESC LIMIT 5";


        $topfivefranchises_data=DB::select($topfivefranchises_sql);

       // dd($topfivefranchises_data);

        $franchises_sql="SELECT COUNT('orders.order_id') as total_order, file_type FROM orders  where bill_dt >='2019-01-01' group by file_type";

        $franchises_data=DB::select($franchises_sql);
        $new_chart_array = [];
        $statuts_string = "";
        $order_chart = array();
        foreach ($franchises_data as $data) {
            $statuts_string .= "{y:".$data->total_order."},";
            $new_chart_array[] = $data->file_type;
        }
        $statuts_string = rtrim($statuts_string,",");
        $chart_data['x'] = json_encode($new_chart_array);
        $chart_data['y'] = $statuts_string;
        $pendingOrders = DB::table('orders')->select(DB::raw('COUNT("order_id") as Pendingorders'))->where('Status','QC Pending')->first();
        $order_chart['chart_data'] = $chart_data;

        ///  added below for chart


       //echo "<pre>",print_r($series),print_r($nseries),print_r($main_series);die;
      $ordercnt=0; // inserted by prashant


      //added for graphs  below code
        $orders = DB::table('orders')
                ->select(DB::raw('DATE_FORMAT(order_us_date, "%Y%m") as yrmonth'))
                 ->where('bill_dt', '>=', $from_date)
                    ->where('bill_dt', '<=', $to_date)
                    ->where('file_price','>', 0)
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
                            ->whereYear('bill_dt', '=', $yr)
                            ->whereMonth('bill_dt', '=', $mn)
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
                            ->whereYear('bill_dt', '=', $yr)
                            ->whereMonth('bill_dt', '=', $mn)
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
                            ->whereYear('bill_dt', '=', $yr)
                            ->whereMonth('bill_dt', '=', $mn)
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


     // return view('Admin.dashboard',compact('hourswithmddate','hours','series','req_data','franchise_list','stat_data','topfiveagent_data','topfivefranchises_data','topfivecustomer_data','sales_data','order_chart','pendingOrders','ordercnt'));
        return view('Admin.dashboard', compact('from_date', 'to_date', 'company_list',  'stat_data', 'topfivefranchises_data', 'sales_data', 'req_data', 'order_chart', 'pendingOrders', 'ordercnt'))->with('orders1', json_encode($orders1,JSON_NUMERIC_CHECK) )->with('orders2', json_encode($orders2,JSON_NUMERIC_CHECK) )->with('orders3', json_encode($orders3,JSON_NUMERIC_CHECK))->with('orders4', json_encode($orders4,JSON_NUMERIC_CHECK) );
    }



    public function saveToken(Request $request)

    {

        auth()->user()->update(['device_token'=>$request->token]);

        return response()->json(['token saved successfully.']);

    }



    /**

     * Write code on Method

     *

     * @return response()

     */



public function sendNotification()
{

 $group = GroupMaster::find(1);

  //$user = User::join('');

 // $user =  GroupUser::getuser($group->id);



//dd($user);

$user = User::find(1);

//$user = User::all();

 // dd($user);


  //dd($users);

  $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            //'order_id' => 101
           //  'actionURL' => url('/'),
            'detail' => 101,
            'url'=> url('/'),

        ];

       // $details = 'GOOD MORNING  , HELLOW HOW ARE YOU?';

     // Notification::send($user, new OrderStatusNotification($details));  working

       Notification::send($user, new ClientStatusNotification($details));

       // Notification::send($group, new OrderStatusNotification($details));

        //$user->notify(new OrderStatusNotification('hello'));
        // event(new \App\Events\SendMessage());

        return 'hello';
}


    public function sendNotification_old(Request $request)

    {

        $touser = array() ;

        //dd($request->touser);

        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        if($request->has('touser')) {
              $touser =  $request->touser ;
          $firebaseToken = User::whereIN('id',  $touser)->pluck('device_token')->all();

                  //dd($firebaseToken);
        }






        $SERVER_API_KEY = '';



        $data = [

            "registration_ids" => $firebaseToken,

            "notification" => [

                "title" => $request->title,

                "body" => $request->body,

            ]

        ];

        $dataString = json_encode($data);



        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];



        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);



        $response = curl_exec($ch);



      //  dd($response);

    }







}
