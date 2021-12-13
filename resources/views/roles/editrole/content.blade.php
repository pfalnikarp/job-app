<br>
<form action="{{route('role.update')}}" method="post" >
    @csrf
<input type="hidden" name="id" value="{{$role->id}}">

<div class="">
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('role.index')}}" style="color: black;"><b>Roles</b></a> <i class="fa fa-angle-double-right"></i><b>Update</b></h5>          
        </div>
        <div class="col-md-3">
            <a href="{{route('role.index')}}" class="btn btn-danger btn-outline rightdiv">Cancel</a>
               <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
        </div>
    </div>
  @if ($errors->any())
    <div class="alert alert-danger mt-1 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    </div>
 @endif
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                     <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="{{$role->name}}"   required="">
                                <input type="hidden" name="id" value="{{$role->id}}">
                            </div>
                        </div>
                        <div class="col-md-4 px-1 ">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="{{$role->slug}}"   required="">
                            </div>
                        </div>
                        <div class="col-md-1 px-1 ">
                            <div class="form-group ">
                                <label>Level</label>
                                <input type="text" class="form-control mt-0" name="level" value="{{$role->level}}"   required="">
                            </div>
                        </div>
                         <div class="col-md-4 pl-1 ">
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea name="description" class="form-control form-control2 mt-0" value="" required="">{{$role->description}}</textarea>
                               <!--  <input type="text" class="form-control mt-0" name="description" value=""   required=""> -->
                            </div>
                        </div>
                   </div>
                     
             <hr class="temcolor1">
            <h5 align="center" class="rounded pt-2 pb-2" ><b>Permission</b></h5>
                       
        
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
                            @if(in_array($permission->description,['List of ROLES'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>

                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                          <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of ROle'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                      <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Edit Role'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                      <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete Role'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                      <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                    <tr>
                    <td><strong>User Details</strong></td>
                         @foreach($permissions as $permission) 
                        
                            @if(in_array($permission->description,['Show User'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                         @endforeach

                         @foreach($permissions as $permission) 
                        
                            @if(in_array($permission->description,['Create User'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                         <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                 
                    
                   
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update User'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                         
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete User'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                   
                      
                      
                  </tr>
                  <tr>
                     <td><strong>Client Details</strong></td>
                         
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Show Client'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                      <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                      
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Creation of Client'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                       <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Modify Client'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                         <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Delete of Client'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                         <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                  </tr>
                  <tr>
                    <td><strong>Order Details</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-view'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Create Order'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Update of Orders1'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Order Delete'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                  </tr>  
                  <tr>
                    <td><strong>Virtual Assistant Details</strong></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.virtual.assistant'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['create.virtual.assistant'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['edit.virtual.assistant'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['delete.virtual.assistant'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                  </tr>  


                        </table>
                         </div>
                  <div class="col-md-6">
                          
                         </div>
                     
               </div>
               <br>
                 <h5  align="center" class="font-weight-bold ">Other Permission</h5>
               <table id="roles" class="" style="width:100%"> 
                <tr>
                  <th style="width: 500px;">Field</th>
                  <th>Modify</th>
                  <th>Show</th>
                  <th>Hide</th>
                     
                </tr>
                 <tr>
                   <td>Client Name</td>
                   <td></td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Show Client Name'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Hide Client Name'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach  
                 </tr>
                    <td>Company Name</td>
                    <td></td>
                      @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Show Company'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach 
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Hide Company'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach 
                     
                 </tr>
                 <tr>
                   <td>Primary Email ID</td>
                   <td></td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['SHOW CLIENT PRIMARY EMAIL'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach 
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['RESTRICT PRIMARY EMAIL'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach 
                 </tr>
                 <tr>
                   <td>File Allocate</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allow-change-allocation'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach 
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allocation-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                          <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           
                        @endforeach 
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allocation-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                         <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach 
                 </tr>
                 
                  <tr>
                    <td>Order Date</td>
                    @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                            @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                               @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-date-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Order Completion Date</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-completion-date-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                       <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                        <tr>
                    <td>Contact</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['contact1_hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                         <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Stitch Count</td>
                          <td></td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['stitch_view'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['stitch_modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       
                  </tr>
                  <tr>
                    <td>File Count</td>
                        <td></td>
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-count-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach

                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-count-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                         
                  </tr>
                   <tr>
                    <td>File Note</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-note-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-note-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                         <td></td>
                  </tr>
                       <tr>
                    <td>File Price</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-price-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-price-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['file-price-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                    <td>Vendor Embroidery Price</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Vendor Emb. Rate Modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['v_emb_rate_show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Vendor Emb Rate Hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                  <td>Vendor File Price /Change Vendor Name</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-modify'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-show'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['vend-file-price-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
               
                    <tr>
                  <td>Execute of Reports</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Execute of Reports'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                       <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       <td></td>
                      <td></td>
                  </tr>

               </table>
               <br>
                 <h5  align="center" class="font-weight-bold ">Status Permission</h5>
               <table id="roles" class="" style="width:100%"> 
                <tr>
                  <th style="width: 500px;">Field</th>
                  <th>Modify</th>
                  <th>Show</th>
                  <th>Hide</th>
                     
                </tr>
                <tr>
                    <td>Status</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['allow modification of order status'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                          @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Only View Order Status'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                      
                           @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['order-status-hide'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <td>Allow Reverse Allocation from QC Pending</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['QC PENDING TO ALLOCATION'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       <td></td>
                       @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['QC PENDING TO ALLOCATION HIDE'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                  </tr>
                  <tr>
                  <td>Allocation to QC Pending</td>
                  
                         @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['alloc-qcpending'] ))
                                   
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                       <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>

                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                           @endforeach
                       <td></td>
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
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
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
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
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
                                     
                                        @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                                     
                             @else
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
                                     
                                  @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                                     
                            @else
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
                            <th>Edit</th>
                          
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>Client Address</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Client Address Show','Client Address Edit','Client State Show','Client State Edit','Vendor Show','Vendor Edit','Company Id Show','Company Id Edit','Digit Rate Show','Digit Rate Edit','Order Us Date Show','Order Us Date Edit','Order Completion Time Show','Order Completion Time Edit','Delay Digitizing','Edit Delay Digitizing','Company Count','Edit Company Count','Delay Vector','Edit Delay Vector','Delay Photoshop','Edit Delay Photoshop','File Name','Edit File Name','File Type','Edit File Type','Client Source Show','Client Source Edit','CSR Person Show','CSR Person Edit','User Summary','User Summary Edit','new client','New Client Edit'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
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
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                       <h5  align="center" class="font-weight-bold ">VA Department</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>  
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>VA Data</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['va.data.show','va.graphics.show','va.operations.show'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->name}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                    </div>
                   </div>
                         <br>
                  <h5  align="center" class="font-weight-bold ">Virtual Assistant</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th style="width: 500px;">Field</th>
                            <th>Show</th>
                            <th>Edit</th>
                          
                           <!--  <th>Delete</th>   -->
                        </tr>
               <?php $row =0; ?>
                        <td>Resource Billing</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->slug,['show.resource.billing','edit.resource.billing','show.generate.invoicing','edit.generate.invoicing','show.currency','edit.currency','show.amont','edit.amont','view.portal','edit.portal','view.portal.password','edit.portal.password','show.department','edit.department','show.seat.slot','edit.seat.slot','show.va.country','edit.va.country','show.va.timezone','edit.va.timezone','show.seat.timing','edit.seat.timing','show.handler1','edit.handler1','show.handler2','edit.handler2','show.resource1','edit.resource1','show.resource2','edit.resource2','show.seat.timining.days','edit.seat.timining.days','show.seat.timining.hours','edit.seat.timining.hours','show.seat.timining.work.time','edit.seat.timining.work.time'] ))
                                      @if($row == 2)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white"></td> -->
                                      @elseif(Auth::user()->levelRolepermission($permission->id,$role->level))
                                        <td>  <i class="fa fa-check-square ml-1" aria-hidden="true" style="color: green;"></i></td>
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white"></td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                      </table>
                      <br>
                   
            </div>

        </div>
    </div>
 </div>

  

 </form>  

