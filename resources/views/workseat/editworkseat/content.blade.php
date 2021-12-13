 @if(Session::has('flash_message'))
   <!--  <div class="alert alert-success mt-1"> -->
        <!-- {{ Session::get('flash_message') }} -->
    <input type="hidden" name="decision" id="decisionid" value="1">
  <!--   </div> -->
@endif
<input type="hidden" name="decision" id="decisionid" value="0">

                        
@if(Session::has('alert-warning'))
    <div class="alert alert-warning mt-1">
        {{ Session::get('flash_message1') }}
    </div>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger mt-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('workseat.updateworkseat')}}" method="post"> 
 <input type="hidden" name="id" value="{{$workseat->id}}">
    @csrf
    <div class="row mt-1">
    <div class="col-md-4">  
        <h4>Edit Virtual Assistant</h4>
    </div>
     <div class="col-md-5">  
       <b>Company Name : {{$company_name}}</b>
     </div>
    <div class="col-md-3">
        <a href="{{route('clients.show',['id'=>$workseat->client_id])}}" class="btn btn-outline btn-danger rightdiv ml-2" id="btncancelid">Cancel</a>
        <button class="btn btn-primary btn-outline rightdiv chkerror">Update</button>
    </div>
 </div>
    <div class="row  mt-1">
  
        <div class="col-md-12" >
            <div class="card temcolor1">
        <div>
           
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                     <div class="col-md-6 pr-1">
                        <div class="input-group my-group">
                            <label class="labcolor mt-1"><b>Select Department : </b></label>
                                <div class="form-check mt-1">&nbsp;
                                @foreach($departments as $department)
                                 @permission('edit.department')
                                   @if(in_array($department,explode(',',$workseat->department)))
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}" checked="">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                   @else
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   @endif
                                 @else
                                   @permission('show.department')
                                     @if(in_array($department,explode(',',$workseat->department)))
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}" checked="" disabled="">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                            <input type="hidden" name="department[]" value="{{$department}}">
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                   @else
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}" disabled="">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   @endif
                                   @else
                                     @if(in_array($department,explode(',',$workseat->department)))
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}" checked="" disabled="">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                            <input type="hidden" name="department[]" value="{{$department}}">
                                        </label>

                                   @else
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="department[]" value="{{$department}}" disabled="">
                                            <span class="form-check-sign"></span>
                                            <span class="" style="color: black;font-size: 15px;"><b>{{$department}}</b></span> 
                                        </label>
                                   @endif

                                   @endpermission

                                 @endpermission
                                @endforeach

                                                
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Seat Slot </label>
                            @permission('edit.seat.slot')
                                <select class="form-control mt-0" name="seatslot"  id="seatslotid">  
                                    
                              @foreach($seatslots as $seatslot ) 

                                 @if($seatslot == $workseat->seatslot) 

                                    <option value="{{$seatslot}}" selected="">{{$seatslot}}</option>
                                 @else    
                                      <option value="{{$seatslot}}">{{$seatslot}}</option>
                                 @endif  
                               @endforeach         
                            @else
                               @permission('show.seat.slot')
                                 <input type="text" name="seatslotss" class="form-control" value="{{$workseat->seatslot}}" disabled="">
                                 <input type="hidden" name="seatslot" value="{{$workseat->seatslot}}">
                               @else
                                <input type="text" name="seatslotss" class="form-control" value="No Permission" disabled="">
                                 <input type="hidden" name="seatslot" value="{{$workseat->seatslot}}">
                               @endpermission 
                            @endpermission 
                                </select>
                                @if($workseat->seatslot == "Custom")
                                    <label class="labcolor mt-1 seatslotclass">No of Hours</label>
                                <input type="text" name="noofhours" value="{{$workseat->noofhours}}" class="form-control seatslotclass" id="noofhoursid">
                                @else

                                <label class="labcolor mt-1 seatslotclass" style="display:none;">No of Hours</label>
                                <input type="text" name="noofhours" value="" class="form-control seatslotclass" id="noofhoursid" style="display:none;">
                                @endif

                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                      <div class="form-group">
                            <label class="labcolor">Country</label>
                         @permission('edit.va.country')
                             <select class="form-control mt-0" name="workcountry" id="workcountryid"> 
                             <option value="{{$workseat->wcountry}}" selected="">{{$workseat->wcountry}}</option>   
                            @foreach($countries as $country ) 

                              @if($country == $workseat->wcountry) 
                                   
                                
                              @else    
                                 <option value="{{$country}}">{{$country}}</option>
                              @endif  
                            @endforeach  
                            </select>
                        @else
                         @permission('show.va.country')
                            <input type="text" name="workcountryss" value="{{$workseat->wcountry}}" class="form-control" disabled="">
                            <input type="hidden" name="workcountry" value="{{$workseat->wcountry}}">
                         @else
                            <input type="text" name="workcountryss" class="form-control" value="No Permission" disabled="">
                            <input type="hidden" name="workcountry" value="{{$workseat->wcountry}}">
                         @endpermission
                        @endpermission
                            <input type="text" name="othercountry" value="" class="form-control mt-1 othercountryclass" id="othercountryid" style="display:none;">
                      </div>
                    </div>
                     <div class="col-md-1 px-1">
                      <div class="form-group">
                            <label class="labcolor">Time Zone</label>
                        @permission('edit.va.country')
                             <select class="form-control mt-0"  name="worktimezone" id="worktimezoneid">     <option value="{{$workseat->wtimezone}}">{{$workseat->wtimezone}}</option> 
                                  
                            </select>
                        @else
                          @permission('show.va.country')
                            <input type="text" name="worktimezoness" value="{{$workseat->wtimezone}}" class="form-control" disabled="">
                            <input type="hidden" name="worktimezone" value="{{$workseat->wtimezone}}">
                          @else
                            <input type="text" name="worktimezoness" class="form-control" value="No Permission" disabled="">
                            <input type="hidden" name="worktimezone" value="{{$workseat->wtimezone}}">
                          @endpermission

                        @endpermission
                            <input type="text" name="othertimezone" value="" class="form-control mt-1 othertimezoneclass" id="othertimezoneid" style="display:none;">
                      </div>
                    </div>
                
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Resource Billing</label>
                        @permission('edit.resource.billing')
                             <select class="form-control mt-0"  name="resourcebilling">         
                                @foreach($resourcebillings as $resourcebilling ) 

                                 @if($resourcebilling == $workseat->billing) 

                                    <option value="{{$resourcebilling}}" selected="">{{$resourcebilling}}</option>
                                 @else    
                                      <option value="{{$resourcebilling}}">{{$resourcebilling}}</option>
                                 @endif  
                        @endforeach 
                            </select>
                            
                        </div>
                    </div>
                @else
                   @permission('show.resource.billing')
                       <input type="text" name="resourcebillingdis" class="form-control" value="{{$workseat->billing}}" disabled="">
                        <input type="hidden" name="resourcebilling" value="{{$workseat->billing}}">
                        </div>
                    </div> 
                   @else
                   <input type="text" name="resourcebillingdis" class="form-control" value="No Permission" disabled="">
                     <input type="hidden" name="resourcebilling" value="{{$workseat->billing}}">
                     </div>
                    </div>
                   @endpermission
                    
                @endpermission
               
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Generate Invoicing</label>
                @permission('edit.generate.invoicing')
                             <select class="form-control mt-0" id="resourceinvoicingid" name="generateinvoicing">    
                                 @foreach($invoicings as $invoicing) 

                                 @if($invoicing == $workseat->invoice) 
                                  
                                    <option value="{{$invoicing}}" selected="">{{$invoicing}}</option>
                                 @else  

                                      <option value="{{$invoicing}}">{{$invoicing}}</option>
                                 @endif  
                               @endforeach     
                            }
                            }
                                      
                            </select>
                        
                @else
                    @permission('show.generate.invoicing')
                        <input type="text" name="generateinvoicingss" class="form-control" value="{{$workseat->invoice}}" disabled="">
                        <input type="hidden" name="generateinvoicing" value="{{$workseat->invoice}}">
                    @else
                      <input type="text" name="generateinvoicing" class="form-control" value="No Permission" disabled="">
                        <input type="hidden" name="generateinvoicing" class="form-control" value="{{$workseat->invoice}}">
                    @endpermission
                @endpermission
                </div>
            </div>
                
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Currency</label>
                    @permission('edit.currency')
                             <select class="form-control mt-0"  name="currency">  
                             @foreach(['US($)','Canadian($)','Australia($)','GBP(£)'] as $currency)
                               @if($currency == $workseat->currency)
                                 <option value="{{$currency}}" selected="">{{$currency}}</option> 
                               @else
                                  <option value="{{$currency}}">{{$currency}}</option>
                               @endif
                               
                             @endforeach     
                            </select>
                     
                @else
                    @permission('edit.currency')
                        <input type="text" name="currency" value="{{$workseat->currency}}" class="form-control" disabled="">
                        <input type="hidden" name="currency" value="{{$workseat->currency}}">
                    @else
                      <input type="text" name="currency" value="No Permission" class="form-control" disabled="">
                        <input type="hidden" name="currency" value="{{$workseat->currency}}">
                    @endpermission
                
                @endpermission
                </div>
            </div>
                
                    <div class="col-md-1 pl-1">
                        <div class="form-group">
                            <label class="labcolor">Amount</label>
                @permission('edit.amont')
                            <input type="text" name="amount" class="form-control" value="{{$workseat->amount}}">
                       
                @else
                    @permission('show.amont')
                     <input type="text" name="amountss" class="form-control" value="{{$workseat->amount}}" disabled="">
                     <input type="hidden" name="amount" value="{{$workseat->amount}}">
                    @else
                     <input type="text" name="amountss" class="form-control" value="-" disabled="">
                     <input type="hidden" name="amount" value="{{$workseat->amount}}">
                    @endpermission
                @endpermission
                        </div>
                    </div>  
                </div>
                <label class="labcolor ml-2"><b>Seat Timing</b></label><span style="font-size: 11px;color: blue;"> (As per the timezone selected above)</span>
               
                 <div class="row">
                          
                   <table class="ml-4" style="width: 100%">
                         <thead>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>
                            <th style="width: 10%"></th>

                         </thead>
                    <tbody>
                    <tr>
                          
                    </tr>
                    <tr>
                      <td> <label class="labcolor">Select Days : </label></td>
                        @foreach($weeknames as $weekname)
                        @permission('edit.seat.timining.days')
                         @if(in_array($weekname,explode(',',$workseat->days)))
                         
                            <td align="center">
                                <div class="form-check mt-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input daysclass" type="checkbox" name="day[]" value="{{$weekname}}" checked="">
                                        <span class="form-check-sign"></span>
                                        <span>{{$weekname}}</span> 
                                    </label>
                                </div>
                            </td>
                          @else
                           
                              <td align="center">
                                <div class="form-check mt-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input daysclass" type="checkbox" name="day[]" value="{{$weekname}}" >
                                        <span class="form-check-sign"></span>
                                        <span>{{$weekname}}</span> 
                                    </label>
                                </div>
                                
                            </td>
                            @endif
                            @else
                             @permission('show.seat.timining.days')
                                @if(in_array($weekname,explode(',',$workseat->days)))
                         
                                    <td align="center">
                                    <div class="form-check mt-2">
                                        <label class="form-check-label">
                                            <input class="form-check-input daysclass" type="checkbox" name="dayss[]" value="{{$weekname}}" checked="" disabled="">
                                            <span class="form-check-sign"></span>
                                            <span>{{$weekname}}</span> 
                                        </label>

                                    </div>
                                    <input type="hidden" name="day[]" value="{{$weekname}}">
                                     </td>
                                @else
                           
                                      <td align="center">
                                        <div class="form-check mt-2">
                                            <label class="form-check-label">
                                                <input class="form-check-input daysclass" type="checkbox" name="dayss[]" value="{{$weekname}}"  disabled="">
                                                <span class="form-check-sign"></span>
                                                <span>{{$weekname}}</span> 
                                            </label>
                                        </div>
                                      
                                    </td>
                                @endif
                             @else
                               <td align="center">
                                <span>No Permission</span> 
                                @if(in_array($weekname,explode(',',$workseat->days)))
                                    <input type="hidden" name="day[]" value="{{$weekname}}">
                                   
                                @else
                                     
                                      
                                @endif
                               
                               </td>
                            @endpermission
                          @endpermission
                         
                        @endforeach
                      

                    </tr>
                    <tr>
                        <td > <label class="labcolor">Number of Hours : </label></td>

                  @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $key=>$day)
                    @permission('edit.seat.timining.hours')
                        @if($hours[$key] != "")
                           <td align="center" ><input type="number" name="hour[]" value="{{$hours[$key]}}" class="ml-3" id="{{$day}}hour" style="width: 40%"></td>
                        @else
                          <td align="center" ><input type="number" name="hour[]" value="{{$hours[$key]}}" class="ml-3 " id="{{$day}}hour" style="width: 40%"></td>
                        @endif
                    @else
                        @permission('show.seat.timining.hours')
                             @if($hours[$key] != "")
                               <td align="center" ><input type="number" name="hourss[]" value="{{$hours[$key]}}" class="ml-3" id="{{$day}}hour" style="width: 40%" disabled=""></td>
                               <input type="hidden" name="hour[]" value="{{$hours[$key]}}" >
                             @else
                              <td align="center" ><input type="number" name="hourss[]" value="{{$hours[$key]}}" class="ml-3 " id="{{$day}}hour" style="width: 40%" disabled=""></td>
                              <input type="hidden" name="hour[]" value="{{$hours[$key]}}">
                             @endif
                        @else
                             @if($hours[$key] != "")
                               <td align="center" ><input type="text" name="hourss[]" value="-" class="ml-3" id="{{$day}}hour" style="width: 40%"></td>
                               <input type="hidden" name="hour[]" value="{{$hours[$key]}}" >
                             @else
                              <td align="center" ><input type="text" name="hourss[]" value="-" class="ml-3 " id="{{$day}}hour" style="width: 40%"></td>
                              <input type="hidden" name="hour[]" value="{{$hours[$key]}}">
                             @endif
                        @endpermission

                    @endpermission

                         
                    @endforeach
                    

                    </tr>
                    <tr>
                        <td > <label class="labcolor">Work Time : </label></td>
                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $key=>$day)
                    @permission('edit.seat.timining.work.time')
                          @if($worktimes[$key] != "")
                              <td align="center"><input  type="time" name="time[]" value="{{$worktimes[$key]}}" class="from-control-3 ml-1 {{$day}}time" style="width: 80%"></td>
                          @else
                              <td align="center"><input  type="time" name="time[]" value="{{$worktimes[$key]}}" class="from-control-3 ml-1 {{$day}}time" style="width: 80%"></td>
                          @endif
                    @else
                        @permission('show.seat.timining.work.time')
                         @if($worktimes[$key] != "")
                              <td align="center"><input  type="time" name="timess[]" value="{{$worktimes[$key]}}" class="from-control-3 ml-1 {{$day}}time" style="width: 80%" disabled=""></td>
                              <input type="hidden" name="time[]" value="{{$worktimes[$key]}}">
                          @else
                              <td align="center"><input  type="time" name="timess[]" value="{{$worktimes[$key]}}" class="from-control-3 ml-1 {{$day}}time" style="width: 80%" disabled=""></td>
                              <input type="hidden" name="time[]" value="{{$worktimes[$key]}}">
                          @endif
                        @else
                          @if($worktimes[$key] != "")
                              <td align="center"><input  type="time" name="timess[]" value="-" class="from-control-3 ml-1 {{$day}}time" style="width: 80%" disabled=""></td>
                              <input type="hidden" name="time[]" value="{{$worktimes[$key]}}">
                          @else
                              <td align="center"><input  type="time" name="timess[]" value="-" class="from-control-3 ml-1 {{$day}}time" style="width: 80%" disabled=""></td>
                              <input type="hidden" name="time[]" value="{{$worktimes[$key]}}">
                          @endif
                        @endpermission

                    @endpermission
                    @endforeach
                      

                    </tr>
                     <!-- <tr>
                        <td > <label class="labcolor">Indian Work Time : </label></td>
                        <td ></td> <td ></td> <td ></td> <td ></td> <td ></td> <td ></td> <td></td>

                    </tr> -->
                </tbody>
                   </table>
                    
                       
                 </div>  
                 
            </div>
        </div>
        @permission('edit.portal')
            <h5 align="center" class="mt-2"><b>Portal Detail</b></h5>

            <div  id="portalid">
         @for($i=0;$i< count($portals['media_type']);$i++)
            <div class="row card-body">
            
              <div class="col-md-2 pr-1">
                  <label>Portal Name</label>
                  <input type="text" class="form-control" name="media_type[]" value="{{$portals['media_type'][$i]}}" >
              </div>

              <div class="col-md-2 px-1">
                <label>Portal Url</label>
                <input type="text" class="form-control" name="portal_url[]" value="{{$portals['portal_url'][$i]}}" >
              </div>
            @permission('edit.portal.password')
               <div class="col-md-2 px-1">
                <label>User Name</label>
                <input type="text" class="form-control" name="username[]" value="{{$portals['portal_username'][$i]}}" >
               </div>
               <div class="col-md-2 px-1">
                <label>Password</label>
                <input type="text" class="form-control" name="password[]" value="{{$portals['portal_password'][$i]}}" >
               </div>
            @else
              @permission('show.portal.password')
                <div class="col-md-2 px-1">
                <label>User Name</label>
                <input type="text" class="form-control" name="usernamess[]" value="{{$portals['portal_username'][$i]}}" disabled="">
                <input type="hidden" name="username[]" value="{{$portals['portal_username'][$i]}}">
               </div>
               <div class="col-md-2 px-1">
                <label>Password</label>
                <input type="text" class="form-control" name="passwordss[]" value="{{$portals['portal_password'][$i]}}" disabled="">
                <input type="hidden" name="password[]" value="{{$portals['portal_password'][$i]}}">
               </div>
               @else
                  <input type="hidden" name="username[]" value="{{$portals['portal_username'][$i]}}">
                  <input type="hidden" name="password[]" value="{{$portals['portal_password'][$i]}}">
               @endpermission
            @endpermission  
               <div class="col-md-4 pl-1">
                <label>Detail</label>
                <textarea class="form-control form-control2" name="portaldetail[]">{{$portals['portal_detail'][$i]}}</textarea>
               </div>
              </div>
         @endfor
            </div>
     
            <div class="row">
              <div class="col-md-2 ml-3">
                  <a href="javascript:void(0)" class="btn btn-outline btn-success btn-sm" id="addportalid">Add Portal</a>
              </div>
            </div>
        @else
         @permission('view.portal')
         <h5 align="center" class="mt-2"><b>Portal Detail</b></h5>

            <div  id="portalid">
         @for($i=0;$i< count($portals['media_type']);$i++)
            <div class="row card-body">
            
              <div class="col-md-2 pr-1">
                  <label>Portal Name</label>
                  <input type="text" class="form-control" name="media_typess[]" value="{{$portals['media_type'][$i]}}" disabled="">
                  <input type="hidden" name="media_typess[]" value="{{$portals['media_type'][$i]}}">
              </div>

              <div class="col-md-2 px-1">
                <label>Portal Url</label>
                <input type="text" class="form-control" name="portal_urlss[]" value="{{$portals['portal_url'][$i]}}" disabled="">
                <input type="hidden" name="portal_url[]" value="{{$portals['portal_url'][$i]}}">
              </div>
            @permission('edit.portal.password')
               <div class="col-md-2 px-1">
                <label>User Name</label>
                <input type="text" class="form-control" name="username[]" value="{{$portals['portal_username'][$i]}}" >
               </div>
               <div class="col-md-2 px-1">
                <label>Password</label>
                <input type="text" class="form-control" name="password[]" value="{{$portals['portal_password'][$i]}}" >
               </div>
            @else
              @permission('view.portal.password')
                <div class="col-md-2 px-1">
                <label>User Name</label>
                <input type="text" class="form-control" name="usernamess[]" value="{{$portals['portal_username'][$i]}}" disabled="">
                <input type="hidden" name="username[]" value="{{$portals['portal_username'][$i]}}">
               </div>
               <div class="col-md-2 px-1">
                <label>Password</label>
                <input type="text" class="form-control" name="passwordss[]" value="{{$portals['portal_password'][$i]}}" disabled="">
                <input type="hidden" name="password[]" value="{{$portals['portal_password'][$i]}}">
               </div>
               @else
                  <input type="hidden" name="username[]" value="{{$portals['portal_username'][$i]}}">
                  <input type="hidden" name="password[]" value="{{$portals['portal_password'][$i]}}">
               @endpermission
            @endpermission  
               <div class="col-md-4 pl-1">
                <label>Detail</label>
                <textarea class="form-control form-control2" name="portaldetailss[]" disabled="">{{$portals['portal_detail'][$i]}}</textarea>
                <input type="hidden" name="portaldetail[]" value="{{$portals['portal_detail'][$i]}}">
               </div>
              </div>
         @endfor
            </div>
         @else
            @for($i=0;$i< count($portals['media_type']);$i++)
             <input type="hidden" name="media_typess[]" value="{{$portals['media_type'][$i]}}">
             <input type="hidden" name="portal_url[]" value="{{$portals['portal_url'][$i]}}">
             <input type="hidden" name="username[]" value="{{$portals['portal_username'][$i]}}">
             <input type="hidden" name="password[]" value="{{$portals['portal_password'][$i]}}">
             <input type="hidden" name="portaldetail[]" value="{{$portals['portal_detail'][$i]}}">
            @endfor   
         @endpermission
        @endpermission
            <h5 align="center" class="mt-2"><b>Managing User</b></h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <label class="labcolor">HANDLER 1</label>
                        @permission('edit.handler1')
                             <select class="form-control mt-0"  name="csr1" id="csr1id">
                              <option value="">SELECT HANDLER 1</option>
                              {{$checkc=0}}

                                @foreach($csrs as $csr)
                                @if($checkc == 0)
                                   <optgroup label="{{ucfirst(trans($csr->rolename))}}">
                                    {{$rolenameis=$csr->rolename}}
                                    {{$checkc=1}}
                                @endif
                                @if($rolenameis != $csr->rolename )
                                </optgroup>
                                  <optgroup label="{{ucfirst(trans($csr->rolename))}}">
                                    {{$rolenameis=$csr->rolename}}
                                @endif

                                @if($csr->id == $workseat->csr1)
                                 <option value="{{$csr->id}}" selected="">{{$csr->name}}</option>
                                @else
                                 <option value="{{$csr->id}}">{{$csr->name}}</option>
                                @endif
                                @endforeach 
                                </optgroup>       
                                     
                            </select>
                        @else
                          @permission('show.handler1')
                            @foreach($csrs as $csr)
                               @if($csr->id == $workseat->csr1)
                               <input type="text" name="csr1ss" class="form-control" value="{{$csr->name}}" disabled="">
                               @endif
                            @endforeach
                            
                            <input type="hidden" name="csr1" value="{{$workseat->csr1}}">
                          @else
                            <input type="text" name="csr1ss" class="form-control" value="No Permission" disabled="">
                            <input type="hidden" name="csr1" value="{{$workseat->csr1}}">
                          @endpermission
                        @endpermission
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label class="labcolor">HANDLER 2</label>
                        @permission('edit.handler2')
                             <select class="form-control mt-0"  name="csr2" > 
                              <option value="">SELECT HANDLER 2</option>  
                               {{$checkc=0}}

                                @foreach($csrs as $csr)
                                @if($checkc == 0)
                                   <optgroup label="{{ucfirst(trans($csr->rolename))}}">
                                    {{$rolenameis=$csr->rolename}}
                                    {{$checkc=1}}
                                @endif
                                @if($rolenameis != $csr->rolename )
                                </optgroup>
                                  <optgroup label="{{ucfirst(trans($csr->rolename))}}">
                                    {{$rolenameis=$csr->rolename}}
                                @endif

                                  @if($csr->id == $workseat->csr2)
                                    <option value="{{$csr->id}}" selected="">{{$csr->name}}</option>
                                 @else
                                    <option value="{{$csr->id}}">{{$csr->name}}</option>
                                 @endif
                                @endforeach 
                                </optgroup>      
                                @foreach($csrs as $csr)
                                 
                                @endforeach      
                            </select>
                        @else
                         @permission('show.handler2')
                         <span style="display: none;">{{$vhandler2 = 0}}</span>
                           @foreach($csrs as $csr)
                               @if($csr->id == $workseat->csr2)
                               <input type="text" name="csr1ss" class="form-control" value="{{$csr->name}}" disabled="">
                               @else
                                    <span style="display: none;">{{$vhandler2++}}</span>
                               @endif
                            @endforeach
                            @if($vhandler2 != 0)
                                <input type="text" name="csr1ss" class="form-control" value="Not Selected" disabled="">
                            @endif
                            <input type="hidden" name="csr2" value="{{$workseat->csr2}}">
                          @else
                           <input type="text" name="csr1ss" class="form-control" value="No Permission" disabled="">
                           <input type="hidden" name="csr2" value="{{$workseat->csr2}}">
                          @endpermission
                         @endpermission
                        </div>
                    </div>
                     <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label class="labcolor">RESOURCE 1</label>
                          @permission('edit.resource1')
                             <select class="form-control mt-0"  name="emp1" id="emp1id">
                               <option value="">Select RESOURCE 1</option>
                               {{$check=0}}

                                @foreach($emps as $emp)
                                @if($check == 0)
                                   <optgroup label="{{ucfirst(trans($emp->rolename))}}">
                                    {{$rolenameis=$emp->rolename}}
                                    {{$check=1}}
                                @endif
                                @if($rolenameis != $emp->rolename )
                                </optgroup>
                                  <optgroup label="{{ucfirst(trans($emp->rolename))}}">
                                    {{$rolenameis=$emp->rolename}}
                                @endif

                                 @if($emp->id == $workseat->emp1)
                                    <option value="{{$emp->id}}" selected="">{{$emp->name}}</option>
                                 @else
                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                 @endif
                                @endforeach 
                                </optgroup>
                                           
                            </select>
                         @else
                            @permission('show.resource1')
                               @foreach($emps as $emp)
                                 @if($emp->id == $workseat->emp1)
                                   <input type="text" name="emp1ss" value="{{$emp->name}}" class="form-control" disabled="">
                                 @endif
                               @endforeach
                                
                                <input type="hidden" name="emp1ss" value="{{$workseat->emp1}}" >
                            @else
                                <input type="text" name="emp1ss" value="No permission" class="form-control" disabled="">
                                <input type="hidden" name="emp1" value="{{$workseat->emp1}}" >
                            @endpermission
                         @endpermission
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group ">
                            <label class="labcolor">RESOURCE 2</label>
                        @permission('edit.resource2')
                             <select class="form-control mt-0"  name="emp2"> 
                               <option value="">Select RESOURCE 2</option>
                               {{$check=0}}

                                @foreach($emps as $emp)
                                @if($check == 0)
                                   <optgroup label="{{ucfirst(trans($emp->rolename))}}">
                                    {{$rolenameis=$emp->rolename}}
                                    {{$check=1}}
                                @endif
                                @if($rolenameis != $emp->rolename )
                                </optgroup>
                                  <optgroup label="{{ucfirst(trans($emp->rolename))}}">
                                    {{$rolenameis=$emp->rolename}}
                                @endif

                                 @if($emp->id == $workseat->emp2)
                                    <option value="{{$emp->id}}" selected="">{{$emp->name}}</option>
                                 @else
                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                 @endif
                                
                                @endforeach 
                                </optgroup>
                                 
                            </select>
                        @else
                          @permission('show.resource2')
                          <span style="display: none;">{{$vhandler2 = 0}}</span>
                            @foreach($emps as $emp)
                                @if($emp->id == $workseat->emp2)
                                 <input type="text" name="emp2ss" class="form-control" disabled=""  value="{{$emp->name}}">
                                @else
                                <span style="display: none;">{{$vhandler2++}}</span>
                                @endif
                            @endforeach
                             @if($vhandler2 != 0)
                               <input type="text" name="emp2ss" class="form-control" disabled=""  value="Not Selected">
                             @endif
                            <input type="hidden" name="emp2" value="{{$workseat->emp2}}">
                          @else
                          <input type="text" name="emp2ss" class="form-control" disabled=""  value="No Permission">
                            <input type="hidden" name="emp2" value="{{$workseat->emp2}}">
                          @endpermission
                        @endpermission
                        </div>
                    </div>
               
                </div>
            </div>


</div>
</form>
<!-- workseat activity log table -->
<br>
<br>
@permission('view.virtual.assistant.log')
<h5 align="center"><b style="text-align: center;"class="ts">Activity Logs</b></h5>
<div class="table-responsive">
<table id="table_history" class="table table-bordered table-striped" style="width: 100%;table-layout: fixed;word-wrap: break-word; ">
   <thead  style="">
      <th class="text-center" >User</th>
      <th class="text-center">File Detail</th>
      <th class="text-center">Updated Column</th>
      <th class="text-center">Old Value</th>
      <th class="text-center">New Value</th>
      <th class="text-center text-nowrap">Updated At</th>
   </thead>
  <tbody>
    
       @php  $rows=0 @endphp 
       @if(isset($cols['updated_by']))     
       {{ $rows =  count($cols['updated_by']) }}
       @endif
       

       @for($i=0; $i< $rows; $i++)
              
              @if(isset( $cols['old_values'][$i]))

              <tr><td>
                {!!  $cols['updated_by'][$i] !!}
              </td><td>  
                {!!  $cols['note'][$i] !!}
              </td><td>
                {!!  $cols['columns_updated'][$i] !!} 
            
              </td><td>
            
                {!!  $cols['old_values'][$i] !!} 
            
              </td><td>
               
               
                {!!  $cols['new_values'][$i] !!}    
               
              </td><td class="text-nowrap">
                {{ $cols['updated_at'][$i] }}
              </td></tr>
              
               @endif
           
       @endfor  
       
  </tbody>

</table>

</div>
@endpermission