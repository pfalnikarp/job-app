 @if(Session::has('flash_message'))
    <!-- <div class="alert alert-success mt-1"> -->
        <!-- {{ Session::get('flash_message') }} -->
        <input type="hidden" name="decision" id="decisionid" value="1">
    <!-- </div> -->
@endif
<input type="hidden" name="decision" id="decisionid" value="0">

                        
@if(Session::has('alert-warning'))
    <div class="alert alert-warning">
        {{ Session::get('flash_message1') }}
    </div>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('workseat.workseatstore')}}" method="post" id="register"> 
  <input type="hidden" name="client_id" value="{{$clients->id}}">
    @csrf
    <div class="row">
    <div class="col-md-4">  
        <h4>Add Virtual Assistant</h4>
    </div>
     <div class="col-md-5 ">
       
    </div>
    <div class="col-md-3">
         <a href="{{route('clients.show',['id'=>$clients->id])}}" class="btn btn-danger btn-outline ml-2 rightdiv" id="btncancelid">Cancel</a>
        <button class="btn btn-success btn-outline rightdiv" id="chkerror">Save</button>
      
     
      
    </div>
 </div>
    <div class="row  mt-2">
  
        <div class="col-md-12" >
            <div class="card temcolor1">
        <div>
           
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                     <div class="col-md-6 pr-1">
                        <div class="input-group my-group">
                            <label class="labcolor mt-1"><b>Select Department<span style='color: red'>*</span>: </b></label>
                                     <div class="form-check mt-1">&nbsp;
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="department[]" value="Graphics">
                                                        <span class="form-check-sign"></span>
                                                         <span class="" style="color: black;font-size: 15px;"><b>Graphics</b></span> 
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="department[]" value="Data">
                                                        <span class="form-check-sign"></span>
                                                          <span class="mb-2" style="color: black;font-size: 15px;"><b>Data</b></span> 
                                                         
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="department[]" value="Operations">
                                                        <span class="form-check-sign"></span>
                                                          <span class="mb-2" style="color: black;font-size: 15px;"><b>Operations</b></span>
                                                    </label>
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
                                <select class="form-control mt-0" name="seat_slot" id="seatslotid">
                                    <option value="Part Time">Part Time</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Custom">Custom</option>  
                                </select>
                                 <label class="labcolor mt-1 seatslotclass" style="display:none;">No of Hours</label>
                                <input type="text" name="noofhours" value="" class="form-control seatslotclass" id="noofhoursid" style="display:none;">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                      <div class="form-group">
                            <label class="labcolor">Country<span style='color: red'>*</span></label>
                             <select class="form-control mt-0" name="workcountry" id="workcountryid" > 
                                 <option value="">Select Country</option>    
                                 <option value="US">US</option>
                                 <option value="UK">UK</option> 
                                 <option value="CANADA">CANADA</option>
                                 <option value="AUSTRALIA">AUSTRALIA</option> 
                                 <option value="NEW ZEALAND">NEW ZEALAND</option>
                                 <option value="Other">Other</option>     
                            </select>
                           
                                <input type="text" name="othercountry" value="" class="form-control mt-1 othercountryclass" id="othercountryid" style="display:none;">
                      </div>
                    </div>
                     <div class="col-md-1 px-1">
                      <div class="form-group">
                            <label class="labcolor">Ti. Zone<span style='color: red'>*</span></label>
                             <select class="form-control mt-0"  name="worktimezone" id="worktimezoneid">         
                                    <option value="">none</option>
                                     
                            </select>
                                <input type="text" name="othertimezone" value="" class="form-control mt-1 othertimezoneclass" id="othertimezoneid" style="display:none;">
                      </div>
                    </div>
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Resource Billing<span style='color: red'>*</span></label>
                             <select class="form-control mt-0"  name="resourcebilling" id="resourcebillingid">       <option value="">Select Billing</option> 
                                    <option value="Hourly">Hourly</option>
                                    <option value="Weekly">Weekly</option> 
                                    <option value="Monthly">Monthly</option>  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Generate Invoicing<span style='color: red'>*</span></label>
                             <select class="form-control mt-0" id="resourceinvoicingid" name="generateinvoicing"> 
                                    <option value="">Select Invoicing</option>        
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Bi-Weekly">Bi-Weekly</option>  
                                    <option value="Monthly">Monthly</option>  
                            </select>
                        </div>
                    </div>
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Currency<span style='color: red'>*</span></label>
                             <select class="form-control mt-0"  name="currency" id="currencyid">        <option value="">Select Currency</option>  
                                    <option value="US($)">US($)</option>
                                    <option value="Canadian($)">Canadian($)</option> 
                                    <option value="Australia($)">Australia($)</option> <option value="GBP(£)">GBP(£)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 pl-1">
                        <div class="form-group">
                            <label class="labcolor">Amount<span style='color: red'>*</span></label>
                            <input type="text" name="amount" class="form-control" id="amountid" required="">
                        </div>
                    </div>
               
                    
                </div>
                <label class="labcolor ml-2"><b>Seat Timing</b></label><span style="font-size: 11px; color: blue;"> (As per the timezone selected above)</span>
               
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
                        <td> <label class="labcolor">Select Days: </label></td>
                       <td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input daysclass" type="checkbox" name="day[]" value="Monday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Monday</span> 
                                                    </label></div></td> <td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input daysclass" type="checkbox"  name="day[]" value="Tuesday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Tuesday</span> 
                                                    </label></div></td><td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"  name="day[]" value="Wednesday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Wednesday</span> 
                                                    </label></div></td> <td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"  name="day[]" value="Thursday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Thursday</span> 
                                                    </label></div></td><td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"  name="day[]" value="Friday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Friday</span> 
                                                    </label></div></td><td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"  name="day[]" value="Saturday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Saturday</span> 
                                                    </label></div></td> <td align="center"><div class="form-check mt-2">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"  name="day[]" value="Sunday">
                                                        <span class="form-check-sign"></span>
                                                         <span >Sunday</span> 
                                                    </label></div></td>

                    </tr>
                    <tr>
                        <td > <label class="labcolor">Number of Hours: </label></td>
                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                          <td align="center" ><input type="number" name="hour[]" value="" class="ml-3 " id="{{$day}}hour" style="width: 40%" ></td>
                    @endforeach

                      

                    </tr>
                    <tr>
                        <td > <label class="labcolor">Work Time: </label></td>
              @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                  <td align="center"><input  type="time" name="time[]" value="" class="from-control-3 ml-1 {{$day}}time" style="width: 70%"></td>
              @endforeach
                       

                    </tr>
                     <tr>
                     <!--    <td > <label class="labcolor">Indian Work Time : </label></td>
                        <td ></td> <td ></td> <td ></td> <td ></td> <td ></td> <td ></td> <td></td> -->

                    </tr>
                </tbody>
                   </table>
                    
                       
                 </div>  
                 
            </div>
        </div>
     
            <h5 align="center" class="mt-2"><b>Portal Detail</b></h5>
            <div  id="portalid">
            <div class="row card-body">
              <div class="col-md-2 pr-1">
                <label>Portal Name</label>
                <input type="text" class="form-control" name="media_type[]" value="" >
              </div>
              <div class="col-md-2 px-1">
                <label>Portal Url</label>
                <input type="text" class="form-control" name="portal_url[]" value="" >
              </div>
               <div class="col-md-2 px-1">
                <label>User Name</label>
                <input type="text" class="form-control" name="username[]" value="" >
               </div>
               <div class="col-md-2 px-1">
                <label>Password</label>
                <input type="text" class="form-control" name="password[]" value="" >
               </div>
               
               <div class="col-md-4 pl-1">
                <label>Detail</label>
                <textarea class="form-control form-control2" name="portaldetail[]"></textarea>
               </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 ml-3">
                  <a href="javascript:void(0)" class="btn btn-outline btn-success btn-sm" id="addportalid">Add Portal</a>
              </div>
            </div>

            <h5 align="center" class="mt-2"><b>Managing User</b></h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Handler 1<span style='color: red'>*</span></label>
                             <select class="form-control mt-0"  name="csr1" id="csr1id">
                              <option value="">Select Handler 1</option>  
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

                                 <option value="{{$csr->id}}">{{$csr->name}}</option>
                                @endforeach 
                                </optgroup>   
                                     
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Handler 2</label>
                             <select class="form-control mt-0"  name="csr2"> 
                              <option value="">Select Handler 2</option>        
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

                                 <option value="{{$csr->id}}">{{$csr->name}}</option>
                                @endforeach 
                                </optgroup>       
                            </select>
                        </div>
                    </div>
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Resource 1<span style='color: red'>*</span></label>
                             <select class="form-control mt-0"  name="emp1" id="emp1id">
                               <option value="">Select Resource 1</option>
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

                                 <option value="{{$emp->id}}">{{$emp->name}}</option>
                                @endforeach 
                                </optgroup>

                                  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group ">
                            <label class="labcolor">Resource 2</label>
                             <select class="form-control mt-0"  name="emp2"> 
                               <option value="">Select Resource 2</option>
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

                                 <option value="{{$emp->id}}">{{$emp->name}}</option>
                                @endforeach 
                                </optgroup>
                            </select>
                        </div>
                    </div>
               
                </div>
            </div>


</div>
</form>