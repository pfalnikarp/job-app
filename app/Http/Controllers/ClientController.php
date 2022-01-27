<?php
namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;

use Yajra\Datatables\Datatables;
use App\Models\Client ;
use App\Models\ClientDtl ;

use App\Models\PersonLog ;
use App\Models\SystemUserlog ;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Rules\AlphaSpaces;
use Validator, Input, Redirect; 
use App\Models\User;
use App\Models\Portaldetail;
use Spatie\Activitylog\Models\Activity;
use App\Models\Work_detail;


class ClientController extends Controller
{
     /**
     * Displays datatables front end viewuser
     *
     * @return \Illuminate\View\View
     */
      public function __construct()
    {

        $this->middleware(function ($request, $next) {
             //$this->user = auth()->user();
            //    dd(Auth::user());
             $this->user =  Auth::user();
             //$username =  auth()->user()->name;

             //dd(auth()->user()->name);

             $username =  Auth::user()->name;
          // dd($username);
             // if( $username  =='prashant' || $username  =='kulind'  )
             // {
             //    return $next($request);
             // }
             // else
             // {
             //    abort(403, 'Unauthorized action.');
             // }

              // if (!($this->user->hasRole('admin'))) {
              //        abort(403, 'Unauthorized action.');
              //     }
              // else {
              //         return $next($request);
              // }

              //  dd('not ok');
             
                  return $next($request);

             
    });
 
        //   if( auth()->user()->name  =='prashant' || auth()->user()->name  =='kulind'  )
        //  { 
        //    $this->middleware('auth');
        // }
        // else
        // {
        //    abort(403, 'Unauthorized action.');
        // }

            
    }



    public function getIndex1()
    {
         //        return view('Clients.index');
        //dd("hello index"); 
    
       // $client_id = 1;
       // $client=Client::find($client_id);

        $client = DB::table('clients')->first();

        return view('clients.index',compact('client'));
    }


     public function getIndex()
    {
       // return view('datatables.index');
        //$user = User::where('username', '=', 'admin')->first();
        //$user->attachRole($admin);
      //$user = auth()->user();
       $user =  auth()->user();
       
      

        //dd( $decrypted["_previous"] );die;
       if (!($user->hasPermission('client.show'))) {
            abort(403, 'Unauthorized action.');
          }
     
        $client=Client::first();
        return view('clients.index',compact('client', 'user'));
    }


    public function index1()
    {
       // $clients=Client::all();
        // $client_id = 4;
        // $client=Client::find($client_id);
      if (!(auth()->user()->hasRole('admin'))) {
            abort(403, 'Unauthorized action.');
          }
      
      if (auth()->user()->hasRole(['owner', 'admin']) && can('read-gmails')) {
     
                 $client = DB::table('clients')->first();
                return view('clients.index',compact('client'));
            }
      else {
          return view('errors.403');
       }
 
    }
  
   


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData1()
    {
        return Datatables::of(Client::query())
      ->addColumn('action', function ($user) {
                return  view('partials.datatablesclients', ['client_id' => $user->client_id])->render();
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
           
            // ->editColumn('client_id', '{{$client_id}}')
            // ->setRowId('client_id')
            // ->setRowClass(function ($user) {
            //     return $user->client_id % 2 == 0 ? 'alert-success' : 'alert-warning';
            // })
            // ->setRowData([
            //     'client_id' => 'test',
            // ])
            // ->setRowAttr([
            //     'color' => 'red',
            // ])
            ->make(true);
    }


     public function anyData($id)
    {

         $value= 0;

                  if($id== 'All'){
                     $clients =DB::table('clients')->leftJoin('client_dtls', 'clients.id', '=', 'client_dtls.client_id')
                    ->select('clients.id', 'clients.client_company', 'clients.phone', 'clients.website','clients.client_address1', 'clients.client_state', 'clients.client_country','clients.created_at','clients.updated_at','clients.created_by','clients.updated_by','clients.timezone_type','clients.unit_price','clients.digit_rate','clients.store_type','clients.other_state','clients.client_source','clients.csr_person','clients.client_specific','clients.company_id',DB::raw('group_concat(client_dtls.client_name) AS cdclient_name'),DB::raw('group_concat(client_dtls.client_email_primary) AS cdclient_email_primary'),DB::raw('group_concat(client_dtls.client_contact_1) AS cdclient_contact_1'),DB::raw('group_concat(client_dtls.client_note) AS cdclient_note'),DB::raw('group_concat(client_dtls.black_list) AS cdblack_list'),DB::raw('group_concat(client_dtls.black_list_reason) AS cdblack_list_reason'),DB::raw('group_concat(client_dtls.client_creation_date_time) AS cdclient_creation_date_time'))
                    ->where([['clients.delete_flag', '=', 'N'],['client_dtls.delete_flag', '=', 'N']])
                     ->distinct()->groupBy('clients.id', 'clients.client_company', 'clients.phone', 'clients.website','clients.client_address1', 'clients.client_state', 'clients.client_country','clients.created_at','clients.updated_at','clients.created_by','clients.updated_by','clients.timezone_type','clients.unit_price','clients.digit_rate','clients.store_type','clients.other_state','clients.client_source','clients.csr_person','clients.client_specific','clients.company_id');
                  }
                  else{
                  $clients =DB::table('clients')->leftJoin('client_dtls', 'clients.id', '=', 'client_dtls.client_id')
                    ->select('clients.id', 'clients.client_company', 'clients.phone', 'clients.website','clients.client_address1', 'clients.client_state', 'clients.client_country','clients.created_at','clients.updated_at','clients.created_by','clients.updated_by','clients.timezone_type','clients.unit_price','clients.digit_rate','clients.store_type','clients.other_state','clients.client_source','clients.csr_person','clients.client_specific','clients.company_id',DB::raw('group_concat(client_dtls.client_name) AS cdclient_name'),DB::raw('group_concat(client_dtls.client_email_primary) AS cdclient_email_primary'),DB::raw('group_concat(client_dtls.client_contact_1) AS cdclient_contact_1'),DB::raw('group_concat(client_dtls.client_note) AS cdclient_note'),DB::raw('group_concat(client_dtls.black_list) AS cdblack_list'),DB::raw('group_concat(client_dtls.black_list_reason) AS cdblack_list_reason'),DB::raw('group_concat(client_dtls.client_creation_date_time) AS cdclient_creation_date_time'))
                    ->where([['clients.delete_flag', '=', 'N'],['client_dtls.delete_flag', '=', 'N']])
                    ->whereRaw("FIND_IN_SET(?, clients.store_type) > 0", [$id])
                     ->distinct()->groupBy('clients.id', 'clients.client_company', 'clients.phone', 'clients.website','clients.client_address1', 'clients.client_state', 'clients.client_country','clients.created_at','clients.updated_at','clients.created_by','clients.updated_by','clients.timezone_type','clients.unit_price','clients.digit_rate','clients.store_type','clients.other_state','clients.client_source','clients.csr_person','clients.client_specific','clients.company_id');
                   }
          
         return Datatables::of($clients)
           
         
            ->make(true);
          
    }


     public function create()
     {
    
        $salses=DB::table('userrole_data')->where('rolename', 'sales')->select('name','id')->get();
        return view('clients.omscreateclient.view',compact('salses'));

  }

public function store(Request $request)
{   
    $request->flash();
    $input = $request->all();
    //dd($input);
    
    // removed on 14/07/17  as giving duplicate error  |unique:clients
    $this->validate($request, [
          'client_company' => 'bail|required|max:255',
          'country'=>'required',
          'state'=>'required',
          'client_source'=>'required',
          'company_email.*' => 'bail|required',
          'company_email.*' => ['regex:/^([\w\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/'],   
       
    ]);
    
    //company email unique validation
    foreach ($request->company_email as $key => $value) {
          $email_count =  Client::whereRaw("FIND_IN_SET(?, email) > 0", $value)->where('delete_flag','=','N')->count();
          if($email_count > 0)
          {
              Session::flash('flash_message', 'Company Email is Duplicate');
              return back()->withInput($request->input());
      
          }
          
    }
    //client email unique validation
    foreach ($request->client_email_primary as $key => $value) {
      if($value == null){
           $email_count=0;
      }
      else{
          $email_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_email_primary) > 0", $value)->where('delete_flag','=','N')->count();
          if($email_count > 0)
          {
             Session::flash('alert-warning', 'Client Primary Email is Duplicate');
             return back()->withInput($request->input());
      
          }
      }  
          
    }
    //company phone validation
    foreach ($request->company_phone as $key => $value) {
        if($value == null){
           $cophone_count=0;
        }
        else{
          $cophone_count =  Client::whereRaw("FIND_IN_SET(?, phone) > 0", $value)->where('delete_flag','=','N')->count();
          if($cophone_count > 0)
          {
              Session::flash('flash_message', 'Company Email is Duplicate');
              return back()->withInput($request->input());
      
          }
        }
          
      }
    //client phone validation
    foreach ($request->client_contact_1 as $key => $value) {
        if($value == null){
           $clphone_count=0;
        }
        else{
          $clphone_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_contact_1) > 0", $value)->where('delete_flag','=','N')->count();
          if($clphone_count > 0)
          {
              Session::flash('flash_message', 'Client Contact is Duplicate');
              return back()->withInput($request->input());
      
          }
        }
          
      }
         
    $result = DB::transaction(function() use ($request) {     

      try {
        

          $input = $request->all();         

          $userid =  auth()->user()->id;

          $max_compid = 0 ;

          $max_compid = DB::table('clients')->max('company_id');
          
          $max_compid = substr($max_compid, -4) + 1 ;

          $cdt =  Carbon::now('Asia/Kolkata');
          $us_time = Carbon::now('America/New_York');
          //$new_dt =  $cdt->year . $cdt->month .$cdt->day .'C001' ;
          //$new_dt =  substr($cdt->year, 2, 2) . $cdt->month  ;
          $new_dt =  $cdt->year . str_pad($cdt->month ,2, '0', STR_PAD_LEFT)  ;
          // dd($new_dt);die;
          $client_company =  ucwords(trim($request->input('client_company')));
          $comp_id =  'CO' . $new_dt . str_pad($max_compid, 4, '0', STR_PAD_LEFT) ;
   
          if (!empty($request ->input('unit_price'))) {
              $unit_price = $request ->input('unit_price');
             }
          else {
               $unit_price = 0 ;
              }

              if (!empty($request->input('digit_rate'))) {
              $digit_rate = $request ->input('digit_rate');
             }
             else{
               $digit_rate = 0 ;
             }
              //  success return
 
                $message = "succcess";

                $csr_personid = $input['csr_personid'];
                //dd($csr_personid);
                $csr_person = '' ;

                if ($csr_personid <> '0') {
                    $person = User::find($csr_personid);
                    $csr_person =  $person->name ;
                 }   
                $store_type=implode(",",$request->input('store_type'));
                $emails=implode(",",$request->input('company_email'));
                $phones=implode(",",$request->input('company_phone'));
                if($request->input('state') == null ){
                         $state= (string)$request->input('other_state');
                }
                else{
                         $state= (string)$request->input('state');
                }
                if($request->input('county') == null){
                        $county= (string)$request->input('other_county');
                    
                }
                else{
                         $county= (string)$request->input('county');
                }
                
                $data = array(
                    'company_id' =>  $comp_id,
                    'client_company' => $client_company ,
                    'website'    => (string)$request->input('website'),
                    'email'       =>$emails,
                    'phone'      =>$phones,
                    'store_type' => $store_type,
                    'industry' => (string)$request->input('industry'),
                    'unit_price' => $unit_price,
                    'digit_rate' => $digit_rate,
                    'client_specific'=>(string)$request->input('client_specific'),
                    'unitno' => (string)$request->input('unit_no'),
                    'client_address1' => (string)$request->input('street_name'),
                    'client_address_line2' => (string)$request->input('address_line_2'),
                    'client_country'    => (string)$request->input('country'),
                    'client_state'  => $state,
                    // 'other_state' => (string)$request->input('other_state'),
                    'city' => $county,
                    'zipcode'  => (string)$request->input('zip_code'),
                    'timezone_type'  => (string)$request->input('time_zone'),
                    'about_company'  => (string)$request->input('aboutcompany'),
                     
                    'client_source' => (string)$request->input('client_source'),
                    'csr_personid' => (string)$request->input('csr_personid'),
                    'csr_person' =>  $csr_person,
                    'red_list' =>'N',
                    'created_by' => $userid,
                    'updated_by' => $userid,
                       
                );


              
               // $j = DB::table('clients')->insertGetId($data);removed as logic changed to  eloquent insert on 24-01-22
              $client =  Client::create($data);
              $j = $client->id ;

                $j_history = DB::table('clients_history')->insertGetId($data);
              
   
            
                if($j > 0) 
                {
                    for($i=0;$i <count($input['first_name']);$i++)
                    {
                        $max_client_id = 0 ;

                        $max_client_id = DB::table('client_dtls')->max('client_creation_id');
          
                        $max_client_id = substr($max_client_id, -4);

                        $max_client_id = $max_client_id + 1 ;

                        $new_client = 'CL'. $new_dt . str_pad($max_client_id, 4, "0", STR_PAD_LEFT);

                       if ($request->input('client_note')[$i] <> '') {
                            $cnote = $request->input('client_note')[$i];
                        }
                        else {
                            $cnote = "Not Defined";
                        }
                        
                        $clientemail=implode(',', $request->client_email_primary[$i]);
                        $clientphone=implode(',', $request->client_contact_1[$i]);
               
                        $datadetail = array(
                            'client_id' => $j,
                            'client_creation_id' => 'CL'. $new_dt . str_pad($max_client_id, 4, "0", STR_PAD_LEFT) ,
                            'first_name'=>  ucwords(trim($input['first_name'][$i])),
                            'last_name' =>  ucwords(trim($input['last_name'][$i])),
                            'client_name' => ucwords(trim($input['first_name'][$i])) ." ". ucwords(trim($input['last_name'][$i])),
                            'client_company' => $client_company,
                            'client_email_primary'=> $clientemail,
                            'client_contact_1'  => $clientphone,
                            'client_note'  => $cnote,
                            'client_creation_date_time' => $us_time,
                            'created_by' => $userid,
                            'updated_by' => $userid,
                            'company_id'  => $comp_id,
                            'cunitno' => $input['cunitno'][$i],
                            'cstreetname'=> $input['cstreet'][$i],
                            'ccountry'=> $input['ccountry'][$i],
                            'cstate'=> $input['cstate'][$i]  ?? null,
                            'ccity'=> $input['ccounty'][$i] ?? null,
                            'czipcode'=> $input['czipcode'][$i],
                            'designation'=> $input['designation'][$i],
                            'linkedin_url'=>$input['linkedin_url'][$i],
                            'self_client_specification'=>$input['self_client_specification'][$i],

                                                );


                          DB::table('client_dtls')->insert($datadetail);

                          DB::table('client_dtls_history')->insert($datadetail);
                   

                }
          //throw new Exception("Some error message");
        } 
            Session::flash('flash_message', 'Company and Client successfully added!' );
          if($request->submitbutton == "formsubmit"){
               return redirect()->route('clients.index');
             //return view('clients.index');
          }
          else{
            return redirect()->action('ClientController@createworkseat', ['id'=> $j]);
          }
      
    } catch (\Exception $e) { 
          //dd("problem hi problem");die;
          //dd("hello");die;
         // dd( $e->getMessage());die;
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Errors in Saving, Contact IT Department' );
          DB::rollBack();
          //return redirect()->action('ClientController@edit', ['id'=> $cid]);
          return redirect()->back()->withErrors(['errors' => $e->getMessage() . $e->getLine()]); 
          //return redirect('clients/create')->withErrors(['errors' => $e->getMessage()]); NOT WORKING
          //return redirect()::back()->withErrors(['errors' => $e->getMessage()]);  error of static
          //return redirect()->action('ClientController@create')->withErrors(['errors' => $e->getMessage()]);
      }


    });

    return $result;
  }

  public function workseatstore(Request $request){
 
        $v = Validator::make($request->all(), [
                'department'=>'bail|required',
                'amount'=>'required',
                'workcountry'=>'required',
                'resourcebilling'=>'required',
                'generateinvoicing'=>'required',
                'csr1'=>'required',
                'emp1'=>'required',
                
           ]);   
          if( $v->fails()){

                   return Redirect::back()->withErrors($v);

          } 
          if ($request->has('day')) {
                $days=implode(',',$request->day);
                $hours=implode(',',$request->hour);
                $times=implode(',',$request->time);
          }
          else{
                $days="";
                $hours=",,,,,,";
                $times=",,,,,,";
          }
          $workstore=new Work_detail;    
            $workstore->department=implode(',',$request->department);
            $workstore->seattype='Fixed';
            $workstore->seatslot=$request->seat_slot;
            $workstore->noofhours=$request->noofhours;
            $workstore->client_id=$request->client_id;
          if($request->workcountry != "Other"){
            $workstore->wcountry=$request->workcountry;
          }
          else{
            $workstore->wcountry=$request->othercountry;
          }
          if($request->worktimezone == "Other"){
             $workstore->wtimezone=$request->othertimezone;
          }
          else{
             $workstore->wtimezone=$request->worktimezone;
          }
            $workstore->billing=$request->resourcebilling;
            $workstore->invoice=$request->generateinvoicing;
            $workstore->currency=$request->currency;
            $workstore->amount=$request->amount;
            $workstore->days=$days;
            $workstore->hours=$hours;
            $workstore->worktime=$times;
            $workstore->work_created_user_id=Auth::user()->id;
            $workstore->media_type=implode(',',$request->media_type);
            $workstore->portal_url=implode(',',$request->portal_url);
            $workstore->portal_username=implode(',',$request->username);
            $workstore->portal_password=implode('(,new)',$request->password);
            $workstore->portal_detail=implode(',',$request->portaldetail);
            $workstore->csr1=$request->csr1;
            $workstore->csr2=$request->csr2;
            $workstore->emp1=$request->emp1;
            $workstore->emp2=$request->emp2;
          $workstore->save();
           Session::flash('flash_message', 'Virtual Assistant Added Successfully');        
      return Redirect::back();
     
  }
        public function storedtl(Request $request)
        {
              // dd("hello store"); die;
              $id = Auth::id();
              $input = $request->all();
              $input['created_by'] = $id ;
              $input['updated_by'] = $id ;
              //$comment = new Comment();

             // $comment->save();
               ClientDtl::create($input);

               //Session::flash('flash_message', 'Client successfully added!');
             
               $response = array(
                    'status' => 'success',
                    'msg' => 'Successfully created',
                );
                return response()->json([$response]);
             //return redirect()->back();
        }
  

      public function  showcompany($id=null)
      {
          $client=Client::find($id);
        // dd($client->client_company);
            $company_id = $client->company_id;
            $company_name =  $client->client_company;

    $inv_summary = DB::table('invoice_summary')
        ->select(DB::raw('yr_month, sum(inv_amount) as invamt, invoice_no as inv_no, sum(amt_paid_usd) as amtrec'))
        ->where('company_id', '=', $company_id)
                ->groupBy('yr_month', 'inv_no')
                 ->get();

            //     dd($inv_summary);

        return view('clients.show',compact('inv_summary', 'company_name'));
             // $client=Client::find($id);
             // return view('clients.show',compact('client'));
      }

     //  Removed for ajax call on 02/09/2016
     // public function edit($id)
     // {
     //        $client=Client::find($id);
     //         return view('clients.edit',compact('client'));


     // }


    public function edit($id)
     {
       
        $cid = $id ;
        $client=Client::find($cid);
        $result = DB::table('client_dtls')->where('client_id', $cid)
                    ->where('delete_flag','N')->get();
         $clientdtls= $result->toArray();

       //activity log inserted on 18/03/2020
        $Dtl = DB::table('client_dtls')->where('client_id' ,'=', $id)->get();

         $child_id = array();
         foreach ($Dtl as $key) {
            $child_id[]= (int)$key->id ;
         }
                
         $lastq = Activity::WhereIn('subject_id', $child_id)->where("subject_type","=","App\Models\ClientDtl")->Orderby('created_at','desc');

        //   dd($lastq);

         $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Models\Client")->union($lastq)->Orderby('created_at','desc')->get()->toArray();

         //dd($lastActivity);
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 

        foreach ($lastActivity as $multi ) {

           //dd($multi['properties']);
                 $user_id  =   $multi['causer_id'];
                 $user_name  = User::find($user_id);
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }
       //activity log code above
      
      //salse user data
        $salses=DB::table('userrole_data')->where('rolename', 'sales')->select('name','id')->get();
    
        return view('clients.omseditclient.view', compact('client', 'clientdtls', 'cols','salses'));

     }
     public function show($id){
        $cid = $id ;
        $client=Client::find($cid);
       
        $result = DB::table('client_dtls')->where('client_id', $cid)
                    ->where('delete_flag','N')->get();
        $clientdtls= $result->toArray();

       //activity log inserted on 18/03/2020
        $Dtl = DB::table('client_dtls')->where('client_id' ,'=', $id)->get();

         $child_id = array();
         foreach ($Dtl as $key) {
            $child_id[]= (int)$key->id ;
         }
                
         $lastq = Activity::WhereIn('subject_id', $child_id)->where("subject_type","=","App\Models\ClientDtl")->Orderby('created_at','desc');

        //   dd($lastq);

         $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Models\Client")->union($lastq)->Orderby('created_at','desc')->get()->toArray();

         //dd($lastActivity);
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 

        foreach ($lastActivity as $multi ) {

           //dd($multi['properties']);
                 $user_id  =   $multi['causer_id'];
                 $user_name  = User::find($user_id);
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }
       //activity log code above
      
      //salse user data
        $salses=DB::table('userrole_data')->where('rolename', 'sales')->select('name','id')->get();
    
        return view('clients.omsshowclient.view', compact('client', 'clientdtls', 'cols','salses'));
     }

      // Copied from dtatabelescontroller on 17/07/17   but not working
      public function edit2(Client $client, Request $request = null)
      {  
           // dd("hello");
            //dd($request->input('client_id')); exit;
              
             $client=Client::find($request->input('client_id'));
             ///return view('customers.edit',compact('customer'));


            if ($request->ajax()) {


                $response = array(
                    'client_id'  => $client->client_id,
                    'client_name' => $client->client_name,
                    'client_email_primary' => $client->client_email_primary,
                    'client_company' => $client->client_company,
                    'client_state' => $client->client_state,
                     );
                
                  return response()->json([$response]);
            }
            else
            {
                 
                  return view('clients.index',compact('client'));
            }

            


     }


     //   public function edit(Client $client, Request $request)
     //  {  
     //        // dd("hello edit");
     //        //   dd($client->client_id);exit;
     //         $client=Client::find($client->client_id);
     //         ///return view('customers.edit',compact('customer'));


     //        if ($request->ajax()) {


     //            $response = array(
     //                'client_id'  => $client->client_id,
     //                'client_name' => $client->client_name,
     //                'client_email_primary' => $client->client_email_primary,
     //                'client_company' => $client->client_company,
     //                'client_state' => $client->client_state,
     //                 );
                
     //              return response()->json([$response]);
     //        }
     //        else
     //        {
                 
     //              return view('clients.index',compact('client'));
     //        }

            


     // }
//update company only by divyaraj
public function update($id ,Request $request)
{
      //dd($request->all());die;
   
       
      $this->validate($request, [
            'client_company' => 'bail|required|max:255',
            'client_email_primary.*' => 'bail|required',
            'state'  =>'required',
            'country'    => 'required',
            'client_email_primary.*' => ['regex:/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/']

      ]);
      //company mail duplicate validation
      foreach ($request->company_email as $key => $value) {
          $email_count =  Client::whereRaw("FIND_IN_SET(?, email) > 0", $value)->where([['delete_flag','=','N'],['id','!=',$id]])->count();
          if($email_count > 0)
          {
             Session::flash('alert-warning', 'warning');
             Session::flash('flash_message1', 'Company Email is Duplicate');
              return back()->withInput($request->input());
      
          }
          
      }

      //company phone dulicate validation
      foreach ($request->company_phone as $key => $value) {
         if($value == null){
           $phone_count=0;
        }
        else{
          $phone_count =  Client::whereRaw("FIND_IN_SET(?, phone) > 0", $value)->where([['delete_flag','=','N'],['id','!=',$id]])->count();
          if($phone_count > 0)
          {
              Session::flash('alert-warning', 'warning');
              Session::flash('flash_message1', 'Company Phone is Duplicate');
              return back()->withInput($request->input());
      
          }
      }
          
      }


      $result = DB::transaction(function() use ($request, $id) {        
        try {

            $cid = $id ;

            $input = $request->all();

            $cdt =  Carbon::now('Asia/Kolkata');
            $new_dt =  $cdt->year . str_pad($cdt->month ,2, '0', STR_PAD_LEFT);

            $client=Client::find($cid);

            $company_id =  $client->company_id ;

            // ADDED BELOW CODE FOR ACTIVITY LIKE LOG ON  07.08.19  added on 17/10/18

            $person_id =   auth()->user()->id;
            $person_name =  auth()->user()->name ;
            $columns_modified = '';
            $what_modify = '' ;
            $old_companynm = $client->client_company;
            $new_companynm = ucwords(trim($request->input('client_company')));

             // insert this code in omsv3.com on 13/10/18
            if( $new_companynm <> $old_companynm ) {
              
              $columns_modified = 'client_company' ;
             
              $what_modify  =  "Company Name changed from " . $old_companynm . " to " . $new_companynm . 'and related orders can be found in SystemUserlog' ;

            

                DB::table('orders')->where('company_id', '=', $company_id)->update(['client_company' => $new_companynm]);

            }

            // added on17/10/18 for  person log


            $client_crid = ClientDtl::where('client_id', $cid)->pluck('client_creation_id');
              
            $userid = Auth::id();
              
    
                  $message = "succcess";

                 $csr_personid = $input['csr_personid'];
                 $csr_person = '' ;

                if ($csr_personid <> '0') {
                    $person = User::find($csr_personid);
                    $csr_person =  $person->name ;
                 }   

                $red_list = (string)$request->input('red_list');
                $red_list_details = (string)$request->input('red_list_details');
                 if($red_list == 'N'){
                    $red_list_details = '';
                   
                }
                if($red_list == 'Y'){
                
                   
                }
                $store_type=implode(",",$request->input('store_type'));
                $comemails=implode(",",$request->input('company_email'));
                $comphones=implode(",",$request->input('company_phone')); 


                $client->update([
               
                      'client_company' => (string)ucwords(trim($request->input('client_company'))),
                      'website'        => (string)$request->input('website'),
                      'phone'          => $comphones,
                      'email'          => $comemails,
                      'client_address1' => (string)$request->input('street_name'),
                      'client_state'  => (string)$request->input('state'),
                      'client_country'    => (string)$request->input('country'),
                      'timezone_type'  => (string)$request->input('time_zone'),
                      'unit_price' => (float)$request->input('unit_price'),
                      'digit_rate' => (float)$request->input('digit_rate'),
                      'store_type' => $store_type,
                      'created_by' => (int)$userid,
                      'updated_by' => (int)$userid,
                      'updated_at' =>  Carbon::now(),
                      //'other_state' => (string)$request->input('other_state'),
                      'client_source' => (string)$request->input('client_source'),
                      'csr_personid' => $csr_personid,
                      'csr_person' =>  $csr_person,
                      'client_specific'  => (string)$request->input('company_specific'),
                      'red_list'  => $red_list,
                      'red_list_details'  => $red_list_details,
                      'unitno'=>(string)$request->input('unit_no'),
                      'client_address_line2'=>(string)$request->input('address_line_2'),
                      'city'=>(string)$request->input('county'),
                      'zipcode'=>(string)$request->input('zip_code'),
                      'about_company'=>(string)$request->input('aboutcompany'),
                      'industry'=>(string)$request->input('industry'),
                      
                  ]);
                  

                 DB::table('clients_history')->insert([
                      'client_company' => (string)ucwords(trim($request->input('client_company'))),
                      'company_id'=>$request->company_id,
                      'website'        => (string)$request->input('website'),
                      'phone'          => $comphones,
                      'email'          => $comemails,
                      'client_address1' => (string)$request->input('client_address1'),
                      'client_state'  => (string)$request->input('state'),
                      'client_country'    => (string)$request->input('country'),
                      'timezone_type'  => (string)$request->input('zip_code'),
                      'unit_price' => (float)$request->input('unit_price'),
                      'digit_rate' => (float)$request->input('digit_rate'),
                      'store_type' => $store_type,
                      'created_by' => (int)$userid,
                      'updated_by' => (int)$userid,
                      'updated_at' =>  Carbon::now(),
                      //'other_state' => (string)$request->input('other_state'),
                      'client_source' => (string)$request->input('client_source'),
                      'csr_personid' => $csr_personid,
                      'csr_person' =>  $csr_person,
                      'client_specific'  => (string)$request->input('company_specific'),
                      'red_list'  => $red_list,
                      'red_list_details'  => $red_list_details,
                      'unitno'=>(string)$request->input('unit_no'),
                      'client_address_line2'=>(string)$request->input('address_line_2'),
                      'city'=>(string)$request->input('county'),
                      'zipcode'=>(string)$request->input('zip_code'),
                      'about_company'=>(string)$request->input('aboutcompany'),
                      'industry'=>(string)$request->input('industry'),
                      
                  ]);
                 Session::flash('flash_message', 'Company Updated successfully');
                 return Redirect::back();

      } catch (\Exception $e) { 
     
          DB::rollBack();
          $go = 'clients/' .$cid . '/edit';
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Errors in Saving, Contact IT Department');
          return redirect()->back()->withErrors(['errors' => $e->getMessage(). $e->getLine() ]);
         
        }

     });

  return $result;

}

public function addnewclient(Request $request){

      $v = Validator::make($request->all(), [
            'first_name'=>'required',
            'client_email_primary.*'=>'required'
      
       ]);   
      if( $v->fails()){

              return  response()->json("formerror");

      }   
      //email duplication  validation 
      foreach ($request->client_email_primary as $key => $value) {
          $email_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_email_primary) > 0", $value)->where('delete_flag','=','N')->count();
          if($email_count > 0)
          {
            return response()->json('formerror');
      
          }
          
      }
     
     
      //phone duplication validation
      foreach ($request->client_contact_1 as $key => $value) {
        if($value == null){
           $phone_count=0;
        }
        else{
          $phone_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_contact_1) > 0", $value)->where('delete_flag','=','N')->count();
            if($phone_count > 0)
            {
               return response()->json('formerror');
            }
        
        }
          
      }
    
      //dd($request->all());
  
      $result = DB::transaction(function() use ($request) {        
      try {
            $cid=$request->input('cid');
            $max_client_id = 0 ;
            $max_client_id = DB::table('client_dtls')->max('client_creation_id');
            $max_client_id = substr($max_client_id, -4);
            $max_client_id = $max_client_id + 1 ;

            $cdt =  Carbon::now('Asia/Kolkata');
            $new_dt =  $cdt->year . str_pad($cdt->month ,2, '0', STR_PAD_LEFT);
            $userid = Auth::id();

            $clientemailin=implode(',',$request->input('client_email_primary'));
            $clientphonein=implode(',',$request->input('client_contact_1'));

            $newinserclie=new ClientDtl;
              $newinserclie->client_id=$cid;
              $newinserclie->client_creation_id = 'CL'. $new_dt . str_pad($max_client_id, 4, "0", STR_PAD_LEFT);
              $newinserclie->first_name= ucwords($request->input('first_name'));
              $newinserclie->last_name = ucwords($request->input('last_name'));
              $newinserclie->client_name = ucwords($request->input('first_name')) ." ". ucwords($request->input('last_name'));
              $newinserclie->client_company = $request->input('client_company');
              $newinserclie->client_email_primary= $clientemailin;
              $newinserclie->client_contact_1  = $clientphonein;
              $newinserclie->client_note = $request->client_note;
              $newinserclie->client_creation_date_time ="$cdt";
              $newinserclie->created_by = $userid;
              $newinserclie->updated_by = $userid;
              $newinserclie->company_id  = $request->company_id;
              $newinserclie->cunitno = $request->cunitno;
              $newinserclie->cstreetname =$request->cstreet;
              $newinserclie->ccountry= $request->ccountry;
              $newinserclie->cstate=$request->cstate;
              $newinserclie->ccity= $request->ccounty;
              $newinserclie->czipcode= $request->czipcode;
              $newinserclie->designation= $request->designation;
              $newinserclie->linkedin_url=$request->linkedin_url;
              $newinserclie->self_client_specification=$request->self_client_specification;
            $newinserclie->save();
                $datadetail = array(
                      'client_id' =>$request->input('cid'),
                      'client_creation_id' => 'CL'. $new_dt . str_pad($max_client_id, 4, "0", STR_PAD_LEFT)  ,
                      'first_name'=> ucwords($request->input('first_name')),
                      'last_name' => ucwords($request->input('last_name')),
                      'client_name' => ucwords($request->input('first_name')) ." ". ucwords($request->input('last_name')),
                      'client_company' => $request->input('client_company'),
                      'client_email_primary'=> $clientemailin,
                      'client_contact_1'  => $clientphonein,
                      'client_note' => $request->input('client_note'),
                      'client_creation_date_time' =>$cdt,
                      'created_by' => $userid,
                      'updated_by' => $userid,
                      'company_id'  => $request->company_id,
                      'cunitno' => $request->input('cunitno'),
                      'cstreetname'=> $request->input('cstreet'),
                      'ccountry'=> $request->input('ccountry'),
                      'cstate'=> $request->input('cstate'),
                      'ccity'=> $request->input('ccounty'),
                      'czipcode'=> $request->input('czipcode'),
                      'designation'=> $request->input('designation'),
                      'linkedin_url'=>$request->input('linkedin_url'),
                      'self_client_specification'=>$request->input('self_client_specification'),

                 );

              DB::table('client_dtls_history')->insert($datadetail);
         //if blank client added delete code
         $findblankclientdtls=ClientDtl::where([['client_id','=',$request->input('cid')],['client_name','='," "]])->delete();
     
     
    
        }catch (\Exception $e){
              dd($e);
          DB::rollBack();
          $go = 'clients/' .$cid . '/edit';
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Errors in Saving, Contact IT Department');
            
              return response()->json(['errors'=>$e]);
         
        
         }
      }); 
      
      return response()->json($result);

}

public function UpdateClientDtl(Request $request)
{
    //  dd($request->comp_flag);

    //dd($request->all());

    $cdt     =  Carbon::now('Asia/Kolkata');
    $us_time =  Carbon::now('America/New_York');

     $clid = ClientDtl::find($request->id);

     //dd($clid->id );
     $person_id =   auth()->user()->id;
     $person_name =   auth()->user()->name;

      // PERSON LOG CREATED
      $person_array =  array(
        'person_id'    =>   auth()->user()->id,
        'person_name'  =>   auth()->user()->name ,
        'columns_modified'  =>  "Client Detail client name deleted  on US TIME" . $us_time ."AND INDIAN TIME" . $cdt ,
        'model_used'    =>   "clients table inserted" ,
        'program_no'    =>  "ClientController.php" ,
        'url_direct'    =>   url()->current() ,
        'what_modify' =>   " Client Detail client name deleted " . $clid->client_company .
                            $clid->client_name . $clid->client_email_primary      
                             ,
        'admin_remarks' =>   "deleted by " . $person_name ,
        'trans_id' =>  $clid->client_id ,
        'trans_child_id' =>  $clid->id,

           );

     // PersonLog::create($person_array);
   
      $clid = ClientDtl::find($request->id);
      $clid->delete_flag ='Y';
      $clid->save();

    // if(isset($request->comp_flag)) { 
    //   $client_id =  $clid->client_id ;
    //   $upd =  Client::find($client_id);
    //   $upd->delete_flag ='Y';
    //   $upd->save();
    //    return redirect('clients');
    // }

   //DB::table('clients')
     //       ->where('client_id', $client_id)
       //     ->update(['delete_flag' => 'Y']);

   $response = array(
                    'status' => 'success',
                    'msg' => 'Successfully Deleted',
                );

   return response()->json([$response]);


}
     
public function destroy($id)
{
    Client::find($id)->delete();
    return redirect('clients');
}


public function compdtl(Request $request)
     {
                //dd($request->search); die;
                
                $clients = 0 ;
                $clients = DB::table('clients')
                 ->Where('client_company',$request->search)->where('delete_flag', 'N')
                 ->first();
                

                //dd($clients);die;
                
            if($clients != null)
            {    
                $output= route('clients.edit',['id'=> $clients->id]);
                return "<a href='{$output}' class=''>Click here</a>";
              
            }
            else{
                  return "not match";    
            }

              
                
             
               // return Response($output);


     } 


 
 public function getemail(Request $request ) {

      if(isset($request->coemail)){
        $email=$request->coemail;
         $email_count =  Client::whereRaw("FIND_IN_SET(?, email) > 0", $email)->where('delete_flag','=','N')->count();
      }
      else{
          $email  =  $request->cliemail;
          $email_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_email_primary) > 0", $email)->where('delete_flag','=','N')->count();

      }
          

          

      
         return response()->json($email_count);
        
  }
 public function getphone(Request $request ) {

      if(isset($request->cophone)){
        $phone=$request->cophone;
         $phone_count =  Client::whereRaw("FIND_IN_SET(?, phone) > 0", $phone)->where('delete_flag','=','N')->count();
       
      }
      else{
          $phone  =  $request->cliphone;
          $phone_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_contact_1) > 0", $phone)->where('delete_flag','=','N')->count();

      }
       return response()->json($phone_count);    
  }
  

  public function GetCompanyNm(Request $request) {
       
       //dd($request->all());
       $company_id =  $request->company_id;
       $client_company =  $request->client_company;

       $old_companynm =  Client::where('company_id','=', $company_id)->select('client_company')->get();

      //$comp_count =  Clients::where('company_id','=', $company_id)->count();
       
       foreach ($old_companynm as $key ) {
           //dd($key->client_company);
            $old_name = $key->client_company;
       }
      

      $response = array(
                       'old_name' => $old_name,
                       'msg' => 'ok' 
              );

      return response()->json([$response]);
       
  }


  public function GetRelatedComp(Request $request) {

    //dd($request->search);
    $searcharray = explode(" ",  $request->search);
    //dd($searcharray);
    
    $i=0;$searchname=" ";
    $searcharray0 ='';
    $searcharray1='';
    if(count($searcharray)>1) {
      
         // dd((string) $searcharray[$i]);
        $searcharray0  =  (string) $searcharray[$i]   . '%';

        $searcharray1  =  (string) $searcharray[$i]   . '%';

        //dd($searcharray .(string)$i );
             
      
    }
    

   //dd($searcharray0);
    
    if(count($searcharray)>= 1) {
        $result = DB::table('orders')->select(DB::raw('count(*) as totord, company_id, client_company'))->where('client_company', 'like', $searcharray0 )->orwhere('client_company', 'like', $searcharray1 )->groupBy('company_id', 'client_company')->get();
      }
    else {

        $result = DB::table('orders')->select(DB::raw('count(*) as totord, company_id, client_company'))->where('client_company', 'like',   $request->search .'%')->whereRaw("soundex(client_company) = soundex(  $request->search
          )")->groupBy('company_id', 'client_company')->get();


    }
    
    $output ='<tr><td>' .'No Related Company Found' .'</td></tr>';

    // dd($result);
    $output1 = '';
    if($result->isNotEmpty())
    {
       foreach ($result as $res ) {
          //dd($res->client_company);

          $comp_id    =  $res->company_id;
          $comp_name  =  $res->client_company;
          $tot_orders =  $res->totord;

           $result1 = DB::table('orders')->select('order_id','file_name', 'status')->where('company_id', '=', $comp_id )->orderby('id','desc')->limit(1)->get();
         
          foreach ($result1 as $res1) {
              # code...
                $output1 .='<tr><td>' . $comp_name .'</td>'.
                      '<td>' . $tot_orders . '</td>'.
                      '<td>' . $res1->order_id . '</td>'.
                      '<td>' . $res1->file_name . '</td>'.
                      '<td>' . $res1->status . '</td'.
                       '</tr>';   
            }  

         
        } 
       

       return response($output1);
    }
    else
    {
      return response($output);
    }

   
  }


  public function getemailforupd(Request $request ) {
          //dd("hello");die;
          //dd($request->cdtlid);die;
          // foreach ($request->email as  $value) {
          //     $email = $value ;
          // }
          $id     =  isset($request->cdtlid) ? $request->cdtlid : 0;
          $email  =  $request->email ;
          // $email_count = DB::table('client_dtls')
          //        ->Where('client_email_primary', '=',  $email)
          //        ->count();
          if ($id > 0 ) {
              $email_count  = ClientDtl::where('client_email_primary', '=',  $email)->where('delete_flag','<>', 'Y')->where('id','<>', $id)->count();
            }
          else
          {
             $email_count  = ClientDtl::where('client_email_primary', '=',  $email)->where('delete_flag','<>', 'Y')->count();

          }

         //dd($email_count);dd($email);die;
         return response()->json($email_count);
        
  }




            public function __call($method,$parameters = array())
                {
                          if (!is_numeric($parameters[0])) {
                             return Redirect::to('clients');
                  }
                 else {
                     $this->edit($parameters[0]);
                      }
                }


  public function search(Request $request = null)
     {
                //dd($request->search); die;
          $output =  '';
         //  $output ='<select class="form-control clstate"  id="client_state3" name="client_state3"  > ';

          if($request->search == 'US') {
                $clients = DB::table('us_states')
                          ->get();
                

              
                foreach ($clients as $client) {
                    # code...

                $output .= '<option  value='. "'$client->name_in_lc '". ">" . "$client->name_in_lc"  .   '</option> ';

               }
                $output .= '</select>';
               // dd($output);die;
                return Response($output);
          }      
          elseif($request->search == 'CANADA') {

                       
                $clients = DB::table('canada_states')
                          ->get();
                
                // dd($clients);die;
              
                foreach ($clients as $client) {
                    # code...

                $output .= '<option  value='. "'$client->id'". ">" . "$client->territory". " " . "$client->state" .   '</option> ';

               }
                $output .= '</select>';
                //dd($output);die;
                return Response($clients);
                 
          }
          else {
                 $output .= '<option  value='.'other' .'>' . 'other' . '</option> ';
                  return Response($output);
          }




     } 
     
  public function statename(Request $request){
          
              $name=$request->countryname;

              $countries=DB::table('countrylists')->where('country_name',$name)->get();
              foreach($countries as $country){}
              $states=DB::table('statelist')->where('countryid',$country->id)->get();
              $state=[];
               foreach($states as $state1){
                   $state2=$state1->statename;
                   $state[]=$state2;

               }
              return  response()->json($state);

  } 
  public function cityname(Request $request){
          
              $state_name=$request->statename;
              $states=DB::table('statelist')->where('statename',$state_name)->get();
               foreach ($states as $timezones) {
                 $time=$timezones->timezone;
               }
              $cities=DB::table('citylists')->where('state_name',$state_name)->get();
              $city=[];
               foreach($cities as $cities1){
                   $cities2=$cities1->city;
                   $city[]=$cities2;

               }
              return  response()->json(['city'=>$city,'time'=>$time]);
  } 
  public function relatedclients($id)
  {
        $clientsdtl=DB::table('client_dtls')->select('id','client_name','client_email_primary','client_contact_1','designation','client_note','black_list')->where([['client_id', '=',$id],['client_dtls.delete_flag', '=', 'N'],['client_name','<>',""]])->get();
        return Datatables::of($clientsdtl)
        ->addColumn('delete',function($data){
            
                    return "<button class='deletedata btn btn-sm btn-fill btn-danger' value='#'>Delete</button>";
           })
          ->addIndexColumn()
        ->addColumn('action',function($data){
             
                 $show= route('clientdtl.showclient',['id'=> $data->id]);
                 $edit= route('clientdtl.editclient',['id'=> $data->id]);
                   $returnstr="";
                    $returnstr.="<a href='{$show}' class='btn btn-sm btn-outline btn-info'><i class='fa fa-eye fa-lg' aria-hidden='true'></i></a>";
                  if (Auth::user()->hasPermission('client.update')) {  
                    $returnstr.="<a href='{$edit}' class='btn btn-sm btn-outline btn-primary ml-1'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></a>";
                  }
                  if (Auth::user()->hasPermission('client.delete')) {
                    $returnstr.="<a href='javascript:void(0)' class='btn btn-sm btn-outline btn-danger dt-center ml-1 delclient'><i class='fa fa-trash-o fa-lg' aria-hidden='true'></i></a><input type='hidden' value='{$data->id}'>";
                  }
                  return $returnstr;
           })
        ->escapeColumns([])  
        ->make(true);
  }
  
  public function relatedworkseat($id){
       $companyworkseat=DB::table('work_details')->select('id','department','wcountry','days','hours','worktime','csr1','emp1','billing','amount','wtimezone')->where([['client_id', '=',$id],['work_deleted','=','N']])->get();
     
        return Datatables::of($companyworkseat)
         ->addIndexColumn()
         ->addColumn('revenue',function($data){
             if($data->billing == 'Hourly'){
                  $pendingdata=explode(',', $data->hours);
                  $pendingdatafinal=array_sum($pendingdata);
                $revenuedata=$pendingdatafinal*$data->amount;

             }
             if($data->billing == 'Weekly'){

               $revenuedata=4*$data->amount;
             }
             if($data->billing == 'Monthly'){
               $revenuedata=$data->amount;
             }
                 
                   return $revenuedata;
           })
         ->addColumn('resource1',function($data){
              $resourcedata=DB::table('users')->where('id',$data->emp1)->value('name');
                 
                   return $resourcedata;
           })
         ->addColumn('handler1',function($data){
              $handlerdata=DB::table('users')->where('id',$data->csr1)->value('name');
                 
                   return $handlerdata;
           })
       ->addColumn('action',function($data){
             
                 // $show= route('workseat.showworkseat',['id'=> $data->id]);
                  $edit= route('workseat.editworkseat',['id'=> $data->id]);
                  $show= route('workseat.showworkseat',['id'=> $data->id]);
                 $returnstr="";
                    $returnstr.="<a href='{$show}' class='btn btn-sm btn-outline btn-info'><i class='fa fa-eye fa-lg' aria-hidden='true'></i></a>";
                  if (Auth::user()->hasPermission('edit.virtual.assistant')) { 
                     $returnstr.="<a href='{$edit}' class='btn btn-sm btn-outline btn-primary ml-1'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></a>";
                   } 
                   if (Auth::user()->hasPermission('delete.virtual.assistant')) {
                     $returnstr.="<a  href='javascript:void(0)' class='btn btn-sm btn-outline btn-danger dt-center ml-1 delva'  ><i class='fa fa-trash-o fa-lg' aria-hidden='true'></i></a><input type='hidden' value='{$data->id}'>";
                   }
                   return $returnstr;
           })
       
        ->escapeColumns([])  
        ->make(true);

  }
   
  public function showclient($id){
        $clientdtl=ClientDtl::find($id);
       
        $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Models\ClientDtl")->Orderby('created_at','desc')->get()->toArray();

    
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 
        $firstlog=0;
        foreach ($lastActivity as $multi ) {
           $user_id  =   $multi['causer_id'];
           $user_name  = User::find($user_id);
          if($firstlog == 0){
             
              $cols['updated_by'][] = $user_name->name;
              $cols['note'][]   =  $multi['note'];
              $cols['old_values'][] ="no" ; 
              $cols['updated_at'][] = $multi['updated_at'];
              $cols['columns_updated'][] = "no" ;
              foreach ($multi['properties']['attributes'] as $key => $value) {
                     $string.=$key.':'.$value.'<br>';
                  }    
              $cols['new_values'][]= $string;
          }
           $firstlog++;
        
                
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }

        return view('clients.omsshowclientdtls.view',compact('clientdtl','cols'));
         
  }
  public function editclient($id){
        $clientdtl=ClientDtl::find($id);
       
        $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Models\ClientDtl")->Orderby('created_at','desc')->get()->toArray();

    
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 
 
        foreach ($lastActivity as $multi ) {
           $user_id  =   $multi['causer_id'];
           $user_name  = User::find($user_id);
         
        
                
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }
         return view('clients.omseditclientdtls.view',compact('clientdtl','cols'));
  }
  public function updateclient(Request $request){
       $v = Validator::make($request->all(), [
            'first_name'=>'required',
            'client_email_primary.*'=>'required'
      
       ]);   
      if( $v->fails()){

               return Redirect::back()->withErrors($v);

      } 
      $clientdtl= ClientDtl::find($request->cid);
      $clientemailcount=count(explode(',',$clientdtl->client_email_primary));
    
      //email duplication  validation 

      foreach ($request->client_email_primary as $key => $value) {
          $email_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_email_primary) > 0", $value)->where([['delete_flag','=','N'],['id','!=',$request->cid]])->count();
          if($email_count > 0)
          {
             return Redirect::back()->withErrors('Duplicate Email not Allow');
          }   
      }

      
      
      //phone duplication validation
 
        foreach ($request->client_contact_1 as $key => $value) {
         if($value == null){
            $phone_count=0;
         }
         else{
            $phone_count =  ClientDtl::whereRaw("FIND_IN_SET(?, client_contact_1) > 0", $value)->where([['delete_flag','=','N'],['id','!=',$request->cid]])->count();
             if($phone_count > 1)
             {
               return Redirect::back()->withErrors('Duplicate Contact not Allow');
             }
          
         }
        }
       
 
      $clientemail=implode(',',$request->client_email_primary);
      $clientphone=implode(',', $request->client_contact_1);
      if($request->black_list == 'N'){
          $blacklistreason="";
      }
      else{

          $blacklistreason=$request->black_list_reason;
      }

      $updateclientdtls=ClientDtl::find($request->cid);
       $updateclientdtls->first_name=ucwords($request->first_name);
       $updateclientdtls->last_name=ucwords($request->last_name);
       $updateclientdtls->client_name=ucwords($request->first_name)." ".ucwords($request->last_name);
       $updateclientdtls->client_email_primary=$clientemail;
       $updateclientdtls->client_contact_1=$clientphone;
       $updateclientdtls->designation=$request->designation;
       $updateclientdtls->linkedin_url=$request->linkedin_url;
       $updateclientdtls->client_note=$request->client_note;
       $updateclientdtls->self_client_specification=$request->self_client_specification;
       $updateclientdtls->cunitno=$request->cunitno;
       $updateclientdtls->cstreetname=$request->cstreet;
       $updateclientdtls->ccountry=$request->ccountry;
       $updateclientdtls->cstate=$request->cstate;
       $updateclientdtls->ccity=$request->ccity;
       $updateclientdtls->czipcode=$request->czipcode;
       $updateclientdtls->black_list=$request->black_list;
       $updateclientdtls->black_list_reason=$blacklistreason;
      $updateclientdtls->update();
      $datadetail = array(
                      'client_id' =>$updateclientdtls->client_id,
                      'client_creation_id' =>$updateclientdtls->client_creation_id ,
                      'first_name'=> $updateclientdtls->first_name,
                      'last_name' => $updateclientdtls->last_name,
                      'client_name' => $updateclientdtls->first_name ." ". $updateclientdtls->last_name,
                      'client_company' => $updateclientdtls->client_company,
                      'client_email_primary'=> $clientemail,
                      'client_contact_1'  => $clientphone,
                      'client_note' => $updateclientdtls->client_note,
                      'client_creation_date_time' =>$updateclientdtls->client_creation_date_time,
                      'created_by' => $updateclientdtls->created_by,
                      'updated_by' => $updateclientdtls->updated_by,
                      'company_id'  => $updateclientdtls->company_id,
                      'cunitno' => $updateclientdtls->cunitno,
                      'cstreetname'=> $updateclientdtls->cstreetname,
                      'ccountry'=> $updateclientdtls->ccountry,
                      'cstate'=> $updateclientdtls->cstate,
                      'ccity'=> $updateclientdtls->ccity,
                      'czipcode'=> $updateclientdtls->czipcode,
                      'designation'=> $updateclientdtls->designation,
                      'linkedin_url'=>$updateclientdtls->linkedin_url,
                      'self_client_specification'=>$updateclientdtls->self_client_specification,

                 );
              DB::table('client_dtls_history')->insert($datadetail);
      Session::flash('flash_message', 'Client Detail Updated Successfully' );        
      return Redirect::back();

  }
 public function createworkseat($id){
   $clients=Client::find($id);
  $roles=["CSR","CSR Manager","Data Executive","Sales Manager","Designer Manager","Accountant Manager"];
   $csrs=DB::table('userrole_data')->whereIn('rolename', $roles)->where('Deleted','=','N')->select('name','id','rolename')->Orderby('rolename')->get();
   $empsuser=["Operations","designer","Data Executive"];
   $emps=DB::table('userrole_data')->whereIn('rolename',$empsuser)->where('Deleted','=','N')->select('name','id','rolename')->Orderby('rolename')->get();
   return view('workseat.createworkseat.view',compact('clients','csrs','emps'));
 }
 public function showworkseat($id){
     $workseat=Work_detail::find($id);
     $company_name=DB::table('clients')->where('id', $workseat->client_id)->value('client_company');

      $hours=explode(',',$workseat->hours);
      //worktime array
      $worktimes=explode(',',$workseat->worktime);
      //weeknames array
     $weeknames=collect(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']);
     $roles=["CSR","CSR Manager","Sales Manager","Designer Manager","Accountant Manager"];
      $csrs=DB::table('userrole_data')->whereIn('rolename', $roles)->where('Deleted','=','N')->select('name','id')->get();
      $emps=DB::table('userrole_data')->where('rolename', 'operations')->where('Deleted','=','N')->select('name','id')->get();
      //portal detail array
     $portals=collect(['media_type'=>explode(',',$workseat->media_type),'portal_url'=>explode(',',$workseat->portal_url),'portal_username'=>explode(',',$workseat->portal_username),'portal_password'=>explode('(,new)',$workseat->portal_password),'portal_detail'=>explode(',',$workseat->portal_detail)]);
     //activity log
      $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Work_detail")->Orderby('created_at','desc')->get()->toArray();

    
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 
        $firstlog=0;
        foreach ($lastActivity as $multi ) {
           $user_id  =   $multi['causer_id'];
           $user_name  = User::find($user_id);
          // if($firstlog == 0){
             
          //     $cols['updated_by'][] = $user_name->name;
          //     $cols['note'][]   =  $multi['note'];
          //     $cols['old_values'][] ="no" ; 
          //     $cols['updated_at'][] = $multi['updated_at'];
          //     $cols['columns_updated'][] = "no" ;
          //     foreach ($multi['properties']['attributes'] as $key => $value) {
          //            $string.=$key.':'.$value.'<br>';
          //         }    
          //     $cols['new_values'][]= $string;
          // }
          //  $firstlog++;
        
                
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }

  
     return view('workseat.showworkseat.view',compact('workseat','weeknames','worktimes','hours','csrs','emps','portals','cols','company_name'));
     // dd($workseat);
 }
 public function editworkseat($id){
     $workseat=Work_detail::find($id);
     $company_name=DB::table('clients')->where('id', $workseat->client_id)->value('client_company');
      $roles=["CSR","CSR Manager","Sales Manager","Designer Manager","Accountant Manager","Data Executive"];
      $csrs=DB::table('userrole_data')->whereIn('rolename', $roles)->where('Deleted','=','N')->select('name','id','rolename')->Orderby('rolename')->get();
      $empsuser=["Operations","designer","Data Executive"];
      $emps=DB::table('userrole_data')->whereIn('rolename',$empsuser)->where('Deleted','=','N')->select('name','id','rolename')->Orderby('rolename')->get();
      //select option
      $seatslots=collect(['Part Time','Full Time','Custom']);
      $resourcebillings=collect(['Hourly','Weekly','Monthly']);
      $invoicings=collect(['Daily','Weekly','Bi-Weekly','Monthly']);
      $countries=collect(['US','UK','CANADA','AUSTRALIA','NEW ZEALAND','Other']);
      //portal detail array
      $portals=collect(['media_type'=>explode(',',$workseat->media_type),'portal_url'=>explode(',',$workseat->portal_url),'portal_username'=>explode(',',$workseat->portal_username),'portal_password'=>explode('(,new)',$workseat->portal_password),'portal_detail'=>explode(',',$workseat->portal_detail)]);

      //days array
      $hours=explode(',',$workseat->hours);

      //worktime array
      $worktimes=explode(',',$workseat->worktime);

      //weeknames array
      $weeknames=collect(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']);
      //department array
      $departments=collect(['Graphics','Data','Operations']);

       //activity log
      $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Work_detail")->Orderby('created_at','desc')->get()->toArray();

    
        
        $lastActivity = collect($lastActivity); 
        $cols = array();

        $string='';  
        $string1=''; 
        $firstlog=0;
        foreach ($lastActivity as $multi ) {
           $user_id  =   $multi['causer_id'];
           $user_name  = User::find($user_id);
          // if($firstlog == 0){
             
          //     $cols['updated_by'][] = $user_name->name;
          //     $cols['note'][]   =  $multi['note'];
          //     $cols['old_values'][] ="no" ; 
          //     $cols['updated_at'][] = $multi['updated_at'];
          //     $cols['columns_updated'][] = "no" ;
          //     foreach ($multi['properties']['attributes'] as $key => $value) {
          //            $string.=$key.':'.$value.'<br>';
          //         }    
          //     $cols['new_values'][]= $string;
          // }
          //  $firstlog++;
        
                
                
             
            
            // $string.='New values:'; 
            // $string1 .='old values:'; 
          if(isset($multi['properties']['old'])){         
           
          if(isset($multi['properties']['attributes'])){
             foreach($multi['properties']['attributes'] as $key=>$value)
              {
                 $cols['note'][]   =  $multi['note'];
                 $cols['updated_by'][] = $user_name->name;
               
                                 
                //dd($value);

                 $changed_key  = str_replace("_", " ", $key);
                 $changed_key  = ucwords($changed_key);
                 
                 $cols['columns_updated'][] = $changed_key ;

                 if ( $value  <> null)
                 {
                    $cols['new_values'][] = $value  ;
                 }
                 else
                 {
                    $cols['new_values'][] = '';
                 }

                             
              } 
          } 
         
          // dd($cols);

           if(isset($multi['properties']['old'])){  
                   foreach($multi['properties']['old'] as $key=>$value)
              {
                
               
                                 
                  if ( $value  <> null)
                  {
                        $cols['old_values'][] = $value ;     
                  }
                  else {
                       $cols['old_values'][] = '' ;
                  }  
                
                $cols['updated_at'][] = $multi['updated_at'];
                             
              }    
          
          }  
          
          }

        }
      
     return view('workseat.editworkseat.view',compact('workseat','csrs','emps','seatslots','resourcebillings','invoicings','portals','hours','worktimes','weeknames','departments','countries','cols','company_name'));
 }

 public function updateworkseat(Request $request){
  
    $v = Validator::make($request->all(), [
                'department'=>'bail|required',
                'amount'=>'required',
                'workcountry'=>'required',
                'resourcebilling'=>'required',
                'generateinvoicing'=>'required',
                'csr1'=>'required',
                'emp1'=>'required',
                
           ]);   
          if( $v->fails()){

                   return Redirect::back()->withErrors($v);

          } 
          if ($request->has('day')) {
                $days=implode(',',$request->day);
                $hours=implode(',',$request->hour);
                $times=implode(',',$request->time);
          }
          else{
                $days="";
                $hours=",,,,,,";
                $times=",,,,,,";
          } 
           
          $workseatupdate=Work_detail::find($request->id);    
            $workseatupdate->department=implode(',',$request->department);
            $workseatupdate->seatslot=$request->seatslot;
            $workseatupdate->noofhours=$request->noofhours;
            if($request->workcountry != "Other"){
                  $workseatupdate->wcountry=$request->workcountry;
            }
            else{
                  $workseatupdate->wcountry=$request->othercountry;
            }
            if($request->worktimezone == "Other"){
                  $workseatupdate->wtimezone=$request->othertimezone;
            }
            else{
                  $workseatupdate->wtimezone=$request->worktimezone;
            }
            // $workseatupdate->wcountry=$request->workcountry;
            // $workseatupdate->wtimezone=$request->worktimezone;
            $workseatupdate->billing=$request->resourcebilling;
            $workseatupdate->invoice=$request->generateinvoicing;
            $workseatupdate->currency=$request->currency;
            $workseatupdate->amount=$request->amount;
            $workseatupdate->days=$days;
            $workseatupdate->hours=$hours;
            $workseatupdate->worktime=$times;
            $workseatupdate->work_created_user_id=Auth::user()->id;
          if (Auth::user()->hasPermission('edit.portal')){
            $workseatupdate->media_type=implode(',',$request->media_type);
            $workseatupdate->portal_url=implode(',',$request->portal_url);
            if (Auth::user()->hasPermission('edit.portal.password')){
              $workseatupdate->portal_username=implode(',',$request->username);
              $workseatupdate->portal_password=implode('(,new)',$request->password);
            }
            $workseatupdate->portal_detail=implode(',',$request->portaldetail);
          }
            $workseatupdate->csr1=$request->csr1;
            $workseatupdate->csr2=$request->csr2;
            $workseatupdate->emp1=$request->emp1;
            $workseatupdate->emp2=$request->emp2;
          $workseatupdate->update();
           Session::flash('flash_message', 'Virtual Assistant Updated Successfully' );        
      return Redirect::back();

 }
 public function deleteworkseat(Request $request){
    if ($request->has('wasearch')) {
      $deletework=Work_detail::find($request->wasearch);  
      $deletework->work_deleted="Y";
      $deletework->update();
    }
    else{
      $deleteclientdtl=ClientDtl::find($request->clisearch);  
      $deleteclientdtl->delete_flag="Y";
      $deleteclientdtl->update();
    }
 }

}