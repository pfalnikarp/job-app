@extends('layouts.newdashbord')
@section('style')


 <style type="text/css">


div.row1 {
    padding-top: 0px;
    height: 80px;
    vertical-align: middle;
}


div.row1-del {
    padding-top: 20px;
    height: 80px;
    vertical-align: middle;
}



input.largerCheckbox { 
            width: 30px; 
            height: 30px; 
        } 

 input.mredlist { 
            width: 30px; 
            height: 30px; 
        } 
       

 
.bootbox.modal {
  position: absolute;
  float: left;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
   overflow-y: hidden;
}

.bootbox .modal-content  {
  background: #fff !important;
}

button.bootbox-close-button.close {
  color: black !important;
}

.bootbox .modal-title {
  color:  blue !important;
}

.sweet-alert title {
  color: blue !important;
}



.bootbox-alert div div div button.btn-primary{
         background-color: orange ;
     }

 .bootbox-alert div.bootbox-body{
       /*  background-color: blue !important;*/
       color:  black;
     }

.bootbox-input {
  height: 100px !important;
}
 

:root {
  --borderWidth: 7px;
  --height: 24px;
  --width: 12px;
  --borderColor: #78b13f;
}

span.checkmark {
  display: inline-block;
  transform: rotate(45deg);
  height: var(--height);
  width: var(--width);
  border-bottom: var(--borderWidth) solid var(--borderColor);
  border-right: var(--borderWidth) solid var(--borderColor);

}

/* checkmark css */

   
/* bootbox  css above  */  
 /* h1 {
    color: blue;
   font-weight: bold;
  }*/

 /* label.control-label {
    
    color: black ;
   }
*/

 /* .form-group .control-label, .form-group-default .control-label {
    
      color: white ;
  } */
   
  label.error {
    color: #880e4f !important;
  }

  label.website_error {
    color: #880e4f !important;
  }

   label.first_name_error {
    color: #880e4f !important;
  }


  label.success {
    color: #388e3c !important;
  }

.row.othdtl {
  padding: 0px !important;
}

.clsource {
  color: blue;
}


.csrperson {
  color: blue;
}

.clcountry {
  color: blue;
}


  input[type] {
     /*color: #FF5722;*/
     color: blue;
    
   }
  
 select[type] {
     /*color: #FF5722;*/
     color: blue;
    
   }
 
  #timezone_type {
     color: #FF5722;
     
   }

  #store_type {
     color: #FF5722;
    
   }

table#comp.table {
  margin-bottom: 0px !important;
}


.clstate {
  color: blue;
}

.editOption {
  color: blue;
}


.hidemsg {
  color: blue ;
}

.toggle-group label, .toggle-group span {
    cursor: pointer;
    color: white;
    font-size: 10px;
    padding-top: 8px;
    font-weight: bold;
    /*height: 40px;*/
}




/*tbody.fullname tfoot tr{
  padding-bottom: 0px !important ;
  margin-bottom: 0px !important;
  height: 8vh  !important;
}*/

table#comp tbody td {
         padding-top: 5px;
        padding-bottom: 2px;
        border-top: 0px;
        font-size: 14px;
      
         
    }


table#comp td, th {
  position: relative;
   background: transparent ;
  
  white-space: nowrap;  
   
}    

</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
      <h3>Edit Client </h3>
    </div>
    <div class="col-md-4">
        <a href="{{route('clients.index')}}" class="btn btn-primary btn-outline mt-3 rightdiv">Back</a> 
    </div>
</div>
<!-- <p class="lead">Add to your task list below.</p>
<hr> -->

 <div class="card temcolor1">
   
<meta name="csrf-token" content="{{ csrf_token() }}">


@if(Session::has('flash_message'))
    <div class="alert alert-warning">
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


<div class="card-body">
 
{!! Form::model($client,['method' => 'PATCH','route'=>['clients.update',$client->id]]) !!}


<!-- <input class="btn btn-large btn-primary confappr" type="submit" value="Approve">  -->
 
<input type="hidden" class="flagaprv" name="approve_flag" value=" ">

<input type="hidden" name="_token" value="{{ csrf_token() }}">
 
<!-- <a href="#" style="float:right" class="btn btn-info compinfo">Company Details</a> -->

<div class="row">
  <div class="col-md-4">
    <div class="form-group"> 
        <input type="hidden" class="comp_id" name="company_id" value="{{ $client->company_id }}">
    
        {!! Form::label('client_company', 'Company', ['class' => 'control-label']) !!}
        {!! Form::text('client_company', null, [ 'class' => 'form-control compadd' , 'minlength' => '2' ]) !!}
        <label id="client_company_error" class="error" for="client_company"></label>
        <label id="client_company_success" class="success" for="client_company"></label>
   </div>
  </div> 

  <div class="col-md-4">
    <div class="form-group">     
       {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
       {!! Form::text('website', null, ['class' => 'form-control addwebsite']) !!}
       <label id="website_error" class="website_error" for="website"></label>
       <label id="website_success" class="success" for="website"></label>
    </div>
  </div> 


  <div class="col-md-3">
    <div class="form-group">      
      {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
      {!! Form::text('phone', null, ['class' => 'form-control ', 'required' => 'required']) !!}
    </div> 
  </div>

  <div class="col-md-1">        
    <div class="form-group"> 
     {!! Form::label('red_list', 'BlackList', ['class' => 'control-label']) !!}

      @if( $client->red_list == "Y")
         <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control1 open"  value='Y' onchange="Mychangecompany(this)" checked>
      @else
         <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control1 open" value='N' onchange="Mychangecompany(this)">
        

      @endif
     <!--  {!! Form::label('red_list', 'BlackList', ['class' => 'control-label']) !!}
      @if( $client->red_list == "Y")
          <input type="checkbox" name="red_list" value='Y' class="mredlist largerCheckbox form-control"    checked="checked" />
      @else
          <input type="checkbox" name="red_list"  value='N' class="mredlist largerCheckbox form-control" >
      @endif -->
      <input type="hidden" name="red_list" class="mred" id="blacklistcompany" value="{{$client->red_list}}">
      <input type="hidden" name="red_list_details" id="blacklistcompanyreason" class="red_reason" value="{{$client->red_list_details}}">
           <!--  {!! Form::hidden('red_list_details', null, ['class' => 'red_reason']) !!}  -->
    </div>
  </div>
</div>   


    
<div class="row" id="client_dtl">
      @php
              $re=0; 
              $delval=0; 
           @endphp
  @foreach ($clientdtls as $dtl)
  @php
    $delval++; 
  @endphp
  <div class="row deleteclient ml-1 mr-1">  
  <div class="col-md-2 fullname"> 
    <div class="form-group">
      <input type="hidden" class="cdtl_id" name="cdtlid[]" value="{{$dtl->id}}">
      <input type="hidden" name="client_creation_id[]"  value="{{ $dtl -> client_creation_id }}">
  
      <label for="first_name">First Name</label><input type="text" name="first_name[]" class=" form-control addfname" 
          value="{{ $dtl -> first_name }} "  required="required"> 
      <label id="first_name_error" class="first_name_error" for="first_name"></label>
      <label id="first_name_success" class="success" for="first_name"></label>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
         <label for="last_name">Last Name</label><input type="text" name="last_name[]" value="{{ $dtl -> last_name }} " class="form-control addlname" >
    </div>              
  </div>

  
  <div class="col-md-2">
    <div class="form-group">
        <label for="client_email_primary">Email</label><input type="email" name="client_email_primary[]" placeholder="Email" value ="{{ $emails = $dtl -> client_email_primary }}" class="form-control emailcheck" required="required">
        <label id="client_email_primary_error" class="client_perror" for="client_email_primary"></label>
        <label id="client_email_primary_success" class="success" for="client_email_primary"></label>
        <span class="client_perror1"></span>
    </div>    
  </div>

  <div class="col-md-2">
    <div class="form-group">
          <label for="client_contact_1">Contact</label>
          <input type="text" name="client_contact_1[]" class="form-control" 
                value="{{ $dtl -> client_contact_1 }}" required="required">
    </div>            
  </div>
    
  <div class="col-md-2">  
    <div class="form-group">
          <label for="client_note">Note</label><input type="text" name="client_note[]" value="{{ $dtl -> client_note }}" class="form-control" >
    </div>            
  </div>
@permission('client.delete')
  <div class="col-md-1">
    <div class="form-group">
      <label style="color: white;">ghghg</label>
      <a href="javascript:void(0);" class="btn btn-danger btn-outline delete">Delete</a>
       <input type="hidden" class="cdid" name="cdid[]" value="{{ $dtl -> id }}">
    </div>
  </div>
@endpermission
  <div class="col-md-1">
    <div class="form-group">
          <label for="black_list">BlackList</label>
           @php
              $re++; 
           @endphp
          @if( $dtl->black_list == "Y")

              <input type="checkbox"  data-toggle="toggle" data-on="Block"  data-off="Unblock"data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="75" class="form-control5 open" onchange="myChangerevblock('{{$re}}',this,'offstatus')" checked>
              <input type="hidden" name="black_list[]" id="blacklist{{$re}}" class="blacklist" value='{{ $dtl->black_list }}'> 
              <input type="hidden" name="black_list_reason[]" id="blacklistreason{{$re}}" class="black_reason" value="{{ $dtl -> black_list_reason }}"> 

          @else
            <input type="checkbox"  data-toggle="toggle" data-on="Block" data-off="Unblock" data-size="sm"  data-onstyle="danger" data-offstyle="info"  data-width="70" class="form-control5 open" onchange="myChangeblock('{{$re}}',this,'onstatus')" id="ddddsa{{$re}}">
              <input type="hidden" name="black_list[]" id="blacklist{{$re}}" class="blacklist" value='{{ $dtl->black_list }}'> 
              <input type="hidden" name="black_list_reason[]" id="blacklistreason{{$re}}" class="black_reason" value="{{ $dtl -> black_list_reason }}"> 
          @endif
          
               
    </div>
  </div> 
  </div>

     
     <!--    <tr><td> <button class ="button btn-md  clientspecific"  type="button"><span class="checkmark"></span> </button></td></tr>
      -->
  @endforeach
<input type="hidden" value="{{$delval}}" id="deleteid">

</div>
  
<div class="row">
  <div class="col-md-2">
    <div class="form-group">
      <label  for="client_specific"><b style="color: white;">hggsadshjk</b></label>  
      <a id="addrow" href="javascript:void(0);" class="btn btn-success btn-outline add">Add Client</a> 
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label  for="client_specific">Client Specification</label> 
      

        <a  href="javascript:void(0);" class="btn btn-primary btn-outline clientspecific">Click to Display</a>
      
    </div>
  </div> 

  <div class="col-md-6">
    <div class="form-group">
          {!! Form::label('client_specific', 'Client Special Details') !!}
          {!! Form::textarea('client_specific', null, ["class" => "form-control client_specific", "rows"=>'3', "cols"=>'10', "readonly" =>"readonly"]) !!}
    </div>
  </div>  
</div>  
             
    
<div class="row othdtl">

      <div class="form-group col-md-4" >
        {!! Form::label('client_address1', 'Address', ['class' => 'control-label']) !!}
        {!! Form::text('client_address1', null, ['class' => 'form-control addaddr']) !!}
        <input type="text" placeholder="Address line 2" class="form-control mt-2" name="client_address2">
      </div>
     
      <div class="form-group col-md-3" >
        {!! Form::label('client_country', 'Country', ['class' => 'control-label']) !!}
        {!! Form::select('client_country', ['select' =>'Select Country First', 'US' =>'US', 'UK' =>'UK','CANADA' =>'CANADA', 'AUSTRALIA' => 'AUSTRALIA', 
            'NEW ZEALAND' =>'NEW ZEALAND','other'=>'other'] , null,  ['class' => 'form-control clcountry']) !!}
      </div>

      <div class="form-group col-md-3" >
          {!! Form::label('client_state', 'State', ['class' => 'control-label stateupd']) !!}
          {{-- <div id="unq" class="stateupd"></div>  --}}
        
          <select required="required" class="form-control clstate"  id="client_state" name="client_state">
          
               <option value="{{ $client->client_state }}" selected="selected">{{ $client->client_state }}</option>
 

          </select>
        
          @if($client->other_state <> "")
            <input name="other_state" class="editOption"  placeholder="Text " 
             value="{{ $client->other_state }}">
          @else
              <input name="other_state" class="editOption"  style="display:none;" placeholder="Text " 
             >

          @endif
           <!--   -->
      </div>

      <div class="form-group col-md-2">
        {!! Form::label('timezone_type', 'TimeZone Type', ['class' => 'control-label']) !!}
        {!! Form::select('timezone_type',  [ 'EST' => 'EST', 'CDT' => 'CDT','MDT' => 'MDT', 'PDT' => 'PDT'],  null, ['class' => 'form-control timez', 'required'=>'required' ]) !!}
        <div class="hidemsg">Press Enter to Select</div>
      </div>
   
</div>  

<div class="row othdtl">
 
      

      <div class="form-group col-md-2">
        {!! Form::label('unit_price', 'Unit Price', ['class' => 'control-label']) !!}
        {!! Form::text('unit_price', null, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group col-md-2">
         {!! Form::label('digit_rate', 'Emb. Rate', ['class' => 'control-label']) !!}
         {!! Form::text('digit_rate', null , ['class' => 'form-control']) !!}
      </div>

      <div class="form-group col-md-2">
      
    
        {!! Form::label('store_type', 'Store Type', ['class' => 'control-label']) !!}
        {{-- {!! Form::text('store_type', null, ['class' => 'form-control']) !!} --}}
      
        {!! Form::select('store_type', ['Retail' => 'Retail', 'Contract' => 'Contract','Other' => 'Other'], null, ['class' => 'form-control stype']) !!}

      </div> 

      <div class="form-group col-md-3">

         {!! Form::label('client_source', 'Client Source', ['class' => 'control-label']) !!}
         {!! Form::select('client_source', ['Telephone' => 'Telephone', 'Email' => 'Email',
         'Internet' => 'Internet', 'Other' => 'Other'], null, ['class' => 'form-control clsource']) !!}

      </div>

      <div class="form-group col-md-3">

         {!! Form::label('csr_personid', 'Sales Executive', ['class' => 'control-label']) !!}
         {!! Form::select('csr_personid', $csr, null, ['class' => 'form-control csrperson']) !!}
         <span>{{ $client->csr_person }}</span>

      </div>
  
</div>
     
    <!-- </div> -->
  

<!-- <div class="form-group">
    {!! Form::label('client_contact_2', 'Contact 2', ['class' => 'control-label']) !!}
    {!! Form::tel('client_contact_2', null, ['class' => 'form-control txtinput']) !!}
</div>


<div class="form-group">
    {!! Form::label('other_contact', 'Other contact', ['class' => 'control-label']) !!}
    {!! Form::tel('other_contact', null, ['class' => 'form-control']) !!}

    REMOVED ON 29/10/2016 AS  NOT WORKING
                      echo '<div class="multipleInput-container">';                       
                      //var_dump($emails);die;
                      echo "<u1>" ;
                      $splittedstring=explode(",",  $emails  ); 
                      
                         foreach ($splittedstring as $key1 => $value) {
                               //echo // "splittedstring[".$dtl."] = ".$value."<br>";
                                 echo "<li class='multipleInput-email'><span>" ;
                                 echo $value ;
                                 echo "</span><a href='#' class='multipleInput-close' title='Remove'></a></li>";
                                 
                                   } 
                       echo "</u1></div" ;            

    
</div> -->

   <!--  <div class="col-sm-4">
      
    </div> -->
  <!-- @if( Auth::user()->name  =='prashant' || Auth::user()->name  =='kulind'  )
    <div class="row">
      <div class="form-group col-sm-4">
         {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
         {!! Form::text('amount', null,  ['class' => 'form-control ']) !!}
      </div>

      <div class="form-group col-sm-4">
         {!! Form::label('type_of_work', 'Type of Work', ['class' => 'control-label']) !!}
         {!! Form::text('type_of_work', null,  ['class' => 'form-control']) !!}
      </div>

      <div class="form-group col-sm-4">
         {!! Form::label('time_limit', 'Time', ['class' => 'control-label']) !!}
         {!! Form::text('time_limit', null,  ['class' => 'form-control']) !!}
      </div>
</div>
@endif -->

<div class="row">
    <div class="col-md-7">
        {!! Form::submit('Submit',['class' => 'btn btn-warning btn-wd btn-outline rightdiv chkerror']) !!}
    </div>

 </div>   
    
</div>



{!! Form::close() !!}

<!--  added  below code for history -->

<div class="table-responsive">

<table id="table_history" class="table table-bordered table-striped">
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
</div>
</div>


<!-- client specification modal popup -->


<div class="modal fade"  tabindex="-1" role="dialog" id="clientspecificmodal" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Client Specification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <textarea class="form-control" id="specificationtext"  placeholder="Enter Text Here" style="height: 90px;"></textarea>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-outline" id="writespecification">Save changes</button>
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
         <input type="hidden" id="clientboxid" value="">
      </div>
    </div>
  </div>
</div>


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

<!--  added above code for history -->

@include('pages.clients.modals.company_list')

@endsection

@section('script')

<script type="text/javascript">

$( document ).ready(function() {
 // $("Form").validate();

  // prevent enter key on any text box  added on 14/01/2020

   $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

   $('textarea').keypress(function(event) {

if ((event.keyCode || event.which) == 13) {

    event.preventDefault();
    return false;

  }

});


  // prevent enter key on any text box added on 14/01/2020

   $(".timez").focusout(function(event) {
      /* Act on the event */

        $(".hidemsg").css("display", "none");
    });

    $(".timez").focusin(function(event) {
      /* Act on the event */
         $(".hidemsg").css("display", "inline-block");
    });

     $(".stype").focusout(function(event) {
      /* Act on the event */

        $(".hidemsg1").css("display", "none");
    });


 //     $(".clientspecific").click(function(event){

   $(".clientspecific").on('click', function() { 
            // debugger;
        

          var text1 =  $(".client_specific").val();
           $("#specificationtext").val(text1);
           $( "#clientspecificmodal" ).modal("show");

        

         // alert(text1);

         //$("bootbox-input bootbox-input-textarea").text(text1);

         // bootbox.prompt({
         //           title: "Enter Details",
         //              inputType: 'textarea',
         //              value: text1,
         //              callback: function (result) {
         //                      console.log(result);
         //                 if (result === null)    {
         //                      return true;
         //                 }
         //                else {
         //                        $(".client_specific").val(result);
         //                }
         //              }
                     
         //            })

        

      }); 
   //add client specification in textbox 
   $("#writespecification").on('click', function() {    
       var text1 =  $("#specificationtext").val();
        var text2=$(".client_specific").val(text1);
        if(text1 == ""){
           Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please Enter Text..'
          })
        }
        else{
           $( "#clientspecificmodal" ).modal("hide");
        }

   });   
          

  $("input.mredlist").on('change', function() { 
            // debugger;
        if(this.checked) {
                    
                    

          var area = $(this);

         
          $(area).closest("tr").find("input.mred").val('Y');

          var text1 =  $(area).closest("tr").find("input.red_reason").val();
         // alert(text1);

         //$("bootbox-input bootbox-input-textarea").text(text1);

         bootbox.prompt({
                   title: "Enter Company Reason for Black List",
                      inputType: 'textarea',
                      value: text1,
                      callback: function (result) {
                              console.log(result);
                         if (result === null)    {
                              return true;
                         }
                        else {
                             //alert(result);

                             $(area).closest("tr").find("input.red_reason").val(result);
                               // $(".black_reason").val(result);
                        }
                      }
                     
                    })

        } 
        else {
            var area = $(this);
          $(area).closest("tr").find("input.mred").val('N');
        }

      });         

  $("input.redlist").on('change', function() { 
             //debugger;
        if(this.checked) {

           /// $(this).val('Y');

          var area = $(this);

          $(area).closest("tr").find("input.blacklist").val('Y');

          var text1 =  $(area).closest("tr").find("input.black_reason").val();
         // alert(text1);

         //$("bootbox-input bootbox-input-textarea").text(text1);

         bootbox.prompt({
                   title: "Enter Reason for Black List",
                      inputType: 'textarea',
                      value: text1,
                      callback: function (result) {
                              console.log(result);
                         if (result === null)    {
                              return true;
                         }
                        else {
                             //alert(result);

                             $(area).closest("tr").find("input.black_reason").val(result);
                               // $(".black_reason").val(result);
                        }
                      }
                     
                    })

        } 
        else {
             var area = $(this);
           $(area).closest("tr").find("input.blacklist").val('N');
        }

      });         




    $(".chkerror").click(function(event) {
      /* Act on the event */
     
       //event.preventDefault();
       if($(".addaddr").val()=="") {
           alert("Address cannot be Blank");
         event.preventDefault();
          return false;
          }
      
    $('input[name^="client_email_primary"]').each(function() {
   // $(".dupl").each(function() {
  
       //var $email1 = $(this).closest('tr').find('.dupl').val();
       var $email1 = $(this).val();
       //alert($email1);


       if  ($email1 == "") {
             $(this).closest("tr").find(".client_perror").text("Invalid Email Id"); 
             alert("Invalid Email Id");
              event.preventDefault();
         //alert(email);
       }
             
      }); 

      // var ret = check_duplicate_email();
       //alert(ret);
      
     //  if(ret == false || ret == undefined) {
     //     event.preventDefault();
     //  }
     //    return ret ;
      //if (!check_duplicate_email()) {
      //    alert("error");

      //    return false;
     // }
      return true;

    });


    myFunc();  

});



// added for tab movement  

// very important script for trap keypress
  // var inputs = $('input, select, textarea').keypress(function (e) {
  //    //debugger;
  //   // alert(e.which);
  //   if (e.which == 9 || e.which == 13) {
  //       e.preventDefault();
  //       var nextInput = inputs.get(inputs.index(this) + 1);
  //       if (nextInput) {
  //           nextInput.focus();
  //           }
  //       }
  //   });


   // var inputs1 = $('input, select, textarea').keydown(function (e) {
     //debugger;
     //alert(e.which);
   // if (e.which == 9 || e.which == 13) {
     
        //e.preventDefault();
    //    var nextInput = inputs1.get(inputs1.index(this) + 1);
     //   if (nextInput) {
     //       nextInput.focus();
     //       }
     //   }
    //});

    // very important script for trapping key over
// added above for tab movement


$(".compadd").focusout(function(event) {
  /* Act on the event */
  // alert($(this).val());
   var value =  $.trim($(this).val());
       $(this).val(value);

  if ($(this).val() == "") {
      $(this).closest("tr").find("#client_company_error").text("This field is required"); 
  }
  else {
       $(".compadd").css("text-transform", "capitalize");
  }

  // added below important code for publishing on 12/10/18
  
 
  var comp_id  =  $(".comp_id").val();


  var formData = {client_company: value, company_id: comp_id } ;
                            console.log(formData);
  
  $.ajax({
          type: "GET",
          cache: false,
          async: true,
          datatype: "json",
          url: "{{ URL::to('clients/getcompanynm') }}",
          data: formData,
          success: function(response)
          { 
            console.log(response[0].old_name) ; 
                           
            if (response[0].old_name == value) {
                return true;
              }
            else 
            {
                alertify.confirm('Confirm Change of Company Name, Related Orders will be changed', function(){ alertify.success('Ok') }, function(){ 
                      alertify.error('Cancel');
                      $(".compadd").val(response[0].old_name);
                });

            }  
            
        
          }
          });
          return true;


  // added above imp code  on 12/10/18




});

$(".compadd").dblclick(function(e){
  
     var comp_name =  $.trim($(this).val());

      if(comp_name.length > 0 ){
                alert(comp_name);
                $("#compmodal").modal('show');
               
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "{{ URL::to('clients/getrelatedcomp') }}",
                    data: {"search": comp_name},
                    success:function(data)
                    {
                        $("#complist tbody").html(data);
                    }
        
                });
        }
        else
        {
            alert("Client Name cannot be Blank")
        }


});



$( ".fullname" ).on( "focusout", '.addfname',  function() {
    //$(".addfname").focusout(function(event) {
      /* Act on the event */

      var value =  $.trim($(this).val());
      $(this).val(value);    
      var fname = $(this).val().trim();
  // alert(fname.length);
  if (fname.length === 0) {
      $(this).closest("tr").find(".first_name_error").text("This field is required"); 
  }
  else {
      $(this).closest("tr").find(".addfname").css("text-transform", "capitalize");
      $(this).closest("tr").find(".first_name_error").text(" ");
      $(this).closest("tr").find("#first_name_success").text("Success"); 
      $(this).closest("tr").find("#first_name_success").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  }

});



//$(".addlname").focusout(function(event) {
$( ".fullname" ).on( "focusout", '.addlname',  function() {  
  /* Act on the event */
  // alert($(this).val());
  // if ($(this).val() == "") {
  //     $(this).closest("tr").find("#last_name_error").text("This field is required"); 
  // }
  // else {
      var value =  $.trim($(this).val());
      $(this).val(value);
      $(".addlname").css("text-transform", "capitalize");
  //}

});

$(".addaddr").focusout(function(event) {
 
  //i alert('hhh');
  $(".addaddr").css("text-transform", "capitalize");
 
});



$(".addwebsite").focusout(function(event) {
  /* Act on the event */
  // alert($(this).val());
  var websiteval =  $(this).val();

  //ar urlregex = new RegExp(         "^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
  //alert(websiteval);

  var urlregex = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)/ ;
  // var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

  if (!urlregex.test(websiteval)) {
       //alert("error");
      $(this).closest("tr").find(".website_error").text("Not Valid Url"); 
  }
  else {
     $(this).closest("tr").find(".website_error").text(" ");
           $(this).closest("tr").find("#website_success").text("Success"); 

          $(this).closest("tr").find("#website_success").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  }

});

$(".clcountry").change(function(e) {

  //alert(this.value);
  $value =  this.value ;

  $('#client_state').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");

    if (this.value == 'US') {

        //      $.ajax({
        //     type: "GET",
        //     cache: false,
        //     url: "{{ URL::to('clients/search') }}",
        //     data: {"search": $value},
        //     success:function(data)
        //           {
        //             //$(".clstate").after(data);
        //           }
        
        // });
      
        // var state=["Mumbai","Delhi","Chennai","Goa"];
        var state = "{{ json_encode($usstates) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());

    }
     else if (this.value == 'UK') {

        var state = "{{ json_encode($ukcities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
       // alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
    else if (this.value == 'CANADA') {

        var state = "{{ json_encode($canadastates) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
    else if (this.value == 'NEW ZEALAND') {

        var state = "{{ json_encode($newzealandcities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
      else if (this.value == 'AUSTRALIA') {

        var state = "{{ json_encode($australiacities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
    else {

        var myselect = $('<select>');

        myselect.append( $('<option></option>').val('other').html('other') );
        $('#client_state').append(myselect.html());


    }
    


});


$(".clstate").change(function(e) {
  
  var optionText = $('.clstate').val();
  var optionText = optionText.trim();
  /* Act on the event */
  if (optionText =="other" ){
        $('.editOption').show();  
        $('.editOption').focus(); 
  
        $('.editOption').keyup(function(){
            var editText = $('.editOption').val();
            $('.editOption').val(editText);
            $('.editOption').html(editText);
            
        });

       }
  else{
        //alert("hello");
        $('.editOption').val("");
        $('.editOption').html("");
        $('.editOption').hide();
    }
});




$(".emailcheck").focusout(function(event) {

  var eml = $(this);
 // alert(eml);
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      
      var v1 = $(this).val();
     // alert(v1);
      if (!filter.test(v1)) {
          $(this).closest("tr").find(".client_perror").text("Invalid Email Id "); 
          //alert("invalid");
          return false;
        }
      else {   

           $(this).closest("tr").find(".client_perror").text(" ");
           $(this).closest("tr").find(".client_perror").text("Success"); 

          $(this).closest("tr").find(".client_perror").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
        }
 

    var $email= [];
    var cnt = 0 ;
   // debugger;
    $(this).closest("tr").find(".client_perror").text(" ");
    $cdtlid = $(this).closest("tr").find(".cdtl_id").val();
    
    //$('input[name^="client_email_primary"]').each(function() {
         
       //var $email1 =  v1;
       //  alert($email1);
       //$email.push($email1);
         
       // alert($email.length);
       // for (var i = 0; i < $email.length; i++) 
       //  {
       //      for (var j = i+1; j < $email.length; j++) 
       //      {                  
       //              if ($email[i] == $email[j]) 
       //              {
       //                  $(this).closest("tr").find(".client_perror").show();
       //                  $(this).closest("tr").find(".client_perror").text("Duplicate Email Id"); 
       //                  alert("duplicate email id");
       //                  return false; // means there are duplicate values
       //              }

       //      }
       //  }
    
      //     var _token = $('#_token').val(); 
           //alert($email);
            var formData = {   email: v1 , cdtlid: $cdtlid}
                           // console.log(formData);
                        $.ajax({
                              type: "GET",
                              cache: false,
                              async: true,
                              datatype: "json",
                              url: "{{ URL::to('clients/getemailforupd') }}",
                              data: formData,
                            beforesend : function(data) {  console.log(data) ;},
                            error       : function(err) { alert("Could not connect to the registration server."); },
                            success: function(response)
                            { 
                            console.log(response) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                           
                             if (response < 1) {

                                  $(this).closest("tr").find(".client_perror").text("Email is Valid"); 
                                  $(".client_perror").fadeIn('normal', function(){
                                  setTimeout(function(){
                                  $(".client_perror").fadeOut("slow");
                                                  },4000);
                                              });
                                 return true;
                               }
                              else
                              {
                                  
                                  $(this).closest("tr").find(".client_perror").text("Duplicate Email Id, Already used"); 
                                  $(this).closest("tr").find(".client_perror").show();
                                  $(this).closest("tr").find(".client_perror1").text("Duplicate Email Id, Already used"); 
                                  // $(".messg").fadeIn('normal', function(){
                                  // setTimeout(function(){
                                  // $(".messg").fadeOut("slow");
                                  //                 },4000);
                                  //             });
                                  console.log("duplicate email id");

                                 return false ;
                              }
        
                            }
                        });
                        return true;

     
  // check_duplicate_email;
  return true;
  
});





$( ".fullname" ).on( "focusout", '.emailcheck',  function(event) {
  var eml = $(this);
  
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     
      var v1 = $(this).val();
      var v2 = $(this);
      //alert(v1);
      if (!filter.test(v1)) {
          $(this).closest("tr").find(".client_perror").text("Invalid Email Id "); 
          //alert("invalid");
          return false;
        }
      else {   

           $(this).closest("tr").find(".client_perror").text(" ");
           $(this).closest("tr").find(".client_perror").text("Success"); 

          $(this).closest("tr").find(".client_perror").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
        }
  
 
  var $email= [];
  var cnt = 0 ;
  $(this).closest("tr").find(".client_perror").text(" ");
   $cdtlid = $(this).closest("tr").find(".cdtl_id").val();
  // alert($cdtlid);
     
  $('input[name^="client_email_primary"]').each(function(e) {
 //  $('.emailcheck').each(function(e) {
           // debugger;
           var $email1 =  $(this).val();
           var v2 = $(this);
         //alert($email1);
       $email.push($email1);
         
       // alert($email.length);
       for (var i = 0; i < $email.length; i++) 
        {
            for (var j = i+1; j < $email.length; j++) 
            {                  
                    if ($email[i] == $email[j]) 
                    {
                        $(v2).closest("tr").find(".client_perror").show();
                        $(v2).closest("tr").find(".client_perror").text("Duplicate Email Id"); 
                        //alert("duplicate email id");
                        // e.preventDefault();

                        return false; // means there are duplicate values
                    }

            }
        }
        $(v2).closest("tr").find(".client_perror").text(""); 
      //     var _token = $('#_token').val(); 
           //alert($email);
             $tmp = $(this).val(); 
            var formData = {   email: $email1, cdtlid: $cdtlid }
                           // console.log(formData);
                        $.ajax({
                              type: "GET",
                              cache: false,
                              async: true,
                              datatype: "json",
                              url: "{{ URL::to('clients/getemailforupd') }}",
                              data: formData,
                            beforesend : function(data) {  console.log(data) ;},
                            error       : function(err) { alert("Could not connect to the registration server."); },
                            success: function(response)
                            { 
                            console.log(response) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                           
                             if (response === 0 ) {

                                  $(v2).closest("tr").find(".client_perror").text("Email is Valid"); 
                                  $(v2).closest("tr").find(".client_perror").fadeIn('normal', function(){
                                  setTimeout(function(){
                                  $(v2).closest("tr").find(".client_perror").fadeOut("slow");
                                                  },4000);
                                              });
                                 return true;
                               }
                              else
                              {
                                 // $(this).closest("tr").find(".client_perror").show();
                                 // debugger;
                                
                                 if ($tmp === $email1) {
                                 $(v2).closest("tr").find(".client_perror").text("Duplicate Email Id, Already used"); 
                                   }
                                  // $(v2).closest("tr").find(".client_perror").fadeIn('normal', function(){
                                  //setTimeout(function(){
                                 // $(v2).closest("tr").find(".client_perror").fadeOut("slow");
                                 //                 },4000);
                                 //             });
                                  //$(v2).closest("span").html("Duplicate Email Id, Already used"); 
                                  // $(".messg").fadeIn('normal', function(){
                                  // setTimeout(function(){
                                  // $(".messg").fadeOut("slow");
                                  //                 },4000);
                                  //             });
                                  console.log("duplicate email id");
                                  //event.preventDefault();
                                 return false ;
                              }
        
                            }
                        });
                        return true;



      });


  return true;
  
});


$( ".fullname" ).on( "focusout", '.dupl',  function() {
    /* Act on the event */
    //$("form").validate();
    // alert("hello");
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      
    var v1 = $(this).closest('tr').find('.dupl').val();
      //alert(v1);
    if (!filter.test(v1)) {
        $(this).closest("tr").find(".client_perror").text("Invalid Email Id "); 
        }
    else {   

        $(this).closest("tr").find(".client_perror").text(" ");
        $(this).closest("tr").find(".client_perror").text("Success"); 

        $(this).closest("tr").find(".client_perror").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
        }
    
 });
    
   
    $('.add').click(function(){
        // var product = $('.product_id').html();  <th class="no">'+n+'</th>' 
          // '<td><input type="text" name="client_email_primary[]" class="qty form-control"></td>' +
          //         '<td><input type="text" name="client_email_secondary[]" class="price form-control"></td>' +
          //         '<td><input type="text" name="client_address1[]" class="dis form-control"></td>' +
          //         '<td><input type="text" name="client_state[]" class="dis form-control"></td>' +
          //         '<td><input type="text" name="client_country[]" class="dis form-control"></td>' +
        
        var tr = '<div class="row pr-3 pl-3"><div class="col-md-2"><div class="form-group"><label for="first_name">First Name</label><input type="text" name="first_name[]" class=" form-control addfname"><label id="first_name_error" class="first_name_error" for="first_name"></label><label id="first_name_success" class="success" for="first_name"></label></div></div><div class="form-group col-md-2"><label for="last_name">Last Name</label><input type="text" name="last_name[]" class="form-control addlname"></div><div class="col-md-2"><div class="form-group"><label for="client_email_primary">Email</label><input type="email" name="client_email_primary[]" placeholder=" Email" class="form-control emailcheck" required="required"><label id="client_email_primary_error" class="client_perror" for="client_email_primary"></label><label id="client_email_primary_success" class="success" for="client_email_primary"></label><span class="client_perror1"></span></div></div><div class="col-md-2"><div class="form-group"><label for="client_contact_1">Contact</label><input type="text" name="client_contact_1[]" class="form-control" required="required"></div></div><div class="col-md-2"><div class="form-group"><label for="client_note">Note</label><input type="text" name="client_note[]" class="form-control" required="required"></div></div><div class="col-md-2"><div class="form-group"><label style="color:white;">sdaaxzczxzxzxc</label><a href="javascript:void(0);" class="btn btn-danger btn-outline" onclick="myDelete(this)">Delete</a></div></div></div>';
        $('#client_dtl').append(tr);
    });


     $( ".delete" ).on( "click",  function() {
      var childid =  $("#deleteid").val();
       if(childid != 1){ 
        Swal.fire({
              title: 'Are you sure?',
              text: "You want delete this client!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                var comp_flag = '';
                $.ajaxSetup({
                       headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                         }
                  }); 

                   var id1 = $(this).next().val();
                    if (id1)
                   {  
                    var formData = {
                            id:  id1,
                            comp_flag: comp_flag
                            //_token: _token
                        }
                            
                        $.ajax({
                            type: "GET",
                            cache: false,
                            datatype:"JSON",
                            url:"updateclientdtl",
                            data: formData,
                            success: function(result)
                            { 
                                var res = result[0].msg ;
                                console.log(result[0].msg) ; 
                                //alert('hello');
                           
                            }
                        });
                    }
           
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                 $(this).closest('.deleteclient').remove();
                 $("#deleteid").val(childid - 1);
                
                 
            }
            else{
                 Swal.fire(
                  'You canceled delete operation.',
                )
            }
        })
        }
        else{
          Swal.fire(
                            'Delete operation not perform on this Client.',
                           ) 
        }

          
    });

       
    $(".compinfo").on("click", function() {
        $('#comp').toggle();
    });
    

    // Routing for  multiple email insert
  
// $('.tm-input').multipleInput();


//$("#client_dtl tbody td .emailcheck").focusout(function(event) {
  /* Act on the event */
  // alert('hello email checking');
  // return false;
//  var eml = $(this);
 // if (!check_duplicate(eml)) {
   //    alert("error");
       //event.stopPropogation();
     //  return false;
 //    }

//});


function check_duplicate(var1) {
    //alert(var1.val());

    var $email= [];
    $('input[name^="client_email_primary"]').each(function() {
  
       var $email1 = $(this).closest('tr').find('.dupl').val();
         //alert(email);
       $email.push($email1);
           });

      for (var i = 0; i < $email.length; i++) 
        {
            for (var j = i+1; j < $email.length; j++) 
            {                  
                    if ($email[i] == $email[j]) 
                    {
                        $(this).closest("tr").find(".client_perror").show();
                        $(this).closest("tr").find(".client_perror").text("Duplicate Email Id"); 
                        $(this).closest("tr").find(".client_perror1").text("Duplicate Email Id");
                        return false; // means there are duplicate values
                    }

            }
        }
    
    
      //     var _token = $('#_token').val(); 
           alert($email);
            var formData = {   email: $email, cdtlid: $cdtlid }
                           // console.log(formData);
                        $.ajax({
                              type: "GET",
                              cache: false,
                              async: true,
                              datatype: "json",
                              url: "{{ URL::to('clients/getemailforupd') }}",
                              data: formData,
                            beforesend : function(data) {  console.log(data) ;},
                            error       : function(err) { alert("Could not connect to the registration server."); },
                            success: function(response)
                            { 
                            console.log(response) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                           
                             if (response == 0 || response == 1) {

                                  $(var1).closest("tr").find(".client_perror").text("Email is Valid"); 
                                  $(".client_perror").fadeIn('normal', function(){
                                  setTimeout(function(){
                                  $(".client_perror").fadeOut("slow");
                                                  },4000);
                                              });
                                 return true;
                               }
                              else
                              {
                                  $(var1).closest("tr").find(".client_perror").show();
                                  $(var1).closest("tr").find(".client_perror").text("Duplicate Email Id, Already used"); 
                                  // $(".messg").fadeIn('normal', function(){
                                  // setTimeout(function(){
                                  // $(".messg").fadeOut("slow");
                                  //                 },4000);
                                  //             });

                                 return false ;
                              }
        
                            }
                        });

     }



function check_duplicate_email() {
    // debugger;
    var $email= [];
    var cnt = 0 ;
    //$('.fullname input[name^="client_email_primary"]').each(function() {
      $(".emailcheck").each(function() { 
   // $(".dupl").each(function() {
  
       //var $email1 = $(this).closest('tr').find('.dupl').val();
       var $email1 = $(this).val();
       //alert($email1);
       if  ($email1 == "") {
             $(this).closest("tr").find(".client_perror").text("Invalid Email Id"); 
             return false;
         //alert(email);
       }
       $email.push($email1);
       
         
        
       for (var i = 0; i < $email.length; i++) 
        {
            for (var j = i+1; j < $email.length; j++) 
            {                  
                    if ($email[i] == $email[j]) 
                    {
                        $(this).closest("tr").find(".client_perror").show();
                        $(this).closest("tr").find(".client_perror").text("Duplicate Email Id"); 
                        return false; // means there are duplicate values
                    }

            }
        }
    
      //     var _token = $('#_token').val(); 
           //alert($email);
            var formData = {   email: $email, cdtlid: $cdtlid }
                           // console.log(formData);
                        $.ajax({
                              type: "GET",
                              cache: false,
                              async: true,
                              datatype: "json",
                              url: "{{ URL::to('clients/getemailforupd') }}",
                              data: formData,
                            beforesend : function(data) {  console.log(data) ;},
                            error       : function(err) { alert("Could not connect to the registration server."); },
                            success: function(response)
                            { 
                            console.log(response) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                           
                             if (response == 0 || response == 1) {

                                  $(this).closest("tr").find(".client_perror").text("Email is Valid"); 
                                  $(".client_perror").fadeIn('normal', function(){
                                  setTimeout(function(){
                                  $(".client_perror").fadeOut("slow");
                                                  },4000);
                                              });
                                 return true;
                               }
                              else
                              {
                                  $(this).closest("tr").find(".client_perror").show();
                                  $(this).closest("tr").find(".client_perror").text("Duplicate Email Id, Already used"); 
                                  // $(".messg").fadeIn('normal', function(){
                                  // setTimeout(function(){
                                  // $(".messg").fadeOut("slow");
                                  //                 },4000);
                                  //             });

                                 return false ;
                              }
        
                            }
                        });
                        return true;
                        });      

     }



(function( $ ){
 
     $.fn.multipleInput = function() {
 
          return this.each(function() {
 
               // create html elements
 
               // list of email addresses as unordered list
               $list = $('<ul />');
 
               // input
               //alert('hello');
               var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

               var $input = $('<input type="text" />').keyup(function(event) {
 
                    if(event.which == 32 || event.which == 188) {
                         // key press is space or comma
                         var val = $(this).val().slice(0, -1); // remove space/comma from value
                         //alert(val);
                          if (!filter.test(val)) {
                                alert("Invalid Email");
                                return false;
                              }


                         // append to list of emails with remove button
                         $list.append($('<li class="multipleInput-email"><span>' + val + '</span></li>')
                              .append($('<a href="#" class="multipleInput-close" title="Remove" />')
                                   .click(function(e) {
                                        $(this).parent().remove();
                                        e.preventDefault();
                                   })
                              )
                         );
                         $(this).attr('placeholder', '');
                         // empty input
                         $(this).val('');
                    }
 
               });
 
               // container div
               var $container = $('<div class="multipleInput-container" />').click(function() {
                    $input.focus();
               });
 
               // insert elements into DOM
               $container.append($list).append($input).insertAfter($(this));
 
               // add onsubmit handler to parent form to copy emails into original input as csv before submitting
               var $orig = $(this);
               $(this).closest('form').submit(function(e) {
 
                    var emails = new Array();
                    $('.multipleInput-email span').each(function() {
                         emails.push($(this).html());
                    });
                    emails.push($input.val());
 
                    $orig.val(emails.join());
 
               });
 
               return $(this).hide();
 
          });
 
     };
})( jQuery );
   function myDelete(thisdelete){
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            $(thisdelete).closest('.row').remove();
          }
          else{
             Swal.fire(
              'You canceled delete operation.',
            )
          }
        })
      
   }

  function myFunc()
  {
        
      var country =  "{{ $client->client_country }}" ;
      if ( country == 'US') {

        var state = "{{ json_encode($usstates) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());

      }
      else if (country  == 'UK') {

        var state = "{{ json_encode($ukcities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
       // alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
    else if (country  == 'CANADA') {

        var state = "{{ json_encode($canadastates) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
    else if (country == 'NEW ZEALAND') {

        var state = "{{ json_encode($newzealandcities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }
      else if (country  == 'AUSTRALIA') {

        var state = "{{ json_encode($australiacities) }}" ;
        var state =  state.replace(/&quot;/g,'"')
        //alert(state);
        var myselect = $('<select>');
       
        $.each(JSON.parse(state), function(index, key) {
               myselect.append( $('<option></option>').val(key).html(key) );
        });
      
        $('#client_state').append(myselect.html());


    }

    $('.clstate option').each(function() {
       var res = "{{ $client->client_state }}" ;
        if($(this).val() == res ) {
             $(this).prop("selected", true);
         }
    });

  }

  $(document).on('click', '.confappr', function(e) {
      var answer = confirm('Are you sure you want to Approve?');
      if (answer)
      {
          $(".flagaprv").val('Y');
          console.log('yes');
      }
      else
      {
          $(".flagaprv").val('N');
          console.log('cancel');
      }


  });

  $(document).ready(function(){
   $("input").not(".addaddr").on("cut copy paste",function(e) {
      e.preventDefault();
   });

});
  $(document).on('click', '#writecompanyblockreason', function(e) {
    
    var companytext=$('#companyblocktext').val();
     $('#blacklistcompanyreason').val(companytext);
       $( "#companyblockmodal" ).modal("hide");

  });
  $(document).on('click', '#writeclientblockreason', function(e) {
    
    var clienttext=$('#clientblocktext').val();
     var findclientid=$(this).next().val();
     $('#blacklistreason'+findclientid).val(clienttext);
    

       $( "#clientblockmodal" ).modal("hide");

  });

  
function myChangeblock(eventvalue,thisdata,stausonoff){
  var lastClass = $(thisdata).attr('class').split(' ').pop();


   //alert( $('#blacklist'+eventvalue).val());
if(lastClass == "bypassclass"){
        $(thisdata).removeClass(lastClass);
}   
else{
if(lastClass == "open"){
  if ($(thisdata).is(':checked')) {
        //switchStatus = $(thisdata).is(':checked')
    
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to block this client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
              if(stausonoff == 'onstatus'){
               $('#blacklist'+eventvalue).val('Y');
               $( "#clientblockmodal" ).modal("show");
               $('#clientboxid').val(eventvalue);
                 //alert( $('#blacklist'+eventvalue).val());
              }
              else{
                 $('#blacklist'+eventvalue).val('N');
                 //alert( $('#blacklist'+eventvalue).val());
              }

          }
          else{
              if(stausonoff == 'onstatus'){
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('off');
                 $('#blacklist'+eventvalue).val('N');
               }
               else{
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('on');
                 $('#blacklist'+eventvalue).val('Y');
               }


          }
      })
       
      
    }
    else{
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to unblock this Client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            if(stausonoff == 'onstatus'){
                $('#blacklist'+eventvalue).val('N');
                //alert( $('#blacklist'+eventvalue).val());
                console.log('unblock');

             }
             else{
                 $('#blacklist'+eventvalue).val('Y');
                // alert( $('#blacklist'+eventvalue).val());
             }
          }
          else{
            if(stausonoff == 'onstatus'){
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('on');
                 $('#blacklist'+eventvalue).val('Y');
                  console.log('block');

                // alert( $('#blacklist'+eventvalue).val());
             }
             else{
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('off');
                 $('#blacklist'+eventvalue).val('N');
                // alert( $('#blacklist'+eventvalue).val());
             }
          }
      })
    }
   }
   else{
     $(thisdata).removeClass(lastClass);
     $(thisdata).addClass('open');
   }
  }
 }
 function myChangerevblock(eventvalue,thisdata,stausonoff){

  var lastClass = $(thisdata).attr('class').split(' ').pop();
   //alert( $('#blacklist'+eventvalue).val());
if(lastClass == "bypassclass"){
        $(thisdata).removeClass(lastClass);
}   
else{
if(lastClass == "open"){
  if ($(thisdata).is(':checked')) {
        //switchStatus = $(thisdata).is(':checked')

        Swal.fire({
          title: 'Are you sure?',
          text: "You want to block this client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
               $('#blacklist'+eventvalue).val('Y');
                 //alert( $('#blacklist'+eventvalue).val());
                 console.log('block');
              
          }
          else{
             
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('off');
                 $('#blacklist'+eventvalue).val('N');
              
                 console.log('unblock');

          }
      })
       
      
    }
    else{
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to unblock this Client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            
                $('#blacklist'+eventvalue).val('N');
                //alert( $('#blacklist'+eventvalue).val());
                console.log('unblock');
           
          }
          else{
         
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('on');
               $('#blacklist'+eventvalue).val('Y');
                  console.log('block');
                // alert( $('#blacklist'+eventvalue).val());
             
          }
      })
    }
   }
   else{
     $(thisdata).removeClass(lastClass);
     $(thisdata).addClass('open');
   }
  }
 }

 function Mychangecompany(thisdata){

 var lastClass = $(thisdata).attr('class').split(' ').pop();
 
if(lastClass == "open"){
  if ($(thisdata).is(':checked')) {
        //switchStatus = $(thisdata).is(':checked')
     
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to block this Company!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            var rejava=0;
               $('.form-control5').each(function(){
                rejava++;
                    $(this).addClass('bypassclass');
                    $(this).bootstrapToggle('on');
                     $('#blacklist'+rejava).val('Y');
                     $("#ddddsa"+rejava).prop('disabled', true);
                 
                  
               });
               $('#blacklistcompany').val('Y');
               //alert( $('#blacklistcompany').val());
                            $( "#companyblockmodal" ).modal("show");

             
          }
          else{
          
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('off');
                 $('#blacklistcompany').val('N');
                 var rejava=0;
                $('.form-control5').each(function(){
                  rejava++;
                    $(this).addClass('bypassclass');
                    $(this).bootstrapToggle('off');
                    $('#blacklist'+rejava).val('N');
                    $("#ddddsa"+rejava).prop('disabled', flase);
                });
          }
      })
        
    }
        else{
      
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to unblock this Company!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
             var rejava=0;
              $('.form-control5').each(function(){
                 rejava++;
                 $("#ddddsa"+rejava).prop('disabled', false);
                    $(this).addClass('bypassclass');
                    $(this).bootstrapToggle('off');
                         $('#blacklist'+rejava).val('N');
                       
               });

                $('#blacklistcompany').val('N');
                //alert( $('#blacklistcompany').val());
           
          }
          else{
              
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('on');
               $('#blacklistcompany').val('Y');
                 //alert( $('#blacklistcompany').val());
                 var rejava=0;
               $('.form-control5').each(function(){
                rejava++;
                  
                    $(this).addClass('bypassclass');
                    $(this).bootstrapToggle('on');
                         $('#blacklist'+rejava).val('Y');
                      $("#ddddsa"+rejava).prop('disabled', true);
               });
          }
      })
    }
    }
   else{
     $(thisdata).removeClass(lastClass);
     $(thisdata).addClass('open');
   }
 }
</script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@stop