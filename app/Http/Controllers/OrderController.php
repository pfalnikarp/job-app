<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDtl;
use App\Models\Vendor;
use App\Models\Order_Status ;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use App\Models\Userlog;
use App\Models\orderdtls_history;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Models\UserAllocationLog;
use App\Models\FileReason;
use App\Models\Timer;
use App\Models\Project;
use Spatie\Activitylog\Models\Activity;

use Notification;
use App\Notifications\OrderStatusNotification;



class OrderController extends Controller
{
  
   public function  index(Request $request) {
         
            //$users = DB::table('designer')->pluck( 'designer.name' , 'designer.id')->toArray();
              //   $user_names = DB::table('designer')->pluck( 'designer.name' , 'designer.name')->toArray();

             //     $users = DB::table('designer')->join('sessions', 'sessions.user_id', '=', 
            //      'designer.id')->pluck( 'designer.name' , 'designer.id')->toArray();
             //    $user_names = DB::table('designer')->join('sessions', 'sessions.user_id', '=', 
             //     'designer.id')->pluck( 'designer.name' , 'designer.name')->toArray();
                

            $users = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->join('sessions', 'sessions.user_id', '=', 
                  'users.id')->whereIn('role_user.role_id',array(6,7))->pluck( 'users.name' , 'users.id')->toArray();
            $user_names = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->whereIn('role_user.role_id',array(6,7))->join('sessions', 'sessions.user_id', '=', 'users.id')->pluck( 'users.name' , 'users.name')->toArray();

            //dd($user_names);
                

                 $users[0] =  'not allocated';
                 $users[91] =  'TRAINEE DESIGNER';
                 $user_names['not allocated'] =  'not allocated';
                 $user_names['TRAINEE DESIGNER'] =  'TRAINEE DESIGNER';

          $status = Order_Status::pluck('status', 'status');  
          $status2 = Order_Status::pluck('status', 'status'); 
          $statusf = array();
                       
          
         if ($request->ajax()) {     
              
            if (Auth::user()->hasRole('Designer') && Auth::user()->level() <=11) {
             
               $dname =  Auth::user()->name ;
                $allotedid = [];
                 $dname = '%'. $dname . '%' ;
                  array_push($allotedid, Auth::user()->id );




                $data = Order::query()->where(function ($query) {
                 $dname =  Auth::user()->name ;  // old logic
                $allotedid = [];
                array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
                $dname = '%'. $dname . '%' ;
                $query->wherein('alloc_id' , $allotedid)
                      ->orWhere('allocation', 'like', $dname);
            });
    
          
            return Datatables::of($data)
                    ->addIndexColumn()
                  //
                           ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status , 'fileprice' => $user->file_price, 'filecount' => $user->file_count])->render();
              })
             ->addColumn('chbox', function ($user) {
             
                return "<br><input class='ml-2 mb-2 checkboxid1' type='checkbox' name='chboxs' value='{{$user->id}}'>";
                             
            })
            ->addColumn('updateusername', function ($user) {
                $updatedusernamedata= DB::table('users')->where('id', '=', $user->updated_by)->value('name');
                return $updatedusernamedata;
                             
            })
            ->addColumn('creatusername', function ($user) {
                $creatusernamedata= DB::table('users')->where('id', '=', $user->created_by)->value('name');
                return $creatusernamedata;
                             
            })
            ->addColumn('action', function ($user) {
               // $vendors = Vendor::pluck('name', 'name');
               //     $tot_revision = 0;
               //   $tot_revision = DB::table('orders')->where('order_id', '=', $user->order_id)->where('status', '=', 'Revision')->count();
                  
               // // dd($tot_revision);
                  
               //  return  view('partials.datatablesorders', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
               //   'file_count' => $user->file_count,
               //    'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
                return  view('partials.datatablesorders', ['id' => $user->id ,'filename' => $user->filename])->render();
                             
            })
            ->filterColumn('order_id', function ($query, $keyword) {
                $query->whereRaw("order_id like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('files', function ($query, $keyword) {
                $query->whereRaw("file_name like ?", ["%{$keyword}%"]);
            })
              ->addColumn('alloc_to_person', function ($user) {
                        $files = explode(',', $user->allocation);
                        $files = DB::table('order_dtls')->where('master_id','=', $user->id )
                                ->select('id', 'allocation')->where('deleted_flag','=','N')->get()->toArray();   
                      
                        $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  $key->allocation;
                    

           $btnmenu.="<li class=''>$fname</li>";
           
                  
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;          
                          
            })
            ->addColumn('files', function ($user) {
                        $files = explode(',', $user->file_name);
                        $files = DB::table('order_dtls')->where('master_id','=', $user->id )
                                ->select('id', 'file_name')->where('deleted_flag','=','N')->get()->toArray();   
                       // dd($files);
                        $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  $key->file_name;
                          $fid   =  $key->id;

                     
           //$btnmenu.="<a href='#'><li class='link1'>$key[$i]</li></a>";
           $btnmenu.="<a href='#'><li class='link1'>$fname</li><input type='hidden' name='fid' class='fid' value='$fid'></a>";
           
                     // $btn[]=$result;
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;          
               // return $files ;
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
            //
             ->addColumn('order_id', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                   $tot_revision = 0 ;
                 $tot_revision = DB::table('file_reason')->where('order_id', '=', $user->order_id)->where('last_status', '=', 'Revision')->count();
                  
               // dd($tot_revision);
                  
                return  view('partials.datatableseditorder', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
                 'file_count' => $user->file_count,
                  'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
            })
           
             ->escapeColumns([])
           
            //->where(function ($query) {
            //     $query->whereNotin('status' , [ 'Cancel', 'Changes', 'On Hold','Duplicate Entry', 'No Response', 'Revision']);
            // })
            // ->where(function ($query) {
            //      $dname =  Auth::user()->name ;  // old logic
            //     $allotedid = [];
            //     array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
            //     $dname = '%'. $dname . '%' ;
            //     $query->wherein('alloc_id' , $allotedid)
            //           ->orWhere('allocation', 'like', $dname);
            // })
           
                    // ->addColumn('action', function($row){
   
                    //        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

            
     
                    //         return $btn;
                    // })

                    ->rawColumns(['action'])
                    ->make(true);      
        }
       else if (Auth::user()->hasRole('sales') && Auth::user()->level() <=11) {

                 $csr_id =  Auth::user()->id ;

          $data = DB::table('orders')->join('clients', 'clients.company_id', '=', 'orders.company_id')->where('clients.csr_personid','=', $csr_id);
                     
            return Datatables::of($data)
                    ->addIndexColumn()
                  //
            ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status , 'fileprice' => $user->file_price, 'filecount' => $user->file_count])->render();
              })
             ->addColumn('chbox', function ($user) {
             
                return "<br><input class='ml-2 mb-2 checkboxid1' type='checkbox' name='chboxs' value='{{$user->id}}'>";
                             
            })

            ->addColumn('action', function ($user) {
               // $vendors = Vendor::pluck('name', 'name');
               //     $tot_revision = 0;
               //   $tot_revision = DB::table('orders')->where('order_id', '=', $user->order_id)->where('status', '=', 'Revision')->count();
                  
               // // dd($tot_revision);
                  
               //  return  view('partials.datatablesorders', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
               //   'file_count' => $user->file_count,
               //    'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
                return  view('partials.datatablesorders', ['id' => $user->id ,'filename' => $user->filename])->render();
                             
            })
            ->filterColumn('order_id', function ($query, $keyword) {
                $query->whereRaw("order_id like ?", ["%{$keyword}%"]);
            })
            ->addColumn('files', function ($user) {
                        $files = explode(',', $user->file_name);
                        $files = DB::table('order_dtls')->where('master_id','=', $user->id )
                                ->select('id', 'file_name')->where('deleted_flag','=','N')->get()->toArray();   
                       // dd($files);
                        $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  $key->file_name;
                          $fid   =  $key->id;

                     
           //$btnmenu.="<a href='#'><li class='link1'>$key[$i]</li></a>";
           $btnmenu.="<a href='#'><li class='link1'>$fname</li><input type='hidden' name='fid' class='fid' value='$fid'></a>";
           
                     // $btn[]=$result;
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;          
               // return $files ;
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
            ->addColumn('updateusername', function ($user) {
                $updatedusernamedata= DB::table('users')->where('id', '=', $user->updated_by)->value('name');
                return $updatedusernamedata;
                             
            })
            ->addColumn('creatusername', function ($user) {
                $creatusernamedata= DB::table('users')->where('id', '=', $user->created_by)->value('name');
                return $creatusernamedata;
                             
            })
            //
             ->addColumn('order_id', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                   $tot_revision = 0 ;
                 $tot_revision = DB::table('orders')->where('order_id', '=', $user->order_id)->where('status', '=', 'Revision')->count();
                  
               // dd($tot_revision);
                  
                return  view('partials.datatableseditorder', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
                 'file_count' => $user->file_count,
                  'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
            })
           
             ->escapeColumns([])
           
            //->where(function ($query) {
            //     $query->whereNotin('status' , [ 'Cancel', 'Changes', 'On Hold','Duplicate Entry', 'No Response', 'Revision']);
            // })
            // ->where(function ($query) {
            //      $dname =  Auth::user()->name ;  // old logic
            //     $allotedid = [];
            //     array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
            //     $dname = '%'. $dname . '%' ;
            //     $query->wherein('alloc_id' , $allotedid)
            //           ->orWhere('allocation', 'like', $dname);
            // })
           
                    // ->addColumn('action', function($row){
   
                    //        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

            
     
                    //         return $btn;
                    // })

                    ->rawColumns(['action'])
                    ->make(true);      
        }
            
          else{    
          $data = Order::query();
          
            return Datatables::of($data)
                    ->addIndexColumn()
                  //
                           ->addColumn('action1', function ($user) {
                return  view('partials.datatablesstatus', ['id' => $user->id, 'status' => $user->status , 'fileprice' => $user->file_price, 'filecount' => $user->file_count])->render();
              })
             ->addColumn('chbox', function ($user) {
             
                return "<br><input class='ml-2 mb-2 checkboxid1' type='checkbox' name='chboxs' value='{{$user->id}}'>";
                             
            })

            ->addColumn('action', function ($user) {
               // $vendors = Vendor::pluck('name', 'name');
               //     $tot_revision = 0;
               //   $tot_revision = DB::table('orders')->where('order_id', '=', $user->order_id)->where('status', '=', 'Revision')->count();
                  
               // // dd($tot_revision);
                  
               //  return  view('partials.datatablesorders', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
               //   'file_count' => $user->file_count,
               //    'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
                return  view('partials.datatablesorders', ['id' => $user->id ,'filename' => $user->filename])->render();
                             
            })
            ->filterColumn('order_id', function ($query, $keyword) {
                $query->whereRaw("order_id like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('files', function ($query, $keyword) {
                $query->whereRaw("file_name like ?", ["%{$keyword}%"]);
            })

            ->addColumn('alloc_to_person', function ($user) {
                        $files = explode(',', $user->allocation);
                        $files = DB::table('order_dtls')->where('master_id','=', $user->id )
                                ->select('id', 'allocation')->where('deleted_flag','=','N')->get()->toArray();   
                      
                        $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  $key->allocation;
                    

           $btnmenu.="<li class=''>$fname</li>";
           
                  
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;          
                          
            })
            ->addColumn('files', function ($user) {
                        $files = explode(',', $user->file_name);
                        $files = DB::table('order_dtls')->where('master_id','=', $user->id )
                                ->select('id', 'file_name')->where('deleted_flag','=','N')->get()->toArray();   
                       // dd($files);
                        $btnmenu="";
                        $btnmenu.="<span><ul style='list-style-type:none;text-align:left;' id='m1'>";
                 // for($i=0;$i<count($files); $i++) {
                    foreach ($files as $key) {
                     
                          $fname =  $key->file_name;
                          $fid   =  $key->id;

                     
           //$btnmenu.="<a href='#'><li class='link1'>$key[$i]</li></a>";
           $btnmenu.="<a href='#'><li class='link1'>$fname</li><input type='hidden' name='fid' class='fid' value='$fid'></a>";
           
                     // $btn[]=$result;
                      }
            $btnmenu.="</ul></span>";
          
             
             return $btnmenu;          
               // return $files ;
                 // \Form::open(array('method'=>'DELETE', 'route' => array('clients.destroy',".$user->client_id."))) .
                 //        \Form::submit('Delete', array('class'=>'btn')) .
                 //        \Form::close() ;             
            })
            ->addColumn('updateusername', function ($user) {
                $updatedusernamedata= DB::table('users')->where('id', '=', $user->updated_by)->value('name');
                return $updatedusernamedata;
                             
            })
            ->addColumn('creatusername', function ($user) {
                $creatusernamedata= DB::table('users')->where('id', '=', $user->created_by)->value('name');
                return $creatusernamedata;
                             
            })
            //
             ->addColumn('order_id', function ($user) {
                 $vendors = Vendor::pluck('name', 'name');
                   $tot_revision = 0 ;
                 $tot_revision = DB::table('file_reason')->where('order_id', '=', $user->order_id)->where('last_status', '=', 'Revision')->count();
                  
               // dd($tot_revision);
                  
                return  view('partials.datatableseditorder', ['id' => $user->id, 'orderid' =>$user->order_id, 'status'=> $user->status, 'fileprice' => $user->file_price,
                 'file_count' => $user->file_count,
                  'tot_revision'=> $tot_revision,   'vendors'=> $vendors])->render();
            })
            
             ->escapeColumns([])
           
            //->where(function ($query) {
            //     $query->whereNotin('status' , [ 'Cancel', 'Changes', 'On Hold','Duplicate Entry', 'No Response', 'Revision']);
            // })
            // ->where(function ($query) {
            //      $dname =  Auth::user()->name ;  // old logic
            //     $allotedid = [];
            //     array_push($allotedid, Auth::user()->id );    // New logic of laravel 5.6
                
            //     $dname = '%'. $dname . '%' ;
            //     $query->wherein('alloc_id' , $allotedid)
            //           ->orWhere('allocation', 'like', $dname);
            // })
           
                    // ->addColumn('action', function($row){
   
                    //        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

            
     
                    //         return $btn;
                    // })

                    ->rawColumns(['action'])
                    ->make(true);      
        }
 }
       //perms

        $vendors = Vendor::pluck('name', 'name');

       // logic for quote to no-response   on 18-12-19

                $cdt =  Carbon::now('Asia/Kolkata');

                $cdt =  date_format($cdt, 'Y-m-d H:i:s');

                $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $cdt)->subDays(10)->toDateTimeString();

               // dd($new_date);

                $noresponse =  DB::table('orders')->where('status', 'Quote')->
                          where('created_at' ,'<=' , $new_date)->select('id')->get()->toArray();

                //dd($noresponse);

                $quote=array();           

                foreach ($noresponse as $key) {
                            $quote[] = $key->id;
                          }          
                 
                // dd($quote);
                 $quotecount =  count($quote);         

                if ( $quotecount >0)
                {
                      DB::table('orders')->where('status', 'Quote')->
                          whereIn('id'  , $quote)->update(['status'=>'No Response']);
                }          

                  // logic for quote to no-response   on 18-12-19
 

          

            
      

       

        
   
         return view('orders.index', compact('users','user_names', 'status'));
   }  

 public function create(Request $request = null)
     {
        //dd($request->theme);

       //   $theme =  $request->theme ; 
       $theme = 'dark';

       //dd(Auth::user());

        $blank_array =array('0'=>'not allocated');

        $cdt =  Carbon::now('Asia/Kolkata');
        $us_time = Carbon::now('America/New_York');

        $cdt     =  date_format($cdt, 'Y-m-d H:i:s');
        $us_time =  date_format($us_time, 'Y-m-d H:i:s');

        $target_date  = Carbon::now('Asia/Kolkata')->addDay();
        //$target_date  = $cdt  ;

        //$users = User::pluck('name', 'id');
       // $users = DB::table('designer')->pluck( 'name' , 'id'); removed on 06-02-21 for designer table removing
        $user_names = DB::table('designer')->pluck( 'name' , 'name');

        $users = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->whereIn('role_user.role_id',array(6,7))->where('users.Deleted','=','N')->pluck( 'users.name' , 'users.id')->toArray();

        $user_names = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->whereIn('role_user.role_id',array(6,7))->where('users.Deleted','=','N')->pluck( 'users.name' , 'users.name')->toArray();

          $users[0] =  'not allocated';
                 $users[91] =  'TRAINEE DESIGNER';
                 $user_names['not allocated'] =  'not allocated';
                 $user_names['TRAINEE DESIGNER'] =  'TRAINEE DESIGNER';
           
        
        $status = Order_Status::pluck('status', 'status'); 
        $vendors = Vendor::pluck('name', 'name');

          if(isset($role->id)) {
                    $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

                    ->where("permission_role.role_id",$role->id)

                    ->get();
                    $rolePermissions = $rolePermissions->toArray();
                  }

          $perms = DB::table('permissions')
                    ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
                    ->join('users', function($join)
                      {
                        $join->on('users.id', '=', 'permission_user.user_id')
                        ->where('users.id', '=', Auth::user()->id);
                      })
                      ->select('permissions.*')
                      ->get();  

              //dd($perms);die;
              $rights1=array();
              foreach ($perms as $key ) {
                      # code...
                      $rights1[] =$key;
                    }    
                    
                    if(!empty($rolePermissions))  {
                    foreach ($rolePermissions as $key ) {
                      # code...
                      $rights2[] =$key;
                    }    
                  }
                
                if(!empty($rights2)) {
                    $rights = array_merge($rights1, $rights2);
                   }
                   else {
                          $rights = $rights1 ;
                   }

        if ($theme == 'dark') {    
           return view('orders.createbootswatch', compact('users',  'status','perms','rights','vendors' , 'us_time', 'cdt' , 'target_date' , 'blank_array' ,'user_names'));
         }
        elseif ($theme =='boot') {
               //dd("hello");
               return view('orders.createbootstrap', compact('users',  'status','perms','rights','vendors' , 'us_time', 'cdt', 'target_date', 'blank_array'));
        }
        else {
                return view('orders.createbootswatch', compact('users',  'status','perms','rights','vendors' , 'us_time', 'cdt' , 'target_date', 'blank_array', 'user_names'));
        }

     }


public function edit($id)
{
      //dd($id);
      if (Auth::user()->hasRole('Designer') ) {
            //dd("hello");
            return view('errors.403');
         } 

       if (!(Auth::user()->hasPermission('order.update') )) {
            //dd("hello");
            return view('errors.403');
         }    
         
        $Order = Order::find($id);

        //Updated by Logic added on 12/10/2017

            $created_by  = $Order->created_by;
            $updated_by = $Order->updated_by ;
            $cby_name =  User::find($created_by);
            $uby_name =  User::find($updated_by);
            $created_byname="";
            $updated_byname="";

            if(isset($cby_name->name)) {
                $created_byname =  $cby_name->name ;
            }
            if(isset($uby_name->name)) {
                $updated_byname =  $uby_name->name ;
            }    
           //  dd($cby_name->name);
           
      $logusers =  DB::table('user_logs')->where('order_id' ,'=', $Order->order_id)->orderby('id','desc')
                    ->limit(2)->get();
       

      foreach($logusers as $key=>$value) {
          $logy[] = collect($logusers[$key])->toArray();
       }
       //dd($logy);
      $diffcolumns = "" ;

         if(isset($logy)) {
      if( count($logy)> 1)
      {
           //dd($logy);
            $diffcol =  array_diff($logy[1], $logy[0]);
            $diffcol_1 =  array_diff($logy[0], $logy[1]);
            //dd($diffcol_1);
            $diffcol =array_slice($diffcol, 0, 5);
            //dd($diffcol);
            foreach($diffcol as $key=>$value)  
            {
                $diffcolumns .= $key .":" . $value  . ",";
            }
             foreach($diffcol_1 as $key=>$value)  
            {
                $diffcolumns .= $key .":" . $value  . ",";
            }


         
      }
      }
   

       $filecount_dtl =  $Order->file_count ;
       $diffcol1 = array();
        $diffcol2 = array();
        
      if ($filecount_dtl == 1 )  {
       $logusers1 =  DB::table('user_logs')->where('order_id' ,'=', $Order->order_id)->orderby('id','desc')->get();

      $logg=array();
       foreach($logusers1 as $key=>$value) {
          $logg[] = collect($logusers1[$key])->toArray();
       }

       
       for( $i=0; $i + 1 < count($logg); $i++)
       {

          $diffcol1[] = array_diff($logg[$i+1], $logg[$i]);
          $diffcol2[] = array_diff($logg[$i], $logg[$i+1]);

          //dd($diffcol1);
          // foreach ($diffcol1 as $key => $value) {
          //        if ($key <> 'id')  
          //         {
          //            dd($logg[$i][$key] . ' to ', $logg[$i+1][$key] );
          //         } 

          // }
       }
     }
     //  dd($diffcol1);
	  //Updated by logic added on 12/10/2017
  $logfirstrecord =  DB::table('user_logs')->where('order_id' ,'=', $Order->order_id)->orderby('id','asc')
                    ->limit(1)->get();
        $OrderDtl =   DB::table('order_dtls')->where('master_id' ,'=', $id)->where('deleted_flag', '<>','Y')->get();

        $OrderDtl = $OrderDtl->toArray();

        //dd($OrderDtl);

        $cdt =  Carbon::now('Asia/Kolkata');
        $us_time = Carbon::now('America/New_York');

        $cdt     =  date_format($cdt, 'Y-m-d H:i:s');
        $us_time =  date_format($us_time, 'Y-m-d H:i:s');

        $target_date  = Carbon::now('Asia/Kolkata')->addDay();
        //$target_date  = $cdt  ;

        //$users = User::pluck('name', 'name');
       // $users = DB::table('designer')->pluck( 'name' , 'id'); removed on 06-02-20
          //for  removing designer table


        $users = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->whereIn('role_user.role_id',array(6,7))->where('users.Deleted','=','N')->pluck( 'users.name' , 'users.id')->toArray();

          $users[0] =  'not allocated';
                 $users[91] =  'TRAINEE DESIGNER';
                 $user_names['not allocated'] =  'not allocated';
                 $user_names['TRAINEE DESIGNER'] =  'TRAINEE DESIGNER';
           

        $status = Order_Status::pluck('status', 'status'); 
        $vendors = Vendor::pluck('name', 'name');

          if(isset($role->id)) {
                    $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

                    ->where("permission_role.role_id",$role->id)

                    ->get();
                    $rolePermissions = $rolePermissions->toArray();
                  }

          $perms = DB::table('permissions')
                    ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
                    ->join('users', function($join)
                      {
                        $join->on('users.id', '=', 'permission_user.user_id')
                        ->where('users.id', '=', Auth::user()->id);
                      })
                      ->select('permissions.*')
                      ->get();  

              //dd($perms);die;
              $rights1=array();
              foreach ($perms as $key ) {
                      # code...
                      $rights1[] =$key;
                    }    
                    
                    if(!empty($rolePermissions))  {
                    foreach ($rolePermissions as $key ) {
                      # code...
                      $rights2[] =$key;
                    }    
                  }
                
                if(!empty($rights2)) {
                    $rights = array_merge($rights1, $rights2);
                   }
                   else {
                          $rights = $rights1 ;
                   }
         
          
        
        //dd($OrderDtl);
        //  below code added on  07-06-20
                    $Dtl = DB::table('order_dtls')->where('master_id' ,'=', $id)->get();

         $child_id = array();
         foreach ($Dtl as $key) {
            $child_id[]= (int)$key->id ;
         }
         
         
         
         
       //  $childid =  [$childid1];
       

                 
         $lastq = Activity::WhereIn('subject_id', $child_id)->where("subject_type","=","App\Models\OrderDtl")->Orderby('created_at','desc');

        //   dd($lastq);

         $lastActivity = Activity::where('subject_id' ,'=', $id)->where("subject_type","=","App\Models\Order")->union($lastq)->Orderby('created_at','desc')->get()->toArray();

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
        // above code added on 07-06-20

        
            
        return view('orders.edit', compact( 'Order', 'OrderDtl', 'users',  'status','perms','rights','vendors' , 'us_time', 'cdt' , 'target_date', 'created_byname' ,  'cols', 'updated_byname','logfirstrecord'));

}
public  function editdtl($id)
{
     
        $Order = Order::find($id);

        $order_oldstatus =  $Order->status ;
        
        $id1 = [] ;

        $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $Order->id)->where('deleted_flag', '<>','Y')->count();

       // dd($orddtlcount);

         $response = array(
                    
                    'status' => 'Success',
                    'msg' => 'Successfully Order changed' 
                  );

        if ($orddtlcount < 2 )
           {

            $response = array(
                    
                    'status' => 'Error',
                    'msg' => 'Single Order cannot be changed from here' 
                  );

                  return response()->json([$response]);
           }

          

        array_push($id1, auth::user()->id);
        
        if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12) {

            $OrderDtl =  DB::table('order_dtls')->where([['master_id' ,'=', $Order->id],['deleted_flag','<>','Y']])->whereRaw("FIND_IN_SET(?, alloc_id) > 0", [$id1])->get();

        }

        else {  
          $OrderDtl =  DB::table('order_dtls')->where('master_id' ,'=', $Order->id)->where('deleted_flag', '<>','Y')->get();
        }
    
        $OrderDtl = $OrderDtl->toArray();
        

        //dd($OrderDtl);

        $cdt =  Carbon::now('Asia/Kolkata');
        $us_time = Carbon::now('America/New_York');

        $cdt     =  date_format($cdt, 'Y-m-d H:i:s');
        $us_time =  date_format($us_time, 'Y-m-d H:i:s');

        $target_date  = Carbon::now('Asia/Kolkata')->addDay();
        //$target_date  = $cdt  ;

        //$users = User::pluck('name', 'id');
       // $users = DB::table('designer')->pluck( 'name' , 'id'); removed on 06-02-21

           $users = DB::table('users')->join('role_user', 'role_user.user_id','=', 'users.id')->whereIn('role_user.role_id',array(6,7))->where('users.Deleted','=','N')->pluck( 'users.name' , 'users.id')->toArray();

             $users[0] =  'not allocated';
                 $users[91] =  'TRAINEE DESIGNER';
                 $user_names['not allocated'] =  'not allocated';
                 $user_names['TRAINEE DESIGNER'] =  'TRAINEE DESIGNER';

        $status = Order_Status::pluck('status', 'status'); 

       
        $vendors = Vendor::pluck('name', 'name');

        // New logic of permission as per laravel 5.6  changed below code on 04-04-18

         $role = DB::table('role_user')->where('user_id', Auth::user()->id)->get();
                //dd($role);
                foreach ($role as $key) {
                  # code...
                     $roleid[] = $key->role_id ;
                }
                
                //dd($roleid);

                if(empty($roleid)) {
                      return view('errors.403');
                }

         
                    $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")

                    ->whereIn("permission_role.role_id", $roleid)
                    ->select("slug")
                    ->get();
                    $rolePermissions = $rolePermissions->toArray();
         

          $perms = DB::table('permissions')
                    ->join('permission_user', 'permissions.id', '=', 'permission_user.permission_id')
                    ->join('users', function($join)
                      {
                        $join->on('users.id', '=', 'permission_user.user_id')
                        ->where('users.id', '=', Auth::user()->id);
                      })
                     ->select('permissions.slug')
                     ->get();  

              //dd($perms);die;
              $rights1= [];
              $rights2= [];                     

              foreach ($perms as $key ) {
                      # code...
                      $rights1[] =$key;
                    }    
                    
                    if(!empty($rolePermissions))  {
                    foreach ($rolePermissions as $key ) {
                      # code...
                      $rights2[] =$key;
                    }    
                  }
                
                if(!empty($rights2)) {
                    $rights = array_merge($rights1, $rights2);
                   }
                   else {
                          $rights = $rights1 ;
                   }
          $tr="";
          $as=1;
          foreach ($OrderDtl as $key => $value) {
            # code...

             $alloted =  explode(",", $value->alloc_id);
             //dd($alloted);
             $alloc2=explode(",", $value->allocation);
             $alloc4="";
             $alloc3 = '<span class="addalloacation"><i class="fa fa-plus-square" aria-hidden="true"></i></span>

  <!-- The Modal -->
  <div class="modal fade dddd" id="alloccontmodal'.$value->id.'" style="overflow-y:hidden;">
    <div class="modal-dialog  modal-md" >
      <div class="modal-content" aria-hidden="true" style="overflow-y:hidden;" >
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select User</h4>
          <a class="btn btn-info btn-sm rightdiv closealloacation" id="" style="color: white;">submit</a>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <select  name="orddtls[allocation1][]"  multiple="multiple"  class=" form-control selectalloc input-sm " id="sdasdasdxx"  onchange="myFunallocation(this,'.$value->id.')">';
           foreach ($users as $key1=>$value1) {
                if (in_array($key1, $alloted)) {
                    
                   $alloc3 .= "<option value=". "'$key1'"." selected" . ">" .$value1.".</option>" ;
                   $alloc4 .=$value1.'<br>';
                }
                else {
                    $alloc3 .= "<option value="."'$key1'" . ">".$value1.".</option>";
                }

            }
          $alloc3 .= '</select></div>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        <!-- Modal footer -->
        <div class="modal-footer">
      
        </div>
        
      </div>
    </div>
  </div>
  
</div>';
             $alloc1 =   '<div class="hideselctuser"><select  name="orddtls[allocation1][]"  multiple="multiple"  class=" form-control selectalloc input-sm "  > ' ;
            
            foreach ($users as $key1=>$value1) {
                if (in_array($key1, $alloted)) {
                    //dd($user);
                   $alloc1 .= "<option value=". "'$key1'"." selected" . ">" .$value1 . "</option>" ;
                }
                else {
                    $alloc1 .= "<option value="."'$key1'" . ">" . $value1 . "</option>";
                }

            }
            
            $alloc1 .= "</select></div>";
          
           
           

             $actstatus = "";
             $actstatus = $value->status ;
             $statuscolor=strtolower($actstatus);
             $finalstatuscolor = preg_replace('/\s+/','', $statuscolor);

           // if ((Auth::user()->hasRole('Designer')) && (Auth::user()->level() < 2)) {

                if($actstatus == 'Quote'|| $actstatus == 'Alloted' || $actstatus == 'Ch-Alloted' || 
                  $actstatus == 'Rev-Alloted') {
                   $pstatus =   '<select  name="orddtls[status][]"   class="form-control
                    input-sm childstatus  '.$finalstatuscolor.'color" onchange="myStatuscolor(this)" > ' ;   
                }
                else {
                    $pstatus =   '<select  disabled name="orddtls[status][]"   class="form-control input-sm childstatus '.$finalstatuscolor.'color" onchange="myStatuscolor(this)" > ' ;    
                }


         //   }
        ///    else
         //   {
         //     $pstatus =   '<select  name="orddtls[status][]"   class="form-control input-sm childstatus" disabled="true" > ' ;
         //   }  
          
            foreach ($status as $st) {
                if ( $st ==  $actstatus) {
                   $pstatus .= "<option value=". "'$st'". "selected". ">" .$st. "</option>";
                 
                switch($st)  
             {
              
                      case 'Quote' :
                            if (Auth::user()->level() >16)  {
                           $pstatus .= '<option value="Approved"  >Approved</option>' ;
                         }
                          break;
                      case 'Approved' :
                           $pstatus .= '<option value="Alloted"  >Alloted</option>' ;
                          break;

                      case 'Alloted' :
                          $pstatus .= '<option value="QC Pending"  >QC Pending</option>';
                          
                          break;    

                      case 'QC Pending' :
                          $pstatus .= '<option value="QC OK"   >QC OK</option>';
                        
                          
                          break;      
                      
                      case 'Rev-Alloted' :
                          $pstatus .= '<option value="Rev-QC Pending"   >Rev-QC Pending</option>';
                          
                          break;   
                       case 'Rev-QC Pending' :
                          $pstatus .= '<option value="Rev-QC OK"   >Rev-QC OK</option>';
                          
                          break;   
                        case 'Revision' :
                          $pstatus  .= '<option value="Rev-Alloted"   >Rev-Alloted</option>';
                          break;                
                        case 'Changes' :
                          $pstatus  .= '<option value="Ch-Alloted"   >Ch-Alloted</option>' ;
                           break; 
                         case 'Ch-Alloted' :
                          $pstatus  .= '<option value="Ch-QC Pending"   >Ch-QC Pending</option>';
                            break;  
                          case 'Ch-QC Pending' :
                           $pstatus  .='<option value="Ch-QC OK"   >Cha-QC OK</option>';
                           break;   
                          
                
            }
                }
            }    
                // else {
                //     $pstatus .= "<option value="."'$st'". ">" . $st ."</option>";
                // }

            
            $pstatus .= "</select>";
             
             //dd($alloc1);
            $clid = $value->id ;

            if (Auth::user()->hasRole('Designer') &&  Auth::user()->level()< 12) {

                    $tr .= '<tr><td style="width:10px;"><input type="hidden"  class="ochildid" name="orddtls[childid][]" value="' . $clid . '"></div></td><td><input type="hidden" name="orddtls[document_type][]"  readonly="readonly" class=" form-control input-sm doctype" value="' . $value->document_type .'" >'.$value->document_type.' </td><td class="ellipsis"><input type="hidden" name="orddtls[file_name][]" readonly="readonly" class=" form-control input-sm"  value="' . $value->file_name . '"  required="required">'.$value->file_name.'</td><td class="ellipsis shownotes pl-1 pr-1">'.$value->note.'</td><td>' .$value->allocation.$alloc1.'</td><td><div class="form-group pl-1 pr-1"> <input type="text" name="orddtls[target_completion_time][]"  class=" form-control input-sm targettime "  value="' . $value->target_completion_time . '"  required="required"></div><input type="hidden" name="orddtls[allocation][]" class="updatealloc"
             value="' . $value->allocation .'"><input type="hidden" name="orddtls[alloc_id][]" class="updateallocid" value="' . $value->alloc_id .'"></td><td><div class="form-group pl-1 pr-1 mt-1">' . $pstatus . ' </div></td></tr>' ;



            } 
            else {  
            
                    $tr .= '<tr><td style="width:10px;"><div class="form-group"><input class="chkidctl mt-4" type="checkbox"  name="orddtls[chkid][]" value='.$clid.'></div><div class="form-group"><input type="hidden"  class="ochildid" name="orddtls[childid][]" value="' . $clid . '"></div></td><td><input type="hidden" name="orddtls[document_type][]"  readonly="readonly" class=" form-control input-sm doctype" value="' . $value->document_type .'" >'.$value->document_type.' </td><td class="ellipsis"><input type="hidden" name="orddtls[file_name][]" readonly="readonly" class=" form-control input-sm"  value="' . $value->file_name . '"  required="required">'.$value->file_name.'</td><td class="ellipsis shownotes pl-1 pr-1">'.$value->note.'</td><td>'.$alloc3.'<span id="allocationgetchangevalue'.$value->id.'">'.$alloc4.'</span></td><td><div class="form-group pl-1 pr-1"> <input type="text" name="orddtls[target_completion_time][]"  class=" form-control input-sm targettime "  value="' . $value->target_completion_time . '"  required="required"></div><input type="hidden" name="orddtls[allocation][]" class="updatealloc" value="' . $value->allocation .'"><input type="hidden" name="orddtls[alloc_id][]" class="updateallocid" value="' . $value->alloc_id .'"></td><td><div class="form-group pl-1 pr-1 mt-1">' . $pstatus . ' </div></td></tr>' ;

            }
           
            

          }
         
            return response($tr);
         //return response()->json(['OrderDtl' = $OrderDtl])->render();
         
        // return view('orders.editdtl', compact( 'Order', 'OrderDtl', 'users',  'status','perms','rights','vendors' , 'us_time', 'cdt' , 'target_date'))->render();
  
}



   public function search(Request $request )
     {
               // dd($request->search);
                $output =  '';
                $clients = DB::table('client_dtls')
                 ->join('clients', 'clients.id', '=', 'client_dtls.client_id')
		  ->where('clients.company_id', '=', 'client_dtls.company_id')
                 ->where('client_dtls.client_name', 'like', '%' . $request->search . '%')
                 ->where('client_dtls.delete_flag','=', 'N')
                 ->where('clients.delete_flag','=', 'N')
                 ->orWhere('client_dtls.client_email_primary', 'like', '%' . $request->search . '%')
                 ->orWhere('clients.client_company', 'like', '%' . $request->search . '%')
                 // ->orWhere('client_email_secondary', 'like', '%' . $request->search . '%')
                 ->orWhere('client_dtls.client_company', 'like', '%' . $request->search . '%')
                 ->orWhere('client_dtls.client_creation_id', 'like', '%' . $request->search . '%')
                 ->orWhere('client_dtls.client_note', 'like', '%' . $request->search . '%')
                  ->orWhere('client_dtls.client_contact_1', 'like', '%' . $request->search . '%')
                  ->select('clients.digit_rate', 'clients.client_specific', 'client_dtls.*')
                  ->get();
                

			  $output = ' ';
                foreach ($clients as $client) {
                        // dd($client->digit_rate);

                   // dd($parent_company->digit_rate);
                    $digit_rate = 'null' ;
                    
                    // if ($header_company->has('digit_rate'))
                    // {
                    //   $digit_rate = $header_company->digit_rate;
                    // }
                  
                    if ( $client->delete_flag == 'N')
                    {
                     
                         $output .= '<tr>' .'<td>' . $client->id . '</td>' .
                                    '<td>' . $client->client_creation_id . '</td>' .
                                    '<td>' . $client->client_name . '</td>' .
                                    '<td>' . $client->client_email_primary . '</td>' .
                                    '<td>' . $client->client_company . '</td>' .
                                    '<td>' . $client->client_note . '</td>' .
                                    '<td>' . $client->client_contact_1 . '</td>' .
                                    '<td>' . $client->company_id . '</td>' .
                                    '<td>' . $client->black_list. '</td>' .
                                    '<td>' . $client->digit_rate . '</td>' .
                                    '<td>' . $client->client_specific . '</td>' 
                                  .'</tr>' ;
                    }
                  
                }
                

                return Response($output);


     } 

public function store(Request $request)
{
  
  $input = $request->all();
  //dd($input);
   if ($input['client_name'] == "" || $input['client_email_primary'] == "") {
        //dd("hello");
        return back()->withErrors(['errors' => ['Select Client name First']])->withInput();
  }

  $validatedData =  $request->validate([
           'client_name' => 'required',
           'client_email_primary'  =>'required',
           'stiches_count' => 'required',
           'file_price'  =>'required',
           'file_count' => 'required|integer|min:1',
           'orddtls.note.*'  => 'required' ,
           'orddtls.file_price.*' => 'required'
    ]);

  // $this->validate($request, [
  //         'client_name' => 'required',
  //         'client_email_primary'  =>'required'
  //                 ]);

 
  
  $result = DB::transaction(function() use ($request) {     
  try {

      $input = $request->all();

      // dd($input);

      if (is_null($input['bill_dt'])) {
          $input['bill_dt'] = $input['order_us_date'];
      }
    
        
    $input_dtls   = $input['orddtls'];
    
    //dd($input_dtls['alloc_id'][0]);

    $cdt =  Carbon::now('Asia/Kolkata');

    $cdt =  date_format($cdt, 'Y-m-d H:i:s');

      $child_status = '';  //  new column created on 24/10/19
   

    //$us_time = Carbon::now('America/New_York');  Removed on 15/03/18 as clash when next day changes
    $us_time1 =  $input['order_us_date'] ;
    //$us_time =  date_format($us_time, 'Ymd'); will not work for request date
    $us_time  = date('Y-m-d', strtotime($us_time1));
    $us_time2  = date('Ymd', strtotime($us_time1));
    //dd($us_time);

    $input['order_dt'] = $cdt ;

     $header_value = 0;  $detail_value = 0 ;
    if ($input['file_type'] <> "Digitizing" ) {
        $header_value = $input['file_price'];
        $detail_value = 0 ;
        for($i=0;$i <count($input_dtls['file_price']);$i++)
          {
              $detail_value = $detail_value + $input_dtls['file_price'][$i] ;
          }

          if ($header_value <> $detail_value) {
              return back()->withErrors(['errors' => ['Total File Price does not match with line totals']]);
          }  
     }
          
     
    $breaks = array("<br />","<br>","<br/>");  
    $ip_address = $_SERVER['REMOTE_ADDR'] ;
    $clid  =  $input['client_creation_id'];
    $company =  DB::table('client_dtls')->select('company_id',
      'client_note', 'client_contact_1')->where('client_creation_id' ,'=', $clid)->first();

    //dd( $company->company_id ); getting right value tested

    $input['company_id'] = $company->company_id ;
    $input['client_note'] = $company->client_note ;
    $input['client_contact_1'] = $company->client_contact_1;

   //   dd($input);

    $parent_company =  DB::table('clients')->select('client_address1',
      'client_state', 'client_country', 'digit_rate')->where('company_id' ,'=', $company->company_id)->first();

    //dd($parent_company);
    if (is_null($parent_company)) {
         return back()->withErrors(['errors' => ['Company is either Deleted or Invalid Record']]);
    }

    //dd($input);

    $input['client_address1']  = $parent_company->client_address1;
    $input['client_state']     = $parent_company->client_state;
    $input['other_contact']    = "";

    if (   $input['digit_rate'] == 0  ||  $input['digit_rate'] == null )
    {
               $input['digit_rate']       = $parent_company->digit_rate;  
    }
    



    $userid = Auth::user()->id;
    //dd($userid); die;

        $input['created_by'] = (int)$userid ;
        $input['updated_by'] = 0;   
        
        $input['ip_address'] = $ip_address ;
        $input['created_nm'] = Auth::user()->name;
        $input['updated_nm'] = "";
        
        $input['status'] = 'Quote' ;

        // if( $input['status'] == 'Approved' )  { 
        //            $input['approval_time'] = $cdt ;
        //            $time_original = $cdt ;
        //  }

        $approval_time = NULL;
        $approval_us_time = NULL;

      
       $maxorderid = DB::table('orders')->where('order_us_date','>=',$us_time)->where('order_id', 'like', 'PO%')->max('order_id');
      
       if( is_null($maxorderid)) {
          $max_id = 0;
          
         }
        else
            {
                    $max_id = $maxorderid;
                    $max_id = substr($max_id, -4);    
            }

      $max_id = (int)($max_id + 1) ;
      $new_dt  = $us_time2 ;
          
      $input['order_id'] = 'PO' . $new_dt . str_pad($max_id, 4, "0", STR_PAD_LEFT);

      $ord_id1 =  'PO' . $new_dt . str_pad($max_id, 4, "0", STR_PAD_LEFT);
     
      // if(is_array($input['allocation'])) {
      //       $input['allocation'] =  join(',', $input['allocation']);
      //     }

      $cnote = "";

      if (isset($input['client_note'])) {
                    $cnote =  $input['client_note'];
      }
      else
       {
                 $input['client_note'] ="";

       }
  
       // dd($input);

         $id = Order::create($input)->id;
        $input['file_count'] =  count($input_dtls['document_type']);
        $input['action'] = 'New Entry ' . 'funct: OrderController@store' ;
        //dd($id);
        $logid = Userlog::create($input)->id;

        // notification logic  on 30-aug-21  and removed on 07-09-21
        // $details =  'Order'.$ord_id1 . 'created';
        // $user = User::find(1);

        //  Notification::send($user, new OrderStatusNotification($details));

        // notification logic on 30-aug-21
        // $response = array(
        //             'createdrowid' => $id,
        //             'status' => 'success',
        //             'msg' => 'Successfully created' . $ord_id1
        //   );
        //return response()->json([$response]);

       $all_filenames = '';
       $all_fnotes  = '';
       $breaks = array("<br />","<br>","<br/>");  
        
      // dd(count($input_dtls['document_type']));
      $all_filenames   =  "";
      $all_fnotes      =  "";
      $all_alloc       =  "";
      $all_allocid       =  "";

      for($i=0;$i <count($input_dtls['document_type']);$i++)
      {    
               // dd($input_dtls['allocation'][$i]);
                $alloc="";
                $alloc_id = "";
                if (isset($input_dtls['allocation'][$i])) {
                  
                    // if (count($input_dtls['allocation1'][$i])> 0)  {
                    //   $alloc =  join(',' , $input_dtls['allocation1'][$i]);
                    // }
                    // else {
                    //     $alloc = ' ';
                    // }
                    // dd($input_dtls['alloc_id'][$i]);

                    $alloc =  $input_dtls['allocation'][$i];
                    $alloc_id = $input_dtls['alloc_id'][$i];
                    //dd($alloc_id);
                  }
                else  {
                      $alloc = ' ';
                      $alloc_id = ' ';
                }  

                    if( $input_dtls['status'][$i] == 'Approved' )  { 
                        $approval_time = $cdt ;
                        $approval_us_time  =  Carbon::now('America/New_York');
                        $approval_us_time  =  date_format($approval_us_time, 'Y-m-d H:i:s');

    
                    }
                   
                
                if (isset($input_dtls['note'][$i])) {
                    $note = str_ireplace($breaks, "\r\n", $input_dtls['note'][$i] );           
                  }
                else {
                    $note = "";
                  }


                
                $status =  $input_dtls['status'][$i];
                $dtl['master_id']  =   $id;
                $dtl['order_id']   =   $ord_id1 ;
                $dtl['file_count']  = count($input_dtls['document_type']); 
                $dtl['client_creation_id'] = $input['client_creation_id'];
                $dtl['client_company']     = $input['client_company'] ;
                $dtl['client_note']        = $cnote; 
                $dtl['file_name' ]         = $input_dtls['file_name'][$i];
                $dtl['file_type']          = $input['file_type']; 
                $dtl['vendor']             = $input['vendor']; 
                $dtl['digit_rate']         = 0;
                $dtl['stiches_count']      = $input['stiches_count']; 


                $dtl['file_price']         = $input_dtls['file_price'][$i]; 
                $dtl['vendor_digit_rate']  = 0; 
                $dtl['vendor_digit_price'] = 0;  
                $dtl['order_date_time']    = $input['order_date_time']; 
                $dtl['order_dt']           = $input['order_dt']; 
                $dtl['target_completion_time']   =  $input_dtls['target_completion_time'][$i]; 
                $dtl['allocation']               =  $alloc;  
                $dtl['alloc_id']                 =  $alloc_id; 
                $dtl['status']                   =  $input_dtls['status'][$i];    
                $dtl['document_type']            =  $input_dtls['document_type'][$i];
                $dtl['note']                     =  $note; 
                $dtl['unit_price']               =  0 ;
                $dtl['order_us_date']            =  $input['order_us_date'];
                $dtl['created_by']               =  $input['created_by'] ; 
                $dtl['updated_by']               =  $input['updated_by']; 
                $dtl['order_completion_time']    =  $input_dtls['target_completion_time'][$i];
               
                $dtl['approval_time']            =  $approval_time; 
                $dtl['approval_us_time']         =  $approval_us_time;
               
                $dtl['status_change_date']       =  $cdt;
                $dtl['ip_address']               =  $input['ip_address'];  
                $dtl['company_id']               =  $input['company_id'] ;
                //$dtl['file_count']               =  $input['file_count']; 

               
                $child_id =  OrderDtl::create($dtl)->id;
                //dd($child_id);
                $dtl['child_id'] =  $child_id ;
                $dtl['created_by'] =  Auth::user()->id ;
                $dtl['action'] = 'New Entry ' . 'funct: OrderController@store' ;
                  
                orderdtls_history::create($dtl);

               
                $all_filenames   .=   $input_dtls['file_name'][$i] . ',' ;
                $all_fnotes      .=   $note . ',' ;
                $all_alloc       .=   $alloc . ',';
                $all_allocid     .=   $alloc_id . ',';
                $doc_type         =   $input_dtls['document_type'][$i];
                $target_date      =   $input_dtls['target_completion_time'][$i]; 
                $compl_time       =   $input_dtls['target_completion_time'][$i]; 
                $child_status      =   $input_dtls['status'][$i] . ',';  // new column assign on 24/10/19

        }
        
         $all_filenames   =  substr_replace($all_filenames,"",-1);
         $all_fnotes      =  substr_replace($all_fnotes,"",-1);
         $all_alloc       =  substr_replace($all_alloc,"",-1);
         $all_allocid       =  substr_replace($all_allocid,"",-1);

        Order::where('id', $id)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type , 'target_completion_time' => $target_date ,
          'allocation' => $all_alloc, 'alloc_id' => $all_allocid, 'approval_time' => $approval_time, 'approval_us_time' => $approval_us_time, 'status_change_date' => $cdt,  'child_status' => $child_status ,
          'status' => $status, 'order_completion_time' => $compl_time ]);
        
         DB::table('user_logs')->where('id', $logid)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type ,'target_completion_time' => $target_date ,
          'allocation' => $all_alloc, 'alloc_id' => $all_allocid, 'approval_time' => $approval_time, 'approval_us_time' => $approval_us_time, 'status_change_date' => $cdt,
          'status' => $status, 'order_completion_time' => $compl_time ]);

             
          if ( $input['file_type'] == 'Digitizing')
          {
             $result = DB::select('CALL ord_updation(?)', array($id));
          } 
        
        return redirect()->action('OrderController@index', ['newid'=>$id]);

       } catch (\Exception $e) { 
          //dd("error" . $e);
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Errors in Saving, Contact IT Department' );
          DB::rollBack();
        
          return redirect()->back()->withErrors(['errors' => $e->getMessage()]); 
        
      }


    });

    return $result;   

}

public function update(Request $request, $id) 
{
  //http_response_code(500);
  //dd($request->file_count);


  $validatedData =  $request->validate([
           'stiches_count' => 'required',
           'file_price'  =>'required',
          'file_count' => 'required|integer|min:1',
           'orddtls.note.*'  => 'required' ,
           'orddtls.file_price.*' => 'required'
              ]);

  // Old Method  for 5.3 above code changed for 5.6
  //  $this->validate($request, [
  //        'stiches_count' => 'required',
  //        'file_price'  =>'required',
  //        'approval_time' => 'required',
  //        'orddtls.note.*'  => 'required'
          // 'vendor_digit_rate' => 'required',
          // 'vendor_digit_price' => 'required'
   //      ]);

 // dd($request->all());

  $result = DB::transaction(function() use ($request, $id) {     
  try {

        $input = $request->all();
        //http_response_code(500);
       //dd($input);
        $Order=Order::find($id);

        $child_status = '' ;

        $what_changed = '';

        //get Old records added on 18/10/18
        $order_old_record = DB::table('orders')->where('id', $id)->get();
        $order_old_record = collect($order_old_record);
        $order_old_record = $order_old_record->toArray();

        $alloc_log = array();

        $diff1=array();
        // dd($order_old_record);
        foreach ($order_old_record as $old) {
             // $old_records[] = collect($order_old_record[$key])->toArray();
                     foreach ($old as $key => $value) {
                              //dd($key);         
                             $old_records[$key] = $value ;
                             if (array_key_exists($key ,$input)) {
                               if($input[$key]<> $old_records[$key] )
                                {
                                  $diff1[$key] =  $value ;
                                  $what_changed = $what_changed . $key . ' value '. $diff1[$key] . ' Changed to ' . $input[$key] . ' ' ;
                                }
                              }
                     }
             
              
         }

        //dd($diff1);

        // get Old records difference on 18/10/18


        $ord_id1 = $Order->order_id ;
        
        $input_dtls   = $input['orddtls'];

        //dd($input_dtls);

        $j =   count($input_dtls['document_type']);  

        $cdt =  Carbon::now('Asia/Kolkata');

        $cdt =  date_format($cdt, 'Y-m-d H:i:s');

        $us_time = Carbon::now('America/New_York');
        $us_time =  date_format($us_time, 'Y-m-d H:i:s');

        //$input['order_dt'] = $cdt ;
        $breaks = array("<br />","<br>","<br/>");  
      
        $ip_address = $_SERVER['REMOTE_ADDR'] ;
       

        $userid = Auth::user()->id;
        
        $input['updated_by'] = (int)$userid ;
        $input['ip_address'] = $ip_address ;
        $input['updated_nm'] = Auth::user()->name;
        $input['created_nm'] = ' ';

        // code added on 10/03/18 for file price validation
        $header_value = 0;  $detail_value = 0 ;
      if ($input['file_type'] <> "Digitizing" ) {
        $header_value = $input['file_price'];
        $detail_value = 0 ;
        for($i=0;$i <count($input_dtls['file_price']);$i++)
          {
            $detail_value = floatval($detail_value) + floatval($input_dtls['file_price'][$i]);
          }

          if ($header_value <> $detail_value) {
              return back()->withErrors(['errors' => ['Total File Price does not match with line totals']])->withInput(); 
          }  
     }
     //dd($detail_value);


        // code added on 10/03/18 for file price validation

      
        //$new_dt  = $us_time ;


      $approval_time =  $Order->approval_time;
      $approval_us_time =  $Order->approval_us_time;

     if (is_null($input['bill_dt'])) {
          $input['bill_dt'] = $input['order_us_date'];
      }
      
      if( $input_dtls['status'][0] == 'Approved' )  { 
            if(is_null($approval_time)) {
                  $input['approval_time']  = $cdt ;
                  $input['approval_us_time'] = $us_time ;
            }
          
      }    

      // changes on 28-08-19 as per kulind sir instruction for updating bill date as approval date
      // CHANGES ON 13/09/19  FOR  ONLY  NEW APPROVED STATUS 

      if ($Order->status != 'Approved') {
          if( $input_dtls['status'][0] == 'Approved' )  { 
                   $input['bill_dt']  =  $us_time ;
          }
        }

       if($input['old_price'] == null)  {
          $input['old_price'] =  $input['file_price'];
       }
                
      $res =  $Order->update($input);
      
     


      $orderupdate  = DB::table('orders')->where('id','=', $Order->id)->get();
      $orderupdate =  $orderupdate->toArray();
      foreach ($orderupdate as  $value) {
          // dd($value);
          $loginput["order_id"] = $value->order_id ;
          $loginput["client_creation_id"] = $value->client_creation_id ;
          $loginput["client_name"] = $value->client_name ;
          $loginput["client_email_primary"] = $value->client_email_primary ;
          $loginput["client_company"] = $value->client_company ;
          $loginput["client_address1"] = $value->client_address1 ;
          $loginput["client_state"] = $value->client_state ;
          $loginput["client_contact_1"] = $value->client_contact_1 ;
          $loginput["other_contact"] = $value->other_contact ;
          $loginput["client_note"] = $value->client_note ;
          $loginput["file_name"] = $value->file_name ;
          $loginput["file_type"] = $value->file_type ;
          $loginput["vendor"] = $value->vendor ;
          $loginput["digit_rate"] = $value->digit_rate ;
          $loginput["stiches_count"] = $value->stiches_count ;
          $loginput["old_price"] = $value->old_price ; // added on 05/11/2019
          $loginput["file_price"] = $value->file_price ;
          $loginput["vendor_digit_rate"] = $value->vendor_digit_rate ;
          $loginput["order_date_time"] = $value->order_date_time ;
          $loginput["order_dt"] = $value->order_dt ;
          $loginput["target_completion_time"] = $value->target_completion_time ;
          $loginput["allocation"] = $value->allocation ;
          $loginput["status"] = $value->status ;
          $loginput["document_type"] = $value->document_type ;
          $loginput["note"] = $value->note ;
          $loginput["unit_price"] = $value->unit_price ;
          $loginput["order_us_date"] = $value->order_us_date ;
          $loginput["created_by"] = $value->created_by ;
          $loginput["updated_by"] = (int)$userid ;
          $loginput["order_completion_time"] = $value->order_completion_time ;
          $loginput["approval_time"] = $value->approval_time ;
          $loginput["approval_us_time"] = $value->approval_us_time ;
          $loginput["ip_address"] = $ip_address ;
          $loginput["company_id"] = $value->company_id ;
          $loginput["file_count"] = $value->file_count ;
          $loginput["alloc_id"] = $value->alloc_id ;
          $loginput['updated_nm'] = Auth::user()->name;
          $loginput['created_nm'] = ' ';
          $loginput["action"] = "update entry " . "OrderController@update" ;
          $loginput['bill_dt'] =  $value->bill_dt;

        
      }
      //dd($loginput);
      $logid = Userlog::create($loginput)->id;  
      
      //dd("hello" . $j);
     
      $all_filenames = '';
      $all_fnotes  = '';
      $all_alloc = '' ;
      $all_allocid = '' ;
      $compl_time = null ;

      $finalstatus = false ;
      $status = "";
      $change_status = "";
      $f_status = '' ;

      for($i=0;  $i <$j; $i++)
      {    
                //dd($input_dtls['allocation']);
                $alloc="";
                $alloc_id = "";
                if (isset($input_dtls['allocation'][$i])) {
                  
                    // if (count($input_dtls['allocation1'][$i])> 0)  {
                    //   $alloc =  join(',' , $input_dtls['allocation1'][$i]);
                    // }
                    // else {
                    //     $alloc = ' ';
                    // }

                    // new logic for not keeping allocation blank
                   if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'QC Pending' || $input_dtls['status'][$i]== 'QC OK'
                        || $input_dtls['status'][$i] == 'Alloted' || $input_dtls['status'][$i] == 'Completed'))
                  {

                    if (($input['file_type'] =='Vector') && ( $input_dtls['status'][$i] != 'Changes'))
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 }
                 //// second condition
                 if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'QC Pending' || $input_dtls['status'][$i]== 'QC OK'
                        || $input_dtls['status'][$i] == 'Alloted' || $input_dtls['status'][$i] == 'Completed'))
                  {  
                     if ($input['file_type'] =='Vector') 
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 }

                 // Rev and changes allocation 
                 if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'Rev-QC Pending' || $input_dtls['status'][$i]== 'Rev-QC OK'
                        || $input_dtls['status'][$i] == 'Rev-Alloted' || $input_dtls['status'][$i] == 'Rev-Completed'))
                  {

                    if (($input['file_type'] =='Vector') && ( $input_dtls['status'][$i] != 'Changes'))
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 } 

                   if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'Rev-QC Pending' || $input_dtls['status'][$i]== 'Rev-QC OK'
                        || $input_dtls['status'][$i] == 'Rev-Alloted' || $input_dtls['status'][$i] == 'Rev-Completed'))
                  {  
                     if ($input['file_type'] =='Vector') 
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 }

                //  cHANGES VALIDATION
                 if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'Ch-QC Pending' || $input_dtls['status'][$i]== 'Ch-QC OK'
                        || $input_dtls['status'][$i] == 'Ch-Alloted' || $input_dtls['status'][$i] == 'Ch-Completed'))
                  {

                    if (($input['file_type'] =='Vector') && ( $input_dtls['status'][$i] != 'Changes'))
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 } 

                   if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   ( $input_dtls['status'][$i] == 'Ch-QC Pending' || $input_dtls['status'][$i]== 'Ch-QC OK'
                        || $input_dtls['status'][$i] == 'Ch-Alloted' || $input_dtls['status'][$i] == 'Ch-Completed'))
                  {  
                     if ($input['file_type'] =='Vector') 
                    {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files'])->withInput(); 
                   }
                 }
 
                  


                  // new logic for not keeping allocation blank

                    $alloc =  $input_dtls['allocation'][$i];
                    $alloc_id = $input_dtls['alloc_id'][$i];

                       

                  }
                else  {
                      $alloc = ' ';
                      $alloc_id = ' ';
                }  
                 
                //dd($alloc . $alloc_id);

                // if (is_array($input_dtls['status'][$i]))    
                // {
                //    $status = implode(" ", $input_dtls['status'][$i]) ;
                // }
                // // else {
                  
                // }   

                // dd($status);
                // if (($status == "Completed") this is old logic not proper removed 24/10/19
                //     && ($input_dtls['status'][$i] == 'Completed'))
                // {
                //    $finalstatus = true ;
                // }
                // else {
                //    $finalstatus = false ;
                // }

                   $status =  $input_dtls['status'][$i];

                  if ($status == 'QC OK') {
                  $dtlid =  OrderDtl::findOrFail($input_dtls['odtlid'][$i]);
                  if($dtlid->status=="QC Pending"){
               
                      if (Auth::user()->hasPermission('do.qc.ok'))  {
                     
                          $response = array(
                                   'status' => 'SUCCESS',
                                   'status' => $status,
                                    'msg' => 'QC OK Successfully changed'
                                  );
                      }
                      else {
                         $response = array(
                         'status' => 'Error',
                         'status2' => $status,
                         'msg' => 'No permission for QC OK'

                          );
                         DB::rollBack();
            
                          return redirect()->back()->withErrors(['errors' => 'No permission for QC OK'])->withInput(); 
                      }
                  }

          
                }  

                    if( $input_dtls['status'][$i] == 'Approved' )  { 
                              $approval_time = $cdt ;
                              $approval_us_time =  $us_time;
                    }
                   
                
                if (isset($input_dtls['note'][$i])) {
                    $note = str_ireplace($breaks, '\r\n', $input_dtls['note'][$i] );           
                    //dd($note);
                  }
                else {
                    $note = "";
                  }
                
               

                $dtl['master_id'] =   $id;
                $dtl['order_id']  =   $ord_id1 ;
                $dtl['client_creation_id'] = $Order->client_creation_id;
                $dtl['client_company']     = $Order->client_company ;
                $dtl['client_note']        = $Order->client_note; 
                $dtl['file_name' ]         = $input_dtls['file_name'][$i];
                $dtl['file_type']          = $input['file_type']; 
                $dtl['vendor']             = $input['vendor']; 
                $dtl['digit_rate']         = 0;
                $dtl['stiches_count']      = $input['stiches_count']; 
               

                $dtl['file_price']         = $input_dtls['file_price'][$i]; 
                $dtl['old_price']          = $input_dtls['old_price'][$i]; 
                $dtl['vendor_digit_rate']  = 0; 
                $dtl['vendor_digit_price'] = 0;  
                $dtl['order_date_time']    = $Order->order_date_time ; 
                $dtl['order_dt']           = $Order->order_dt ; 
                $dtl['target_completion_time']   =  $input_dtls['target_completion_time'][$i]; 
                $dtl['allocation']               =  $alloc;  
                $dtl['alloc_id']                 =  $alloc_id;  
                $dtl['status']                   =  $input_dtls['status'][$i];  



                // dd($input_dtls['status']);
                     if( ($input_dtls['status'][$i] == 'Approved') && 
                      ($alloc <>'not allocated' && $alloc_id <> '0') )  { 
                             $dtl['status'] = 'Alloted' ;
                            // dd($dtl['status']);
                             $status = 'Alloted';
                    }
                
                //approved to alloted

              
    

                
                $dtl['document_type']            =  $input_dtls['document_type'][$i];
                $dtl['note']                     =  $note; 
                $dtl['unit_price']               =  0 ;
                $dtl['order_us_date']            =  $input['order_us_date'];
                $dtl['order_completion_time']    =  $input_dtls['target_completion_time'][$i];
                $dtl['approval_time']            =  $approval_time; 
                $dtl['approval_us_time']         =  $approval_us_time; 
                $dtl['status_change_date']       =  $cdt;
                $dtl['ip_address']               =  $input['ip_address'];  
               
                $dtl['file_count']               =  $input['file_count']; 

                // ALLOCATION  INSERT


                // ALLOCATION  INSERT

                // if (isset($input_dtls['rev_mistake'][$i])) {
                  
                //     $reason  =   [ 'target_date' => null,
                //                    'old_notes' => null,
                //                    'new_notes' => null, 
                //                    'mistake_by' => $input_dtls['rev_mistake'][$i],
                //                    'reason' =>  $input_dtls['rev_mistake_reason'][$i],
                //                    'order_id' => $ord_id1, 
                //                    'order_master_id' => null,
                //                    'order_child_id' => null, 
                //                     'last_status' => $input_dtls['status'][$i],
                //                   'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                //                   'designer' => $request->mistake_designer_name ,
                //                   'teamleader' => $request->teamleader
                //               ] ;
   

                //                FileReason::create($reason);

  
                // }
                
                
                //dd($dtl);
                $dtl_old_status ='';
                  if (isset($input_dtls['odtlid'][$i])) 
                {
                    $child_id  = $input_dtls['odtlid'][$i];

                    //dd($child_id);
                    
                    $dtlid =  OrderDtl::find($input_dtls['odtlid'][$i]);
                      //OLD  CHILD RECORD UPDATE
                    
                    if( $dtlid->old_status == null)  {
                           $dtl_old_status  =  $dtlid->status ;
                    }
                    else {
                           $dtl_old_status  =  $dtlid->old_status ;
                    }  
                    // dd($dtlid->status);
                    //  OLD CHILD RECORD UPDATE
                   

                    //
                    //get Old Dtl records added on 18/10/18
                   
        $order_oldchild_record = DB::table('order_dtls')->where('id', 
          $child_id)->get();
        $order_oldchild_record = collect($order_oldchild_record);
        $order_oldchild_record = $order_oldchild_record->toArray();
        // dd($order_old_record);
        $what_changed2 = ' ';
        foreach ($order_oldchild_record as $old) {
             // $old_records[] = collect($order_old_record[$key])->toArray();
                     // dd($order_oldchild_record);
                     foreach ($old as $key => $value) {
                             // dd($key);         
                        $old_child_records[$key] = $value ;
                        if (array_key_exists($key ,$input_dtls)) {
                               if($input_dtls[$key][$i] <> $old_child_records[$key] )
                                {

                                  //dd($input_dtls[$key]);
                                  $diff1[$key] =  $value ;
                                  $what_changed2 = $what_changed2 . $key . ' value '.  (string)$diff1[$key] . ' Changed to ' . 
                                  (string)$input_dtls[$key][$i] . ' ' ;

                                  //dd($what_changed2);
                                }
                              }
                     }
             
              
         }

        // get Old records difference on 18/10/18
                      $dtl['old_status'] =  $dtl_old_status ;
 
                    if ($dtlid->status <> $dtl['status']) 
                        {
                            $dtl['status_change_date']       =  $cdt;
                            $dtl['updated_by']    =  (int)$userid ;
                        }
                       // dd($dtl);
                    $dtlid->update($dtl);  //update  order dtl

                             //  timer logic
                if ($dtlid->status == 'Alloted'  || $dtlid->status == 'Rev-Alloted' || $dtlid->status == 'Ch-Alloted' )
 {
     $project_id=1;
     $teamleader ='';

     $alloted = DB::table('user_allocation_log')->where('order_id' ,'=', $dtlid->order_id)->wherein('status', ['Alloted','Rev-Alloted', 'Ch-Alloted'])->select('username')->orderBy('id', 'desc')->first();
              
              if (!empty($alloted)){
                 $teamleader =  $alloted->username;
            }
            else{
                 $teamleader=Auth::user()->name;
            }


          
                       $tmp = array();
                      // $tmp =  array( 'name' => $dtlid->file_name,
                            //        'order_id' => $dtlid->order_id,
                             //       'order_dtl_id' =>  $dtlid->id,
                             //       'status'  =>  $dtlid->status,
                             //       'allocated_by' => $teamleader,
                              //      'user_id' => $alloc_id );

                      // dd($tmp);

       // $timer = Project::mine()->findOrFail($project_id)
                             //   ->timers()
                            //    ->Create($tmp);

                $separated = explode(',', $alloc_id);

                       foreach ($separated as  $value) {
                            if ($value <> '0') {
                         $tmp =  array( 'name' => $dtlid->file_name,
                                    'order_id' => $dtlid->order_id,
                                    'order_dtl_id' =>  $dtlid->id,
                                    'status'  =>  $dtlid->status,
                                    'allocated_by' => $teamleader,
                                    'user_id' => $value,
                                    'started_at' => new Carbon );


                               $timer = Project::mine()->findOrFail($project_id)
                                ->timers()
                                ->Create($tmp);
                         }

                       }

 }

     if($dtlid->status == 'Rev-QC Pending' || $dtlid->status == 'Ch-QC Pending'|| $dtlid->status == 'QC Pending' )     

             {
                   

                   DB::table('timers')->where('order_id','=', $dtlid->order_id)->where('order_dtl_id', '=', $dtlid->id)->update(['stopped_at' => new Carbon]);

             }

 // timer logic





                      $alloc_log['user_id'] = Auth::user()->id ;
                            $alloc_log['username'] = Auth::user()->name ;
                            $alloc_log['order_id'] = $Order->order_id;
                            $alloc_log['order_master_id'] = $Order->id ;
                            $alloc_log['order_dtls_id'] = $child_id ;
                            $alloc_log['status'] =$input_dtls['status'][$i] ;
                            $alloc_log['alloc_person_id'] = $input_dtls['alloc_id'][$i];
                            $alloc_log['alloc_person'] = $input_dtls['allocation'][$i];

                          UserAllocationLog::create($alloc_log); 

                }
                else {
                       $dtl['created_by']    =  (int)$userid ; 
                       $dtl['status_change_date']       =  $cdt;
                       $dtl['old_status']  = '' ;
                       $child_id = OrderDtl::create($dtl)->id;

                       $alloc_log['user_id'] = Auth::user()->id ;
                            $alloc_log['username'] = Auth::user()->name ;
                            $alloc_log['order_id'] = $Order->order_id;
                            $alloc_log['order_master_id'] = $Order->id ;
                            $alloc_log['order_dtls_id'] = $child_id ;
                            $alloc_log['status'] =$input_dtls['status'][$i] ;
                            $alloc_log['alloc_person_id'] =  $alloc_id ;
                            $alloc_log['alloc_person'] =  $alloc ;

                         UserAllocationLog::create($alloc_log);
                }

                $dtl['action'] = 'Update Entry ' . 'funct: OrderController@update' ;
                
                $dtl['child_id'] =  $child_id ;  
                $dtl['created_by'] =  Auth::user()->id ;

                orderdtls_history::create($dtl);

                              
                $all_filenames   .=   $input_dtls['file_name'][$i] . ',' ;
                $all_fnotes      .=   $note . ',' ;
                $all_alloc       .=   $alloc . ',';
                $all_allocid     .=   $alloc_id . ',';
                $doc_type         =   $input_dtls['document_type'][$i];
                $target_date      =   $input_dtls['target_completion_time'][$i]; 

                $child_status    .=   $input_dtls['status'][$i] . ',' ;

                if ($status == 'Completed') {
                   $compl_time       =  $cdt ; 
                }
               
        }
         
        $all_filenames   =  substr_replace($all_filenames,"",-1);
        $all_fnotes      =  substr_replace($all_fnotes,"",-1);
        $all_alloc       =  substr_replace($all_alloc,"",-1);
        $all_allocid     =  substr_replace($all_allocid,"",-1); 

           $child_id1 = $Order->id ;

                $child =  DB::table('order_dtls')->where('master_id','=', 
                  $child_id1)->where('deleted_flag','<>','Y')->pluck('status', 'status')->toArray();

                $last_date =  DB::table('order_dtls')->where('master_id','=', 
                  $child_id1)->where('deleted_flag','<>','Y')->max('target_completion_time');

                
              //  dd($last_date);

             //   dd($child);

         $unique_status =  array_unique($child);

               //$f_status = $new_status2 ;
               //dd($unique_status);
               
          $f_status =  implode('', $unique_status);
          
          if ( count($unique_status) == 1 )  
                {
                   $finalstatus = true ;
                   
                }
                else {
                   $finalstatus = false ;
                }

                if ($f_status != 'Completed') {
                   $compl_time = null;
                }
        
                

        if ($finalstatus) {

            $Order=Order::find($id); 
            
            // OLD LOGIC REMOVED ON  11-03-2020 AS NOT ENTRY NOT SAVED IN ACTIVITY LOG
          //   DB::table('orders')->where('id', $id)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type , 'file_count' =>$j, 'allocation' => $all_alloc, 'alloc_id' => $all_allocid, 'child_status' => $child_status,
          //     'target_completion_time' => $last_date ,
          //    'status' => $f_status ,  'old_status' => $Order->status,
          // 'order_completion_time' => $compl_time ]);

            $Order->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type , 'file_count' =>$j, 'allocation' => $all_alloc, 'alloc_id' => $all_allocid, 'child_status' => $child_status,
              'target_completion_time' => $last_date ,
             'status' => $f_status ,  'old_status' => $Order->status,
          'order_completion_time' => $compl_time ]);

                     
            DB::table('user_logs')->where('id', $logid)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type , 'target_completion_time' => $target_date , 'file_count' =>$j,
             'status' => $f_status , 'allocation' => $all_alloc, 'old_status' => $Order->status,
          'order_completion_time' => $compl_time ]);
        }

        else {
                  
                 // $f_status  =  $new_status2 ;



                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                  elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                
                  else{
                          
                         // dd($child);

                  $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                  //dd($min_status_id);

                  if ($min_status_id > 0) {
                      $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {



                      $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                     // dd($min_status_id);

                      if ($min_status_id > 0) {
                             $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {
                             

                             $min_status_id  = DB::table('order_status')->wherein('status', $child)->whereNotIn('id', ['10','11','12','13','14', '15'])->min('id');

                           // dd($min_status_id);

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                  } //  inner else condition


                  } // Main else condition

                  

               // dd($f_status);

            $Order=Order::find($id);       

            $Order->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type ,   'target_completion_time'
             => $last_date ,   'allocation'=>$all_alloc , 'alloc_id'=>$all_allocid, 'status' => 
              $f_status ,   'child_status' => $child_status, 'old_status' => $Order->status,
              'file_count' =>$j ]);

             // remove below code and added above on 11/03/2020
            // DB::table('orders')->where('id', $id)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type ,   'target_completion_time'
            //  => $last_date ,   'allocation'=>$all_alloc , 'alloc_id'=>$all_allocid, 'status' => 
            //   $f_status ,   'child_status' => $child_status, 'old_status' => $Order->status,
            //   'file_count' =>$j ]);

            
            DB::table('user_logs')->where('id', $logid)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type ,  'target_completion_time' =>
             $last_date ,  'allocation'=>$all_alloc , 'old_status' => $Order->status,
             'file_count' =>$j,  'alloc_id' => $all_allocid,
             'status' =>   $f_status ,   'child_status' => $child_status,  'alloc_id'=>$alloc_id ]);
        }

        // User Log  insert as on 27-12-19

          // $alloc_all  =  DB::table('order_dtls')->select('allocation', 'alloc_id')->where('master_id','=',  $dtlid->master_id)->get()->toArray();

          //   $allocation = '';
          //   $allocationid = '';
          //   foreach ($alloc_all as $key => $value) {
          //         $allocation  .=  $value->allocation . ',' ;
          //         $allocationid .=  $value->alloc_id .  ',' ;
          //   }

          //   $id = (int)$dtlid->master_id;

          //   DB::table('orders')->where('id' ,'=', $id )->update(['allocation' => $allocation, 'alloc_id' => $allocationid]) ;



             $userlogs = Order::where('id', $id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $ip_address = $_SERVER['REMOTE_ADDR'] ;
                      
                      $log['ip_address'] = $ip_address ;   
                      $log['created_nm'] ='';
                      $log['updated_nm'] = Auth::user()->name ;

                      Userlog::create($log); 


                if (  $input['file_type'] == "Digitizing"  && $input['file_price'] == 0  )    {
                        $result = DB::select('CALL ord_updation(?)', array($id));  
                }

                

        // User Log  insert as on 27-12-19

        //overall changes applied on 19/10/18

         $person_array =  array(
        'person_id'    =>   Auth::user()->id,
        'person_name'  =>   Auth::user()->name ,
        'columns_modified'  =>  $what_changed ,
        'model_used'    =>   "orders table updated" ,
        'program_no'    =>  "OrderController.php" ,
        'url_direct'    =>   url()->current() ,
        'what_modify' =>   $what_changed . ' '. $what_changed2,
        'admin_remarks' =>   '',
        'trans_id' =>  $id ,
        'trans_child_id' =>  0

           );

         // PersonLog::create($person_array);


        // overall changes applied on 19/10/18
         if ($request->has('btnSubmit'))  {
           return redirect()->back();
       }
       else{
              return redirect()->action('OrderController@index', ['newid'=>$id])->with('success','Order updated successfully');
       }

        

   } catch (\Exception $e) { 
          //dd("error" . $e);
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Errors in Saving, Contact IT Department' );
          DB::rollBack();
        
          return redirect()->back()->withErrors(['errors' =>  $e->getLine() . ' ' . $e->getMessage()]); 
        
      }


    });

    return $result;   


}



public function  delete_child(Request $request)
{
  //dd($request->all());
  //dd($childid);
  $childid = $request->childid ;
  //dd($childid);

//  $deletedrows =  DB::table('order_dtls')->where('id', '=', $childid)->update(['deleted_flag' =>'Y']);

  // dd($deletedrows);

   $dtlid =  OrderDtl::find($childid);

   $deletedrows = $dtlid->update(['deleted_flag' =>'Y']);
   $details1 = $dtlid -> toArray();
                     foreach ($details1 as $key => $value) {
                                 // dd($key);
                                   $detail[$key] = $value ;   
                            }
   
                $detail['child_id']= $dtlid->id ;
                $detail['created_by'] =  Auth::user()->id ;
                $detail['action'] = 'Delete Dtl Entry ' . 'funct: OrderController@delete_child' ;

              $master_id =  $dtlid->master_id ;
                orderdtls_history::create($detail);

              // LOGIC TO UPDATE HEADER STATUS AS ON  18-12-19
                   $child_id1 = $childid ;

                $child =  DB::table('order_dtls')->where('master_id','=', 
                  $master_id)->where('deleted_flag','<>','Y')->pluck('status', 'status')->toArray();

                $last_date =  DB::table('order_dtls')->where('master_id','=', 
                  $master_id)->where('deleted_flag','<>','Y')->max('target_completion_time');

                
              //  dd($last_date);

              //  dd($child);

         $unique_status =  array_unique($child);

               //$f_status = $new_status2 ;
               //dd($unique_status);
               
          $f_status =  implode('', $unique_status);
          
          if ( count($unique_status) == 1 )  
                {
                   $finalstatus = true ;
                   
                }
                else {
                   $finalstatus = false ;
                }

                if ($f_status != 'Completed') {
                   $compl_time = null;
                }
        
              $Order =  Order::find($master_id);

              $count =  $Order->file_count ;
              $count = $count -1 ;

               

        if ($finalstatus) {
              $Order->update(['file_count' => $count, 'status' => $f_status]);  
                      
            
        }

        else {
                  
                 // $f_status  =  $new_status2 ;

                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                  elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                
                  else{
                          
                         // dd($child);

                  $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                  //dd($min_status_id);

                  if ($min_status_id > 0) {
                      $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {



                      $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                     // dd($min_status_id);

                      if ($min_status_id > 0) {
                             $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                  } //  inner else condition
                         

                  } 

                 // LOGIC TO UPDATE HEADER STATUS  AS ON 18-12-19
              $Order->update(['file_count' => $count, 'status' => $f_status]); 

             }  // Main else condition

            


  $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully',
                  );
  

  return response()->json([$response]);
}


public function updatedtl(Request $request)
{


if(!isset($request->orddtls["chkid"]) && $request->allocshow =='yes'){
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Not a Single Record Selected' );
          //DB::rollBack();
          // dd("hello");
        
          return redirect()->back()->withErrors(["errors" => "Sorry, Wrong selection,checkbox not selected ,  Click to remove error message"]); 
  }   


  $userid = Auth::user()->id;
  $ip_address = $_SERVER['REMOTE_ADDR'] ;

  //$allvalues = $request->orddtls["status"];

  $input = $request->all();

  $input_dtls   = $input['orddtls'];
  //dd($input_dtls);
  //dd($input_dtls['childid']);

  //dd($input_dtls);

  $alloc_log = array(); 

  $new_status2 =  $request->fstatus ;

  $cdt =  Carbon::now('Asia/Kolkata');

  $cdt =  date_format($cdt, 'Y-m-d H:i:s');

  $us_time = Carbon::now('America/New_York');
  
  $us_time =  date_format($us_time, 'Y-m-d H:i:s');

  //dd($new_status2)       ;
 
     if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12) 
                {
                  
                    if ($new_status1  !== 'QC Pending') {
                       
                     Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'You are Not Authorised' );
                //DB::rollBack();
                // dd("hello");
        
                return redirect()->back()->withErrors(["errors" => "Unauthorized Action"]);
                     }
                

                }

  if( ($input['allocationf'][0] == 'not allocated') && ($request->allocshow =='yes'))
  {
  
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Allocation is Blank' );
          //DB::rollBack();
          // dd("hello");
        
          return redirect()->back()->withErrors(["errors" => "Allocation is not Selected"]); 

  
  }

  if( !isset($input['fstatus']) && ($request->statusshow =='yes'))
  {
  
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Status not selected' );
          //DB::rollBack();
          // dd("hello");
        
          return redirect()->back()->withErrors(["errors" => "Status not selected"]); 
  }
       if(isset($input['fstatus'])){
        if ($input['fstatus'] == 'QC OK') {

            if (Auth::user()->hasPermission('do.qc.ok'))  {
                     
                      $response = array(
                                   'status' => 'SUCCESS',
                                    'msg' => 'QC OK Successfully changed'
                                  );
                     }
                     else {
               $response = array(
                    'status' => 'Error',
                     'msg' => 'No permission for QC OK'

                  );
                DB::rollBack();
                  Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'No permission for QC OK' );
            
                     return redirect()->back()->withErrors(['errors' => 'No permission for QC OK'])->withInput(); 
           }
         }

          
  }  


  //    if( isset($input['fstatus']) && (!isset($request->statusshow)))
  // {
  
  //         Session::flash('alert-warning', 'warning');
  //         Session::flash('flash_message1', 'Status not selected' );
  //         //DB::rollBack();
  //         // dd("hello");
        
  //         return redirect()->back()->withErrors(["errors" => "Status not selected"]); 
  // }


    
   if( !(isset($request->orddtls["chkid"][0])) )
  {
  
          Session::flash('alert-warning', 'warning');
          Session::flash('flash_message1', 'Not a Single Record Selected' );
          //DB::rollBack();
          // dd("hello");
        
          return redirect()->back()->withErrors(["errors" => "Sorry, Wrong selection,checkbox not selected ,  Click to remove error message"]); 
  }

  
  //dd(count(array_unique($allvalues)));
   if (Auth::user()->level()< 20)
  {
    if (isset($request->statusshow)) {


     if ($new_status2  == 'Completed' || $new_status2  == 'Rev-Completed' || 
      $new_status2  == 'Ch-Completed')
      {
               

                 // $response = array(
                 //    'status' => 'Error','status2' => $status2,
                 //    'msg' => 'You are Not Authorised'

                 //  );
               //return response()->json([$response]);
                Session::flash('alert-warning', 'warning');
                Session::flash('flash_message1', 'You are Not Authorised' );
                //DB::rollBack();
                // dd("hello");
        
                return redirect()->back()->withErrors(["errors" => "Unauthorized Action"]);  


           }   
      }      
  }



       
        //http_response_code(500);
       // dd($input);
        $allocf='';
        $allocf_id = '';
        if(isset($input['allocshow'])) {
          if($input['allocshow'] =='yes') {
                    if(isset($input['allocationf'])) {
                        if(count($input['allocationf']) > 0) {
                            $allocf  =  join(',' , $input['allocationf']) ;
                        } 
                    }   
                    
                    if(isset($input['allocationf_id'])) {
                        if(count($input['allocationf_id']) > 0) {
                            $allocf_id  =  join(',' , $input['allocationf_id']) ;
                        } 
                    }   
          }
        }


        //  only allocation updation
    $j =   count($input_dtls['document_type']);  

    // direct assign added as on 07-01-2020
    //dd($request->orddtls["chkid"][0]);

     if (isset($request->orddtls["chkid"][0]) &&  $request->allocshow <> 'yes' && 
       (!isset($request->statusshow)) ) 
     {
 
   
     for($i=0;  $i <$j; $i++)
      {    
                //dd($input_dtls['allocation1']);
                $alloc="";
                $alloc_id = "";
                if (isset($input_dtls['allocation'][$i])) {
                    $alloc =  $input_dtls['allocation'][$i];
                    $alloc_id = $input_dtls['alloc_id'][$i];
                  }
                else  {
                    $alloc    = ' ';
                    $alloc_id = ' ';
                }  
                
                //dd($alloc);

                // if (is_array($input_dtls['status'][$i]))    
                // {
                //    $status = implode(" ", $input_dtls['status'][$i]) ;
                // }
                // // else {
                    // $status =  $input_dtls['status'][$i];
                    //$status =  $input_dtls['status'][$i];
                // }   

                $status =  $input_dtls['status'][$i];
                $dtl['status'] = $input_dtls['status'][$i] ;

                   if ( $status == 'QC OK') {
            if (Auth::user()->hasPermission('do.qc.ok'))  {
                     
                      $response = array(
                                   'status' => 'SUCCESS',
                                   'status' => $status,
                                    'msg' => 'QC OK Successfully changed'
                                  );
                     }
                     else {
               $response = array(
                    'status' => 'Error',
                    'status2' => $status,
                    'msg' => 'No permission for QC OK'

                  );
                DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'No permission for QC OK'])->withInput(); 
           }

          
       }   



                    // not required as already approved below
                    // if( $input_dtls['status'][$i] == 'Approved' )  { 
                    //           $approval_time = $cdt ;
                    // }
                    
                   // dd($input_dtls['status']);
                     if( ($input_dtls['status'][$i] == 'Approved') && ($alloc <>'not allocated'))   { 
                             $dtl['status'] = 'Alloted' ;
                            // dd($dtl['status']);
                             $status = 'Alloted';
                    }

                    if( ($input_dtls['status'][$i] == 'Revision') && ($alloc <>'not allocated'))   { 
                             $dtl['status'] = 'Rev-Alloted' ;
                            // dd($dtl['status']);
                             $status = 'Rev-Alloted';
                    }


                        if( ($input_dtls['status'][$i] == 'Changes') && ($alloc <>'not allocated'))   { 
                             $dtl['status'] = 'Ch-Alloted' ;
                            // dd($dtl['status']);
                             $status = 'Ch-Alloted';
                    }
                    
                
                              
               
              
                if(isset($input_dtls['chkid']) && ($request->allocshow =='yes')) {
                    if(in_array($input_dtls['childid'][$i] , $input_dtls['chkid']) ) {
                        $dtl['allocation']  =  $allocf;  
                        $dtl['alloc_id']    =  $allocf_id; 
                        $alloc              =  $allocf;
                        $alloc_id            =  $allocf_id;
                        //dd($dtl['alloc_id']);

                    }
                    else {
                       $dtl['allocation']  =  $alloc;  
                       $dtl['alloc_id']  = $alloc_id ;
                    }

                } 
                else {
                    $dtl['allocation']  =  $alloc;  
                    $dtl['alloc_id']  = $alloc_id ;
                }
                  
                //dd($dtl['alloc_id']);
                //dd($dtl['allocation']);
            
                // $dtl['order_id']  =   $ord_id1 ;
                // $dtl['client_creation_id'] = $Order->client_creation_id;
                // $dtl['client_company']     = $Order->client_company ;
                // $dtl['client_note']        = $Order->client_note; 
             //   $dtl['file_name' ]         = $input_dtls['file_name'][$i];
                // $dtl['file_type']          = $input['file_type']; 
                // $dtl['vendor']             = $input['vendor']; 
                // $dtl['digit_rate']         = 0;
                // $dtl['stiches_count']      = $input['stiches_count']; 
                // $dtl['file_price']         = $input['file_price']; 
                // $dtl['vendor_digit_rate']  = 0; 
                // $dtl['vendor_digit_price'] = 0;  
                // $dtl['order_date_time']    = $Order->order_date_time ; 
                // $dtl['order_dt']           = $Order->order_dt ; 
              //  $dtl['target_completion_time']   =  $input_dtls['target_completion_time'][$i]; 
                
               // $dtl['status']                 =  $input_dtls['status'][$i];    
                //dd($input_dtls['status'][$i]);
                //$dtl['document_type']            =  $input_dtls['document_type'][$i];
               
                //$dtl['unit_price']               =  0 ;
                // $dtl['order_us_date']            =  $input['order_us_date'];
                // $dtl['approval_time']            =  $approval_time; 
                // $dtl['status_change_date']       =  $cdt;
                // $dtl['ip_address']               =  $input['ip_address'];  
                // $dtl['company_id']               =  $input['company_id'] ;
                // $dtl['file_count']               =  $input['file_count']; 
 
               

                  //if ( $input_dtls['childid'][$i] == $input_dtls['childid'][$i] ) 
                 if(in_array($input_dtls['childid'][$i] , $input_dtls['chkid']) )     

                {   // dd(($input_dtls['childid'][$i]));
                       // dd($dtl);
                    $dtlid =  OrderDtl::find($input_dtls['childid'][$i]);
                     
                    // if ($dtlid->status <> $dtl['status']) 
                    //     {
                    //         $dtl['status_change_date']       =  $cdt;
                    //         $dtl['updated_by']    =  (int)$userid ;
                                        //     }

                      $dtl['master_id'] =  $dtlid->master_id;
                      $master_id   =   $dtlid->master_id;

                      //
                       // changes for approval blank on multiple order approve from ediddtl

                 $Order=Order::find($master_id);
                  
                  $approval_time =  $Order->approval_time;
                  
                  $approval_us_time =  $Order->approval_us_time;

        $chk_appr_status = 0;

      if( $input_dtls['status'][0] == 'Approved' )  { 
            if(is_null($approval_time)) {
                  $input1['approval_time']  = $cdt ;
                  $input1['approval_us_time'] = $us_time ;
                  $chk_appr_status = 1;
            }
          
      }    

      // changes on 28-08-19 as per kulind sir instruction for updating bill date as approval date
      // CHANGES ON 13/09/19  FOR  ONLY  NEW APPROVED STATUS 

      if ($Order->status != 'Approved') {
          if( $input_dtls['status'][0] == 'Approved' )  { 
                   $input1['bill_dt']  =  $us_time ;
                   $chk_appr_status = 1;
          }
        }

       if($input['old_price'] == null)  {
          $input1['old_price'] =  $input['file_price'];
          $chk_appr_status = 1;
       }
                
      if ($chk_appr_status == 1) {
                 $res1 =  $Order->update($input1);  
      }
      
      
          // changes done for approval blank for mulitple order on order id
   
                      //

                      $dtlid->update($dtl);
                        //  timer logic
                     // dd($dtlid->status);

 if ($dtlid->status == 'Alloted'  || $dtlid->status == 'Rev-Alloted' || $dtlid->status == 'Ch-Alloted' )
 {
     $project_id=1;
     $teamleader ='';

     $alloted = DB::table('user_allocation_log')->where('order_id' ,'=', $dtlid->order_id)->wherein('status', ['Alloted','Rev-Alloted', 'Ch-Alloted'])->select('username')->orderBy('id', 'desc')->first();
              
              if (!empty($alloted)){
                 $teamleader =  $alloted->username;
            }

     // $timer = Project::mine()->findOrFail($project_id)
     //                            ->timers()
     //                            ->save(new Timer([
     //                                'name' => $dtlid->file_name,
     //                                'order_id' => $dtlid->order_id,
     //                                'order_dtl_id' =>  $dtlid->id,
     //                                'status'  =>  $dtlid->status,
     //                                'allocated_by' => $teamleader,
     //                                'user_id' => Auth::user()->id
                                 
     //                            ]));
               $tmp = array();
                 $separated = explode(',', $alloc_id);

                       foreach ($separated as  $value) {
                            if ($value <> '0') {
                         $tmp =  array( 'name' => $dtlid->file_name,
                                    'order_id' => $dtlid->order_id,
                                    'order_dtl_id' =>  $dtlid->id,
                                    'status'  =>  $dtlid->status,
                                    'allocated_by' => $teamleader,
                                    'user_id' => $value,
                                    'started_at' => new Carbon );


                               $timer = Project::mine()->findOrFail($project_id)
                                ->timers()
                                ->Create($tmp);
                         }

                       }



               ////////////////INSERTED ABOVE
                       // $tmp =  array( 'name' => $dtlid->file_name,
                       //              'order_id' => $dtlid->order_id,
                       //              'order_dtl_id' =>  $dtlid->id,
                       //              'status'  =>  $dtlid->status,
                       //              'allocated_by' => $teamleader,
                       //              'user_id' => $alloc_id );


                        // $timer = Project::mine()->findOrFail($project_id)
                        //         ->timers()
                        //         ->Create($tmp);
                       //  REMOVED ABOVE CODE ON 01-01-21 by prashant
                      // dd($tmp);
                       
    


      if($dtlid->status == 'Rev-QC Pending' || $dtlid->status == 'Ch-QC Pending'|| $dtlid->status == 'QC Pending' )     

             {
                   

                   DB::table('timers')->where('order_id','=', $dtlid->order_id)->where('order_dtl_id', '=', $dtlid->id)->update(['stopped_at' => new Carbon]);

             }                           

 }

 // timer logic

                       $alloc_log['user_id'] = Auth::user()->id ;
                            $alloc_log['username'] = Auth::user()->name ;
                            $alloc_log['order_id'] = $dtlid->order_id;
                            $alloc_log['order_master_id'] =  $master_id  ;
                            $alloc_log['order_dtls_id'] =$input_dtls['childid'][$i];
                            $alloc_log['status'] =$input_dtls['status'][$i] ;
                            $alloc_log['alloc_person_id'] = $input_dtls['alloc_id'][$i];
                            $alloc_log['alloc_person'] = $input_dtls['allocation'][$i];

                          UserAllocationLog::create($alloc_log); 
                           //dd($alloc_log);
                        $details1 = $dtlid->toArray();
                     foreach ($details1 as $key => $value) {
                                 // dd($key);
                                   $detail[$key] = $value ;   
                            }
               

                $detail['child_id']= $dtlid->id ;
                $detail['created_by'] =  Auth::user()->id ;
                $detail['updated_by'] =   Auth::user()->id ;
                $detail['action'] = 'Update Dtl Entry ' . 'funct: OrderController@updatedtl' ;

                orderdtls_history::create($detail);    

                }
                // else {
                //        $dtl['created_by']    =  (int)$userid ; 
                //        $dtl['status_change_date']       =  $cdt;
                //        orderdtls::create($dtl);
                // }

               
                //$dtl['child_id'] = $dtlid->id ;
              

               

        }

         //  added update orders table on 07-01-2020
         $alloc_all  =  DB::table('order_dtls')->select('allocation', 'alloc_id')->where('master_id','=',  $dtlid->master_id)->get()->toArray();

            $allocation = '';
            $allocationid = '';
            foreach ($alloc_all as $key => $value) {
                  $allocation  .=  $value->allocation . ',' ;
                  $allocationid .=  $value->alloc_id .  ',' ;
            }

            $id = (int)$dtlid->master_id;

            $Order = Order::find($id);
          
            $new_status2 =  $Order->status ;

        

          //// added this code for priority status

          $f_status  = $new_status2 ;
                    $child =  DB::table('order_dtls')->where('master_id','=', 
                  $master_id)->where('deleted_flag','=','N')->pluck('status', 'status')->toArray();

    

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );

        //  dd($child);

                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                   elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                  else{

                    $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                     //dd($min_status_id);

                    if ($min_status_id > 0) {
                       $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {


                      $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                      if ($min_status_id > 0) {
                      $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                 
               }   // inner else condition
               

                   $child =  DB::table('order_dtls')->where('master_id','=', 
                  $master_id)->where('deleted_flag','=','N')->pluck('status', 'status')->toArray();

                // $last_date =  DB::table('order_dtls')->where('master_id','=', 
                //   $child_id1)->max('target_completion_time');
                
              //  dd($last_date);

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );
                  
               
                $Order = Order::find($id);

             //    UPDATE 11-03-2020  FOR ACTIVITY LOG
             //    DB::table('orders')->where('id', $id)->update([ 'status' => $f_status ,   'child_status' => $childstatus, 'allocation' => $allocation, 'alloc_id' => $allocationid,
             // 'old_status' => $Order->status   ]);

                $Order->update([ 'status' => $f_status ,   'child_status' => $childstatus, 'allocation' => $allocation, 'alloc_id' => $allocationid,
             'old_status' => $Order->status   ]);

                      

             $userlogs = Order::where('id', $id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $ip_address = $_SERVER['REMOTE_ADDR'] ;
                      
                      $log['ip_address'] = $ip_address ;   
                      $log['created_nm'] ='';
                      $log['updated_nm'] = Auth::user()->name ;

                      Userlog::create($log); 
          


          //  get  total count and status id            
            

           return redirect()->action('OrderController@index', ['newid'=>$dtlid->master_id])->with('success','Order updated successfully');
          }
   } 



    // direct assign added as on 07-01-2020

    if  ($request->allocshow =='yes')  {
            
        foreach ($input_dtls['chkid'] as $key => $valueid) {
          
          //dd($valueid);
          
        if  (count($input['allocationf']) > 0) {
            for($i=0; $i< $j; $i++) {

              if( $valueid == $input_dtls['childid'][$i] )
                 {

                        $dtl['allocation']  =  $allocf;  
                        $dtl['alloc_id']    =  $allocf_id; 
                        $alloc              =  $allocf;
                        $alloc_id           =  $allocf_id;



                        $dtlid =  OrderDtl::find($input_dtls['childid'][$i]);

                        $dtlid->update(['allocation' => '', 'alloc_id' => '']);

                        if( ($input_dtls['status'][$i] == 'Approved') && ($alloc <>'not allocated'))  
                        { 
                             $dtl['status'] = 'Alloted' ;
                            // dd($dtl['status']);
                             $status = 'Alloted';
                              $dtlid->update(['allocation' =>  $allocf, 'alloc_id' => $alloc_id,
                                'status' => $status ]);
                        }
                        else
                        {

                           $dtlid->update(['allocation' =>  $allocf, 'alloc_id' => $alloc_id]);
                        }
                       // dd($dtl['alloc_id']);

                       

                          
                     
                          $dtlid->update(['allocation' =>  $allocf, 'alloc_id' => $alloc_id]);
                          
                          $array2 = DB::table('order_dtls')->where('id', '=', $valueid)->get()->toArray();  
                      
                         

                           foreach ($array2 as  $userlog) {
                                  # code...
                                    foreach ($userlog as $key => $value) {
                                        $array3[$key] = $value;
                                      }
                              }  

                          // dd($array3);
                          $array3['updated_by'] = Auth::user()->id;
                          $array3['child_id']= $array3['id'] ;
                          $array3['action'] = 'Update Dtl Entry ' . 'funct: OrderController@updatedtl' ;    
                 
                          orderdtls_history::create($array3);

                            $alloc_log['user_id'] = Auth::user()->id ;
                            $alloc_log['username'] = Auth::user()->name ;
                            $alloc_log['order_id'] = $dtlid->order_id;
                            $alloc_log['order_master_id'] = $dtlid->master_id ;
                            $alloc_log['order_dtls_id'] = $dtlid->id ;
                            $alloc_log['status'] = $dtlid->status ;
                            $alloc_log['alloc_person_id'] =  $alloc_id ;
                            $alloc_log['alloc_person'] =  $allocf ;

                        UserAllocationLog::create($alloc_log);  

                }      //  if  checked id matches
                
                
                              
            } // Loops end here




        } //  if allocation  exist
           }  // if valueid checked  $input_dtls['chkid']
          
            $alloc_all  =  DB::table('order_dtls')->select('allocation', 'alloc_id')->where('master_id','=',  $dtlid->master_id)->get()->toArray();

            $allocation = '';
            $allocationid = '';
            foreach ($alloc_all as $key => $value) {
                  $allocation  .=  $value->allocation . ',' ;
                  $allocationid .=  $value->alloc_id .  ',' ;
            }

            $id = (int)$dtlid->master_id;
            // inserted for global effect on 07-01-20

               $Order = Order::find($id);
          
            $new_status2 =  $Order->status ;

        

          //// added this code for priority status

          $f_status  = $new_status2 ;
                    $child =  DB::table('order_dtls')->where('master_id','=', 
                  $id)->where('deleted_flag','=','N')->pluck('status', 'status')->toArray();

    

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );

        //  dd($child);

                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                   elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                  else{

                    $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                     //dd($min_status_id);

                    if ($min_status_id > 0) {
                       $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {


                      $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                      if ($min_status_id > 0) {
                      $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                 
               }   // inner else condition
               
                $child =  DB::table('order_dtls')->where('master_id','=', $id)->where('deleted_flag','=','N')->pluck('status', 'status')->toArray();

                // $last_date =  DB::table('order_dtls')->where('master_id','=', 
                //   $child_id1)->max('target_completion_time');
                
              //  dd($last_date);

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );
                  
                //  removed and added below logic for activity log entry 11-03-2020
                
             //    DB::table('orders')->where('id', $id)->update([ 'status' => $f_status ,   'child_status' => $childstatus, 'allocation' => $allocation, 'alloc_id' => $allocationid,
             // 'old_status' => $Order->status   ]);

                $Order = Order::find($id);

                $Order->update([ 'status' => $f_status ,   'child_status' => $childstatus, 'allocation' => $allocation, 'alloc_id' => $allocationid,
             'old_status' => $Order->status ]);
            
            // inserted for global effect on 07-01-20

            //DB::table('orders')->where('id' ,'=', $id )->update(['allocation' => $allocation, 'alloc_id' => $allocationid]) ;

             $userlogs = Order::where('id', $id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $ip_address = $_SERVER['REMOTE_ADDR'] ;
                      
                      $log['ip_address'] = $ip_address ;   
                      $log['created_nm'] ='';
                      $log['updated_nm'] = Auth::user()->name ;

                      Userlog::create($log); 


            

           return redirect()->action('OrderController@index', ['newid'=>$dtlid->master_id])->with('success','Order updated successfully');

  
          }

   } // if allocshow  is yes
    

         // only allocation updation           

       // dd($allocf . $allocf_id);

  //$chkid  =  $request->orddtls['chkid'];
  // dd($chkid);

  
  $cdt =  Carbon::now('Asia/Kolkata');

  $cdt =  date_format($cdt, 'Y-m-d H:i:s');

  $us_time = Carbon::now('America/New_York');
  
  $us_time =  date_format($us_time, 'Y-m-d H:i:s');

 
  $alloc_log = array();
                   
 

 

  $j =   count($input_dtls['document_type']);  

   
  foreach ($input_dtls['chkid'] as $key => $valueid) {
       
          //dd($valueid);

          for($i=0; $i< $j; $i++) 
          {

              if( $valueid == $input_dtls['childid'][$i] )
              {
                //  dd($valueid . $input_dtls['childid'][$i] );
                // allocation logic added on 06/12/19

                 if( $request->has('fstatus')) {  
                   if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'QC Pending' ||  $new_status2 == 'QC OK'
                        ||  $new_status2 == 'Alloted' ||  $new_status2 == 'Completed'))
                  {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                 }

                  if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'QC Pending' ||  $new_status2 == 'QC OK'
                        ||  $new_status2 == 'Alloted' ||  $new_status2 == 'Completed'))
                  {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                 }

                  if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'Ch-QC Pending' ||  $new_status2 == 'Ch-QC OK'
                        ||  $new_status2 == 'Ch-Alloted' ||  $new_status2 == 'Completed'))
                  {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                 }

                 // new check added above on 02-12-19
 
                  if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'Ch-QC Pending' ||  $new_status2 == 'Ch-QC OK'
                        ||  $new_status2 == 'Ch-Alloted' ||  $new_status2 == 'Ch-Completed'))
                  {
                       DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                  }
                 
                  if ( in_array('not allocated', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'Rev-QC Pending' ||  $new_status2 == 'Rev-QC OK'
                        ||  $new_status2 == 'Rev-Alloted' ||  $new_status2 == 'Completed'))
                  {
                     DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                  }

                  if ( in_array('0', explode(",", $input_dtls['allocation'][$i])) &&
                   (  $new_status2 == 'Rev-QC Pending' ||  $new_status2 == 'Rev-QC OK'
                        || $new_status2  == 'Rev-Alloted' || $new_status2  == 'Rev-Completed'))
                  {
                       DB::rollBack();
            
                     return redirect()->back()->withErrors(['errors' => 'Blank Allocation, Please Allocate files']); 
                  }
                
                 // new check added above on 02-12-19

                 //   if (   $input_dtls['status'][$i]  == 'Changes' ||
                 //        $input_dtls['status'][$i] == 'Revision' )
                 //  {
                 //     DB::rollBack();
            
                 //     return redirect()->back()->withErrors(['errors' => 'Revision not allowed']); 
                 // }
               }
                // allocation logic added on 06/12/19

                //  allocation check on new status assign on 06/12/19

               

          }  // if matches $valueid == $input_dtls['childid'][$i] 
         
     }  // for i loop
  }    // for all checked values



    //  Now insert into  database after validation

    foreach ($input_dtls['chkid'] as $key => $valueid)
    {
          
         // dd($new_status2 . $valueid);

          $orderid=OrderDtl::find($valueid);  

           //  MAIN ORDER FILE DETAILS

          $master_id = $orderid->master_id ;

          $Order=Order::find($master_id);

          $id =  $Order->id ;
           

          $allocation    =  $orderid->allocation ;
          $alloc_id      =  $orderid->alloc_id ;
         // dd($allocation);
          $filetype      =  $orderid->file_type ;
          $oldstatus     =  $orderid->status ;
          $stiches_count =  $orderid->stiches_count;
          $emptyalloc  =    strpos($allocation, '0');
          $new_date = '';

          $alloc_log['user_id'] = Auth::user()->id ;
          $alloc_log['username'] = Auth::user()->name ;
          $alloc_log['order_id'] = $orderid->order_id;
          $alloc_log['order_master_id'] = $master_id ;
          $alloc_log['order_dtls_id'] = $orderid->id ;
          $alloc_log['status'] = $new_status2 ;
          $alloc_log['alloc_person_id'] =  $alloc_id ;
          $alloc_log['alloc_person'] =  $allocation ;
          //dd($alloc_log);
                      
                      

  // MAIN ORDER FILE DETAILS

       if ($request->has('fstatus')) {
    
           $new_status2 =  $request->fstatus;


          for($i=0; $i< $j; $i++) {

              if( $valueid == $input_dtls['childid'][$i] )
                {
           
                  switch($new_status2)
                  {
           
                  case 'Approved' :
                  $time_original = $cdt ;

                  if ($orderid->document_type == "Rush") {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHours(3)->toDateTimeString();
                  }
                  elseif ($orderid->document_type  == "SuperRush")
                  {
                          $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHour()->addMinutes(30)->toDateTimeString();
                  }
                  else {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addDay()->toDateTimeString();
                        }    
                      // $Order->update( [
                      //               'status' =>  $new_status2,
                      //                'old_status' => $oldstatus,
                      //               'approval_time' => $cdt ,
                      //               'approval_us_time' => $us_time ,
                      //               'bill_dt' => $us_time,
                      //               'target_completion_time' => $new_date,
                      //                 'updated_by' => $userid,
                      //                 'ip_address' => $ip_address,
                      //                 'status_change_date' => $cdt
                      //                   ]);
                       
                     // dd($new_date); 

                    //  Removed below code for  activity log
                    // DB::table('order_dtls')->where('master_id', $master_id)->where('id', $valueid)->update(['status' => $new_status2,  'old_status' => $oldstatus,'approval_time' => $cdt, 'approval_us_time' => $us_time]);
                    
                    OrderDtl::where('master_id', $master_id)->where('id', $valueid)->update(['status' => $new_status2,  'old_status' => $oldstatus,'approval_time' => $cdt, 'approval_us_time' => $us_time]); 


                     
                    $array2 = DB::table('order_dtls')->where('master_id', $master_id)->where('id', $valueid)->get()->toArray();  
                      
                     
                            foreach ($array2  as $userlog) {
                                 foreach ($userlog  as $key => $value) {
                                  $array3[$key] = $value;
                                }
                            } 
                            
                      $array3['created_by'] = Auth::user()->id;
                      $array3['child_id']= $array3['id'] ;
                       $array3['action'] = 'Update Dtl Entry ' . 'funct: OrderController@updatedtl' ;

                      orderdtls_history::create($array3);

                      // $userlogs = Order::where('id', $Order->id)->get()->toArray();

                      // foreach ($userlogs as  $userlog) {
                      //      foreach ($userlog as $key => $value) {
                      //              $log[$key] = $value ;   
                      //       }
                      // }
                      // $log['ip_address'] = $ip_address ;   
                      // $log['created_nm'] ='';
                      // $log['updated_nm'] = Auth::user()->name ;

                      // Userlog::create($log); 
                      

                      
                     UserAllocationLog::create($alloc_log);   
                      break;

                      // approved condition
                   case "Alloted"  :
                     $getorderdtailalloteds=OrderDtl::where('master_id', $master_id)->where('id', $valueid)->pluck('id');

                      foreach ($getorderdtailalloteds as $getorderdtailalloted) {
                        # code...
                      }
                      $chngedeallotedstatusobj=OrderDtl::findOrFail($getorderdtailalloted);
                      $chngedeallotedstatusobj->update(['status' => $new_status2, 
                         'old_status' => $oldstatus  ]);

                       // DB::table('order_dtls')->where('master_id', $master_id)->where('id',
                       //  $valueid)->update(['status' => $new_status2, 
                       //   'old_status' => $oldstatus  ]); 

                      $array2 = DB::table('order_dtls')->where('master_id', $master_id)->where('id', $valueid)->get()->toArray();

                     
                      foreach ($array2 as  $userlog) {
                            foreach ($userlog as $key => $value) {
                                        $array3[$key] = $value;
                                      }
                      }  

                        
                     $array3['child_id']= $array3['id'] ;
                     $array3['created_by'] = Auth::user()->id;
                     $array3['action'] = 'Update Dtl Entry ' . 'funct: OrderController@updatedtl' ;

                     orderdtls_history::create($array3);

                      //orderdtls_history::create($array2);

                      // $userlogs = Order::where('id', $Order->id)->get()->toArray();

                      // foreach ($userlogs as  $userlog) {
                      //      foreach ($userlog as $key => $value) {
                      //              $log[$key] = $value ;   
                      //       }
                      // }
                      // $log['ip_address'] = $ip_address ;   
                      // $log['created_nm'] ='';
                      // $log['updated_nm'] = Auth::user()->name ;

                      // Userlog::create($log); 
                      
                      
                      UserAllocationLog::create($alloc_log); 
                      break;

                    default:
                      // dd("Your favorite color is neither red, blue, nor green!");  
                      $getorderdtaildefalts=OrderDtl::where('master_id', $master_id)->where('id', $valueid)->pluck('id');

                      foreach ($getorderdtaildefalts as $getorderdtaildefaltid) {
                        # code...
                      }
                       
                      $chngedefaltstatsuobj=OrderDtl::findOrFail($getorderdtaildefaltid);
                      $chngedefaltstatsuobj->update(['status' => $new_status2,  'old_status' => $oldstatus]);

                       // DB::table('order_dtls')->where('master_id', $master_id)->where('id', $valueid)->update(['status' => $new_status2,  'old_status' => $oldstatus]);
     

                      $array2 = DB::table('order_dtls')->where('master_id', $master_id)->where('id', $valueid)->get()->toArray();

                      
                      foreach ($array2 as  $userlog) {
                            foreach ($userlog as $key => $value) {
                                        $array3[$key] = $value;
                                      }
                      }  
                      //dd($array3);

                    $array3['created_by'] =  Auth::user()->id ;  
                    $array3['child_id']= $array3['id'] ;
                    $array3['action'] = 'Update Dtl Entry ' . 'funct: OrderController@updatedtl' ;

                     //dd($array3);

                     orderdtls_history::create($array3);    

                        $alloc_log['user_id'] = Auth::user()->id ;
                        $alloc_log['username'] = Auth::user()->name ;
                        $alloc_log['order_id'] = $orderid->order_id;
                        $alloc_log['order_master_id'] = $master_id ;
                        $alloc_log['order_dtls_id'] = $orderid->id ;
                        $alloc_log['status'] = $new_status2 ;
                        $alloc_log['alloc_person_id'] =  $orderid->alloc_id ;
                        $alloc_log['alloc_person'] =  $orderid->allocation ;

                      
                        UserAllocationLog::create($alloc_log);   

                     break;
            
            }  // switch end

          }   // if valueid =  child record


    }      //  loop through  selectd records
  }//if condition added for revision problem

    // find child status -applied on 07-12-19
        // $all_filenames   =  substr_replace($all_filenames,"",-1);
        // $all_fnotes      =  substr_replace($all_fnotes,"",-1);
        // $all_alloc       =  substr_replace($all_alloc,"",-1);
        // $all_allocid     =  substr_replace($all_allocid,"",-1); 

        //    $child_id1 = $Order->id ;
        
         

  // added this code fro priority status
}
             if ($new_status2 == 'Completed') {
                   $compl_time       =  $cdt ; 
                }

                $child =  DB::table('order_dtls')->where('master_id','=', 
                  $master_id)->where('deleted_flag','=','N')->pluck('status', 'status')->toArray();

                // $last_date =  DB::table('order_dtls')->where('master_id','=', 
                //   $child_id1)->max('target_completion_time');
                
              //  dd($last_date);

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );
                 
               // dd($childstatus);

                $unique_status =  array_unique($child);
              
          $f_status = $new_status2 ;
          $finalstatus = false ;

                if ( count($unique_status) == 1 )  
                {
                   $finalstatus = true ;
                   $f_status =  $new_status2 ;
                }
                else {
                   $finalstatus = false ;
                }

                if ($f_status != 'Completed') {
                   $compl_time = null;
                }
        
               ///
                   $alloc_all  =  DB::table('order_dtls')->select('allocation', 'alloc_id')->where('master_id','=',  $master_id)->get()->toArray();

            $allocation = '';
            $allocationid = '';
            foreach ($alloc_all as $key => $value) {
                  $allocation  .=  $value->allocation . ',' ;
                  $allocationid .=  $value->alloc_id .  ',' ;
            }

              $id = (int)$master_id;

            // DB::table('orders')->where('id' ,'=', $id )->update(['allocation' => $allocation, 'alloc_id' => $allocationid]) ;

             Order::where('id' ,'=', $id )->update(['allocation' => $allocation, 'alloc_id' => $allocationid]) ;


               ///  

        // if ($finalstatus) {
        //     DB::table('orders')->where('id', $id)->update([ 'child_status' => $childstatus,
        //       'target_completion_time' => $last_date ,
        //      'status' => $f_status ,  'old_status' => $Order->status,
        //   'order_completion_time' => $compl_time ]);
           
        //   //   DB::table('user_logs')->where('id', $logid)->update(['file_name'=> $all_filenames, 'note'=>$all_fnotes ,'document_type' => $doc_type , 'target_completion_time' => $target_date , 'file_count' =>$j,
        //   //    'status' => $f_status , 'allocation' => $all_alloc, 'old_status' => $Order->status,
        //   // 'order_completion_time' => $compl_time ]);
        // }



    // find child status  -07-12-19

    $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('deleted_flag','=','N')->count();

    $orddtlcount_st =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('status', '=', $new_status2 )->where('deleted_flag','=','N')->count();   
       
   //   dd($orddtlcount_st);
          // update if status of order dtl status changes
          if($orddtlcount == $orddtlcount_st) {
                  
                  Order::where('id', $master_id)->update(['status' =>
                                      $new_status2]);
                        //  UserAllocationLog::create($alloc_log); 
              }
    
          else {

            

          //// added this code for priority status

          $f_status  = $new_status2 ;

        //  dd($child);

                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                   elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                  else{

                    $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                     //dd($min_status_id);

                    if ($min_status_id > 0) {
                       $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {


                      $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                      if ($min_status_id > 0) {
                      $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                 
               }   // inner else condition


      } // last else condition changed on 17-12-19
                  
            // dd($f_status);
            
            //if ($new_status2 == 'Approved'  || $f_status == 'Approved') { on 28-01-20 removed as updating bill date 
            if ($new_status2 == 'Approved' ) {
                   $time_original = $cdt ;

                  if ($orderid->document_type == "Rush") {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHours(3)->toDateTimeString();
                  }
                  elseif ($orderid->document_type  == "SuperRush")
                  {
                          $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHour()->addMinutes(30)->toDateTimeString();
                  }
                  else {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addDay()->toDateTimeString();
                        }   

                 $Order->update( [
                                  'status' =>  $new_status2,
                                  'old_status' => $oldstatus,
                                  'approval_time' => $cdt ,
                                  'approval_us_time' => $us_time ,
                                  'bill_dt' => $us_time,
                                 'target_completion_time' => $new_date,
                                  'updated_by' => $userid,
                                  'ip_address' => $ip_address,
                                  'status_change_date' => $cdt
                                        ]);

 
            }else
            {
                 
                    $updatelast=Order::findorfail($id);
                    $updatelast->update([ 'status' => $f_status ,   'child_status' => $childstatus,'old_status' => $Order->status]);


            }

       }

        $userlogs = Order::where('id', $id)->get()->toArray();
         
                  foreach ($userlogs as  $userlog) {
                    # code...
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }

                  $log['created_nm'] ='';
                  $log['updated_nm'] = Auth::user()->name ;
                
                  Userlog::create($log);

        return redirect()->back();
}



    public function updatenotes(Request $request)
    {
           
            // dd($request->all()); die;
           
            // $OrderUpdate=$request->all();
            //  $Order=Order::find($id);
            //  $Order->update($OrderUpdate);
            //   return redirect('orders');
            // $date = new DateTime();
            //echo $date->format('Y-m-d H:i:s');
            $user = Auth::user()->name;

            //$new_note = $request->oldnotes .' <br />'.  $request->newnotes .'<br />User Name : '
            //. $user . '<br />Time : ' . Carbon::now() .' <br />' ;

            $new_note = $request->oldnotes .' <br />'.  $request->newnotes .'<br />';
            
            $userid = Auth::user()->id;
            $ip_address = $_SERVER['REMOTE_ADDR'] ;
                
              

            $orderid=Order::find($request->id);
              //$client->update($clientUpdate);
                 //return redirect('clients');

              // dd($request->client_name);
              if ($request->ajax()) {

                  $orderid->update( [
                  'note' => $new_note, 'updated_by' =>$userid, 'ip_address' => $ip_address]);
                    
                  

                   $person_array =  array(
                      'person_id'    =>   Auth::user()->id,
                      'person_name'  =>   Auth::user()->name ,
                      'columns_modified'  =>  'field note modified' ,
                      'model_used'    =>   "orders table updated" ,
                      'program_no'    =>  "OrderController.php function updatenotes()" ,
                      'url_direct'    =>   url()->current() ,
                       'what_modify' =>    substr($request->newnotes,20),
                       'admin_remarks' =>   '',
                        'trans_id' =>  $orderid->id ,
                        'trans_child_id' =>  0

                   );

                 // PersonLog::create($person_array);

                  
                  $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully',
                  );
                
                  return response()->json([$response]);
            }
              else
            {
                 
                  return view('orders.index');
            }
        }
  

     public function getnotes(Request $request)
     {
       
       $notes = array() ;
      $note =  DB::table('orders')->select('note' ,'file_price', 'old_status', 'client_specific')->where('id','=', $request->id)->get();

      foreach ($note as $key ) {
           
           $notes[] =  $key ;

           //dd($key);
      }
             
          return  response()->json(['notes' =>$notes]);
     }


  public function getdesign(Request $request)
     {
      
      
       $notes = array() ;
       if ($request->has('childid'))  {

          $note =  DB::table('user_allocation_log')->select('username' , 'alloc_person', 'status')->where('order_dtls_id','=', $request->childid)->wherein('status', ['QC Pending', 'QC OK', 'Rev-QC Pending', 'Rev-QC OK', 'Ch-QC Pending', 'Ch-QC OK'])->orderby('id','asc')->get()->toArray();
          
       }
       else {
          $note =  DB::table('user_allocation_log')->select('username' , 'alloc_person', 'status')->where('order_master_id','=', $request->id)->wherein('status', ['QC Pending', 'QC OK', 'Rev-QC Pending', 'Rev-QC OK', 'Ch-QC Pending', 'Ch-QC OK'])->orderby('id','asc')->get()->toArray();

          // dd($note);
       }
       


      foreach ($note as $key ) {
           
            //dd($key->status);
            // if( $key->status == 'QC Pending') {
            //       $notes['designer'] =  $key->alloc_person ;
            // }
            // if( $key->status == 'QC OK') {

                $notes[0] =  $key->username ;
                $notes[1] =  $key->alloc_person ;

            // }
           


           //dd($key);
      }

       if ( count($notes) == 0) {
               $note =  DB::table('user_allocation_log')->select('username' , 'alloc_person', 'status')->where('order_id','=', $request->orderid)->wherein('status', ['QC Pending', 'QC OK', 'Rev-QC Pending', 'Rev-QC OK', 'Ch-QC Pending', 'Ch-QC OK'])->orderby('id','asc')->get()->toArray();

                foreach ($note as $key ) {
       
                    $notes[0] =  $key->username ;
                    $notes[1] =  $key->alloc_person ;

              }
       }
      
             
          return  response()->json([ 'notes' =>$notes]);
     }

//order status  update ajax function added below on 28-05-20

public function updateorderstatus(Request $request)
{
   // dd($request->all());

  $input = $request->all();
  

  $status2 = Order_Status::pluck('status', 'status'); 

  $user = Auth::user()->name;
  $userid = Auth::user()->id;
  $ip_address = $_SERVER['REMOTE_ADDR'] ;

  $new_price = 0;
  if ($request->has('a3')) {
      
      $new_price = $request->a3 ;  
       
  }

  $new_target_date2 = '';
  $old_price = 0 ;

  $new_status2 = $request->status2 ;
  $alloc1 = $request->alloc1;

  //dd($alloc1);

  //dd(in_array('not allocated', explode(",", $alloc1)));

  //dd(in_array('0', explode(",", $alloc1))) ;

  //$pos = strpos($alloc1, '0');

  
  //dd($pos);

 

  $alloc_log = array();

  $new_target_date2 = $request->new_target_date2;

    if ($new_status2 == 'Changes')
  {
   
     $old_price =  $request->old_price; 

  }

  $targettime2 = '';

  if ($new_status2 == 'Revision') {
           if ($request->targettime2 == null || $request->revnotes == null || $request->rev_mistake_reason == null)  {

               $response = array(
                    'status' => 'Error',
                    'status2' => $status2,
                    'msg' => ' Either Notes or Target Time is Required'

                  );
               return response()->json([$response]);
           }
          
  }

   if ($new_status2 == 'QC OK') {
            if (Auth::user()->hasPermission('do.qc.ok'))  {
                     
                      $response = array(
                                   'status' => $new_status2,
                                    'oldstatus' => $status2,
                                    'msg' => 'QC OK Successfully changed'
                                  );
                     }
                     else {
               $response = array(
                    'status' => 'Error',
                    'status2' => $status2,
                    'msg' => 'No permission for QC OK'

                  );
               return response()->json([$response]);
           }

          
  }

  if ($request->has('targettime2')){

       //$us_time  = date('Y-m-d', strtotime($us_time1));
       $targettime2  = date('Y-m-d H:i:s' , strtotime($request->targettime2)) ;

  }
  else {

      $targettime2 =   $new_target_date2 ;
  }


  $id = $request->id ;
  $user = Auth::user()->name;
  $userid = Auth::user()->id;
  $ip_address = $_SERVER['REMOTE_ADDR'] ;

  $cdt =  Carbon::now('Asia/Kolkata');
  $cdt =  date_format($cdt, 'Y-m-d H:i:s');


  $us_time = Carbon::now('America/New_York');
  $us_time =  date_format($us_time, 'Y-m-d H:i:s');

  if (Auth::user()->level()< 20)
  {
    
     if ($new_status2  == 'Approved' || $new_status2  == 'Completed' || $new_status2  == 'Revision' ||   $new_status2  == 'Duplicate Entry' ||
      $new_status2  == 'On Hold' || $new_status2  == 'Changes' || $new_status2  == 'Rev-Completed' ||   $new_status2  == 'UnApproved'  ||   $new_status2  == 'No Response'  ||   $new_status2  == 'Cancel' ||  $new_status2  == 'Ch-Completed')
      {
                 $response = array(
                    'status' => 'Error','status2' => $status2,
                    'msg' => 'You are Not Authorised'

                  );
               return response()->json([$response]);
           }    
  }

  $orderid=Order::find($id);
  //where('status', '=', 'Completed')

  $order_master_id =  $orderid->id;
  $order_id_no     =  $orderid->order_id;




  $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $id)->where('deleted_flag','=','N')->count();
   //dd($orddtlcount);               


  $orddtlcount_st =  DB::table('order_dtls')->where('master_id','=', $id)->where('deleted_flag','=','N')->where('status', '=', 'Completed')->count();


  //  Blank allocation logic added on  16/11/19
    if ( (in_array('not allocated', explode(",", $alloc1)) == true  || in_array('0', explode(",", $alloc1)) == true ) &&
                   ( $new_status2 == 'QC Pending' || $new_status2== 'QC OK'
                        || $new_status2 == 'Alloted' || $new_status2 == 'Completed'))
                  {

                    if ( $input['file_type'] =='Vector' )
                    {
                     DB::rollBack();
            
                     $response = array(
                    'status' => 'Error', 'status2' => $status2,
                    'msg' => 'Files Status change is not applied, Please Select Designer'

                  );

               return response()->json([$response]);
                   }
                 }

    if ( (in_array('not allocated', explode(",", $alloc1)) == true ||  in_array('0', explode(",", $alloc1)) == true ) &&
                   ( $new_status2 == 'Rev-QC Pending' || $new_status2== 'Rev-QC OK'
                        || $new_status2 == 'Rev-Alloted' || $new_status2 == 'Rev-Completed'))
                  {

                    if ( $input['file_type'] =='Vector' )
                    {
                     DB::rollBack();
            
                      $response = array(
                    'status' => 'Error', 'status2' => $status2,
                    'msg' => 'Please Select Designer First..'

                  );

               return response()->json([$response]);
                   }
                 }

     if ( (in_array('not allocated', explode(",", $alloc1)) == true || in_array('0', explode(",", $alloc1)) == true  ) &&
                   ( $new_status2 == 'Ch-QC Pending' || $new_status2== 'Ch-QC OK'
                        || $new_status2 == 'Ch-Alloted' || $new_status2 == 'Ch-Completed'))
                  {

                    if ( $input['file_type'] =='Vector'  )
                    {
                     DB::rollBack();
            $response = array(
                    'status' => 'Error', 'status2' => $status2,
                    'msg' => 'Please Select Designer First..'

                  );

               return response()->json([$response]);
                   }
                 }            

  //  Blank allocation logic added on 16/11/19 
  
 
            //dd($orderid);die;
  $allocation    =  $orderid->allocation ;
  $filetype      =  $orderid->file_type ;
  $oldstatus     =  $orderid->status ;
  $stiches_count =  $orderid->stiches_count;
  $emptyalloc  =    strpos($allocation, '0');

  $allocation_id  = $orderid->alloc_id;
  //http_response_code(500);
  //dd($emptyalloc);
  //  Check User Name validation with allocation

  // Designer validation

  //dd($orddtlcount);
   

   $tmp_variable =  $oldstatus . '-' . $new_status2 ;


    // timer  insert

 if ($new_status2 == 'Alloted'  || $new_status2 == 'Rev-Alloted' || $new_status2 == 'Ch-Alloted')
 {
     $project_id=1;
     $teamleader ='';

     $alloted = DB::table('user_allocation_log')->where('order_id' ,'=', $orderid->order_id)->wherein('status', ['Alloted','Rev-Alloted', 'Ch-Alloted'])->select('username')->orderBy('id', 'desc')->first();
              
              if (!empty($alloted)){
                 $teamleader =  $alloted->username;
              }
              else{
                 $teamleader=Auth::user()->name;
              }


             //
               $separated = explode(',', $allocation_id);

                       foreach ($separated as  $value) {
                            if ($value <> '0') {
                       


                               $timer = Project::mine()->findOrFail($project_id)
                                ->timers()
                                 ->save(new Timer([
                                    'name' => $orderid->file_name,
                                    'order_id' => $orderid->order_id,
                                    'order_dtl_id' =>  null,
                                    'status'  =>  $orderid->status,
                                    'allocated_by' => $teamleader,
                                    'user_id' => $value,
                                    'started_at' => new Carbon
                                  
                                ]));
                         }

                       }



            /////  inserted above code on 01-01-21

     // $timer = Project::mine()->findOrFail($project_id)
     //                            ->timers()
     //                            ->save(new Timer([
     //                                'name' => $orderid->file_name,
     //                                'order_id' => $orderid->order_id,
     //                                'order_dtl_id' =>  null,
     //                                'status'  =>  $orderid->status,
     //                                'allocated_by' => $teamleader,
     //                                'user_id' => Auth::user()->id,
     //                                'started_at' => new Carbon
                                  
     //                            ]));

 }



  // timer insert
  //Revision and  changes logic added
  if ($oldstatus == 'Revision'   && ($new_status2 != 'Rev-Alloted' && $new_status2 != 'Cancel' && $new_status2 != 'On Hold') )
  {
                 $response = array(
                    'status' => 'Error', 'status2' => $status2, 
                    'oldstatus' => $oldstatus,
                    'msg' => 'Status should be changed to Alloted'

                  );

               return response()->json([$response]);
 }  

 if ($oldstatus == 'Changes'  &&  ($new_status2 != 'Ch-Alloted'  && $new_status2 != 'Cancel' && $new_status2 != 'On Hold') )
  {
                 $response = array(
                    'status' => 'Error', 'status2' => $status2,
                     'oldstatus' => $oldstatus,
                    'msg' => 'Status should be changed to Alloted'

                  );

               return response()->json([$response]);
 }  

  if (($new_status2  == 'Approved' || $new_status2  == 'Quote') && ($oldstatus == 'Alloted' ||  $oldstatus == 'QC Pending' || $oldstatus == 'QC OK' || $oldstatus == 'Completed' ) 
               && ($orddtlcount == 1)) {
                 $tmp_variable = $tmp_variable . 'first cond' ;
                // dd($tmp_variable);
                 $response = array(
                    'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
           } 


   if (($new_status2  == 'Approved' || $new_status2  == 'Quote') && ($oldstatus == 'Alloted' ||  $oldstatus == 'QC Pending' || $oldstatus == 'QC OK' || $oldstatus == 'Completed' ) 
               && ($orddtlcount == 1)) {
                 $tmp_variable = $tmp_variable . 'first cond' ;
                // dd($tmp_variable);
                 $response = array(
                    'status' => 'Error',
                    'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
           }

    if (($new_status2  == 'Alloted' || $new_status2  == 'Approved' || $new_status2  == 'Quote') && ($oldstatus == 'QC Pending' || $oldstatus == 'QC OK' || $oldstatus == 'Completed')
               && ($orddtlcount == 1)) {
                 $tmp_variable = $tmp_variable . 'secon cond' ;

                 // dd($tmp_variable);
              if (Auth::user()->hasPermission('qcpending.to.alloc')) 
              {
                   $response = array(
                    'status' => 'Success', 'status2' => $status2,
                     'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order Successfully changed'

                  );

              }
              else {
                 $response = array(
                      'oldstatus' => $oldstatus, 'status2' => $status2,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
             }
           }

     if (($new_status2  == 'QC Pending'  ) && ( $oldstatus == 'QC OK' || $oldstatus == 'Completed')
               && ($orddtlcount == 1)) {

                  $tmp_variable = $tmp_variable . 'third cond' ;
                  //dd($tmp_variable);
                 $response = array(
                     'oldstatus' => $oldstatus, 'status2' => $status2,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
           } 
           
           
           
     if (($new_status2  == 'QC OK') && ($oldstatus == 'Completed')
               && ($orddtlcount == 1)) {

                  $tmp_variable = $tmp_variable . 'last cond' ;
                 // dd($tmp_variable);
                 $response = array(
                      'oldstatus' => $oldstatus, 'status2' => $status2,
                    'msg' => 'Reverse Order not Possible'

                  );
               return response()->json([$response]);
           }               

    //  Designer validation
   if (Auth::user()->hasRole('Designer') && Auth::user()->level() < 12) 
    {
                    //  dd('ok');die;
           //if ($new_status2  !== 'QC Pending') 
           if (($new_status2  == 'QC Pending' || $new_status2 == 'Ch-QC Pending' || $new_status2 == 'Rev-QC Pending') && ($oldstatus == 'Alloted' || $oldstatus == 'Rev-Alloted' || $oldstatus == 'Ch-Alloted')
               && ($orddtlcount == 1)) {
                 
                 $response = array(
                    'status' => 'success', 'status2' => $status2,
                     'oldstatus' => $oldstatus,
                    'msg' => 'Updated successfully'

                  );
           }
           else
           {
                   
            $response = array(
                            'status' => 'error', 'status2' => $status2,
                          'msg' => 'Designer are allowed only to change from Allocated to QC Pending'
                          );
                  
           return response()->json([$response]);
          } 
        
    }
    // Designer validation 
    else
    {
         if ( $orddtlcount > 1) 
           {
                   
            $response = array(
                          'status' => 'error', 'status2' => $status2,
                          'msg' => 'Direct Status Change is not allowed '
                          );
                  
           return response()->json([$response]);
          } 
    }
   // Designer OThers validation  

  
 // $usernm = DB::table('users')->pluck('name'); re,move as  allocation user name not consideered in 5.6
  $usernm = DB::table('users')->pluck('id', 'id');
  $usernm = $usernm->toArray();
  // http_response_code(500);
  // dd($usernm);
  $totalloc = 0 ;
  if ($filetype == 'Vector')
  {
    //$totalloc =  DB::table('orders')->where('id','=', $id)->pluck('alloc_ation');// re,move as  allocation user name not consideered in 5.6
    $totalloc =  DB::table('orders')->where('id','=', $id)->pluck('alloc_id', 'alloc_id');
    $totalloc = $totalloc->toArray();
    $toteachalloc = explode(',', implode(' ', $totalloc));
    $matchalloc = count(array_intersect($usernm , $toteachalloc));

    // New Logic added on 09/04/18 as problem in status change 
  

    //http_response_code(500);
    // dd($matchalloc);
    // if (($new_status2 == 'QC Pending' || $new_status2 =='QC OK' || $new_status2 =='Completed') &&  ($matchalloc==0))
    // {
    //     $response = array(
    //                                  'status' =>$oldstatus,
    //                                   'msg' => 'Please Allocate the files'
    //                               );

                  
    //                           return response()->json([$response]);


    // }

   
  }
  //  Check User Name validation for allocation not blank


  $getstatusid =   DB::table('order_status')->where('status','=' , $new_status2)->select('id')
                         ->get();

  foreach($getstatusid  as $newid) {
          $newstatusid = $newid->id;
      }

  //dd($newstatusid);     


 if ( $new_status2 == 'Cancel')  {

         $orderid->update( [        'old_status' => $oldstatus,
                                    'status' =>  $new_status2,
                                     'updated_by' => $userid,
                                      'ip_address' => $ip_address,
                                      'status_change_date' => $cdt
                                        ]);

       
        $response = array(
                    'status' => 'success',
                    'status2' => $status2,
                     'oldstatus' => $oldstatus,
                    'msg' => 'Updated successfully'

                  );

 }
         

          if( $oldstatus == "Quote" && $new_status2 <> 'Approved') {

               if ($new_status2 != 'UnApproved' && $new_status2 != 'On Hold' && $new_status2 != 'Cancel'  && $new_status2 != 'Duplicate Entry'  ) {
               $response = array(
                                     'status' =>$oldstatus, 'status2' => $status2,
                                      'msg' => 'File is Never Approved'
                                  );

                  
                              return response()->json([$response]);
              }                

          }

if($newstatusid <= 8) {
          if( $oldstatus == "Approved" && $new_status2 <> 'Alloted' && $filetype =='Vector') {
               $response = array(
                                     'status' =>$oldstatus, 'status2' => $status2,
                                      'msg' => 'Please Allocate the files'
                                  );

                  
                              return response()->json([$response]);

          }

   if( $oldstatus == "Alloted" && $new_status2 <> 'QC Pending' && $filetype =='Vector') {
               $response = array(
                                     'status' =>$oldstatus, 'status2' => $status2,
                                      'msg' => 'Please change to QC Pending'
                                  );


                  
                              return response()->json([$response]);
       }                          

    }


  if ($orddtlcount > 1) {
      if ($new_status2=="Completed" && ($orddtlcount <> $orddtlcount_st) ) {
        
          $response = array('msg' => 'All files are not Completed, Please Update Child Records' ,'status2' => $status2);
               return response()->json([$response]);
      }
  }
    
        if ($stiches_count == 0  && $filetype == "Digitizing" && $new_status2 == 'Completed') 
        {
               $response = array('msg' => 'Error in stiches_count' ,'status2' => $status2);
               return response()->json([$response]);
                  
        }

   
  
    if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12) 
    {
                    //  dd('ok');die;
        if (($new_status2  !== 'QC Pending') && ($new_status2  !== 'Ch-QC Pending') && ($new_status2  !== 'Rev-QC Pending')) {
                   
                   
            $response = array(
                            'status' => 'error', 'status2' => $status2,
                          'msg' => 'Designer are allowed only to change from Allocated to QC Pending'
                          );
                  
           return response()->json([$response]);
        }

        //added notification toastr code below
        $designernm =  Auth::user()->name ;

        //removed below code as  clash if redis not working on 31/03/18
        //  $redis = LRedis::connection();
        //$push_note =  $orderid->order_id . $orderid->file_name .' status is changed to ' .
        // $new_status2. ' by ' . $designernm;
        
        //$data = ['message' => $push_note, 'user' =>$designernm, 'type' => 'orderchange'];

        //removed above code as  clash if redis not working on 31/03/18

        //dd($data); removed temporary on 21/02/18 as server moved to virtual

        //$redis->publish('message', json_encode($data));

        // above code added for notification on 3/10/17
   
    }
          $response = array(
                    'status' => 'success',
                     'status2' => $status2,
                    'msg' => 'Updated successfully'

                  );
        
     //      if ($totalloc > 0) {
            
     //        $alloc_log['user_id'] = Auth::user()->id ;
     //        $alloc_log['username'] = Auth::user()->name ;
     //        $alloc_log['order_id'] = $orderid->master_id ;
     //        $alloc_log['order_master_id'] = $orderid->id ;
     //        $alloc_log['status'] = $new_status2 ;
     //        $alloc_log['alloc_person'] = $orderid->allocation;
     //        $alloc_log['alloc_person_id'] = $orderid->alloc_id;

     //        UserAllocationLog::create($alloc_log);
     // }        
           //  timer updation

             if($new_status2 == 'Rev-QC Pending' || $new_status2 == 'Ch-QC Pending'|| $new_status2 == 'QC Pending' )     

             {
                   $order_id = $orderid->order_id;

                   DB::table('timers')->where('order_id','=',$order_id)->update(['stopped_at' => new Carbon]);

             }




           /// timer  updation       

          if($new_status2 == 'Approved')
          {
                $time_original = $cdt ;
                if ($orderid->document_type == "Rush") {
                    $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHours(3)->toDateTimeString();
                }
                elseif ($orderid->document_type  == "SuperRush")
                {
                      $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHour()->addMinutes(30)->toDateTimeString();
                }
                else {
                      $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addDay()->toDateTimeString();
                     }    
                      $orderid->update( [
                                    'status' =>  $new_status2,
                                     'old_status' => $oldstatus,
                                    'approval_time' => $cdt ,
                                    'approval_us_time' => $us_time ,
                                    'bill_dt' => $us_time,
                                    'target_completion_time' => $new_date,
                                      'updated_by' => $userid,
                                      'ip_address' => $ip_address,
                                      'status_change_date' => $cdt
                                        ]);


                      OrderDtl::where('master_id', $id)
                      ->update(['status' => $new_status2,'target_completion_time' => $new_date,  'old_status' => $oldstatus,'approval_time' => $cdt, 'approval_us_time' => $us_time]);

                      $userlogs = Order::where('id', $orderid->id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $log['ip_address'] = $ip_address ;   
                      $log['created_nm'] ='';
                      $log['updated_nm'] = Auth::user()->name ;

                      Userlog::create($log); 

                      
                    //  UserAllocationLog::create($alloc_log);   

                      return response()->json([$response]);

            }
            else
            {


                  $qcpend = DB::table('user_logs')->where('status','=' , 'QC Pending')
                         ->where('order_id','=', $orderid->order_id)->count();

                  $qcok = DB::table('user_logs')->where('status','=' , 'QC OK')
                         ->where('order_id','=', $orderid->order_id)->count();

                  if( ($new_status2 == 'Completed')  &&  ($emptyalloc !== false)  && ($filetype =='Vector')) {
                                $response = array(
                                     'status' => 'Error', 'status2' => $status2,
                                      'msg' => 'Without Allocation, File cannot be in Completed status'
                                );
                             return response()->json([$response]);
                  }  
                        
                  if( $filetype == 'Vector')  {
                        if($new_status2 == 'Completed'  &&  $qcok == 0 && $qcpend > 0 ) {
                                $response = array(
                                     'status' => 'Error', 'status2' => $status2,
                                      'msg' => 'Without QC Ok, File cannot be in Completed status'
                                );                                
                  
                          return response()->json([$response]);
                        }
                  }
                      if($filetype == 'Vector') {
                         if($new_status2 == 'Completed'  &&  $qcpend < 1 ) {
                                    $response = array(
                                     'status' => 'Error', 'status2' => $status2,
                                      'msg' => 'File is Never QC, File cannot be in Completed status'
                                  );

                  
                              return response()->json([$response]);
                              }
                      }
                          
                         
                     if($new_status2 == 'Completed') {

                            $orderid->update( [ 'old_status' => $oldstatus,
                                    'status' =>  $new_status2 , 'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'order_completion_time' => $cdt
                                           ]);
                              
                              OrderDtl::where('master_id', $id)
                      ->update([ 'old_status' => $oldstatus, 'status' => $new_status2,'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'order_completion_time' => $cdt]);

                        $alloc_log['user_id'] = Auth::user()->id ;
                                  $alloc_log['username'] = Auth::user()->name ;
                                  $alloc_log['order_id'] = $orderid->order_id ;
                                  $alloc_log['order_master_id'] = $orderid->id ;
                                  // $alloc_log['order_dtls_id']=  $OrderDtl->id; 
                                  $alloc_log['status'] = $new_status2 ;
                                  $alloc_log['alloc_person'] = $orderid->allocation;
                                  $alloc_log['alloc_person_id'] = $orderid->alloc_id;

                                  UserAllocationLog::create($alloc_log);
                      }
                      else if ($new_status2 =='Revision') {

                                       $new_note = $orderid->note .' <br />'.  'Revision #notes:' . $request->revnotes .'<br /> ';
            

                                    $orderid->update( [  'old_status' => $oldstatus,
                                    'status' =>  $new_status2 , 'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'allocation'  => 'not allocated',
                                        'alloc_id'  => 0,
                                       'target_completion_time' => $targettime2 ,
                                        'note' => $new_note
                                                                          

                                           ]);

                             OrderDtl::where('master_id', $id)
                      ->update([  'old_status' => $oldstatus, 'status' => $new_status2,'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'order_completion_time' => $cdt,
                                      'allocation'  => 'not allocated',
                                        'alloc_id'  => 0,
                                       'target_completion_time' => $targettime2,
                                        'note' => $new_note]);

                                   // New  addition
            //       $new_note = $orderid->note .' <br />'.  'Revision #notes:' . $request->revnotes .'<br />User Name : '
            // . $user . '<br />Time : ' . Carbon::now('Asia/Kolkata') .' <br />' ;

               $new_note = $orderid->note .' <br />'.  'Revision #notes:' . $request->revnotes .'<br />';
           
   
              $reason  =   [ 'target_date' => $targettime2,
                       'old_notes' => $orderid->note,
                       'new_notes' => $request->revnotes, 
                       'mistake_by' => $request->rev_mistake,
                       'reason' =>  $request->rev_mistake_reason,
                       'order_id' => $orderid->order_id, 
                       'order_master_id' => null,
                       'order_child_id' => null,  'last_status' =>$orderid->status,
                       'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                       'designer' => $request->mistake_designer_name ,
                       'teamleader' => $request->mistake_lead_name
                      
                        ] ;

                   FileReason::create($reason);
  

            //  new  addition


                               }
                               elseif ($new_status2 =='Changes') {
                                    
                                      $new_note = $orderid->note .' <br />'.  'Changes #notes:' . $request->revnotes .'<br />' ;
            
                                   
                                         $orderid->update( [  'old_status' => $oldstatus,
                                    'status' =>  $new_status2 , 'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'file_price' => $new_price,
                                       'old_price' => $old_price,
                                        'allocation'  => 'not allocated',
                                        'alloc_id'  => 0,
                                       'target_completion_time' => $new_target_date2,
                                       'note' => $new_note
                                           ]);

                             OrderDtl::where('master_id', $id)
                      ->update([  'old_status' => $oldstatus, 'status' => $new_status2,'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'order_completion_time' => $cdt, 
                                       'file_price'=>$new_price ,
                                       'old_price' => $old_price,
                                        'allocation'  => 'not allocated',
                                        'alloc_id'  => 0,
                                       'target_completion_time' => $new_target_date2,
                                       'note' => $new_note
                                     ]);
                                       
                                       // New  addition
                 

   
              $reason  =   [ 'target_date' => $new_target_date2,
                       'old_notes' =>  $new_note,
                       'new_notes' => $request->revnotes, 
                       'mistake_by' => $request->rev_mistake,
                       'reason' =>   'Old Price: '. $old_price .'<br />' . 
                                     'Add Price: '. $request->add_price .'<br />' .
                                     'File Price: '. $new_price   ,
                       'order_id' => $orderid->order_id, 
                       'order_master_id' => null,
                       'order_child_id' => null,  'last_status' =>$orderid->status,
                       'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                       'designer' => $request->mistake_designer_name ,
                       'teamleader' => $request->mistake_lead_name
                      
                        ] ;

                   FileReason::create($reason);
  

            //  new  addition


                                    }
                                else {
                                   $orderid->update( [ 'old_status' => $oldstatus,
                                    'status' =>  $new_status2 , 'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt
                                           ]);

                             OrderDtl::where('master_id', $id)
                      ->update([  'old_status' => $oldstatus, 'status' => $new_status2,'updated_by' => $userid, 
                                    'ip_address' => $ip_address,
                                       'status_change_date' => $cdt,
                                       'order_completion_time' => $cdt]);


                                  $alloc_log['user_id'] = Auth::user()->id ;
                                  $alloc_log['username'] = Auth::user()->name ;
                                  $alloc_log['order_id'] = $orderid->order_id ;
                                  $alloc_log['order_master_id'] = $orderid->id ;
                                  $alloc_log['status'] = $new_status2 ;
                                  $alloc_log['alloc_person'] = $orderid->allocation;
                                  $alloc_log['alloc_person_id'] = $orderid->alloc_id;

                                  UserAllocationLog::create($alloc_log);

                          }

                    //  }

            
    
                                $userlogs = Order::where('id', $orderid->id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $log['ip_address'] = $ip_address ;   
                      $log['created_nm'] ='';
                      $log['updated_nm'] = Auth::user()->name ;

                      Userlog::create($log); 

                      // New  addition
                      if ($new_status2 =='Rev-QC OK') {

                        $new_note = $orderid->note .' <br />'.  'Revision #notes:' . $request->revnotes .'<br /> '   ;
                      
                           $note =  DB::table('user_allocation_log')->select('username' , 'alloc_person', 'status')->where('order_master_id','=', 
                            $orderid->id)->where('status', '=', 'Rev-QC Pending')->orderby('id','asc')->get()->toArray();
                    
                          //dd($note);
                          $designer = '' ;
                          $teamleader = '';
                          foreach ($note as $key ) {
           
            
                                $teamleader=  $key->username ;
                                $designer =  $key->alloc_person ;
                          }

   
                          $reason  =   [ 'target_date' => $targettime2,
                              'old_notes' => $orderid->note,
                              'new_notes' => $request->revnotes, 
                              'mistake_by' => $request->rev_mistake,
                              'reason' =>  $request->rev_mistake_reason,
                              'order_id' => $orderid->order_id, 
                              'order_master_id' => $orderid->id,
                              'order_child_id' => null,  'last_status' =>$orderid->status,
                              'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                              'designer' => $designer,
                              'teamleader' => $teamleader
                      
                            ] ;

                            FileReason::create($reason);
                      }
  

                    //  new  addition
                       

                          return response()->json([$response]);

              }       


}

//added below func on 280520
// added on  21/12/19  for  revision qc ok status

public function  updatereason(Request $request)
{
  
  //dd($request->all());

  $new_status2 = $request->status2 ;

  $id = $request->childid ;
  $user = Auth::user()->name;
  $userid = Auth::user()->id;
  $ip_address = $_SERVER['REMOTE_ADDR'] ;

  $cdt =  Carbon::now('Asia/Kolkata');
  $us_time = Carbon::now('America/New_York');

  $cdt =  date_format($cdt, 'Y-m-d H:i:s');
  $us_time =  date_format($us_time, 'Y-m-d H:i:s');

  $orderid=OrderDtl::find($id);
 
  $oldstatus = $orderid->status;
  $master_id = $orderid->master_id ;

  $cdt = Carbon::now('Asia/Kolkata');


  $orderid->update( ['status' =>  $new_status2 , 
                     'updated_by' => $userid, 
                     'ip_address' => $ip_address,
                     'status_change_date' => $cdt
                                           ]);


     $reason  =   [ 
                    'mistake_by' => $request->rev_mistake,
                    'reason' => $request->rev_mistake_reason,
                    'order_id' =>  $orderid->order_id, 
                    'order_master_id' =>  $orderid->master_id,
                    'order_child_id' =>  $orderid->id,
                    'last_status' =>  $orderid->status,
                    'user_id' => $userid, 'user_name' =>  Auth::user()->name
                ] ;
  
    FileReason::create($reason);
  
      // Final Update of status implemented on 21-12-19

    $child =  DB::table('order_dtls')->where('master_id','=', $orderid->master_id)
    ->where('deleted_flag', '=','N')->pluck('status', 'status')->toArray();

                // $last_date =  DB::table('order_dtls')->where('master_id','=', 
                //   $child_id1)->max('target_completion_time');
                
              //  dd($last_date);

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );
                 
               // dd($childstatus);

                $unique_status =  array_unique($child);
              
          $f_status = $new_status2 ;
          $finalstatus = false ;

                if ( count($unique_status) == 1 )  
                {
                   $finalstatus = true ;
                   $f_status =  $new_status2 ;
                }
                else {
                   $finalstatus = false ;
                }

                                               



    // find child status  -07-12-19

    $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('deleted_flag','=','N')->count();

    $orddtlcount_st =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('status', '=', $new_status2 )->where('deleted_flag','=','N')->count();   
       
   //   dd($orddtlcount_st);
          // update if status of order dtl status changes
          if($orddtlcount == $orddtlcount_st) {

                  Order::where('id', $master_id)->update(['status' =>
                                      $new_status2]);
                        //  UserAllocationLog::create($alloc_log); 
              }
    
          else {

            

          //// added this code for priority status

          $f_status  = $new_status2 ;

        //  dd($child);

                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                   elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                  else{

                    $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                     //dd($min_status_id);

                    if ($min_status_id > 0) {
                       $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {


                     $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                     // dd($min_status_id);

                      if ($min_status_id > 0) {
                             $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                 
               }   // inner else condition


      } // last else condition changed on 17-12-19
                  
             //dd($f_status);
            
            if ($new_status2 == 'Approved'  || $f_status == 'Approved') {
                   $time_original = $cdt ;

                  if ($orderid->document_type == "Rush") {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHours(3)->toDateTimeString();
                  }
                  elseif ($orderid->document_type  == "SuperRush")
                  {
                          $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHour()->addMinutes(30)->toDateTimeString();
                  }
                  else {
                        $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addDay()->toDateTimeString();
                        }   

                 $Order->update( [
                                  'status' =>  $new_status2,
                                  'old_status' => $oldstatus,
                                  'approval_time' => $cdt ,
                                  'approval_us_time' => $us_time ,
                                  'bill_dt' => $us_time,
                                 'target_completion_time' => $new_date,
                                  'updated_by' => $userid,
                                  'ip_address' => $ip_address,
                                  'status_change_date' => $cdt
                                        ]);

 
            }else
            {
                           Order::where('id', $id)->update([ 'status' => $f_status ,   'child_status' => $childstatus,
             'old_status' => $oldstatus   ]);


            }

       }



      // Final Update of status implemented on 21-12-19


        $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully'

                  );

        return response()->json([$response]);     

}

//allocation select on index page added 29-05-20

public function updatealloc(Request $request)
    {
           
           
            // $OrderUpdate=$request->all();
            //  $Order=Order::find($id);
            //  $Order->update($OrderUpdate);
            //   return redirect('orders');
            // $date = new DateTime();
            //echo $date->format('Y-m-d H:i:s');
            $user = Auth::user()->name;
            $userid = Auth::user()->id;
                
            $ip_address = $_SERVER['REMOTE_ADDR'] ;
            

            $new_alloc = $request->newalloc ;
            $new_allocnm = $request->newallocnm ;

            if (is_array($new_alloc)) {
                //dd($new_alloc);
                $new =  join(',', $new_alloc);
            }   
            else {

                $new = $new_alloc ;
            }

            // if($new=='0,' || $new_allocnm =='not allocated,' ) {  not required 
            //      $response = array(
                    
            //         'status' => 'Error',
            //         'msg' => ' Allocation are Blank' 
            //       );
            //       return response()->json([$response]);

            // }

            

            $orderid=Order::find($request->id);
            $status =  $orderid->status ;
            $master_id = $orderid->id ;


            $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('deleted_flag','=', 'N')->count();

            if($orddtlcount > 1) {
                 $response = array(
                    
                    'status' => 'Error',
                    'msg' => 'Multiple Orders Cannot be Alloted from here' 
                  );
                  return response()->json([$response]);

            }

           if( ($status == 'Approved') && 
                      ($new_allocnm <> 'not allocated,') )  { 
                            
                         
                             $status = 'Alloted';
                    }

           if( ($status == 'Revision') && 
                      ($new_allocnm <> 'not allocated,') )  { 
                            
                         
                             $status = 'Rev-Alloted';
                    }
                    

            if( ($status == 'Changes') && 
                      ($new_allocnm <> 'not allocated,') )  { 
                            
                         
                             $status = 'Ch-Alloted';
                    }                   
                         
            // else {   removed as per akshay as resassigned in qc pending state
            //       $response = array(
                    
            //         'status' => 'Error',
            //         'msg' => 'Error in Status , Status should be quote or approved' 
            //       );
            //       return response()->json([$response]);

            // } 
              //$client->update($clientUpdate);
                 //return redirect('clients');

              // dd($request->client_name);
              if ($request->ajax()) {

                  // Removed extra code 
                  //  $orderid->update( [
                  // 'allocation' => ""  , 
                  // 'alloc_id' => 0 ,
                  //  'updated_by' => $userid ]);

                // if ($status == 'Alloted') {
                //   $orderid->update( [
                //   'allocation' => $new_allocnm  , 
                //   'alloc_id' => $new ,
                //   'status'  => $status,
                //    'updated_by' => $userid ]);
                // }
                // else
                // {
                
                   $orderid->update( [
                  'allocation' => $new_allocnm  , 
                  'alloc_id' => $new ,
                   'status'  => $status,
                  'updated_by' => $userid ]);
               // }

                 OrderDtl::where('master_id','=', $master_id)->update( [
                  'allocation' => $new_allocnm  , 
                  'alloc_id' => $new ,
                  'status'  => $status,
                   'updated_by' => $userid ]);


                   $alloc_log['user_id'] = Auth::user()->id ;
                            $alloc_log['username'] = Auth::user()->name ;
                            $alloc_log['order_id'] = $orderid->order_id;
                            $alloc_log['order_master_id'] = $orderid->id ;
                            $alloc_log['order_dtls_id'] = null ;
                            $alloc_log['status'] =$status;
                            $alloc_log['alloc_person_id'] = $new;
                            $alloc_log['alloc_person'] = $new_allocnm;

                          UserAllocationLog::create($alloc_log); 
                       // timer  insert

 if ($orderid->status == 'Alloted'  || $orderid->status == 'Rev-Alloted' || $orderid->status == 'Ch-Alloted')
 {
     $project_id=1;
     $teamleader ='';

     $alloted = DB::table('user_allocation_log')->where('order_id' ,'=', $orderid->order_id)->wherein('status', ['Alloted','Rev-Alloted', 'Ch-Alloted'])->select('username')->orderBy('id', 'desc')->first();
              
              if (!empty($alloted)){
                 $teamleader =  $alloted->username;
            }


           /////

             $separated = explode(',', $new);

                       foreach ($separated as  $value) {
                            if ($value <> '0') {
                       


                               $timer = Project::mine()->findOrFail($project_id)
                                ->timers()
                                 ->save(new Timer([
                                    'name' => $orderid->file_name,
                                    'order_id' => $orderid->order_id,
                                    'order_dtl_id' =>  null,
                                    'status'  =>  $orderid->status,
                                    'allocated_by' => $teamleader,
                                    'user_id' => $value,
                                    'started_at' => new Carbon
                                  
                                ]));
                         }

                       }

            /////  code added  above on 01-01-21 at 3:47 am
     // $timer = Project::mine()->findOrFail($project_id)
     //                            ->timers()
     //                            ->save(new Timer([
     //                                'name' => $orderid->file_name,
     //                                'order_id' => $orderid->order_id,
     //                                'order_dtl_id' =>  null,
     //                                'status'  =>  $orderid->status,
     //                                'allocated_by' => $teamleader,
     //                                'user_id' => Auth::user()->id,
     //                                'started_at' => new Carbon
                                  
     //                            ]));

 }



  // timer insert              

                    
                  
                  $userlogs = Order::where('id', $orderid->id)->get()->toArray();
                  //dd($userlogs);die;

                  foreach ($userlogs as  $userlog) {
                    # code...
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                
                  $log['ip_address'] = $ip_address ;
                  $log['created_nm'] ='';
                  $log['updated_nm'] = Auth::user()->name ;
                  Userlog::create($log);


                  $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully',
                  );
                
                  return response()->json([$response]);
            }
              else
            {
                 
                  return view('orders.index');
            }
        }

public function UpdateChildFile(Request $request)
{
   //dd($request->all());
   $id = $request->dtlid;
   $filename =  $request->newfilename;

   $dtl = OrderDtl::find($id);
   $dtl->update(['file_name'=>$filename]);

   $dtlfilenames=OrderDtl::where([['order_id','=',$dtl->order_id],['deleted_flag','=','N']])->pluck('file_name');
   $filestring='';
   foreach ($dtlfilenames as $key => $value) {
      if($key== 0){
        $filestring.= $value;
      }
      else{
        $filestring.=','.$value; 
      }
   }
   $orderfileupdate=Order::where('order_id','=',$dtl->order_id);
   $orderfileupdate->update(['file_name'=>$filestring]);
    $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully',
                  );
                
                  return response()->json([$response]);
            


}


// New Functionality of Delayed orders added on 21/06/18
     // Changed on  24/07/18 for Vector
public function DelayedOrdersv(Request $request )
     {
                //dd($request->search);
          // dd("hello");
       // dd(Carbon::now());

         $nowdt =  Carbon::now()->timezone('Asia/Kolkata')->toDateTimeString();   
         //dd($nowdt);

                $output =  '';
                $orders = DB::table('orders')->where('target_completion_time', '<=', $nowdt)
                ->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry' ,'On Hold', 'No Response' , 'Ch-Completed', 'Rev-Completed'])
                ->where('file_type','=', 'Vector')
                ->orderby('id', 'desc')
                ->get();

               // dd($orders);
                
                foreach ($orders as $order) {
                    # code...
                   // <th>Order Id</th>
              //<th>Order Us Date</th>
              //<th>Target Date</th>
              //<th>File Name</th>
              //<th>Status</th>
              //<th>Allocation </th>
               $string1 =  $order->status;

                  $bar1=strtolower($string1);
                   $data = preg_replace('/\s+/', '', $bar1);
                  $editurl= route('orders.edit',['id'=> $order->id]);
                 $url =  "<a href='{$editurl}'  > $order->order_id</a>" ;       
                
              $output .= '<tr>' .'<td>' . $url . '</td>' .
                    '<td>' . $order->order_us_date . '</td>' .
                '<td>' . $order->target_completion_time . '</td>' .
                '<td>' . str_replace(",","<hr>", $order->file_name) . '</td>' .
                 '<td>' . $order->file_type . '</td>' .
                // '<td>' . $client->client_email_secondary. '</td>' .
                '<td><span class="'.$data.'color btn-sm" style="cursor: context-menu;" >' . $order->status . '</span></td>' .
                '<td>' . str_replace(",","<br>", $order->allocation) . '</td>' 
                .'</tr>' ;
                }
                

                return Response($output);


     }   
public function DelayedOrdersd(Request $request )
     {
                //dd($request->search);
          // dd("hello");
       // dd(Carbon::now());

      if($request->search == "newcompany"){
         $output =  'No Data';
          $output1=0;
         if($request->datedata == ""){
            $now = Carbon::now();
            $year=$now->year;
            $month=$now->month;
         }
         else{
          $monthyear=explode("-", $request->datedata);
          $year=$monthyear[1];
          $month=$monthyear[0];

         }
       $datas=DB::table("clients")->leftJoin('client_dtls', 'clients.id', '=', 'client_dtls.client_id')->select('clients.company_id','clients.client_company','clients.email','clients.phone','clients.created_at',DB::raw('group_concat(client_dtls.client_name) AS cdclient_name'))->whereMonth('clients.created_at', '=', $month)->whereYear('clients.created_at', '=', $year)->where('store_type','=',"Retail")->distinct()->groupBy('clients.company_id','clients.client_company','clients.email','clients.phone','clients.created_at')->get();

        foreach ($datas as $data) {
          $output1++;
           $orderdatas=DB::table("orders")->where('company_id','=',$data->company_id)->first();
         if(empty($orderdatas)){

          $orderdataorder_date_timeis="No Order";
          $orderdatastatusis="No Order";
         }
         else{
            $outputlink= route('orders.edit',['id'=> $orderdatas->id]);
               
         
           $orderdataorder_date_timeis=$orderdatas->order_date_time."<br><a href='{$outputlink}'>".$orderdatas->order_id."</a>";
           $orderdatastatusis=$orderdatas->status;
         }
          $output .= '<tr><td>'.$output1.'</td><td>' . $data->created_at . '</td><td>'.$data->client_company  .'</td><td>'. str_replace(',', '<br>', $data->cdclient_name) .'</td><td>'.$data->email.'</td><td>'.$data->phone  .'</td><td>'. $orderdataorder_date_timeis .'</td><td ><span class="'.strtolower($orderdatastatusis).'color btn-sm">'. $orderdatastatusis .'<span></td></tr>' ;
        }
        return Response([$output,$output1]);   
      }
      else{
         $nowdt =  Carbon::now()->timezone('Asia/Kolkata')->toDateTimeString();   
         //dd($nowdt);

                $output =  '';
                $orders = DB::table('orders')->where('target_completion_time', '<=', $nowdt)
                ->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry' ,'On Hold', 'No Response' , 'Ch-Completed', 'Rev-Completed'])
                ->where('file_type','=', 'Digitizing')
                ->orderby('id', 'desc')
                ->get();

               // dd($orders);
                
                foreach ($orders as $order) {
                    # code...
                   // <th>Order Id</th>
              //<th>Order Us Date</th>
              //<th>Target Date</th>
              //<th>File Name</th>
              //<th>Status</th>
              //<th>Allocation </th>
                  $string1 =  $order->status;

                  $bar1=strtolower($string1);
                   $data = preg_replace('/\s+/', '', $bar1);
                 $editurl= route('orders.edit',['id'=> $order->id]);
                 $url =  "<a href='{$editurl}'  > $order->order_id</a>" ;        
                
              $output .= '<tr>' .'<td>' . $url . '</td>' .
                    '<td>' . $order->order_us_date . '</td>' .
                '<td>' . $order->target_completion_time . '</td>' .
                '<td>' . $order->file_name . '</td>' .
                 '<td>' . $order->file_type . '</td>' .
                // '<td>' . $client->client_email_secondary. '</td>' .
                 '<td><span class="'.$data.'color btn-sm" style="cursor: context-menu;" >' . $order->status . '</span></td>'  .
                '<td>' . $order->allocation . '</td>' 
                .'</tr>' ;
                }
                
          }
                return Response($output);


     } 
      public function delayedordersp(Request $request )
     {
                //dd($request->search);
          // dd("hello");
       // dd(Carbon::now());

         $nowdt =  Carbon::now()->timezone('Asia/Kolkata')->toDateTimeString();   
         //dd($nowdt);

                $output =  '';
                $orders = DB::table('orders')->where('target_completion_time', '<=', $nowdt)
                ->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry' ,'On Hold', 'No Response' , 'Ch-Completed', 'Rev-Completed'])
                ->where('file_type','=', 'Photoshop')
                ->orderby('id', 'desc')
                ->get();

               // dd($orders);
                
                foreach ($orders as $order) {
                    # code...
                   // <th>Order Id</th>
              //<th>Order Us Date</th>
              //<th>Target Date</th>
              //<th>File Name</th>
              //<th>Status</th>
              //<th>Allocation </th>
                  $string1 =  $order->status;

                  $bar1=strtolower($string1);
                   $data = preg_replace('/\s+/', '', $bar1);
                 $editurl= route('orders.edit',['id'=> $order->id]);
                 $url =  "<a href='{$editurl}'  > $order->order_id</a>" ;      
                
              $output .= '<tr>' .'<td>' . $url . '</td>' .
                    '<td>' . $order->order_us_date . '</td>' .
                '<td>' . $order->target_completion_time . '</td>' .
                '<td>' . $order->file_name . '</td>' .
                 '<td>' . $order->file_type . '</td>' .
                // '<td>' . $client->client_email_secondary. '</td>' .
                 '<td><span class="'.$data.'color btn-sm" style="cursor: context-menu;" >' . $order->status . '</span></td>' .
                '<td>' . $order->allocation . '</td>' 
                .'</tr>' ;
                }
                

                return Response($output);


     } 
     //today company list by divyaraj
  public function TodayOrdComp()              
{
     //  $nowdt1 =  Carbon::now('America/New_York')->addDays(-6);

      $nowdt1 =  Carbon::now('America/New_York');

      $nowdt =  $nowdt1->toDateTimeString();
      $nowdt_ymd =  $nowdt1->format('Y-m-d');

      // dd($nowdt);
      // order_us_date changed to bill_dt as per kulind sir instruct 16-01-2020

                $output =  '';
                $orders = DB::table('orders')->where(DB::raw("(DATE_FORMAT(bill_dt,'%Y-%m-%d'))"),$nowdt_ymd)
                  //->where(DB::raw("(DATE_FORMAT(order_us_date,'%Y-%m-%d'))"),$nowdt_ymd)
                //->where('order_us_date', '>=', $nowdt_ymd)
                //->where('order_us_date', '<=', $nowdt)
                ->whereNotIn('status', ['Quote',  'Cancel', 'Duplicate Entry', 'On Hold', 'No Response'])
                ->whereIn('file_type', ['Vector', 'Digitizing'])
                ->select(DB::raw('sum(file_count) as count, file_type, company_id'))
                ->groupBy('company_id', 'file_type')->get();
                

      //dd($orders);
                
                foreach ($orders as $order) {
                    # code...
                    // dd($order->client_company);
                     $clients = DB::table('client_dtls')->where('delete_flag', 'N')->where('company_id', '=', $order->company_id)->limit(1)->get();
                      //dd($clients);
                      
                     foreach($clients as $cl){
                         
                        $company = $cl->client_company;
                        $name =  $cl->client_name ;
                        $email =  $cl->client_email_primary ;
                     }
                
                          $url =  "<a  href='#'  >  $order->company_id </a>" ; 
              $output .= '<tr class="todaycount">'  .'<td>' .  $order->company_id . '</td>' .'<td>' . $company . '</td>' .
                    '<td>' . $name . '</td>' .
                '<td>' . $email . '</td>' .
                '<td>' . $order->file_type . '</td>' .
                 '<td>' . $order->count . '</td>' 
                                .'</tr>' ;
                }
                

                return Response($output);
}  
//searchordcomp by divyaraj
     public function SearchOrdComp(Request $request)              
{
     //  $nowdt1 =  Carbon::now('America/New_York')->addDays(-6);

      $nowdt1 =  Carbon::now('America/New_York');

      $nowdt =  $nowdt1->toDateTimeString();
      $nowdt_ymd =  $nowdt1->format('Y-m-d');

      // dd($nowdt);
      // order_us_date changed to bill_dt as per kulind sir instruct 16-01-2020

                $output =  '';
                $orders = DB::table('orders')->whereBetween(DB::raw("(DATE_FORMAT(bill_dt,'%Y-%m-%d'))"),[$request->cstartdate, $request->cenddate])
                  //->where(DB::raw("(DATE_FORMAT(order_us_date,'%Y-%m-%d'))"),$nowdt_ymd)
                //->where('order_us_date', '>=', $nowdt_ymd)
                //->where('order_us_date', '<=', $nowdt)
                ->whereNotIn('status', ['Quote',  'Cancel', 'Duplicate Entry', 'On Hold', 'No Response'])
                ->whereIn('file_type', ['Vector', 'Digitizing'])
                ->select(DB::raw('sum(file_count) as count, file_type, company_id'))
                ->groupBy('company_id', 'file_type')->get();
                

      //dd($orders);
                
                foreach ($orders as $order) {
                    # code...
                    // dd($order->client_company);
                     $clients = DB::table('client_dtls')->where('delete_flag', 'N')->where('company_id', '=', $order->company_id)->limit(1)->get();
                      //dd($clients);

                     foreach($clients as $cl){
                         
                        $company = $cl->client_company;
                        $name =  $cl->client_name ;
                        $email =  $cl->client_email_primary ;
                     }
                
                          $url =  "<a  href='#'  >  $order->company_id </a>" ; 
              $output .= '<tr class="todaycount">'  .'<td>' .  $order->company_id . '</td>' .'<td>' . $company . '</td>' .
                    '<td>' . $name . '</td>' .
                '<td>' . $email . '</td>' .
                '<td>' . $order->file_type . '</td>' .
                 '<td>' . $order->count . '</td>' 
                                .'</tr>' ;
                }
                

          return Response($output);
}
public function curr_mnth_piedata(Request $request)
{
          
           // dd($request->year);

           // $mont = $request->month ;

           // $newmont = (int)$mont + 1; 

             $newmont = 1;

            $date_start = '2020-'. str_pad($newmont, 2, '0', STR_PAD_LEFT) . '-01';
            $date_end = '2020-'. str_pad($newmont, 2, '0', STR_PAD_LEFT) . '-31';

             
            
            $curr_mnth_startdt =  Carbon::now()->startOfMonth()->subDays(60); 


            $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');


            $curr_date    =  Carbon::now() ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');


   $coin1 = \DB::table('orders')
                ->select(DB::raw('
                  sum(IF(file_type ="Digitizing", file_price,0)) digiprice, 
                  sum(IF(file_type ="Vector", file_price,0)) vectprice,
                  sum(IF(file_type ="Photoshop", file_price,0)) photoprice,
                   sum(IF(file_type ="Digitizing", file_count,0)) digicount,
                  sum(IF(file_type ="Vector", file_count,0)) vectcount,
                  sum(IF(file_type ="Photoshop", file_count,0)) photocount'  ))
                ->where('status','=','Completed')
                ->where('bill_dt','>=', $date_start)
                ->where('bill_dt','<=', $date_end)
                //->groupBy(DB::raw('DATE_FORMAT(bill_dt, "%Y%m")'))
                ->get();

               //($coin1);
                $tot1 = array();
                $total=0;

                 foreach ($coin1 as $key=>$value) {
                    $total =(float)$value->digiprice + (float)$value->vectprice + (float)$value->photoprice;
              


                //dd($total);
                //     $total= (float)$coin1->digiprice + (float)$coin1->vectprice +(float)$coin1->photoprice;
                  
                  if ($value->vectprice == null){
                        $tot1 =  array( 'error' =>'no data');
                  }
                  else {
                    $tot1['vect'] = ((float)$value->vectprice/(float)$total)*100;   
                    $tot1['digi'] =  ((float)$value->digiprice/(float)$total)*100;             
                    $tot1['photo'] =  ((float)$value->photoprice/(float)$total)*100;  
                    $tot1['vect1'] =  (float)$value->vectprice;   
                    $tot1['digit1']  = (float)$value->digiprice;             
                    $tot1['photo1'] =  (float)$value->photoprice;  
                  
                    $tot1['vectcount'] = (float)$value->vectcount;
                    $tot1['digicount'] = (float)$value->digicount;
                  $tot1['photocount']= (float)$value->photocount;
                  

                  }

                  
                 }

    return response()->json($tot1);

}


public function curr_mnth_data(Request $request)
{
            $curr_mnth_startdt =  Carbon::now()->startOfMonth()->subDays(60); 


            $curr_mnthdt  = date_format($curr_mnth_startdt, 'Y-m-d');


            $curr_date    =  Carbon::now() ;
            $curr_dt      = date_format($curr_date, 'Y-m-d');


   $coin1 = \DB::table('orders')
                ->select(DB::raw('DISTINCT DATE_FORMAT(bill_dt, "%Y%m") as vday, 
                  sum(IF(file_type ="Digitizing", file_price,0)) digiprice, 
                  sum(IF(file_type ="Vector", file_price,0)) vectprice' ))
                ->where('status','=','Completed')
                ->groupBy(DB::raw('DATE_FORMAT(bill_dt, "%Y%m")'))
                ->get();

               // dd($coin1);

                 $tot1= array();
                 $tot2= array();
                foreach ($coin1 as $key=>$value) {
                     $tot1[$key]=$value;
                }

   // $coin2 = \DB::table('orders')
   //              ->select(DB::raw('DISTINCT DATE_FORMAT(bill_dt, "%Y%m") as vday, sum(file_price) as dprice' ))
   //              ->where('status','=','Completed')
   //              ->where('file_type', '=', 'Digitizing')
   //               ->groupBy(DB::raw('DATE_FORMAT(bill_dt, "%Y%m")'))
   //              ->get();

   //              //dd($coin2);

   //              foreach ($coin2 as $key=>$value) {
   //                   $tot2[$key]=$value;
   //              }

   // $coins = array_merge($tot1, $tot2);

             // dd($coins);

                $coins = $tot1;

    return response()->json($coin1);

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

           
            return view('highcharts')->with('orders1', json_encode($orders1,JSON_NUMERIC_CHECK))
                               ->with('orders2', json_encode($orders2,JSON_NUMERIC_CHECK))
                               ->with('orders3', json_encode($orders3,JSON_NUMERIC_CHECK))
                               ->with('orders4', json_encode($orders4,JSON_NUMERIC_CHECK));
        }

//order status  update ajax function added below on 28-05-20 update divyaraj
public function orderdtlstatus(Request $request)
{
  //dd($request->all()); 
  $input = $request->all();
 
  //http_response_code(500);
  
  $new_status2 = $request->status2 ;
  // new logic for status change added
  $new_price = 0;
  if ($request->has('a3')) {
      
      $new_price = $request->a3 ;  
       
  }

  $new_target_date2 = '';
  $old_price = 0 ;

  $new_status2 = $request->status2 ;
  if (isset($request->allocname1[0])) {

       $allocname1  = $request->allocname1[0];
  }

  $new_target_date2 = $request->new_target_date2;
  
  if ($new_status2 == 'Changes')
  {
    $old_price =  $request->old_price; 
  }

 
  
  $targettime2 =  $new_target_date2 ; 
  
   
  

  // new logic for status change added



  if (Auth::user()->level()< 20)
  {
    
     if ($new_status2  == 'Completed' )
      {
                 $response = array(
                    'status' => 'Error',
                    'msg' => 'You are Not Authorised'

                  );
               return response()->json([$response]);
           }    
  }

  $id = $request->childid ;
  $user = Auth::user()->name;
  $userid = Auth::user()->id;
  $ip_address = $_SERVER['REMOTE_ADDR'] ;

  $cdt =  Carbon::now('Asia/Kolkata');
  $us_time = Carbon::now('America/New_York');

  $cdt =  date_format($cdt, 'Y-m-d H:i:s');
  $us_time =  date_format($us_time, 'Y-m-d H:i:s');

  $orderid=OrderDtl::find($id);
  $oldstatus = $orderid->status;



  //$input_dtls   = $input['orddtls'];  error throwing while testing...

  //$order_master_id =  $orderid->id;  wrong as this is id not master id of orders changed 
   //on  23-jan-2020

  $order_master_id =  $orderid->master_id;  

  $order_id_no     =  $orderid->order_id;

  $Order = Order::find($order_master_id);

 //  new logic for qc ok  inserted on 04-02-21 by prashant

if ($new_status2 == 'QC OK') {
            if (Auth::user()->hasPermission('do.qc.ok'))  {
                     
                      $response = array(
                                   'status' => $new_status2,
                                    'oldstatus' => $oldstatus,
                                    'msg' => 'QC OK Successfully changed'
                                  );
                     }
                     else {
               $response = array(
                    'status' => 'Error',
                    'oldstatus' => $oldstatus,
                    'msg' => 'No permission for QC OK'

                  );
               return response()->json([$response]);
           }

          
  }


  // new logic for qc ok inserted on 04-02-21 by prashant

  
  //user allocation as on 29/11/19

  $alloc_log = array();
  // user allocation as on 29/11/19
            

  //          dd($oldstatus);die;
  $allocation    =  $orderid->allocation ;
  $filetype      =  $orderid->file_type ;
  $oldstatus     =  $orderid->status ;
  $stiches_count =  $orderid->stiches_count;
  $master_id     =  $orderid->master_id ;
  $emptyalloc  =    strpos($allocation, '0');
  //http_response_code(500);

  $alloc_log['user_id'] = Auth::user()->id ;
  $alloc_log['username'] = Auth::user()->name ;
  $alloc_log['order_id'] = $order_id_no ;
  $alloc_log['order_master_id'] = $order_master_id ;
  $alloc_log['order_dtls_id'] = $id ;
  $alloc_log['status'] = $new_status2 ;
  $alloc_log['alloc_person_id'] = $orderid->alloc_id;
  $alloc_log['alloc_person'] = $orderid->allocation;
  

  //reverse check introduced on 22/06/18 as not working

   $tmp_variable =  $oldstatus . '-' . $new_status2 ;

    //Revision and  changes logic added

   if ( ($allocname1 == '0')  &&  ($new_status2 == 'Alloted' || $new_status2 == 'Rev-Alloted' || $new_status2 == 'Ch-Alloted' || $new_status2 == 'QC Pending' 
    || $new_status2 == 'QC OK'  || $new_status2 == 'Completed') ) {

           $response = array(
                    'oldstatus' => $oldstatus,
                    'msg' => 'Allocation cannot be Blank'

                  );
               return response()->json([$response]);
        }


   if ($new_status2 == 'Revision'  &&  $oldstatus != 'Completed' )
  {
             if ($oldstatus != 'Rev-Completed' ) 
             {

                  if ($oldstatus != 'Ch-Completed' ) {

                      $response = array(
                    'status' => 'Error',
                    'oldstatus' => $oldstatus,
                    'msg' => 'Revision is after Completed status only'

                  );

               return response()->json([$response]);   
                  }
                 
             }  
 }  

  if ($oldstatus == 'Revision'  && ($new_status2 != 'Rev-Alloted'  && $new_status2 != 'Cancel'  && $new_status2 != 'On Hold' ))
  {
                 $response = array(
                    'status' => 'Error',
                    'oldstatus' => $oldstatus,
                    'msg' => 'Status should be changed to Alloted'

                  );

               return response()->json([$response]);
 }  

 if ($oldstatus == 'Changes'  && ( $new_status2 != 'Ch-Alloted'  && $new_status2 != 'Cancel'  && $new_status2 != 'On Hold' ))
  {
                 $response = array(
                    'status' => 'Error',
                     'oldstatus' => $oldstatus,
                    'msg' => 'Status should be changed to Alloted'

                  );

               return response()->json([$response]);
 }  


 // above code added on 26/11/19 for revision done at any status

   if (($new_status2  == 'Approved' || $new_status2  == 'Quote') && ($oldstatus == 'Alloted' ||  $oldstatus == 'QC Pending' || $oldstatus == 'QC OK' || $oldstatus == 'Completed' ) 
               ) {
                 $tmp_variable = $tmp_variable . 'first cond' ;
                // dd($tmp_variable);
                 $response = array(
                     'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
           }

    if (($new_status2  == 'Alloted' || $new_status2  == 'Approved' || $new_status2  == 'Quote') && ($oldstatus == 'QC Pending' || $oldstatus == 'QC OK' || $oldstatus == 'Completed')
               ) {
                 $tmp_variable = $tmp_variable . 'secon cond' ;

                 // dd($tmp_variable);
             if (Auth::user()->hasPermission('qcpending.to.alloc')) 
              {
                   $response = array(
                    'status' => 'Success',
                    'msg' => 'Reverse Order Successfully changed'

                  );

              }
              else {
                 $response = array(
                     'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );
                  


               return response()->json([$response]);
             }
           }

     if (($new_status2  == 'QC Pending'  ) && ( $oldstatus == 'QC OK' || $oldstatus == 'Completed')
              ) {

                  $tmp_variable = $tmp_variable . 'third cond' ;
                  //dd($tmp_variable);
                 $response = array(
                     'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );

               return response()->json([$response]);
           } 
           
           
           
     if (($new_status2  == 'QC OK') && ($oldstatus == 'Completed')
               ) {

                  $tmp_variable = $tmp_variable . 'last cond' ;
                 // dd($tmp_variable);
                 $response = array(
                     'oldstatus' => $oldstatus,
                    'msg' => 'Reverse Order not Possible'

                  );
               return response()->json([$response]);
           }               


  //reverse check introduced on 22/06/18 as not working
  
  //  Check User Name validation for  allocation not blank

  // Total count in details
    $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $master_id)->where('deleted_flag', '=', 'N')->count();
  // Total count in details
  
  $usernm = DB::table('users')->pluck('id', 'id'); //changed in laravel 5.6
  //dd($usernm);
  $usernm = $usernm->toArray();
  // http_response_code(500);
 
  if ($filetype == 'Vector')
  {
    $totalloc =  DB::table('order_dtls')->where('master_id','=', $master_id)->pluck('alloc_id', 'alloc_id');
    //$totalloc =  DB::table('order_dtls')->where('id','=', $id)->pluck('allocation');
    //dd($id);
    $totalloc = $totalloc->toArray();
    $toteachalloc = explode(',', implode(' ', $totalloc));
    $matchalloc = count(array_intersect($usernm , $toteachalloc));
    //http_response_code(500);
   // dd($matchalloc);
    // if (($new_status2 == 'QC Pending' || $new_status2 =='QC OK' || $new_status2 =='Completed') &&  ($matchalloc ==0 ))
    //   {
    //     $response = array(
    //                                  'status' =>$oldstatus,
    //                                   'msg' => 'Please Allocate the files'
    //                               );

                  
    //                           return response()->json([$response]);


    //   }
  //  Check User Name validation for allocation not blank
  }



 
  $getstatusid =   DB::table('order_status')->where('status','=' , $new_status2)->select('id')
                         ->get();

  foreach($getstatusid  as $newid) {
          $newstatusid = $newid->id;
      }


 if ( $new_status2 == 'Cancel')  {

         // $orderid->update( [
         //                            'status' =>  $new_status2,
         //                             'updated_by' => $userid,
         //                              'ip_address' => $ip_address,
         //                              'status_change_date' => $cdt
         //                                ]);
          
         //   UserAllocationLog::create($alloc_log); 
       
        $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully'

                  );

 }

  
          if( $oldstatus == "Quote" && $new_status2 <> 'Approved') {

                if ($new_status2 != 'UnApproved' && $new_status2 != 'On Hold' && $new_status2 != 'Cancel'  && $new_status2 != 'Duplicate Entry'  ) {
                      
               $response = array(
                                      'oldstatus' => $oldstatus,
                                      'msg' => 'File is Never Approved'
                                  );

                  
                              return response()->json([$response]);
                }              

          }

if($newstatusid <= 8) {
    if( $oldstatus == "Approved" && $new_status2 <> 'Alloted' && $filetype =='Vector') {
               $response = array(
                                     'oldstatus' => $oldstatus,
                                      'msg' => 'Please Allocate the files'
                                  );

                  
                              return response()->json([$response]);

          }

   if( $oldstatus == "Alloted" && $new_status2 <> 'QC Pending' && $filetype =='Vector') {
               $response = array(
                                     'oldstatus' => $oldstatus,
                                      'msg' => 'Please change to QC Pending'
                                  );

                  
                              return response()->json([$response]);

    }
  }

    
        if ($stiches_count == 0  && $filetype == "Digitizing" && $new_status2 == 'Completed') 
        {
               $response = array('msg' => 'Error in stiches_count' ,  'oldstatus' => $oldstatus,);
               return response()->json([$response]);
                  
        }

   
  
    if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12) 
    {
                    //  dd('ok');die;
        if (($new_status2  !== 'QC Pending') && ($new_status2  !== 'Ch-QC Pending') && ($new_status2  !== 'Rev-QC Pending')) {
                   
            $response = array(
                            'oldstatus' => $oldstatus,
                          'msg' => 'Designer are allowed only to change from Allocated to QC Pending'
                          );
                  
           return response()->json([$response]);
        }
   
    }
          $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully'

                  );
                
                  
    // new logic for qc pending  for 07-01-2020

    if ($new_status2 =='QC Pending' || $new_status2 =='Rev-QC Pending'  || $new_status2 =='Ch-QC Pending'  ) {      
        
         $orderid->update( [
                                    'status' =>  $new_status2,
                                     'updated_by' => $userid,
                                      'ip_address' => $ip_address,
                                      'status_change_date' => $cdt
                                        ]);

                       OrderDtl::where('master_id', $master_id)->where('id', $id)->update(['status' => $new_status2 ]);


                    
                      $userlogs = OrderDtl::where('id', $orderid->id)->get()->toArray();
                      foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                      $log['child_id'] = $orderid->id ;
                      $log['created_by'] =  Auth::user()->id ;
                      $log['action']   =  "update detail status mode "."OrderController@orderdtlstatus" ;
                      orderdtls_history::create($log);   
                      UserAllocationLog::create($alloc_log);
                        $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully'

                  );
                      
             //
             // return response()->json([$response]);        
         }    

   // else  {


   //            $response = array(
   //                  'status' => 'error',
   //                  'msg' => 'Contact Admin, Unauthorized action'

   //                );

   //            return response()->json([$response]);
   //    }
   


   //  new logic for qc pending for 07-01-2020          

    // new logic added on 16/10/19 for status changes


    if ($new_status2 =='Revision' ) {
    
            $rev_note = $orderid->note .' <br />'.  'Revision #notes:' . $request->rev_note .'<br />User Name : '
            . $user . '<br />Time : ' . Carbon::now('Asia/Kolkata') .' <br />' ;


              $orderid->update( [
                     'status' =>  $new_status2 , 'updated_by' => $userid, 
                     'ip_address' => $ip_address,
                     'status_change_date' => $cdt,
                     'allocation'  => 'not allocated',
                    'alloc_id'  => 0,
                    'target_completion_time' => $targettime2,
                    'note' => $rev_note
              ]);

                $notes =  $Order->notes . '<br />' . $rev_note ;  
                    $Order->update(['note' => $notes ]);

               $response = array(
                            'oldstatus' => $oldstatus,
                            'target_date' => $targettime2,
                            'note'  =>  $rev_note,
                          'msg' => 'Updated successfully'
                          );

        $userlogs = OrderDtl::where('id', $orderid->id)->get()->toArray();
              
        foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
              }

        $log['child_id'] = $orderid->id ;
        $log['created_by'] =  Auth::user()->id ;
                      
        $log['action']   =  "update detail status mode "."OrderController@orderdtlstatus" ;
      
        orderdtls_history::create($log);

              // UserAllocationLog::create($alloc_log); 
         
              $reason  =   [ 'target_date' => $targettime2,
                             'old_notes' => $orderid->note,
                             'new_notes' => $rev_note, 
                             'mistake_by' => $request->rev_mistake,
                             'reason' => $request->rev_mistake_reason,
                             'order_id' =>  $orderid->order_id, 
                             'order_master_id' =>  $orderid->master_id,
                             'order_child_id' =>  $orderid->id,
                             'last_status' =>  $orderid->status,
                             'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                             'designer' => $request->mistake_designer_name ,
                             'teamleader' => $request->mistake_lead_name
                  ] ;
   
                  //  dd($reason);

            FileReason::create($reason);

      }
      
      elseif ($new_status2 =='Changes') 
      {
           $rev_note = $orderid->note .' <br />'.  'Changes #notes:' . $request->rev_note .'<br />User Name : '
            . $user . '<br />Time : ' . Carbon::now('Asia/Kolkata') .' <br />' ;
      
                                   
                    $orderid->update( [
                           'status' =>  $new_status2 , 'updated_by' => $userid, 
                           'ip_address' => $ip_address,
                           'status_change_date' => $cdt,
                           'file_price' => $new_price,
                           'old_price' => $old_price,
                           'allocation'  => 'not allocated',
                           'alloc_id'  => 0,
                           'target_completion_time' => $new_target_date2,
                           'note' => $rev_note
                                       
                    ]);
                     
                    $notes =  $Order->notes . '<br />' . $rev_note ;  
                    $Order->update(['note' => $notes ]);

                      $response = array(
                            'oldstatus' => $oldstatus,
                            'target_date' => $targettime2,
                            'file_price' => $new_price,
                            'note'  =>  $rev_note,
                            'msg' => 'Updated successfully'
                          );

          $userlogs = OrderDtl::where('id', $orderid->id)->get()->toArray();
              
          foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
              }

        $log['child_id'] = $orderid->id ;
        $log['created_by'] =  Auth::user()->id ;
                      
        $log['action']   =  "update detail status mode "."OrderController@orderdtlstatus" ;
      
        orderdtls_history::create($log);


                                      //UserAllocationLog::create($alloc_log); 
                                          $reason  =   [ 'target_date' => $targettime2,
                                   'old_notes' => $orderid->note,
                                   'new_notes' => $rev_note, 
                                   'mistake_by' => $request->rev_mistake,
                                    'reason' =>   'Old Price: '. $old_price .'<br />' . 
                                     'Add Price: '. $request->add_price .'<br />' .
                                     'File Price: '. $new_price   ,
                                   'order_id' =>  $orderid->order_id, 
                                   'order_master_id' =>  $orderid->master_id,
                                   'order_child_id' =>  $orderid->id,
                                    'last_status' =>  $orderid->status,
                                  'user_id' => $userid, 'user_name' =>  Auth::user()->name,
                                  'designer' => $request->mistake_designer_name ,
                                  'teamleader' => $request->teamleader
                              ] ;

                                  // dd($reason);
   

                               FileReason::create($reason);

            }
             elseif ($new_status2 =='Rev-QC OK') 
           {
               
                $orderid->update( [
                           'status' =>  $new_status2 , 'updated_by' => $userid, 
                           'ip_address' => $ip_address,
                           'status_change_date' => $cdt
                                                                  
                    ]);

          $userlogs = OrderDtl::where('id', $orderid->id)->get()->toArray();
              
          foreach ($userlogs as  $userlog) {
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
              }

        $log['child_id'] = $orderid->id ;
        $log['created_by'] =  Auth::user()->id ;
                      
        $log['action']   =  "update detail status mode "."OrderController@orderdtlstatus" ;
      
        orderdtls_history::create($log);


                                      //UserAllocationLog::create($alloc_log); 
                                          $reason  =   [ 
                                   'mistake_by' => $request->rev_mistake,
                                   'reason' => $request->rev_mistake_reason,
                                   'order_id' =>  $orderid->order_id, 
                                   'order_master_id' =>  $orderid->master_id,
                                   'order_child_id' =>  $orderid->id,
                                    'last_status' =>  $orderid->status,
                                  'user_id' => $userid, 'user_name' =>  Auth::user()->name
                                  
                              ] ;

                                  // dd($reason);
   

                               FileReason::create($reason);
            

           }

     // code added to update  header status
     
   

  $child =  DB::table('order_dtls')->where('master_id','=',  $orderid->master_id)
    ->where('deleted_flag', '=','N')->pluck('status', 'status')->toArray();

    

                $childstatus = implode(', ', array_map(function($val){ 
                         return sprintf("'%s'", $val);
                       }, $child)
                        );
    
                $unique_status =  array_unique($child);
              
          $f_status = $new_status2 ;

          //  dd($f_status);
          $finalstatus = false ;

                if ( count($unique_status) == 1 )  
                {
                   $finalstatus = true ;
                   $f_status =  $new_status2 ;
                }
                else {
                   $finalstatus = false ;
                }

                                               



    // find child status  -07-12-19

    $orddtlcount =  DB::table('order_dtls')->where('master_id','=', $orderid->master_id)->where('deleted_flag','=','N')->count();

    $orddtlcount_st =  DB::table('order_dtls')->where('master_id','=',  $orderid->master_id)->where('status', '=', $new_status2 )->where('deleted_flag','=','N')->count();   
       
      //dd($orddtlcount_st . $orddtlcount);
          // update if status of order dtl status changes
          if($orddtlcount == $orddtlcount_st ) {

                  Order::where('id',  $orderid->master_id)->update(['status' =>
                                      $new_status2]);
                        //  UserAllocationLog::create($alloc_log); 
              }
    
          else {

    
          $f_status  = $new_status2 ;
           
          // dd($f_status);

    
                  if (in_array('Changes', $child) ){
                    
                     $f_status = 'Changes';
                  }
                  elseif ( in_array('Revision', $child)){
                                $f_status = 'Revision';
                  }
                   elseif ( in_array('Rev-Alloted', $child)){
                                $f_status = 'Rev-Alloted';
                  }
                  elseif ( in_array('Rev-QC Pending', $child)){
                                $f_status = 'Rev-QC Pending';
                  }
                  elseif ( in_array('Rev-QC OK', $child)){
                                $f_status = 'Rev-QC OK';
                  }
                  elseif ( in_array('Ch-Alloted', $child)){
                                $f_status = 'Ch-Alloted';
                  }
                  elseif ( in_array('Ch-QC Pending', $child)){
                                $f_status = 'Ch-QC Pending';
                  }
                  elseif ( in_array('Ch-QC OK', $child)){
                                $f_status = 'Ch-QC OK';
                  }
                  else{



                    $min_status_id  = DB::table('order_status')->where('id','<', '8')->wherein('status', $child)->min('id');

                     //dd($min_status_id);

                    if ($min_status_id > 0) {
                       $finalstatus_desc =  DB::table('order_status')->where('id','<', '8')->where('id', $min_status_id)->pluck('status');

                      foreach ($finalstatus_desc as $key) {
                        //dd($key);
                        $f_status = $key;
                      }  
                  }
                  else {


                     $min_status_id  = DB::table('order_status')->where('id','>', '15')->whereNotIn('id', ['20', '24'])->wherein('status', $child)->min('id');

                     // dd($min_status_id);

                      if ($min_status_id > 0) {
                             $finalstatus_desc =  DB::table('order_status')->where('id','>', '15')->where('id', $min_status_id)->pluck('status');

                              foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                              }  
                      }
                      else {

                            $min_status_id  = DB::table('order_status')->wherein('status', $child)->min('id');

                            $finalstatus_desc =  DB::table('order_status')->where('id', $min_status_id)->pluck('status');

                            foreach ($finalstatus_desc as $key) {
                                  //dd($key);
                                  $f_status = $key;
                            }    
                      }  


                 
               }   // inner else condition


      } // last else condition changed on 17-12-19
                  
          // dd($f_status);
       Order::where('id', $orderid->master_id)->update([ 'status' => $f_status ,   'child_status' => $childstatus,
             'old_status' => $oldstatus   ]);

            /// final  updation on header status
    
    }        
      

  
    return response()->json([$response]);
}

public function getfiles(Request $request)
{

       $id=  $request->oid;
   
      $files = DB::table('order_dtls')->where('master_id','=', $id )->get()->toArray(); 


      foreach ($files as $key ) {
                                   # code...
               $order_id = $key->order_id;

      }                           
   
     
     $timers = DB::table('timers')->where('order_id' ,'=', $order_id)->get()->toArray(); 
     //dd($timers);
     

      $searches = array();
      $diff = '';

      //dd($files);

       return response()->json([
                'success' => true,
                'modal' => view('orders.temp', compact(
                    'timers',
                    'searches', 'diff'
                    
                ))->render()
            ]);

       

}


 public function updatetimer(Request $request)
    {

          //  dd($request->id);
      $id = $request->id ;
      $project_id = 1;

      $data =  DB::table('timers')->where('id', '=', $id)->update(['started_at' => new Carbon]);

      
}


public function stoptimer(Request $request)
    {

          //  dd($request->id);
      $id = $request->id ;
      $project_id = 1;


     if ($timer = Timer::mine()->running()->first()) {
            $timer->update(['stopped_at' => new Carbon]);
        }


     }
     public function getdelayvalue(Request $request){
        $nowdt =  Carbon::now('Asia/Kolkata')->toDateTimeString();
        $nowdt_ymd =  Carbon::now('Asia/Kolkata')->format('Y-m-d');

        $delayordersv = DB::table('orders')->where('target_completion_time', '<=', $nowdt )->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry', 'On Hold' , 'No Response', 'Ch-Completed', 'Rev-Completed'])->where('file_type','=', 'Vector')->count();

        $delayordersd = DB::table('orders')->where('target_completion_time', '<=', $nowdt )->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry' , 'On Hold' , 'No Response' , 'Ch-Completed', 'Rev-Completed'])->where('file_type','=', 'Digitizing')->count();     

        $delayordersp = DB::table('orders')->where('target_completion_time', '<=', $nowdt)->whereNotIn('status', ['Quote',  'Completed', 'Cancel', 'Duplicate Entry', 'On Hold' , 'No Response' , 'Ch-Completed', 'Rev-Completed'])->where('file_type','=', 'Photoshop')->count();

        $nowdt1 =  Carbon::now('America/New_York');

        $nowdt =  $nowdt1->toDateTimeString();
        $nowdt_ymd =  $nowdt1->format('Y-m-d');

      // order_us_date changed to bill_dt as per kulind sir instruct 16-01-2020
        $todayscompany = DB::table('orders')->where(DB::raw("(DATE_FORMAT(bill_dt,'%Y-%m-%d'))"),$nowdt_ymd)->whereNotIn('status', ['Quote',  'Cancel', 'Duplicate Entry' ,  'On Hold' , 'No Response' ])->wherein('file_type', ['Vector', 'Digitizing'] )
                ->distinct()
                ->count('client_company'); 
        
         return  response()->json(['delayordersv' =>$delayordersv,'delayordersd' =>$delayordersd,'delayordersp'=>$delayordersp,'todayscompany'=>$todayscompany]);


     }
     public function updateordermisc(Request $request)
{
           
           //dd( $request -> stitchvalue); die;
            $input  = $request -> all();
           //dd($input); die;

            $user = Auth::user()->name;
            $userid = Auth::user()->id;
            $ip_address = $_SERVER['REMOTE_ADDR'] ;
            $new_status1 = $request->status1 ;
                
                
   
            $orderid=Order::find($request->id);
            //dd($orderid);die;
            $allocation =  $orderid->allocation ;
            $filetype    = $orderid->file_type ;
            $oldstatus =  $orderid->status ;
            $stiches_count = $orderid->stiches_count ;
            if ($request ->has('stitchvalue')) {
              $stiches_count = $request['stitchvalue'];
              //dd($stiches_count);die;
            }


          if ($request ->has('stitchvalue')) {
                  
                  $new_stitchvalue = $request['stitchvalue'] ;

                  if ($new_stitchvalue == 0  && $filetype == "Digitizing") {
                        $response = array('msg' => 'Error in stiches_count');
                        return response()->json([$response]);
                      }
                             // dd($new_stitchvalue);die;

                                               
                              //dd($orderid['file_type']); die;  
                                $orderid->update( [
                                    'stiches_count' =>  $new_stitchvalue,  'updated_by' => $userid , 'ip_address' => $ip_address]);

                     $v_id =  $orderid->id ;
                     // dd($orderid ->vendor_digit_price);
                     $result = DB::select('CALL ord_updation(?)', array($v_id));
          }

           

          $cdt =  Carbon::now('Asia/Kolkata');
          $cdt =  date_format($cdt, 'Y-m-d H:i:s');
          // inserted as not updating file price on 08/08/17

                  if ($request ->has('vendor1')) {
                  
                      $vendor1 = $request->vendor1 ;

                        $orderid->update( [
                         'vendor' =>  $vendor1 ,  'updated_by' => $userid , 'ip_address' => $ip_address]);

                        $v_id =  $orderid->id ;
                      
                        $result = DB::select('CALL ord_updation(?)', array($v_id));

                  } 

                 if ($request ->has('document_type')) {
                  
                     //$new_document_type = $request->document_type ;  old column name document_type
                     // changed on 28/04/17

                     $new_document_type = $request->document_type ;

                     //dd($orderid->id);
                      if(is_null($orderid->approval_time)) {
                            $time_original = $orderid->order_date_time ;
                      }
                      else {
                            $time_original = $orderid->approval_time; 
                      }

                     // $time_add      = $time_original + (3600*24); //add seconds of one day
                     $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addDay()->toDateTimeString(); 
                    
                  
                      if ($new_document_type == "Rush") {

                          $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHours(3)->toDateTimeString();


                        }
                      elseif ($new_document_type == "SuperRush")
                      {
                          //$time_add  =  $time_original + 90 ;
                          //$new_date  =  date("Y-m-d H:i:s", $time_add);
                           $new_date  = Carbon::createFromFormat('Y-m-d H:i:s', $time_original)->addHour()->addMinutes(30)->toDateTimeString();
                      }
          
                    //dd($new_status_normal);
                    $orderid->update( [
                      'document_type' =>  $new_document_type,
                      'target_completion_time' => $new_date,  'updated_by' => $userid ,
                      'ip_address' => $ip_address]);

                    //dd($orderid->document_type);

                    } 

                               
                                 
                  

                 if ($request ->has('filevalue')) {
                  
                  $new_filename = $request->filevalue ;

                  $orderid->update( [
                  'file_name' =>  $new_filename , 'updated_by' => $userid , 'ip_address' => $ip_address]);

                  }
  

                if ($request ->has('filetype1')) {
                  
                      $new_filetype1 = $request->filetype1 ;

                      $orderid->update( [
                          'file_type' =>  $new_filetype1 , 'updated_by' => $userid , 'ip_address' => $ip_address]);

                  
                      $v_id =  $orderid->id ;
                      
                      $result = DB::select('CALL ord_updation(?)', array($v_id));
                  }  

                if ($request ->has('vend_file_price')) {
                  
                  $new_vend_file_price = $request->vend_file_price ;

                  $orderid->update( [
                  'vendor_digit_price' =>  $new_vend_file_price ,'updated_by' => $userid,
                   'ip_address' => $ip_address ]);

                  }  

                  if ($request ->has('vend_embr_price')) {
                  
                  $new_vend_embr_price = $request->vend_embr_price ;

                  $orderid->update( [
                  'vendor_digit_rate' =>  $new_vend_embr_price , 'updated_by' => $userid ,
                  'ip_address' => $ip_address]);

                  }  

                   if ($request ->has('filepricevalue')) {
                  
                  $file_price = $request->filepricevalue ;
                           // dd($file_price);
                  $orderid->update( [
                  'file_price' =>  $file_price , 'updated_by' => $userid, 'ip_address' => $ip_address]);

                  }  
     


          
                if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 2) 
                {
                  
                    if ($new_status1  !== 'QC Pending') {
                       
                    
                     $response = array(
                          'status' => 'success',
                          'msg' => 'Designer are allowed only to change from Allocated to QC Pending'
                          );
                  
                          return response()->json([$response]);
                     }
                

                }
             
               
                if ($request ->has('vendor1')) {
                  
                      $vendor1 = $request->vendor1 ;

                        $orderid->update( [
                         'vendor' =>  $vendor1 ,  'updated_by' => $userid , 'ip_address' => $ip_address]);

                } 

             
                 if ($request ->has('filevalue')) {
                  
                  $new_filename = $request->filevalue ;

                  $orderid->update( [
                  'file_name' =>  $new_filename , 'updated_by' => $userid , 'ip_address' => $ip_address]);

                  }
  

                if ($request ->has('filetype1')) {
                  
                  $new_filetype1 = $request->filetype1 ;

                  $orderid->update( [
                  'file_type' =>  $new_filetype1 , 'updated_by' => $userid , 'ip_address' => $ip_address]);

                  }  

                if ($request ->has('vend_file_price')) {
                  
                  $new_vend_file_price = $request->vend_file_price ;

                  $orderid->update( [
                  'vendor_digit_price' =>  $new_vend_file_price ,'updated_by' => $userid,
                   'ip_address' => $ip_address ]);

                  }  

                  if ($request ->has('vend_embr_price')) {
                  
                  $new_vend_embr_price = $request->vend_embr_price ;

                  $orderid->update( [
                  'vendor_digit_rate' =>  $new_vend_embr_price , 'updated_by' => $userid ,
                  'ip_address' => $ip_address]);

                  }  

                   if ($request ->has('filepricevalue')) {
                  
                  $file_price = $request->filepricevalue ;
                           // dd($file_price);
                  $orderid->update( [
                  'file_price' =>  $file_price , 'updated_by' => $userid, 'ip_address' => $ip_address]);

                  }  
     

                  $v_id =  $orderid->id ;
                  //dd($v_id);die;
                 // $result = DB::select('CALL ord_updation(?)', array($v_id));
                  // DB::statement(DB::raw('CALL getLibraryList('.$email.');'));

                  $userlogs = Order::where('id', $orderid->id)->get()->toArray();
                  //dd($userlogs);die;

                  foreach ($userlogs as  $userlog) {
                    # code...
                           foreach ($userlog as $key => $value) {
                                   $log[$key] = $value ;   
                            }
                      }
                
                  $log['ip_address'] = $ip_address ;   
                  $log['created_nm'] ='';
                  $log['updated_nm'] = Auth::user()->name ;

                  //dd($log);die;
                  Userlog::create($log);
                
                  //Userlog::create($userlogs);
     
                  $response = array(
                    'status' => 'success',
                    'msg' => 'Updated successfully'

                  );
                
        
                  return response()->json([$response]);
}


}
