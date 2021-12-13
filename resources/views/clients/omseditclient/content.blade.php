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
{!! Form::model($client,['method' => 'PATCH','route'=>['clients.update',$client->id], 'id'=>'clientadd']) !!}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" name="company_id" value="{{$client->company_id}}">
 <div class="row">
    <div class="col-md-3">  
        <h4 class="mt-2">Edit Company</h4>
    </div>
    <div class="col-md-9 mt-2">
        <a href="{{route('clients.show',['id'=>$client->id])}}" class="btn btn-danger btn-outline rightdiv mb-1 ml-2">Cancel</a>
        <button class="btn btn-outline btn-primary mb-1 rightdiv chkerror">Update</button>
      
    </div>
 </div>

<div class="card temcolor1">
  
<div class="card-body">
<div id="collapseOne">
  <div class="row"> 
    <div class="col-md-3 pr-1"> 
      <div class="form-group">
        <label>Company Name<span style='color: red'>*</span></label>
         <input type="text" name="client_company" class="form-control mb-3 compinput" autofocus="" required="" id="client_company" value="{{$client->client_company}}">
        <span id="client_company_error" class="client_company_error text-danger spantext" for="client_company"></span>
        <span id="client_company_success" class="success" for="client_company text-success spantext"></span>
        <input type="hidden" name="allredycompanyname" value="{{$client->client_company}}" id="allredycompanynameid" >

                 {!! Form::label('red_list', 'BlackList ', ['class' => 'control-label']) !!}

                  @if( $client->red_list == "Y")
                     <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control1 open"  value='Y' onchange="Mychangecompany(this)" checked>
                  @else
                     <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control1 open" value='N' onchange="Mychangecompany(this)">
                    

                  @endif
                
                  <input type="hidden" name="red_list" class="mred" id="blacklistcompany" value="{{$client->red_list}}">
                  <input type="hidden" name="red_list_details" id="blacklistcompanyreason" class="red_reason" value="{{$client->red_list_details}}">
                       <!--  {!! Form::hidden('red_list_details', null, ['class' => 'red_reason']) !!}  -->
              
      </div>  
    </div>
    <div class="col-md-3 px-1"> 
      <div class="form-group">
        <label>Website</label>
        <input type="text" name="website" class="form-control addwebsite"  value="{{$client->website}}">
         <span id="website_error" class="website_error text-danger spantext" for="website"></span>
        <span id="website_success" class="website_success text-success spantext" for="website"></span>
      </div> 
    </div>
   


    <div class="col-md-3 px-1"> 
    <label>email<span style='color: red'>*</span></label>
    <div id="emailtextboxcompany">
    @php
      $emaili=0;
    @endphp
    @foreach(explode(",",$client->email) as $key=>$compemailarray)  
             
      <div  class="form-group-sm mb-1">
    @permission('show.primary-email')
      @if($key == 0)
        <input type="email" name="company_email[]" class="form-control coemail" required="" onfocusout="myComemailcheck(this,{{$emaili}})" value="{{$compemailarray}}">
        <input type="hidden" name="alredycheckemail" value="{{$compemailarray}}">
        <span id="email_error" class="email_error{{$emaili}} text-danger spantext companyemailerror" for="email"></span>
        <span id="email_success" class="email_success{{$emaili++}} text-success spantext" for="email"></span>
      @else
       <div class="input-group input-group-unstyled">
        <input type="email" name="company_email[]" class="form-control coemail" required="" onfocusout="myComemailcheck(this,{{$emaili}})" value="{{$compemailarray}}">
        <input type="hidden" name="alredycheckemail" value="{{$compemailarray}}"><a href="JavaScript:void(0);" class="removecompanyemailfield btn3 ">X</a></div>
        <span id="email_error" class="email_error{{$emaili}} text-danger spantext companyemailerror" for="email"></span>
        <span id="email_success" class="email_success{{$emaili++}} text-success spantext" for="email"></span>
      @endif
    @else
      
      <input type="text" name="" value="{{$compemailarray}}" class="form-control" disabled="">
      <input type="hidden" name="company_email[]" value="{{$compemailarray}}">
    @endpermission
      </div>

    @endforeach
   </div>
       <a href="JavaScript:void(0);" id="addcompanyemail" class=""><i class="fa fa-plus" aria-hidden="true"></i></a>
       <input type="hidden" value="{{$emaili}}" id="lastemailvalueid">
    </div>  

    <div class="col-md-3 pl-1"> 
             <label>Phone</label>
      <div  id="phonetextboxcompany">
        @php
           $phonei=0;
        @endphp
      @foreach(explode(",",$client->phone) as $key=>$compephonrarray)

        <div class="form-group-sm mb-1">
      @permission('contact1.show')
        @if($key == 0) 
        <input type="text" name="company_phone[]" class="form-control cophone"    onfocusout="myComephonecheck(this,{{$phonei}})" value="{{$compephonrarray}}">
        <input type="hidden" name="alredycheckphone" value="{{$compephonrarray}}">
    	  <span id="phone_error" class="phone_error{{$phonei}} text-danger spantext companyphoneerror" for="phone"></span>
        <span id="phone_success" class="phone_success{{$phonei++}} text-success spantext" for="phone"></span>
        <input type="hidden" name="btnvalue" value="" class="btnvalue">
        @else
        <div class="input-group input-group-unstyled">
        <input type="text" name="company_phone[]" class="form-control cophone"    onfocusout="myComephonecheck(this,{{$phonei}})" value="{{$compephonrarray}}">
        <input type="hidden" name="alredycheckphone" value="{{$compephonrarray}}"><a href="JavaScript:void(0);" class="remove_companyphonefield btn3 ">X</a></div>
        <span id="phone_error" class="phone_error{{$phonei}} text-danger spantext companyphoneerror" for="phone"></span>
        <span id="phone_success" class="phone_success{{$phonei++}} text-success spantext" for="phone"></span>
        <input type="hidden" name="btnvalue" value="" class="btnvalue">
        @endif
       @else
         <input type="text" name="" value="{{$compephonrarray}}" class="form-control" disabled="">
         <input type="hidden" name="company_phone[]" value="{{$compephonrarray}}">
       @endpermission 
      </div>
 
      @endforeach
    </div>
        <a href="#" id="addcompanyphone" class=""> <i class="fa fa-plus" aria-hidden="true"></i> </a>
        <input type="hidden" value="{{$phonei}}" id="lastphonevalueid">
    </div>  
    
  </div>
  <div class="row">
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label>Company Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 
                   @if(in_array("Retail",explode(',',$client->store_type)))
                      <label class="form-check-label ml-4">
                      <input class="form-check-input" type="checkbox" name="store_type[]" value="Retail" checked="">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Retail</b></span> 
                    </label>&nbsp;&nbsp;&nbsp;
                  @else
                     <label class="form-check-label ml-4">
                      <input class="form-check-input" type="checkbox" name="store_type[]" value="Retail">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Retail</b></span> 
                    </label>&nbsp;&nbsp;&nbsp;
                  @endif
                  @if(in_array("Fix",explode(',',$client->store_type)))
                     <label class="form-check-label ml-2">
                      <input class="form-check-input" type="checkbox" name="store_type[]" value="Fix" checked="">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Fix</b></span> 
                    </label>
                  @else
                    <label class="form-check-label ml-2">
                      <input class="form-check-input" type="checkbox" name="store_type[]" value="Fix">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Fix</b></span> 
                    </label>
                  @endif
                  
                </div> 
              </div>
               <div class="col-md-2 px-1">
                    <div class="form-group">
                        <label class="">Industry</label>
                        <input type="text" class="form-control mt-0"  name="industry" value="{{$client->industry}}">
                    </div>
                </div> 
             <div class="col-md-2 px-1">
                <div class="form-group">
                  <label>Vector Price</label>
                  @permission('vend-file-price.modify')
                    <input type="text" name="unit_price" class="form-control" value="{{$client->unit_price}}">
                  @else
                    @permission('vend-file-price.show')
                     <input type="text" name="" value="{{$client->unit_price}}" class="form-control" disabled=""> 
                    @else
                       <input type="text" name="" value="-" class="form-control" disabled=""> 
                    @endpermission  
                     <input type="hidden" name="unit_price" class="form-control" value="{{$client->unit_price}}">
                  @endpermission
                </div>
              </div>

              <div class="col-md-2 px-1">
                <div class="form-group">
                   <label>Emb. Rate</label>
                  @permission('v_emb_rate.modify') 
                   <input type="text" name="digit_rate" class="form-control" value="{{$client->digit_rate}}">
                  @else
                    @permission('v_emb_rate.show') 
                       <input type="text" name="" value="{{$client->digit_rate}}" class="form-control" disabled="">
                    @else
                        <input type="text" name="" value="-" class="form-control" disabled="">
                    @endpermission
                       <input type="hidden" name="digit_rate" class="form-control" value="{{$client->digit_rate}}">
                  @endpermission
                </div>
              </div>  
              <div class="col-md-4 pl-1">
                  <label>Company Special Details</label>
                  <textarea name="company_specific" class="form-control form-control2">{{$client->client_specific}}</textarea>
                
              </div> 

     </div>
  <b>Company Address</b>
  <div class="row">
                    <div class="col-md-1 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Unit No</label>
                            <input type="text" class="form-control mt-0"  name="unit_no" value="{{$client->unitno}}">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label class="labcolor">Street Name</label>
                            <input type="text" class="form-control mt-0" name="street_name" value="{{$client->client_address1}}">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Address Line2</label>
                            <input type="text" class="form-control mt-0" name="address_line_2" value="{{$client->client_address_line2}}">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Country<span style='color: red'>*</span></label>
                            <select class="form-control mt-0 scountry" name="country">  
                                 <option value="{{$client->client_country}}" selected="">{{$client->client_country}}</option>
                                 <option value="US">US</option>
                                 <option value="UK">UK</option> 
                                 <option value="CANADA">CANADA</option>
                                 <option value="AUSTRALIA">AUSTRALIA</option> 
                                 <option value="NEW ZEALAND">NEW ZEALAND</option>
                                 <option value="Other">Other</option>                  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                          <label class="labcolor">State<span style='color: red'>*</span></label>
                           <select class="form-control mt-0 sstate" id="stateid" name="state">
                              <option value="{{$client->client_state}}" selected="">{{$client->client_state}}</option>
                           </select>
                           <input name="other_state" class="editstate col-md-12 mt-1" id="otherstateid" style="display:none;" placeholder="State Name" value="" >
                        </div>
                    </div>
                     <div class="col-md-2 pl-1">
                        <div class="form-group">
                          <label class="labcolor">City/County</label>
                           <select class="form-control mt-0 scounty" id="County" name="county">
                             <option value="{{$client->city}}" selected="">{{$client->city}}</option>
                           </select>
                           <input name="other_county" class="editcounty col-md-12 mt-1" style="display:none;" placeholder="County Name " value="" id="othercountyid">
                        </div>
                    </div>
          </div>
          
          <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Zip Code</label>
                            <input type="text" class="form-control mt-0 mb-4" name="zip_code" value="{{$client->zipcode}}">
                             
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Time Zone</label>
                             <select class="form-control mt-0" id="time_zone" name="time_zone">         
                                <option value="{{$client->timezone_type}}">{{$client->timezone_type}}</option>             
                            </select>
                             <input name="other_timezone" class="edittimezone col-md-12 mt-1" style="display:none;" placeholder="Time Zone" value="" id="othertimezoneid">

                        </div>

                    </div>
                     <div class="col-md-8 pl-1">
                            <div class="form-group">
                                <label class="labcolor">About Company</label>
                                <textarea name="aboutcompany" class="form-control form-control2 mt-0 description">{{$client->about_company}}</textarea>
                            </div>
                    </div>  
            </div>

          <div class="row"> 
            <div class="col-md-5">
              <div class="form-group"> 
              </div>
            </div>
            <div class="col-md-2 px-1">
                <div class="form-group">
                  <label>Client Source</label>
                  <select class="form-control clsource" name="client_source">
                    <option value="{{$client->client_source}}" selected="">{{$client->client_source}}</option>
                    <option value="Email">Email</option>
                    <option value="Telephone">Telephone</option>
                    <option value="Internet">Internet</option>
                    <option value="Other">Other</option>
                    
                  </select>
                </div>
            </div> 

            <div class="col-md-3 pl-1"> 
                <div class="form-group">
                   <label>Sales Executive</label>
                   <select class="form-control" name="csr_personid">
                    @if($client->csr_personid == "")
                        <option value="0">Select Sales Executive</option>
                    @endif
                    @foreach($salses as $salse )
                      @if($salse->id == $client->csr_personid)
                         <option value="{{$salse->id}}" selected="">{{$salse->name}}</option>
                      @else
                         <option value="{{$salse->id}}">{{$salse->name}}</option>
                      @endif
                    @endforeach
                   </select>
                </div>
            </div>
           
        </div>


    </div>
<!-- end company id -->


 <!-- end client id -->

   <!-- end fix seat -->
 </div>
 </div>   

{!! Form::close() !!}

<!-- client specification modal popup -->
<br>
<br>
@permission('view.company.log')
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
<!-- company block modal popup -->
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