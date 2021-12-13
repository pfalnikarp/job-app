@extends('layouts.maintemplate')
@section('style')
<style type="text/css">

  .container-fluid {
    width: 100%;
    padding-right: 5px;
    padding-left: 5px;
    margin-right: auto;
    margin-left: auto;
}
.hideselctuser{
   display: none;
}

.vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
.btn.btn-link {
  -ms-user-select: all;
  -webkit-user-select: all;
  -moz-user-select: all;
  user-select: all;
  display: inline;
  color: #343841;
  font-weight: bold;
}
  
/*.modal-dialog{
    overflow-y: initial !important;
}
*/



/*  added above on  09/06/20 */

.ui-dialog .ui-dialog-titlebar-close {
  color: blue;
  background: white;
}


select.ostatus > option[value=""] {
    display: none;
}


.form-control {
   font-weight: 600;
   font-size: 14px;

}

table#laraorder tbody tr {
        background: transparent; 
    }

table.dataTable tbody tr.selected{
    background-color: white !important;
}
table#laraorder tbody tr.selected {
    background-color: #B0BED9 !important;
    }


/*  css above added on  26/05/20 */

  .table>thead>tr>th
{
  text-transform: capitalize !important;
 
}

  .table>thead>tr>th>input
{
   box-sizing: border-box;
  /*border: 2px solid orange;*/
}

div.row1 {
  padding-top: 20px;
    height: 40px;
    vertical-align: middle;
}
/* css added above  on 15 */
  /* css added on 15/04/20 */
   
.fstat_1   {
   /*background: #00695c; */
   background:  #9c9391; 
   color: black;

  /* color: white !important; removed as background now white on 02/05/17 */
   text-align: center;
   /*border: 0px;  removed for paralled testing on 08/02/17
   padding: 0px !important;*/
           
  }

/*.btn-success {
  color: orange !important;
}
*/


.foo   {
   color: blue;
   background: #006064 !important;
}

/* superscript css */
sup {
    vertical-align: super;
    font-size: smaller;
    color: blue !important;
    padding-top: 5px;
    margin-left: -10px;
}
/* superscript css */

table.dataTable tbody th,
table.dataTable tbody td {
    white-space: nowrap;
}


   /* css added on 15/04/20 */

   /*    TABLE CSS  DONE ON 28-02-2020 */ 

@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

/*body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
  line-height: 1.42em !important;
 }
*/


h1 {
  font-size:3em; 
  font-weight: 300;
  line-height:1em;
  text-align: center;
  color: #4DC3FA;
}

h2 {
  font-size:1em; 
  font-weight: 300;
  text-align: center;
  display: block;
  line-height:1em;
  padding-bottom: 2em;
  color: #FB667A;
}

h2 a {
  font-weight: 700;
  text-transform: uppercase;
  color: #FB667A;
  text-decoration: none;
}

.blue { color: #185875; }
.yellow { color: #FFF842; }



/*    TABLE CSS  DONE ON 28-02-2020 */

     /*  .table .thead-light th {
 
  color: #401500;
 
  background-color: #FFDDCC;
 
  border-color: #792700;
 
}

.container {
  padding-left: 15px !important;
  padding-right: 15px !important;
  width: 100% !important ;
} */

th.dt-center.fstat {
  text-align: center !important;
 /* padding-left: 20px !important;*/

}

td.fstat {
        font-style:italic;
        text-align: center; 
          vertical-align: middle !important;
       /* background:#FFAF33;*/
    }

.ellipsis {
   
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
  .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
   /* border-top: 0; */
       empty-cells: hide;
}  

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td  {
  /*line-height: 0.1px !important;*/
  padding: 0 !important;
  padding-top: 0 !important ;
  padding-bottom: 0 !important ; 
  padding-right: 0 !important;
   border-color: #979DD6 !important;
  /* border:1px #979DD6 solid;*/
}

table#laraorder td, th {
   position: relative;
  vertical-align: middle;
  text-align: center !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  clear: both;
  border-collapse: collapse;
    word-wrap: break-word;
   max-width: 150px !important;
   /*height: 100% !important;*/
  white-space: nowrap ;  
 
 
  
}


    .dataTables_scroll{
    overflow:auto;
    position:relative;
} 
    /*  NEW CSS ON 11-05-20 to fix fixed column  alignment */

.dataTables_length>label {
	color: black;
}

.dataTables_length>label{
	color: black;
}

/*select.custom-select.custom-select-sm.form-control.form-control-sm
{
  color:black !important;
  height: calc(2.8125rem + 2px) !important;
}*/

td.editdtl {
   padding-top: 10px;
}

/*
 input[type=search] {
	width: 100%;
	height: 50%;
  padding: 12px 20px;
  margin: 8px 0;t
  box-sizing: border-box;
	border: 2px solid black;
}*/


div.dataTables_scroll{
   width: 100% !important;
}


.dataTables_length {
    padding-left: 50px !important;

}


 
div.DTFC_RightHeadBlocker {
 
   background-color: #e9ecef;
   
   }
   
/*  removed as  dashboard_orders included and main div container-fluid inserted
div.dtfc_scrollwrapper {
      margin-left: -30px;

}*/

div#laraorder_filter {
   margin-left: -10px !important;
   left: -10px;
}

td>span>ul
{
  padding-top: 10px !important;
}



/*input.orde, .bill, .file, .stat {
  width: 100px;
}*/

div.mycustom {
  position: relative;
  top: -10px;
  left: -5px;
  width: 100%;

}

.table>thead {
  height: 10% ;
}

.table>thead>tr>th.dt-center {
	float: center !important;
	text-align: center !important;
	
}

table.dataTable>thead>tr>th, table.dataTable>thead>tr>td {
    padding: 4px !important;
    outline: 0;
}

table.dataTable>tbody>tr>th, table.dataTable>tbody>tr>td{
    padding: 2px !important;
    outline: 0;
}
.DTFC_LeftHeadWrapper{
/*   height: 58px;
*/
   /* background-color: red;*/
   height: 76px;
}
.DTFC_LeftBodyWrapper{
 /* overflow-y:unset !important*/
/*
   background-color: green;*/
    
  
}

.DTFC_RightHeadWrapper{
   /*height: 52px;*/
    height: 70px;
   /* background-color: red;*/
}
.DTFC_RightBodyWrapper{
/*overflow-y:unset !important*/
}
table.dataTable thead .sorting {
     background-image: none;
}
table.dataTable thead .sorting_desc {
     background-image: none;
}
.Edit{
   width: 0% !important;
  visibility: hidden;
}
.chbo{
    width: 0% !important;
  visibility: hidden;
}

/*.Stat{
width:100%;

}
*/

   </style> 

@endsection
@section('third_party_stylesheets')
<style type="text/css">
  table.c {
  table-layout: fixed;
  width: 100%;
  word-wrap: break-word;  
  text-align: center;
 
}
  .quotecolor {
  background: #0a17ec !important;
  color: white !important;
}

.allotedcolor {
  background: black !important;
  color: white !important;
}
.rev-allotedcolor{
  background: black !important;
  color: white !important;
}
.ch-allotedcolor{
  background: black !important;
  color: white !important;
}
.changescolor{
   background: #ffc107 !important;
  color: black !important;
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
.rev-qcpendingcolor{
   background: #FA4193 !important;
   color: black !important;
}
.ch-qcpendingcolor{
   background: #FA4193 !important;
  color: black !important;
}
.completedcolor {
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
.qcokcolor {
  background: #DED641 !important;
  color: black !important;
}
.ch-qcokcolor{
  background: #DED641 !important;
  color: black !important;
}
.rev-qcokcolor{
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



#rev_mistake {
     height: 40px  !important;
     width: 200px !important;
}

/*   new  css for  table layout */

.btn.editmain {

  background: white;

}



td.fstat {
  background: white !important;
  max-width: 80px !important;
}


input.Stat {
  width: 80px !important;
}

/*.DTFC_RightBodyLiner {
  max-width: 100px !important;
}*/


</style>

@endsection
@section('content')
<!-- below code added as glyph symbol not displayed -->
@php
$orderpage="true";
$orderpageedit="true";
@endphp
<div class="container-fluid mycustom">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">  

 

<div class="card-body  table-responsive" >

    <table id="laraorder" class="table condensed data-table row-border compact order-column">
      
        <thead class="thead-light fhead">
          <tr class="firstrow">
              <th></th>
         <!--      <th>chbox</th> -->
              <th>Order ID</th>
              <th>Bill Dt</th>
              @permission('show.client-name') 
              <th>Client Name</th>
              @endpermission
              @permission('show.company') 
              <th>Client Company</th>
              @endpermission
              @permission('show.primary-email') 
              <th>Client Email</th>
              @endpermission
              <th>File Type</th>
              <th>File Name</th>
              <th>File Note</th>
              <th>Priority</th>
              <th>Target Completed</th>
              <th>Allocation</th>
            @permission('stitch.view')
              <th>Stiches</th>
            @endpermission
              <th>Id</th>
              <th>Child Status</th>
            @permission('file-price.show')
              <th>File Price</th>
            @endpermission
              <th>File Count</th>
            @permission('contact1.show')
              <th>Client Contact</th>
            @endpermission
            @permission('client.address.show')
              <th>Client Address</th>
            @endpermission
            @permission('client.state.show')
              <th>Client State</th>
            @endpermission  
            @permission('vendor.show')
              <th>Vendor</th>
            @endpermission  
            @permission('digit.rate.show') 
              <th>Digit Rate</th> 
            @endpermission  
            @permission('v_emb_rate.show')
              <th>Vendor Digit Rate</th>
            @endpermission  
            @permission('vend-file-price.show')
              <th>Vendor Digit Price</th>
            @endpermission 
              <th>Order Date Time</th>
            @permission('order.us.date.show')
              <th>Order Us Date</th>
            @endpermission 
              <th>Created At</th>
              <th>Updated At</th>
              <th>Created By</th>
              <th>Updated By</th>
            @permission('order.completion.time.show')  
              <th>Order Completion Time</th> 
            @endpermission 
              <th>Approval Time</th>
            @permission('company.id.show')
              <th>Company Id</th>
            @endpermission  
              <th style="width: 50px;">Status</th>
          
          </tr>
            
           <tr class="secondrow">
              <th>Edit</th>
           <!--    <th><input type="checkbox" name="" value=""></th> -->
              <th>Order ID</th>
              <th>Bill Dt</th>
              @permission('show.client-name') 
              <th>Client Name</th>
              @endpermission
              @permission('show.company') 
              <th>Client Company</th>
              @endpermission
              @permission('show.primary-email') 
              <th>Client Email</th>
              @endpermission
              <th>File Type</th>
              <th>File Name</th>
              <th>File Note</th>
              <th>Priority</th>
              <th>Target Completed</th>
              <th>Allocation</th>
             @permission('stitch.view')
              <th>Stiches</th>
             @endpermission
              <th class="defaultSort">Id</th>
              <th>Child Status</th>
            @permission('file-price.show')
              <th>File Price</th>
            @endpermission
              <th>File Count</th>
            @permission('contact1.show')
              <th>Client Contact</th>
            @endpermission
            @permission('client.address.show')
              <th>Client Address</th>
            @endpermission
            @permission('client.state.show')
              <th>Client State</th>
            @endpermission  
            @permission('vendor.show')
              <th>Vendor</th>
            @endpermission  
            @permission('digit.rate.show') 
              <th>Digit Rate</th> 
            @endpermission  
            @permission('v_emb_rate.show')
              <th>Vendor Digit Rate</th>
            @endpermission  
            @permission('vend-file-price.show')
              <th>Vendor Digit Price</th>
            @endpermission  
              <th>Order Date Time</th>
            @permission('order.us.date.show')
              <th>Order Us Date</th>
            @endpermission 
              <th>Created At</th>
              <th>Updated At</th>
              <th>Created By</th>
              <th>Updated By</th>
            @permission('order.completion.time.show') 
              <th>Order Completion Time</th>
            @endpermission  
              <th>Approval Time</th>
            @permission('company.id.show')
              <th>Company Id</th>
            @endpermission  
              <th style="width: 50px !important;">Status</th>
          
          </tr>
        </thead>
        <tbody class="fbody">
        </tbody>

    </table>

</div>

        </div>
        </div>
        

   


@include('pages.orders.modals.edit.client_help')
@include('pages.orders.modals.create.client_help')
@include('pages.orders.modals.create.order_delayed')
@include('pages.orders.modals.today_order')
@include('pages.orders.modals.newclientadded')
@include('pages.orders.dialogs.note')
@include('pages.orders.dialogs.newfilename')
@include('pages.orders.dialogs.stichesd')
@include('pages.orders.dialogs.vendord')

@include('pages.orders.dialogs.alloc')
@include('pages.orders.dialogs.orddate')
@include('pages.orders.dialogs.ordcompdate')
@include('pages.orders.dialogs.status')
@include('pages.orders.dialogs.vendemb_rate')
@include('pages.orders.dialogs.filecount')
@include('pages.orders.dialogs.multipleorderalloc')
@include('orders.editdtl')
@include('pages.orders.dialogs.fileprice')
@include('pages.orders.dialogs.revision')
@include('pages.orders.dialogs.filereason')
@include('pages.orders.dialogs.filetyped')
@include('pages.orders.modals.today_order_detail')
@include('pages.orders.modals.edit.order_view_link')
@include('pages.orders.modals.alloc-timer')


   

@endsection
@section('script')
<!--  timer function -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>

<!--  timer function -->
<script type="text/javascript">
  $(function () {

 //header textbox logic to search 
$('#laraorder  .fhead .firstrow th').each( function (i) {
        var title = $('#laraorder th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);

        if(title.trim().length> 0) {
         if( title == 'Edit' ) {
              // $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="inputdt" value=""  /><a href="" class="orderdate">Click</a/>' );  placeholder="'+title.trim()
             }
         else {     
           $(this).html('<input  type="text"  name="'+titleclass+'"  data-index="'+i+'" class="'+titleclass+'" />' );


           }
        }    
    } );

    //datatable logic
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true, 
        async: true,
        responsive: true,
        scrollX: true,
        scrollY: ($(window).height() - 260), 
        scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
        bStateSave: true,
      
        dom: "Rlfrtip",
        autowidth: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        fixedColumns: true,
         fixedColumns:   {
           
              leftColumns: 1,

            rightColumns: 1,
          

        },

        select: {
          style: 'multi'
        },
        lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="20" selected>20</option>'+
                      '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select> Orders'

                    },
        colReorder: true,
		
        scroller: {
           rowHeight: 1
        }, 
        
        ajax: '{!!  route('orders.index') !!}',
         "preDrawCallback": function (settings) {
            pageScrollPos = $('div.dataTables_scrollBody').scrollTop();
         },
         "drawCallback": function (settings) {
             $('div.dataTables_scrollBody').scrollTop(pageScrollPos);
        },
          createdRow: function ( row, data, index ) {
                 
                  
                  var todaydt =  new Date() ;
                  var targetdt =  new Date(data.target_completion_time);
                 
                   //under half  red color
                   if (( targetdt.getTime() - todaydt.getTime()  > 0 && targetdt.getTime() - todaydt.getTime()  < 30*60*1000 ) &&  (data.status !== 'Completed')  &&  (data.status !== 'Rev-Completed') &&  (data.status !== 'Ch-Completed')  && (data.status !== 'Approved') &&  (data.status !== 'No Response')   && (data.status !== 'Quote') &&  (data.status !== 'Cancel')  && (data.status !== 'Duplicate Entry'))  {
                         
                              $(row).css('background-color', '#f2e461');
                   }
                   //between half hour to two hour light brown color
                   else if (( targetdt.getTime() - todaydt.getTime()  > 0) && ( targetdt.getTime() - todaydt.getTime() > 30*60*1000 && targetdt.getTime() - todaydt.getTime() <= 120*60*1000) &&  (data.status !== 'Completed')  &&  (data.status !== 'Rev-Completed') &&  (data.status !== 'Ch-Completed')  && (data.status !== 'Approved') &&  (data.status !== 'No Response')  && (data.status !== 'Quote') &&  (data.status !== 'Cancel')  && (data.status !== 'Duplicate Entry'))  {
                          
                            $(row).css('background-color', '#a9f299');
                   }
                   //after time go pista color
                   else if (( targetdt.getTime() < todaydt.getTime() )  && (data.status !== 'Approved') && (data.status !== 'Quote')   &&  (data.status !== 'No Response')  &&  (data.status !== 'Completed')  &&  (data.status !== 'Rev-Completed') &&  (data.status !== 'Ch-Completed') && (data.status !== 'Cancel')  && (data.status !== 'Duplicate Entry'))  {
                                 $(row).addClass( 'blink_me' );
                             //$(row).css('background-color', '#FE5A4C');
                         
                   }
                   
                              
          },
        columns: [
        
          
          { data: 'action', name: 'action', width: '2px', class: 'dt-center fstat', orderable: false, searchable: false},
           // { data: 'chbox', name: 'chbox', width: '2px', class: 'dt-center fstat chboxs', orderable: false, searchable: false},
           { data: 'order_id', name: 'order_id', width: '10px', class: 'dt-center',searchable: true
          //           "render": function (data, type, full, meta) {
          //                   return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
          //                   }
           },
            { data: 'bill_dt', name: 'bill_dt' , width: '50px' , class: 'dt-center',
                 
             },
               @permission('show.client-name') 
                 { data: 'client_name', name: 'client_name',  class: 'dt-center',
                                              

             },
           
             @endpermission
            @permission('show.company') 
              { data: 'client_company', name: 'client_company' , class: 'dt-center',
                

              },
            @endpermission
            @permission('show.primary-email') 
               { data: 'client_email_primary', name: 'client_email_primary' , class: 'dt-center',
                

            },
   

   @endpermission
 
            
          
           
            { data: 'file_type', name: 'file_type' , class: 'dt-center ftype',
             "render": function (data, type, full, meta)
            {
                            return '<span data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }

            },
            { data: 'files', name: 'files', width: '200px', class: 'dt-center'
            // ,
            //             "render": function (data, type, full, meta) {
            //                 return '<span class="filename" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
            //                 }

            },
            { data: 'note', name: 'note',    searchable: false,
              defaultContent: "",  class: 'not dt-center',
                        "render": function (data, type, full, meta) {
                                  var re = /<br *\/?>/gi;
              
                         return '<span class="notemodify" data-toggle="tooltip" title="' + data.replace(re, "\n") + '">' + data.substring(0,10) + '</span>';
                       }


            },
            
            { data: 'document_type', name: 'document_type' , class: 'dt-center' },
           
            { data: 'target_completion_time', name: 'target_completion_time' 
                       , width: '130px', class: 'ord-comp-dt-tm dt-center'
                       
                         },
            { data: 'alloc_to_person', name: 'alloc_to_person'  , width: '130px',
                     class: 'dt-center donothing' ,
                      
                        @permission('allowchange.allocation')
                              class: 'editalloc dt-center' 
                              
                         @endpermission
                      
            

             },
        @permission('stitch.view')
          { data: 'stiches_count', name: 'stiches_count', class: 'dt-center' },
        @endpermission
          { data: 'id', name: 'id' , class: 'fooid idRow dt-center',  width: '2px'},    
          {data: 'child_status', name: 'child_status', class: 'dt-center' ,visible: false },
          @permission('file-price.show')
            { data: 'file_price', name: 'file_price' , width: '50px' , class: 'dt-center'},
          @endpermission
            { data: 'file_count', name: 'file_count' , width: '50px' , class: 'cfilecount dt-center'},
          @permission('contact1.show')
            { data: 'client_contact_1', name: 'client_contact_1' , width: '50px' , class: 'dt-center'},
          @endpermission
          @permission('client.address.show')
            { data: 'client_address1', name: 'client_address1' , width: '50px' , class: 'dt-center'},
          @endpermission
          @permission('client.state.show')
            { data: 'client_state', name: 'client_state' , width: '50px' , class: 'dt-center'},
          @endpermission
          @permission('vendor.show')
            { data: 'vendor', name: 'vendor' , width: '50px' , class: 'dt-center'},
          @endpermission  
          @permission('digit.rate.show') 
            { data: 'digit_rate', name: 'digit_rate' , width: '50px' , class: 'dt-center'},
          @endpermission 
          @permission('v_emb_rate.show')
            { data: 'vendor_digit_rate', name: 'vendor_digit_rate' , width: '50px' , class: 'dt-center'},
          @endpermission  
          @permission('vend-file-price.show')
            { data: 'vendor_digit_price', name: 'vendor_digit_price' , width: '50px' , class: 'dt-center'},
          @endpermission  
            { data: 'order_date_time', name: 'order_date_time' , width: '50px' , class: 'dt-center'},
          @permission('order.us.date.show')
            { data: 'order_us_date', name: 'order_us_date' , width: '50px' , class: 'dt-center'},
          @endpermission  
            { data: 'created_at', name: 'created_at' , width: '50px' , class: 'dt-center'},
            { data: 'updated_at', name: 'updated_at' , width: '50px' , class: 'dt-center'},
            { data: 'creatusername', name: 'creatusername' , width: '50px' , class: 'dt-center'},
            { data: 'updateusername', name: 'updateusername' , width: '50px' , class: 'dt-center'},
          @permission('order.completion.time.show') 
            { data: 'order_completion_time', name: 'order_completion_time' , width: '50px' , class: 'dt-center'},
          @endpermission  
            { data: 'approval_time', name: 'approval_time' , width: '50px' , class: 'dt-center'},
          @permission('company.id.show')
            { data: 'company_id', name: 'company_id' , width: '50px' , class: 'dt-center'},
          @endpermission    
            { data: 'action1', name: 'status' , class: 'dt-center fstat',  width: '2px', sortOrder: 'desc , orderable: false, searchable: false'},
                            ],
                         pageLength: 20,
              pagination: true,
            
           order: [ [ $('th.defaultSort').index(),  'desc' ] ]

          
          
              
          

    });
        //var table sir code
      
    //callback function for direct editing 
       

  });

function blinker() {
    //$('.blink_me').fadeOut(1200);
    //$('.blink_me').fadeIn(200);
      $( ".blink_me" ).animate({backgroundColor: "#E8E6E4"}, 300 );
    $( ".blink_me" ).animate({backgroundColor: "#CD5C5C"}, 300 );
  
    
}
setInterval(blinker, 1000);
  //get digit vector photoshoop and todaycompany count value for upper button Divyaraj
   countValue();
   

   //stichis count direct editing
    
     //code added on 31-1-2021
   //refresh data table
  $(document).on("click", "#delsession", function(){
          event.preventDefault ;
          var table = $('#laraorder').DataTable();
          table.state.clear();
          
          // $('.Comp').val('');
         // window.location.href =  window.location.href.split("?")[0];
         // alert(window.location.href);
           window.location.reload();
          
            window.location.href = "{{ route('orders.index')}}";
          
  });

  //user allocation popup id
   

   //close user allocation popup logic
     $(document).on("click", ".closealloacation", function(e){

     var as=$(this).next().val();
    
     $('.dddd').modal("hide"); 
  });
 //check box logic to seletct row change color line
  $(document).on("click", ".checkboxid1", function(){
        
        // var table = $('.data-table').DataTable();
 
         if ( $(this).closest('tr').hasClass('selected') ) {
            $(this).removeClass('selected');
             $(this).closest('tr').removeClass('selected')
         }
         else {
             $(this).closest('tr').addClass('selected');
         }

  });
   $('#laraorder tbody').on( 'click', 'tr', function () {
    
        
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');  //removed on 28/08/17 for multiple selection
        }
        else {
        
            $(this).addClass('selected');
          
        }
  });
//when serch in header box this logic execute
  $( document ).ready(function() {
    //  added below on 18-02-21

    $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}

    var newid1 =$.urlParam('newid');
    console.log(newid1);

    if (newid1 != undefined ||  newid1 != null){
         var table = $('#laraorder').DataTable();
          table.search(newid1).draw();  
    }

    $("#laraorder").DataTable().columns.adjust().draw();
    
     
    
    //  added below on 18-02-21
    //added above on 07-06-20
	          $("#menu1").empty();
            $("#title1").empty();
	        $("#menu1").append('<a href="{{route('orders.create',['id'=>'noid'])}}">Create Orders</a>');
       		$("#title1").append('<center><h2>Orders</h2></center>');	

          //added on 12/05/20
           var table = $('#laraorder').DataTable();


         $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
	
//multiple order popup logic and change logic	
$(document).on("click", ".editdtl", function(e){
    e.preventDefault();
   
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
   // alert(url);
   //  $("#dtltable .dtlbody").empty();

    var formData =  {
                      id:  id1
                     
                    }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: url,
                            data: formData,
                            success: function(result)
                            { 
                        
                            //console.log(result[0].msg) ; 
                            if (result[0].status)
                             {
                                 //alert(result[0].msg);
                                 toastr.info(result[0].msg);
                              }
                            else
                              {
                                  // debugger;
                                   $( "#editdtlmodalwindow" ).find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
                                  $(".finalalloc").hide();
                                  $("#editdtlmodalwindow .feditstatus").val('');
                                  $("#editdtlmodalwindow").modal('show');
                                  $("#dtltable .dtlbody").empty();

                                  $("#dtltable .dtlbody").append(result);
                                
                                  $("#editdtlmodalwindow .feditstatus").val(fstatus);
                                  $("#updatedtl .submitdtl").prop('disabled', false);
                                  
                                    var multipleCancelButton = new Choices('#sdasdasdxx', {
                                     removeItemButton: true,
                                      maxItemCount:15,
                                   // searchResultLimit:5,
                                   // renderChoiceLimit:5
                                  });

                                  @if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12)
                                  @else
                                  $('#allocationpopupmodalid').empty();
                                  var editrandomallo1= Math.floor(Math.random() * 100000);
      
                                 editord1='ordtls'+editrandomallo1;
                                 editord2='ordtlsid'+editrandomallo1;
                                 editord3='cc'+editrandomallo1;
                                 editord4='allocationshow'+editrandomallo1;
                                   var alloeditpopupmultiorder='<div class="form-group" style="text-align: left;"><input type="checkbox" class="allocshow " name="allocshow" value="no"> &nbsp;&nbsp;Assign to users<div class="modal  bd-example-modal-md dddd" id="ddddcc'+editrandomallo1+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y:hidden;"><div class="modal-dialog modal-md" role="document"><div class="modal-content"><div class="modal-body"><div class="row"><div class="col-md-8"><b>Select Designer</b></div><div class="col-md-4"><a class="btn btn-danger btn-sm rightdiv closealloacation mb-1" id="" style="color: white;">X</a></div></div><select class="form-control selectalloc '+editord3+'" name="allocationf_id[]"  multiple="multiple" data-live-search="true" id="dropDownIdedit'+editrandomallo1+'" onchange="myFunctionallocation(this,'+editord1+','+editord2+','+editord4+')" > @foreach ($users as $key1=>$value1) <option value={{$key1}}>{{ $value1 }}.</option> @endforeach</select><input type="hidden" name="orddtls[allocation][]" value="0" id="'+editord1+'" class="updatealloc"><input type="hidden" name="allocationf[]" value="not allocated" id="'+editord2+'" class="updateallocid"> <br><br><br><br><br><br><br><br><br><br><br><br><a class="btn btn-primary rightdiv submitalloacationmulti" id="submitalloacation">Submit</a></div></div></div></div></div> <div class="ml-4" id="'+editord4+'"> </div>'; 
                                  $('#allocationpopupmodalid').append(alloeditpopupmultiorder);
                                  var multipleCancelButton = new Choices('#dropDownIdedit'+editrandomallo1, {
                                     removeItemButton: true,
                                      maxItemCount:15,
                                   // searchResultLimit:5,
                                   // renderChoiceLimit:5
                                  });
                            @endif
                              }
                            }
                        });

});

// added on  16-02-21  by prashant for form changes trigger

 $("#updatedtl :input").change(function() {
   //alert('ok');
  $(this).closest('form').data('changed', true);
});

  $("#updatedtl :checkbox").change(function() {
   //alert('ok');
  $(this).closest('form').data('changed', true);
});

// added above on 16-02-21

//addedbelow code on 24-05-20  for updatedtl  orders function(multiple order update logic)
$(document).on("click", "#updatedtl .submitdtl", function(e){ 
           // debugger;

                 // $("select.childstatus").prop('disabled',false);
                 // $("select.selectalloc").prop('disabled',false);
          
                 //  $("#updatedtl").submit();
                 //   $("#editdtlmodalwindow").modal('hide');

                //   return;
                
               
           // if ($("#updatedtl").data("changed")) {  // this not working so change as below on 15-02-21
      if($(this).closest('form').data('changed')) {
           
              // Something has changed
                                    //     alert('something chagnes');

                  $("select.childstatus").prop('disabled',false);
                  $("select.selectalloc").prop('disabled',false);
                  

                   Swal.fire({
              title: "CHANGES DETECED!",
              text: "Do you want to Save Changes ?",
              icon: "warning",
              buttons: true,
              buttons: ["Don't Save!", "Save it!"],
              dangerMode: true,
              showCloseButton: true,
               confirmButtonText: 'Save it!',
               cancelButtonText: "Don't Save!",
              })
              .then((result) => {
              if (result.value) {
                  Swal.fire("Please wait Your Record is Saving!", {
                  icon: "success",
              });
                    $("#updatedtl").submit();
                    return;

              } else {
                  Swal.fire("Changes are reverted Back!");
                    // var url = '{{ action("OrderController@index") }}' ;
                  //location.href =url;
                   $("#editdtlmodalwindow").modal('hide');
                   return;
              }
              });

                 
                   
          
                  
                 //$("#btnSubmit").attr('disabled', 'false');
                    //$("#finalsubmit").attr('diabled', 'false');

            }

            else {
                    //alertify.error('No changes done,close this form');
                     Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: "No changes done,close this form"
                                          
                                    })

                  $("#updatedtl .submitdtl").attr('disabled', 'true');
                  $("#editdtlmodalwindow").modal('hide');
                  //e.preventDefault();
                  return false;
                
                }
     
      });


//edit note code
    $(document).on("click", ".shownotes", function(e){
      var notesinfo=$(this).html();
      if(notesinfo != '.'){
     Swal.fire(''+notesinfo+'');
       Swal.fire({
                  title: 'Notes...',
                  text: ''+notesinfo+'',
                 
       })
     }
    });
 //  below logic for  edit dtl  records(multiple order change logic)

 $(document).on("change", ".statusshow", function(e){   
      
       // alert('clicked');
         if ( $('input[name="statusshow"]').is(':checked') ) {

              $(".finalalloc").hide();
               $(".feditdtlstatus").show();
              $(".statusshow").val('yes');
              $('input[name="allocshow"]').val('no'); 
             
              //$(".submitdtl").hide();
            }
            else {
              $(".statusshow").val('no');
              $(".finalalloc").show();
              $(".feditdtlstatus").hide();
            }

    });

  $(document).on("focusin", "select.falloc", function(e){  
            $("#dtltable-footer .feditdtlstatus").hide();
    });  
  //search statdate of company count
$("#startdatecount").datepicker({
dateFormat: "yy-mm-dd",
changeMonth: true,
changeYear: true,

});
//new company month
$('#newcompanymonth').datepicker( {
            changeMonth: true,
            changeYear: true,
             minViewMode: "months",
            showButtonPanel: true,
            dateFormat: 'mm-yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
  //search enddate of company count
$("#enddatecount").datepicker({
dateFormat: "yy-mm-dd",
changeMonth: true,
changeYear: true,

});

//multiple order popup logic popup modal
    $(document).on("change", ".allocshow", function(e){   
           //  debugger;
        //alert('clicked');

         if ( $('input[name="allocshow"]').is(':checked') ) {
               
              $('input[name="allocshow"]').val('yes');  
               var nextSectionWithId =  $(this).next().attr("id");
 
               $('#'+nextSectionWithId).modal("show");  
               // $(".finalalloc").show();
               // $(".feditdtlstatus").show();
               // $(".falloc").focus();
               // $(".submitdtl").show();
            }
            else {
              $('input[name="allocshow"]').val('no');   
                $(".finalalloc").hide();
                $(".feditdtlstatus").hide();
            }

    });
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
//new company added list this month
$(document).on("click", ".thismonthcompany", function(e){

        $("#newaddedclientmodal").modal('show');
        $("#newcompanymonth").val("");
        //$("#search").val($value);
        $("#tableaddclientid tbody").html('<h2>Please wait ... </h2>');
        $value = "newcompany" ;
           
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('delayedordersd') }}",
            data: {"search": $value},
            success:function(data)
                  {
                    console.log(data);
                    $("#tableaddclientid tbody").html(data[0]);
                    $("#newcompanycountid").text(data[1]);
                    
                  }
        
        });
 
});
//search new company added list search by month and year
 $(document).on("click", "#newcompanysearchbyclickid", function(e){

        // $("#newaddedclientmodal").modal('show');
        var datedata=$('#newcompanymonth').val();
       
        //$("#search").val($value);
        $("#tableaddclientid tbody").html('<h2>Please wait ... </h2>');
        $value = "newcompany" ;
           
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('delayedordersd') }}",
            data: {"search": $value,"datedata":datedata},
            success:function(data)
                  {
                    
                    $("#tableaddclientid tbody").html(data[0]);
                    $("#newcompanycountid").text(data[1]);
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
//multiple order popup select all logic
  $('#dtltable #selectAll').click(function (e) {
     
          $(this).closest('table').find('td input.chkidctl').prop('checked', this.checked);
          $("input.statusshow").hide();
          $("input.feditstatus").hide();
          
          oldstat = []; 
          $( "#dtltable  input.chkidctl:checked" ).each(function( index ) {   

               var oldstatus  = $(this).closest('tr').find('select.childstatus').val();
                 oldstat.push(oldstatus);

            });     
           
           //alert(oldstat);
          // debugger;

           //GetUnique(oldstat);

           var outputArray = [];
          // for (var i = 0;  inputArray.length; i++)
          //       {
          //         if ((jQuery.inArray(inputArray[i], outputArray)) == -1)
          //             {
          //                 outputArray.push(inputArray[i]);
          //             }
          //       }
          for (var i = 0;  i < oldstat.length; i++)
                {
                  if ((jQuery.inArray(oldstat[i], outputArray)) == -1)
                      {
                          outputArray.push(oldstat[i]);
                      }
                }
                
                //alert(outputArray.length);
               // debugger;
              // alert(outputArray[0]);
             //  alert(outputArray[1]);

                if (outputArray.length == 1 ){
                             $("input.statusshow").show();
                             $("input.feditstatus").show();
                        $("#editdtlmodalwindow select.feditstatus").empty();
                     
                    if ( outputArray[0] == 'Quote') {
                        
                      
                         // $("input.feditstatus").val('Approved');
                        @if (Auth::user()->level() > 16)
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Approved">Approved</option>'); 
                        @endif  

                     }

                    if ( outputArray[0] == 'Approved') {
                        
                      
                         //  $("input.feditstatus").val('Alloted');
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Alloted">Alloted</option>'); 

                     }

                    if ( outputArray[0] == 'Completed') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }
                                        if ( outputArray[0] == 'Rev-Completed') {
                          $("#editdtlmodalwindow select.feditstatus").hide();
                      
                          $("#editdtlmodalwindow select.feditstatus").val('');

                    }

                    if ( outputArray[0] == 'On Hold') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editmodalwindow input.feditstatus").val("");

                    }

                    if ( outputArray[0] == 'Ch-Completed') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }


                    if ( outputArray[0] == 'Revision') {
                        
                        $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-Alloted">Rev-Alloted</option>'); 
                      
                       //     $("input.feditstatus").val('Rev-Alloted');

                    }

                    if ( outputArray[0] == 'Changes') {
                        
                           $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-Alloted">Ch-Alloted</option>'); 
                         //  $("input.feditstatus").val('Ch-Alloted');

                    }

                    if ( outputArray[0] == 'Cancel' || outputArray[0] == 'Duplicate Entry') {
                        
                       $("#editdtlmodalwindow select.feditstatus").append('<option value="Approved">Approved</option>'); 
                          
                          //$("#editdtlmodalwindow select.feditstatus").val('');
                          //  $("#editdtlmodalwindow select.feditstatus").hide();

                    }

                     if ( outputArray[0] == 'On Hold') {
                        
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');
                            $("#editdtlmodalwindow select.feditstatus").hide();

                    }

                     if ( outputArray[0] == 'Alloted') {
                            
                             $("#editdtlmodalwindow select.feditstatus").append('<option value="QC Pending">QC Pending</option>'); 
                      
                           //$("input.feditstatus").val('QC Pending');

                     }
                     else if ( outputArray[0] == 'QC Pending') {
                           $("#editdtlmodalwindow select.feditstatus").append('<option value="Alloted">Alloted</option>'); 
                             $("#editdtlmodalwindow select.feditstatus").append('<option value="QC OK">QC OK</option>'); 
                      
                           // $("input.feditstatus").val('QC OK');

                     }
                      else if ( outputArray[0] == 'QC OK') {
                             $("#editdtlmodalwindow select.feditstatus").append('<option value="Completed">Completed</option>'); 
                      
                          // $("input.feditstatus").val('Completed');

                     }

                    if ( outputArray[0] == 'Rev-Alloted') {
                               $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-QC Pending">Rev-QC Pending</option>');
                      
                          // $("input.feditstatus").val('Rev-QC Pending');

                     }
                     else if ( outputArray[0] == 'Rev-QC Pending') {
                        
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-QC OK">Rev-QC OK</option>');
                          
                          // $("input.feditstatus").val('Rev-QC OK');

                     }
                      else if ( outputArray[0] == 'Rev-QC OK') {
                              $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-Completed">Rev-Completed</option>');
                      
                          // $("input.feditstatus").val('Rev-Completed');

                     }

                       if ( outputArray[0] == 'Ch-Alloted') {
                              $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC Pending">Ch-QC Pending</option>');
                      
                           //$("input.feditstatus").val('Ch-QC Pending');

                     }
                     else if ( outputArray[0] == 'Ch-QC Pending') {
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC OK">Ch-QC OK</option>');
                      
                           //$("input.feditstatus").val('Ch-QC OK');

                     }
                      else if ( outputArray[0] == 'Ch-QC OK') {
                           $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-Completed">Ch-Completed</option>');
                      
                           //$("input.feditstatus").val('Ch-Completed');

                     }


                }



  });
// below routine for  both updation of text and id in edit program for allocation(multiple order)cody by prashant sir not use
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
        //alert('Please allocate files');
         Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Please Select Designer First..'
                                          
                                    })

                  
        e.stopPropagation();
        return false;
      }
      // else if( (option_all != 'not allocated') && (childst == 'Alloted')) {
      //        confirm('Do you want to change allocation');

      // }


      // allocation validation above

      var result = new Array();

      //$("select.selectalloc").each(function() {
            result.push($(this).val());
      //  });

      var output = result.join(", ");
      //alert(output);
         $(this).closest('tr').find('.updateallocid').val(output);

    });
//allocatonpproblem
    // below routine for  both updation of text and id in  edit program for allocationf not use
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
          // alert('Please allocate files');
          Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Please Select a Designer First..'
                                          
                                    })
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

  //added logic for each checkbox selected(multiple order)

var oldstat = new Array();
  var oldstatus = '';
  $("input.statusshow").hide();

  $(document).on("change", "#dtltable  input.chkidctl", function(e){
           // debugger;
           // alert('clicked');  
           $(this).closest('form').data('changed', true);  
          
          $("input.statusshow").hide(); 
          $("#editdtlmodalwindow select.feditstatus").hide(); 

          oldstat = []; 
          $( "#dtltable  input.chkidctl:checked" ).each(function( index ) {   

               var oldstatus  = $(this).closest('tr').find('select.childstatus').val();
                 oldstat.push(oldstatus);
                 //  $("input.statusshow").show(); 
                 // $("#editdtlmodalwindow select.feditstatus").show();
                 //             $("#editdtlmodalwindow select.feditstatus").show();

            });     
           
           //alert(oldstat);

           //GetUnique(oldstat);

           var outputArray = [];
          // for (var i = 0;  inputArray.length; i++)
          //       {
          //         if ((jQuery.inArray(inputArray[i], outputArray)) == -1)
          //             {
          //                 outputArray.push(inputArray[i]);
          //             }
          //       }
          for (var i = 0;  i < oldstat.length; i++)
                {
                  if ((jQuery.inArray(oldstat[i], outputArray)) == -1)
                      {
                          outputArray.push(oldstat[i]);
                      }
                }
                
                //alert(outputArray.length);
               // debugger;

                if (outputArray.length == 1 ){
                             $("input.statusshow").show(); 
                             $("#editdtlmodalwindow select.feditstatus").show();
                             $("#editdtlmodalwindow select.feditstatus").show();
                             
                              $("#editdtlmodalwindow select.feditstatus").empty();

                    if ( outputArray[0] == 'Quote') {

                      @if (Auth::user()->level()> 16)
                      
                          $("#editdtlmodalwindow select.feditstatus").val('Approved');
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Approved">Approved</option>'); 
                      @endif 

                     }

                    if ( outputArray[0] == 'Approved') {
                        
                      
                           $("#editdtlmodalwindow select.feditstatus").val('Alloted');
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Alloted">Alloted</option>'); 

                     }

                    if ( outputArray[0] == 'Completed') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }
                                        if ( outputArray[0] == 'Rev-Completed') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }

                      if ( outputArray[0] == 'On Hold') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editmodalwindow input.feditstatus").val("");

                    }

                     if ( outputArray[0] == 'Cancel' || outputArray[0] == 'Duplicate Entry') {
                        
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Approved">Approved</option>');  
                           //$("#editdtlmodalwindow select.feditstatus").val('');
                           // $("#editdtlmodalwindow select.feditstatus").hide();

                    }

                    if ( outputArray[0] == 'Ch-Completed') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }


                    if ( outputArray[0] == 'Ch-QC Pending') {
                      @permission('do.qc.ok')  
                        $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC OK">Ch-QC OK</option>');
                      @endpermission
                          // $("input.feditstatus").val('Ch-QC OK');

                    }

                     if ( outputArray[0] == 'Ch-QC OK') {
                        
                       $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-Completed">Ch-Completed</option>');
                         //  $("input.feditstatus").val('Ch-Completed');

                    }

                    if ( outputArray[0] == 'Revision') {
                         $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-Alloted">Rev-Alloted</option>');
                      
                          // $("input.feditstatus").val('Rev-Alloted');

                    }

                      if ( outputArray[0] == 'Cancel') {
                            $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');
                      

                    }

                    if ( outputArray[0] == 'Duplicate Entry') {
                             $("#editdtlmodalwindow select.feditstatus").hide();
                      
                           $("#editdtlmodalwindow select.feditstatus").val('');

                    }


                    if ( outputArray[0] == 'Changes') {
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-Alloted">Ch-Alloted</option>');
                      
                           //$("input.feditstatus").val('Ch-Alloted');

                    }

                     if ( outputArray[0] == 'Alloted') {
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="QC Pending">QC Pending</option>');
                      
                          //  $("input.feditstatus").val('QC Pending');

                     }
                     else if ( outputArray[0] == 'QC Pending') {
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Alloted">Alloted</option>'); 
                          @permission('do.qc.ok')  
                             $("#editdtlmodalwindow select.feditstatus").append('<option value="QC OK">QC OK</option>'); 
                          @endpermission
                      
                          // $("input.feditstatus").val('QC OK');

                     }
                      else if ( outputArray[0] == 'QC OK') {
                              $("#editdtlmodalwindow select.feditstatus").append('<option value="Completed">Completed</option>'); 
                      
                             //$("input.feditstatus").val('Completed');

                     }

                    if ( outputArray[0] == 'Rev-Alloted') {
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-QC Pending">Rev-QC Pending</option>'); 
                      
                           //$("input.feditstatus").val('Rev-QC Pending');

                     }
                     else if ( outputArray[0] == 'Rev-QC Pending') {
                        @permission('do.qc.ok')  
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-QC OK">Rev-QC OK</option>'); 
                        @endpermission
                           //$("input.feditstatus").val('Rev-QC OK');

                     }
                      else if ( outputArray[0] == 'Rev-QC OK') {
                        
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-Completed">Rev-Completed</option>'); 
                           //$("input.feditstatus").val('Rev-Completed');

                     }

                       if ( outputArray[0] == 'Ch-Alloted') {
                        
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC Pending">Ch-QC Pending</option>'); 
                           //$("input.feditstatus").val('Ch-QC Pending');

                     }
                     else if ( outputArray[0] == 'Ch-QC Pending') {
                         $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC OK">Ch-QC OK</option>'); 
                      
                          // $("input.feditstatus").val('Ch-QC OK');

                     }
                      else if ( outputArray[0] == 'Ch-QC OK') {
                        
                           $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-Completed">Ch-Completed</option>'); 
                           //$("input.feditstatus").val('Ch-Completed');

                     }


                }


                //return outputArray;
  });


// file name  changes
//$("ul#m1 li").click(function() {
@permission('edit.file.name')
$('#laraorder tbody').on('dblclick', 'li.link1', function () {

   // alert(this.id); // id of clicked li by directly accessing DOMElement property
   // alert($(this).attr('id')); // jQuery's .attr() method, same but more verbose
  //  alert($(this).html()); // gets innerHTML of clicked li
    //alert($(this).text()); // gets text contents of clicked li

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
              });  
    

     ///  file name  changes
     var target = $(this);
     
            
            var filename = $(this).text();
           // alert(filename);
            var dtlid= (target).next('.fid').val();
           // alert(dtlid);
            $( "#newfiledialog" ).dialog({
               
            title : "Change File Name",
            resizable: true,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'slide',
            hide: 'slide',
            width: 300,
            height:325,
            center: true,
            position: {
                       my: "left",
                       at: "center",
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
   
              var newfilename = $('#newfiledialog .filename2').val();
                       

                        // alert( oldnotes + newnotes+ _token);

              var formData = {
                             
                            newfilename: newfilename,
                            dtlid: dtlid
                            
                        }
                            
               //alert(dataString);
                $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updatechildfile",
                            data: formData,
                            success: function(result)
                            { 
                            console.log(result[0].msg) ; 
                             //$( "#notedialog .success" ).html("Data Updated Successfully");  
                              
                             //table.page(currentPageIndex).draw(false);
                             // table.row( $rowid ).scrollTo();
                                table.ajax.reload();

                            }
                        });

                     setTimeout(function(){
                               $('#newfiledialog').dialog('close');                
                                }, 300); 
                               // table.ajax.reload();
                              //table.page(currentPageIndex).draw(false);
                              //table.row( $rowid ).scrollTo();
                               
                          //return false ;

              },
 
    
              },
      
              ],

        
             create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                       // $( "#statusdialog" ).dialog("close");
                   });
        },
          close : function() {
             $( this ).dialog( "close" ); 
          },
          open: function(event, ui) {
            var dialog = $(event.target).parents(".ui-dialog.ui-widget");
            var buttons = dialog.find(".ui-dialog-buttonpane").find("button");

            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

        
            var AddButton = buttons[0];
        
            $(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
            $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#notedialog .newnotes").focus();
           
            //$(this).find('.ui-dialog-titlebar-close').blur();
           
        
            },

                });


                $( "#newfiledialog" ).dialog("open");
                $( "#newfiledialog .filename1" ).val( filename );
                 $( "#newfiledialog .filename2" ).val( filename );
               
                // alert(id1);
                $( "#newfiledialog .fileid" ).val( dtlid ); 
                // table.ajax.reload(); 
      

         //// file name changes


});
  @endpermission
    
$('#laraorder tbody').on('dblclick', 'td', function () {
        
      //var id1 = $(this).closest('tr');
        //   alert(id1.html());
     // debugger;
        var table = $('#laraorder').DataTable();
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
                     
//user allocation logic from order table
if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'Allocation') {

      //alert(table.cell( this ).index().name);
             //alert("Do you want to change allocation");
            // return false;
          
            $('#dropDownId').val('');
            if (($(this).closest('tr').has('td.donothing').length) > 0 ) { 
                  // alert("No Rights to Modify Allocation, Contact Admin");
                  Swal.fire({
                              type: 'error',
                              title: 'Error',
                              text: 'No Rights to Modify Allocation, Contact Admin'
                                          
                          })
                  return false;

            }

            var file_count = $(this).closest('tr').find('td.cfilecount').text();
          
            if (file_count > 1 ) {
                // alertify.error('Direct Changes not allowed, More than one file exist');
                  Swal.fire({
                              type: 'error',
                              title: 'Error',
                              text: 'Direct Changes not allowed, More than one file exist'
                                          
                          })

                 return false;
            }

            var table = $('#laraorder').DataTable();
            var target = $(this);
            var currentPageIndex = table.page.info().page;

            //var id1 = $(this).closest('tr').find('td:eq(20)').text(); not working on column hide - column no changes
            var id1 = $(this).closest('tr').find('td.fooid').text();
            //alert(id1);
            var alloc = $(this).closest('tr').find('td.editalloc').text();
            //alert(alloc);
            //$('#dropDownId').val('harish');
        

            $( "#allocdialog" ).dialog({
               
                    title : "Select Designer",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show : "slide",
                    hide: "slide",
                    width: 400,
                    height: 500,
                     // position: {
                     //   my: "left",
                     //   at: "right",
                     //   of: target
                     //          },

                    
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
                                   // console.log(selText);
                                    //$('#allocdialog .allocname').append(selText+', ');
                                    //$('#allocdialog .allocname').val(selText+', ');
                                      var input = $("#allocdialog .allocname");
                                      input.val(input.val() + selText+', ');
                                  }
                        });
                       
                        //alert($("#allocdialog .allocname").val());
                        var newallocnm = $("#allocdialog .allocname").val();
                        if(!newallocnm){
                            Swal.fire({
                              type: 'error',
                              title: 'Error',
                              text: 'Please Select Designer'
                                          
                          })
                          
                          return false;
                        
                        }

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
                                Swal.fire({
                                          type: 'error',
                                          title: 'Error..',
                                          text: result[0].msg
                                          
                                    })
                            }
                              table.page(currentPageIndex).draw(false);
                            
                                                           
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
                      $("#allocdialog").empty();

                      $("#allocdialog").append('<select name="allocation1[]" id="dropDownId" multiple="" class="fooalloc form-control ">@foreach($users as $key=>$c)<option value="{{$key}}">{{$c}}</option>@endforeach</select>  <input type="hidden" class="allocid" name="id" id="id" value=0 /> <input type="hidden" class="allocname" value=""/>')
                    },
                       create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                        $( "#statusdialog" ).dialog("close");
                   });
        },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
            
            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

                    $('#dropDownId').val(alloc.split(','));
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
                   
                   
            
                    },

                });

            var multipleCancelButton = new Choices('#dropDownId', {
                     removeItemButton: true,
                      maxItemCount:15,
                     // searchResultLimit:5,
                     // renderChoiceLimit:5
                 });
             $( "#allocdialog" ).dialog("open");
             //table.ajax.reload(); 
         }

        //  notes  changes
       @permission('file-note.modify') 
        if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'File Note') {
             // alert( table.cell( this ).data() );

            var target  = $(this);
            var oldnotes = table.cell( this ).data();
            //alert(oldnotes);
            var re = /<br *\/?>/gi;
            var oldnotes1 = oldnotes.replace(re,"\n");
            var currentPageIndex = table.page.info().page;
           
          

            var file_count = $(this).closest('tr').find('td.cfilecount').text();

            // if (file_count > 1 ) {
            //      alertify.error('Direct Changes not allowed, More than one file exist');

            //      return false;
            // }
                
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
                             // table.row( $rowid ).scrollTo();
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
             create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                        $( "#statusdialog" ).dialog("close");
                   });
        },
          open: function(event, ui) {
            var dialog = $(event.target).parents(".ui-dialog.ui-widget");
            var buttons = dialog.find(".ui-dialog-buttonpane").find("button");

            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

        
            var AddButton = buttons[0];
        
            $(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
            $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#notedialog .newnotes").focus();
           
            //$(this).find('.ui-dialog-titlebar-close').blur();
           
        
            },

                });

                $( "#notedialog" ).dialog("open");
                $( "#notedialog .oldnotes" ).text( oldnotes1 );
                // alert(id1);
                $( "#notedialog .noteid" ).val( key );
                // table.ajax.reload(); 
         }

     @endpermission

@permission('vendor.edit')
    if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'Vendor') {
   
    var target = $(this);
         $( "#vendorddialog" ).dialog({
               
            title : "Select Vendor",
            resizable: true,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'slide',
            hide: 'slide',
            width: 200,
            height:200,
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
   
              var vendor = $('#vendorddialog .vendorddialogvalue').val();
         
           
                       

                        // alert( oldnotes + newnotes+ _token);

              var formData = {
                            id:  key, 
                            vendor1: vendor,
                          
                           
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
                          
                             // table.row( $rowid ).scrollTo();
                                 table.ajax.reload();

                            }
                        });

                     setTimeout(function(){
                               $('#vendorddialog').dialog('close');                
                                }, 300); 
                               // table.ajax.reload();
                              //table.page(currentPageIndex).draw(false);
                              //table.row( $rowid ).scrollTo();
                               
                          //return false ;

              },
 
    
              },
      
              ],

          close : function() {
                  $( this ).dialog( "close" ); 
      
          },
             create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                       
                   });
        },
          open: function(event, ui) {
            var dialog = $(event.target).parents(".ui-dialog.ui-widget");
            var buttons = dialog.find(".ui-dialog-buttonpane").find("button");

            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

        
            var AddButton = buttons[0];
        
            $(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
            $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#vendorddialog .vendorddialogvalue").focus();
           
            //$(this).find('.ui-dialog-titlebar-close').blur();
           
        
            },

                });

                $( "#vendorddialog" ).dialog("open");
  }   
@endpermission 
@permission('edit.file.type')
  if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'File Type') {
    var target = $(this);
         $( "#filetypeddialog" ).dialog({
               
            title : "Select File Type",
            resizable: true,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'slide',
            hide: 'slide',
            width: 200,
            height:200,
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
   
              var filetype1 = $('#filetypeddialog .ftype').val();
         
           
                       

                        // alert( oldnotes + newnotes+ _token);

              var formData = {
                            id:  key, 
                            filetype1: filetype1,
                          
                           
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
                          
                             // table.row( $rowid ).scrollTo();
                                 table.ajax.reload();

                            }
                        });

                     setTimeout(function(){
                               $('#filetypeddialog').dialog('close');                
                                }, 300); 
                               // table.ajax.reload();
                              //table.page(currentPageIndex).draw(false);
                              //table.row( $rowid ).scrollTo();
                               
                          //return false ;

              },
 
    
              },
      
              ],

          close : function() {
                  $( this ).dialog( "close" ); 
      
          },
             create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                       
                   });
        },
          open: function(event, ui) {
            var dialog = $(event.target).parents(".ui-dialog.ui-widget");
            var buttons = dialog.find(".ui-dialog-buttonpane").find("button");

            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

        
            var AddButton = buttons[0];
        
            $(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
            $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#filetypeddialog .ftype").focus();
           
            //$(this).find('.ui-dialog-titlebar-close').blur();
           
        
            },

                });

                $( "#filetypeddialog" ).dialog("open");
              
  }
  @endpermission 
@permission('stitch.modify')
   rowData = table.row( $(this).parents('tr') ).data();
  if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'Stiches' && rowData.file_type == 'Digitizing') {
 
     var target = $(this);
    
         $( "#stichesddialog" ).dialog({
               
            title : "Stiches Count",
            resizable: true,
            modal: true,
            autoOpen:false,
            closeButton:true,
            show: 'slide',
            hide: 'slide',
            width: 200,
            height:250,
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
   
              var stitchvalue = $('#stichesddialog .stichesddialogvalue').val();
         
           
                       

                        // alert( oldnotes + newnotes+ _token);

              var formData = {
                            id:  key, 
                            stitchvalue: stitchvalue,
                          
                           
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
                          
                             // table.row( $rowid ).scrollTo();
                                 table.ajax.reload();

                            }
                        });

                     setTimeout(function(){
                               $('#stichesddialog').dialog('close');                
                                }, 300); 
                               // table.ajax.reload();
                              //table.page(currentPageIndex).draw(false);
                              //table.row( $rowid ).scrollTo();
                               
                          //return false ;

              },
 
    
              },
      
              ],

          close : function() {
                  $( this ).dialog( "close" ); 
      
          },
             create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                       
                   });
        },
          open: function(event, ui) {
            var dialog = $(event.target).parents(".ui-dialog.ui-widget");
            var buttons = dialog.find(".ui-dialog-buttonpane").find("button");

            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.html('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');

        
            var AddButton = buttons[0];
        
            $(AddButton).addClass("btn btn-small btn-primary");
            
            //$(AddButton).blur();
            $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");
            $("#stichesddialog .stichesddialogvalue").focus();
           
            //$(this).find('.ui-dialog-titlebar-close').blur();
           
        
            },

                });

                $( "#stichesddialog" ).dialog("open");
  }
 
  @endpermission

});

//logic for changing  allocation on 28-05-20

 // above  logic  for edit dtl records      

 // below logic  for order status
 $(document).on("click", ".editstatus", function(e){
   e.preventDefault();
   //alert("edit status") ;
  // debugger;

    

    @permission('orderstatus.modify')
    @else
           toastr.info("You Don't have Permission to Edit");
           return false;
    @endpermission

 
    var table = $('#laraorder').DataTable();
  var currentPageIndex = table.page.info().page;
    
    var $rowid = table.fixedColumns().rowIndex();
    //alert($rowid);
    //$rowid = table.row( this ).index() ;
    //alert($rowid);
    //alert('hi edit');
       

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    })

    var target = $(this);
    var _token = $(this).parents('form:first').find('input[name=_token]').val();
    var url = $(this).parents('form:first').attr('action');
    var id = $(this).parents('form:first').find('input[name=id]').val();
   // var oldprice = $(this).parents('form:first').find('input[name=oldprice]').val();
    var status1 = $(this).text();
    var filetype = '';
    var alloc1 =  '' ;
    var oldstatus = '';
    var oldstat2 = '';
    var oldnotes = '';
    var oldprice = 0;
    var currentstat = '';
     //alert(id);
    // alert(oldprice);
     $("#statusdialog .statusid").val(id);


     // logic created for getting old notes on  27/11/19
      $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('orders/getnotes') }}",
            data: { id: id},
            success:function(data)
                  {
                     //console.log(data.notes);
                     oldnotes  = data.notes[0].note ;
                     oldprice  = data.notes[0].file_price ;
                     oldstat2 = data.notes[0].old_status ;
                     vclient_specific = data.notes[0].client_specific ;

                     var re = /<br *\/?>/gi;
                     oldnotes = oldnotes.replace(re,"\n");
                   
                    $("#statusdialog .coldnotes").val(oldnotes);
                    $("#statusdialog .oldprice").val(oldprice);
                    $("#statusdialog #oldstatus").val(oldstat2);
                    $("#statusdialog .client_specific").val(vclient_specific);

                    var currentstat =   $("#statusdialog .ostatus").val();
                    if (currentstat == 'Cancel' || currentstat == 'On Hold' ||
                     currentstat == 'Duplicate Entry' )
                        {
                          oldstatus1 = 'Prv.Status:'+ oldstat2 ;
                          $("#statusdialog select.ostatus").append('<option value="'+oldstat2+'">'+oldstatus1+'</option>'); 
                          
                        }
                                         //$("#clienthelp tbody").html(data);
                  }
        
        });

       //   debugger;
     // logic created for getting old notes
    $(".fbody").find("tr").each(function(){
       var testid = $(this).find("td.fooid").text();
       //alert(testid);
       if (id == testid) {
          $(this).addClass('selected').siblings().removeClass('selected'); 
          //Important fix for allocation
          //debugger;
           alloc1  =  $(this).find("td.editalloc").text();
           //alert(alloc1);
          filetype = $(this).find("td.ftype").text();
          //oldnotes = $(this).find("td.oldstat1").text();
         
              //  alert(filetype);

          if ( status1 == 'Alloted' && filetype =='Vector'  && (alloc1.indexOf('0') > 0 ||  alloc1.indexOf('not allocated') >0 ))
          {
                  //alert("Please Allocate Files");
                   Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Please Select Designer First..'
                                          
                                    })

                  e.stopPropagation();
                  return false;
          }

          if ( status1 == 'Alloted'  && filetype == 'Vector'  && (alloc1 == 'not allocated'  || alloc1 == '0') )
          {
                Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Please allocate files'
                                          
                                    })
              e.stopPropagation();
               //alert("Please Allocate Files");
               return false;

          }
          //Important fix for allocation
          //$(this).addClass("selected");
          return false;

       }
    });
     //alert(filetype);
       //  $.ajaxSetup({
       //      headers: {
       //              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
       //            }
       // });
             
       $( "#statusdialog" ).dialog({
               
                    title : "Change Status",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    left: 1000,
                    width: 200,
                    height:180,
                    position: {
                       my: "right",
                       at: "center",
                       of: target
                              },


                    buttons: [
                                {
                        text: "Submit",
                        title: "Submit",
                        id: 'stat',
                        class: 'fmy',
                        tabindex: '2',
                        // form: "client_form_submit",
                        click: function() {
                        // debugger;
  
                        var a1 = 0;
                        var a2 = 0;
                        var a3 = 0;  
                        var notes ='';

               
                        var status2  = $("#statusdialog .ostatus").val();
                        var _token   = $("#statusdialog .token").val();
                        var a1 =  $("#filepricedialog .old_price1").val();
                        var a2 =  $("#filepricedialog .add_price").val();
                        var new_target_date2 = $("#new_target_date2").val();
                        
                        var revnotes  = $("#revisiondialog .rev_note").val();
                        var rev_mistake  = $("#revisiondialog #rev_mistake").val();
                        var rev_mistake_reason  = $("#revisiondialog #rev_mistake_reason").val();
                        var mistake_designer_name = '' ;
                        var mistake_lead_name = '' ;
                      
                        if ( status2 == 'Completed' || status2 == 'Ch-Completed' || status2 == 'Rev-Completed') {

                             vclient_specific = $("#statusdialog .client_specific").val();
                               // alert(vclient_specific);
                             if (vclient_specific == undefined || vclient_specific == null || vclient_specific == "") {
                                             console.log(vclient_specific);
                             }
                              else { 
                                
                                Swal.fire("Client Specific Information", vclient_specific, "success")
                             }
                             
                        }
                       
                       if  (status2 == 'Revision') {
                               
                               mistake_lead_name      =  $("#revisiondialog #mistake_lead_name").val();
                               mistake_designer_name = $("#revisiondialog #mistake_designer_name").val(); 
                       }
                                           

                        if  (status2 == 'Rev-QC OK' )
                        {  

                          //alert($( "#statusdialog select.ostatus" ).val());
                         //debugger;
                          
                           if ( $("#filereason  select#rev_mistake option:selected").html() == "Select")
                                   {
                                         // alert('Revision Note cannot be blank');
                                         // return false;

                                       //   $("#statusdialog select.ostatus").append('<option value="'+oldstat2+'">'+oldstatus1+'</option>'); 
                                         
                                           Swal.fire({
                                               type: 'error',
                                               title: 'Error',
                                               text: 'Select  Mistake Caused By'
                                          
                                            })
                                          
                                            return false;
                                           //  $( this ).dialog( "close" );
                                   }
                                    
                                  else if ($("#filereason  textarea#rev_mistake_reason").val() == "" ){

                                    
                                        
                                        Swal.fire({
                                               type: 'error',
                                               title: 'Error',
                                               text: 'Reason cannot be blank'
                                          
                                            })
                                          
                                            return false;

                                  } 

                           

                            rev_mistake  = $("#filereason  select#rev_mistake option:selected").html();
                             rev_mistake_reason  = $("#filereason  textarea#rev_mistake_reason").val();

                        }

                        if (status2 == 'Changes') {
                            revnotes  =  $("#filepricedialog textarea.rev_note").val();
                            new_target_date2 = $("#filepricedialog #new_target_date2").val();
                        }
                       
                       // alert(revnotes);
                                          
                        if (a1>=0 && a2 >= 0 && a1 != '' && a2 !='')
                        {
                           var a3 =   parseFloat(a1) + parseFloat(a2);  
                        }
                        
                        
                        if (typeof(a3) == 'undefined' || a3 == null ) {
                           a3 = 0 ;
                        }
                      
                        
                        var targettime2 = '';
                        if (status2 =='Revision') {
                            targettime2 =  $("#revisiondialog .new_target_date2").val();
                           // alert(targettime2);
                         }
                         //alert( newalloc + _token);

                         //var _token = $('input[name=_token]').val();

                        var formData = {
                            id:  id, 
                            file_type: filetype,
                            alloc1: alloc1,
                            status2: status2,
                            targettime2: targettime2,
                            old_price: a1,
                            add_price: a2,
                            a3: a3,
                            new_target_date2: new_target_date2,
                            revnotes: revnotes,
                            rev_mistake: rev_mistake,
                            rev_mistake_reason: rev_mistake_reason,
                            mistake_lead_name: mistake_lead_name,
                            mistake_designer_name: mistake_designer_name,
                            _token: _token
                        }
                            
                         //alert(dataString);
                        // debugger;
                         var status2 = { 'Invalid' :'Invalid' };
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateorderstatus",
                            data: formData,
                            success: function(result)
                            { 
                              res = result[0].msg;
                              status2 = result[0].status2;
                              if ( result[0].oldstatus != null)
                              {
                                     oldstatus = result[0].oldstatus;
                              }
                              console.log(status2);
                              if (res == 'Updated successfully') {
                                  console.log(res);
                              }
                             // else {
                                //  alert(res);
                                  //alertify.confirm(res);
                                 //toastr.info(res);
                                 // Swal.fire({
                                  //        type: 'error',
                                  //        title: result,
                                 //         text: res
                                          
                                //    })
                                 
                             // }
                            console.log(result[0].msg) ; 
                            // $(".delmsg").html(res).fadeOut( "slow");
                             $(".delmsg").html(res).fadeOut('slow');
                             $( "#statusdialog .success" ).html("Data Updated Successfully"); 

                            var listitems = '';
                             $( "#statusdialog .ostatus" ).html(' '); 
                              $.each(status2, function(key, value){
                                 // console.log(key+value);
                                listitems += '<option value="' + key + '">' + value + '</option>';
                                    });
                              //$select.append(listitems);
                           
                           // $( "#statusdialog .ostatus" ).append(listitems); 
                             
                             //table.ajax.reload();
                             table.page(currentPageIndex).draw(false);
                              $(".fbody").find("tr").each(function(e){
                                  // debugger;
                                  var testid = $(this).find("td.fooid").text();
                                  //alert(testid);
                                  //alert(id);
                                  if (id === testid) {

                                       $(this).addClass('selected'); 
                                       return false;

                                      }
                              });
                              

                            }
                        });
                     
                       
                     setTimeout(function(){
                               $('#statusdialog').dialog('close');                
                                }, 300); 
                      //table.ajax.reload(); 
                      
    
                   
                    return false ;

                     },
 
        
                },
            
                ],


                    close : function() {
                          //   $("#filepricedialog .old_price1").val("");
                          // $("#filepricedialog .add_price").val("");
                          // $("#new_target_date2").val("");
                          // $(".coldnotes").val("");

                        
                    },
                       create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                        $( "#statusdialog" ).dialog("close");
                   });
        },
                    open: function(event, ui) {
                        
                        //$('.allocid').val(id1);
                     //  $("#dropDownId  option:selected").text("harish");
                    // $("#dropDownId").find("option[text='harish']").attr("selected", true); 
                    //$('#strings').val(values.split(','));
                   // $('#status').val(status1);
                   
                    //alert(status1);
                    //debugger;
                   $("#statusdialog select.ostatus").empty();
                   // code added for dynamic look
                   //  debugger;

                   // if ( oldstatus == 'undefined' || oldstatus == ""  )
                   // {
                   //      oldstatus =$("#statusdialog #oldstatus").val();
                          
                   // }
                    
                  if (status1 == 'Cancel')  {

                              //   alert($("#statusdialog #oldstatus").val());
                            //alert(oldstatus);
                           oldstatus1 = 'Prv.Status:'+ oldstatus ;
                        $("#statusdialog select.ostatus").append('<option value="'+status1+'">'+status1+'</option>'); 
                        $("#statusdialog select.ostatus").append('<option value="On Hold">On Hold</option>');    
                        $("#statusdialog select.ostatus").append('<option value="Approved">Approved</option>'); 
                  }
                  else   if (status1 == 'On Hold')  {
                           oldstatus1 = 'Prv.Status:'+ oldstatus ;
                        $("#statusdialog select.ostatus").append('<option value="'+status1+'">'+status1+'</option>'); 
                        // $("#statusdialog select.ostatus").append('<option value="'+oldstatus+'">'+oldstatus1+'</option>'); 
                        $("#statusdialog select.ostatus").append('<option value="Cancel">Cancel</option>');    
                      
                  }
                  else 
                    if (status1 == 'Duplicate Entry')  {
                           oldstatus1 = 'Prv.Status:'+ oldstatus ;
                        $("#statusdialog select.ostatus").append('<option value="'+status1+'">'+status1+'</option>'); 
                       
                        $("#statusdialog select.ostatus").append('<option value="Cancel">Cancel</option>');    
                        $("#statusdialog select.ostatus").append('<option value="Approved">Approved</option>'); 
                        $("#statusdialog select.ostatus").append('<option value="UnApproved">UnApproved</option>');
                  }
                  else {


    $("#statusdialog select.ostatus").append('<option value="Quote">Quote</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Approved">Approved</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Alloted">Alloted</option>'); 
    $("#statusdialog select.ostatus").append('<option value="QC Pending">QC Pending</option>'); 
    $("#statusdialog select.ostatus").append('<option value="QC OK">QC OK</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Completed">Completed</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Revision">Revision</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Changes">Changes</option>'); 
    $("#statusdialog select.ostatus").append('<option value="UnApproved">UnApproved</option>');
    $("#statusdialog select.ostatus").append('<option value="Complain">Complain</option>'); 
    $("#statusdialog select.ostatus").append('<option value="No Response">No Response</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Rev-Alloted">Rev-Alloted</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Rev-QC Pending">Rev-QC Pending</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Rev-QC OK">Rev-QC OK</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Rev-Completed">Rev-Completed</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Ch-Alloted">Ch-Alloted</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Ch-QC Pending">Ch-QC Pending</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Ch-QC OK">Ch-QC OK</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Ch-Completed">Ch-Completed</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Cancel">Cancel</option>'); 
    $("#statusdialog select.ostatus").append('<option value="On Hold">On Hold</option>'); 
    $("#statusdialog select.ostatus").append('<option value="Duplicate Entry">Duplicate Entry</option>'); 
    }
                 


                 // code added for dynamic look
                 // alert('open'+ status1);

                    
                    $("#statusdialog select.ostatus").val(status1); 
                    
                    var dialog = $(event.target).parents(".ui-dialog.ui-widget");
                    var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                    var AddButton = buttons[0];
            
                    $(AddButton).addClass("btn btn-small btn-primary navbar-btn");
                    $(AddButton).html("<i class='icon-plus-sign'></i>   Submit");

                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                    //$(this).find('.ui-dialog-titlebar-close').prop("tabindex", "3");

                    //$("#statusdialog #status").change(function(){
                      //      alert("changed");  
                            //$(this).closest( ".ui-dialog" ).find(":button").addClass("ui-state-focus");
                       //   $(this).closest( ".ui-dialog" ).find(".fmy").addClass("ui-state-focus");
                       //   $(this).closest( ".ui-dialog" ).find(".fmy").removeClass("btn-primary");
                       //   $(this).closest( ".ui-dialog" ).find(".fmy").addClass("blink_me");
                       //   $(this).closest( ".ui-dialog" ).find(".fmy").focus();
                   //});

                    
                 },
               });

              
             $( "#statusdialog" ).dialog("open");
                 //   $("#statusdialog").dialog("widget").position({
                 // my: 'left top',
                // at: 'right',
                  // of: window
                //});

               $("#statusdialog select.ostatus").val(status1);
             $("#statusdialog #status").val(status1); 
              
                $("#statusdialog .oldprice").val(oldprice);
                $("#statusdialog .ftype1").val(filetype);

               // $("#statusdialog .coldnotes").val(oldnotes);

            // if ( status1 =='Approved' ){

            //     // alert('please wait approved');

            //       $("#statusdialog .ostatus").append(['All is Well']);
            //                              }    
         var previous=$("#statusdialog .ostatus").val();
                 if (previous =='Quote') {
                   
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                   $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                   $('#statusdialog .ostatus option[value="Changes"]').remove();
                  
                
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();    
                  $('#statusdialog .ostatus').empty();

                  
                   $('#statusdialog .ostatus').append('<option value="Quote">Quote</option>');
                   $('#statusdialog .ostatus').append('<option value="Approved">Approved</option>');
                   $('#statusdialog .ostatus').append('<option value="Cancel">Cancel</option>');
                   $('#statusdialog .ostatus').append('<option value="On Hold">On Hold</option>');
                   $('#statusdialog .ostatus').append('<option value="Duplicate Entry">Duplicate Entry</option>'); 
                
                $('#statusdialog .ostatus').filter(function() {
                                return  $.trim(this.value).length == 0;
                                        }).remove();


              }

              if (previous =='Approved') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
              }

               if (previous =='UnApproved') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
              }

               if (previous =='No Response') {
                       
                    $('#statusdialog .ostatus option[value="Quote"]').remove();  
                    $('#statusdialog .ostatus option[value="Requote"]').remove(); 
                    $('#statusdialog .ostatus option[value="Followup"]').remove();
                    $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Revision"]').remove();
                    $('#statusdialog .ostatus option[value="Complain"]').remove();
                    $('#statusdialog .ostatus option[value="Changes"]').remove();
                    $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="On-Hold"]').remove();
                    $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  }

                if (previous =='Alloted') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='QC Pending') {
             
                
               @permission('do.qc.ok')
               @else
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                @endpermission
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='QC OK') {
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Completed') {
                  // alert('completed');

                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="On Hold"]').remove();
                  
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                   
            
        
                  
              }
               if (previous =='Changes') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                      $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                 
                 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Revision"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Revision') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                $('#statusdialog .ostatus option[value="Completed"]').remove();
                $('#statusdialog .ostatus option[value="Changes"]').remove();
                $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                         $('#statusdialog .ostatus option[value="On Hold"]').remove();
                 
                 
              }

              if (previous =='Rev-Alloted') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                 
              }

              if (previous =='Rev-QC Pending') {
                 @permission('do.qc.ok')
                 @else
                    $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                 @endpermission
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
               $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
                 
              }

              if (previous =='Rev-QC OK') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Rev-Completed') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                   $('#statusdialog .ostatus option[value="Alloted"]').remove();    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Completed"]').remove();
               
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                  
                 
              }
 
            if (previous =='Ch-Alloted') {
                            $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                     $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                 
              }

              if (previous =='Ch-QC Pending') {
                 @permission('do.qc.ok')
                 @else
                    $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                 @endpermission
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  
                       $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                  
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Ch-QC OK') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();

                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove(); 
                 
                 
              }

              if (previous =='Ch-Completed') {
                 //debugger;
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="On Hold"]').remove();
                
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  

                 
              }

});
 

 // above  logic for  order status  on 25-05-20  
 $(document).on("focusin", "#dtltable select.childstatus", function(e){  

    
            // Store the current value on focus and on change
           // alert("hello childstatus");
        previous = this.value;
      
    }).on("change", "#dtltable select.childstatus", function(e) {    
        // Do something with the previous value after the change
        var status2 = this.value;
  
         if (status2=='Revision'  ||  status2 == 'Changes') {
              e.stopPropagation();
              return false;
        }
        var  newst = $(this);

        //alert($(newst).val());
        var currentPageIndex = table.page.info().page;

        var childid = $(this).closest('tr').find('.ochildid').val();
     
        // debugger;

        // Make sure the previous value is updated
        @permission('alloc.qcpending')
                    //alert('alloc-qcpending');
                     // alert(previous);
                    if( previous == 'Alloted' || previous == 'Ch-Alloted' || previous == 'Rev-Alloted') {
 
                          if ($(this).val() != 'QC Pending' && $(this).val() != 'Rev-QC Pending'  && $(this).val() != 'Ch-QC Pending' ) {


                          // alert('Designer are allowed only to change from Allocated to QC Pending');
                            swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })
                              e.stopPropagation();
                           return false ;
                         }
                         
                     }
         @endpermission
          var allocname1  =   $(newst).closest('tr').find('select.selectalloc').val();
          
          var formData = {
                            childid:  childid, 
                            status2: status2,
                            allocname1:allocname1
                            //_token: _token
                           
                        }
                           
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url: "{{ URL::to('orders/orderdtlstatus') }}",
                            data: formData,
                            success: function(result)
                            { 
                              res = result[0].msg ;
                              console.log(result);
                              oldstatus = result[0].status;
                             // alert(oldstatus);
                              if (res == "Updated successfully") {
                                 console.log(result[0].msg);
                                  
                                   $(newst).prop('disabled', 'disabled');
                                   table.page(currentPageIndex).draw(false);
                              }
                              else {
                                  //alert(res);
                                  //alertify.confirm(res);
                                     Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

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
// below  logic for changing status on 26-05-20
function file_price_cal(){
    
    var oldprice = $("#statusdialog .oldprice").val();
    //alert(oldprice);
   // alert($("#statusdialog .coldnotes").val());

    var oldnotes = $("#statusdialog .coldnotes").val();

    $("#filepricedialog").dialog( { 
              title : "Update File  Changes",
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
                                  //debugger;
                                   if ( $("#filepricedialog .new_target_date2").val() == "")
                                   {
                                         //alert('Target date cannot be blank');
                                         
                                         swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Target date cannot be blank'
                                        
                                         })

                                          return false;

                                           
                                   }
                                    
                                  else {
                                          //alert('ok close');
                                           $( this ).dialog( "close" );
                                       
                                       
                                     }

                               // code added
                                var a1 = 0;
                        var a2 = 0;
                        var a3 = 0;                                                              
                       
                        var a1 =  $("#filepricedialog .old_price1").val();
                        var a2 =  $("#filepricedialog .add_price").val();
  
                        var new_target_date2 = $("#filepricedialog #new_target_date2").val();

                                          
                        if (a1>=0 && a2 >= 0 && a1 != '' && a2 !='')
                        {
                           var a3 =   parseFloat(a1) + parseFloat(a2);  
                        }
                        
                        
                        if (typeof(a3) == 'undefined' || a3 == null ) {
                           a3 = 0 ;
                        }
                      
                        
                        var targettime2 = '';
                       

                        // var formData = {
                        //    // childid:  childid, 
                        //     status2: status2,
                        //     old_price: a1,
                        //     a3: a3,
                        //     new_target_date2: new_target_date2,
                        //     _token: _token
                        // }

                        //    $.ajax({
                        //     type:"POST",
                        //     async: true,
                        //     datatype:"JSON",
                        //     processData: false,
                        //     url: "{{ URL::to('orders/orderdtlstatus') }}",
                        //     data: formData,
                        //     success: function(result)
                        //     { 
                        //       var res = result[0].msg ;
                        //       var oldstatus = result[0].status ;
                        //       if (res == "Updated successfully") {
                        //            console.log(result[0].msg) ; 
                        //       }
                        //       else {
                        //            alert(res);
                        //            $(newst).val(oldstatus);
                        //           return false;
                        //       }
                        //       //$(".delmsg").html(res).fadeOut('slow');

                               
                        //     }
                        // });
                               

                               // code added

                            }
                          },
                          // {
                          //   text: "Calc",
                          //   click: function() {
                          //            cal_new_price();
                          //             return false;
                          //   }
                          // },




                        ],
                    

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                        //  $( "#statusdialog" ).dialog("close");
                    },
                     create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                        $( "#statusdialog" ).dialog("close");
                   });
        },
                    open: function(event, ui) {
                        
                   
                    var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                    //var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                   // var AddButton = buttons[0];
            
                    
                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                   

                    
                 },
               });

             $( "#filepricedialog" ).dialog("open");
            
           
             $("#filepricedialog .old_price1").val(oldprice);
             $("#filepricedialog .oldnotes").val(oldnotes);
             $("#filepricedialog .add_price").val(0);
              $("#filepricedialog .rev_note").val('');
              $("#filepricedialog  select#rev_mistake").val('0');
             $("#filepricedialog   #rev_mistake_reason").val('');
              $("#filepricedialog  #new_target_date2").html('');
              $("#filepricedialog .file_price2").val(0);
              $("#filepricedialog .file_price2").focus();
                 
             return false;
  }  
 

var previous='';

$("#statusdialog .ostatus").on('click', function () {
   // $(this).dblclick();

             var previous = $(this).find('option:selected').text();
             // if (previous == 'Changes') 
             //    {   
             //            file_price_cal(); 
             //     }
             //debugger;
            
            
             var ftype1  =  $("#statusdialog .ftype1").val();


             
             if ( ftype1 == 'Digitizing'  )
             {
               
                  if (previous =='No Response') {
                       
                    $('#statusdialog .ostatus option[value="Quote"]').remove();  
                    $('#statusdialog .ostatus option[value="Requote"]').remove(); 
                    $('#statusdialog .ostatus option[value="Followup"]').remove();
                    $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Revision"]').remove();
                    $('#statusdialog .ostatus option[value="Complain"]').remove();
                    $('#statusdialog .ostatus option[value="Changes"]').remove();
                    $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="On-Hold"]').remove();
                    $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  }
                  else if(previous =='Approved'){
                     $('#statusdialog .ostatus').append('<option value="Completed">Completed</option>');
                      $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  }
                
                  else {
                    $('#statusdialog .ostatus option[value="Requote"]').remove();  
                    $('#statusdialog .ostatus option[value="Followup"]').remove();
                    $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Revision"]').remove();
                    $('#statusdialog .ostatus option[value="Complain"]').remove();
                    $('#statusdialog .ostatus option[value="Changes"]').remove();
                    $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                  }
                
                }

              else  {
             
              
            
              if (previous =='Quote') {
                   
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                   $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                   $('#statusdialog .ostatus option[value="Changes"]').remove();
                  
                
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();    
                  $('#statusdialog .ostatus').empty();

                  
                   $('#statusdialog .ostatus').append('<option value="Quote">Quote</option>');
                   $('#statusdialog .ostatus').append('<option value="Approved">Approved</option>');
                   $('#statusdialog .ostatus').append('<option value="Cancel">Cancel</option>');
                   $('#statusdialog .ostatus').append('<option value="On Hold">On Hold</option>');
                   $('#statusdialog .ostatus').append('<option value="Duplicate Entry">Duplicate Entry</option>'); 
                
                $('#statusdialog .ostatus').filter(function() {
                                return  $.trim(this.value).length == 0;
                                        }).remove();


              }

              if (previous =='Approved') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
              }

               if (previous =='UnApproved') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
              }

               if (previous =='No Response') {
                       
                    $('#statusdialog .ostatus option[value="Quote"]').remove();  
                    $('#statusdialog .ostatus option[value="Requote"]').remove(); 
                    $('#statusdialog .ostatus option[value="Followup"]').remove();
                    $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Revision"]').remove();
                    $('#statusdialog .ostatus option[value="Complain"]').remove();
                    $('#statusdialog .ostatus option[value="Changes"]').remove();
                    $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  
                    $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="On-Hold"]').remove();
                    $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  }

                if (previous =='Alloted') {

                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='QC Pending') {
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='QC OK') {
                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                        $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Completed') {
                  // alert('completed');

                  $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="On Hold"]').remove();
                  
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                   
            
        
                  
              }
               if (previous =='Changes') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                      $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                 
                 
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Revision"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                    $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Revision') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                $('#statusdialog .ostatus option[value="Completed"]').remove();
                $('#statusdialog .ostatus option[value="Changes"]').remove();
                $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                         $('#statusdialog .ostatus option[value="On Hold"]').remove();
                 
                 
              }

              if (previous =='Rev-Alloted') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                 
              }

              if (previous =='Rev-QC Pending') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
               $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="Revision"]').remove();
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
                 
              }

              if (previous =='Rev-QC OK') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Rev-Completed') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                   $('#statusdialog .ostatus option[value="Alloted"]').remove();    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                   $('#statusdialog .ostatus option[value="Completed"]').remove();
               
                   $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                  
                 
              }
 
            if (previous =='Ch-Alloted') {
                            $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                     $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                 
              }

              if (previous =='Ch-QC Pending') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  
                       $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();
                  
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                   $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                  
                      $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
              }

              if (previous =='Ch-QC OK') {
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                       $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Completed"]').remove();
                     $('#statusdialog .ostatus option[value="Revision"]').remove();
                     $('#statusdialog .ostatus option[value="Changes"]').remove();

                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                  
                   $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-Completed"]').remove(); 
                 
                 
              }

              if (previous =='Ch-Completed') {
                 //debugger;
                      $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                    
                  $('#statusdialog .ostatus option[value="Quote"]').remove(); 
                  $('#statusdialog .ostatus option[value="Requote"]').remove();  
                  $('#statusdialog .ostatus option[value="Followup"]').remove();
                  $('#statusdialog .ostatus option[value="Alloted"]').remove();
                  $('#statusdialog .ostatus option[value="QC Pending"]').remove();
                  $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  $('#statusdialog .ostatus option[value="On Hold"]').remove();
                
                  $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
                  $('#statusdialog .ostatus option[value="Complain"]').remove();
                  $('#statusdialog .ostatus option[value="No Response"]').remove(); 
                  $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
                
                  $('#statusdialog .ostatus option[value="Completed"]').remove();
                
                  $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
                    $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                     $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                      $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  

                 
              }
            }
            

            // debugger;
             $('#statusdialog select.ostatus option')
                .filter(function() {
                             // alert('hi'); 
                          this.size=  $('#statusdialog select.ostatus option').length;
                        // alert('ggggff');
                       return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                  }).remove();
              
                       
       

    });


    $("#statusdialog .ostatus").on('focus', function () {
            // Store the current value on focus and on change
        previous = this.value;
      
              
               //     debugger;
         //   $('#statusdialog .ostatus').append('<option value="Premium">Premium</option>');
         //$("#statusdialog .ostatus").each(function() {

          var ftype1  =  $("#statusdialog .ftype1").val();
             
            
        // if ( ftype1 == 'Digitizing'  )
        //      {
        //          $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //            $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
                  
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //            $('#statusdialog .ostatus option[value="Changes"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
        //          }

        //      else  
        //       {     
         
        //    if (previous =='Quote') {

                
                  
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //            $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //            $('#statusdialog .ostatus option[value="Changes"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
        //       }

        //       if (previous =='Approved') {

        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();     
                 
        //       }

        //         if (previous =='Alloted') {

        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //            $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //            $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //                 $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='QC Pending') {
        //           $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //                 $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='QC OK') {
        //           $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
                    
        //                 $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='Completed') {
        //           // alert('completed');
        //           $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //                 $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }
        //        if (previous =='Changes') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                    
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //            $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //             $('#statusdialog .ostatus option[value="Completed"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='Revision') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //            $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //         $('#statusdialog .ostatus option[value="Completed"]').remove();
        //         $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
                 
        //       }

        //       if (previous =='Rev-Alloted') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Changes"]').remove();
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //            $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();

                 
        //       }

        //       if (previous =='Rev-QC Pending') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
                
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //        $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //           $('#statusdialog .ostatus option[value="Revision"]').remove();
        //            $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='Rev-QC OK') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //            $('#statusdialog .ostatus option[value="Completed"]').remove();
        //              $('#statusdialog .ostatus option[value="Revision"]').remove();
        //                $('#statusdialog .ostatus option[value="Changes"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //            $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //            $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='Rev-Completed') {
        //                $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //            $('#statusdialog .ostatus option[value="Alloted"]').remove();    
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //            $('#statusdialog .ostatus option[value="Completed"]').remove();
        //              $('#statusdialog .ostatus option[value="Revision"]').remove();
        //            $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
               
                 
        //       }
 
        //       if (previous =='Ch-QC Pending') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
                  
        //                $('#statusdialog .ostatus option[value="Completed"]').remove();
        //              $('#statusdialog .ostatus option[value="Revision"]').remove();
        //              $('#statusdialog .ostatus option[value="Changes"]').remove();
                  
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                
        //            $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
                  
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
                 
        //       }

        //       if (previous =='Ch-QC OK') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
        //                $('#statusdialog .ostatus option[value="Alloted"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Completed"]').remove();
        //              $('#statusdialog .ostatus option[value="Revision"]').remove();
        //              $('#statusdialog .ostatus option[value="Changes"]').remove();

        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //           $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
                  
        //            $('#statusdialog .ostatus option[value="Ch-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
                     
                 
                 
        //       }

            

        //       if (previous =='Ch-Completed') {
        //               $('#statusdialog .ostatus option[value="Approved"]').remove(); 
                    
        //           $('#statusdialog .ostatus option[value="Quote"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Requote"]').remove();  
        //           $('#statusdialog .ostatus option[value="Followup"]').remove();
        //           $('#statusdialog .ostatus option[value="QC Pending"]').remove();
        //           $('#statusdialog .ostatus option[value="QC OK"]').remove();
        //           $('#statusdialog .ostatus option[value="On Hold"]').remove();
        //           $('#statusdialog .ostatus option[value="Cancel"]').remove();
        //           $('#statusdialog .ostatus option[value="UnApproved"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Complain"]').remove();
        //           $('#statusdialog .ostatus option[value="No Response"]').remove(); 
        //           $('#statusdialog .ostatus option[value="Duplicate Entry"]').remove();
        //           $('#statusdialog .ostatus option[value="Completed"]').remove();
        //             $('#statusdialog .ostatus option[value="Ch-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Ch-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Ch-Completed"]').remove();
        //                $('#statusdialog .ostatus option[value="Rev-Alloted"]').remove();
        //             $('#statusdialog .ostatus option[value="Rev-QC Pending"]').remove();
        //              $('#statusdialog .ostatus option[value="Rev-QC OK"]').remove();
        //               $('#statusdialog .ostatus option[value="Rev-Completed"]').remove();
                  
                  
                 
        //       }
        //    }

                  

          //  }); 
           
         


    }).change(function(e) {
        // Do something with the previous value after the change
          changevalue = $(".ostatus").val();
            //debugger;
        //alert(oldprice);
      
          //alert('working..');
        // Make sure the previous value is updated
       
         
        // debugger;
            //$("#revisiondialog").dialog("destroy");
            //debugger;
               
             $( "#revisiondialog .rev_note").val('');
             $( "#revisiondialog select#rev_mistake").val('0');
             $( "#revisiondialog #rev_mistake_reason").val('');
             $("#revisiondialog #new_target_date2").html(''); 
             

     
      
        @permission('alloc.qcpending') 
                    // alert('alloc-qcpending');
                     // alert(previous);
                    if( ($(this).val() !== 'QC Pending') && (previous == 'Alloted')) {
                          //alert('Designer are allowed only to change from Allocated to QC Pending');
                            Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

                              e.stopPropagation();
                           return false ;
                         
            } 
        @endpermission    

        @if (Auth::user()->hasRole('Designer') && Auth::user()->level() <=11)
                 
                    if( ($(this).val() !== 'QC Pending') ) {

                        //  alert('Designer are allowed only to change from Allocated to QC Pending');
                          Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

                              e.stopPropagation();
                           return false ;
                         
            } 

        @endif

         @if (Auth::user()->hasRole('team.lead.designer') && Auth::user()->level() <=15)
                 //alert('ok');
            //         if( ($(this).val() !== 'QC OK') ) {
            //             //  alert('Designer are allowed only to change from Allocated to QC Pending');
            //               swal({
            //                               icon: 'error',
            //                               title: 'Error',
            //                               text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
            //                         })

            //                   e.stopPropagation();
            //                return false ;
                         
            // } 

        @endif
         
         
        @if( Auth::user()->level() > 12)
          
              //alert('not alloc qcpend ok');
              if( ($(this).val() == 'QC Pending') && (previous == 'Alloted')) {
                          //alert('Only Designer are allowed only to change from Allocated to QC Pending');
                           Swal.fire({
                                          type: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

                          e.stopPropagation();
                          return false ;
                           
                     }


         
        @endif


       if (changevalue == 'Revision')
       {
            revision_update();
            
       }

        if ( changevalue == 'Rev-QC OK'  )
       {
            revision_qc_ok_update();
            
       }
       
       
       if (changevalue == 'Changes') 
       {   

          file_price_cal(); 
                      
       }

       

        return true;
        
    });



// above logic for changing status on 26-05-20
	  
  });
// added datepicker

 
    $("#order_date_time").datetimepicker();
    $("#order_us_date").datetimepicker();
    $("#order_date").datetimepicker();
    $("#ord_comp_date").datetimepicker();
    $("#order_us_dt").datetimepicker();
    $('#modal-update #order_date_time').datetimepicker(); 
    $('#modal-update #order_us_date').datetimepicker(); 
    $("#target_completion_time2").datetimepicker({ minDate: 0});
     $("#new_target_date2").datetimepicker( {minDate: 0});



// added datepicker above

// added to get designer names in revision on 27-05-20


$(document).on("change", ".getdesign", function(e){
            
         if (this.value == 'Designer') {   
             var id = $("#statusdialog .statusid").val();
             
             

            $.ajax({
              type: "GET",
              cache: false,
              url: "{{ URL::to('orders/getdesign') }}",
              data: { id: id},
              success:function(data)
                  {
                     console.log(data);
                     //console.log(data.notes);
                    //  oldnotes  = data.notes[0].note ;
                    //  oldprice  = data.notes[0].file_price ;
                    //  oldstat2 = data.notes[0].old_status ;
                   
                    // $("#statusdialog .coldnotes").val(oldnotes);
                    // $("#statusdialog .oldprice").val(oldprice);
                    // $("#statusdialog #oldstatus").val(oldstat2);
                    // var currentstat =   $("#statusdialog .ostatus").val();
                   
                                         //$("#clienthelp tbody").html(data);

                     $("#revisiondialog #mistake_designer_name").val(data.notes[1]);                     
                     $("#revisiondialog #mistake_lead_name").val(data.notes[0]);                     
                  }
        
            });
          }
          else {
                 $("#revisiondialog #mistake_designer_name").val("");                     
                 $("#revisiondialog #mistake_lead_name").val("");
          }


});
    



//  added to get designer names in revision on 27-05-20

//   added function below on 27-05-20
 function revision_qc_ok_update(){
    
    // var oldprice = $(".oldprice").val();
    var oldnotes  =  $("#statusdialog .coldnotes").val();
    //alert(oldnotes);

    $("#filereason").dialog( { 
              title : "Revision File Update",
                    resizable: false,
                    modal: true,
                    autoOpen:false,
                    closeButton:true,
                    show: 'fold',
                    hide: 'fold',
                    //left: 1000,
                    width: 700,
                    height:280,
                   buttons: [
                          {
                            text: "OK",
                            class: "revok",
                            click: function() 
                            {      
                                  //alert($("#filereason  select#rev_mistake option:selected").html());
                                  // alert($("#filereason  textarea#rev_mistake_reason").val());
                                 // alert($("#revisiondialog .rev_note").val());
                                   if ( $("#filereason  select#rev_mistake option:selected").html() == "Select")
                                   {
                                         // alert('Revision Note cannot be blank');
                                         // return false;
                                           Swal.fire({
                                               type: 'error',
                                               title: 'Error',
                                               text: 'Select  Mistake Caused By'
                                          
                                            })
                                            return false;
                                           //  $( this ).dialog( "close" );
                                   }
                                    
                                  else if ($("#filereason  textarea#rev_mistake_reason").val() == "" ){

                                         Swal.fire({
                                               type: 'error',
                                               title: 'Error',
                                               text: 'Reason cannot be blank'
                                          
                                            })
                                            return false;

                                  } 
                                  
                                  else  {
                                          //alert('ok close');
                                           $( this ).dialog( "close" );
                                       
                                       
                                     }

                           
                        
                                var targettime2 = '';
                       

                      
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
             $("#filereason  #revision_mistake_reason").val('');
             $("#filereason  select#revision_mistake").val('0');
           
             
                 
             return false;
  }  


  function revision_update(){
    
    // var oldprice = $(".oldprice").val();
    var oldnotes  =  $("#statusdialog .coldnotes").val();
    //alert(oldnotes);

    $("#revisiondialog").dialog( { 
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
                                 // alert($("#revisiondialog .rev_note").val());
                                   if ( $("#revisiondialog .rev_note").val() == "")
                                   {
                                         // alert('Revision Note cannot be blank');
                                         // return false;
                                          Swal.fire({
                                               type: 'error',
                                               title: 'Error',
                                               text: 'Revision Note cannot be blank'
                                          
                                            })
                                            return false;

                                             $( this ).dialog( "close" );
                                   }
                                    
                                  else {
                                          //alert('ok close');
                                           $( this ).dialog( "close" );
                                       
                                       
                                     }

                           
                        
                                var targettime2 = '';
                       

                      
                            }
                          },
                         

                        ],
                    

                    close : function() {
                        //$(".dialogSave").button("option", "disabled",  false);
                        // $(".dialogSave").show();
                       // debugger;
                    },
                       create: function() {
            $(this).closest('div.ui-dialog')
                   .find('.ui-dialog-titlebar-close')
                   .click(function(e) {
                       //alert('hi');
                       e.preventDefault();
                        $( "#statusdialog" ).dialog("close");
                   });
        },
                    exit : function(){

                           $(this).dialog("destroy");
                    },
                    open: function(event, ui) {


            var closeBtn = $('.ui-dialog-titlebar-close');
            closeBtn.append('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>');
      

                        
                   
                    var dialog1 = $(event.target).parents(".ui-dialog.ui-widget");
                    //var buttons = dialog.find(".ui-dialog-buttonpane").find("button");
            
                   // var AddButton = buttons[0];
            
                    
                   
                    $(this).find('.ui-dialog-titlebar-close').blur();

                   

                    
                 },
               });




             $( "#revisiondialog" ).dialog("open");
             //debugger;
              $( "#revisiondialog .oldnotes").val(oldnotes);
             $( "#revisiondialog .rev_note").val('');
             $( "#revisiondialog select#rev_mistake").val('0');
             $( "#revisiondialog #rev_mistake_reason").val('');
             //$("#revisiondialog #new_target_date2").html(''); 
              $("#target_completion_time2").val('');
          //  $("#target_completion_time2").datetimepicker();
            $("#target_completion_time2").datepicker("setDate",new Date());
            // $("#revisiondialog input#target_completion_time2").html("");
            
             
                 
             return false;
  }  
  $(document).on("click", ".problemallocation", function(e){

   var lastClass = $(this).attr('class').split(' ').pop();
    var lastClass2 = $(this).attr('class').split(' ');
   
 
  
    $( "#dddd"+lastClass ).modal("show");
    if(lastClass2[0] == 'oneclick'){
      var multipleCancelButton = new Choices("#dropDownId"+lastClass, {
     removeItemButton: true,
     maxItemCount:15,
     // searchResultLimit:5,
     // renderChoiceLimit:5
     });
  }
  $( this ).removeClass( "oneclick" );

 });
$(document).on("click", ".closealloacation", function(e){
 var lastClass = $(this).attr('class').split(' ').pop();

    $( "#dddd"+lastClass ).modal("hide");
 
  });
$(document).on("click", ".submitalloacation", function(e){
 var lastClass = $(this).attr('class').split(' ').pop();

    $( "#dddd"+lastClass ).modal("hide");
 
  });
function myFunction(cc,kk) {
   
    var x =  $(cc).val();
    var y =  $(cc).text();

       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
    $('#ordtls'+kk).val(y);   
    $('#ordtlsid'+kk).val(x); 
   
   
}
 $(document).ready(function(){

       
//stop the timer
  $(document).on('click', '#modal-display-data .stop', function(){
                // alert('start');
                $(this).removeClass('stop');
              //  $(this).closest('.parent').find('.timer1').timer();
              // $(this).closest('.parent').find('.stop').text('START');

           var    id1 =    $(this).closest('.parent').find('.oid').val();

              

       $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
       });

         // $.ajax({
         //                    type:"POST",
         //                    async: true,
         //                    datatype:"JSON",
         //                    url:"orders/stoptimer",
                           
         //                    data: formData,
         //                    success: function(result)
         //                    { 
                        
         //                    //console.log(result[0].msg) ; 
         //                    // if (result[0].status)
         //                    //  {
         //                    //      //alert(result[0].msg);
         //                    //      toastr.info(result[0].msg);
         //                    //   }
                            
         //                    }
         //                });
   

   });




  //start the timer
  $(document).on('click', '#modal-display-data .start', function(){
                // alert('start');
                $(this).removeClass('start');
                  $(this).addClass('stop');
                  $(this).closest('i').remove();
                   $(this).append('<i class="fa fa-stop" aria-hidden="true"></i>');
                $(this).closest('.parent').find('.timer1').timer();
              // $(this).closest('.parent').find('.start').text('STOP');

           var    timerid1 =    $(this).closest('.parent').find('.timerid').val();

              

   $.ajaxSetup({
      headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }


   });
   
   //  $("#dtltable .dtlbody").empty();

    var formData =  {
                      id:  timerid1
                     
                    }
                            
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updatetimer",
                           
                            data: formData,
                            success: function(result)
                            { 
                        
                            //console.log(result[0].msg) ; 
                            // if (result[0].status)
                            //  {
                            //      //alert(result[0].msg);
                            //      toastr.info(result[0].msg);
                            //   }
                            
                            }
                        });


  });


 $(document).on('click', '.opentimer', function(){
         // alert($(this).html()) ;
         var id =   $(this).find('.orderindexid').val();
        // alert(id);
          $("#alloc-timer").modal('show');   
          
          $("#alloc-timer  .orderindexid1").val(id);
         

           // window.axios.get('home/project/timers/getfiles?&oid='+id).then(response => {
           //                         console.log(response.data.modal);
           //                     $("#modal-display-data").html(response.data.modal);
           //      if (response.data.id !== undefined) {
           //          //this.startTimer(response.data.project, response.data)
           //         // this.files = response.data
           //      }
           //  })

          // get  Files detail
      $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('orders/getfiles') }}",
            data: { oid: id},
            success:function(res)
                  {
                     
                     // oldnotes  = data.notes[0].note ;
                     // oldprice  = data.notes[0].file_price ;
                     // oldstat2 = data.notes[0].old_status ;
                       $("#modal-display-data").html(res.modal);

                      /// $("#modal-display-data .timer1").timer();  working
                     // $("#timer1.timer1.btn.starttimer").timer();

                       

                                                         
                     
                  }
        
        });

     
        

         //start a timer
           

            //pause the timer
            $('#pause').on('click', function () {
                 //alert('pause');
                $('#timer1').timer('pause');

            });

            //resume the timer
            $('#resume').on('click', function () {
                $('#timer1').timer('resume');

            });

            //remove the timer
            $('#remove').on('click', function () {
                $('#timer1').timer('remove').hide();
                $('#pause,#resume,#remove').hide();
                $('.text-note').show();

            });

 });





 });
  $(document).on("click", ".submitalloacationmulti", function(e){
     $('.dddd').modal("hide"); 
  });
function myFunctionallocation(cc,csf,csf2,allocationshowid) {
    
   var x =  $(cc).val();
   var y =  $(cc).text();
 
       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
  $('#'+csf.id).val(x);   
   $('#'+csf2.id).val(y);
   $('#'+allocationshowid.id).html(dc);
}
function myFunallocation(ccc,scval) {
  var o =  $(ccc).val();
  var p =  $(ccc).text();
  p=p.split('.').join(',');
  var po=p.replace(/,/g, '<br>');
  $('#allocationgetchangevalue'+scval).html(po);
  


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
    //change status calculate price function
    function cal_new_price() {
        
        var a1 =  $(".old_price1").val();
        var a2 =  $(".add_price").val();
        $(".file_price2").val( parseFloat(a1) + parseFloat(a2));
        return false;

   }
   //change status call functin
  $(document).on("change", ".add_price", function(){
        cal_new_price();
        return false;
  });
      //show alloacation modal
  $(document).on("click", ".addalloacation", function(e){

      var nextSectionWithId =  $(this).next().attr("id");

      $('#'+nextSectionWithId).modal("show"); 
 });
</script>

@endsection

