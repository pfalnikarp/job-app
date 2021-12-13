<form action="{{route('user.userupdate')}}" method="post" >
    @csrf
<input type="hidden" name="id" value="{{$userdata->id}}">

<div class="">
  <br>
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('user.index')}}" style="color: black;"><b>User's Roles & Permission</b></a> <i class="fa fa-angle-double-right "></i>Show</h5>          
        </div>
        <div class="col-md-3">
           
            <a href="{{route('user.index')}}" class="btn btn-danger btn-outline rightdiv ">Cancel</a>
             
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-body ">
                  <h5 align="center" class="rounded pt-2 pb-2"><b>Show User</b></h5>
                  <div class="row">
                     <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>User Name</label>
                                <h5>{{$userdata->name}}</h5>
                                
                               
                             </div>
                       </div>
                      <div class="col-md-4 px-1 ">
                            <div class="form-group ">
                                <label>E-Mail Address</label>
                                <h5>{{$userdata->email}}</h5>
                            </div>
                      </div>
                      
                   </div>
                  
                  <hr class="temcolor1">
                    <h5 align="center" class="rounded pt-2 pb-2"><b>Roles</b></h5>
                   <!--     <h4 style="color:black"><b>Roles:</b></h4> -->
                   <div class="row ml-1">
                      <table>    
                        <tr>  
                            <?php $row =0; ?>
                        @foreach($roledata as $role) 
                                      @if($row == 7)
                                        <?php $row =0; ?>
                                        </tr><tr>
                                      @endif
                                       

                                      @if($userdata->hasRole($role->id))
                                       <?php $row++; ?>
                                      <td> 
                                        <i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;
                                         </td><td style="color: black">{{$role->name}}&nbsp;&nbsp;</td>
                                      @else
                                    
                                      @endif
                          
                        @endforeach
                        </table> 
                </div>
        <hr class="temcolor1">
         <h5 align="center" class="rounded pt-2 pb-2 mt-4"><b>Permission</b></h5>
            <div class="row">
            <div class="col-md-12">
                            <h5  align="center" class="font-weight-bold">Main Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        <tr>  
                        <td><strong>Roles</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['List of ROLES'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of ROle'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Edit Role'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete Role'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                </tr>
                    <tr>  
                        <td><strong>User Details</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Show User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Create User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                       <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              
              </tr>
               <tr>  
                        <td><strong>Client Details</strong></td>
                        @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['Show Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Modify Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete of Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              </tr>
               <tr>  
                  <td><strong>Order Details</strong></td>
                      
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-view'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Create Order'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update of Orders1'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                 @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Order Delete'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              </tr>
                        </table>
                         </div>
                
             <div class="col-md-12">
              <br>
                      <h5  align="center" class="font-weight-bold">Other Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                              <th style="width: 500px;">Field</th>
                              <th>Show</th>
                              <th>Modify</th>
                              <th>Hide</th>
                        </tr>
                        
                         <tr>   
                        <td>client name</td>
                        
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Show Client Name'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Hide Client Name'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color: red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

                        </tr>
                         <tr>   
                        <td>Primary Email ID</td>
                      
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['SHOW CLIENT PRIMARY EMAIL'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                <td></td>
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['RESTRICT PRIMARY EMAIL'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

                        </tr>
                 <tr>   
                      <td>File Allocate</td>
                       
                       
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allocation-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allow-change-allocation'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allocation-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
              
               <tr>   
                      <td>Order Date</td>
                       
                       
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
                <tr>   
                      <td>Order Completion Date</td>
                       
                        
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-completion-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
                <tr>   
                      <td>Order Completion Date</td>
                       
                        
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-completion-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
               <tr>   
                      <td>Contact</td>
                       
                      
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['contact1_modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
              <tr>   
              <td>Stitch Count</td>
                    
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['stitch_view'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['stitch_modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              
              </tr>
              <tr>   
              <td>File Count</td>              
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-count-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-count-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
             
              </tr>
                <tr>   
                      <td>File Note</td>
                       
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-note-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-note-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
              </tr>
              <tr>   
                      <td>File Price</td>
                       
                      
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-price-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-price-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
              </tr>
             
              <tr>   
                      <td>Vendor Embroidery Price</td>
                       
                      
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['v_emb_rate_show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['Vendor Emb. Rate Modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                   @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Vendor Emb Rate Hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              </tr>
              <tr>   
                      <td>Vendor File Price /Change Vendor Name</td>
                       
                       
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-show'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['vend-file-price-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                   @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              </tr>
               
               <tr>   
                  <td>Execute of Reports</td>
                        <td></td>
                        @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['Execute of Reports'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

             <td></td>
                  
              </tr>

                        </table>
              <br>
                      <h5  align="center" class="font-weight-bold">Status Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                              <th style="width: 500px;">Field</th>
                              <th>Show</th>
                              <th>Modify</th>
                              <th>Hide</th>
                        </tr>
                        <tr>   
                      <td>Status</td>
                       
                       
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Only View Order Status'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['allow modification of order status'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-status-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach

              </tr>
              <tr>   
                <td>Allow Reverse Allocation from QC Pending</td>
                <td></td>       
                        @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['QC PENDING TO ALLOCATION'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['QC PENDING TO ALLOCATION HIDE'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                  
              </tr>
              <tr>   
                      <td>Allocation to QC Pending</td>
                      <td></td> 
                        @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['alloc-qcpending'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
              
             <td></td>
                  
              </tr>
             </table>
                 <br>          
                            <h5  align="center" class="font-weight-bold ">Dashboard Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Company Revenue</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['comp.revenue','comp.filecount','designer.revenue','designer.count','file.price.dashboard'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>

              <br>          
                            <h5  align="center" class="font-weight-bold ">New Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                            <th>Modify</th>
                           
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>client name</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Client Address Show','Client Address Edit','Client State Show','Client State Edit','Vendor Show','Vendor Edit','Company Id Show','Company Id Edit','Digit Rate Show','Digit Rate Edit','Order Us Date Show','Order Us Date Edit','Order Completion Time Show','Order Completion Time Edit','Delay Digitizing','Edit Delay Digitizing','Company Count','Edit Company Count','Delay Vector','Edit Delay Vector','Delay Photoshop','Edit Delay Photoshop','File Name','Edit File Name','File Type','Edit File Type'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                       <td> 
                                        <i class="fa fa-check" aria-hidden="true" style="color:red;"></i></td>
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                         <td> 
                                        <i class="fa fa-times" aria-hidden="true"></i></td>
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>
                         </div>
          </div>



        

        </div>
    </div>
   
 </div>
</form>