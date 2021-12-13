@extends('layouts.dashboard_orders')

 
@section('style')

<style type="text/css">

.ui-dialog .ui-dialog-titlebar-close {
  color: blue;
  background: white;
}


select.ostatus > option[value=""] {
    display: none;
}

label {
  font-weight: 600;
}

.form-control {
   font-weight: 600;
   font-size: 14px;

}

table#laraorder tbody tr {
        background: transparent; 
    }

table#laraorder tbody tr.selected {
    background-color: #e57373 !important;
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



#rev_mistake {
     height: 40px  !important;
     width: 200px !important;
}

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
  padding-left: 20px !important;
}

td.fstat {
        font-style:italic;
        text-align: center; 
       /* background:#FFAF33;*/
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
   border-color:  blue !important;
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
   max-width: 200px ;
   height: 100% !important;
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

select.custom-select.custom-select-sm.form-control.form-control-sm
{
  color:black !important;
  height: calc(2.8125rem + 2px) !important;
}

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

input.acti {
  width: 0% !important;
  visibility: hidden;

}

/*input.orde, .bill, .file, .stat {
  width: 100px;
}*/

div.mycustom {
  position: relative;
  top: -10px;
  left: -10px;
  width: 100%;

}

.table>thead {
  height: 10% ;
}

.table>thead>tr>th.dt-center {
	float: center !important;
	text-align: center !important;
	
}
   </style> 

@endsection

@section('content')
<!-- below code added as glyph symbol not displayed -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

             
<body>
     

@if(isset($rights))
   
  

  @foreach ($rights as $key)
         
    <?php 
   
        $var[] = $key; 
      
    ?>
   

  @endforeach

@endif


<div class="container-fluid mycustom">
      
<div class="row">  
   
<div class="card-body  table-responsive" >

    <table id="laraorder" class="table condensed data-table stripe row-border compact" style="width:100%">
        <thead class="thead-light fhead">
          <tr class="firstrow">
              <th>Action</th>
              <th>Order ID</th>
              <th>Bill Dt</th>
              @permission('order.show.client') 
              <th>Client Name</th>
              @endpermission
              @permission('order.show.company') 
              <th>Client Company</th>
              @endpermission
              @permission('order.show.email') 
              <th>Client Email</th>
              @endpermission
              <th>File Type</th>
              <th>File Name</th>
              <th>File Note</th>
              <th>Doc. Type</th>
              <th>Targe Completed</th>
              <th>Allocation</th>
              <th>Stiches</th>
              <th>Id</th>
              <th>Child Status</th>
              <th>Status</th>
          
          </tr>

           <tr class="secondrow">
              <th>Action</th>
              <th>Order ID</th>
              <th>Bill Dt</th>
              @permission('order.show.client') 
              <th>Client Name</th>
              @endpermission
              @permission('order.show.company') 
              <th>Client Company</th>
              @endpermission
              @permission('order.show.email') 
              <th>Client Email</th>
              @endpermission
              <th>File Type</th>
              <th>File Name</th>
              <th>File Note</th>
              <th>Doc. Type</th>
              <th>Targe Completed</th>
              <th>Allocation</th>
              <th>Stiches</th>
              <th>Id</th>
              <th>Child Status</th>
              <th>Status</th>
          
          </tr>
         
         
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

        </div>
        </div>
        

   
</body>
   

@endsection

@include('pages.orders.modals.edit.client_help')
@include('pages.orders.modals.create.client_help')
@include('pages.orders.modals.create.order_delayed')
@include('pages.orders.modals.today_order')
@include('pages.orders.dialogs.note')
@include('pages.orders.dialogs.newfilename')

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
@include('pages.orders.modals.today_order_detail')
@include('pages.orders.modals.edit.order_view_link')

@section('script')
<script type="text/javascript">
  $(function () {

 //  header logic search added
$('#laraorder  .fhead .firstrow th').each( function (i) {
        var title = $('#laraorder th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);

        if(title.trim().length> 0) {
        //   if( title == 'Order Date') {
        //       $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="inputdt" value=""  /><a href="" class="orderdate">Click</a/>' );  placeholder="'+title.trim()
        //     }
        // else {     
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder=" " data-index="'+i+'"     class="'+titleclass+'"   />' );
        //    }
        }    
    } );

    //first header row logic
    
    var table = $('.data-table').DataTable({
        // processing: true,
        // serverSide: true,
        //   async: true,
        // ajax: "{{ route('orders.index') }}",
        // columns: [
        //     {data: 'id', id: 'id'},
        //     {data: 'order_id', name: 'order_id'},
        //     {data: 'client_name', name: 'client_name'},
        //     {data: 'client_email_primary', name: 'client_email_primary'},
        //     {data: 'client_address1', name: 'client_address1'},
        //     {data: 'client_state', name: 'client_state'},
        //     {data: 'client_contact_1', name: 'client_contact_1'},
        //      {data: 'other_contact', name: 'other_contact'},
        //      {data: 'client_note', name: 'client_note'},
        //      {data: 'file_name', name: 'file_name'},
        //      {data: 'file_type', name: 'file_type'},
        //      {data: 'vendor', name: 'vendor'},
        //      {data: 'stiches_count', name: 'stiches_count'},
        //      {data: 'order_date_time', name: 'order_date_time'},
        //      {data: 'order_dt', name: 'order_dt'},
        //      {data: 'target_completion_time', name: 'target_completion_time'},
        //      {data: 'allocation', name: 'allocation'},
        //      {data: 'status', name: 'status'},
        //      {data: 'document_type', name: 'document_type'},
        //      {data: 'note', name: 'note'},
        //      {data: 'unit_price', name: 'unit_price'},
        //      {data: 'order_us_date', name: 'order_us_date'},
        //      {data: 'created_at', name: 'created_at'},

        //     {data: 'action', name: 'action', orderable: false, searchable: false},
        // ]
        processing: true,
        serverSide: true,
        deferRender: true, 
        async: true,
		responsive: true,
        scrollX: true,
		    scrollY: 400, 
        scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
        bStateSave: true,
        dom: "Rlfrtip",
        autowidth: false,
		
        fixedColumns: true,
         fixedColumns:   {
            leftcolumns: 1,
            rightColumns: 1
        },
       
        colReorder: true,
		
        scroller: {
           rowHeight: 1
        }, 
    //     initComplete: function(settings) { 
    //     $(".data-table").colResizable({liveDrag:true});
    // },
        ajax: '{!!  route('orders.index') !!}',
         stateSaveCallback: function(settings,data) {
               localStorage.setItem( 'DataTables1_' + settings.sInstance, JSON.stringify(data) )
              },
            stateLoadCallback: function(settings) {
                   return JSON.parse( localStorage.getItem( 'DataTables1_' + settings.sInstance ) )
            },

  
           
        columns: [
          { data: 'action', name: 'action', width: '5px', class: 'fstat', orderable: false, searchable: false },
           { data: 'order_id', name: 'order_id', width: '10px', class: 'dt-center' , orderable: true
          //           "render": function (data, type, full, meta) {
          //                   return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
          //                   }
           },
            { data: 'bill_dt', name: 'bill_dt' , width: '50px' , class: 'dt-center',
                 
             },
               @permission('order.show.client') 
                 { data: 'client_name', name: 'client_name',  class: 'dt-center',
                                              

             },
           
  @endpermission
    @permission('order.show.company') 
    { data: 'client_company', name: 'client_company' , class: 'dt-center',
                

            },
   @endpermission
    @permission('order.show.email') 
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
            { data: 'allocation', name: 'allocation'  , width: '130px',
                     class: 'dt-center donothing' ,
                      @if (isset($var))
                        @if (in_array('select.allocation', $var))
                              class: 'editalloc dt-center' 
            
                         @endif
                      @endif
            

             },
            { data: 'stiches_count', name: 'stiches_count', class: 'dt-center' },
          { data: 'id', name: 'id' , class: 'fooid idRow dt-center',  width: '2px', sortOrder: 'desc'},
          
                
            {data: 'child_status', name: 'child_status', class: 'dt-center' ,visible: false },
            { data: 'action1', name: 'status' , class: 'dt-center fstat',  width: '2px', sortOrder: 'desc'},
                            ],
                         pageLength: 10,
              pagination: true,
              order: [[ 2, "desc" ]]
         

    });


  var table = $('.data-table').DataTable();
table.columns.adjust().draw();

        
    
  });
  
  $( document ).ready(function() {
      document.addEventListener( 'dblclick', function(event) {  
    alert("Double-click disabled!");  
    //event.preventDefault();  
    //event.stopPropagation(); 
  },  true //capturing phase!!
);

    //added above code on 05-06-20
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
	
	
$(document).on("dblclick", ".editdtl", function(e){
    //e.preventDefault();
    alert("hello");
    
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
                                  $("#dtltable .dtlbody").append(result);
                                  $("#editdtlmodalwindow .feditstatus").val(fstatus);
                                  $("#updatedtl .submitdtl").prop('disabled', false);

                              }
                            }
                        });

});

//addedbelow code on 24-05-20  for updatedtl  orders function
$(document).on("click", "#updatedtl .submitdtl", function(e){ 
           // debugger;
            $("select.childstatus").prop('disabled',false);
                  $("select.selectalloc").prop('disabled',false);
          
                   $("#updatedtl").submit();

                   return;
                
               
            if ($("#updatedtl").data("changed")) {

                  $("select.childstatus").prop('disabled',false);
                  $("select.selectalloc").prop('disabled',false);
          
                   $("#updatedtl").submit();
                 //$("#btnSubmit").attr('disabled', 'false');
                    //$("#finalsubmit").attr('diabled', 'false');

            }

            else {
                    //alertify.error('No changes done,close this form');
                    swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: "No changes done,close this form"
                                          
                                    })

                  $("#updatedtl .submitdtl").attr('disabled', 'true');
                  e.preventDefault();
                  return false;
                
                }
     
      });
    
 //  below logic for  edit dtl  records

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




    $(document).on("change", ".allocshow", function(e){   
           //  debugger;
       // alert('clicked');
         if ( $('input[name="allocshow"]').is(':checked') ) {
               
              $('input[name="allocshow"]').val('yes');   
               $(".finalalloc").show();
               $(".feditdtlstatus").show();
               $(".falloc").focus();
               $(".submitdtl").show();
            }
            else {
              $('input[name="allocshow"]').val('no');   
                $(".finalalloc").hide();
                $(".feditdtlstatus").hide();
            }

    });

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
                          
                          $("#editdtlmodalwindow select.feditstatus").append('<option value="Approved">Approved</option>'); 

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

  // added logic for each checkbox selected

var oldstat = new Array();
  var oldstatus = '';
  $("input.statusshow").hide();

  $(document).on("change", "#dtltable  input.chkidctl", function(e){
           // debugger;
           // alert('clicked');
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
                        
                      
                           $("#editdtlmodalwindow select.feditstatus").val('Approved');

                     }

                    if ( outputArray[0] == 'Approved') {
                        
                      
                           $("#editdtlmodalwindow select.feditstatus").val('Alloted');

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
                        
                        $("#editdtlmodalwindow select.feditstatus").append('<option value="Ch-QC OK">Ch-QC OK</option>');
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
                             $("#editdtlmodalwindow select.feditstatus").append('<option value="QC OK">QC OK</option>'); 
                      
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
                            $("#editdtlmodalwindow select.feditstatus").append('<option value="Rev-QC OK">Rev-QC OK</option>'); 
                      
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
$('#laraorder tbody').on('click', 'li.link1', function () {

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
            show: 'fold',
            hide: 'fold',
            width: 300,
            height:300,
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

                $( "#newfiledialog" ).dialog("open");
                $( "#newfiledialog .filename1" ).val( filename );
                 $( "#newfiledialog .filename2" ).val( filename );
               
                // alert(id1);
                $( "#newfiledialog .fileid" ).val( dtlid ); 
                // table.ajax.reload(); 
      

         //// file name changes


});

// filename changes

/// added on 020620

 $('#laraorder tbody').on( 'click', 'tr', function () {
        //alert('hello selected');
         
        $rowid = table.row( this ).index() ;
        var currentPageIndex = table.page.info().page; 

        // alert($rowid);
       // var currentPageIndex = table.page.info().page;
        var form = $(this).parents('form:first');
       
       // $(this).find(".stamprow").val($rowid);
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });



//  added on 020620

//  logic for changing allocation on 28-05-20

    
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
                     

if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'Allocation') {
      //alert(table.cell( this ).index().name);
             //alert("Do you want to change allocation");
            // return false;
            if (($(this).closest('tr').has('td.donothing').length) > 0 ) { 
                  // alert("No Rights to Modify Allocation, Contact Admin");
                  swal({
                              icon: 'error',
                              title: 'Error',
                              text: 'No Rights to Modify Allocation, Contact Admin'
                                          
                          })
                  return false;

            }

            var file_count = $(this).closest('tr').find('td.cfilecount').text();

            if (file_count > 1 ) {
                // alertify.error('Direct Changes not allowed, More than one file exist');
                  swal({
                              icon: 'error',
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
                                   // console.log(selText);
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
                                swal({
                                          icon: 'error',
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

           
             $( "#allocdialog" ).dialog("open");
             //table.ajax.reload(); 
         }

        //  notes  changes
        if ($('#laraorder thead tr.secondrow th').eq($(this).index()).text().trim() == 'File Note') {
             // alert( table.cell( this ).data() );

            var target  = $(this);
            var oldnotes = table.cell( this ).data();
            //alert(oldnotes);
            var re = /<br *\/?>/gi;
            var oldnotes1 = oldnotes.replace(re,"\n");
            var currentPageIndex = table.page.info().page;
           
            //alert($rowid); removed on 07-01-2020 as per designer
            // @if (isset($var))
            //   @if (!in_array('file-note.modify', $var))
            //        //alert("No Permission to modify file notes");
            //           swal({
            //                   icon: 'error',
            //                   title: 'Error',
            //                   text: 'No Permission to modify file notes'
                                          
            //               })
            //        return false;
            //   @endif
            // @endif

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


        



});

//logic for changing  allocation on 28-05-20

 // above  logic  for edit dtl records      

 // below logic  for order status
 $(document).on("click", ".editstatus", function(e){
   e.preventDefault();
   //alert("edit status") ;
  // debugger;

    @if (isset($var))
        @if (!in_array('orderstatus.modify', $var))
             $(".delmsg").html("").fadeIn('fast');
             $(".delmsg").html("You Don't have Permission to Edit").fadeOut( 3000 );
             return false; 
        @endif
    @endif

   

 
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
                   swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Please Select Designer First..'
                                          
                                    })

                  e.stopPropagation();
                  return false;
          }

          if ( status1 == 'Alloted'  && filetype == 'Vector'  && (alloc1 == 'not allocated'  || alloc1 == '0') )
          {
                swal({
                                          icon: 'error',
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
                       my: "left",
                       at: "right",
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
                                
                                swal("Client Specific Information", vclient_specific, "success")
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
                                         
                                           swal({
                                               icon: 'error',
                                               title: 'Error',
                                               text: 'Select  Mistake Caused By'
                                          
                                            })
                                          
                                            return false;
                                           //  $( this ).dialog( "close" );
                                   }
                                    
                                  else if ($("#filereason  textarea#rev_mistake_reason").val() == "" ){

                                    
                                        
                                        swal({
                                               icon: 'error',
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
                         var status2 = { 'Invalid' :'Invalid' };
                        $.ajax({
                            type:"POST",
                            async: true,
                            datatype:"JSON",
                            url:"orders/updateorderstatus",
                            data: formData,
                            success: function(result)
                            { 
                              res = result[0].msg ;
                              status2 = result[0].status2;
                              if ( result[0].oldstatus != null)
                              {
                                     oldstatus = result[0].oldstatus;
                              }
                              console.log(status2);
                              if (res == 'Updated successfully') {
                                  console.log(res);
                              }
                              else {
                                //  alert(res);
                                  //alertify.confirm(res);
                                 //toastr.info(res);
                                  swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: res
                                          
                                    })
                                 
                              }
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
        
            

});
 

 // above  logic for  order status  on 25-05-20  

// below  logic for changing status on 26-05-20

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
                             //alert('hi'); 
                            // alert(this.text);
                       return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                  }).remove();
              
                       
       

    });


    $("#statusdialog .ostatus").on('focus', function () {
            // Store the current value on focus and on change
        previous = this.value;
        //alert(previous);
              
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
             

     
      
        @if (in_array('alloc.qcpending', $var) ) 
                    // alert('alloc-qcpending');
                     // alert(previous);
                    if( ($(this).val() !== 'QC Pending') && (previous == 'Alloted')) {
                          //alert('Designer are allowed only to change from Allocated to QC Pending');
                            swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

                              e.stopPropagation();
                           return false ;
                         
            } 
        @endif    

        @if (Auth::user()->hasRole('Designer') && Auth::user()->level() <=1)
                 
                    if( ($(this).val() !== 'QC Pending') ) {
                        //  alert('Designer are allowed only to change from Allocated to QC Pending');
                          swal({
                                          icon: 'error',
                                          title: 'Error',
                                          text: 'Only Designer are allowed only to change from Allocated to QC Pending'
                                          
                                    })

                              e.stopPropagation();
                           return false ;
                         
            } 

        @endif

         @if (Auth::user()->hasRole('team.lead.designer') && Auth::user()->level() <=2)
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
         
         
        @if( Auth::user()->level() > 2)
          
              //alert('not alloc qcpend ok');
              if( ($(this).val() == 'QC Pending') && (previous == 'Alloted')) {
                          //alert('Only Designer are allowed only to change from Allocated to QC Pending');
                           swal({
                                          icon: 'error',
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

            alert(id);

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
                                           swal({
                                               icon: 'error',
                                               title: 'Error',
                                               text: 'Select  Mistake Caused By'
                                          
                                            })
                                            return false;
                                           //  $( this ).dialog( "close" );
                                   }
                                    
                                  else if ($("#filereason  textarea#rev_mistake_reason").val() == "" ){

                                         swal({
                                               icon: 'error',
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
                                          swal({
                                               icon: 'error',
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

</script>

@endsection

