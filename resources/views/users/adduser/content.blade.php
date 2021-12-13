<form action="{{route('user.store')}}" method="post" >
    @csrf


<div class="">
  <br>
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('user.index')}}" style="color: black;"><b>User</b></a> <i class="fa fa-angle-double-right "></i>Create</h5>
        </div>
        <div class="col-md-3 mb-2">

            <a href="{{route('user.index')}}" class=" btn btn-danger btn-outline rightdiv ">Cancel</a>
             <button class="btn btn-success btn-outline rightdiv mr-2">Save</button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card temcolor1 ">

                <div class="card-body ">
                    <h5 align="center" class="rounded pt-2 pb-2"><b>New User</b></h5>
                  <div class="row">
                     <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>First Name</label>
                                <input type="text" class="form-control mt-0" name="first_name" value="{{ old('first_name') }}" required="">
                            </div>
                     </div>
                      <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>Last Name</label>
                                <input type="text" class="form-control mt-0" name="last_name" value="{{ old('last_name') }}" required="">
                            </div>
                     </div>
                      <div class="col-md-3 px-1 ">
                            <div class="form-group ">
                                <label>E-Mail Address</label>
                                <input type="email" class="form-control mt-0" name="email" value="{{ old('email') }}" required="">
                            </div>
                     </div>
                      <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>Password</label>
                                <input type="text" id="password" class="form-control mt-0" name="password" value="{{ old('password') }}" required="">
                            </div>
                     </div>

                   </div>
                

                     
                  
                    <hr class="temcolor1">
                    <h5 align="center" class="rounded pt-2 pb-2"><b>Roles</b></h5>
                   
                   <!--     <h4 style="color:black"><b>Roles:</b></h4> -->
                   <div class="row">
                      <table>
                        <tr>
                            <?php $row = 0;?>
                        @foreach($roles as $role)
                                      @if($row == 7)
                                        <?php $row = 0;?>
                                        </tr><tr>
                                      @endif
                                        <?php $row++;?>


                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input1" type="checkbox" name="assignroles[]" value="{{$role->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><td style="color: black;">{{$role->name}}</td>

                        @endforeach
                        </table>
                </div>
                        <hr class="temcolor1">
                <h5 align="center" class="rounded pt-2 pb-2 mt-4"><b>Permission</b></h5>
      <div class="row">
          <div class="col-md-12">
                         
                                                  <h5  align="center" class="font-weight-bold ">Main Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                        <tr>
                           <td><strong>Roles</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['role.list'] ))
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['role.create'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['role.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['role.delete'] ))
                                   
                                      
                                      
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                                            <td><strong>User Details</strong></td>
                    
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['user.show'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['user.create'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach
                 
                    
                   
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['user.update'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['user.delete'] ))
                                   
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                  </tr>
                  <tr>
                     <td><strong>Client Details</strong></td>
                         
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['client.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                      
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['client.create'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['client.update'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['client.delete'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                  
                            @else
                            @endif
                         
                        @endforeach  
                  </tr>
                  <tr>
                    <td><strong>Order Details</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order.view'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order.create'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                         
                        @endforeach  
                                                  @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order.update'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order.delete'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                            @else
                            @endif
                         
                        @endforeach  
                  </tr> 
                   <tr>
                    <td><strong>Virtual Assistant Details</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.virtual.assistant'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['create.virtual.assistant'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                         
                        @endforeach  
                                                  @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['edit.virtual.assistant'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['delete.virtual.assistant'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                            @else
                            @endif
                         
                        @endforeach  
                  </tr>  
 

                        </table>
                         </div>

              <div class="col-md-6 mt-2">
                           
                         </div>
                       </div>
            <br>
                 <h5  align="center" class="font-weight-bold ">Other Permission</h5>
               <table id="roles" class="" style="width:100%"> 
                <tr>
                  <th style="width: 500px;">Field</th>
                  <th>Show</th>
                  <th>Modify</th>
                  <th>Hide</th>
                     
                </tr>
                 <tr>
                   <td>Client Name</td>
                   @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.client-name'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                         
                        @endforeach
                   <td></td>
                            
                         @foreach($permissions as $permission) 
                        @if(in_array($permission->slug,['hide.client-name'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                         
                        @endforeach  
                 </tr>
                    <td>Company Name</td>
                     @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.company'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                         
                        @endforeach
                    <td></td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['hide.company'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                  
                            @else
                            @endif
                         
                        @endforeach 
                     
                 </tr>
                 <tr>
                   <td>Primary Email ID</td>
                   @foreach($permissions as $permission) 
                    @if(in_array($permission->slug,['show.primary-email'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach
                   <td></td>
                         
                         @foreach($permissions as $permission) 
                          @if(in_array($permission->slug,['restrict.primary-email']))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach 
                 </tr>
                 <tr>
                   <td>File Allocate</td>
                    @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['allocation.show'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->

                            @else
                            @endif
                           
                        @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['allowchange.allocation'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                         
                        @endforeach 
                         
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['allocation.hide'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach 
                 </tr>
                  
                  <tr>
                    <td>Order Date</td>
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['orderdate.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order-date.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                    
                               @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['orderdate.hide'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Order Completion Date</td>
                  
                         
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['ordercompletiondate.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order-completion-date.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['ordercompletiondate.hide'] ))
                                   
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                  </tr>
                        <tr>
                    <td>Contact</td>
                  
                         
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['contact1.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['contact1.modify'] ))
                                   
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['contact1.hide'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Stitch Count</td>
                        
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['stitch.view'] ))
                                   
                                      
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['stitch.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                          <td></td>
                  </tr>
                  <tr>
                    <td>File Count</td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-count.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                             @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-count.modify'] ))
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                           @endforeach
                           <td></td>
                  </tr>
                   <tr>
                    <td>File Note</td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-note.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-note.modify'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                   
                            @else
                            @endif
                           @endforeach
                         
                         <td></td>
                  </tr>
                       <tr>
                    <td>File Price</td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-price.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-price.modify'] ))
                                   
                                      
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                         
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['file-price.hide'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Vendor Embroidery Price</td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['v_emb_rate.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['v_emb_rate.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                         
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['v_emb_rate.hide'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                  <td>Vendor File Price /Change Vendor Name</td>
                      @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['vend-file-price.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['vend-file-price.modify'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                          
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['vend-file-price.hide'] ))
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                  </tr>
               
                   <tr>
                  <td>Execute of Reports</td>
                   <td></td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['report.execute'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                       
                       <td></td>
                  </tr>
               </table>
               <br>
                 <h5  align="center" class="font-weight-bold ">Status Permission</h5>
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
                            @if(in_array($permission->slug,['orderstatus.show'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['orderstatus.modify'] ))
                                   
                                    
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['order-status.hide'] ))
                                   
                                      
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                  </tr>
             
                   <tr>
                  <td>Allow Reverse Allocation from QC Pending</td>
                        <td></td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['qcpending.to.alloc'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                       
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['qcpending.to.allochide'] ))
                                   
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                    
                            @else
                            @endif
                           @endforeach
                  </tr>
                <tr>
                  <td>Allocation to QC Pending</td>
                          <td></td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['alloc.qcpending'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
                            @endif
                           @endforeach
                      
                       <td></td>
                  </tr>
                  <tr>
                   <td>Can do QC Ok</td>
                          <td></td>
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['do.qc.ok'] ))
                                   
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @else
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
                          
                           <!--  <th>Delete</th>   -->
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
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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
                          
                           <!--  <th>Delete</th>   -->
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
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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
                        <td>Confirm Orders Date Range</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['confirm.orders.date.range','active.clients.date.range','inactive.clients.date.range','clients.generated.date.range'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                               <!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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
                          
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>Client Address</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['client.address.show','client.address.edit','client.state.show','client.state.edit','vendor.show','vendor.edit','company.id.show','company.id.edit','digit.rate.show','digit.rate.edit','order.us.date.show','order.us.date.edit','order.completion.time.show','order.completion.time.edit','show.delay.digitizing','edit.delay.digitizing','show.company.count','edit.company.count','show.delay.vector','edit.delay.vector','show.delay.photoshop','edit.delay.photoshop','show.file.name','edit.file.name','show.file.type','edit.file.type','show.client.source','edit.client.source','show.csr.person','edit.csr.person'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span><!--permissionslug-->
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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
                          
                           <!--  <th>Delete</th>   -->
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
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                <br>
                <div class="row">
                  <div class="col-md-6">  
                  <h5  align="center" class="font-weight-bold ">Company Type</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                           
                          
                           <!--  <th>Delete</th>   -->
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
                                     
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                     
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