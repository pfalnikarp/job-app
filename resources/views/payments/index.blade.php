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

table#companypaid-table tbody tr {
        background: transparent;
    }

table.dataTable tbody tr.selected{
    background-color: white !important;
}
table#companypaid-table tbody tr.selected {
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


th.dt-center.fstat {
  text-align: center !important;
  padding-left: 20px !important;
}

td.fstat {
        font-style:italic;
        text-align: center;

       /* background:#FFAF33;*/
    }
table.c {
  table-layout: fixed;
  width: 100%;
  word-wrap: break-word;
  text-align: center;

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

table#companypaid-table td, th {
   position: relative;
  vertical-align: middle;
  text-align: center !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  clear: both;
  border-collapse: collapse;
    word-wrap: break-word;
   max-width: 150px !important;
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

div#companypaid-table_filter {
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
.Stat{
width:100%;

}


   </style>

@endsection

@section('content')
<!-- below code added as glyph symbol not displayed -->

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

<h2> Cancel Payment</h2>

<div class="row">



<div class="card-body  table-responsive" >

    <table id="companypaid-table" class="table condensed data-table row-border compact order-column" style="width:100%">

        <thead class="thead-light fhead">
          <tr >
              <th>  Cancel </th>
               <th>  Tran-id </th>
              <th>Company</th>
              <th>Invoices</th>
              <th>Payment Date</th>
              <th> Conv-rate</th>
              <th> Pay Channel</th>
               <th>Remarks</th>
               <th>Currency</th>
               <th>Amt Recd</th>
                 <th>Amt Recd(INR)</th>
               <th>Bank Charges</th>
               <th>Status</th>

          </tr>


        </thead>
        <tbody class="fbody">
        </tbody>

    </table>

</div>

        </div>
        </div>








@endsection
@section('script')
<!--  timer function -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>

<!--  timer function -->
<script type="text/javascript">
  $(function () {

 //header textbox logic to search
$('#companypaid-table  .fhead .firstrow th').each( function (i) {
        var title = $('#companypaid-table th').eq( $(this).index() ).text();
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
        autowidth: false,

        lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="20" selected>20</option>'+
                      '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select> '

                    },
        colReorder: true,

        scroller: {
           rowHeight: 1
        },

        ajax: '{!!  route("payments.index") !!}',
         "preDrawCallback": function (settings) {
            pageScrollPos = $('div.dataTables_scrollBody').scrollTop();
         },
         "drawCallback": function (settings) {
             $('div.dataTables_scrollBody').scrollTop(pageScrollPos);
        },

        columns: [

          { data: 'action', name: 'action',  class: 'dt-center '},
          { data: 'tran_id', name: 'tran_id', width: '50px', class: 'dt-center '},
           // { data: 'chbox', name: 'chbox', width: '2px', class: 'dt-center fstat chboxs', orderable: false, searchable: false},
           { data: 'client_company', name: 'client_company', width: '200px', class: 'dt-center',searchable: true
          //           "render": function (data, type, full, meta) {
          //                   return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
          //                   }
           },
           { data: 'invoices', name: 'invoices', width: '100px', class: 'dt-center',searchable: true
          //           "render": function (data, type, full, meta) {
          //                   return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
          //                   }
           },
            { data: 'payment_date', name: 'payment_date' , width: '20px' , class: 'dt-center',

             },




            { data: 'conv_rate', name: 'conv_rate' , class: 'dt-center ftype',
             "render": function (data, type, full, meta)
            {
                            return '<span data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }

            },
            { data: 'pay_channel', name: 'pay_channel', width: '10px', class: 'dt-center'

            },
            { data: 'remarks', name: 'remarks',
              defaultContent: "",  class: 'not dt-center',
                        "render": function (data, type, full, meta) {
                                  var re = /<br *\/?>/gi;

                         return '<span class="notemodify" data-toggle="tooltip" title="' + data.replace(re, "\n") + '">' + data.substring(0,10) + '</span>';
                       }


            },

              { data: 'currency', name: 'currency'  ,
                     class: 'dt-center donothing'


             },
            { data: 'amt_paid_usd', name: 'amt_paid_usd'  ,
                     class: 'dt-center donothing'


             },

                  { data: 'amt_received_inr', name: 'amt_received_inr'  ,
                     class: 'dt-center donothing'


             },



            { data: 'bank_charges', name: 'bank_charges' , class: 'dt-center fstat',  width: '2px' },
             { data: 'status', name: 'status' , class: 'dt-center fstat'},
                            ],
                         pageLength: 20,
              pagination: true,

           order: [ [ 1,  'desc' ] ]






    });
        //var table sir code

    //callback function for direct editing


  });


  $(document).on("click", "#delsession", function(){
          event.preventDefault ;
          var table = $('#companypaid-table').DataTable();
          table.state.clear();

          // $('.Comp').val('');
         // window.location.href =  window.location.href.split("?")[0];
         // alert(window.location.href);
           window.location.reload();

            window.location.href = "{{ route('orders.index')}}";

  });

  //user allocation popup id

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
         var table = $('#companypaid-table').DataTable();
          table.search(newid1).draw();
    }



          //added on 12/05/20
           var table = $('#companypaid-table').DataTable();


         $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );


 });

</script>

@endsection

