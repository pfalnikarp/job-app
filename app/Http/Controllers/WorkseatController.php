<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use App\Models\Client ;
use App\Models\ClientDtl ;
use App\Models\Work_detail;
use App\Models\User;
class WorkseatController extends Controller
{
  //main workseat user summary table
   public function userworkseatsummary(Request $request){
    $graphicscount=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Graphics')->where('work_deleted','=','N')->count();
    $datacount=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Data')->where('work_deleted','=','N')->count();
    $scrcount=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Operations')->where('work_deleted','=','N')->count();
   	if($request->ajax()) {
      if(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show')){
       
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show')){
       
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->Where('department','!=','Data')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.graphics.show')){
       
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->Where('department','!=','Operations')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show')){
    
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->Where('department','!=','Graphics')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.data.show')){
   		  $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->whereRaw("FIND_IN_SET(?, department) > 0", 'Data')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.graphics.show')){
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->whereRaw("FIND_IN_SET(?, department) > 0", 'Graphics')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }
      else if(Auth::user()->hasPermission('va.operations.show')){
        $data=DB::table('userrole_data')->leftJoin('work_details', 'userrole_data.id', '=', 'work_details.emp1')->select('userrole_data.id','userrole_data.name',DB::raw('group_concat(work_details.department) AS workdeatildepartment'),DB::raw('group_concat(work_details.id) AS workdeatilid'),DB::raw('sum(work_details.noofhours) AS sumnoofhours'),DB::raw('group_concat(work_details.hours) AS workdeatilhours'))->where([['work_details.work_deleted','=','N'],['work_details.id','<>',""],['userrole_data.Deleted','=','N']])->whereRaw("FIND_IN_SET(?, department) > 0", 'Operations')->distinct()->groupBy('userrole_data.id','userrole_data.name');
      }

        return Datatables::of($data)
        
           
            ->addColumn('view',function($data){
              $view= route('workseat.viewworkseatuser',['id'=> $data->id]);
             return "<a href='{$view}' class='btn btn-sm btn-fill btn-success'>View</a>";

            })
           
            
            ->addColumn('totalhour',function($data){
                  
                  return 54;

            })
            ->addColumn('pendinghours',function($data){
                  $pendingdata=explode(',', $data->workdeatilhours);
                  $pendingdatafinal=54-array_sum($pendingdata);

                  return $pendingdatafinal;

            })
            
           ->escapeColumns([])  
           ->make(true);
   	}
      return view('usersummary.workseatusersummary.viewusersworkseatsummary.view',compact('graphicscount','datacount','scrcount'));
   }
  //view login individual user workseat table  
  public function viewworkseat(Request $request){
    if($request->ajax()) {
      $data=DB::table('work_details')->leftJoin('clients', 'work_details.client_id', '=', 'clients.id')->select(DB::raw('work_details.id AS cdclient_contact_1'),'clients.id','work_details.days','work_details.hours','work_details.noofhours','clients.client_company','clients.company_id','work_details.worktime','work_details.wtimezone','work_details.wcountry','work_details.csr1')->where([['work_details.work_deleted','=','N'],['work_details.emp1','=',Auth::user()->id]]);
  
        return Datatables::of($data)
        
           
            ->addColumn('view',function($data){
             $view= route('workseat.showworkseatoperations',['id'=> $data->cdclient_contact_1]);
             return "<a href='{$view}' class='btn btn-sm btn-fill btn-success'>View</a>";

            })
            ->addColumn('handler1',function($data){
              $handlerdata=DB::table('users')->where('id',$data->csr1)->value('name');
                 
                   return $handlerdata;
           })
            

            
           ->escapeColumns([])  
           ->make(true);
    }
    return view('workseat.viewworkseat.view');
  } 
  // pass user summary view to individual user alloted work seat page
  public function viewworkseatuser($id){
     $username=User::find($id);
     $roledentity=DB::table('userrole_data')->where('id','=',Auth::user()->id)->value('rolename');
  if($roledentity == 'Operations'){
    return view('usersummary.workseatusersummary.viewuserworkseat.opview',compact("id","username"));
  }
  else{
    return view('usersummary.workseatusersummary.viewuserworkseat.view',compact("id","username"));
  }
  }
  //user individual work seat table(ajax function of viewworkseatuser)
  public function viewworkseatuserajax($id){
    $data=DB::table('work_details')->leftJoin('clients', 'work_details.client_id', '=', 'clients.id')->select(DB::raw('work_details.id AS cdclient_contact_1'),'clients.id','work_details.days','work_details.hours','work_details.noofhours','clients.client_company','clients.company_id','work_details.worktime','work_details.wtimezone','work_details.wcountry','work_details.csr1')->where([['work_details.work_deleted','=','N'],['work_details.emp1','=',$id]]);
  
        return Datatables::of($data)
        
           
            ->addColumn('view',function($data){
             $view= route('workseat.showworkseatoperations',['id'=> $data->cdclient_contact_1]);
             return "<a href='{$view}' class='btn btn-sm btn-fill btn-success'>View</a>";

            })
            ->addColumn('handler1',function($data){
              $handlerdata=DB::table('users')->where('id',$data->csr1)->value('name');
                 
                   return $handlerdata;
           })

            
           ->escapeColumns([])  
           ->make(true);
  }
  // operations role user click on companylink so company page open
  public function viewworkseatcompany($id){
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
         $roledentity=DB::table('userrole_data')->where('id','=',Auth::user()->id)->value('rolename');
  if($roledentity == 'Operations'){
     return view('workseat.workseatclient.opview', compact('client', 'clientdtls', 'cols','salses'));
  }
   else{
      return view('workseat.workseatclient.view', compact('client', 'clientdtls', 'cols','salses'));
   } 
    
       
  }
  public function showclientdtloperations($id){

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

     $roledentity=DB::table('userrole_data')->where('id','=',Auth::user()->id)->value('rolename');
    if($roledentity == 'Operations'){
        return view('workseat.workseatclientdtl.opview',compact('clientdtl','cols'));
    }
    else{
      return view('workseat.workseatclientdtl.view',compact('clientdtl','cols'));
    }
  }
  // operations role user click on view  button so work seat detail page show
  public function showworkseatoperations($id){
    $workseat=Work_detail::find($id);
     $company_name=DB::table('clients')->where('id', $workseat->client_id)->value('client_company');

      $hours=explode(',',$workseat->hours);
      //worktime array
      $worktimes=explode(',',$workseat->worktime);
      //weeknames array
     $weeknames=collect(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']);
     $roles=["CSR","CSR Manager","Sales Manager","Designer Manager","Accountant Manager"];
      $csrs=DB::table('userrole_data')->whereIn('rolename', $roles)->where('Deleted','=','N')->select('name','id')->get();
      $empsuser=["Operations","designer","Data Executive"];
      $emps=DB::table('userrole_data')->whereIn('rolename', $empsuser)->where('Deleted','=','N')->select('name','id')->get();
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
  $roledentity=DB::table('userrole_data')->where('id','=',Auth::user()->id)->value('rolename');
  if($roledentity == 'Operations'){
     return view('workseat.showworkseatoperations.opview',compact('workseat','weeknames','worktimes','hours','csrs','emps','portals','cols','company_name'));
  }
  else{
    return view('workseat.showworkseatoperations.view',compact('workseat','weeknames','worktimes','hours','csrs','emps','portals','cols','company_name'));
  }
  
    
  }
 
  public function workseatgraphics(Request $request){
    $data="No Data";
    $revenuedatavalue=0;
    $usarray=[];
    $canadianrev=0;
    $ausrev=0;
    $gbprev=0;
    $usrev=0;
    $sumArray = array();
     $user=User::find(Auth::user()->id);
  if($request->search == 'Graphics'){
    $workseatgraphicsdatas=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Graphics')->where('work_deleted','N')->get();
    
    if(count($workseatgraphicsdatas)>0){
      $data="";
      foreach ($workseatgraphicsdatas as $key=>$workseatgraphicsdata) {
         
        $daysdata=str_replace(',', '<br/>',$workseatgraphicsdata->days);
        $hoursdata="";
        foreach(explode(',', $workseatgraphicsdata->hours) as $hours){
          if($hours != ""){
           $hoursdata.=$hours.'<br>';
          }
        }
        //$hoursdata=str_replace(',', '<br/>',$workseatgraphicsdata->hours);
        $worktimedata="";
        foreach(explode(',', $workseatgraphicsdata->worktime) as $worktime){
          if($worktime != ""){
           $worktimedata.=$worktime.'<br>';
          }
        }
        if($workseatgraphicsdata->invoice == 'Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 4;
            $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);

        }
        else if($workseatgraphicsdata->invoice == 'Bi-Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 2;
            $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Daily'){
           $revenuedata=$workseatgraphicsdata->amount * 30;
           $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Monthly'){
          $revenuedata=$workseatgraphicsdata->amount * 1;
          $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else{
             $revenuedata=$workseatgraphicsdata->amount * 1;
             $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        foreach ($usarray as $usarrays) {

          
          
          
        }
        foreach ($usarrays as $keyis => $value) {
            
          if($keyis == "GBP(£)"){
            $gbprev+=$value;

          }
          else if($keyis == "Australia($)"){
            $ausrev+=$value;
          }
          else if($keyis == "Canadian($)"){
            $canadianrev+=$value;
          }
          else if($keyis == "US($)"){
            $usrev+=$value;
          }
          }

         $revenuedatavalue="US($) = ".$usrev.", GBP(£) = ".$gbprev .", Canadian($) = ".$canadianrev.", Australia($) = ".$ausrev;
        //$worktimedata=str_replace(',', '<br/>',$workseatgraphicsdata->worktime);
        $empdata=DB::table('users')->where('id',$workseatgraphicsdata->emp1)->value('name');
        $csrdata=DB::table('users')->where('id',$workseatgraphicsdata->csr1)->value('name');
        $companyid=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('company_id');
        $companyids=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('id');

         $showurl= route('clients.show',['id'=> $companyids]);
         $companyid =  "<a href='{$showurl}'> $companyid</a>";

        $companyname=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('client_company');
       
      if ($user->hasPermission('show.amont')) {
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$revenuedata." ".$workseatgraphicsdata->currency."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";

      }
      else{
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";
        $revenuedatavalue="-";
      }
      }
    }
  }
  if($request->search == 'Data'){
    $workseatgraphicsdatas=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Data')->where('work_deleted','N')->get();

    if(count($workseatgraphicsdatas)>0){
      $data="";
      foreach ($workseatgraphicsdatas as $key=>$workseatgraphicsdata) {
        
        $daysdata=str_replace(',', '<br/>',$workseatgraphicsdata->days);
        $hoursdata="";
        foreach(explode(',', $workseatgraphicsdata->hours) as $hours){
          if($hours != ""){
           $hoursdata.=$hours.'<br>';
          }
        }
        //$hoursdata=str_replace(',', '<br/>',$workseatgraphicsdata->hours);
        $worktimedata="";
        foreach(explode(',', $workseatgraphicsdata->worktime) as $worktime){
          if($worktime != ""){
           $worktimedata.=$worktime.'<br>';
          }
        }
        if($workseatgraphicsdata->invoice == 'Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 4;
            $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Bi-Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 2;
            $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Daily'){
           $revenuedata=$workseatgraphicsdata->amount * 30;
           $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Monthly'){
          $revenuedata=$workseatgraphicsdata->amount;
          $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else{
             $revenuedata=$workseatgraphicsdata->amount;
             $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
         foreach ($usarray as $usarrays) {

          
          
          
        }
        foreach ($usarrays as $keyis => $value) {
            
          if($keyis == "GBP(£)"){
            $gbprev+=$value;

          }
          else if($keyis == "Australia($)"){
            $ausrev+=$value;
          }
          else if($keyis == "Canadian($)"){
            $canadianrev+=$value;
          }
          else if($keyis == "US($)"){
            $usrev+=$value;
          }
          }

         $revenuedatavalue="US($) = ".$usrev.", GBP(£) = ".$gbprev .", Canadian($) = ".$canadianrev.", Australia($) = ".$ausrev;
        //$worktimedata=str_replace(',', '<br/>',$workseatgraphicsdata->worktime);
        $empdata=DB::table('users')->where('id',$workseatgraphicsdata->emp1)->value('name');
        $csrdata=DB::table('users')->where('id',$workseatgraphicsdata->csr1)->value('name');
        $companyid=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('company_id');

        $companyids=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('id');

         $showurl= route('clients.show',['id'=> $companyids]);
         $companyid =  "<a href='{$showurl}'> $companyid</a>";

        $companyname=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('client_company');
      
      if ($user->hasPermission('show.amont')) {
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$revenuedata." ".$workseatgraphicsdata->currency."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";

      }
      else{
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";
        $revenuedatavalue="-";
      }
      }
    }
  }
  if($request->search == 'Operations'){
    $workseatgraphicsdatas=Work_detail::whereRaw("FIND_IN_SET(?, department) > 0", 'Operations')->where('work_deleted','N')->get();
    if(count($workseatgraphicsdatas)>0){
      $data="";
      foreach ($workseatgraphicsdatas as $key=>$workseatgraphicsdata) {
        
        $daysdata=str_replace(',', '<br/>',$workseatgraphicsdata->days);
        $hoursdata="";
        foreach(explode(',', $workseatgraphicsdata->hours) as $hours){
          if($hours != ""){
           $hoursdata.=$hours.'<br>';
          }
        }
        //$hoursdata=str_replace(',', '<br/>',$workseatgraphicsdata->hours);
        $worktimedata="";
        foreach(explode(',', $workseatgraphicsdata->worktime) as $worktime){
          if($worktime != ""){
           $worktimedata.=$worktime.'<br>';
          }
        }
        if($workseatgraphicsdata->invoice == 'Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 4;
             $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Bi-Weekly'){
            $revenuedata=$workseatgraphicsdata->amount * 2;
             $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Daily'){
           $revenuedata=$workseatgraphicsdata->amount * 30;
            $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else if($workseatgraphicsdata->invoice == 'Monthly'){
          $revenuedata=$workseatgraphicsdata->amount;
           $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
        else{
             $revenuedata=$workseatgraphicsdata->amount;
              $usarray[]=array($workseatgraphicsdata->currency=>$revenuedata);
        }
          foreach ($usarray as $usarrays) {

          
          
          
        }
        foreach ($usarrays as $keyis => $value) {
            
          if($keyis == "GBP(£)"){
            $gbprev+=$value;

          }
          else if($keyis == "Australia($)"){
            $ausrev+=$value;
          }
          else if($keyis == "Canadian($)"){
            $canadianrev+=$value;
          }
          else if($keyis == "US($)"){
            $usrev+=$value;
          }
          }

         $revenuedatavalue="US($) = ".$usrev.", GBP(£) = ".$gbprev .", Canadian($) = ".$canadianrev.", Australia($) = ".$ausrev;
        //$worktimedata=str_replace(',', '<br/>',$workseatgraphicsdata->worktime);
        $empdata=DB::table('users')->where('id',$workseatgraphicsdata->emp1)->value('name');
        $csrdata=DB::table('users')->where('id',$workseatgraphicsdata->csr1)->value('name');
        $companyid=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('company_id');
       
        $companyids=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('id');

         $showurl= route('clients.show',['id'=> $companyids]);
         $companyid =  "<a href='{$showurl}'> $companyid</a>";

        $companyname=DB::table('clients')->where('id',$workseatgraphicsdata->client_id)->value('client_company');
     
        if ($user->hasPermission('show.amont')) {
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$revenuedata." ".$workseatgraphicsdata->currency."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";

      }
      else{
        $data.="<tr><td>".++$key."</td><td>".$companyid."</td><td>".$companyname."</td><td>".$daysdata."</td><td>".$hoursdata."</td><td>".$worktimedata."</td><td>".$workseatgraphicsdata->wcountry."</td><td>".$csrdata."</td><td>".$empdata."</td></tr>";
        $revenuedatavalue="-";
      }
      }
    }
  }
     return Response([$data,$revenuedatavalue]);
  }

  public function userworkhours(Request $request){
  
    $userdata=User::find($request->user_id);
    $userdata->workuserhours=$request->workuserhours;
    $userdata->update();

  }

}
