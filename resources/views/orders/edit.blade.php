@extends('layouts.maintemplate')
@section('third_party_stylesheets')

<style type="text/css">


/* new changes in revision dialog applied on 16/12/19 */

div.row1 {
    padding-top: 0px;
    height: 80px;
    vertical-align: middle;
}

#filepricedialog, #revisionchilddialog, #filereason {
  background-color: white;
}

/* new changes in revision dialog applied on 16/12/19 */


/*select.selectalloc {
   background: white ;
   color: blue ;
}

input:focus {
    background-color: #FFFF33;
  } 

select:focus {
    background-color: #FFFF33;
  }*/




table#clienthelp th {
   background:  #9c9391 !important;
  }



/*table#clienthelp td {
     color: blue;
  }*/


table#table_history tr td.td_history {
    text-align: left;

}

table#clienthelp tr:hover {
    cursor: pointer;
    background-color: #ffab40 !important; 
    color: #311b92 !important;
  }

div.scroll
{
/*background-color:#00FFFF;*/
height:40px;
width:140px;
overflow-x:scroll;
white-space: nowrap;
}  


/*  code added for dialog colors */

.ui-dialog .ui-dialog-buttonpane { background: #71B1E9 !important; }


#filepricedialog {
  background-color: white;
}

.ui-button .ui-icon {
    color: red !important ;
}

.ui-dialog-titlebar {
    background: #98bbe3 !important;  
}

/* color code for status  */

.quotecolor {
  background: #0a17ec !important;
  color: white !important;
}

.allotedcolor {
  background: black !important;
  color: white !important;
}
.ch-allotedcolor{
  background: black !important;
  color: white !important;
}
.revisioncolor {
    background: #FA7C7C !important;
    color: black !important;
}
.rev-allotedcolor{
  background: black !important;
  color: white !important;
}
.unapprovedcolor {
    background: #FFAC5C !important;
    color: black !important;
}

.complaincolor {
    background: #FF0000 !important;
    color: white !important;
}

.followupcolor {
   background:  #E5ff28 !important ;
   color:  black !important;
}

.onholdcolor {
    background: #A606C8 !important;
    color: white !important;
}

.cancelcolor {
    background: #C9303F !important;
    color: white !important;
}
.complaincolor{
    background: #C9303F !important;
    color: white !important;
}
/*qcpending class*/
.qcpendingcolor
 {
  background: #FA4193 !important;
  color: black !important;
}
.rev-qcpendingcolor{
   background: #FA4193 !important;
   color: black !important;
}
.ch-qcpendingcolor{
   background: #FA4193 !important;
  color: black !important;
}

/*changes class*/
.changescolor{
   background: #ffc107 !important;
  color: black !important;
}
/*complete class*/
.completedcolor{
  background: #41E329 !important;
  color: black !important;
}
.ch-completedcolor{
   background: #41E329 !important;
   color: black !important;
}
.rev-completedcolor{
   background: #41E329 !important;
   color: black !important;
}

/*qcok class*/
.qcokcolor {
  background: #DED641 !important;
  color: black !important;
}
.rev-qcokcolor{
  background: #DED641 !important;
  color: black !important;
}
.ch-qcokcolor{
  background: #DED641 !important;
  color: black !important;
}
.requotecolor {
  background: #4bc2f9 !important;
  color: #0a17ec !important;
}

.noresponsecolor {
  background: #FFFE0B !important;
  color: black !important;
}

.approvedcolor {
  background: #00F0E1 !important ;
  color: black !important ;
}
.duplicateentrycolor{
     background: #ffc107 !important;
     color: black !important; 
}

.followupcolor{
     background: #447DF7 !important;
     color: black !important; 
}
.requotecolor{
     background: #4bc2f9 !important;
     color: black !important; 
}
/* New Revision and changes dialog css added */

#rev_mistake {
     height: 40px  !important;
     width: 200px !important;
}


#targetdatedialog input[type=text] {
margin-top:5px;
/*margin-bottom:20px;
border-radius:5px;*/
padding:5px 0
box-sizing: border-box;
border: 2px solid black;
}


#targetdatedialog input[type=textarea] {
margin-top:5px;
/*margin-bottom:20px;
border-radius:5px;*/
padding:5px 0
box-sizing: border-box;
border: 2px solid black;
}
table.c {
  table-layout: fixed;
  width: 100%;
  word-wrap: break-word;  
  text-align: center;
 
}
/* final submit disable            */

.choices__list--dropdown{display:block;}
</style>
@endsection

@section('content')
@php

$orderpageedit="true";
@endphp


@include('pages.orders.modals.create.client_help')
@include('pages.orders.dialogs.fileprice')
@include('pages.orders.dialogs.targetdate')
@include('pages.orders.dialogs.revision_child')
@include('pages.orders.dialogs.filereason')
@include('pages.orders.modals.create.order_delayed')
@include('pages.orders.modals.today_order')

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif 


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if (count($errors) > 0)  old 5.3 method
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<span class="delmsg"> </span>
<div class="row">
  <div class="col-md-8">
      <h4 style="" class="mt-1" >Update Order : {{$Order->order_id}}  </h4>
      <input type="hidden" name="getorderid" id="getorderid" value="{{$Order->order_id}}">
  </div>
  <div class="col-md-4">
      <a href="{{route('orders.index')}}" class="btn btn-primary btn-outline mt-1 mb-1 rightdiv">Back</a>
  </div>
</div>
<!-- <div class="row">
<div class ="col-md-1 backbtnvisible" style="float: left;" > 
             <a   class="btn btn-primary backbtn" href="#"><span class="glyphicon glyphicon-arrow-left"></span></a>
</div>
</div>
 -->




  <div class="" id="">
        <div class="card temcolor1">
            <div class="" id="headingOne" style="background-color: #D6DBDF">
                <h6 class="mt-1 ml-1" align="center">
                  <input type="button" class="btn btn-link" id="collapseOne23" value="Click Here to Hide Order Detail" style="color: black;font-weight: bold;">
                                    
                </h6>
            </div>
            <div id="collapseOne" >
                <div class="card-body">
                    <div class="row">

    <div class="col-md-8">
    <div class="form-group">
        <!-- {!! Form::label('order_id', 'Order Id', ['class' => 'control-label']) !!}
        {!! Form::text('order_id', null ,['class' => 'form-control ', 'readonly'=>'readonly', 'autofocus' =>'autofocus']) !!} -->
       
        <label><b>Client Name : </b></label>
        <b style=" font-size: large;">{{$Order->client_name}}</b>
        <br>
        <label><b>client_email_primary : </b></label>
        <b style=" font-size: large;">{{$Order->client_email_primary}}</b>
        <br>
        <label><b>Company : </b></label>
        <b style=" font-size: large;">{{$Order->client_company}}</b>
        <br>
        <label><b>Created By : </b></label>
        <b style=" font-size: large;">{{$created_byname}}</b>
        <br>
        <label><b style="color:#ff3d3d;">Bill Date : </b></label>
        <b style=" font-size:large; color:#ff3d3d;"> {{$Order->bill_dt}}</b>
    </div>
    </div>

   <div class="col-md-4">
    <div class="form-group">
       
            <label><b>Order Date(India) : </b></label>
            <b style="font-size: large;">{{$Order->order_date_time}}</b>
            <br>
            <label><b>Order Date(US) : </b></label>
            <b style=" font-size: large;">{{$Order->order_us_date}}</b>
            <br>
            <label><b>Approval Time : </b></label>
            <b style="font-size: large;">{{$Order->approval_time}}</b>
            <br>
            <label><b>Approval US Time : </b></label>
            <b style=" font-size: large;">{{$Order->approval_us_time}}</b>
            <br>
            <label><b>Total Files : </b></label>
            <b style=" font-size: large;">{{$Order->file_count}}</b>
           
        
      </div>
    </div>    
</div>
                </div>
            </div>
        </div> 
    </div>
 <div class="card temcolor1">
    <div class="card-body">
{!! Form::model($Order,['method' => 'PATCH', 'id'=> 'editorderform' , 'route'=>['orders.update','order' => $Order->id]]) !!}
{!! Form::hidden('order_us_date', null, ["class" => "form-control"]) !!}
<div class="row">
{!! Form::hidden('file_count', null, ["class" => "form-control file_count",'id'=>'file_countid']) !!}
    <div class="col-md-2">
    <div class="form-group">
        {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
        {!! Form::select('file_type', ['Vector' => 'Vector', 'Digitizing' => 'Digitizing' ,'Photoshop' =>'Photoshop'] , $Order->file_type ,  ['class' => 'ftype form-control']) !!}
    </div>
    </div>

    
    <div class="col-md-2">

        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor', ['class' => 'control-label']) !!}
             {!! Form::select('vendor', $vendors, $Order->vendor,  ['class' => 'vend  form-control' ,'required'=>'required'
              ]) !!} 
           
        </div>
    </div>


    <div class="col-md-2 ">    
        <div class="form-group">
            {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
            {!! Form::number('file_price', null, ['class' => 'valid_file_price form-control', 'required'=>'required', 'step' => 'any']) !!}
              <input type="hidden" name="old_price" class="orig_old_price" value=0 />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('bill_dt', 'BILL Date', ['class' => 'control-label']) !!}
            {!! Form::text('bill_dt', null, ['class' => 'form-control', 'id' =>'bill_dt']) !!}
         
        </div>
    </div> 
    <div class="col-md-2 show_stich">
        <div class="form-group">
   
              {!! Form::label('stiches_count', 'Stiches', ['class' => 'control-label slabel']) !!}
                {!! Form::number('stiches_count', $Order->stiches_count, ['class' => 'form-control scount', 'required'=>'required']) !!}
   
        </div>
    </div>  

    <div class="col-md-2  show_stich">
         <div class="form-group">
              {!! Form::label('digit_rate', 'Digit Rate', ['class' => 'control-label']) !!}
                 {!! Form::number('digit_rate', null, ['class' => 'form-control digitrt']) !!}
         </div>
    </div>
   

         
</div>



     {!! Form::hidden('client_specific', null, ["class" => "form-control client_specific"]) !!}
   
    



<hr>
@php
    $delval=0; 
@endphp
@foreach( $OrderDtl as $dtl)
@php
    $delval++; 
@endphp

<div class="row delclassre"  id="morefiles">
  <div class="col-md-1">
    <label class="control-label">Doc.Type:</label>
    
      {!! Form::select('orddtls[document_type][]', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 
        $dtl->document_type , ['class' => 'required form-control4 form-control doctype', 'required'=>'required']) !!}
      <input type="hidden" class="orderid{{ $dtl -> id }} odtl_id"  name="orddtls[odtlid][]"  value="{{ $dtl -> id }}">
  </div>
  <div class="col-md-2">
      <label class="control-label">File Name:</label>
     <input type="text" 
           name="orddtls[file_name][]"  class="form-control" 
             value="{{ $dtl->file_name }} "  required="required"> 
        
           <label id="file_name_error" class="file_name_error" for="file_name"></label>
           <label id="file_name_success" class="success" for="file_name"></label>
  </div>
  <div class="col-md-1">
    <label class="control-label">price:</label>
      <input type="text"  name="orddtls[file_price][]"  class="dtl_filepriceid{{ $dtl -> id }} form-control dtl_fileprice"  value="{{ $dtl->file_price }}"  required="required" step="any">
            <input type="hidden" name="orddtls[old_price][]"  class=" form-control dtl_oldprice dtl_oldpriceid{{ $dtl -> id }}"  value=0 >
  </div>
  <div class="col-md-2">
    <label class="control-label">File Note:</label>
      @php $breaks = array("<br />","<br>","<br/>");  
                  $note = str_ireplace($breaks, "\r\n", $dtl->note );  @endphp
            <textarea class="notes{{ $dtl -> id }} form-control form-control2 oldnotes" name="orddtls[note][]">{{ $note }} </textarea>
     
  </div>
  <div class="col-md-2 addalloacation">

         {!! Form::label('file_price', 'Allocation:', ['class' => 'control-label']) !!}
         @php
         $randomallo=rand();
                $alloted =  explode(",", $dtl->alloc_id);
             @endphp
         <a class="btn btn-sm btn-round addalloacation">Change</a>
             <div class="modal fade bd-example-modal-md dddd" id="dddd{{ $randomallo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="row">
             <div class="col-md-8">
                  <b>Select Designer</b>
             </div>
             <div class="col-md-4">
                 <a class="btn btn-danger mb-1 btn-sm rightdiv closealloacation" id="" style="color: white;">X</a>
                 <input type="hidden" name="sa" value="dddd{{ $randomallo }}">
             </div>
        </div>
         <select class="allocationid{{ $dtl -> id }} form-control selectalloc cc{{ $randomallo }}" name="orddtls[allocation1][]"  multiple="multiple" data-live-search="true" id='dropDownId' onchange="myFunction(this,'ordtls{{$randomallo}}','ordtlsid{{$randomallo}}','allocationshow{{ $randomallo }}')" > @php foreach ($users as $key1=>$value1) {
          if (in_array($key1, $alloted)) { 
            @endphp
            @if($key1 == 0)
            @else
             <option value={{$key1}}  selected >{{ $value1 }}.</option>
            @endif
            @php    }
                else {
            @endphp
                  <option value={{$key1}}>{{ $value1 }}.</option>
            @php    }
            }  @endphp</select>
        <input type="hidden" name="orddtls[allocation][]" class="hiddenallocationname{{ $dtl -> id }}" value="{{$dtl ->allocation}}" id="ordtls{{$randomallo}}">
        <input type="hidden" name="orddtls[alloc_id][]" class="hiddenallocationid{{ $dtl -> id }}"value="{{$dtl->alloc_id}}" id="ordtlsid{{$randomallo}}">  
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <a class="btn btn-primary rightdiv  submitalloacation" id="submitalloacation">Submit</a>
      </div>
      
    </div>
  </div>
</div>
   <div id="allocationshow{{ $randomallo}}" class="allocationshowid{{$dtl -> id}}"> @php foreach ($users as $key1=>$value1) {
          if (in_array($key1, $alloted)) { 
            @endphp
            {{ $value1 }}</br>
           
            @php    }
            }  @endphp</div>   
  </div>
  <div class="col-md-2">
       <label class="control-label">Target-Time:</label>
       @if(($dtl->status == 'Quote') || ($dtl->status == 'Approved'))
               <input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime targettimeid{{$dtl -> id}}" 
              value="{{ $dtl->target_completion_time }}"  required="required"> 
             @else
               <input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime targettimeid{{$dtl -> id}}" 
              value="{{ $dtl->target_completion_time }}"  required="required"> 
             @endif
            
  </div>
  <div class="col-md-1">
    <label class="control-label">status:</label>
     
            @php

                $dtlstatus =   $dtl->status;
                $dtloldstatus = $dtl->old_status;

             @endphp
            <input type="hidden" name="oldstat" class="oldstatusvalue{{ $dtl -> id }} oldstat" value="{{ $dtl->status }}">
 
   @if(in_array($dtl->status,['Quote','QC Pending','No Response','Approved','UnApproved','Alloted','QC OK','Completed','On Hold','Cancel','Revision','Rev-Alloted','Rev-QC Pending','Ch-Alloted','Ch-Completed','Ch-QC Pending','Rev-Completed','Ch-QC OK','Rev-QC OK','Changes','Complain','Duplicate Entry','Followup','Requote'] ))
               @php
                  $string123 = $dtl->status;

                  $bar123=strtolower($string123);
                   $data123 = preg_replace('/\s+/', '', $bar123);
                
                 @endphp
   @else
   @php
                  
                   $data123 = "noclasshere";
                
                 @endphp
   @endif
            <select  name="orddtls[status][]"   class="satusid{{ $dtl -> id }} required form-control form-control4 neweditstatus {{$data123}}color"  onchange="myStatuscolor(this)">
            
            @foreach ($status as $key2) 
                @if ( $key2 == $dtlstatus  &&  $dtl->file_type != 'Digitizing') 
                   <option value="{{ $key2 }}"  selected >{{ $key2 }}</option>
                   
                  @switch($key2)
                      @case('Quote')

                    <option value="Approved" class="approvedcolor" >Approved</option>
                    <option value="UnApproved"  >UnApproved</option>
                    <option value="Cancel"   >Cancel</option>
                    <option value="Duplicate Entry"  >Duplicate Entry</option>
                    <option value="On Hold"   >On Hold</option>
                
                          @break
                      @case('No Response')
                    <option value="Approved"  >Approved</option>
                    <option value="UnApproved"  >UnApproved</option>
                    <option value="Cancel"   >Cancel</option>
                   
                          @break      

                    @case('Approved')
                          <option value="Alloted"  >Alloted</option>
                          <option value="Cancel"   >Cancel</option>
                    <option value="Duplicate Entry"  >Duplicate Entry</option>
                    <option value="On Hold"   >On Hold</option>
                          @break
                    @case('UnApproved')
                          <option value="Approved"  >Approved</option>
                          <option value="Cancel"   >Cancel</option>
                          @break    

                    @case('Alloted')
                          <option value="QC Pending"  >QC Pending</option>
                          <option value="On Hold"   >On Hold</option>
                           <option value="Cancel"   >Cancel</option>
                          @break    

                      @case('QC Pending')
                          <option value="Alloted"  >Alloted</option>
                        @permission('do.qc.ok')  
                          <option value="QC OK"   >QC OK</option>
                        @endpermission
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break      
                      @case('QC OK')
                          <option value="Completed"   >Completed</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break      
                      @case('Completed')
                          <option value="Revision"   >Revision</option>
                          <option value="Changes"   >Changes</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break      
                      @case('Revision')
                          <option value="Rev-Alloted"   >Rev-Alloted</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break   
                      @case('Rev-Alloted')
                          <option value="Rev-QC Pending"   >Rev-QC Pending</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break   
                       @case('Rev-QC Pending')
                        @permission('do.qc.ok')
                          <option value="Rev-QC OK"   >Rev-QC OK</option>
                        @endpermission
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break  
                        @case('Rev-QC OK')
                          <option value="Rev-Completed"   >Rev-Completed</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break   
                        @case('Rev-Completed')
                          <option value="Revision"   >Revision</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="Changes"   >Changes</option>
                          @break                
                        @case('Changes')
                          <option value="Ch-Alloted"   >Ch-Alloted</option>
                          <option value="Cancel"   >Cancel</option>
                          @break 
                        @case('Ch-Alloted')
                          <option value="Ch-QC Pending"   >Ch-QC Pending</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break  
                        @case('Ch-QC Pending')
                         @permission('do.qc.ok')
                          <option value="Ch-QC OK"   >Ch-QC OK</option>
                         @endpermission
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break   
                        @case('Ch-QC OK')
                          <option value="Ch-Completed"   >Ch-Completed</option>
                          <option value="Cancel"   >Cancel</option>
                          <option value="On Hold"   >On Hold</option>
                          @break  
                        @case('Ch-Completed')
                          <option value="Revision" >Revision</option>
                          <option value="Cancel" >Cancel</option>
                          <option value="Changes" >Changes</option>
                          @break    
                        @case('On Hold')
                          <option value="Cancel"   >Cancel</option>
                          @if( $dtloldstatus != null   &&  $dtloldstatus != 'Cancel') 
                               <option value="{{ $dtloldstatus }}"   >'Prv.Stat:' .{{ $dtloldstatus }}</option>
                          @endif
                            <option value="Approved"  >Approved</option>

                          @break    
                        @case('Cancel')
                          <option value="On Hold"   >On Hold</option>
                          @if( $dtloldstatus != null   &&  $dtloldstatus != 'On Hold') 
                               <option value="{{ $dtloldstatus }}"   >'Prv.Stat:' . {{ $dtloldstatus }}</option>
                          @endif
                            <option value="Approved"  >Approved</option>
                          @break              
                        @case('No Response')
                          <option value="Approved"   >Approved </option>
                          <option value="UnApproved"   >UnApproved </option>
                          <option value="Cancel"   >Cancel</option>
                          @break  
                        @case('Duplicate Entry')
                          <option value="Cancel"   >Cancel</option>
                          @if( $dtloldstatus != null  &&  $dtloldstatus != 'Cancel') 
                               <option value="{{ $dtloldstatus }}"   >'Prv.Stat:' . {{ $dtloldstatus }}  </option>
                          @endif
                            <option value="Approved"  >Approved</option>
                          @break   
        
    
                         
                  @endswitch
                  
                @elseif ( $key2 == $dtlstatus  &&  $dtl->file_type == 'Digitizing')
                    <option value="{{ $key2 }}"  selected >{{ $key2 }}</option>
                      <option value="Approved"  >Approved</option>
                      <option value="UnApproved"  >UnApproved</option>
                      <option value="Cancel"   >Cancel</option>
                      <option value="Duplicate Entry"  >Duplicate Entry</option>
                      <option value="On Hold"   >On Hold</option> 
                      <option value="Completed"   >Completed</option>


                @endif

                

            @endforeach

               
           </select>  
           <label id="status_error" class="status_error" for="status"></label>
           <label id="status_success" class="success" for="status"></label>
  </div>
  @permission('order.delete')
  <div class="col-md-1">
     <label class="control-label rdcolor" style="color: white">sadsdaasda</label>
     <div style="text-align: center;">
       <a href="#" class="btn btn-danger btn-outline delete">Delete</a>
        <input type="hidden" class="odtl_id" name="os[odtlid][]" value="{{ $dtl -> id }}">
     </div>
   </div>
  @endpermission
</div>
@endforeach
<div id="morefiles1"></div>
            <a href="#" class="btn btn-success btn-outline add">Add Order</a>
<div class="row">
  <div class="col-md-4">
        <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-warning rightdiv btn-wd" value="Submit" />
  </div>
  <div class="col-md-4">

      {!! Form::submit('Submit and Exit',['id' => 'finalsubmit' ,'name' => 'finalsubmit' , 'class' => 'btn rightdiv btn-primary btn-outline']) !!}
  </div>

</div>
{!! Form::close() !!}
<input type="hidden" value="{{$delval}}" id="deleteid">

<br>

</div>
</div>
<div class="table-responsive">

<table id="table_history" class="table table-bordered table-striped" style="width: 100%;table-layout: fixed;word-wrap: break-word; ">
   <!-- <thead  style="background: grey;color: blue; ">
    --> 
     <thead>
  
      <th class="text-center" style="width: 80px;">User</th>
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
             @if($cols['columns_updated'][$i] != "Ip Address")
              @if(isset( $cols['old_values'][$i]))
              
             

              <tr><td>
                {!!  $cols['updated_by'][$i] !!}
              </td><td>  
                {!!  $cols['note'][$i] !!}
              </td><td>
                {!!  $cols['columns_updated'][$i] !!} 
            
              </td><td>
              @if(in_array($cols['old_values'][$i],['Quote','QC Pending','No Response','Approved','UnApproved','Alloted','QC OK','Completed','On Hold','Cancel','Revision','Rev-Alloted','Rev-QC Pending','Ch-Alloted','Ch-Completed','Ch-QC Pending','Rev-Completed','Ch-QC OK','Rev-QC OK','Changes','Complain','Duplicate Entry','Followup','Requote'] ))  
               @php
                  $string = $cols['old_values'][$i] ;

                  $bar=strtolower($string);
                   $data = preg_replace('/\s+/', '', $bar);
                
                 @endphp
                  <span class="{{$data}}color btn-sm" style="cursor: context-menu;" >{!!  $cols['old_values'][$i] !!} </span>
              
              @else
                 {!!  $cols['old_values'][$i] !!}

               @endif

                
            
              </td><td>
             @if(in_array($cols['new_values'][$i],['Quote','QC Pending','No Response','Approved','UnApproved','Alloted','QC OK','Completed','On Hold','Cancel','Revision','Rev-Alloted','Rev-QC Pending','Ch-Alloted','Ch-Completed','Ch-QC Pending','Rev-Completed','Ch-QC OK','Rev-QC OK','Changes','Complain','Duplicate Entry','Followup','Requote'] ))  
               @php
                  $string1 = $cols['new_values'][$i];

                  $bar1=strtolower($string1);
                   $data = preg_replace('/\s+/', '', $bar1);
                
                 @endphp
                  <span class="{{$data}}color btn-sm" style="cursor: context-menu;" >{!!  $cols['new_values'][$i] !!} </span>
              @else
                  {!!  $cols['new_values'][$i] !!}
               @endif
            
               
                   
               
              </td><td class="text-nowrap">
                {{ $cols['updated_at'][$i] }}
              </td></tr>
              
               @endif
             @endif  
       @endfor
        @foreach($logfirstrecord as $key)
           
          <tr>
        
           <td>
               {!!   'Order Created By:'  .  $key->created_nm !!}
                 </td><td>
                  {!! $key->client_name  !!}
           </td>
          </td><td>
                  {!! 'File:' .$key->file_name !!}
           </td>
             </td><td>
                  {!! 'Price:' . $key->file_price !!}
           </td>
            </td><td>
                  {!! $key->file_type  !!}
           </td>
           
            </td><td>
                  {!! $key->created_at  !!}
           </td>
         </tr>

  @endforeach  
</tbody>
</table>
  
    
  

  

 

</div>

@endsection

@section('script') 


<script type="text/javascript">
  //show selection box in allocation modal
  $(document).ready(function(){

     var multipleCancelButton = new Choices('#dropDownId', {
     removeItemButton: true,
     maxItemCount:15,
     // searchResultLimit:5,
     // renderChoiceLimit:5
     });
    countValue();
  });
  //show alloacation modal
 $(document).on("click", ".addalloacation", function(e){

 var nextSectionWithId =  $(this).next().attr("id");
 
      $('#'+nextSectionWithId).modal("show"); 
 });
 //close alloaction modal
 $(document).on("click", ".closealloacation", function(e){
    var as=$(this).next().val();
    
     $('.dddd').modal("hide"); 
 });
 //submit allocation modal
 $(document).on("click", ".submitalloacation", function(e){
     $('.dddd').modal("hide"); 
 });
 //hide and show order information 
 $(document).on("click", "#collapseOne23", function(e){
  var hideinfo=document.getElementById("collapseOne23").value;
        if(hideinfo == "Click Here to Hide Order Detail")  {
           $('#dddd').modal("show"); 
         $("#collapseOne").hide();
         document.getElementById("collapseOne23").value="Click Here to Show Order Detail"
        }
        else{
          $("#collapseOne").show();
          document.getElementById("collapseOne23").value="Click Here to Hide Order Detail"
        }

    });
  

function revision_qc_ok_update(previous, newst, childid,status2, oldnotes, _token){
  
    // var oldprice = $(".oldprice").val();
    //var oldnotes  =  $("#statusdialog .coldnotes").val();
    //alert(oldnotes);

    $("#filereason").dialog( { 
            title : "File Reason Update",
            resizable: false,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'fold',
            hide: 'fold',
            width: 700,
            height:280,
            buttons: [
               {
                  text: "OK",
                  class: "revok",
                  click: function() 
                  {     

                    //  validation  logic
                        if ( $("#filereason #rev_mistake_reason").val() == "")
                            {
                                         //alert('Target date cannot be blank');
                                         
                                         Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Reason  cannot be blank'
                                        
                                         })

                                          return false;

                                           
                            }

                    ////inserted  swal logic
                              Swal.fire({
                        title: "Revision Status will be Saved",
                        text: "Status Change will not be Reverted Back, Continue..?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                  .then((willDelete) => {
                  if (willDelete) {
                        // $(newst).closest('tr').find('.updatealloc').val('not allocated');
                        // $(newst).closest('tr').find('.updateallocid').val(0);
                        // $(newst).closest('tr').find('select.neweditstatus').val(status2);
                        // var allocname1  =   $(newst).closest('tr').find('select.selectalloc').val();

                        // target_change(previous, newst,childid, status2,  oldnotes, _token);
         
                        // $(this).closest('td').find('.ctarget').focus();
                       // return false;
                           
                            if ( $("#filereason #rev_mistake_reason").val() == "")
                            {
                                         //alert('Target date cannot be blank');
                                         
                                         Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Reason  cannot be blank'
                                        
                                         })

                                          return false;

                                           
                            }

                            else {

                           var rev_mistake = $("#filereason #rev_mistake").val();
                    var rev_mistake_reason = $("#filereason #rev_mistake_reason").val();
                     
                    var formData = {
                                  childid:  childid, 
                                  status2: status2,
                                  rev_mistake_reason: rev_mistake_reason,
                                  rev_mistake: rev_mistake,
                                  _token: _token
                                
                            }
            

                           

                     $( this ).dialog( "close" );

                     vclient_specific  =  $("#editorderform .client_specific").val();

       if ( status2 == 'Completed' || status2 == 'Ch-Completed' || status2 == 'Rev-Completed'){

                      // swal({
                      //                     icon: 'error',
                      //                     title: 'Special Client Details',
                      //                     text: vclient_specific
                                          
                      //               })
                        if (vclient_specific == undefined || vclient_specific == null || vclient_specific == "") {
                                             console.log(vclient_specific);
                             }
                              else { 
                                
                                Swal.fire("Client Specific Information", vclient_specific, "success")
                             }
                     
       }
                          


                    $.ajax({
                        type:"POST",
                        async: true,
                        datatype:"JSON",
                        url: "{{ URL::to('orders/orderdtlstatus') }}",
                        data: formData,
                        success: function(result)
                            { 
                             
                              var res = result[0].msg ;
                              var oldstatus = result[0].oldstatus ;
                              if (res == "Updated successfully") {
                                   console.log(result[0].msg) ; 
                                   console.log("status2");
                                   $(newst).closest('tr').find('select.neweditstatus').val(status2);
                             
                              }
                              else {
                                    Swal.fire({
                                          type: 'error',
                                          title: 'Error in your selection...',
                                          text: res
                                          
                                    })
                                  // alert(res);

                                  $(newst).val(previous);
                                  return false;
                              }
                               
                            }
                      });          

                       

                      
                            } // else condition ends here
                       


                  } else {
                        //swal("Your imaginary file is safe!");
                      Swal.fire(
                            'Cancelled',
                            'Changes are reverted Back :)',
                            'error'
                          )
                          $( this ).dialog( "close" );
                          
                           $(newst).val(previous);
                          e.stopPropagation();
                          return false;
                        }
                 });  
                

                    /// inserted swal logic 
                      
                            }
                          },
                         

                        ],
                    

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                    },
                    open: function(event, ui) {
                        
                   
                    var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                    //var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                   // var AddButton = buttons[0];
            
                    
                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                   

                    
                 },
               });

             $( "#filereason" ).dialog("open");
             $("#filereason #rev_mistake").val('');
             $("#filereason #rev_mistake_reason").val('');
            
                 
             return false;
  }  



$(document).ready(function ($) {
        //alert("hello order create ready");
        //$(".clientinput").focus();
        //$(".clientinput").blur();
        //document.newformadd.input.focus();

  //  check if form has been changed  //
        //$("#btnSubmit").attr('disabled', 'true');
        //$("#finalsubmit").attr('disabled', 'true');
     var filetype =   $("#editorderform .ftype").val();
     //$(".show_stich").show();

    //$("input#btnSubmit").prop('disabled', true);
    //$("input#finalsubmit").prop('disabled', true );

     if (filetype != "Digitizing"){
       
         $(".show_stich").hide();
          $(".valid_file_price").val(5.5);
    }
     else {
        // $(".valid_file_price").val(0.00);
        $(".show_stich").show();
    }

    //alertify.set('notifier','position', 'bottom-center');
     
    $('input').change(function () {
           // alert(this.value);
           $("#editorderform").data("changed",true);
                  $("input#btnSubmit").prop('disabled',  false);
                  $("input#finalsubmit").prop('disabled', false);
    }); 

     $('select').change(function () {
           // alert(this.value);
           $("#editorderform").data("changed",true);
                  $("input#btnSubmit").prop('disabled', false);
                  $("input#finalsubmit").prop('disabled', false);
    });

     $('textarea.oldnotes').change(function () {
           // alert(this.value);
           //debugger;
           $("#editorderform").data("changed",true);
                  $("input#btnSubmit").prop('disabled', false);
                  $("input#finalsubmit").prop('disabled', false);
    }); 

    $("input[type='text']").change( function() {
                  $("#editorderform").data("changed",true);
                  $("#btnSubmit").prop('disabled', false);
                  $("#finalsubmit").prop('disabled', false);
    });

   
    
    $(document).on("click", "div.backbtnvisible", function(e){

      // alert('hi');
    
      var aElems = document.getElementsByClassName("a.backbtn");

// for (var i = 0, len = aElems.length; i < len; i++) {
//     aElems[i].onclick = function() {
          if ($("#editorderform").data("changed")) {
               
              //  const swalWithBootstrapButtons = Swal.mixin({
              //      customClass: {
              //      confirmButton: "btn btn-lg btn-success",
              //      cancelButton: "btn btn-lg btn-danger"
              // },
              // buttonsStyling: true
              // })


          Swal.fire({
              title: "CHANGES DETECED!",
              text: "Do you want to Save Changes ?",
              icon: "warning",
              buttons: true,
              buttons: ["Don't Save!", "Save it!"],
              dangerMode: true,
              showCloseButton: true,
              // confirmButtonText: 'Save it!',
              // cancelButtonText: "Don't Save!",
              })
              .then((willDelete) => {
              if (willDelete) {
                  Swal.fire("Please wait Your Record is Saving!", {
                  icon: "success",
              });
                    $("#editorderform").submit();

              } else {
                  Swal.fire("Changes are reverted Back!");
                     var url = '{{ action("OrderController@index") }}' ;
                  location.href =url;
              }
              });
    

          // swal({
          //     title: 'Save Changes?',
          //     text: "Changes will be Applied, Continue..",
          //     icon: 'warning',
          //     showCancelButton: true,
          //     confirmButtonText: 'Yes,Save!',
          //     cancelButtonText: 'No,cancel!',
          //     reverseButtons: true,
          //     showCloseButton: true
          //     }).then((result) => {
          //         if (result.value) {
          //               swalWithBootstrapButtons.fire(
          //               'Saving!',
          //               'Please wait Your Record is Saving.',
          //                 'success'
          //         )
          //                $("#editorderform").submit();
          //         } else if (
          //         /* Read more about handling dismissals below */
          //         result.dismiss === Swal.DismissReason.cancel                  
          //     ) {
                  
          //         var url = '{{ action("OrderController@index") }}' ;
          //         location.href =url;  
          //     swalWithBootstrapButtons.fire(
          //         'Cancelled',
          //         'Changes are reverted Back :)',
          //         'error'
          //       )
          //       }
          // })

             // return confirm("Some Changes are Done, Do you want to Exit?");
          }    
          else
          {  
             alert('ok back');
             var url = '{{ action("OrderController@index") }}' ;
                  location.href =url; 
          }
//     };
// }

});
    //  $(document).on("click", ".backbtn", function(e){
    //                   e.preventDefault();
    //          if ($("#editorderform").data("changed")) {

    //                toastr.confirm('Some Changes have occur, Do you want to exit?', {onOk: () => { console.log('ok') }, onCancel: () => {  eval(this.href); }});

    //          }
    //          else {
    //               $(".backbtn").trigger("click");
 
    //          }
            
             
    //          return true;
    // });
     


      $("#btnSubmit").click(function() {
            //debugger;
            TotalPriceCalc();
            if ($("#editorderform").data("changed")) {
          
                   $("#editorderform").submit();
                 //$("#btnSubmit").attr('disabled', 'false');
                    //$("#finalsubmit").attr('diabled', 'false');

            }

            else {
                   // alertify.error('No changes done, Please Press top back key, or refresh page',0);
                      Swal.fire({
                            type: 'error',
                            title: 'No changes done...',
                            text: 'No changes done, Please Press top back key, or refresh page'
                                 
                      })
                      return false;

                 // $("#btnSubmit").prop('disabled', 'true');
                  //$("#finalsubmit").prop('disabled', 'true');
                }
     
      });

      $("#finalsubmit").click(function() {

             //debugger;
             TotalPriceCalc();
              if ($("#editorderform").data("changed")) {
          
                   $("#editorderform").submit();
                 //$("#btnSubmit").attr('disabled', 'false');
                    //$("#finalsubmit").attr('diabled', 'false');

              }

              else {
                  //alertify.message('No changes done, Please Press top back key, or refresh page');
                  Swal.fire({
                            title: 'No Changes to Save...',
                            text: "No changes done",
                            type: 'warning',
                           
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                          }).then((result) => {
                              window.location.href = "{{route('orders.index')}}";  // replace
                          })
                   
                     
                 
                     

                 // $("#btnSubmit").prop('disabled', 'true');
                  $("#finalsubmit").prop('disabled', 'true');
              }

     }); 


     




  // check if form has been changed  on 02/12/2019 //      

  $(document).on("change", ".ftype", function(e){
     var file_type =  this.value ;
     $("#editorderform").data("changed",true);
     //$("#btnSubmit").prop('disabled', 'false');
    // alert(file_type);
    if (file_type != "Digitizing"){
        //  $(".scount").attr('readonly', 'readonly');
        //debugger;
          $(".show_stich").hide();
          $(".valid_file_price").val(5.5);
    }
     else {
       // $(".valid_file_price").val(0.00);
        $(".show_stich").show();
    }

  });     
   
   
        $(document).on("keyup", ".clientinput", function(e){
        //alert('mymodal2');
        //e.preventDefault();
       // $("#btnSubmit").prop('disabled', 'false');
         
        $value = $(this).val();
        //alert($value);
        if($value.length > 0 ){
                //alert($value);
                $("#myModal2").modal('show');
               

                $("#search").val($value);
                 // alert($value);
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "{{ URL::to('orders/search') }}",
                    data: {"search": $value},
                    success:function(data)
                    {
                        $("#clienthelp tbody").html(data);
                    }
        
                });
        }
        else
        {
            alert("Client Name cannot be Blank")
        }
             
        });





      $(document).on("click", ".clienthelp tr", function(e){
      //     e.preventDefault();
      // $("#clienthelp  tr").click(function(){
        
        $(this).addClass('selected').siblings().removeClass('selected');    
        var vclient_creation_id=$(this).find('td:eq(1)').html();
        var vclient_name=$(this).find('td:eq(2)').html();
        var vprimary_email=$(this).find('td:eq(3)').html();
        // var vsecondary_email=$(this).find('td:eq(4)').html();
        var vcompany=$(this).find('td:eq(4)').html();
        var vclient_note=$(this).find('td:eq(5)').html();
        var vclient_contact_1=$(this).find('td:eq(6)').html();
        var vcompany_id=$(this).find('td:eq(7)').html();
        
     
   

      });

     //$(".clienthelp tr").on("dblclick", function(){  
    $(document).on("dblclick", ".clienthelp tr", function(e){ 
          
                //alert($( "OrderCreateModal input[name='client_name']").val()) ;
           
          // $(".clienthelp tr").unbind("click");
          // $(".clienthelp tr").unbind("dblclick");
           $(this).addClass('selected').siblings().removeClass('selected');    
          var vclient_creation_id=$(this).find('td:eq(1)').html();
          var vclient_name=$(this).find('td:eq(2)').html();
          var vprimary_email=$(this).find('td:eq(3)').html();
          // var vsecondary_email=$(this).find('td:eq(4)').html();
          var vcompany=$(this).find('td:eq(4)').html();
          var vclient_note=$(this).find('td:eq(5)').html();
          var vclient_contact_1=$(this).find('td:eq(6)').html();
          var vcompany_id=$(this).find('td:eq(7)').html();

         // alert(vclient_creation_id);

          $("#myModal2").modal('hide');  
          $( "#newformadd #client_name" ).val( vclient_name.trim() );
          $( "#newformadd #client_email_primary" ).val( vprimary_email );
          $( "#newformadd #client_company" ).val(vcompany.trim());
          // $( "#newformadd .clientcomp" ).css( 'text-align', 'left');
          // $( "#newformadd .clientcomp" ).css( 'float', 'left');
          
          $( "#newformadd  .creationid" ).val( vclient_creation_id );
          $( "#newformadd  .cnote" ).val( vclient_note );
          $( "#newformadd  #client_contact_1" ).val( vclient_contact_1 );
          $( "#newformadd  .compid" ).val( vcompany_id );

         $("#newformadd .ftype").focus();

        // alert("data received");
        
         //$("input").blur();
           
        });

    $(".add").click(function(){
    
      $("#editorderform").data("changed",true);
      //$("#btnSubmit").prop('disabled', 'false');
    
      //var n = ($('#orderdtltable .add tr').length-0)+1;
      
       //alert("adding row" + n);


      var cnt = $(".dtlbody").children().length;
      //alert(cnt);
      $(".fcount").val(cnt + 1);
         
        
        var now = new Date();
        now.setDate(now.getDate()+1);

        var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn ;

              
       var randomallo1= Math.floor(Math.random() * 100000);
      
             ord1='ordtls'+randomallo1;
             ord2='ordtlsid'+randomallo1;
             ord3='cc'+randomallo1;
             ord4='allocationshow'+randomallo1;

                var tr = '<div class="row delclass"><div class="col-md-1"><div class="form-group "><label class="control-label">Doc.Type:</label><select  name="orddtls[document_type][]"  class=" form-control form-control4 doctype  doctypeid'+randomallo1+'" value=" " "autofocus"            ="autofocus" required="required"><option value="Normal">Normal</option><option value="Rush">Rush</option><option value="SuperRush">SuperRush</option></select> <input type="hidden" name="npnameuse" value="'+randomallo1+'"></div></div><div class="col-md-2"><div class="form-group "><label class="control-label">File Name:</label><input type="text" name="orddtls[file_name][]"  class=" form-control "  value=" "  required="required"></div></div> <div class="col-md-1"><div class="form-group "><label class="control-label">price:</label><input type="hidden" name="orddtls[old_price][]"  class=" form-control dtl_oldprice "  value=0 ><input type="text" name="orddtls[file_price][]"  class=" form-control dtl_fileprice "  value=0  step="any"></div></div><div class="col-md-2"><div class="form-group "><label class="control-label">File Note:</label><textarea class="form-control form-control2 oldnotes" name="orddtls[note][] value="not defined"></textarea> </div></div> <div class="col-md-2"><label class="control-label">Allocation :</label><a class="btn btn-sm btn-round addalloacation">Change</a><div class="modal fade bd-example-modal-md dddd" id="dddd'+randomallo1+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-md" role="document"><div class="modal-content"><div class="modal-body"><div class="row"><div class="col-md-8"><b>Select Designer</b></div><div class="col-md-4"><a class="btn btn-danger btn-sm  mb-1 rightdiv closealloacation" id="" style="color: white;">X</a></div></div><select class="form-control selectalloc '+ord3+'" name="orddtls[allocation1][]"  multiple="multiple" data-live-search="true" id="dropDownId'+randomallo1+'" onchange="myFunctionDynamic(this,'+ord1+','+ord2+','+ord4+')" > @php foreach ($users as $key1=>$value1) { @endphp <option value={{$key1}}>{{ $value1 }}.</option> @php    }  @endphp</select><input type="hidden" name="orddtls[allocation][]" value="not allocated" id="'+ord1+'"><input type="hidden" name="orddtls[alloc_id][]" value="0" id="'+ord2+'"> <br><br><br><br><br><br><br><br><br><br><br><br><a class="btn btn-primary rightdiv submitalloacation" id="submitalloacation">Submit</a></div></div></div></div><div id="'+ord4+'"></div>    </div><div class="col-md-2"><div class="form-group "><label class="control-label">TARGET-TIME:</label> <input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime targettimeadd'+randomallo1+' targettimeid'+randomallo1+'"  value="{{ $target_date }}"  required="required"></div></div><div class="col-md-1"><div class="form-group "><label class="control-label">STATUS:</label> <select  name="orddtls[status][]"  class=" form-control form-control4 fstatus quotecolor" value=" "  required="required"><option value="Quote" class="quotecolor">Quote</option><option value="Approved" class="approvedcolor">Approved</option></select> </div></div><div class="col-md-1"><label class="control-label rdcolor" style="color: white">sadsdaasda</label><a id="deletewe" href="#" class="btn btn-danger btn-outline delete" >Delete</a></div></div>';

        $('#morefiles1').append(tr);
        
        
     var multipleCancelButton = new Choices('#dropDownId'+randomallo1, {
     removeItemButton: true,
     maxItemCount:15,
     // searchResultLimit:5,
     // renderChoiceLimit:5
     });
 
  
         //$(this).closest('tr').next().find('td:eq(0) input').focus(); 
         //$(this).next().focus();
        $('.targettimeadd'+randomallo1).val(tdate);
        $('.doctypeid'+randomallo1).focus();
        //  $(this).closest('tr').find('.doctype').blur();
        //$('html,body').animate({scrollTop: $(document).height()}, 100);
       
        TotalPriceCalc();
        
        return false;

     });  

    //delete new added row
    $("#morefiles1").on("click",".delete",function () {
   
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
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
             $(this).closest('.delclass').remove();
          }
          else{
             Swal.fire(
              'You canceled delete operation.',
            )
          }
        })
        
    });

    $( ".temcolor1" ).on( "click", "a.delete" ,  function(e) {
        //debugger;
        var childid =  $("#deleteid").val();
        var childidcontroller =  $(this).next().val();      
        e.preventDefault();
      if(childid != 1){ 
        $("#editorderform").data("changed",true);
        
           Swal.fire({
            text: "Do you want to delete ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'cancel',
            confirmButtonText: 'delete',
            reverseButtons: true
          })
          .then((result) => {
          if (result.value) {
              //  Delete Logic Starts here

         

                      // $.ajaxSetup({
                      //   headers: {
                      //               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      //            }
                      // });    
             
               
              var _token = $(this).parents('form:first').find('input[name=_token]').val();
             // alert(_token);

             
             
                     
                       var formData = {
                            childid:  childidcontroller, 
                            _token: _token
                           
                        }
                            
                         //alert(formData);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/delete_child') }}",
                            data: formData,
                            success: function(result)
                            { 
                              res = result[0].msg ;
                             
                              console.log(result[0].msg) ; 
                             
                              $(".delmsg").html(res).fadeOut('slow');
                               
                            }
                        });
              $(this).closest('.delclassre').remove(); 
              var countvalue=$('#file_countid').val();
              $('#file_countid').val(countvalue-1);
              $("#deleteid").val(childid - 1);

             
            }
          else{
              Swal.fire(
                   'You canceled delete operation.',
               ) 
            }
        });
     }    
              else{
                  Swal.fire({
                             type:'info',
                             text:'Delete operation not perform on this file.',
                           }) 
              } 
      TotalPriceCalc();
        
    });

});    

$("#order_date_time").datetimepicker();
$("#approval_time").datetimepicker();
$(".targettime").datetimepicker();
$("#bill_dt").datepicker( {dateFormat: 'yy-mm-dd'});
$("input.new_target_date2").datetimepicker( {minDate: 0});



// added below code for revision designer change  on 16-12-19
$(document).on("change", ".getdesign", function(e){
             
         
        if (this.value == 'Designer') {

              var vorderid = $("#getorderid").val();
              var childid =  $("#revisionchilddialog  .rchildid").val();
             //alert(vorderid);
              $.ajax({
                  type: "GET",
                  cache: false,
                  url: "{{ URL::to('orders/getdesign') }}",
                  data: { childid: childid, orderid: vorderid},
                  success:function(data)
                    {
                         console.log(data);
                    
                         $("#revisionchilddialog #mistake_designer_name").val(data.notes[1]);                     
                         $("#revisionchilddialog #mistake_lead_name").val(data.notes[0]);                     
                    }
        
              });
          }    
          else {

                 $("#revisionchilddialog #mistake_designer_name").val("");                     
                 $("#revisionchilddialog #mistake_lead_name").val("");

          }
              
              return false;
});

// added below code for status  update in new edit mode on 28/09/17
var previous ='';
 
 $(document).on("change", "select.neweditstatus", function(e, previous ) {    
        // Do something with the previous value after the change
        //var array = $(this).val(); // this brings array value
         $("#editorderform").data("changed",true);
        //$("#btnSubmit").prop('disabled', 'false');
       
        var  thisst = $(this);
           
         var newclassname=$(thisst).attr('class').split(' ')[0];
         var addclassname=newclassname.substr(7);
        
        var status2  = this.value; 
      
        //status2 = status2.toString();

        var allocname1=$(".allocationid"+addclassname).val();

        if ( (allocname1 == '0')  &&  (status2 == 'Alloted' || status2 == 'QC Pending' || status2 == 'QC OK'  || status2 == 'Completed') ) {

           // alert('Allocation cannot be blank');
           Swal.fire({
                  type: 'error',
                  title: 'Error in your selection...',
                  text: 'Allocation cannot be blank'
                                                  
                })
                    $('.satusid'+addclassname+' option').prop('selected', function () { 

                          myStatuscolor(thisst);
                          return this.defaultSelected;

                   }); 
           // alert( $().val());
            return false;
  
        }
            
        //debugger;    
        //if (status2 == 'Alloted' && ())

        //alert(status2);
       // alert('hello');
       
        //debugger;
          // alert(status2);
        var  newst = $(this);
        var previous = $('.oldstatusvalue'+addclassname).val();
       
          //alert(previous);
        // alert($(newst).closest('tr').find('select.neweditstatus').val());
        
        // Removed below code as per kulind sir instruction on 17-12-2019
        // var r = confirm("Confirm Status Changes?");

        // if (r != true) {
        //      $(newst).val(previous);
        //      //$(newst).find('select.neweditstatus').val(previous);
        //      return false ;
        // }
           

        // Removed above code as per kulind sir instruction on 17-12-2019
    

        var childid =$('.orderid'+addclassname).val();
        var dtl_target_dt =$('.targettimeid'+addclassname).val();
        var oldprice  = $('.dtl_filepriceid'+addclassname).val();
        var oldnotes  = $('.notes'+addclassname).val();
     
        $('.dtl_oldpriceud'+addclassname).val(oldprice);
       

        $.ajaxSetup({
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                 }
                      });  

        var _token = $(this).parents('form:first').find('input[name=_token]').val();
        // Make sure the previous value is updated

        if (status2 == 'Changes') {
           
            // debugger;
            $('.hiddenallocationname'+addclassname).val('not allocated');
            $('.hiddenallocationid'+addclassname).val(0);
            $(".allocationid"+addclassname).val(0);

            $(".add_price").val(0);
            $(".new_target_date2").val('');
            $(".orig_old_price").val(oldprice);
            $(".file_price2").val(oldprice);
           // alert(oldprice);
           
           // $("#filepricedialog").dialog();

            $("#filepricedialog").dialog( { 
                    title : "File Price Changes",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    //left: 1000,
                    width: 900,
                   // height:180,
                   buttons: [
                          {
                            text: "OK",
                            class: "filepriceok",
                            click: function() 
                            { 
                              //  validation
                                 if ( $("#filepricedialog input#new_target_date2").val() == "")
                                   {
                                         Swal.fire({
                                              icon: 'error',
                                              title: 'Error in your selection...',
                                              text: 'Target date cannot be blank'
                                                    
                                          })

                                         //alert('Target date cannot be blank');
                                         return false;
                                           
                                   }


                            // click function ok  insert swal  now
                                
                                     Swal.fire({
                        title: "Change Status will be Saved",
                        text: "Change will not be Reverted Back, Continue..?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                  .then((willDelete) => {
                  if (willDelete) {
                    
                            var targettime2 = '';
                             if ( $("#filepricedialog input#new_target_date2").val() == "")
                                   {
                                         Swal.fire({
                                              icon: 'error',
                                              title: 'Error in your selection...',
                                              text: 'Target date cannot be blank'
                                                    
                                          })

                                         //alert('Target date cannot be blank');
                                         return false;
                                           
                                   }

                            else {

                                  var a1 = 0;
                        var a2 = 0;
                        var a3 = 0;                                                              
                       
                        var a1 =  $(".old_price1").val();
                        var a2 =  $(".add_price").val();
                        var new_target_date2 = $("#filepricedialog input#new_target_date2").val();

                        var rev_note =  $("#filepricedialog .rev_note").val();
                        //$(this).closest('tr').find('.targettime').val(new_target_date2);
                        $('.targettimeid'+addclassname).val(new_target_date2); 

                      

                                          
                        if (a1>=0 && a2 >= 0 && a1 != '' && a2 !='')
                        {
                           var a3 =   parseFloat(a1) + parseFloat(a2);  
                        }
                        
                        
                        if (typeof(a3) == 'undefined' || a3 == null ) {
                           a3 = 0 ;
                        }
                        
                        // alert(a3);
                        //$(".valid_file_price").val(a3);
                        $('.dtl_filepriceid'+addclassname).val(a3);

                        TotalPriceCalc();

                        
                        var targettime2 = '';

                        vclient_specific  =  $("#editorderform .client_specific").val();

       if (  status2 == 'Ch-Completed' || status2 == 'Completed'  ||  status2 == 'Rev-Completed'){

                      // swal({
                      //                     icon: 'error',
                      //                     title: 'Special Client Details',
                      //                     text: vclient_specific
                                          
                      //               })
                      Swal.fire("Client Specific Details", vclient_specific, "success")
       }
                       

                        var formData = {
                            childid:  childid, 
                            status2: status2,
                            old_price: a1,
                            add_price: a2,
                            a3: a3,
                            new_target_date2: new_target_date2,
                            allocname1: allocname1,
                            rev_note: rev_note,
                            _token: _token
                        }

                           $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/orderdtlstatus') }}",
                            data: formData,
                            success: function(result)
                            { 
                              console.log(result);

                              var res = result[0].msg ;
                              var oldstatus = result[0].oldstatus;
                              
                              if (res == "Updated successfully") {
                                   console.log(result[0].msg) ; 
                                    $(".allocationid"+addclassname).val(0);
                                   $("#allocationshow"+addclassname).html('not allocated');
                                    $('.hiddenallocationname'+addclassname).val('not allocated');
                                    $('.hiddenallocationid'+addclassname).val(0);
                                    $('.targettimeid'+addclassname).val(result[0].target_date);
                                     
                                        var re = /<br *\/?>/gi;
                                        var oldnotes1 = result[0].note;
                                        var oldnotes1 = oldnotes1.replace(re,"\n");
                                        
                                    $('.notes'+addclassname).val(oldnotes1);
                                    

                              }
                              else {

                                   $(newst).val(previous);
                                    Swal.fire({
                                          icon: 'error',
                                          title: 'Error in your selection...',
                                          text: res
                                          
                                    })
                                  return false;
                              }
                              //$(".delmsg").html(res).fadeOut('slow');

                               
                            }
                        });
                               

                               // code added

                                           $( this ).dialog( "close" );
                     

                      
                            } // else condition ends here
                       


                  } else {
                        //swal("Your imaginary file is safe!");
                      Swal.fire(
                            'Cancelled',
                            'Changes are reverted Back :)',
                            'error'
                          )
                          $( this ).dialog( "close" );
                            var previous = $('oldstatusvalue'+addclassname).val();
                           $(newst).val(previous);
                          e.stopPropagation();
                          return false;
                        }
                 });  
                

                            }  // click function swal added
                          },
                          {
                            text: "Calc",
                            click: function() {
                                     cal_new_price();
                                      return false;
                            }
                          },




                        ],
                         create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                           var previous = $('oldstatusvalue'+addclassname).val();
                           $(newst).val(previous);
                       e.preventDefault();
                       return false;
                   });
        },

                    

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                      
                       
                    },
                    open: function(event, ui) {
                        
                   
                    var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                    //var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                   // var AddButton = buttons[0];
            
                    
                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                   

                    
                 },
               });
            

            $( "#filepricedialog" ).dialog("open");
            
            $( "#filepricedialog input#new_target_date2" ).datepicker("setDate",new Date());         
            $("#filepricedialog .oldnotes").val(oldnotes);
            $("#filepricedialog .rev_note").val('');
            $("#filepricedialog .old_price1").val(oldprice);
            $("#filepricedialog .add_price").val(0);
            $("#filepricedialog .add_price").focus();
           // return false;

                 
   
          
              //  return false;
             // $(this).closest('td').find('.ctarget').focus();
        }

        if ( status2 == 'Rev-QC OK'  )
       {
            
            revision_qc_ok_update(previous, newst,childid, status2,  oldnotes, _token);
            
       }

         if (status2 == 'Revision') {
             //debugger;
              $('.hiddenallocationname'+addclassname).val('not allocated');
              $('.hiddenallocationid'+addclassname).val(0);
              $(newst).val(status2);
              var allocname1  =   $(".allocationid"+addclassname).val();
                       

                        
                     target_change(previous, newst,childid, status2,  oldnotes, _token);
         
                        // $(this).closest('td').find('.ctarget').focus();
                      return false;
                 
        
           
        }

        //return false;

       // debugger;
       vclient_specific  =  $("#editorderform .client_specific").val();

       if (  status2 == 'Completed' || status2 == 'Ch-Completed' || status2 == 'Rev-Completed'){

                      // swal({
                      //                     icon: 'error',
                      //                     title: 'Special Client Details',
                      //                     text: vclient_specific
                                          
                      //               })
                      Swal.fire("Client Specific Information", vclient_specific, "success")
       }

     
        // NEW LOGIC FOR STATUS CHANGE ADDED
        if (status2  == 'Changes' || status2  == 'Revision' || status2 == 'Rev-QC OK' ) {
                     


        }
        else {

               var allocname1  =  $(".allocationid"+addclassname).val();  

            var formData = {
                            childid:  childid, 
                            status2:  status2,
                            allocname1: allocname1,
                            _token: _token
                           
                        }
                           
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/orderdtlstatus') }}",
                            data: formData,
                            success: function(result)
                            { 

                              var res = result[0].msg ;
                              //var oldstatus = result[0].status ; this is wrong removed 22/10/19
                              var oldstatus =  result[0].oldstatus;
                              if (res == "Updated successfully") {
                                   console.log(result[0].msg) ; 
                              }
                              else {
                                   // alert(res);
                                     Swal.fire({
                                          type: 'error',
                                          title: 'Error in your selection...',
                                          text: res
                                          
                                    })
                                   //toastr.info(res);
                                  //alert($(this).val());
                                  ////$(this).val(previous);
                                  //alert($(newst).val());
                                   
                                  $(".allocationid"+addclassname).val(oldstatus);
                                   
                                  return false;
                              }
                              //$(".delmsg").html(res).fadeOut('slow');

                               
                            }
                        });
        
    }
      return false;
        // NEW LOGIC FOR STATUS CHANGE ADDED
   });

   


// added above code for status update in new edit mode on 28/09/17
 // added logic on 15/11/2019 to prevent  delete button on enter
     $(document).keypress(function(e) { 
            if(e.which == 13) {
                   alert('Please Submit Record');
                   e.preventDefault();
                   $("#btnSubmit").focus();
                   return false;
              }
      });

    $(window).keydown(function(event){
        if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });
// added logic on 15/11/2019 to prevent  delete button on enter

 // allocation logic
    $(document).on("change", "select.selectalloc", function(e){    
        // debugger;
       
         $("#editorderform").data("changed",true);
        var option_all = ''; 
        var option_all = $(this).closest('tr').find(".selectalloc option:selected").map(function() {     return $(this).text();
              
          }).get().join(',');

      $(this).closest('tr').find('.updatealloc').val(option_all);   
      //   var alloc =  this.value ;
         //alert(option_all);
      var childst = $(this).closest('tr').find('.neweditstatus').val();
      //alert(childst);

      if ((option_all == 'not allocated')  && (childst == 'QC Pending' || childst == 'QC Pending' || childst == 'Alloted' || childst == 'Completed'))
      {
        //alert('Please allocate files');
          Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Please allocate files'
                                          
                                    })
        e.stopPropagation();
        return false;
      }

      var result = new Array();

      //$("select.selectalloc").each(function() {
            result.push($(this).val());
      //  });

      var output = result.join(", ");
      //alert(output);
         $(this).closest('tr').find('.updateallocid').val(output);

    });

//$("#orderdtltable td.doctype").focusout(function(event) {
//not use in omsv4.com ask to delete
$(document).on("focusout", "#orderdtltable select.doctype", function(e){   
  /* Act on the event */
   //$("#btnSubmit").prop('disabled', 'false');
    var  document_type =  this.value ;
    var findtragetid=this.next().value;
    //alert("findtragetid");
    var now = new Date();
     // alert(document_type);
       
      if (document_type == 'Normal') {
              
            now.setDate(now.getDate()+1);
            //now.setMinutes(now.getMinutes() + 30);
            // alert(now);
            //var tdate = Date.parseDate(now, "Y-m-d g:i a");
 
             var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00';
            
            //alert(tdate);
            //$(".targettime").val(tdate);
            $(this).closest('tr').find('.targettime').val(tdate);

          }

});

$(document).on("focusout", ".dtl_fileprice" , function(e){
      //alert(this.value);
      //$("#btnSubmit").prop('disabled', 'false');
      TotalPriceCalc();


});


//$("#orderdtltable td.doctype").change(function(event) {
$(document).on("change", "select.doctype", function(e){     
  /* Act on the event */
      var  document_type =  this.value ;
      var findtargetid=$(this).next().val();
    
      var now = new Date();
      //alert(document_type);
      //$("#btnSubmit").prop('disabled', 'false');
       
      if (document_type == 'Normal') {
              
            now.setDate(now.getDate()+1);
            //now.setMinutes(now.getMinutes() + 30);
            
            //var tdate = Date.parseDate(now, "Y-m-d g:i a");
 
             var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn ;
            
            //alert(tdate);
            //$(".targettime").val(tdate);
            $('.targettimeid'+findtargetid).val(tdate);

          }
      else if (document_type == 'Rush') {
              
            var now = new Date();
            
            var now = new Date(now.setHours(now.getHours() + 3));
            //alert('new hour' +now);
            
            
            var now = new Date(now.setMinutes(now.getMinutes() + 30));
            //alert('new' + now);
            
            var d   =   now,
            month   = '' + (d.getMonth() + 1),
            day     = '' + d.getDate(),
            year    = d.getFullYear(),
            hr      = d.getHours() ,
            mn      = d.getMinutes();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00' ;
            
          
            //$(".targettime").val(tdate);
            $('.targettimeid'+findtargetid).val(tdate);

      } 
      else {

            var now = new Date();
            var now = new Date(now.setHours(now.getHours() + 1));
            var now = new Date(now.setMinutes(now.getMinutes() + 30));

            var d   =   now,
            month   = '' + (d.getMonth() + 1),
            day     = '' + d.getDate(),
            year    = d.getFullYear(),
            hr      = d.getHours() ,
            mn      = d.getMinutes() ;

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00';
            
            //alert(tdate);
            //$(".targettime").val(tdate);
             $('.targettimeid'+findtargetid).val(tdate);

      }   


});

$(".add_price").change(function(){
        cal_new_price();
        return false;
});


function TotalPriceCalc() {
   var total = 0.00;
  
    $(".dtl_fileprice").each(function() {
      // alert(this.value);
       if ($("#client_company").val() == "Signs")
        {
            
             $(this).val(5);
        }
        // else {
        //       $(this).val(5.5);
        //  }

  
      //var cnt = $(".dtlbody").children().length;
      //alert(cnt);
    
    total += parseFloat(this.value,2) || 0;
  
  });
    //$("#lblTotalPrice").val(total);
    
      $(".valid_file_price").val(total);
}


// logic added for multiple rows status change to Revision and change status


  function cal_new_price() {
        
        var a1 =  $(".old_price1").val();
        var a2 =  $(".add_price").val();
        $(".file_price2").val( parseFloat(a1) + parseFloat(a2));
        return false;

  }

  function file_price_cal(){
     // debugger;
    var oldprice = $(".valid_file_price").val();
    
   // $("#filepricedialog").dialog();

    $("#filepricedialog").dialog( { 
              title : "File Price Changes",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    //left: 1000,
                    width: 900,
                   // height:180,
                   buttons: [
                          {
                            text: "OK",
                            class: "filepriceok",
                            click: function() 
                            {
                                   if ( $(".new_target_date2").val() == "")
                                   {
                                        // alert('Target date cannot be blank');
                                          Swal.fire({
                                              icon: 'error',
                                              title: 'Error in your selection...',
                                              text: 'Target date cannot be blank'
                                                    
                                          })

                                         return false;
                                           
                                   }
                                    
                                  else {
                                          //alert('ok close');
                                           $( this ).dialog( "close" );
                                       
                                       
                                     }

                            }
                          },
                          {
                            text: "Calc",
                            click: function() {
                                     cal_new_price();
                                      return false;
                            }
                          },




                        ],
                    

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                    },
                    open: function(event, ui) {
                        
                   
                    var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                    //var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                   // var AddButton = buttons[0];
            
                    
                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                   

                    
                 },
               });
            

             $( "#filepricedialog" ).dialog("open");
                      
             $(".old_price1").val(oldprice);
             $(".old_price1").focus();
                 
             return false;
  }  


  function target_change(previous, newst, childid,status2, oldnotes, _token)
  {
   
    //alert(oldnotes);
   // var childid = $(newst).closest('tr').find('.odtl_id').val();
   //alert(childid);

       


     $("#revisionchilddialog").dialog( { 
                    title : "Revision Update",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    //left: 1000,
                    width: 800,
                    height:480,
                   buttons: [
                          {
                            text: "OK",
                            class: "revok",
                            click: function() 
                            {      
                                if ( $("#revisionchilddialog .new_target_date2").val() == "")
                            {
                                         //alert('Target date cannot be blank');
                                         
                                         Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Target date cannot be blank'
                                        
                                         })

                                          return false;

                                           
                            }
                            else if  ( $("#revisionchilddialog  #rev_mistake").val() == "0") {
                                        Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Please Select Revision Mistake Done by'
                                        
                                         })

                                          return false;
                            }
                             else if  ( $("#revisionchilddialog  #rev_mistake_reason").val() == "") {
                                        Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Revision Mistake Reason Cannot be Blank'
                                        
                                         })

                                          return false;
                            }
                           

                            Swal.fire({
                        title: "Revision Status will be Saved",
                        text: "Status Change will not be Reverted Back, Continue..?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                  .then((willDelete) => {
                  if (willDelete) {
                        // $(newst).closest('tr').find('.updatealloc').val('not allocated');
                        // $(newst).closest('tr').find('.updateallocid').val(0);
                        // $(newst).closest('tr').find('select.neweditstatus').val(status2);
                        // var allocname1  =   $(newst).closest('tr').find('select.selectalloc').val();

                        // target_change(previous, newst,childid, status2,  oldnotes, _token);
         
                        // $(this).closest('td').find('.ctarget').focus();
                       // return false;
                            var targettime2 = '';
                            if ( $("#revisionchilddialog .new_target_date2").val() == "")
                            {
                                         //alert('Target date cannot be blank');
                                         
                                         Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Target date cannot be blank'
                                        
                                         })

                                          return false;

                                           
                            }
                            else if  ( $("#revisionchilddialog  #rev_mistake").val() == "0") {
                                        Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Please Select Revision Mistake Done by'
                                        
                                         })

                                          return false;
                            }
                             else if  ( $("#revisionchilddialog  #rev_mistake_reason").val() == "") {
                                        Swal.fire({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Revision Mistake Reason Cannot be Blank'
                                        
                                         })

                                          return false;
                            }

                            else {

                              var rev_mistake  =  $("#revisionchilddialog  #rev_mistake").val();
                            var rev_mistake_reason  =  $("#revisionchilddialog  #rev_mistake_reason").val();

                            var rev_note  =  $("#revisionchilddialog  .rev_note").val();
                            var new_target_date2 = $("#revisionchilddialog .new_target_date2").val();

                            var rev_note  =  $("#revisionchilddialog  .rev_note").val();

                            var mistake_designer_name = $("#revisionchilddialog #mistake_designer_name").val();

                            var mistake_lead_name = $("#revisionchilddialog #mistake_lead_name").val();

                            vclient_specific  =  $("#editorderform .client_specific").val();
                             var allocname1=$(".allocationid"+childid).val();
// console.log(childid);
// console.log(status2);
// console.log(new_target_date2);
// console.log(rev_mistake_reason);
// console.log(rev_mistake);
// console.log(mistake_designer_name);
// console.log(mistake_lead_name);
// console.log(rev_note);
// return false;
       if ( status2 == 'Completed' || status2 == 'Ch-Completed' ||  status2 == 'Rev-Completed'){

                      // swal({
                      //                     icon: 'error',
                      //                     title: 'Special Client Details',
                      //                     text: vclient_specific
                                          
                      //               })
                        Swal.fire("Client Specific Information", vclient_specific, "success")
       }
            

                            var formData = {
                                  childid:  childid, 
                                  status2: status2,
                                  new_target_date2: new_target_date2,
                                  rev_note: rev_note,
                                  rev_mistake_reason: rev_mistake_reason,
                                  rev_mistake: rev_mistake,
                                  mistake_designer_name: mistake_designer_name,
                                  mistake_lead_name: mistake_lead_name,
                                  allocname1:allocname1,
                                   _token: _token
                                
                            }

                            $( this ).dialog( "close" );
                                

                      

                      $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/orderdtlstatus') }}",
                            data: formData,
                            success: function(result)
                            { 
                             
                              var res = result[0].msg ;
                              var oldstatus = result[0].oldstatus ;
                              if (res == "Updated successfully") {
                                   console.log(result[0].msg) ; 
                                   console.log(status2);
                                   $(newst).val(status2);
                                    if ( status2 == 'Revision'){

                                      
                                      $(".allocationid"+childid).val(0);
                                      $('.hiddenallocationname'+childid).val('not allocated');
                                      $('.hiddenallocationid'+childid).val(0);
                                      $('.targettimeid'+childid).val(result[0].target_date);

                                         var re = /<br *\/?>/gi;
                                        var oldnotes1 = result[0].note;
                                        var oldnotes1 = oldnotes1.replace(re,"\n");  
                                      $('.notes'+childid).val(oldnotes1);
                                   }  
                              }
                              else {
                                   //alert(res);
                                     Swal.fire({
                                          icon: 'error',
                                          title: 'Error in your selection...',
                                          text: res
                                          
                                    })
                                   //use 
                                  $(newst).val(previous);
                                  return false;
                              }
                               
                            }
                      });  
                       

                      
                            } // else condition ends here
                       


                  } else {
                        //swal("Your imaginary file is safe!");
                      Swal.fire(
                            'Cancelled',
                            'Changes are reverted Back :)',
                            'error'
                          )
                          $( this ).dialog( "close" );
                           
                           $(newst).val(previous);
                          e.stopPropagation();
                          return false;
                        }
                 });  
                
                       
                          },

                            }
                            
                            
                         

                        ],
                      create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                          
                           $(newst).val(previous);
                       e.preventDefault();
                       return false;
                   });
        },

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                    },
                    open: function(event, ui) {
                   
                       var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                                      
                        $(this).find('.ui-dialog-titlebar-close').blur();

                    },
               });

             $("#revisionchilddialog").dialog("open");
             $("#revisionchilddialog .rchildid").val(childid);
             $( "#revisionchilddialog .oldnotes").val(oldnotes);
             $( "#revisionchilddialog .rev_note").val('');
             $( "#revisionchilddialog  select#rev_mistake").val('0');
             $( "#revisionchilddialog #rev_mistake_reason").val('');
             $("#revisionchilddialog #mistake_designer_name").val('');
             $("#revisionchilddialog #mistake_lead_name").val('');
             $(".new_target_date2").val('');
            // $("#target_completion_time2").datetimepicker();
            // $("#target_completion_time2").datepicker("setDate",new Date());
             $( "#revisionchilddialog input#new_target_date2" ).datepicker("setDate",new Date());
            
             return false;  
    
    
  }  
  //DV button logic
    $(document).on("click", ".delayorderv", function(e){
  
        $("#ModalDelayed").modal('show');
        $('#delayheader').html("Orders Delayed Vector after Target Time");
        //$("#search").val($value);
        $("#table3 tbody").html('<h2>Please wait ... </h2>');
        $value = "" ;
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('delayedordersv') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    console.log(data);
                    $("#table3 tbody").html(data);
                  }
        
        });
 
});
//Delay order digitizing DD button logic
$(document).on("click", ".delayorderd", function(e){

        $("#ModalDelayed").modal('show');

        //$("#search").val($value);
        $("#table3 tbody").html('<h2>Please wait ... </h2>');
        $value = "" ;
           $('#delayheader').html("Orders Delayed Digitizing after Target Time");
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('delayedordersd') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    console.log(data);
                    $("#table3 tbody").html(data);
                  }
        
        });
 
});
//delay photoshop DP buton logic
$(document).on("click", ".delayorderp", function(e){
         
         $("#ModalDelayed").modal('show');

        //$("#search").val($value);
        $("#table3 tbody").html('<h2>Please wait ... </h2>');
        $('#delayheader').html("Orders Delayed Photoshop after Target Time");
        $value = "" ;
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('delayedordersp') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    console.log(data);
                    $("#table3 tbody").html(data);
                  }
        
        });
 
});
//CC button logic
$(document).on("click", ".todayscompany", function(e){
       
        $("#todayordModal2").modal('show');
        //$("#search").val($value);
        $("#todayorder tbody").html('<h2>Please wait ... </h2>');
        $value = "" ;
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('todayordcomp') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    console.log(data);
                    $("#todayorder tbody").html(data);
                  }
        
        });
 
});
//show data on count company table by divyaraj
$(document).on("click", "#datecompanycount", function(e){

      var cstartdate= $("#startdatecount").val();
      var cenddate= $("#enddatecount").val();

        $("#todayorder tbody").html('<h2>Please wait ... </h2>');
        $value = "" ;
    
        $.ajax({
            type: "post",
            cache: false,
            url: "{{ URL::to('searchordcomp') }}",
            data: {
                             "_token": "{{ csrf_token() }}",
                             "cstartdate":cstartdate,
                             "cenddate":cenddate,
                       },   
            success:function(data)
                  {
                    console.log(data);
                    $("#todayorder tbody").html(data);
                  }
        
        });
 
});
//allocation field change with allocation function
function myFunction(cc,csf,csf2,allocationshowid) {
   
   var x =  $(cc).val();
   var y =  $(cc).text();

       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
   $('#'+csf).val(y);   
   $('#'+csf2).val(x); 
   $('#'+allocationshowid).html(dc);
   
}
//dunamic added file allocation field change with allocation function(javascript)
function myFunctionDynamic(cc,csf,csf2,allocationshowid) {
 
   var x =  $(cc).val();
   var y =  $(cc).text();

       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
   $('#'+csf.id).val(y);   
   $('#'+csf2.id).val(x); 
   $('#'+allocationshowid.id).html(dc);
  
}
function myStatuscolor(thisstatus) {

  var statusname=$(thisstatus).val()
  
  if(statusname == 'QC OK' || statusname == 'Rev-QC OK' || statusname == 'Ch-QC OK'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('qcokcolor');
  }
  else if(statusname == 'Quote'){
     var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('quotecolor');
  }
  else if(statusname == 'QC Pending' || statusname == 'Ch-QC Pending' || statusname == 'Rev-QC Pending'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('qcpendingcolor');
  }
  else if(statusname == 'No Response'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('noresponsecolor');
  }
  else if(statusname == 'Approved'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('approvedcolor');
  }
  else if(statusname == 'UnApproved'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('unapprovedcolor');
  }
  else if(statusname == 'Alloted' || statusname == 'Ch-Alloted' || statusname == 'Rev-Alloted'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('allotedcolor');
  }
  else if(statusname == 'Completed' || statusname == 'Rev-Completed' || statusname == 'Ch-Completed'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('completedcolor');
  }
  else if(statusname == 'On Hold'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('onholdcolor');
  }
  else if(statusname == 'Cancel'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('cancelcolor');
  }
  else if(statusname == 'Revision'){
    
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('revisioncolor');
   
  }
  else if(statusname == 'Changes'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('changescolor');
  }
  else if(statusname == 'Complain'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('complaincolor');
  }
  else if(statusname == 'Requote'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('requotecolor');
  }
  else if(statusname == 'Duplicate Entry'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('duplicateentrycolor');
  }
  else if(statusname == 'Duplicate Entry'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('duplicateentrycolor');
  }
  else if(statusname == 'Followup'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('followupcolor');
  }
  else{
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('nocolorclasscolor');
  }

}
 function countValue(){
       
        $.ajax({
        type:'GET', 
        url: '{{route("order.getdelayvalue")}}',
      
        success: function (resp) {
          $('#delayordersvcount').text('('+resp.delayordersv+')');
          $('#delayordersdcount').text('('+resp.delayordersd+')');
          $('#delayorderspcount').text('('+resp.delayordersp+')');    
          $('#todayscompanycount').text('('+resp.todayscompany+')'); 
        },
        error: function () {}
        }); // ajax asynchronus request 
    }
</script> 


@stop
