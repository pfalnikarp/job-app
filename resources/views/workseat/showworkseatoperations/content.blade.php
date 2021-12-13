 <div class="row mt-1 mb-1">
    <div class="col-md-4">  
        <h4>View Virtual Assistant</h4>
    </div>
     <div class="col-md-5">  
         <b>Company Name : {{$company_name}}</b>
    </div>
    <div class="col-md-3">
        <a href="javascript:history.go(-1)" class="btn btn-primary btn-outline ml-2 rightdiv">Back</a>
        
    </div>
 </div>

<div class="card temcolor1">
  <div class="card-body">
    
 
      <div class="card s">
        <div class="card-body ">
            <h5 align="center" class="ts"><b>Virtual Assistant Information</b></h5>
        <div class="row"> 
          <div class="col-md-3">
            <div class="form-group">
              <h5><label class="labviewcolor">Department : </label>
              @permission('show.department')
              <span class="spantext">{{$workseat->department}}</span></h5>
              @else
              <span class="spantext">No Permission</span></h5>
              @endpermission
              <h5><label class="labviewcolor">Seat Slot : </label>
              @permission('show.seat.slot')
              <span class="spantext">{{$workseat->seatslot}}</span></h5>
              @else
              <span class="spantext">No Permission</span></h5>
              @endpermission
              @if($workseat->seatslot == 'Custom')
                   <h5><label class="labviewcolor">No of Hours : </label>
                @permission('show.seat.timing')
                  <span  class="spantext">{{$workseat->noofhours}}</span></h5>
                @else
                  <span class="spantext">No Permission</span></h5>
                @endpermission
              @else
               <h5><label class="labviewcolor">Created : </label>
              <span class="spantext">{{$workseat->created_at}}</span></h5>
              @endif
              
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <h5><label class="labviewcolor">Country : </label>
            @permission('show.va.country')
                <span class="spantext">{{$workseat->wcountry}}</span></h5>
            @else
                  <span class="spantext">No Permission</span></h5>
            @endpermission 
                <h5><label class="labviewcolor">Time zone : </label>
            @permission('show.va.timezone')    
                <span  class="spantext">{{$workseat->wtimezone}}</span></h5>
            @else
                  <span class="spantext">No Permission</span></h5>
            @endpermission
                @if($workseat->seatslot == 'Custom')
                 <h5><label class="labviewcolor">Created : </label>
                 <span class="spantext">{{$workseat->created_at}}</span></h5>
                @endif
                 
            </div>
          </div>
          <div class="col-md-3">
          <div class="form-group">
         
                <h5><label class="labviewcolor">Billing : </label>
             @permission('show.resource.billing')
                <span  class="spantext">{{$workseat->billing}}</span></h5>
             @else
                  <span class="spantext">No Permission</span></h5>
             @endpermission
          
         
            <h5><label class="labviewcolor">Invoice : </label>
          @permission('show.generate.invoicing')  
             <span class="spantext">{{$workseat->invoice}}</span></h5>
           @else
             <span class="spantext">No Permission</span></h5>
          @endpermission 
          
          </div>
           </div>
           <div class="col-md-3">
          <div class="form-group">
              
            <h5><label class="labviewcolor">Currency : </label>
          @permission('show.currency') 
            <span class="spantext">{{$workseat->currency}}</span></h5> 
          @else
             <span class="spantext">No Permission</span></h5>
          @endpermission 
         
            <h5><label class="labviewcolor">Amount : </label>
          @permission('show.amont') 
            <span class="spantext">{{$workseat->amount}}</span></h5>
          @else
             <span class="spantext">No Permission</span></h5>
          @endpermission 
          </div>
           </div>
       </div>
    
  </div>
 </div>
      <div class="card s">
      <div class="card-body ">
        <h5 align="center" class="ts"><b>Seat Timing</b><span style="font-size: 11px;color: blue;"> (As per above timezone)</span></h5>
        <div class="row"> 
            <table class="ml-3" style="width: 100%">
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
                      <td> <label class="labviewcolor">Select Days: </label></td>
                       @permission('show.seat.timining.days')
                        @foreach($weeknames as $weekname)
                         @if(in_array($weekname,explode(',',$workseat->days)))
                            <td align="center">
                              
                                    <span class="spantext">{{$weekname}}</span> 
                                   
                            </td>
                         @else
                            <td align="center">
                              
                                                              
                            </td>
                         @endif
                        @endforeach
                      

                    </tr>
                @else
                   <td> <span class="spantext">No Permission</span></h5></td>
                @endpermission
                    <tr>
                        <td > <label class="labviewcolor">Number of Hours:</label></td>
                    @permission('show.seat.timining.hours')
                        @for($i=0;$i<7;$i++)
                             <td align="center"><span class="spantext">{{$hours[$i]}}</span></td>
                        @endfor
                    @else
                      <td> <span class="spantext">No Permission</span></h5></td>
                    @endpermission

                    </tr>
                    <tr>
                        <td > <label class="labviewcolor">Work Time : </label></td>
                      @permission('show.seat.timining.work.time')
                        @for($i=0;$i<7;$i++)
                             <td align="center" ><span class="spantext">{{$worktimes[$i]}}</span></td>
                        @endfor
                      @else
                          <td> <span class="spantext">No Permission</span></h5></td>
                      @endpermission
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
      <div class="card s">
      <div class="card-body ">
        <h5 align="center" class="ts"><b>Managing User</b></h5>
        <div class="row"> 
          <div class="col-md-6">
            <h5><label class="labviewcolor">Handler 1: </label>
            @permission('show.handler1')
               @foreach($csrs as $csr)
                @if($csr->id == $workseat->csr1)
                  <span class="spantext"> {{$csr->name}}</span></h5>
                @else
                 
                @endif
               @endforeach  
            @else
              <span class="spantext">No Permission</span></h5>
            @endpermission   
         
            <h5><label class="labviewcolor">Handler 2 : </label>
            @permission('show.handler2')
               @foreach($csrs as $csr)
                @if($csr->id == $workseat->csr2)
                  <span class="spantext"> {{$csr->name}}</span></h5>
                @else
                
                @endif
               @endforeach
            @else
              <span class="spantext">No Permission</span></h5>
            @endpermission
          </div> 
          <div class="col-md-6">
            <h5><label class="labviewcolor">Resource 1 : </label>
            @permission('show.resource1')
              @foreach($emps as $emp)
                @if($emp->id == $workseat->emp1)
                  <span class="spantext"> {{$emp->name}}</span>
                @else
                 
                @endif
                                
              @endforeach
            @else
              <span class="spantext">No Permission</span></h5>
            @endpermission   
            <h5><label class="labviewcolor">Resource 2 : </label>
            @permission('show.resource2')
              @foreach($emps as $emp)
                @if($emp->id == $workseat->emp2)
                  <span class="spantext"> {{$emp->name}}</span>
                @else
              
                @endif             
              @endforeach 
            @else
              <span class="spantext">No Permission</span></h5>
            @endpermission  
          </div>       
        </div>
      </div>
      </div> 

  @permission('view.portal') 
      <div class="card s">
      <div class="card-body ">
        <h5 align="center" class="ts"><b>Portal Detail</b></h5>
        <div class="row"> 
         @for($i=0;$i< count($portals['media_type']);$i++)
          <div class="col-md-6">
            <h5  class="ts"><b>Portal{{$i+1}}</b></h5>
            <h5><label class="labviewcolor">Portal Name : </label>
            <span class="spantext">{{$portals['media_type'][$i]}}</span></h5>

            <h5><label class="labviewcolor">Portal Url : </label>
            <span class="spantext">{{$portals['portal_url'][$i]}}</span></h5>
    @permission('view.portal.password') 
            <h5><label class="labviewcolor">User Name : </label>
            <span class="spantext">{{$portals['portal_username'][$i]}}</span></h5>
       
            <h5><label class="labviewcolor">Password : </label>
            <span class="spantext">{{$portals['portal_password'][$i]}}</span></h5>
    @endpermission  
            <h5><label class="labviewcolor">Deatail : </label>
            <span class="spantext">{{$portals['portal_detail'][$i]}}</span></h5>
          </div> 
         @endfor      
        </div>
      </div>
      </div>
  @endpermission   
 </div>
</div>
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
                {!! $cols['updated_at'][$i] !!}
              </td></tr>
              
               @endif
           
       @endfor  
       
  </tbody>

</table>

</div>

@endpermission

