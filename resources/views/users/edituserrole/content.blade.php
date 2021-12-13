<form action="{{route('user.userupdate')}}" method="post" >
    @csrf
<input type="hidden" name="id" value="{{$userdata->id}}">

<div class="">
  <br>
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('user.index')}}" style="color: black;"><b>User's Roles & Permission</b></a> <i class="fa fa-angle-double-right "></i>Update</h5>          
        </div>
        <div class="col-md-3">
           
            <a href="{{route('user.index')}}" class="btn btn-danger btn-outline rightdiv ">Cancel</a>
             <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
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
                  <h5 align="center" class="rounded pt-2 pb-2"><b>Edit User</b></h5>
                  <div class="row">
                    
                      <div class="col-md-2 pr-1 ">
                            <div class="form-group ">
                                <label>First Name</label>
                                <input type="text" class="form-control mt-0" name="first_name" value="{{$userdata->first_name}}">
                            </div>
                      </div>
                      <div class="col-md-2 px-1 ">
                            <div class="form-group ">
                                <label>Last Name</label>
                                <input type="text" class="form-control mt-0" name="last_name" value="{{$userdata->last_name}}">
                            </div>
                      </div>
                      <div class="col-md-3 px-1 ">
                            <div class="form-group ">
                                <label>E-Mail Address</label>
                                <input type="email" class="form-control mt-0" name="email" value="{{$userdata->email}}">
                            </div>
                      </div>
                      <div class="col-md-3">
                            <div class="form-group ">
                                <label>New Password</label>
                                <input type="text" id="password" class="form-control mt-0" name="password" value="">
                            </div>
                      </div>
                   </div>
                  
                  <hr class="temcolor1">
                    <h5 align="center" class="rounded pt-2 pb-2"><b>Roles</b></h5>
                   <!--     <h4 style="color:black"><b>Roles:</b></h4> -->
                   <div class="row">
                      <table width="100%">   
                        <tr>  
                            <?php $row =0; ?>
                        @foreach($roledata as $role) 
                                      @if($row == 7)
                                        <?php $row =0; ?>
                                        </tr><tr>
                                      @endif
                                        <?php $row++; ?>

                                      @if($userdata->hasRole($role->id))
                                      <td> 
                                        <div class="form-check">
                                      
                                        <input class="form-check-input " type="checkbox" name="assignroles[]" value="{{$role->id}}" checked="">
                                          <label class="form-check-label" >
                                                    {{ $role->name}}
                                          </label>
                                       
                                        </div></td><td style="color: black"></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                              
                                                <input class="form-check-input" type="checkbox" name="assignroles[]" value="{{$role->id}}">

                                                   <label class="form-check-label" >
                                                    {{ $role->name}}
                                          </label>
                                              
                                            </div></td><td style="color: black"></td>
                                      @endif
                        @endforeach
                        </table> 
                </div>
                <!--  GROUP NOTIFY-->
                
                 <hr class="temcolor1">
                    <h5 align="center" class="rounded pt-2 pb-2"><b>Notification Details</b></h5>

                   <div class="row">
                      <table  width="100%">   
                        <tbody>
                          
                       
                        <tr>  
                            <?php $row =0; $n=0; ?>
                        @foreach($permissions  as $permission) 
                                    
                                        <?php $row++;  ?>
                                       
                                     @if( str_contains($permission->slug, 'notify'))
                                    
                                      <td> 
                                        <div class="form-group">
                                        <div class="form-check">
                                      @if($userdata->hasPermission($permission->id)) 
                                          <input class="form-check-input " type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                            
                                      @else
                                           <input class="form-check-input " type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" >
                                            

                                      @endif
                                          <label class="form-check-label" >
                                                    {{ $permission->name}}
                                          </label>
                                        </div> </div></td>
                                        <?php $n++; ?>
                                        @if($n>3)
                                           <?php $n=0; ?>
                                           </tr><tr>
                                        @endif    

                                       <!--  <td style="color: black"></td> -->
                                       @endif
                                    

                                   
                                    
                        @endforeach
                      </tr>
                         </tbody>
                        </table> 
                </div>

                               

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
                                    <!--     <div class="form-check" > -->
                                       <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                   <!--      <span class="form-check-sign form-check-sign1"></span> -->
                                     </div>
                                      <!--   </div> --></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                               
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                               <!--  <span class="form-check-sign"></span> -->
                                              
                                            </div></td> 
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of ROle'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                     
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                     <!--    <span class="form-check-sign form-check-sign1"></span> -->
                                      
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                              
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                             <!--    <span class="form-check-sign"></span> -->
                                            
                                            </div></td><!-- <td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Edit Role'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                      
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                      
                                      
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                          
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                             
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete Role'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"> -->
                                        </td>
                      @endif
                  @endif
                @endif
              @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Create User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"> --></td>
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete User'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"> --></td>
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
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Modify Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete of Client'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div> </td><!--<td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Create Order'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update of Orders1'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                 @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Order Delete'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              </tr>
               <tr>  
                  <td><strong>Virtual Assistant Details</strong></td>
                      
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.virtual.assistant'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['create.virtual.assistant'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['edit.virtual.assistant'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                 @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['delete.virtual.assistant'] ))
                                    
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td> 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                      @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              </tr></td>
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Hide Client Name'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                <td></td>
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['RESTRICT PRIMARY EMAIL'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allow-change-allocation'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allocation-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-completion-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['order-completion-date-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['contact1_modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['stitch_modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              <td></td>
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-count-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-note-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['file-price-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['Vendor Emb. Rate Modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                   @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Vendor Emb Rate Hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['vend-file-price-modify'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                   @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['allow modification of order status'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-status-hide'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->

                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              
              @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['QC PENDING TO ALLOCATION HIDE'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              
             <td></td>
                  
              </tr>
              <tr>   
                      <td>Can do QC Ok</td>
                      <td></td> 
                        @foreach($permissions as $permission) 
                        @if(in_array($permission->description,['Can do QC Ok'] ))

                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
              
             <td></td>
                  
              </tr>
          </table>
                  <br>   
                <div class="row">
                  <div class="col-md-6">       
                            <h5  align="center" class="font-weight-bold ">Dashboard Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 400px;">Field</th>
                            <th>Show</th>
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Company Revenue</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['comp.revenue','comp.filecount','designer.revenue','designer.count','file.price.dashboard','monthly.dashboard'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>
                       </div>
                       <div class="col-md-6">
                        <h5  align="center" class="font-weight-bold ">Log Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 400px;">Field</th>
                            <th>Show</th>
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Order Log</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['view.order.log','view.company.log','view.client.log','view.virtual.assistant.log'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>
                        </div>
                       </div> 

              <br>  
               <div class="row">    
          <div class="col-md-6">      
            <h5  align="center" class="font-weight-bold ">Invoice Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 300px;">Field</th>
                            <th>Show</th>
                          
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>Generate Invoice</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['print.invoice','generate.invoice'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                                     
                                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                                     
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                  </div>
                   <div class="col-md-6">      
            <h5  align="center" class="font-weight-bold ">Report Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 300px;">Field</th>
                            <th>Show</th>
                          
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>Orders Date Range</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['confirm.orders.date.range','active.clients.date.range','inactive.clients.date.range','clients.generated.date.range'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                     
                                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}"> 
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                                     
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                  </div>

            </div>
  <br>

                            <h5  align="center" class="font-weight-bold ">New Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                            <th>Modify</th>
                           
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Client Address</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Client Address Show','Client Address Edit','Client State Show','Client State Edit','Vendor Show','Vendor Edit','Company Id Show','Company Id Edit','Digit Rate Show','Digit Rate Edit','Order Us Date Show','Order Us Date Edit','Order Completion Time Show','Order Completion Time Edit','Delay Digitizing','Edit Delay Digitizing','Company Count','Edit Company Count','Delay Vector','Edit Delay Vector','Delay Photoshop','Edit Delay Photoshop','File Name','Edit File Name','File Type','Edit File Type','Client Source Show','Client Source Edit','CSR Person Show','CSR Person Edit'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>
                           <br>          
                            <h5  align="center" class="font-weight-bold ">Virtual Assistant</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                            <th>Modify</th>
                           
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Resource Billing</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.resource.billing','edit.resource.billing','show.generate.invoicing','edit.generate.invoicing','show.currency','edit.currency','show.amont','edit.amont','view.portal','edit.portal','view.portal.password','edit.portal.password'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
                      @endif
                  @endif
                @endif
              @endforeach
                        </tr>
                        </table>
                        <div class="row">
                          <div class="col-md-6">
                            <br>          
                            <h5  align="center" class="font-weight-bold ">Company Type</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                          
                           
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>All Company</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.all.clients','show.retail.clients','show.fix.clients'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                        @if($userdata->hasDirectPermission($permission->id))
                                      <td > 
                                        <div class="form-check" >
                                        <label class="form-check-label" >
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="" >
                                        <span class="form-check-sign form-check-sign1"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                  @else
                      @if($userdata->hasPermission($permission->id)) 
                                     <td> 
                                        <i class="fa fa-check" aria-hidden="true"></i></td><!-- <td style="color: white"></td> -->
                      @else 
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white"></td> -->
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
    </div>
   
 </div>
</form>