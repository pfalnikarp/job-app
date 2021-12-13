@if(Session::has('flash_message'))
    <div class="alert alert-success mt-1">
        {{ Session::get('flash_message') }}
    </div>
@endif


                        
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
<form action="{{route('clientdtl.updateclient')}}" method="POST">
<div class="row">
    <div class="col-md-3">  
        <h3>Edit Client</h3>
    </div>
    <div class="col-md-9 mt-3">
        <a href="{{route('clients.show',['id'=>$clientdtl->client_id])}}" class="btn btn-danger btn-outline ml-2 rightdiv">Cancel</a>
      
        <button class="btn btn-primary btn-outline rightdiv">Update</button>
      
    </div>
 </div>
<div class="card temcolor1">

 
<div class="card-body">

  @csrf
<input type="hidden" name="cid" value="{{$clientdtl->id}}">
<input type="hidden" name="company_id" value="{{$clientdtl->company_id}}">
<input type="hidden" name="client_company" value="{{$clientdtl->client_company}}">

          <div class="row">
           <div class="col-md-3 pr-1">
            <div class="form-group"> 
              <label for="first_name">First Name<span style='color: red'>*</span></label><input type="text" name="first_name"  class=" form-control addfname" value="{{$clientdtl->first_name}}"  required="required" onfocusout="myClifirstnamecheck(this,'0')" id="newaddfnameid"> 
              <span id="first_name_error" class="first_name_error0 text-danger spantext clientfirstnameerror" for="first_name"></span>
             <span id="first_name_success" class="first_name_success0 text-success spantext" for="first_name"></span>
             <label class="control-label mt-2">BlackList : </label>
   
          @if( $clientdtl->black_list == "Y")

              <input type="checkbox"  data-toggle="toggle" data-on="Block"  data-off="Unblock"data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="75" class="form-control5 open" onchange="myChangerevblock(this,'offstatus')" checked>
              <input type="hidden" name="black_list" id="blacklist" class="blacklist" value='{{ $clientdtl->black_list }}'> 
              <input type="hidden" name="black_list_reason" id="blacklistreason" class="black_reason" value="{{ $clientdtl -> black_list_reason }}"> 

          @else
            <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control5 open" onchange="myChangerevblock(this,'onstatus')" id="ddddsa">
              <input type="hidden" name="black_list" id="blacklist" class="blacklist" value='{{ $clientdtl->black_list }}'> 
              <input type="hidden" name="black_list_reason" id="blacklistreason" class="black_reason" value="{{ $clientdtl->black_list_reason }}"> 
          @endif
            </div>   
           </div>
           <div class="col-md-2 px-1">
            <div class="form-group">
               <label for="last_name">Last Name</label><input type="text" name="last_name"   value="{{$clientdtl->last_name}}" class="form-control addlname"  onfocusout="myClilastnamecheck(this,'0')">
               <span class="last_name_error0 text-danger spantext clientlastnameerror" for="last_name"></span>
               <span  class="last_name_success0 text-success spantext" for="last_name"></span>
            </div>     
          </div>
          
          <div class="col-md-4 px-1 cemail" >
     
            <div id="emailtextboxclient" class="form-group-sm">
               <label for="client_email_primary">Email<span style='color: red'>*</span></label>
    @php
      $emaili=0;
    @endphp
        @foreach(explode(",",$clientdtl->client_email_primary) as $key=>$clientemailarray)
         @if($key == 0) 
               <input type="email" name="client_email_primary[]"  class=" form-control emptyemail   emailcheck cliemail mb-1" required="required" onfocusout="myCliemailcheck(this,{{$emaili}})" value="{{$clientemailarray}}">
               <input type="hidden" name="alredycheckcliemailvalue" value="{{$clientemailarray}}">
              <span id="client_email_primary_error" class="client_perror{{$emaili}} text-danger spantext clientemailerror"></span>
              <span id="client_email_primary_success" class="success client_perrorsuccess{{$emaili++}} text-success spantext" for="client_email_primary"></span>
         @else
            <div class="input-group input-group-unstyled">
             <input type="email" name="client_email_primary[]"  class=" form-control emptyemail   emailcheck cliemail mb-1" required="required" onfocusout="myCliemailcheck(this,{{$emaili}})" value="{{$clientemailarray}}">
               <input type="hidden" name="alredycheckcliemailvalue" value="{{$clientemailarray}}"><a href="JavaScript:void(0);" class="remove_emailfield btn3 ">X</a></div>
              <span id="client_email_primary_error" class="client_perror{{$emaili}} text-danger spantext clientemailerror"></span>
              <span id="client_email_primary_success" class="success client_perrorsuccess{{$emaili++}} text-success spantext" for="client_email_primary"></span>
         @endif
        @endforeach
            </div> 
            <a href="JavaScript:void(0);" class="addclientemail"> <i class="fa fa-plus" aria-hidden="true"></i></a>
              <input type="hidden" value="{{$emaili}}">
          </div>
          <div class="col-md-3 pl-1" id="">
              <div id="phonetextboxclient" class="form-group-sm">
                 <label for="client_contact_1">Contact</label>
        @php
           $phonei=0;
        @endphp
        @foreach(explode(",",$clientdtl->client_contact_1) as $key=>$clientphonearray) 
           @if($key == 0)
                 <input type="text" name="client_contact_1[]"   class="form-control emptyphone0 cliphone mb-1"  onfocusout="myCliphonecheck(this,{{$phonei}})" value="{{$clientphonearray}}">
                 <input type="hidden" name="alredycheckcliphonevalue" value="{{$clientphonearray}}">
                <span  class="client_phoneerror{{$phonei}} text-danger spantext clientphoneerror"></span>
                <span  class="client_phonesuccess{{$phonei++}} text-success spantext" ></span>
           @else
             <div class="input-group input-group-unstyled mt-1 mb-1">
                <input type="text" name="client_contact_1[]"   class="form-control emptyphone0 cliphone mb-1"  onfocusout="myCliphonecheck(this,{{$phonei}})" value="{{$clientphonearray}}" required="">
                <input type="hidden" name="alredycheckcliphonevalue" value="{{$clientphonearray}}"><a href="JavaScript:void(0);" class="deletephone btn3 ">X</a></div>
                <span  class="client_phoneerror{{$phonei}} text-danger spantext clientphoneerror"></span>
                <span  class="client_phonesuccess{{$phonei++}} text-success spantext" ></span>

           @endif  
        @endforeach
                  
          </div>
             <a href="JavaScript:void(0);" class="addclientphone"> <i class="fa fa-plus" aria-hidden="true"></i></a>
             <input type="hidden" value="{{$phonei}}">
          </div> 
        </div>
        <div class="row">
          <div class="col-md-2 pr-1">
            <div class="form-group"> 
               <label for="designation">DESIGNATION</label><input type="text" name="designation"  value="{{$clientdtl->designation}}" class="form-control" >
            </div>
          </div>
          <div class="col-md-2 px-1">
            <div class="form-group">
              <label class="">linkedin URL</label>
              <input type="text"  class="form-control mt-0"  name="linkedin_url" placeholder="" value="{{$clientdtl->linkedin_url}}" >
     
            </div>
          </div>
          <div class="col-md-4 px-1">
           <div class="form-group"> 
              <label for="client_note">Client Description / Note</label>
              <textarea name="client_note"  class="form-control form-control2">{{$clientdtl->client_note}}</textarea>
           </div>
          </div> 
          <div class="col-md-4 pl-1">
            <label>Client Special Details</label>
            <textarea name="self_client_specification" class="form-control form-control2">{{$clientdtl->self_client_specification}}</textarea>  
          </div>
        </div>
        <div class="row">
          <div class="col-md-1 pr-1">
                <label>U NO</label>
                <input type="text" name="cunitno" class="form-control" value="{{$clientdtl->cunitno}}">
          </div>
          <div class="col-md-2 px-1">
                <label>Street Name</label>
                <input type="text" name="cstreet" class="form-control" value="{{$clientdtl->cstreetname}}">
          </div>
          <div class="col-md-3 px-1">
              <label>Country</label>
              <select class="form-control mt-0 scountry" name="ccountry"> 
                @if($clientdtl->ccountry == "")
                   <option value="">Select country</option>
                @else
                    <option value="{{$clientdtl->ccountry}}" selected="">{{$clientdtl->ccountry}}</option> 
                @endif
                  
          
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
              <select class="form-control mt-0 sstate" id="stateid" name="cstate" value=" ">
                @if($clientdtl->cstate == "")
                   <option value="">None</option>
                @else
                    <option value="{{$clientdtl->cstate}}" selected="">{{$clientdtl->cstate}}</option> 
                @endif
              </select>
              <input name="clientother_state" class="clienteditstate" style="display:none;" placeholder="Text" value="">
          </div>
          <div class="col-md-2 px-1">
              <label>city/county</label>
              <select class="form-control mt-0 clientscounty" id="County" name="ccity">
                @if($clientdtl->ccity == "")
                   <option value="">None</option>
                @else
                    <option value="{{$clientdtl->ccity}}" selected="">{{$clientdtl->ccity}}</option> 
                @endif

              </select>
              <input name="clientother_county" class="clienteditcounty" style="display:none;" placeholder="Text " value="">  
          </div>
          <div class="col-md-2 pl-1">
              <div class="form-group">
                <label class="labcolor">Zip Code</label>
                <input type="text" class="form-control mt-0 mb-4" name="czipcode" value="{{$clientdtl->czipcode}}">          
              </div>
          </div>
        </div>

</form>
<!-- client specification modal popup -->
<br>
<br>
@permission('view.client.log')
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
<!-- client block modal popup -->
<div class="modal fade"  tabindex="-1" role="dialog" id="companyblockmodal" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Company Block Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <textarea class="form-control" id="companyblocktext"  placeholder="Enter Text Here" style="height: 90px;"></textarea>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-outline" id="writecompanyblockreason">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- client block modal popup -->
<div class="modal fade"  tabindex="-1" role="dialog" id="clientblockmodal" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Client Block Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <textarea class="form-control" id="clientblocktext"  placeholder="Enter Text Here" style="height: 90px;"></textarea>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-outline" id="writeclientblockreason">Save</button>
      </div>
    </div>
  </div>
</div>