@extends('layouts.bootswatchold030117')


@section('content')

<style type="text/css">


.dt-button {
  background: #bbdefb !important;
    
}

.paybutton {
   border-radius: 4px;
  background-color: #f4511e !important;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 10px;
  width: 120px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}


.clientinput {
  text-align: left !important ;
}



div.finalalloc {
   display: none;
}

div.feditdtlstatus {
  display: none;
}

/*input.btn.submitdtl {
  display: none;
}*/

select.selectalloc {
   background: white ;
   color: blue ;
}

.modal-footer {
  padding: 10px !important;
}


/*input[type=text], textarea {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;
}*/
 
/*input[type=text]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);
}
*/

select:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);
}


button:active {
outline: none  !important;
border: none !important;
}


button:focus {
    box-shadow:none !important;
    outline:0 !important;
    background: #86ff28 !important;
}

#invoices-table_wrapper .dataTables_paginate .paginate_button {
  color: #1BCBFF !important;  /* changed on 04-08-18  as per inst of kulind sir from blue to .. */
  font-weight: bold !important;
}


.dataTables_info {
  color: #1BCBFF !important;  /* changed on 04-08-18  as per inst of kulind sir from blue to .. */
  font-weight: bold !important;
}

th.dt-center

th input {
        width: 90%;
    }

.btn-success {
  color: orange !important;
}

.quotecolor {
  background: #0a17ec !important;
  color: white;
}

.allotedcolor {
  background: black !important;
  color: white;
}

.revisioncolor {
    background: #FA7C7C !important;
    color: black !important;
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



.qcpendingcolor {
  background: #FA4193 !important;
  color: black !important;
}

.completedcolor {
  background: #41E329 !important;
  color: black !important;
}

.qcokcolor {
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


.class_black {
   color: black !important;
}


.error {
   color: red;
}

.foo   {
   color: blue;
   background: #006064 !important;
}

.my-input-class {
  color: blue;
}

.fooalloc   {
   color: orange !important;
   background: #FFFACD !important;
}

.fooid   {
   color: blue;
   /*background: transparent !important;*/
   width: 1px !important;
}

.fstat   {
   /*background: #00695c; */
   background:  #9c9391;
  /* color: white !important; removed as background now white on 02/05/17 */
   text-align: center;
   /*border: 0px;  removed for paralled testing on 08/02/17
   padding: 0px !important;*/
           
  }

.fstatprice   {
  background: #00695c; 
  
  /* color: white !important; removed as background now white on 02/05/17 */
   text-align: center;
   /*border: 0px;  removed for paralled testing on 08/02/17
   padding: 0px !important;*/
           
  }  

div.DTFC_RightHeadBlocker {
 /* background: #00695c !important;   removed as background now white on 02/05/17 
   background:  #9c9391 !important; */
}

.fhead   {
   /*background: #00bfa5  !important;
   background: transparent !important;  
   color: white !important;  */
   text-align: center;
   vertical-align: middle;
   /*opacity: 0.5;*/
   font-weight: 900;
   overflow-x: hidden;


}

/* removed on 13/09/17 due to clash with bootswatch .test  {
  color: blue !important;
}*/ 

.fbody tr  {
 /* height: 5px !important ;  */
}

.fbody td  {
 /* height: 5px !important ;*/

}

.fcol   {
     /*  background: transparent !important;
   background: #00bfa5  !important;color: #01579b !important;*/
   text-align: center;
   vertical-align: middle;
 
}

input {
  text-align: left !important ;
}

.clientcomp {
   text-align: left !important ;
   float: left ;
}


/*button#stat .fmy .ui-button .ui-corner-all .ui-widget .btn .btn-small .btn-primary .navbar-btn  {
*/ 
/*.fmy {
  margin: 20px 0 !important;
  display: block !important;
}*/

/*.fmy:focus {        for  checking focus navigation
 background: transparent !important;
}*/

.ui-button .ui-icon {
    color: red !important ;
}

.ui-dialog-titlebar {
    background: #D984DA !important;  
}

#statusdialog .ui-widget select {
    background: #D5D1A3 !important;
  }


/*.ui-dialog .ui-dialog-content { background: yellow !important; } */

.ui-dialog .ui-dialog-buttonpane { background: #71B1E9 !important; }

table#invoices-table tbody tr.selected {
    background-color: #e57373 !important;
    }

table#invoices-table td a.glyphicon-edit:hover {
     color: orange !important;
}






/*.ui-dialog {
 top: 40% !important;
  position: absolute !important;
  float: top;
  left:  40vw !important;
   
}
*/



/*#statusdialog  {
  top: 50% !important;
  left: 80% !important; 
  position: absolute !important;
  float: right;
}*/


span.error {
    color: #880e4f !important;
}


/*.btn {
  background: transparent !important;
}*/

.modal-header {
/*  background: #2196f3; removed on 12/04/17  */ 
    background:  #9c9391;

}

  
.modal-dialog{
    overflow-y: initial !important;
}

.modal-body{
    max-height: calc(100vh - 200px) !important;
    overflow-y: auto  !important;
    /*background: #00bfa5 ;
    background:    #44703c   ; removed on 12/04/17  
    background: transparent !important ;  */
    scrollbar-face-color: #414340;
            scrollbar-shadow-color: #cccccc;
            scrollbar-highlight-color: #cccccc;
            scrollbar-3dlight-color: #cccccc;
            scrollbar-darkshadow-color: #cccccc;
            scrollbar-track-color: #cccccc;
            scrollbar-arrow-color: #000000;
}


.modal-footer {
   /*background: #2196f3;*/
    background:  #9c9391;
}

label {
  color: white ;
}



/*table#invoices-table {
    height: 600px !important;
}*/

/*table#invoices-table thead {
    background: #00bfa5  !important;
}*/


/*table#invoices-table {
        background: transparent !important;
        margin-left: 5px !important ;
        padding-left: 10px !important ;
}  */ 

/*table#invoices-table tbody tr td.FirstCol {
        background: transparent !important ;
}  
*/

.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    text-align: center !important;
    empty-cells: hide;
}

 
table#invoices-table tbody  tr.odd {
 /*  height: 2px !important ;*/
}

table#invoices-table tbody  tr {
       /*  background: transparent ;  removed on 02/05/17 as background changed to day white
       max-height:  5px !important;*/

        background: transparent ;
     
}  

h1, h2, h3 ,h4 {
/*  color: black !important;*/
  font-weight: bold ;
}

table#invoices-table td:hover{
    cursor: pointer;
    background-color: #ffab40;
    color: #311b92 !important;

    /*color: #FFF !important;   opacity: 1;*/
}

/*th, td { white-space: nowrap; }
    div.dataTables_wrapper {
       margin: 0 auto;
    }*/


/*table#invoices-table   tr.redClass {
   background-color: green;
}*/

span.super {
    vertical-align:super;
    font-size:70%;
}



/*.btn-sm,.btn-group-sm>.btn.edit-dtl {  removed as to increase distance on 27/09/17
  padding: 5px 0px !important;
}*/

table#invoices-table td, th {
  position: relative;
  background: transparent ; 
 /* padding: 2px 4px !important;*/
 padding-left: 4px !important;
  padding-right: 4px !important;
  text-align: left;
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  border-top: 0px;
  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
   max-width: 200px !important;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;  
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  
}

table.dataTable tbody td {
    padding: 1px 1px !important;
}


.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td  {
  /*line-height: 0.1px !important;*/
  /* padding: 0 !important;*/
  padding-top: 0 !important ;
  padding-bottom: 0 !important ;
}


/*.table>thead>tr>th, .table>thead>tr>th.fstat {
  line-height: 25px !important;
  padding-bottom: 8px !important ;
}
*/


/*
Removed on 21/12/2016 as now theme is working in back and it was
imposed as to padd minimum space around text item
table#invoices-table tbody td.osize {
    padding-left: -2px !important;
    padding-right: 2px !important;
    font-size: 9px;
    background: transparent ;
}
*/

/*table#invoices-table td:hover::after,
table#invoices-table th:hover::after {
  content: "";
  position: absolute;
  background-color: #008080;
  left: 0;
  top: -5000px;
  height: 10000px;
  width: 100%;
  z-index: -1;
}*/


/*
table#invoices-table thead th.sorting_asc {
    background: #66A9BD url('images/sort_asc.png') no-repeat right center;
}
 
table#invoices-table thead th.sorting_desc {
    background: #66A9BD url('images/sort_desc.png') no-repeat right center;
}
 
table#invoices-table thead th.sorting {
    background: #66A9BD url('images/sort_both.png') no-repeat right center;
}*/

h1 {
    text-align: center;
    font-weight: bold ;
}


table#clienthelp th {
   /* background-color: #0288d1;  removed on 12/04/17*/
   background:  #9c9391 !important;
}

table#clienthelp td {
    /*background-color: #3f51b5; removed on 02/05/17
    background-color: transparent;  */
     color: blue;
}


table#clienthelp tr:hover{
    cursor: pointer;
    background-color: #ffab40 !important; 
      color: #311b92 !important;
    /*color: #FFF !important;*/
}

table#dtltable tr:hover {
  cursor: pointer;
  /*background-color: #ffab40 !important; 
  color: #311b92 !important;
   color: #FFF !important;*/
}

table#editclienthelp th {
   /* background-color: #0288d1;
     background:  #9c9391 !important;  */
     background:  #9c9391 !important;
}

table#editclienthelp td {
    /*background-color: #3f51b5;*/
    background-color: transparent;
    color: blue;
}

table#editclienthelp tr:hover{
    cursor: pointer;
    background-color: #ffab40 !important;
    color: #311b92 !important;
    /*color: #FFF !important;*/
}



/*.selected {
    background-color: brown;
    color: #FFF;
}*/


#page-wrap {
  margin: 50px;
}

p {
  margin: 20px 0; 
}

/*
input[select] {
     color: #FF5722;
   }*/

.cnote {
  color: #FF5722 !important;
}

.editcnote {
  color: #FF5722 !important;
}

#document_type {
  color: #FF5722;
}

#file_type {
  color: #FF5722;
}

#note {
  color: #FF5722;
}

select.vend {
  color: #FF5722;
}

select.editvend {
  color: #FF5722;
}

/*.input-sm {
     color: #FF5722;
   }*/



#timezone_type {
     color: #FF5722;
   }

.foo {
     color: #FF5722;
   }   

  #store_type {
     color: #FF5722;
   }   

  #status {
     color: #FF5722;
   } 

   .finalstatus {
     color: #FF5722   !important;
     background: #FFFACD !important;
   } 

  /* label {
     color: #212121;
   }

  input[type] {
     color: #FF5722;
   }*/

  a.my-tool-tip, a.my-tool-tip:hover, a.my-tool-tip:visited {
    color: blue;
  }

/* Ensure that the demo table scrolls 
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 1200px;
        margin: 0 auto;
    }
   
*/

/*.table-responsive {
  width: 98%;
  overflow-x: auto;
  overflow-y: hidden;
  -webkit-overflow-scrolling: touch;
  -ms-overflow-style: -ms-autohiding-scrollbar;
   margin-left: 15px !important ;
}*/
 
.container {
  padding-left: 15px !important;
  padding-right: 15px !important;
  width: 100% !important ;
}

element.style {
  height: 1px !important;
}

/*table.dataTable span.highlight {   changed on 20/10/17 as new theme is bootswatch
  background-color: #e8f8f5;

  border-radius: 0.28571429rem;
}

table.dataTable span.column_highlight {
 
  background:  #e8f8f5;
  border-radius: 0.28571429rem;
}
*/

 th input {
       /* width: 70%;*/
        background: #E6E6FA;
    }

th input.Edit {
  width: 0%;
  visibility:hidden;
}

th input.FSta {
  width: 0%;
  visibility:hidden;
}

select[name='invoices-table_length'] {
  color: blue !important;
}

</style>

<link href="{{ URL::asset('css/animate.min.css') }}" rel="stylesheet">


{{-- <script src="//code.jquery.com/jquery.js"></script>  --}}
<script src="{{ URL::asset('js/code-jquery1.11.1.js') }}"></script> 
  <!-- form validation -->

 {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script> --}}
  <script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.1-ui.js') }}"></script>




@if(isset($rights))
   
  

  @foreach ($rights as $key)
         
    <?php 
   
        $var[] = $key; 
      
    ?>
   

  @endforeach

@endif

<h4>Invoices</h4>

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
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



{{-- <div class="row jeevan">  --}}
{{-- <div class="table-responsive">  --}}

   

<div class="row" style="height:10vh; ">
    <input type="hidden" name="orddelete" id="orddelete" /> 
    <input type="hidden" name="createdrowid" id="createdrowid" /> 
    <div class="col-md-1"  style="float: left;" >
          <button type="button" class="btn btn-primary " data-toggle="tooltip" 
                title="Clear Search" ><span class="clearsession glyphicon glyphicon-erase" > </span>
          </button>
    </div>
    
     <div class ="col-md-1" style="float: left;" > 
             <a   class="btn btn-primary" href="{{ action("OrdertablesController@getIndex") }}"><span class="glyphicon glyphicon-arrow-left"></span></a>
    </div>
   {{--  <div class="col-md-4"  style="float: left;" >
        <a   class="btn btn-primary delsession glyphicon glyphicon-erase " > Clear Search </a>
        <a   class="btn btn-primary orderalloc" href="#"> Allocate Multiple Orders</a>
    </div> --}}
   
      {{-- <div id="deleteTheOrder" style="float: left;" class="col-md-2">

     {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteOrder', 'action' => ['OrderController@destroy', $order->id]]) !!}
      {!! Form::button( 'DELETE', ['type' => 'submit', 'class' => 'btn btn-lg btn-danger btn-border wow fadeInUp delete ','id' => 'btnDeleteProduct' ] ) !!}
              {!! Form::close() !!} 
 

    </div> --}}

   
    
    <div style ="float:center;" class="delmsg  col-md-2"> </div>

     <div class ="col-md-1" style="float: center;" > 
             <a   class=" btn btn-small w3-button w3-round-small paybutton  w3-khaki" href="{{ action("OrdertablesController@getIndex") }}"><b>Submit</b></a>
</div>

 
    <div class ="col-md-1" style="float: right;"> 
        @if (isset($var))
          @if (in_array('client.create', $var))
                 <a href="{{url('/clients/create')}}" style="float: right;" data-toggle="tooltip" 
                title="Create Client" class="btn btn-primary btn-small my-tool-tip" ><span class="glyphicon glyphicon-plus"></span></a>  
    
          @endif
        @endif
    </div>    

   
   
    <div class ="col-md-2" style="float: right;">
   
        @if (isset($var))
        @if (in_array('order.create', $var))
              
                {{--  <a href="#OrderCreateModal" style="float: right;" data-toggle="modal" class="btn btn-small btn-primary btn-border wow fadeInUp ocreate " >Create Order</a>   --}}
                <a href="{{ route('orders.create') }}" style="float: right;" data-toggle="tooltip" title="Create Order"  class="btn btn-info  btn-border wow fadeInUp " ><span class="glyphicon glyphicon-plus-sign"></span></a>  

   

        @endif
        @endif
      
    </div>      
   

</div>


<table class="table table-responsive table-striped table-hover condensed searchHighlight maint" id="invoices-table">
    <thead class = "fhead">
        <tr class="firstrow">
            <th>Pay</th>
            <th>Order Id</th>
            <th>Order Date</th>
            @if (isset($var) )
                      @if (in_array('show.client-name', $var) )
                       <th>Client Name</th>
                       @else
                          <th></th> 
                      @endif 

            @endif
            <th>Company Name</th>
            <th>Primary Email</th>
            <th>Vendor </th>
            <th>File Type</th>
            <th>File Name</th>
           
            <th>Priority</th>
            <th>Order Date & Time</th>
         
            <th>Stich Count</th>
            <th> @if (isset($var))
                    @if (in_array('file-price.hide', $var) || Auth::user()->hasRole('Designer'))
                         
                    @else
                             File Price
                    @endif
                    @endif  </th>
            <th> @if (isset($var))
                    @if (in_array('v_emb_rate.hide', $var))
                         
                    @else
                           V.Emb.Rate
                    @endif
                    @endif   </th>
            <th> @if (isset($var))
                    @if (in_array('vend-file-price.hide', $var))
                         
                    @else        
                          V.File Price
                    @endif
                    @endif  </th>
            <th>Client Contact</th>
            <th>Client Note</th>
            <th>Id</th>
            <th>Status</th>
            <th>File Count </th>
              <th> @if (isset($var))
                    @if (in_array('file-price.hide', $var) || Auth::user()->hasRole('Designer'))
                         
                    @else
                             File Price
                    @endif
                    @endif  </th>
            <th>FStatus</th>
            
           
            
        </tr>
         <tr class="secondrow">
            <th class="select-checkbox"><input type="checkbox" 
            id = "selectAll" name="select_all"></th>
            <th>Order Id</th>
            <th>Order Date</th>
            <th style="text-align: left !important;" > @if (isset($var))
                      @if (in_array('show.client-name', $var))
                         Client Name
                      @endif 
                      
                @endif      </th>
            <th style="text-align: left !important;" >@if (isset($var))
                      @if (in_array('show.company', $var))
                         Company Name
                      @endif 
                      {{-- @if (!in_array('hide-company', $var))
                         Company Name
                      @endif --}}   
                @endif 
            </th>
            <th >@if (isset($var))
                      @if (in_array('show.primary-email', $var))
                          Primary Email
                      @endif   
                      {{-- @if (!in_array('restrict-primary-email', $var))
                          Primary Email
                      @endif    --}}
                @endif 

            </th>
            <th>Vendor </th>
            <th>File Type</th>
            <th>File Name</th>
         
            <th>Priority</th>
            <th>Order Date & Time</th>
           
            <th>Stich Count</th>
            <th> @if (isset($var))
                    @if (in_array('file-price.hide', $var)  || Auth::user()->hasRole('Designer'))
                         
                    @else
                             File Price
                    @endif
                    @endif  </th>
            <th> @if (isset($var))
                    @if (in_array('v_emb_rate.hide', $var))
                         
                    @else
                           V.Emb.Rate
                    @endif
                    @endif   </th>
            <th> @if (isset($var))
                    @if (in_array('vend-file-price.hide', $var))
                         
                    @else        
                          V.File Price
                    @endif
                    @endif  </th>
            <th>Client Contact</th>
            <th>Client Note</th>
            <th>Id</th>
            <th>Status</th>
            <th>File Count </th>
              <th>  </th>
            <th>File <br> Status</th>
            
           
            
        </tr>
    </thead>
    <tbody class="fbody"></tbody>
    <tfoot>

            <tr> 
               <th></th>
            <th></th>
            <th></th>
            <th>     </th>
            <th class="topay">    </th>
            <th>  </th>
            <th></th>
            <th></th>
            <th></th>
         
            <th></th>
            <th></th>
           
            <th></th>
            <th>  </th>
            <th>   </th>
            <th>  </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th> </th>
              <th>  </th>
            <th></th>
            
           

             
            </tr>
        </tfoot>
</table>
 {{--</div> 
 </div>  --}}

{{-- @if (isset($var))
@if (in_array('order-create', $var))
    <a href="#OrderCreateModal" data-toggle="modal" class="btn btn-primary ocreate ">Create Order</a>  
@endif
@endif --}}



 
{{--
@include('pages.orders.modals.create.orders' , ['SubmitTextButton'=>'Add']  )
@include('pages.orders.modals.edit.orders' , ['SubmitTextButton'=>'Edit']  )
@include('pages.orders.modals.edit.orderdtls_1' , ['SubmitTextButton'=>'Edit']  )
 --}}
@include('pages.orders.modals.edit.client_help')
@include('pages.orders.modals.create.client_help')

@include('pages.orders.dialogs.note')
{{-- @include('pages.orders.dialogs.alloc') --}}
@include('pages.orders.dialogs.orddate')
@include('pages.orders.dialogs.ordcompdate')
{{-- @include('pages.orders.dialogs.status') --}}
@include('pages.orders.dialogs.vendemb_rate')
@include('pages.orders.dialogs.filecount')
{{-- @include('pages.orders.dialogs.multipleorderalloc')
@include('orders.editdtl'); --}}



@endsection


@push('scripts')

<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.js') }}"></script>

<script>

$(function() {

var $rowid = 0 ;
var currentPageIndex = 0;
var rows_selected = [];
var rows_selected_total = [];
var tot2 = 0 ;



//  header logic search added
// $('#invoices-table .fhead .firstrow th').each( function (i) {
//         var title = $('#invoices-table th').eq( $(this).index() ).text();
//         var titleclass = title.substring(0,4);
//         if(title.trim().length> 0) {
//            $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder=" '+title+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
//         }
//     } );

//	var selected = [];    commented on 27/01/17  as  not know for what purpose kept

    $('#invoices-table').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        scrollX: true,
        scrollY: 400,  
        scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        bStateSave: true,
        fixedColumns:   false,
        select:         true,
        // fixedColumns:   {
        //      leftcolumns: 1,
        //     rightColumns: 2
        // },
       
        scroller: {
           rowHeight: 1
        }, 

       footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
         
            total = api
                .column( 20 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                //alert(total);
 
          
            pageTotal = api
                .column( 20, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
           
            $( api.column( 7 ).footer() ).html(
                '$'+pageTotal 
                //+' ( $'+ total +' total)'
            );
        },
        
        ajax: '{!! route('invoices.data') !!}',
         stateSaveCallback: function(settings,data) {
               localStorage.setItem( 'DataTables1_' + settings.sInstance, JSON.stringify(data) )
              },
            stateLoadCallback: function(settings) {
                   return JSON.parse( localStorage.getItem( 'DataTables1_' + settings.sInstance ) )
            },
            createdRow: function ( row, data, index ) {
                  var  tmp =  $("#createdrowid").val();
           
                  
                  var todaydt =  new Date() ;
                  var targetdt =  new Date(data.target_completion_time);
                  //console.log(targetdt + todaydt);
           
          },
      columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0,
                    checkboxes: {
                          selectRow: true
                          }
                }
              ],
              select: {
                      selector: 'td:first-child' ,
                      style: 'multi'
                    },
        columns: [
          { data: 'action', name: 'action', width: '5px', class: 'fstat ', orderable: false, searchable: false },
          { data: 'order_id', name: 'order_id', width: '10px'
                    // "render": function (data, type, full, meta) {
                    //         return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                    //         }
            },
            { data: 'order_date_time', name: 'order_date_time' , width: '50px' ,
                   "render": function (data, type, full, meta) {
                                                        
                             return '<span class="test" data-toggle="tooltip" title="' +  moment(data).format('DD/MM/YYYY h:mm a') + '">' + moment(data).format('DD/MM/YYYY h:mm a') + '</span>';
                             }
             },
            { data: 'client_name', name: 'client_name',  
                @if (isset($var))
               
                    @if (in_array('show.client-name', $var))
                         "render": function (data, type, full, meta) {
                              width: '50px'; orderable: true ;
                            return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
                    @else
                          
                           "render": function (data, type, full, meta) {
                             width: '0px' ; visible: 'false' ; orderable: false ;
                            return '';
                            }
                    @endif
                @endif   
                       

             },
            { data: 'client_company', name: 'client_company' ,
                @if (isset($var))
                      @if (in_array('show.company', $var))
                          width: '50px' ,
                         "render": function (data, type, full, meta) {
                            return '<span class="test1" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }  
                             
                      @else    
                          width: '0px', 
                         
                           "render": function (data, type, full, meta) {
                            return ' ';
                            }
                      @endif      
                @endif   

            },
            { data: 'client_email_primary', name: 'client_email_primary',  orderable: true,
                @if (isset($var))
                      
                        @if (in_array('show.primary-email', $var))
                             width: '100px' ,
                           "render": function (data, type, full, meta) {
                               return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
                        @else
                            width: '0px', 
                                                       
                             "render": function (data, type, full, meta) {
                            return '' ;
                            }

                        @endif
               
                @endif         

             },
            { data: 'vendor', name: 'vendor'} ,
            { data: 'file_type', name: 'file_type' ,
             "render": function (data, type, full, meta)
            {
                            return '<span data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }

            },
            { data: 'file_name', name: 'file_name', width: '200px',
                        "render": function (data, type, full, meta) {
                            return '<span class="filename" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }

            },
           
            
            { data: 'document_type', name: 'document_type' },
            { data: 'order_date_time', name: 'order_date_time' ,class: 'ord_dt_tm', width: '130px' ,
               "render": function (value, type, full, meta) {
                                                        
                             return '<span class="test" data-toggle="tooltip" title="' +  moment(value).format('DD/MM/YYYY h:mm a') + '">' + moment(value).format('DD/MM/YYYY h:mm a') + '</span>';
                             }


             },
           
          
            { data: 'stiches_count', name: 'stiches_count' },
            { data: 'file_price', name: 'file_price', class: 'fstatprice'
                  
             },
            { data: 'vendor_digit_rate', name: 'vendor_digit_rate' , 
                           class: 'vdigit-rate' ,
                  @if (isset($var))
                    @if (in_array('v_emb_rate.hide', $var))
                          width: '0px', 
                                                       
                             "render": function (data, type, full, meta) {
                            return '' ;
                            }
                    @endif
                    @endif   
          },
            { data: 'vendor_digit_price', name: 'vendor_digit_price' ,
                    class: 'vdigit_price',
                    @if (isset($var))
                    @if (in_array('vend-file-price.hide', $var))
                          width: '0px', 
                                                       
                             "render": function (data, type, full, meta) {
                            return '' ;
                            }

                    @endif
                    @endif  

             },
            { data: 'client_contact_1', name: 'client_contact_1' ,
                     "render": function (data, type, full, meta) {
                            return '' ;
                            }
                        },
           
            
            { data: 'client_note', name: 'client_note', orderable: false, searchable: false , defaultContent:'',
                        "render": function (data, type, full, meta) {
                            var re = /<br *\/?>/gi;
                        
                         return '<span class="note" data-toggle="tooltip" title="' + data.replace(re, "\n") + '">' + data.substring(0,10) + '</span>';
                            }

             },
            { data: 'id', name: 'id' , class: 'fooid idRow',  width: '2px', sortOrder: 'desc'},
            { data: 'status', name: 'status' ,   width: '2px', sortOrder: 'desc'},
            { data: 'file_count', name: 'file_count' , class: 'cfilecount',  width: '2px' },
            { data: 'file_price', name: 'file_price' , class: 'fstatprice'
             },
            { data: 'action1', name: 'action1',  class: 'fstat statposition', orderable: false, searchable: false , width: '12px' 
               }
           
            ]
             ,
              pageLength: "25",
              pagination: true,
              responsive: true,
              order: [[ 20, "desc" ]]
           // ,
        //    dom: 'lBfrtip'
       //     ,
       // buttons: [
      //      {
      //          text: 'Normal Sort',
      //          action: function ( e, dt, node, config ) {
                   //alert( 'Button activated'  );
      //              normalrow();
      //      },  
      //         text: 'Group Order-Date',
      //         action: function ( e, dt, node, config ) {
                   // alert( 'Button activated'  );
      //              rowgroup();
      //         }
     //       },  
    //        'copy', 'csv', 'excel', 'pdf'
  //      ]          
   
       
        
    });

   
  
function blinker() {
    //$('.blink_me').fadeOut(1200);
    //$('.blink_me').fadeIn(200);
    $( ".blink_me" ).animate({backgroundColor: "#3B3605"}, 300 );
    $( ".blink_me" ).animate({backgroundColor: "#4B515D"}, 300 );
    
}

function blinker1() {
    //$('.blink_me1').fadeOut(900);
    //$('.blink_me1').fadeIn(200);
    $( ".blink_me1" ).animate({backgroundColor: "#F53535"}, 300 );
    $( ".blink_me1" ).animate({backgroundColor: "#4B515D"}, 300 );
   // $('.blink_me1').animate({ backgroundColor: "#F53535" }, {duration:300});
}

setInterval(blinker1, 300);
setInterval(blinker, 600);

    

  function rowgroup(){ 
    
        $("#invoices-table").dataTable().rowGrouping({iGroupingColumnIndex:1,sGroupingColumnSortDirection: 'desc'});
   // Order by the grouping
    //$('#invoices-table tbody').on( 'click', 'td.group', function (e) {
        //e.preventDefault();
        //alert('right click');
        // var currentOrder = table.order()[0];
        // alert(currentOrder[0]);
        //  alert(currentOrder[1]);
        // if ( currentOrder[0] === 0 && currentOrder[1] === 'asc' ) {
        //     table.order( [[ 0, 'desc' ]] ).draw( false );
        // }
        // else {
        //     table.order( [[ 0, 'asc' ]] ).draw( false );
        // }
    //} );


   } 

  
   var table = $('#invoices-table').DataTable();
   // Handle click on "Select all" control
 var table = $('#invoices-table').DataTable();
 
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
         $('#invoices-table tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#invoices-table tbody input[type="checkbox"]:checked').trigger('click');
      }




      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

     // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
  
// new code for select all checkbox
   // table
   //  .column( 12 )
   //  .data()
   //  .each( function ( value, index ) {
   //      console.log( 'Data in index: '+index+' is: '+value );
   //  } );

   $('#invoices-table tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');
      //alert('child input checkbox clicked');
      var tot = $($row).find('td.fstatprice').text();
      alert(tot);
      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         //var tot = $($row).find('td.fstatprice').text();
         var tot1 = parseFloat(tot);
         //alert(tot1);
         rows_selected.push(rowId);
         rows_selected_total.push(tot1);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
         rows_selected_total.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      //var key = $(this).closest('tr').find('td.fooid').text();
      //alert(key);
       var tot2 = 0 ;
      
         $('#invoices-table tbody input[type="checkbox"]').each(function () {
             if(this.checked){
                var tot3 = $(this).closest('tr').find('td.fstatprice').text();
                //alert('checked' + key);
                   tot2 = parseFloat(tot3) + parseFloat(tot2);
                   tot2 =  tot2.toFixed(2);         
                   //alert('tot3 : '+tot2);
                   //tot2 =  parseFloat(tot2) +  tot3.toFixed(2);
                   //alert('tot2'+ tot2);
                 }
 
            });
        
       // alert('total' + tot2);
       $(".topay").text('Total to Pay: ' + tot2);
      
      //updateTotal(rows_selected_total);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });


function updateTotal(rows_selected_total) {

 // $.each(rows_selected, function(index, rowId){
 //           var key = $(this).closest('tr').find('td.fooid').text();
 //           alert(key);
 //      });
 var tot2 = 0;
 var tmp = rows_selected_total.toString();
 alert(tmp);

$.each(rows_selected_total, function(index, tot1){
         // Create a hidden element
        var tmp = tot1.toString();
        //alert(tmp);
        //var tot2 = tot2 + tot1.toFixed(2) ;
         //alert('total' + tot2);
      });

 //alert(tot2);

 var sum=0;
 if (rows_selected_total.length)
{
    sum = rows_selected_total.reduce(function(a, b) { return a.toFixed(2) + b.toFixed(2); });
   
}
   var  sum1 =  sum.toFixed(2);
  //alert(sum1);

}


   // table.columns( '.fstatprice' ).every( function ()   
   //   {
   //        var sum = this.data().reduce( function (a,b) {
   //                      return a + b;
   //                  }, 0 );

   //     $( this.footer() ).html( 'Sum: '+ sum );
   //   });

    

   $("#invoices-table .fhead").on("click", "th.select-checkbox", function() {
           //  alert('hello');
           var cells = [];
        var rows = $("#invoices-table").dataTable().fnGetNodes();
        for(var i=0;i<rows.length;i++)
        {
            // Get HTML of 3rd column (for example)
            cells.push($(rows[i]).find("td:eq(2)").html()); 
        }
        console.log(cells);
       // alert(cells);

    if ($("th.select-checkbox").hasClass("selected")) {
        table.rows().deselect();
        $("th.select-checkbox").removeClass("selected");
    } else {
        table.rows().select();
        $("th.select-checkbox").addClass("selected");
    }
}).on("select deselect", function() {
    ("Some selection or deselection going on")
    if (table.rows({
            selected: true
        }).count() !== table.rows().count()) {
        $("th.select-checkbox").removeClass("selected");
    } else {
        $("th.select-checkbox").addClass("selected");
    }
});

// $("#selectAll").toggle(function () { 
//        $("checkboxSelector", dataTable.fnGetNodes()).attr("checked", true); }
//      , function () { 
//          $("checkboxSelector", dataTable.fnGetNodes()).attr("checked", false); 
//      }
//  );


//   $(document).on( 'init.dt.dth', function (e, settings, json) {
//       var table = new $.fn.dataTable.Api( settings );
//       var body = $( table.table().body() );

//        $.fn.dataTable.defaults.searchHighlight 
 
//     if (
//         $( table.table().node() ).hasClass( 'searchHighlight' ) || // table has class
//         settings.oInit.searchHighlight                          || // option specified
//         $.fn.dataTable.defaults.searchHighlight                    // default set
//     ) {
//        console.log("ok");
//     }
// });
  // code added for search highlight on 11/03/17

 //code added on reality on 20-06-17
 // Apply the search
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );



 //code added  above on reality on 20-06-17



  $('#invoices-table tbody').on( 'click', 'tr', function () {
        //alert('hello selected');
        var $rowid = table.row( this ).index() ;
        var currentPageIndex = table.page.info().page;
       //alert ($rowid);
        var key = $(this).closest('tr').find('td.fooid').text();
        if ( $(this).hasClass('selected') ) {
           //  $(this).removeClass('selected');  removed on 28/08/17 for multiple selection
        }
        else {
           // table.$('tr.selected').removeClass('selected');  removed on 28/08/17 for multiple selection
            $(this).addClass('selected');
            $("#orddelete").val(key);
        }
    });

   $('#invoices-table tbody').on( 'dblclick', 'tr', function () {
        //alert('hello selected');
        var $rowid = table.row( this ).index() ;
        var currentPageIndex = table.page.info().page;
       //alert ($rowid);
        var key = $(this).closest('tr').find('td.fooid').text();
        if ( $(this).hasClass('selected') ) {
             $(this).removeClass('selected'); 
        }
        else {
            table.$('tr.selected').removeClass('selected'); 
            $(this).addClass('selected');
            $("#orddelete").val(key);
        }
    });


 


function normalrow() {
    var oSettings = jQuery('#invoices-table').dataTable().fnSettings();

    for (f = 0; f < oSettings.aoDrawCallback.length; f++) {
        if (oSettings.aoDrawCallback[f].sName == 'fnRowGrouping') {
            oSettings.aoDrawCallback.splice(f, 1);
            break;
        }
    }

    oSettings.aaSortingFixed = null;
  

   }
  
  $('#invoices-table').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
  });

   
	

    
    if (!$(this).hasClass('group'))
       // alert('false click');
    {
    table.MakeCellsEditable({
        "onUpdate": myCallbackFunction,
        "inputCss":'my-input-class',
        "columns": [6,7,8,10,14,15] ,
        
        "confirmationButton": { 
            "confirmCss": 'my-confirm-class',
            "cancelCss": 'my-cancel-class'
        },
        "inputTypes": [
            {
                "column": 10,
                "type": "list",
                "options":[
                    { "value": "Normal", "display": "Normal" },
                    { "value": "Rush", "display": "Rush" },
                    { "value": "SuperRush", "display": "SuperRush" },
                    
                ]
        
            },
            {
                "column": 7,
                "type": "list",
                "options":[
                    { "value": "Vector", "display": "Vector" },
                    { "value": "Digitizing", "display": "Digitizing" }
                    
                ]
        
            },
            {
                "column": 8,
                "type": "text"
        
            },
            
            {
                "column": 14,
                "type": "text"
        
            },
            {
                "column": 15,
                "type": "text"
        
            },
            {
                "column": 6,
                 "type": "list",
                "options":[
                    { "value": "", "display": "" },
                    { "value": "VENDORY", "display": "VENDORY" },
                    { "value": "VENDORP", "display": "VENDORP" },
                    { "value": "VENDOR3", "display": "VENDOR3" },
                     { "value": "VENDOR4", "display": "VENDOR4" }
                    
                ]
        
            }            

            ]
        
        
    });
    }
   

    function myCallbackFunction (updatedCell, updatedRow, oldValue,id1, columnIndex) 
    {
    		console.log("The new value for the cell is: " + updatedCell.data());
   			console.log("The old value for that cell was: " + oldValue);
    		console.log("The values for each cell in that row are: " + updatedRow.data());
              
        //var id1 = $(this).closest('tr').find('td:eq(0)').text();
        //alert(id1);
       //alert(updatedRow.html());
      
            //alert(columnIndex);
        var table = $('#invoices-table').DataTable();
        var currentPageIndex = table.page.info().page;

        //table.$('tr').closest('tr').addClass('selected');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }); 


        if (columnIndex === 10) {

            @if (isset($var))
            @if (in_array('priority.modify', $var))
            var document_type = updatedCell.data();
            //alert(id1);
            
            
            var ord_date_time = $(this).closest('tr').find('td.ord_dt_tm').val();
            //var _token = form.find('input[name=_token]').val();                        
         
            var formData = {
                            id:  id1, 
                            document_type: document_type,
                            ord_date_time: ord_date_time
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                              var res = result[0].msg ;
                            console.log(result[0].msg) ; 
                            //alert('hello');
                           
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                             table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();
                            }
                        });
                       // table.ajax.reload();
                @else 
                   alert("You don't have permission to Update Priority");
                   return false;
                @endif
                @endif
              //  table.ajax.reload();
                        
        }

        if (columnIndex === 14) {
            var stitchvalue = updatedCell.data();
            //alert(stitchvalue);
            //alert(id1);
            //var _token = form.find('input[name=_token]').val();                        
         
            var formData = {
                            id:  id1, 
                            stitchvalue: stitchvalue
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                           // table.ajax.reload(); 
                            alert("updated");
                           table.page(currentPageIndex).draw(false);
                             table.row( $rowid ).scrollTo();
        
                            }
                        });
                     //   table.ajax.reload();  
        }

        

         if (columnIndex === 15) {
            var filepricevalue = updatedCell.data();
            //alert(filepricevalue);
            //var _token = form.find('input[name=_token]').val();                        
         
            var formData = {
                            id:  id1, 
                            filepricevalue: filepricevalue
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                             table.page(currentPageIndex).draw(false);
                                  table.row( $rowid ).scrollTo();
                            }
                        });
                       // table.ajax.reload();  
        }

   //     if (columnIndex === 15) {
    //        var vend_embr_price = updatedCell.data();
          
    //        var formData = {
    //                        id:  id1, 
    //                        vend_embr_price: vend_embr_price
     //                   }
                            
     //                   $.ajax({
     //                       type:"POST",
     //                       async: true,
     //                       datatype:"JSON",
      //                      url:"orders/updateordermisc",
     //                       data: formData,
     //                       success: function(result)
     //                      { 
     //                       console.log(result[0].msg) ; 
          
     //                      }
    //                    });
    //                    table.ajax.reload();  
    //    }


    //    if (columnIndex === 16) {
    //        var vend_file_price = updatedCell.data();
    //        var formData = {
    //                        id:  id1, 
    //                        vend_file_price: vend_file_price
              
    //                   }
                            
    //                    $.ajax({
    //                        type:"POST",
    //                        async: true,
    //                        datatype:"JSON",
    //                        url:"orders/updateordermisc",
    //                        data: formData,
    //                        success: function(result)
    //                        { 
    //                        console.log(result[0].msg) ; 
    //                          table.ajax.reload();
    //                        }
    //                    });
    //                   table.ajax.reload();  
    //   }

        if ( columnIndex === 6 )  {
            //alert('id return is ' + id1);
            
            @if (isset($var))
              @if (!in_array('vend-file-price.modify', $var))
                   alert("No Permission to modify vendor");
                   return false;
              @endif
            @endif

            var vendor = updatedCell.data();
            //alert(filetype || 'is ok');

            var formData = {
                            id:  id1, 
                            vendor1: vendor
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                              //table.ajax.reload();
                              table.page(currentPageIndex).draw(false);
                               table.row( $rowid ).scrollTo();
                            }
                        });
              table.row( $rowid ).scrollTo();          
           //table.ajax.reload(); 
        }


        if (columnIndex === 8) {
            var filevalue = updatedCell.data();
            //alert(filevalue+id1);
            //alert(id1);
            //var _token = form.find('input[name=_token]').val();                        
         
            var formData = {
                            id:  id1, 
                            filevalue: filevalue
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                              table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();
                            }
                        });
                         table.row( $rowid ).scrollTo();    
                        //table.ajax.reload(); 
        	}
        
        if ( columnIndex === 7 )  {
            //alert('id return is ' + id1);
            var filetype = updatedCell.data();
            //alert(filetype || 'is ok');

            var formData = {
                            id:  id1, 
                            filetype1: filetype
                            //_token: _token
                        }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                              //table.ajax.reload();
                              table.page(currentPageIndex).draw(false);
                               table.row( $rowid ).scrollTo();
                            }
                        });
            //  table.row( $rowid ).scrollTo();          
           //table.ajax.reload(); 
        }


    }
    
    
$('#invoices-table tbody').on('dblclick', 'td', function () {
        
         //var id1 = $(this).closest('tr');
         //  alert(id1.html());
     // debugger;
        var table = $('#invoices-table').DataTable();
       // table.$('tr.selected').removeClass('selected');

        //table.$('tr').addClass('selected');
       // $(this).closest('tr').addClass('selected');
       
     
      //alert(table.cell( this ).index().columnVisible);
      //var key = $(this).closest('tr').find('td:eq(20)').text();
      var key = $(this).closest('tr').find('td.fooid').text();
      //alert(key);

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
              });  
                     

    //  if (table.cell( this ).index().columnVisible ==8 ){
  if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'File Note') {
             // alert( table.cell( this ).data() );

            var target  = $(this);
            var oldnotes = table.cell( this ).data();
            var re = /<br *\/?>/gi;
            var oldnotes1 = oldnotes.replace(re,"\n");
            var currentPageIndex = table.page.info().page;
           
            //alert($rowid);
            @if (isset($var))
              @if (!in_array('file-note.modify', $var))
              //     alert("No Permission to modify file notes");
              //     return false;
              @endif
            @endif
                
             //alert(oldnotes);
            $( "#notedialog" ).dialog({
               
     				title : "Enter Notes This field is required",
      			resizable: true,
       			modal: true,
			  		autoOpen:false,
        		closeButton:true,
			      show: 'fold',
    				hide: 'fold',
    				width: 500,
				  	height:400,
            center: true,
            position: {
                       my: "left",
                       at: "right",
                       of: target
                              },


					  buttons: [
								{
   
   						text: "Submit",
    					title: "Submit",
              id: 'notes',
              tabindex: '3',
    					// form: "client_form_submit",
    					click: function() {
	 
     					var oldnotes = $('#notedialog .oldnotes').val();
        		  var newnotes = $('#notedialog .newnotes').val();
        			var _token   = $("#notedialog .token").val();
                       

                        // alert( oldnotes + newnotes+ _token);

        	    var formData = {
                            id:  key, 
                            oldnotes: oldnotes,
                            newnotes: newnotes,
                            _token: _token
                        }
                            
		           //alert(dataString);
                $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updatenotes",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             //$( "#notedialog .success" ).html("Data Updated Successfully");  
                             $('#notedialog .newnotes').val("");
                              
                              table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();
                                // table.ajax.reload();

                            }
                        });

                     setTimeout(function(){
                               $('#notedialog').dialog('close');                
                                }, 300); 
                               // table.ajax.reload();
                              //table.page(currentPageIndex).draw(false);
                              //table.row( $rowid ).scrollTo();
                               
        		              //return false ;

					    },
 
		
				      },
			
			      	],

					close : function() {
		
			
					},
					open: function(event, ui) {
		     		var dialog = $(event.target).parents(".ui-dialog.ui-widget");
   					var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
		    
		     		var AddButton = buttons[0];
		    
		     		$(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
		     		$(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#notedialog .newnotes").focus();
           
			      //$(this).find('.ui-dialog-titlebar-close').blur();
           
		    
   					},

                });

                $( "#notedialog" ).dialog("open");
                $( "#oldnotes" ).text( oldnotes1 );
                // alert(id1);
                $( "#notedialog .noteid" ).val( key );
                // table.ajax.reload(); 
	       }

    // if(table.cell( this ).index().columnVisible == 12) {
   //   alert($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim()); changed on 21/06/17 
            // as logic changed

if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'Allocation') {
      //alert(table.cell( this ).index().name);
             //alert("Do you want to change allocation");
            // return false;
            if (($(this).closest('tr').has('td.donothing').length) > 0 ) { 
                  alert("No Rights to Modify Allocation, Contact Admin");
                  return false;

            }

            var table = $('#invoices-table').DataTable();
            var target = $(this);
            var currentPageIndex = table.page.info().page;

            //var id1 = $(this).closest('tr').find('td:eq(20)').text(); not working on column hide - column no changes
            var id1 = $(this).closest('tr').find('td.fooid').text();
            //alert(id1);
            var alloc = $(this).closest('tr').find('td.editalloc').text();
            //alert(alloc);
            //$('#dropDownId').val('harish');
            

            $( "#allocdialog" ).dialog({
               
                    title : "Change Allocation",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 200,
                    height: 250,
                     position: {
                       my: "left",
                       at: "right",
                       of: target
                              },

                    
                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'allocs',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var newalloc = $('#dropDownId').val();
                        var _token   = $("#allocdialog .token").val();
                        var selText1 = "";
                        $("#allocdialog .allocname").val("");
                        $("#allocdialog select.fooalloc option:selected").each(function () {
                               var $this = $(this);
                                if ($this.length) {
                                    var selText = $this.text();
                                    console.log(selText);
                                    //$('#allocdialog .allocname').append(selText+', ');
                                    //$('#allocdialog .allocname').val(selText+', ');
                                      var input = $("#allocdialog .allocname");
                                      input.val(input.val() + selText+', ');
                                  }
                        });
                        
                        //alert($("#allocdialog .allocname").val());
                        var newallocnm = $("#allocdialog .allocname").val();

                         //alert( newalloc + _token);

                        var formData = {
                            id:  id1, 
                            newalloc: newalloc,
                            newallocnm: newallocnm,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updatealloc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                            // $( "#allocdialog .success" ).html("Data Updated Successfully");  
                             var res = result[0].msg ;
                            $(".delmsg").html(res).fadeOut('slow');
                            if (result[0].status == 'Error')
                            {
                               alert(result[0].msg);
                            }
                             //$('.dataTable').each(function() {
                                 // dt = $(this).dataTable();
                                 // dt.fnDraw();
                                  // table.draw( false );
                              //});
                              table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();

                            }
                        });

                     setTimeout(function(){
                               $('#allocdialog').dialog('close');                
                                }, 300); 

                               
                   
                            //return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
            
            
                    },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                    $('#dropDownId').val(alloc.split(','));
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
                   
                   
            
                    },

                });

           
             $( "#allocdialog" ).dialog("open");
             //table.ajax.reload(); 
         }



  // if (table.cell( this ).index().columnVisible == 21 ) {
//file count edit

if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'File Count') {             
    
    var target = $(this);
    var file_count = $(this).closest('tr').find('td.cfilecount').text();
    var key = $(this).closest('tr').find('td.fooid').text();
    var table = $('#invoices-table').DataTable();
    var currentPageIndex = table.page.info().page;

    @if (isset($var))
        @if (!in_array('file-count.modify', $var))
               alert("No Permission to modify file count");
               return false;
        @endif
    @endif

    $( "#filecountdialog" ).dialog({
               
                    title : "Change File Count[Click on Time to Exit]",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 200,
                    height:200,
                     position: {
                       my: "left",
                       at: "right",
                       of: target
                              },


                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'filecount',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var newfilecount = $('.fcountval').val();
                        //alert(newfilecount);
                        var _token   = $("#filecountdialog .token").val();
                        var table = $('#invoices-table').DataTable();

                         //alert( newalloc + _token);

                        var formData = {
                            id:  key, 
                            newfilecount: newfilecount,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updatefilecount",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             //$( "#filecountdialog .success" ).html("Data Updated Successfully");  
                              alert("File Count updated successfully");
                              //table.ajax.reload();
                               //$('#invoices-table').DataTable().ajax.reload(); tried on 21/08/17 for reload 
                              table.page(currentPageIndex).draw(false);
                              //table.api().ajax.reload(null, false);
                              table.row( $rowid ).scrollTo();

                            }

                        });
                     
                      
                     setTimeout(function(){
                               $('#filecountdialog').dialog('close');                
                                }, 20); 
                     

                         
    
                   
                    //return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
            
            
                    },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                    $('.fcountval').val(file_count);
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
             
            
                    },

                });

             $( "#filecountdialog" ).dialog("open");     
             //var table = $('#invoices-table').DataTable();
                            
                            

          }


//file count edit


 //if (table.cell( this ).index().columnVisible == 10 ){
if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'Order Date & Time') {             
    
    var target = $(this);
    var ord_dt = $(this).closest('tr').find('td.ord_dt_tm').text();
    var key = $(this).closest('tr').find('td.fooid').text();
    var table = $('#invoices-table').DataTable();
    var currentPageIndex = table.page.info().page;

    alert("No Permission"); // added on 17/10/17 for data consistency
    return false;

    @if (isset($var))
        @if (!in_array('order-date.modify', $var))
               alert("No Permission");
               return false;
        @endif
    @endif

    $( "#orderdatedialog" ).dialog({
               
                    title : "Change Order Date[Click on Time to Exit]",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 400,
                    height:300,
                     position: {
                       my: "left",
                       at: "right",
                       of: target
                              },


                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'orddt',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var neworderdt = $('#order_date').val();
                        //alert(neworderdt);
                        var _token   = $("#orderdatedialog .token").val();
                       

                         //alert( newalloc + _token);

                        var formData = {
                            id:  key, 
                            neworderdt: neworderdt,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateorderdt",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             $( "#orderdatedialog .success" ).html("Data Updated Successfully");  
                              
                              table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();

                            }
                        });
                     
                         
                     setTimeout(function(){
                               $('#orderdatedialog').dialog('close');                
                                }, 300); 
                    // table.ajax.reload();

                         
    
                   
                    //return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
            
            
                    },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                    $('#order_date').val(ord_dt);
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
             
            
                    },

                });


             $( "#orderdatedialog" ).dialog("open");     

          }
    
//if (table.cell( this ).index().columnVisible == 11 ){
if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'Order Comp.Date')  {   
   // alert('hi ok');
    var target = $(this);
    var ord_comp_dt = $(this).closest('tr').find('td.ord-comp-dt-tm').text();
    var key = $(this).closest('tr').find('td.fooid').text();
   
    var table = $('#invoices-table').DataTable();
    var currentPageIndex = table.page.info().page;

    alert("No Permission"); // added on 17/10/17 for data consistency
    return false;

    @if (isset($var))
        @if (!in_array('order-completion-date.modify', $var))
               alert("No Permission");
                return false;
        @endif
    @endif

    $( "#ordercompdatedialog" ).dialog({
               
                    title : "Change Order Comp Date[Click on Time to Exit]",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 400,
                    height:200,
                    position: {
                       my: "left",
                       at: "right",
                       of: target
                              },


                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'corddt',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var neworderdt = $('#ord_comp_date').val();
                        var _token   = $("#orderdatedialog .token").val();
                       

                         //alert( newalloc + _token);

                        var formData = {
                            id:  key, 
                            neworderdt: neworderdt,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordercompdt",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             $( "#ordercompdatedialog .success" ).html("Data Updated Successfully");  
                               //table.ajax.reload();
                                table.page(currentPageIndex).draw(false);
                                table.row( $rowid ).scrollTo();

                            }
                        });
                        // table.ajax.reload();  
                     setTimeout(function(){
                               $('#ordercompdatedialog').dialog('close');                
                                }, 30); 

                             
                   
                    //return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
            
            
                    },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                    $('#ord_comp_date').val(ord_comp_dt);
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
             
            
                    },

                });


             $( "#ordercompdatedialog" ).dialog("open");     

   }


if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'V.Emb.Rate') {
     
            var table = $('#invoices-table').DataTable();
            var target = $(this);


            //var id1 = $(this).closest('tr').find('td:eq(20)').text(); not working on column hide - column no changes
            var id1 = $(this).closest('tr').find('td.fooid').text();
           // alert(id1);
            var vrate = $(this).closest('tr').find('td.vdigit-rate').text();
            var currentPageIndex = table.page.info().page;
           // alert(vrate);
            //$('#dropDownId').val('harish');
            

            $( "#embratedialog" ).dialog({
               
                    title : "Vendor Embroidery Rate",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 200,
                    height: 150,
                     position: {
                       my: "left",
                       at: "left",
                       of: target
                              },

                    
                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'allocs',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var vend_embr_price = $('#embratedialog #vendor_digit_rate').val();
                        var _token   = $("#embratedialog .token").val();
                       

                         //alert( newalloc + _token);

                        var formData = {
                            id:  id1, 
                            vend_embr_price: vend_embr_price,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateordermisc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                            // $( "#embratedialog .success" ).html("Data Updated Successfully");  
                             //$('.dataTable').each(function() {
                                 // dt = $(this).dataTable();
                                 // dt.fnDraw();
                                  // table.draw( false );
                              //});
                               table.page(currentPageIndex).draw(false);
                               table.row( $rowid ).scrollTo();

                            }
                        });

                     setTimeout(function(){
                               $('#embratedialog').dialog('close');                
                                }, 300); 

     
                     },
 
        
                },
            
                ],


                  close : function() {
            
            
                  },
                  open: function(event, ui) {
                        
                  $('#embratedialog #vendor_digit_rate').val(vrate);   
                  var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                  var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                  var AddButton = buttons[0];
            
                  $(AddButton).addClass("btn btn-small btn-primary");
                  $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
                   
                  },

                });

           
             $( "#embratedialog" ).dialog("open");
             //table.ajax.reload(); 
         }



if ($('#invoices-table thead tr.secondrow th').eq($(this).index()).text().trim() == 'V.File Price') {
     
    var table = $('#invoices-table').DataTable();
    var target = $(this);
    var currentPageIndex = table.page.info().page;

    var id1 = $(this).closest('tr').find('td.fooid').text();
    var vrate = $(this).closest('tr').find('td.vdigit_price').text();
    //alert(vrate);
  
    $( "#embratedialog" ).dialog({
            title : "Vendor File Price",
            resizable: false,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'fold',
            hide: 'fold',
            width: 200,
            height: 150,
            position: {
                  my: "left",
                  at: "left",
                  of: target
                    },

            buttons: [
                   {
                  text: "Submit",
                  title: "Submit",
                  id: 'allocs',
                  click: function() {
     
                  var vend_file_price = $('#embratedialog #vendor_digit_rate').val();
                  var _token   = $("#embratedialog .token").val();

                  var formData = {
                            id:  id1, 
                            vend_file_price: vend_file_price,
                            _token: _token
                        }

                  $.ajax({
                      type:"POST",
                      async: true,
                      datatype:"JSON",
                      url:"orders/updateordermisc",
                      data: formData,
                      success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                                  // table.draw( false );
                                table.page(currentPageIndex).draw(false);
                                table.row( $rowid ).scrollTo();
                            }
                      });

                setTimeout(function(){
                               $('#embratedialog').dialog('close');                
                                }, 300); 
     
                     },
        
                },
            
                ],
                close : function() {
                },
                open: function(event, ui) {
                        
                $('#embratedialog #vendor_digit_rate').val(vrate);   
                var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                var AddButton = buttons[0];
            
                $(AddButton).addClass("btn btn-small btn-primary");
                $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
                   
                },
      });

      $( "#embratedialog" ).dialog("open");
           //  table.ajax.reload(); 
  }

   
 
 
});
     

   


$(document).ready(function(){
  // debugger;
  
  
    // $('#invoices-table').DataTable( {
    //      searchHighlight: true
    //  } );

   
    $("Form").validate();

    $("#orderadd").validate({
       rules: {
         file_name: "required"
       },
       messages: {
        file_name: "File Name is required"
       },

        onfocusout: function(element) {
            this.element(element);
        },


        submitHandler: function(form) {
            form.submit();
        }


    });

    $("#orderedit").validate({
       rules: {
         file_name: "required"
       },
       messages: {
        file_name: "File Name is required"
       },

        onfocusout: function(element) {
            this.element(element);
        },


        submitHandler: function(form) {
            form.submit();
        }


    });


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

     

  var inputs1 = $('input, select, textarea').keydown(function (e) {
     
    // alert(e.which);

    if (e.which == 9 || e.which == 13) {
        //alert($(this).html());
        //e.preventDefault();

        //var nextInput = inputs1.get(inputs1.index(this) + 1);
        var nextInput = inputs1.get(inputs1.index(this) );
        //$(this).next('input,textarea').focus();
       // if (nextInput) {
       //     nextInput.focus();
       //     }
        }
    });

    // very important script for trapping key over
 
  
  $("#statusdialog #status").keydown(function(){
                          // alert("changed");  
                       // alert($(this).html());
             // debugger;
              //$(this).closest( ".ui-dialog" ).find(":button").addClass("ui-state-focus");
              //   $(this).closest( ".ui-dialog" ).find(".fmy").addClass("ui-state-focus");
              //   $(this).closest( ".ui-dialog" ).find(".fmy").removeClass("btn-primary");
            //  $("#statusdialog .ui-dialog").find(":button").addClass("blink_me");
             
              //$(".ui-dialog .fmy").css("background", "#584a47");

              //$(".ui-dialog .fmy").addClass("blink_me"); 
              //above jquery was tested successfully on 08/02/17
              $(".ui-dialog .fmy").blur();
              $(".ui-dialog .fmy").focus();
              
    });


    var previous;

   
  $(".fbody").on("change", ".checkclick", function(e){
      //alert('hello');
        var id1 =  this.value ;
        //alert(id1);
        var table = $('#invoices-table').DataTable();
        $(".fbody").find("tr").each(function(){
          var testid = $(this).find("td.fooid").text();
           //alert(testid);
           if (id1 == testid) {
                //$(this).addClass('selected').siblings().removeClass('selected'); 
                $(this).removeClass('selected'); 
                $(this).addClass("selected");
            }
        });
           

    

    //    $(".fbody").find("tr").each(function(){

    //    if ( $(this).hasClass('selected') ) { 
    //         var testid = $(this).find("td.fooid").text();
    //         alert(testid);
    //     }
       
    // });


  });

    // added on 07/10/17
  $('#dtltable #selectAll').click(function (e) {
           $(this).closest('table').find('td input.chkidctl').prop('checked', this.checked);
  });

    // added on 07/10/17
   // added on 22/09/17
   //$(document).on("change", "#dtltable select.childstatus", function(e){  

   


   // added on 22/09/17 above

   // added on  06/10/17 for editdtl view multiple status assign

  //$(document).on("change", "#dtltable select.childstatus", function(e){  

    $(document).on("focusin", "#editdtlmodalwindow select.feditstatus", function(e){  
   
            // Store the current value on focus and on change
           // alert("hello childstatus");
        previous = this.value;
       // alert(previous);
    }).on("change", "#editdtlmodalwindow select.feditstatus", function() {    
        // Do something with the previous value after the change
        var status2 = $(this).val();
        var  newst = $(this);
        //alert($(newst).val());
        
        @if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 2)
        
            if (status2 !== 'QC Pending') {
                alert('Only QC Pending allowed for Designer');
                return false;
                e.stopPropagation();
            }
        @endif
        //var childid = $(this).closest('tr').find('.ochildid').val();
        var currentPageIndex = table.page.info().page;
        var result = new Array();

        var result = $.map($('#dtltable input.chkidctl:checked'), function(c){return c.value; })
         //alert(result);

        var formData = {
                        childid:  result, 
                        status2: status2
                            //_token: _token
                      
                        }
                           
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/orderdtlstatusf') }}",
                            data: formData,
                            success: function(result)
                            { 
                              res = result[0].msg ;
                              console.log(result);
                              oldstatus = result[0].status;
                             // alert(oldstatus);
                              if (res == "Updated successfully") {
                                  console.log(result[0].msg) ; 
                                  $("#editdtlmodalwindow").modal('hide');
                                  $(".delmsg").html("Status Changed Successfully").fadeOut('slow');
                                  table.page(currentPageIndex).draw(false);
                              }
                              else {
                                  alert(res);
                                  //alert($(this).val());
                                  ////$(this).val(previous);
                                  //alert($(newst).val());
                                  $(newst).val(oldstatus);
                                  return false;
                              }
                              //$(".delmsg").html(res).fadeOut('slow');

                               
                            }
                        });
        
    });


   // added above for editdtl view multiple status assign


   // added on 21/09/17
     $(document).on("change", ".allocshow", function(e){   
   
       // alert('clicked');
         if ( $('input[name="allocshow"]').is(':checked') ) {

              $(".finalalloc").show();
              $(".feditdtlstatus").show();
              $(".falloc").focus();
              $(".submitdtl").show();
            }
            else {
              $(".finalalloc").hide();
              $(".feditdtlstatus").hide();
            }

    });

   // added below logic for confusion of submit button on 12/10/17  

   $(document).on("click", ".alert-danger", function(e) {
       $(".alert").fadeOut("slow");
   });

      $(document).on("change", ".statusshow", function(e){   
   
       // alert('clicked');
         if ( $('input[name="statusshow"]').is(':checked') ) {

              $(".finalalloc").hide();
              $(".feditdtlstatus").show();
             
              $(".submitdtl").hide();
            }
            else {
              $(".finalalloc").show();
              $(".feditdtlstatus").hide();
            }

    });

    $(document).on("focusin", "select.falloc", function(e){  
            $(".feditdtlstatus").hide();
    });  

   // added above logic for confusion of submit button on 12/10/17


// below routine for  both updation of text and id in edit program for allocation
    $(document).on("change", "#dtltable select.selectalloc", function(e){    
      // debugger;
      //var alloc =  this.value ;
      //var alloc = $(this).val();
       //  alert(alloc);
        var option_all = ''; 
        var option_all = $(this).closest('tr').find(".selectalloc option:selected").map(function() {     return $(this).text();
              
          }).get().join(',');

      $(this).closest('tr').find('.updatealloc').val(option_all);  

      // allocation validation for not allocated

       var childst = $(this).closest('tr').find('.childstatus').val();
      //alert(childst);

      if ((option_all == 'not allocated')  && (childst == 'QC Pending' || childst == 'QC OK' || childst == 'Alloted' || childst == 'Completed'))
      {
        alert('Please allocate files');
        e.stopPropagation();
        return false;
      }
      else if( (option_all != 'not allocated') && (childst == 'Alloted')) {
             confirm('Do you want to change allocation');

      }


      // allocation validation above


      var result = new Array();

      //$("select.selectalloc").each(function() {
            result.push($(this).val());
      //  });

      var output = result.join(", ");
      //alert(output);
         $(this).closest('tr').find('.updateallocid').val(output);

    });

    // below routine for  both updation of text and id in  edit program for allocationf
    $(document).on("change", "#editdtlmodalwindow .falloc", function(e){    

      //var alloc =  this.value ;
      //var alloc = $(this).val();
       //  alert(alloc);

    var option_all = ''; 
    var option_all = $(this).find("option:selected").map(function() {     return $(this).text();
              
          }).get().join(',');

       // alert(option_all);

         // Blank allocation validation on 04/01/18
      var childst = $(this).closest('tr').find('.feditstatus').val();
      //alert(childst);

      if ((option_all == 'not allocated')  && (childst == 'QC Pending' || childst == 'QC OK' || childst == 'Alloted' || childst == 'Completed'))
      {
        alert('Please allocate files');
        e.stopPropagation();
        return false;
      }

      // Blank allocation validation on 04/01/18
 

      $("#editdtlmodalwindow .fupdateallocid").val(option_all);  

      //var result = new Array();

      //$("select.selectalloc").each(function() {
         //   result.push($(this).val());
      //  });

      //var output = result.join(", ");
      //alert(output);
       //  $(this).closest('tr').find('.updateallocid').val(output);

    });



   // added on 21/09/17 above


    
    // $("#notedialog .newnotes").keydown(function(){
          
              //$(".ui-dialog #notes").addClass("blink_me"); 
              //above jquery was tested successfully on 08/02/17
            //  alert("new notes changed");
             // $(".ui-dialog #notes").blur();
             // $(".ui-dialog #notes").focus();
              
    //});

    $(".clearsession").click(function(event) {
        
      //event.preventDefault ; removed on 20/10/17 as some users have problem in clear search
      var table = $('#invoices-table').DataTable();
      table.state.clear();
      window.location.reload();

    });

    $(".ocreate").click(function(e){
          e.preventDefault ;
    // alert("modal clicked"); 
       
            

    $("#OrderCreateModal").modal({
        show: true,
        speed: 250,
        transition: 'slideUp',
        // transitionClose: 'slideBack',
        autofocus: 'input'
           
      });
    
   

    $('#OrderCreateModal').on('shown.bs.modal', function () {
        //alert("Modal Open");
        
        $("#OrderCreateModal .addclientinput").focus();
    });
        
   
            //$('input[type=text]').each(function(){
            //      $(this).val('');
            //  });
       
        
            

    });

    
    
    $("#order_date_time").datetimepicker();
    $("#order_us_date").datetimepicker();
    $("#order_date").datetimepicker();
    $("#ord_comp_date").datetimepicker();
    $("#order_us_dt").datetimepicker();
    $('#modal-update #order_date_time').datetimepicker(); 
    $('#modal-update #order_us_date').datetimepicker(); 
    //$("Form").validate();


    $('.expand').css({ height: '28px' });
     
   
    $('.expand').focusin(function() {
        $( this ).css({ height: '48px' })
    });

    $('.expand').focusout(function() {
        $( this ).css({ height: '28px' })
    });


    $(".submitbutton").hover(function() {
        $(this).css('background', '#33f9ff');
        $(this).css('cursor','pointer').attr('title', 'Double Click to Save');
    }, function() {
        $(this).css('background', 'grey');
        $(this).css('cursor','auto');
    });
     
    $(".submitbutton").dblclick(function (e) {
        // e.preventDefault();
       // alert("hello");
       
        //debugger;
       
        var form = $(this).parents('form:first');
        var formid = $(this).parents('form:first').attr('id');
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var formid1 =  "#" + formid + ' input' ;

        // validation routine start
       
        
        var table = $('#invoices-table').DataTable();
        var dataentryerror = 0 ;
       // alert(formid);

      var valid = true ;
     
      $(formid1).each(function(){
          //debugger;
      // $("#orderadd input").each(function() {
          //alert("checking..");
          if($(this).hasClass('required') == true){
          var inputVal = $(this).val();
          //alert(inputVal);
          var $parentTag = $(this).parent();
          //if(inputVal == ''){
          if($.trim(inputVal).length == 0){
              //alert("problem");
              $parentTag.addClass('error').append('<span class="error">Required field</span>');
              var dataentryerror = 1 ;
              //alert('loop' + dataentryerror);
               return valid=false ;
          }
        }

      });

     // alert(valid);
     
      //  alert('outerloop' + dataentryerror);

       //var aaa = $( "formid #dropDownId1 option:selected" ).text();
       var editallocid = "#" + formid + ' #dropDownId1 option:selected' ;
       var aaa = $( editallocid ).text();
       
       //alert(aaa); Removed below code on 02/05/17 on inital testing  as per kulind sir instruction as digitizing does not require allocation
       // if($.trim(aaa).length <=0 ) { 
       //       alert('Select allocation'); 
       //      var $parentTag = $("#dropDownId1").parent();
           
       //      $parentTag.addClass('error').append('<span class="error">Required field</span>');
       //      valid = false  ;
       // }

        // validation routine completes


if(valid) {
       
     
        if (formid=="orderadd") {
           
            
            //alert(formid);
            
          }

        var method = '';
        if (form.has('input[name=_method]')) {
            method = form.find('input[name=_method]').val();
            console.log(method);
        } 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        if(method != 'PATCH') {
            console.log("Post method detected, going to run this part of the script");
           // $(this).html("<i class='fa fa-spinner fa-spin'></i>&nbsp;Wait!").attr('disabled', true);
            e.preventDefault();
            //var formdata = $('#contactusform').serializeArray();
            var _token = form.find('input[name=_token]').val();
       
            e.preventDefault(); 
         
        var client_creation_id = form.find('input[name=client_creation_id]').val();
        var client_name = form.find('input[name=client_name1]').val();

        var client_email_primary = form.find('input[name=client_email_primary]').val();
        var client_company = form.find('input[name=client_company]').val();
        var company_id = form.find('input[name=company_id]').val();
        //var file_type = form.find('input[name=file_type]').val();
        var file_type = form.find('.ftype').val();
        var note = form.find('input[name=note]').val();
        var note = $('#OrderCreateModal #note').val();
        var client_note = $('#OrderCreateModal #client_note').val();
        var vendor    = $('#OrderCreateModal .vend').val();
        //alert(vendor);
        var file_name = form.find('input[name=file_name]').val();
        var file_count = form.find('input[name=file_count]').val();
        var digit_rate = form.find('input[name=digit_rate]').val();
        var file_price = form.find('input[name=file_price]').val();
        var stiches_count = form.find('input[name=stiches_count]').val();
        var vendor_digit_price = form.find('input[name=vendor_digit_price]').val();
        var vendor_digit_rate = form.find('input[name=vendor_digit_rate]').val();
        var order_date_time = form.find('input[name=order_date_time]').val();
        var order_us_date = form.find('input[name=order_us_date]').val();
        var allocation = $('#OrderCreateModal #dropDownId1').val();
        var document_type = form.find('.dtype').val();
       
         //alert(note);
        //alert(client_note);
        //var allocation = form.find('input[name=allocation[]]').val();
        var status = $('#OrderCreateModal #status').val();
        if(status == 'Completed' || status == 'QC OK' || status == "QC Pending") {
           alert('Status Should be QUOTE or Approved');
           //e.stopPropagation();
        }
        
        myList = [];
            $.each($(".foo option:selected"), function(){ 
                //alert($(this).val());
                myList.push($(this).val())
            });  

        var _token = form.find('input[name=_token]').val();

        //var url = '/laravel/public/orders';
        var url = 'orders';

        var formData = {
            client_creation_id: client_creation_id,
            client_name: client_name,
            client_email_primary: client_email_primary,
            client_company: client_company,
            note: note,
            client_note: client_note,
            file_type:  file_type,
            file_name:  file_name,
            file_count: file_count,
            vendor: vendor,
            file_price: file_price,
            stiches_count: stiches_count,
            vendor_digit_price: vendor_digit_price,
            vendor_digit_rate: vendor_digit_rate,
            order_date_time: order_date_time,
            order_us_date: order_us_date,
            allocation: allocation,
            document_type: document_type,
            company_id: company_id,
            // allocation1: myList,
            status: status,
            _token: _token
        }

        
        var url = form.attr('action');
        //console.log(url);
        console.log(formData);
        var target = form.find(".success");
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('.submitbutton').val();

        var type = "POST"; //for creating new resource
       // var task_id = $('#task_id').val();;
        var my_url = url;

        // if (state == "Update"){
        //     type = "PUT"; //for updating existing resource
        //    // my_url += '/' + task_id;
        // }

        console.log(formData);
       //debugger;

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data[0].createdrowid);
                 console.log('hello');
                  table.ajax.reload();
                  //  table.page( 1).draw(false);
                  //  table.row( 1 ).scrollTo();

                $("#createdrowid").val(data[0].createdrowid);
               
                target.html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data[0].msg + "</p></div>").fadeOut( 4000 );
                // $('.submitbutton').html("<i class='fa fa-check'></i>&nbsp;Add More!").attr('disabled', true);

                //console.log(stat);
                //$( "#success" ).text("Successfully Added");
                
                                    
                 $(form).find('input[name=client_name1]').val("");
                 $(form).find('input[name=client_email_primary]').val("");
                 $(form).find('input[name=client_creation_id]').val("");
                 $(form).find('input[name=client_company]').val("");
                 $(form).find('input[name=client_note]').val("");
                 //$(form).find('input[name=client_]').val("");
              
                 $(form).find('input[name=stiches_count]').val(0);
                 $(form).find('input[name=file_price]').val(0);
                 $(form).find('input[name=digit_rate]').val(0);
                 $(form).find('input[name=stiches_count]').val(0);
                 //$(form).find('input[name=file_type]').val("");
                  $(form).find('input[name=file_name]').val("");
                 $('#OrderCreateModal #dropDownId1').val(" ");
                 //$(form).find('input[name=vendor_digit_rate').val("");
                 //$(form).find('input[name=vendor_digit_price').val("");
                 $('#OrderCreateModal #client_note').val("");
                 $('#OrderCreateModal #note').val("");
                 //$(form).find('input[name=document_type]').val("");
                 $("#OrderCreateModal").modal("hide");
               

                
            
            },

            error: function (data) {
                console.log(data.responseText);
               // console.log('Error:', data);
                var errors = data.responseJSON;
               // var errors = JSON.parse(data.responseText);
                console.log(errors);

                var errorsHtml = " ";
                $.each( errors, function( key, value ) {
                    errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                });

                target.html(errorsHtml).show("fast");
                $('.submitbutton').html("<i class='fa fa-flash'></i>&nbspResend").attr('disabled', false);
                }
        });
        
    }
    else if(method == 'PATCH') {
        //$(this).html("<i class='fa fa-spinner fa-spin'></i>&nbspWait!").attr('disabled', true); removed on 02/02/17

        e.preventDefault();
        var id = $("#modal-update #id").val();
        var client_id = $("#modal-update #client_id").val();
        var client_name = $("#modal-update #client_name").val();
        var client_email_primary = $("#modal-update #client_email_primary").val();
        var client_company = $("#modal-update #client_company").val();
        var client_state = $("#modal-update #client_state").val();
        var file_type = $("#modal-update #file_type").val();
        var vendor    = $("#modal-update #vendor").val();
        var note = $("#modal-update #note").val();
        var client_note = $("#modal-update #client_note").val();
        var document_type = $("#modal-update #document_type").val();
        var file_name = $("#modal-update #file_name").val();
        var digit_rate = $("#modal-update #digit_rate").val();
        var file_price = $("#modal-update #file_price").val();
        var stiches_count = $("#modal-update #stiches_count").val();
        var vendor_digit_price = $("#modal-update #vendor_digit_price").val();
        var vendor_digit_rate = $("#modal-update #vendor_digit_rate").val();
        var order_date_time = $("#modal-update #order_date_time").val();
        var order_us_date =$("#modal-update #order_us_date").val();
        var document_type = $("#modal-update #document_type").val();
        var allocation = $('#modal-update #dropDownId1').val();
        var status = $('#modal-update #status').val();
        var _method = form.find('input[name=_method]').val();
        var _token = form.find('input[name=_token]').val();

       // alert(allocation);
       // alert (status);
       // var client_id = $('.edit').parent('form:first').find('input[name=clientid]').val();
       
        var formData = {
                    id: id,
                    client_id: client_id,
                    client_name: client_name,
                    client_email_primary: client_email_primary,
                    client_company: client_company,
                    client_state: client_state,
                    vendor: vendor,
                     note: note,
            client_note: client_note,
            file_type:  file_type,
            file_name:  file_name,
            file_price: file_price,
            document_type: document_type,
            stiches_count: stiches_count,
            vendor_digit_price: vendor_digit_price,
            vendor_digit_rate: vendor_digit_rate,
            order_date_time: order_date_time,
            order_us_date: order_us_date,
            status: status,
            document_type: document_type,
            allocation:allocation,
                    _token: _token,
                    _method: _method
                        }

       //  url commented on 25/11/2016 for testing
        //var url = '/laravel/public/orders/'+client_id ;
      //  var url = '/laravel/public/orders/'+client_id ;
       // var url = '/laravel_linux_demo/public/orders/'+client_id ;

        var url = form.attr('action');
        var target = form.find('.success');
        //alert(status_normal);
          console.log(url);
        //console.log(json([formData]));
        
        //e.stopPropagation();
        //return false;

          $.ajax({
                url: url,
                type: 'PATCH',
                dataType: 'json',
                data: formData
              })
              .done(function(data) {
                console.log("hello updated");
                var success = data.responseJSON;
                target.html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data[0].msg + "</p></div>").fadeOut( 4000 );
                 
                //$('.submitbutton').html("<i class='fa fa-check'></i>&nbsp;Done!").attr('disabled', true);
                //$('.editmodalwindow').modal('hide');
              })
              .fail(function(data) {
                var errors = data.responseJSON;
                var errorsHtml = " ";
                $.each( errors, function( key, value ) {
                    errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                });
                target.html(errorsHtml);
                $('.submitbutton').html("<i class='fa fa-flash'></i>&nbsp;Retry!").attr('disabled', false);
              })
              .always(function() {
                 $("#editmodalwindow").modal('hide');
                console.log("complete");
              });
              
          }
        }
        //debugger;
        //alert($rowid);
       // var table = $('#invoices-table').DataTable();
      //   table.page(currentPageIndex).draw(false);
        //                      table.row( $rowid ).scrollTo();
        table.ajax.reload();
    });
 
 });

// $(document).ready(function(){
// add module
 $(document).on("keyup", ".clientinput", function(e){
    //alert('mymodal2');
    e.preventDefault();
    
    
    $value = $(this).val();
    alert($value);
    if($value){
        $("#myModal2").modal('show');
        $("#search").val($value);
    
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

//modify module
// add module
 $(document).on("keyup", ".editclientinput", function(e){
    //alert('mymodal2');
    e.preventDefault();
    
    
    $value = $(this).val();
    //alert($value);
    if($value){
        $("#editmyModal2").modal('show');
        $("#search").val($value);
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('orders/search') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    $("#editclienthelp tbody").html(data);
                  }
        
        });
    }
    else
    {
        alert("Client Name cannot be Blank")
    }

});


$(document).on("keyup", ".searchinput", function(e){
    //alert('mymodal2');
    e.preventDefault();
    
    
    $value = $(this).val();
    // alert($value);
    if($value){
        $("#myModal2").modal('show');
        $("#search").val($value);
    
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
        
        
		$(".clienthelp tr").bind("dblclick", function(){  
			    //alert(vclient_name);
                //alert($( "OrderCreateModal input[name='client_name']").val()) ;
				$("#myModal2").modal('hide');
			    $( "#OrderCreateModal .clientinput" ).val( vclient_name.trim() );
                $( "#OrderCreateModal .clientpemail" ).val( vprimary_email );
                $( "#OrderCreateModal .clientcomp" ).val(vcompany.trim());
                $( "#OrderCreateModal .clientcomp" ).css( 'text-align', 'left');
                 $( "#OrderCreateModal .clientcomp" ).css( 'float', 'left');
                $( "#OrderCreateModal .createid" ).val( vclient_creation_id );
                $( "#OrderCreateModal .cnote" ).val( vclient_note );
                $( "#OrderCreateModal .contact1" ).val( vclient_contact_1 );
                 $( "#OrderCreateModal .compid1" ).val( vcompany_id );


        });
});

$(document).on("click", ".editclienthelp tr", function(e){
//     e.preventDefault();
   //debugger
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

 //   $(".editclienthelp tr").bind("dblclick", function(){  
$(document).on("dblclick", ".editclienthelp tr", function(e){

      //debugger
        var vclient_creation_id=$(this).find('td:eq(1)').html();
        var vclient_name=$(this).find('td:eq(2)').html();
        var vprimary_email=$(this).find('td:eq(3)').html();
        // var vsecondary_email=$(this).find('td:eq(4)').html();
        var vcompany=$(this).find('td:eq(4)').html();
        var vclient_note=$(this).find('td:eq(5)').html();
        var vclient_contact_1=$(this).find('td:eq(6)').html();
         var vcompany_id=$(this).find('td:eq(7)').html();
        // alert(vcompany_id);
          //alert(vclient_name);
                //alert($( "OrderCreateModal input[name='client_name']").val()) ;
        $("#editmyModal2").modal('hide');
          $( "#editmodalwindow .editclientinput" ).val( vclient_name.trim() );
                $( "#editmodalwindow .clientpemail" ).val( vprimary_email );
                $( "#editmodalwindow .clientcomp" ).val( vcompany.trim() );
                $( "#editmodalwindow .clientcomp" ).css( 'text-align', 'left');
                $( "#editmodalwindow .createid" ).val( vclient_creation_id );
                $( "#editmodalwindow .cnote" ).val( vclient_note );
                $( "#editmodalwindow .contact1" ).val( vclient_contact_1 );
                 $( "#OrderCreateModal .compid1" ).val( vcompany_id );

       
});
    


// new order dtls  modal



// new order dtls modal 20/09/17

$(document).on("click", ".editdtl", function(e){
    e.preventDefault();
    //alert("hello");
    
    var _token = $(this).parents('form:first').find('input[name=_token]').val();
    var url = $(this).parents('form:first').attr('action');
    var id1 = $(this).parents('form:first').find('input[name=id]').val();
    var currentPageIndex = table.page.info().page;
    var fstatus =  $(this).parents('form:first').find('.fstatus1').val();


    

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    });
   
     $("#dtltable .dtlbody").empty();

    var formData =  {
                      id:  id1
                     
                    }
                            
                       

});



    /**
    * process the response, populating the form fields from the JSON data
    * @param {Object} response the JSON data parsed into an object
    */
    function process_response_projects(response)
    {
        //jQuery.noConflict();

        var form = $("#editmodalwindow").find("form:first");
        var url = form.attr("action");
        alert("hi");
        console.log("form default url is " + url);
        console.log(response);
        var id                   = response[0].id;
        var client_name          = response[0].client_name;
        var client_id            = response[0].client_id;
        var client_email_primary = response[0].client_email_primary;
        var client_company       = response[0].client_company;
        var client_state         = response[0].client_state;
        console.log(response[0].allocation);
        var order_id             = response[0].order_id;
        var client_creation_id   = response[0].client_creation_id;
        var client_address1      = response[0].client_address1;
        var client_contact_1     = response[0].client_contact_1;
        var client_note          = response[0].client_note
        var note                 = response[0].note;
        var file_name            = response[0].file_name;
        var file_type            = response[0].file_type;
        var file_price           = response[0].file_price;
        var stiches_count        = response[0].stiches_count;
        var vendor_digit_rate    = response[0].vendor_digit_rate;
        var vendor_digit_price   = response[0].vendor_digit_price;
        var order_date_time      = response[0].order_date_time;
        var target_completion_time = response[0].target_completion_time;
        var allocation          = response[0].allocation;
        var unit_price          = response[0].unit_price;
        var status              = response[0].status;
        var document_type       = response[0].document_type;
        var order_us_date       = response[0].order_us_date;
        var created_byname      = response[0].created_byname;
        var updated_byname      = response[0].updated_byname;
        var approval_time       = response[0].approval_time;
        var diffcolumns         = response[0].diffcolumns;
        var fcount              = response[0].file_count;

 

        var host = window.location.host;
        var pathname = window.location.pathname;
        // console.log("new projectslug is " +  client_id);
       // hide to overwrite client model
       // var updatedurl = 'http://' + host + pathname + '/' +  client_id;
        console.log("original url" + url + allocation + status);
        //console.log("updated url"+ updatedurl); //for debug
      

        // below is correct but as we have to update orders url
        // commented below for testing in local
        //var updatedurl = 'http://' + host +'/laravel/public/orders/'+client_id ;

        var updatedurl = url ;
          form.attr('action', updatedurl);
           console.log("updated url"+ updatedurl);
        form.find('#form-url').html(updatedurl);
        // var i;
        $("#modal-update #id").val(id); 
        $("#modal-update #client_id").val(client_id);
        $("#modal-update #client_name").val(client_name);
        $("#modal-update #client_email_primary").val(client_email_primary);
        $("#modal-update #client_company").val(client_company);
        $("#modal-update #client_state").val(client_state);
       
        // $('#dropDownId').val(alloc.split(','));
        $("#modal-update #dropDownId1").val(allocation.split(','));
        
        $("#modal-update #status").val(status);
        $("#modal-update #document_type").val(document_type);
        $("#modal-update .editscount").val(stiches_count);
        $("#modal-update #file_price").val(file_price);
        $("#modal-update #file_type").val(file_type);
        $("#modal-update #file_name").val(file_name);
        $("#modal-update #note").val(note);
        $("#modal-update #client_note").val(client_note);
        $("#modal-update #target_completion_time").val(target_completion_time);
        $("#modal-update #order_date_time").val(order_date_time);
        $("#modal-update #order_us_date").val(order_us_date);
        $("#modal-update #approval_time").val(approval_time);
        $("#modal-update #created_byname").val(created_byname);
        $("#modal-update #updated_byname").val(updated_byname);
        $('#modal-update #diffcolumns').val(diffcolumns);
        $('#modal-update #file_count').val(file_count);

        $("#editmodalwindow .hidealloc").prop("disabled", true); 
        $("#editmodalwindow .hidestatus").prop("disabled", true); 
        $("#editmodalwindow").modal('show');

    }

// procedure for modify order details
 function process_response_projects1(response)
    {
        //jQuery.noConflict();

        var form = $("#editmodalwindow1").find("form:first");
        var url = form.attr("action");
        alert("projects1");
        console.log("form default url is " + url);
        console.log(response);
        var id                   = response[0].id;
        var client_name          = response[0].client_name;
        var client_id            = response[0].client_id;
        var client_email_primary = response[0].client_email_primary;
        var client_company       = response[0].client_company;
        var client_state         = response[0].client_state;
        console.log(response[0].allocation);
        var order_id             = response[0].order_id;
        var client_creation_id   = response[0].client_creation_id;
        var client_address1      = response[0].client_address1;
        var client_contact_1     = response[0].client_contact_1;
        var client_note          = response[0].client_note
        var note                 = response[0].note;
        var file_name            = response[0].file_name;
        var file_type            = response[0].file_type;
        var file_price           = response[0].file_price;
        var stiches_count        = response[0].stiches_count;
        var vendor_digit_rate    = response[0].vendor_digit_rate;
        var vendor_digit_price   = response[0].vendor_digit_price;
        var order_date_time      = response[0].order_date_time;
        var target_completion_time = response[0].target_completion_time;
        var allocation          = response[0].allocation;
        var unit_price          = response[0].unit_price;
        var status              = response[0].status;
        var document_type       = response[0].document_type;
        var order_us_date       = response[0].order_us_date;
        var created_byname      = response[0].created_byname;
        var updated_byname      = response[0].updated_byname;
        var approval_time       = response[0].approval_time;
        var diffcolumns         = response[0].diffcolumns;
        var fcount              = response[0].file_count;
        var status1             = response[0].status1;
        //alert("hello" + status1);
       // alert(allocation);

          if (fcount > 1 )
          {
             var  fhtml = "<input type='text' name='fcount[]' /><br>";
          }

 

        var host = window.location.host;
        var pathname = window.location.pathname;
        // console.log("new projectslug is " +  client_id);
       // hide to overwrite client model
       // var updatedurl = 'http://' + host + pathname + '/' +  client_id;
        console.log("original url" + url + allocation + status);
        //console.log("updated url"+ updatedurl); //for debug
      

        // below is correct but as we have to update orders url
        // commented below for testing in local
        //var updatedurl = 'http://' + host +'/laravel/public/orders/'+client_id ;

        var updatedurl = url ;
          form.attr('action', updatedurl);
           console.log("updated url"+ updatedurl);
        form.find('#form-url').html(updatedurl);
        // var i;
        $("#modal-update1 #id").val(id); 
        $("#modal-update1 .inner p").append(fhtml); 
        $("#modal-update1 #client_id").val(client_id);
        $("#modal-update1 #client_name").val(client_name);
        $("#modal-update1 #client_email_primary").val(client_email_primary);
        $("#modal-update1 #client_company").val(client_company);
        $("#modal-update1 #client_state").val(client_state);
       
        // $('#dropDownId').val(alloc.split(','));
        $("#modal-update1 #dropDownId1").val(allocation.split(','));
        
        $("#modal-update1 #status").val(status);
        $("#modal-update1 #status2").val(status1.split(','));
        $("#modal-update1 #document_type").val(document_type);
        $("#modal-update1 .editscount").val(stiches_count);
        $("#modal-update1 #file_price").val(file_price);
        $("#modal-update1 #file_type").val(file_type);
        $("#modal-update1 #file_name").val(file_name);
        $("#modal-update1 #note").val(note);
        $("#modal-update1 #client_note").val(client_note);
        $("#modal-update1 #target_completion_time").val(target_completion_time);
        $("#modal-update1 #order_date_time").val(order_date_time);
        $("#modal-update1 #order_us_date").val(order_us_date);
        $("#modal-update1 #approval_time").val(approval_time);
        $("#modal-update1 #created_byname").val(created_byname);
        $("#modal-update1 #updated_byname").val(updated_byname);
        $('#modal-update1 #diffcolumns').val(diffcolumns);
        $('#modal-update1 #file_count').val(file_count);

        $("#editmodalwindow1 .hidealloc").prop("disabled", true); 
        $("#editmodalwindow1 .hidestatus").prop("disabled", true); 
        $("#editmodalwindow1").modal('show');

    }

    
      
});


$("#OrderCreateModal .ftype").on("change", function(){
    var selectedOption = $(this).find("option:selected").text();
    
    if(selectedOption == "Vector" ) {
      //&& $('.valid_file_price').val() == '0' || $('.valid_file_price').val() == ''){
       // alert("You must insert value greater then 0 while you select File Type Vector");
        $('#OrderCreateModal .valid_file_price').val(5.5);
        $('#OrderCreateModal .scount').val(0.00);
        $('#OrderCreateModal .scount').hide();
        $('#OrderCreateModal .slabel').hide();
        $("#OrderCreateModal .add_vendor_digit_rate").val(0.00); 
        $("#OrderCreateModal .add_vendor_digit_price").val(0.00); 
    }
    else
    {
      //alert(selectedOption); 
     // debugger;
      $('#OrderCreateModal .slabel').show();
      $('#OrderCreateModal .scount').show();
      $('OrderCreateModal .valid_file_price').val(0);
      calc_astitch_count();
    }
});

$("#editmodalwindow .editftype").on("change", function(){
    var selectedOption = $(this).find("option:selected").text();
    //alert(selectedOption);
    if(selectedOption == "Vector" ) {
      // && $('.edit_file_price').val() == '0' || $('.edit_file_price').val() == ''){
       // alert("You must insert value greater then 0 while you select File Type Vector");
        $('#editmodalwindow .edit_file_price').val(5.5);
        $('#editmodalwindow .editscount').val(0.00);
        $("#editmodalwindow .edit_vendor_digit_rate").val(0.00); 
        $("#editmodalwindow .edit_vendor_digit_price").val(0.00); 
        
       }
    else
    {
      $('#editmodalwindow .edit_file_price').val(0);
       calc_estitch_count();
    }
});


$("#OrderCreateModal .vend").on("change", function(){
    var selectedOption = $(this).find("option:selected").text();
    var stich_count  =   $("#OrderCreateModal .scount").val() ;
    // alert(this.value);
    var filetype = $("#OrderCreateModal .ftype").val() ;
   
    //alert(stich_count);
    //alert(filetype);
    if (filetype == "Digitizing") {
       if(this.value == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
      
        //alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75

        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
             $("#OrderCreateModal .add_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                  $("#OrderCreateModal .add_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(40);

            }

            
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2) ;
            $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
            $("#OrderCreateModal .valid_file_price").val(fval);
   
      } 
    else
    {
       if (stich_count < 8000   ) {
            var vprice =  stich_count * 0.90 ;
            $("#OrderCreateModal .add_vendor_digit_rate").val(0.90);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.80);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.70);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
               $("#OrderCreateModal .add_vendor_digit_rate").val(0.60);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.50);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.40);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(30);

            }

             
          var fval = ((stich_count/1000) * 1.75).toFixed(2);
          var vprice1 = (vprice/1000).toFixed(2) ;

          $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
          $("#OrderCreateModal .valid_file_price").val(fval);
    }


  }

});

$("#editmodalwindow .editvend").on("change", function(){
    //debugger;
    var selectedOption = $(this).find("option:selected").val();
    var stich_count  =   $("#editmodalwindow .editscount").val() ;
    //alert(this.value);

    //alert(selectedOption);
    var filetype = $("#editmodalwindow .editftype").val() ;
    
   // alert(stich_count);
   // alert(filetype);

    if (filetype == "Digitizing") {
       if(selectedOption == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
      
        //alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75

        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
             $("#editmodalwindow .edit_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                  $("#editmodalwindow .edit_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(40);

            }

            
            //var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2) ;

            //vprice1 = (vprice/1000).toFixed(2) ;
            $("#editmodalwindow .edit_vendor_digit_price").val(vprice1);
            $("#editmodalwindow .edit_file_price").val(fval);
   
      } 
    else
    {
       if (stich_count < 8000   ) {
            var vprice =  stich_count * 0.90 ;
            $("#editmodalwindow .edit_vendor_digit_rate").val(0.90);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.80);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.70);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
               $("#editmodalwindow .edit_vendor_digit_rate").val(0.60);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.50);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.40);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(30);

            }

             
          var fval = ((stich_count/1000) * 1.75).toFixed(2);
          var vprice1 = (vprice/1000).toFixed(2) ;
          //alert(vprice1);
            $("#editmodalwindow .edit_vendor_digit_price").val(vprice1);
            $("#editmodalwindow .edit_file_price").val(fval);
    }


  }

});

function calc_astitch_count() {
   // alert("hello procedure for calculation");
    var selectedOption = $('#OrderCreateModal .vend').val();
    var stich_count  =   $("#OrderCreateModal .scount").val() ;
    //alert(selectedOption);
    var filetype = $("#OrderCreateModal .ftype").val() ;
  
   // alert(stich_count);
   // alert(filetype);
    if (filetype == "Digitizing") {
       if(selectedOption == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
      
        //alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75

        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
             $("#OrderCreateModal .add_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $("#OrderCreateModal.add_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
                $("#OrderCreateModal.add_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                  $("#OrderCreateModal .add_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(40);

            }

            
            //var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2) ;

            //vprice1 = (vprice/1000).toFixed(2) ;
            $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
            $("#OrderCreateModal .valid_file_price").val(fval);
   
      } 
    else
    {  
      // alert("hello");
       if (stich_count < 8000   ) {
            var vprice =  stich_count * 0.90 ;
            $("#OrderCreateModal .add_vendor_digit_rate").val(0.90);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.80);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.70);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
               $("#OrderCreateModal .add_vendor_digit_rate").val(0.60);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.50);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.40);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(30);

            }

             
          var fval = ((stich_count/1000) * 1.75).toFixed(2);
          var vprice1 = (vprice/1000).toFixed(2) ;

            $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
            $("#OrderCreateModal .valid_file_price").val(fval);
    }

}
}

function calc_estitch_count() {
    var selectedOption = $('#editmodalwindow .editvend').text();
    var stich_count  =   $("#editmodalwindow .editscount").val() ;
    //alert(this.value);
    var filetype = $("#editmodalwindow .editftype").val() ;
   
    //alert(stich_count);
    //alert(filetype);
    if (filetype == "Digitizing") {
       if(selectedOption == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
      
       // alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75

        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
             $("#editmodalwindow .edit_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                  $("#editmodalwindow .edit_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(40);

            }

            
            //var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2) ;

            //vprice1 = (vprice/1000).toFixed(2) ;
            $("#editmodalwindow .edit_vendor_digit_price").val(vprice1);
            $("#editmodalwindow .edit_file_price").val(fval);
   
      } 
    else
    {
       if (stich_count < 8000   ) {
            var vprice =  stich_count * 0.90 ;
            $("#editmodalwindow .edit_vendor_digit_rate").val(0.90);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.80);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.70);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
               $("#editmodalwindow .edit_vendor_digit_rate").val(0.60);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
                 $("#editmodalwindow .edit_vendor_digit_rate").val(0.50);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(0.40);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;
                $("#editmodalwindow .edit_vendor_digit_rate").val(30);

            }

             
          var fval = ((stich_count/1000) * 1.75).toFixed(2);
          var vprice1 = (vprice/1000).toFixed(2) ;

            $("#editmodalwindow .edit_vendor_digit_price").val(vprice1);
            $("#editmodalwindow .edit_file_price").val(fval);
    }

}
}



$("#OrderCreateModal .scount").on("change", function(){
      //alert("hello");
      var stich_count =  $(this).val();
     // alert(stich_count);
      //alert($("#file_type").val());
      //alert($(".vend").val());
      $("#OrderCreateModal .scount").val(stich_count);

 if ($("#OrderCreateModal .ftype").val() == "Digitizing") {
       if($("#OrderCreateModal .vend").val() == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
       
        //alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75
        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
            $("#OrderCreateModal .add_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
               $("#OrderCreateModal .add_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                 $("#OrderCreateModal .add_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $("#OrderCreateModal .add_vendor_digit_rate").val(40);

            }

            
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2) ;

            $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
            $("#OrderCreateModal .valid_file_price").val(fval);
      } 
    else
    {
       if (stich_count <= 8000   ) {
            var vprice =  stich_count * 0.90 ;
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;

            }

           
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 =  (vprice/1000).toFixed(2);

            $("#OrderCreateModal .add_vendor_digit_price").val(vprice1);
            $("#OrderCreateModal .valid_file_price").val(fval);
         }

      }   
     
});


$(".editscount").on("change", function(){
      //alert("hello");
      var stich_count =  $(this).val();
     // alert(stich_count);
      //alert($("#file_type").val());
      //alert($(".vend").val());
      $(".editscount").val(stich_count);

 if ($(".editftype").val() == "Digitizing") {
       if($(".editvend").val() == "VENDOR1"  ) {
        // alert("You must insert value greater then 0 while you select File Type Vector");
       
        // alert(stich_count);
        //#file_price.value =  stitchcount/1000 *1.75
        if (stich_count <= 8000   ) {
            var vprice =  stich_count * 1 ;
            $(".edit_vendor_digit_rate").val(1);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.85 ;
                $(".edit_vendor_digit_rate").val(0.85);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.75 ;
                $(".edit_vendor_digit_rate").val(0.75);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.65 ;
               $(".edit_vendor_digit_rate").val(0.65);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.55 ;
                 $(".edit_vendor_digit_rate").val(0.55);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.43 ;
                $(".edit_vendor_digit_rate").val(0.43);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *40 ;
                $(".edit_vendor_digit_rate").val(40);

            }

            
            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 =  (vprice/1000).toFixed(2);
            
            $(".edit_vendor_digit_price").val(vprice1);
            $(".edit_file_price").val(fval);
      } 
    else
    {
       if (stich_count <= 8000   ) {
            var vprice =  stich_count * 0.90 ;
            $(".edit_vendor_digit_rate").val(0.90);
            }
        else if( stich_count > 8000 && stich_count <= 10000 ) {  
                var vprice =  stich_count * 0.80 ;
                $(".edit_vendor_digit_rate").val(0.80);
            }
        else if( (stich_count > 10000) && (stich_count <= 15000) ) {  
                var vprice =  stich_count * 0.70 ;
                $(".edit_vendor_digit_rate").val(0.70);
            }
        else if( (stich_count > 15000) && (stich_count <= 20000) ) {  
               var vprice =  stich_count *  0.60 ;
               $(".edit_vendor_digit_rate").val(0.60);
            }
        else if( (stich_count > 20000) && (stich_count <= 30000) ) {  
                 var vprice =  stich_count * 0.50 ;
                 $(".edit_vendor_digit_rate").val(0.50);
            }
        else if( (stich_count > 30000) && (stich_count <= 60000) ) {  
                var vprice =  stich_count * 0.40 ;
                $(".edit_vendor_digit_rate").val(0.40);
            }
        else if(stich_count > 60000 ) {  
                var vprice =  stich_count *30 ;
                $(".edit_vendor_digit_rate").val(0.90);

            }

            var fval = ((stich_count/1000) * 1.75).toFixed(2);
            var vprice1 = (vprice/1000).toFixed(2);

            $(".edit_vendor_digit_price").val(vprice1);
            $(".edit_file_price").val(fval);

         }

      }   
     
});


$(".paybutton").click(function(event){
   var table = $('#example2').DataTable({
      pageLength: 4
   });

   // Handle form submission event
   $('#frm-example2').on('submit', function(e){
      // Prevent actual form submission
      e.preventDefault();

      // Serialize form data
      var data = table.$('input,select,textarea').serializeArray();

      // Include extra data if necessary
      // data.push({'name': 'extra_param', 'value': 'extra_value'});

      // Submit form data via Ajax
      $.post({
         url: 'echo_request.php',
         data: data
      });
   });
   

});



$(".orderalloc").click(function(event) {
  /* Act on the event */
 //alert("clicked properly");

 var table = $('#invoices-table').DataTable();
 var $rowid = table.row( this ).index() ;
 var currentPageIndex = table.page.info().page;

  var id1= [];
   $.each(table.rows('.selected').data(), function() {
       id1.push(this["id"]);
   });

      //alert(a[0]);
      //console.log(a[0]);

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });       
 
  
 var target = $(this);
 $( "#mallocdialog" ).dialog({
               
                    title : "Change Allocation",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    width: 200,
                    height: 250,
                     position: {
                       my: "left",
                       at: "left",
                       of: target
                              },

                    
                    buttons: [
                                {
   
                        text: "Submit",
                        title: "Submit",
                        id: 'allocs',
                        // form: "client_form_submit",
                        click: function() {
     
                        
                        var newalloc = $('#dropDownId2').val();
                        var _token   = $("#mallocdialog .token1").val();
                       

                         //alert( newalloc + _token);

                        var formData = {
                            id:  id1, 
                            newalloc: newalloc,
                            _token: _token
                            
                        }
                            
                         //alert(dataString);
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/multipleorderalloc",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             // $( "#mallocdialog .success" ).html("Data Updated Successfully");  
                             //$('.dataTable').each(function() {
                                 // dt = $(this).dataTable();
                                 // dt.fnDraw();
                                  // table.draw( false );
                              //});
                              //alert(result[0].msg);
                              table.page(currentPageIndex).draw(false);
                              table.row( $rowid ).scrollTo();

                            }
                        });

                     setTimeout(function(){
                               $('#mallocdialog').dialog('close');                
                                }, 300); 

                               
                   
                            //return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
            
            
                    },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                    $('#dropDownId').val(alloc.split(','));
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
                   
                   
            
                    },

                });

         $( "#mallocdialog" ).dialog("open");

});

// new code for select all checkbox


function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }

}


$(document).ready(function(){

// An offset to push the content down from the top
var offset = $('#header').outerHeight();

function scrollToAnchor( anchor ) {
    $("html, body").animate({ scrollTop: $(anchor).position() - offset });
       
}

// When you click on an <a> that has a '#'
$('nav#primary-navwrapper a[href^="#"], #sitemap a[href^="#"], .hireme a[href^="#"]').bind('click.smoothscroll',function (event) {
    // Prevent from default action to intitiate
    // The id of the section we want to go to.
    var id = $(this).attr("href");

    // Our scroll target : the top position of the
    // section that has the id referenced by our href.
    var target = $(id).offset().top - offset;

    console.log(target);

    // The magic...smooth scrollin' goodness.
    $('html, body').animate({ scrollTop:target }, 500);

    // Prevent the page from jumping down to our section.
    event.preventDefault();
    return false;

}); 

/**
 * This part handles the highlighting functionality.
 * We use the scroll functionality again, some array creation and 
 * manipulation, class adding and class removing, and conditional testing
 */
var aChildren = $('#primary-navwrapper li').children(); // find the a children of the list items
var aArray = []; // create the empty aArray
for (var i=0; i < aChildren.length; i++) {    
    var aChild = aChildren[i];
    var ahref = $(aChild).attr('href');
    aArray.push(ahref);
} // this for loop fills the aArray with attribute href values

$(window).scroll(function(){
    var windowPos = $(window).scrollTop(); // get the offset of the window from the top of page
    var windowHeight = $(window).height(); // get the height of the window
    var docHeight = $(document).height();

    for (var i=0; i < aArray.length; i++) {
        var theID = aArray[i];
        var divPos = $(theID).offset().top - offset; // get the offset of the div from the top of page
        var divHeight = $(theID).height(); // get the height of the div in question
        if (windowPos >= divPos && windowPos < (divPos + divHeight)) {
            $("a[href='" + theID + "']").addClass('current');
        } else {
            $("a[href='" + theID + "']").removeClass('current');
        }
    }
});

//now scroll to the anchor when loading page - this was missing
scrollToAnchor(document.location.hash);

});


</script>

<!-- code added for highlight search query -->
<script>

(function(window, document, $){


function highlight( body, table )
{
  // Removing the old highlighting first
  body.unhighlight();

  // Don't highlight the "not found" row, so we get the rows using the api
  if ( table.rows( { filter: 'applied' } ).data().length ) {
    table.columns().every( function () {
        var column = this;
        column.nodes().flatten().to$().unhighlight({ className: 'column_highlight' });
        column.nodes().flatten().to$().highlight( $.trim( column.search() ).split(/\s+/), { className: 'column_highlight' } );
    } );
    body.highlight( $.trim( table.search() ).split(/\s+/) );
  }
}


// Listen for DataTables initialisations
$(document).on( 'init.dt.dth', function (e, settings, json) {
  if ( e.namespace !== 'dt' ) {
    return;
  }

  var table = new $.fn.dataTable.Api( settings );
  var body = $( table.table().body() );

  if (
    $( table.table().node() ).hasClass( 'searchHighlight' ) || // table has class
    settings.oInit.searchHighlight                          || // option specified
    $.fn.dataTable.defaults.searchHighlight                    // default set
  ) {
    table
      .on( 'draw.dt.dth column-visibility.dt.dth column-reorder.dt.dth', function () {
        highlight( body, table );
      } )
      .on( 'destroy', function () {
        // Remove event handler
        table.off( 'draw.dt.dth column-visibility.dt.dth column-reorder.dt.dth' );
      } );

    // initial highlight for state saved conditions and initial states
    if ( table.search() ) {
      highlight( body, table );
    }
  }
} );


})(window, document, jQuery);

jQuery.extend({
    highlight: function (node, re, nodeName, className) {
        if (node.nodeType === 3) {
            var match = node.data.match(re);
            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';
                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);
                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);
                wordNode.parentNode.replaceChild(highlight, wordNode);
                return 1; //skip added node in parent
            }
        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
                !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
                !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
            for (var i = 0; i < node.childNodes.length; i++) {
                i += jQuery.highlight(node.childNodes[i], re, nodeName, className);
            }
        }
        return 0;
    }
});

jQuery.fn.unhighlight = function (options) {
    var settings = { className: 'highlight', element: 'span' };
    jQuery.extend(settings, options);

    return this.find(settings.element + "." + settings.className).each(function () {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

jQuery.fn.highlight = function (words, options) {
    var settings = { className: 'highlight', element: 'span', caseSensitive: false, wordsOnly: false };
    jQuery.extend(settings, options);
    
    if (words.constructor === String) {
        words = [words];
    }
    words = jQuery.grep(words, function(word, i){
      return word != '';
    });
    words = jQuery.map(words, function(word, i) {
      return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });
    if (words.length == 0) { return this; };

    var flag = settings.caseSensitive ? "" : "i";
    var pattern = "(" + words.join("|") + ")";
    if (settings.wordsOnly) {
        pattern = "\\b" + pattern + "\\b";
    }
    var re = new RegExp(pattern, flag);
    
    return this.each(function () {
        jQuery.highlight(this, re, settings.element, settings.className);
    });
};
</script>

@endpush