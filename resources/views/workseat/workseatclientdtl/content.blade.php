 <div class="row">
    <div class="col-md-3">  
        <h3>View Client</h3>
    </div>
    <div class="col-md-9 mt-3">
        <a href="javascript:history.go(-1)" class="btn btn-success btn-outline ml-2 rightdiv">Back</a>
        
    </div>
 </div>

<div class="card temcolor1">

 
<div class="card-body">
  <div class="row"> 
   <div class="col-md-5 px-2">
    <div class="card s">
      <div class="card-body ">
        <h5 align="center" class="ts"><b>Client Information</b></h5>
        <h5><label class="labviewcolor">Company Name : </label>
        <span class="spantext">{{$clientdtl->client_company}}</span></h5>
        <h5><label class="labviewcolor">Client Name : </label>
        <span class="spantext">{{$clientdtl->client_name}}</span></h5>
        <h5><label class="labviewcolor">Designation : </label>
        <span class="spantext">{{$clientdtl->designation}}</span></h5>
        <h5><label class="labviewcolor">Linkedin Url : </label>
        <span class="spantext">{{$clientdtl->linkedin_url}}</span></h5>
        <h5><label class="labviewcolor">Created : </label>
        <span class="spantext">{{$clientdtl->created_at}}</span></h5>
        <h5><label class="labviewcolor">Client Note : </label>
        <span  class="spantext">{{$clientdtl->client_note}}</span></h5>  
        <h5><label class="labviewcolor">Client Specificatin : </label>
        <span  class="spantext">{{$clientdtl->self_client_specification}}</span></h5>              
       </div>
     </div>
  </div>
  <div class="col-md-3 px-0">
    <div class="card s">
      <div class="card-body ">
          <h5 align="center" class="ts"><b>Client Contact</b></h5>
     
        <h5 align="center"><label class="labviewcolor">email</label></h5>
      @permission('show.primary-email')
        @php
            $a=1;
        @endphp
            @foreach(explode(",",$clientdtl->client_email_primary) as $compemailarray)  
                      <h5><span class="spantext">{{$a++}}) {{$compemailarray}}</span></h5>
            @endforeach
      @else
             <h5><span class="spantext">No Permission</span></h5>
      @endpermission 
        <h5 align="center"><label class="labviewcolor">Phone</label></h5>
      @permission('contact1.show')
        @php
            $b=1;
        @endphp
            @foreach(explode(",",$clientdtl->client_contact_1) as $compephonrarray)
                      <h5><span class="spantext">{{$b++}}) {{$compephonrarray}}</span></h5>
            @endforeach
      @else
            <h5><span class="spantext">No Permission</span></h5>
      @endpermission 
      </div>
     </div>
      <h5><label class="labviewcolor">BlackList : </label>
          <span>{{$clientdtl->black_list}}</span></h5>
      <h5><label class="labviewcolor">Black Reason : </label> 
          <span>{{$clientdtl->black_list_reason}}</span></h5> 
  </div>
  <div class="col-md-4 px-2">
    <div class="card s">
      <div class="card-body ">
         <h5 align="center" class="ts"><b>Client Address</b></h5>
        @permission('client.address.show') 
          <h5><label class="labviewcolor">Unit No : </label>
          <span class="spantext">{{$clientdtl->cunitno}}</span></h5> 
          <h5><label class="labviewcolor">Street Name : </label>
          <span class="spantext">{{$clientdtl->cstreetname}}</span></h5>
          <h5><label class="labviewcolor">Address Line2 : </label>
          <span>{{$clientdtl->client_address_line2}}</span></h5>
          <h5><label class="labviewcolor">Country : </label>
          <span class="spantext">{{$clientdtl->ccountry}}</span></h5>  
          <h5><label class="labviewcolor">State : </label>
          <span class="spantext">{{$clientdtl->cstate}}</span></h5>
          <h5><label class="labviewcolor">City/County : </label>
          <span class="spantext">{{$clientdtl->city}}</span></h5> 
          <h5><label class="labviewcolor">Zip Code : </label>
          <span class="spantext">{{$clientdtl->czipcode}}</span></h5> 
          <h5><label class="labviewcolor">Time Zone : </label>
          <span class="spantext">{{$clientdtl->timezone_type}}</span> </h5>
        @else
              <h5 align="center"><span class="spantext">No Permission</span></h5>
        @endpermission
      </div>
     </div>
  </div>
 </div>
<!-- end company id -->

 <!-- end client id -->

   <!-- end fix seat -->
  

<!-- client specification modal popup -->
@permission('view.client.log')
 <h5 align="center"><b style="text-align: center;"class="ts">Activity Logs</b></h5>
<div class="table-responsive">

<table id="table_history" class="table table-bordered table-striped" style="width: 100%;table-layout: fixed;word-wrap: break-word; ">
   <thead  style="background: grey;color: blue; ">
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