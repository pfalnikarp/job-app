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
 
{!! Form::open(['route'=>'clients.store',  'id'=>'clientadd']) !!}

<meta name="csrf-token" content="{{ csrf_token() }}" />
 <div class="row">
    <div class="col-md-3">  
        <h4 class="mt-1">Add Company</h4>
    </div>
    <div class="col-md-9 mt-1 mb-1">
        <a href="{{route('clients.index')}}" class="btn btn-danger btn-outline rightdiv">Cancel</a>
      
    </div>
 </div>

<div class="card temcolor1">
 <div class="row">
            <div class="col-md-12" id="headingTwo">
                <nav class="nav nav-tabs bg-info">
                  <a href="JavaScript:void(0);" class="nav-item nav-link active"  id="collapseOne23" ><b style="color: black;">Company Information</b></a>
                  <a href="JavaScript:void(0);" class="nav-item nav-link collapseclient"><b style="color: black;">Client Information</b></a>
                </nav>
         
                       
            </div> 
        </div> 

<div class="card-body">
<div id="collapseOne">
  <div class="row"> 
    <div class="col-md-3 pr-1"> 
      <div class="form-group">
        <label>Company Name<span style='color: red'>*</span></label>
         <input type="text" name="client_company" class="form-control compinput" autofocus="" required="" id="client_company" value="{{old('client_company')}}">
        <span id="client_company_error" class="client_company_error text-danger spantext" for="client_company"></span>
        <span id="client_company_success" class="success" for="client_company text-success spantext"></span>
      </div>  
    </div>
    <div class="col-md-3 px-1"> 
      <div class="form-group">
        <label>Website</label>
        <input type="text" name="website" class="form-control addwebsite" pattern="(https?://)?(www\.)?([a-zA-Z0-9_%]*)\b\.[a-z]{2,4}(\.[a-z]{2})?((/[a-zA-Z0-9_%]*)+)?(\.[a-z]*)?" value="{{old('website')}}">
         <span id="website_error" class="website_error text-danger spantext" for="website"></span>
        <span id="website_success" class="website_success text-success spantext" for="website"></span>
      </div> 
    </div>
    <div class="col-md-3 px-1"> 
       <div id="emailtextboxcompany" class="form-group-sm">
        <label>email<span style='color: red'>*</span></label>
        <input type="email" name="company_email[]" class="form-control coemail" required="" onfocusout="myComemailcheck(this,0)" id="companyemailid">
        <span id="email_error" class="email_error0 text-danger spantext companyemailerror" for="email"></span>
        <span id="email_success" class="email_success0 text-success spantext" for="email"></span>
      </div>
       <a href="JavaScript:void(0);" id="addcompanyemail" class="mt-1"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>  

    <div class="col-md-3 pl-1"> 
        <div id="phonetextboxcompany" class="form-group-sm">
        <label>Phone</label>
        <input type="text" name="company_phone[]" class="form-control cophone" required=""   onfocusout="myComephonecheck(this,0)">
    	  <span id="phone_error" class="phone_error0 text-danger spantext companyphoneerror" for="phone"></span>
        <span id="phone_success" class="phone_success0 text-success spantext" for="phone"></span>
        <input type="hidden" name="btnvalue" value="" class="btnvalue">
      </div>
        <a href="#" id="addcompanyphone" class="mt-1"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
    </div>  
    
  </div>
  <div class="row">
              <div class="col-md-2 pr-1">
                <div class="form-group">
                  <label>Company Type<span style='color: red'>*</span></label><br>
                    <label class="form-check-label ml-4">
                      <input class="form-check-input bbbbbb" type="checkbox" name="store_type[]" value="Retail" onchange="Mychangecompanystatus(this)">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Retail</b></span> 
                      <input type="hidden" name="checkval" value="0" id="retailid">
                    </label>&nbsp;&nbsp;&nbsp;
                    <label class="form-check-label ml-2">
                      <input class="form-check-input bbbbbb" type="checkbox" name="store_type[]" value="Fix"  onchange="Mychangecompanystatus(this)">
                      <span class="form-check-sign"></span>
                      <span class="" style="color: black;font-size: 13px;"><b>Fix</b></span> 
                    </label>
                </div> 
              </div>
               <div class="col-md-2 px-1">
                    <div class="form-group">
                        <label class="">Industry</label>
                        <input type="text" class="form-control mt-0"  name="industry" value="{{old('industry')}}">
                    </div>
                </div> 
               <div class="col-md-2 px-1">
                <div class="form-group">
                  <label>Vector Price</label>
                  <input type="text" name="unit_price" class="form-control" value="0.00">
                </div>
               </div>

              <div class="col-md-2 px-1">
                <div class="form-group">
                   <label>Emb. Rate</label>
                   <input type="text" name="digit_rate" class="form-control" value="1.75">
                </div>
              </div> 
          <div class="col-md-4 pl-1">
            <label>Company Special Details</label>
            <textarea name="client_specific" class="form-control form-control2"></textarea>
                
          </div> 

  </div>
  <b>Company Address</b>
  <div class="row">
                    <div class="col-md-1 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Unit No</label>
                            <input type="text" class="form-control mt-0"  name="unit_no" value="{{old('unit_no')}}">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label class="labcolor">Street Name</label>
                            <input type="text" class="form-control mt-0" name="street_name" value="{{old('street_name')}}">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Address Line2</label>
                            <input type="text" class="form-control mt-0" name="address_line_2" value="{{old('address_line_2')}}">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Country<span style='color: red'>*</span></label>
                            <select class="form-control mt-0 scountry" name="country" required="" id="scountryid">  
                                 <option value="">Select country</option>
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
                           </select>
                           <input name="other_state" class="editstate col-md-12 mt-1" id="otherstateid" style="display:none;" placeholder="State Name" value="">
                        </div>
                    </div>
                     <div class="col-md-2 pl-1">
                        <div class="form-group">
                          <label class="labcolor">City/County</label>
                           <select class="form-control mt-0 scounty" id="County" name="county">
                           </select>
                           <input name="other_county" class="editcounty col-md-12 mt-1" style="display:none;" placeholder="County Name " value="" id="othercountyid">
                        </div>
                    </div>
          </div>
          
          <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label class="labcolor">Zip Code</label>
                            <input type="text" class="form-control mt-0 mb-4" name="zip_code" value="{{old('zip_code')}}">
                             
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label class="labcolor">Time Zone</label>
                             <select class="form-control mt-0" id="time_zone" name="time_zone">         
                                <option value="Other">Other</option>             
                            </select>
                             <input name="other_timezone" class="edittimezone col-md-12 mt-1" style="display:none;" placeholder="Time Zone" value="" id="othertimezoneid">

                        </div>
                    </div>
                     <div class="col-md-8 pl-1">
                            <div class="form-group">
                                <label class="labcolor">About Company</label>
                                <textarea name="aboutcompany" class="form-control form-control2 mt-0 description"></textarea>
                            </div>
                    </div>  
            </div>

          <div class="row"> 
            <div class="col-md-3">
            </div>
            <div class="col-md-3 px-1">
                <div class="form-group">
                  <label>Company Source<span style='color: red'>*</span></label>
                  <select class="form-control clsource" name="client_source" id="clientsourceid">
                    <option value="">Select Company Source</option> 
                    <option value="Telephone">Telephone</option>
                    <option value="Email">Email</option>
                    <option value="Internet">Internet</option>
                    <option value="Other">Other</option> 
                  </select>
                </div>
              </div> 

            <div class="col-md-3 pl-1"> 
                <div class="form-group">
                   <label>Sales Executive</label>
                   <select class="form-control" name="csr_personid">
                     <option value="0">Select Sales Executive</option>
                    @foreach($salses as $salse )
                     <option value="{{$salse->id}}">{{$salse->name}}</option>
                    @endforeach
                   </select>
                </div>
            </div>
             <div class="col-md-3 pl-1"> 
                <div class="form-group">
                    <a href="JavaScript:void(0);" class="mt-4 nav-item nav-link collapseclient"><b>Go to Next Page <i class="fa fa-arrow-right" aria-hidden="true"></i></b></a>
                  
                </div>
            </div>
          </div>


    </div>
<!-- end company id -->

 <div id="collapseTwo">
  <div class="row" id="addclient">
    <div class="col-md-3 pr-1">
      <div class="form-group"> 
        <label for="first_name">First Name</label><input type="text" name="first_name[]"  class=" form-control" value="{{ old('first_name.0') }}"  required="required" onfocusout="myClifirstnamecheck(this,'0')"> 
           <span id="first_name_error" class="first_name_error0 text-danger spantext clientfirstnameerror" for="first_name"></span>
           <span id="first_name_success" class="first_name_success0 text-success spantext" for="first_name"></span>
      </div>   
    </div>
    <div class="col-md-2 px-1">
      <div class="form-group">
         <label for="last_name">Last Name</label><input type="text" name="last_name[]"   value="{{ old('last_name.0') }} " class="form-control addlname" required="required" onfocusout="myClilastnamecheck(this,'0')">
         <span class="last_name_error0 text-danger spantext clientlastnameerror" for="last_name"></span>
         <span  class="last_name_success0 text-success spantext" for="last_name"></span>
     </div>     
    </div>
     <div class="col-md-2 px-1">
     <div class="form-group"> 
       <label for="designation">DESIGNATION</label><input type="text" name="designation[]"  value=" " class="form-control" >
     </div>
    </div>
    <div class="col-md-3 px-1 cemail" >
     
      <div id="emailtextboxclient" class="form-group-sm">
         <label for="client_email_primary">Email</label><input type="email" name="client_email_primary[][]"  value="" class=" form-control emptyemail0   emailcheck cliemail" required="required" onfocusout="myCliemailcheck(this,'00')">
        <span id="client_email_primary_error" class="client_perror00 text-danger spantext clientemailerror"></span>
        <span id="client_email_primary_success" class="success client_perrorsuccess00 text-success spantext" for="client_email_primary"></span>
      
     </div> 
        <a href="JavaScript:void(0);" class="addclientemail mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a>
          <input type="hidden" value="0">
    </div>

    <div class="col-md-2 pl-1" id="">
      <div id="phonetextboxclient" class="form-group-sm">
         <label for="client_contact_1">Contact</label><input type="text" name="client_contact_1[][]"  value="" class="form-control emptyphone0 cliphone" required="required" onfocusout="myCliphonecheck(this,'00')">
        <span  class="client_phoneerror00 text-danger spantext clientphoneerror"></span>
        <span  class="client_phonesuccess00 text-success spantext" ></span>
          
     </div>
        <a href="JavaScript:void(0);" class="addclientphone mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a>
          <input type="hidden" value="0">
    </div> 
   
      <div class="col-md-2 pr-1">
          <div class="form-group">
            <label class="">linkedin URL</label>
            <input type="text"  class="form-control mt-0"  name="linkedin_url[0]" placeholder="" value="" >
             <h5 class="text-left mt-4">Client Address</h5>
          </div>
      </div>
   
      <div class="col-md-6 px-1">
        <div class="form-group"> 
          <label for="client_note">Client Description / Note</label>
          <textarea name="client_note[]" value="" class="form-control form-control2"></textarea>
         
        </div>
      </div> 

      <div class="col-md-4 pl-1">
            <label>Client Special Details</label>
            <textarea name="self_client_specification[]" class="form-control form-control2"></textarea>
                
      </div>
      
  
        <div class="col-md-1 pr-1">
                <label>Unit NO</label>
                <input type="text" name="cunitno[]" class="form-control">
        </div>
        <div class="col-md-3 px-1">
                <label>Street Name</label>
                <input type="text" name="cstreet[]" class="form-control">
        </div>
        <div class="col-md-2 px-1">
                          <label>Country</label>
                           <select class="form-control mt-0 scountryclient" name="ccountry[]">  
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
                            <select class="form-control mt-0 clientsstate" id="clientstateid" name="cstate[]" value=" ">
                             <!--  <option>none</option> -->
                           </select>
                           <input name="clientother_state[]" class="clienteditstate" style="display:none;" placeholder="Text" value="">
                    </div>
                     <div class="col-md-2 px-1">
                          <label>city/county</label>
                            <select class="form-control mt-0 clientscounty" id="clientcountyid" name="ccounty[]">
                           </select>
                           <input name="clientother_county[]" class="clienteditcounty" style="display:none;" placeholder="Text " value="">  
                    </div>
                    <div class="col-md-2 pl-1">
                          <label>Zip Code</label>
                          <input type="text" name="czipcode[]" class="form-control">  
          </div>
   
  </div>
  <div class="row" id="addmoreclient">
  </div>
  <div class="row">
    <div class="col-md-8 mt-3">
       <a id="addclientrow" href="JavaScript:void(0);" class="btn btn-success btn-outline add">Add Client</a> 
    </div>
    <div class="col-md-4 mt-3">
        <button type="submit" class="btn btn-warning btn-outline chkerror rightdiv" name="submitbutton" value="formsubmit">Submit</button>
        
        <!-- <button type="submit" class="btn btn-primary  chkerror rightdiv mr-2" name="submitbutton" value="addfixsheet">Add Fix Seat</button> -->
    </div>

  </div>     
 </div>
 <!-- end client id -->
   
 </div>
 </div>   

{!! Form::close() !!}
