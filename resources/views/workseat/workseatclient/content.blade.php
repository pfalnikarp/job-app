@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif
                       
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

<input type="hidden" name="company_id" value="{{$client->company_id}}">
 <div class="row mt-1 mb-1">
    <div class="col-md-3">  
        <h4>View Company</h4>
    </div>
    <div class="col-md-9">
        <a href="javascript:history.go(-1)" class="btn btn-primary btn-outline rightdiv ">Back</a>
    
      
    </div>
 </div>

<div class="card temcolor1">

 
<div class="card-body">
  <div class="row"> 
   <div class="col-md-5 px-2">
    <div class="rounded border border-fill s">
      <div class="card-body">
        <h5 align="center" class="ts"><b>Company Information</b></h5>
        <h5><label class="labviewcolor">Company Name : </label>
        <span class="spantext">{{$client->client_company}}</span></h5>
        <h5><label class="labviewcolor">Website : </label>
        <span class="spantext">{{$client->website}}</span></h5>
        <h5><label class="labviewcolor">Company Type : </label>
        <span class="spantext">{{$client->store_type}}</span></h5>
        <h5><label class="labviewcolor">Industry : </label>
        <span class="spantext">{{$client->industry}}</span></h5>
        <h5><label class="labviewcolor">Company Special Details : </label>
        <span class="spantext">{{$client->company_specific}}</span></h5>
       </div>
     </div>
     <div class="rounded border border-fill s mt-2">
      <div class="card-body">
      @permission('vend-file-price.show')
        <h5><label class="labviewcolor">Vector Price : </label>
        <span class="spantext">{{$client->unit_price}}</span></h5> 
      @endpermission
      @permission('v_emb_rate.show')
        <h5><label class="labviewcolor">Emb. Rate : </label>
        <span class="spantext">{{$client->digit_rate}}</span></h5> 
      @endpermission
        <h5><label class="labviewcolor">Client Source : </label>
        <span class="spantext">{{$client->client_source}}</span></h5> 
        <h5><label class="labviewcolor">Sales Executive : </label>
        <span  class="spantext">{{$client->csr_person}}</span></h5>           
      </div> 
     </div>
  </div>
  <div class="col-md-3 px-0">
    <div class="card s">
      <div class="card-body ">
          <h5 align="center" class="ts"><b>Company Contact</b></h5>
        <h5 align="center"><label class="labviewcolor">email</label></h5>
     @permission('show.primary-email')  
        @php
            $a=1;
        @endphp
            @foreach(explode(",",$client->email) as $compemailarray)  
                      <h5><span class="spantext">{{$a++}}) {{$compemailarray}}</span></h5>
            @endforeach
     @else
         <h5 align="center"><span class="spantext">No Permission</h5>
     @endpermission 
     
        <h5 align="center"><label class="labviewcolor">Phone</label></h5>
     @permission('contact1.show') 
        @php
            $b=1;
        @endphp
            @foreach(explode(",",$client->phone) as $compephonrarray)
                   @if($compephonrarray != "")
                      <h5><span class="spantext">{{$b++}}) {{$compephonrarray}}</span></h5>
                   @else
                       <h5>No Phone</h5>
                   @endif

            @endforeach
     @else
        <h5 align="center"><span class="spantext">No Permission</h5>
     @endpermission
 
      </div>
     </div>
      <h5><label class="labviewcolor">BlackList : </label>
          <span class="spantext">{{$client->red_list}}</span></h5>
      <h5><label class="labviewcolor">Black Reason : </label> 
          <span class="spantext">{{$client->red_list_details}}</span></h5> 
  </div>
  <div class="col-md-4 px-2">
    <div class="card s">
      <div class="card-body ">
         <h5 align="center" class="ts"><b>Company Address</b></h5>
        @permission('client.address.show')
          <h5><label class="labviewcolor">Unit No : </label>
          <span class="spantext">{{$client->unitno}}</span></h5> 
          <h5><label class="labviewcolor">Street Name : </label>
          <span class="spantext">{{$client->client_address1}}</span></h5>
          <h5><label class="labviewcolor">Address Line2 : </label>
          <span>{{$client->client_address_line2}}</span></h5>
          <h5><label class="labviewcolor">Country : </label>
          <span class="spantext">{{$client->client_country}}</span></h5>  
          <h5><label class="labviewcolor">State : </label>
          <span class="spantext">{{$client->client_state}}</span></h5>
          <h5><label class="labviewcolor">City/County : </label>
          <span class="spantext">{{$client->city}}</span></h5> 
          <h5><label class="labviewcolor">Zip Code : </label>
          <span class="spantext">{{$client->zipcode}}</span></h5> 
          <h5><label class="labviewcolor">Time Zone : </label>
          <span class="spantext">{{$client->timezone_type}}</span> </h5>
          <h5><label class="labviewcolor">About Company : </label>
          <span class="spantext">{{$client->about_company}}</span></h5>
        @else
          <h5 align="center"><span class="spantext">No Permission</h5>
        @endpermission 
      </div>
     </div>
  </div>
 </div>
<!-- end company id -->
<br>
 <h5 align="center"><b style="text-align: center;"class="ts">Client Team Information</b></h5> 
  <div class="row">
      
             
 
                 <div class="col-md-12 mt-1"> 
                      <div class="table-wrapper-scroll-y my-custom-scrollbar">
                      <table id="clientrecords" class="table table-bordered table-striped mb-0" style="width:100%">
                                       <thead>
                                         <tr>
                                             <th>No</th>
                                             <th>Name</th>
                                          @permission('show.primary-email')
                                             <th>Email</th>
                                          @endpermission
                                          @permission('contact1.show')
                                             <th>Phone</th>
                                          @endpermission
                                             <th>Designation</th>
                                             <th>Client Note</th>
                                             <th>Block list</th>
                                             <th>Action</th>
                                           
                                         </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                     </table>
                      </div>   
                </div>

  </div>
 <!-- end client id -->
@permission('show.virtual.assistant')
 <br>
    <h5 align="center"><b style="text-align: center;"class="ts">Virtual Assistant</b></h5>
     <div class="row">
      
               
 
                 <div class="col-md-12 mt-1"> 
                      <div class="">
                      <table id="worksheetrecords" class="table table-bordered table-striped mb-0" style="width:100%">
                                       <thead>
                                         <tr>
                                             <th>No</th>
                                             <th>Department</th>
                                             <th>country</th>
                                             <th>days</th>
                                             <th>hours</th>
                                             <th>worktime</th>
                                             <th>RESOURCE </th>
                                             <th>HANDLER</th>
                                          @permission('show.amont')
                                             <th>Revenue</th>
                                          @endpermission
                                              <th>country</th>
                                             <th>Action</th>
                                         </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                     </table>
                      </div>   
                </div>

  </div>
@endpermission
   <!-- end fix seat -->
  

<!-- client specification modal popup -->
<form id="theClientForm">
  @csrf
<input type="hidden" name="cid" value="{{$client->id}}">
<input type="hidden" name="company_id" value="{{$client->company_id}}">
<input type="hidden" name="client_company" value="{{$client->client_company}}">

<div class="modal fade"  tabindex="-1" role="dialog" id="addclientmodal" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Client</h5>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
       <i class="fa fa-close"></i>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
           <div class="col-md-3 pr-1">
            <div class="form-group"> 
              <label for="first_name">First Name<b style='color: red'>*</b></label><input type="text" name="first_name"  class=" form-control addfname" value=""  required="required" onfocusout="myClifirstnamecheck(this,'0')" id="newaddfnameid"> 
              <span id="first_name_error" class="first_name_error0 text-danger modalspantext clientfirstnameerror" for="first_name"></span>
             <span id="first_name_success" class="first_name_success0 text-success modalspantext" for="first_name"></span>
            </div>   
           </div>
           <div class="col-md-2 px-1">
            <div class="form-group">
               <label for="last_name">Last Name</label><input type="text" name="last_name"   value="" class="form-control addlname" required="required" onfocusout="myClilastnamecheck(this,'0')">
               <span class="last_name_error0 text-danger modalspantext clientlastnameerror" for="last_name"></span>
               <span  class="last_name_success0 text-success modalspantext" for="last_name"></span>
            </div>     
          </div>
          
          <div class="col-md-4 px-1 cemail" >
     
            <div id="emailtextboxclient" class="form-group-sm">
               <label for="client_email_primary">Email<b style='color: red'>*</b></label><input type="email" name="client_email_primary[]"  value="" class=" form-control emptyemail emailcheck cliemail" required="required" onfocusout="myCliemailcheck(this,'01')" id="firstclientemailid">
              <span id="client_email_primary_error" class="client_perror01 text-danger modalspantext clientemailerror"></span>
              <span id="client_email_primary_success" class="success client_perrorsuccess01 text-success modalspantext" for="client_email_primary"></span>
      
            </div> 
            <a href="JavaScript:void(0);" class="btn btn-sm btn-primary btn-outline addclientemail mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a>
              <input type="hidden" value="1">
          </div>
          <div class="col-md-3 pl-1" id="">
              <div id="phonetextboxclient" class="form-group-sm">
                 <label for="client_contact_1">Contact</label><input type="text" name="client_contact_1[]"  value="" class="form-control emptyphone0 cliphone" required="required" onfocusout="myCliphonecheck(this,'00')">
                <span  class="client_phoneerror00 text-danger modalspantext clientphoneerror"></span>
                <span  class="client_phonesuccess00 text-success modalspantext" ></span>
                  
             </div>
             <a href="JavaScript:void(0);" class="btn btn-sm btn-primary btn-outline addclientphone mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a>
             <input type="hidden" value="0">
          </div> 
        </div>
        <div class="row">
          <div class="col-md-2 pr-1">
            <div class="form-group"> 
               <label for="designation">DESIGNATION</label><input type="text" name="designation"  value=" " class="form-control" >
            </div>
          </div>
          <div class="col-md-2 px-1">
            <div class="form-group">
              <label class="">linkedin URL</label>
              <input type="text"  class="form-control mt-0"  name="linkedin_url" placeholder="" value="" >
     
            </div>
          </div>
          <div class="col-md-4 px-1">
           <div class="form-group"> 
              <label for="client_note">Client Description / Note</label>
              <textarea name="client_note" value="" class="form-control form-control2"></textarea>
           </div>
          </div> 
          <div class="col-md-4 pl-1">
            <label>Client Special Details</label>
            <textarea name="self_client_specification" class="form-control form-control2"></textarea>  
          </div>
        </div>
        <div class="row">
          <div class="col-md-1 pr-1">
                <label>U NO</label>
                <input type="text" name="cunitno" class="form-control">
          </div>
          <div class="col-md-2 px-1">
                <label>Street Name</label>
                <input type="text" name="cstreet" class="form-control">
          </div>
          <div class="col-md-3 px-1">
              <label>Country</label>
              <select class="form-control mt-0 scountryclient" name="ccountry">  
                  <option value="">Select country</option>
                  <option value="US">US</option>
                  <option value="UK">UK</option> 
                  <option value="CANADA">CANADA</option>
                  <option value="AUSTRALIA">AUSTRALIA</option> 
                  <option value="NEW ZEALAND">NEW ZEALAND</option>
                  <option value="Other">Other</option>                  
              </select>                   
          </div>
          <div class="col-md-2 px-1">
              <label>State</label>
              <select class="form-control mt-0 clientsstate" id="clientstateid" name="cstate" value=" ">
                             <!--  <option>none</option> -->
              </select>
              <input name="clientother_state" class="clienteditstate" style="display:none;" placeholder="Text" value="">
          </div>
          <div class="col-md-2 px-1">
              <label>city/county</label>
              <select class="form-control mt-0 clientscounty" id="clientcountyid" name="ccounty">
              </select>
              <input name="clientother_county" class="clienteditcounty" style="display:none;" placeholder="Text " value="">  
          </div>
          <div class="col-md-2 pl-1">
              <div class="form-group">
                <label class="labcolor">Zip Code</label>
                <input type="text" class="form-control mt-0 mb-4" name="czipcode" value="">          
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-outline" id="addsubmitclient">Save</button>
      </div>
    </div>
  </div>
</div>
</form>
 <br>
 <br>
@permission('view.company.log')
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
       

  
    
  
 <!--   for($i=0 ; $i< count($diffcol2); $i++)
  {
             echo "<tr>";
              foreach($diffcol2[$i] as  $key => $value )
              {
                  if ($key <> 'ip_address') {
                  if ($key <> 'created_at') {
                    if ($key <> 'updated_by') {

                        if ($key <> 'status_change_date' ) {
                          if ($key <> 'id' ) {
                                echo "<td class='td_history'>";
                                   $heading = $key ;
                                  if ($key == 'updated_nm') {
                                      $heading = 'Updated By';
                                   }
                                  if ( $key == 'updated_at') {
                                       $heading = 'Updated on' ;
                                   }
                                echo $heading .' : ' . $value ;
                                echo "</td>";
                          }
                        }
                    }
                  }
                }
                 
              }

            echo "</tr>";

              
  } -->

 <!--  for($i=0 ; $i< count($diffcol1); $i++)
  {
             echo "<tr>";
              foreach($diffcol1[$i] as  $key => $value )
              {
                  if ($key <> 'ip_address') {
                  if ($key <> 'created_at') {
                    if ($key <> 'updated_by') {

                        if ($key <> 'status_change_date' ) {
                          if ($key <> 'id' ) {
                                echo "<td class='td_history'>";
                                   $heading = $key ;
                                  if ($key == 'updated_nm') {
                                      $heading = 'Updated By';
                                   }
                                  if ( $key == 'updated_at') {
                                       $heading = 'Updated on' ;
                                   }
                                echo $heading .' : ' . $value ;
                                echo "</td>";
                          }
                        }
                    }
                  }
                }
                 
              }

            echo "</tr>";

              
  } -->

  

  </tbody>

</table>

</div>
@endpermission