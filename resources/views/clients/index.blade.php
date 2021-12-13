@extends('layouts.maintemplate')

@section('third_party_stylesheets')
<style type="text/css">
 
  .table>thead>tr>th
{
  text-transform: capitalize !important;
 
}

 div.mycustom {
  position: relative;
  top: -20px;
  left: -25px;
  width: 100%;
  height: 400px;

}   

div.dataTables_scroll{
   width: 100% ;
}

 
div.DTFC_RightHeadBlocker {
 
   background-color: #e9ecef;
   
   }

/*
div.dtfc_scrollwrapper {
      margin-left: -30px;

}*/


.dataTables_length {
    padding-left: 50px !important;

}



/*  above code added to synchronize with other page on 13-05-20 */    


 /* added below code for full size scrolling for clients on 02/11/18*/
.container {
 /* padding-left: 15px !important;
  padding-right: 15px !important;*/
  width: 100% !important ;
}

.ctitle {
   font-size: 24px;
 }


.client_client_id {
  height: 80vh;
  max-height: 800px;
} 

/*table#comp-table {   problem with full width removed on 06/10/17
    width: 90% !important;
}*/


div.dataTables_wrapper {
  width: 100% !important;
}

/* added above code for full size scrolling for clients on 02/11/18*/

table#comp-table tbody tr {
        background: transparent; 
    }

table#comp-table tbody tr.selected {
    background-color: #f09e9e !important;
    }

 
table#comp-table tbody td {
         padding-top: 10px;
        padding-bottom: 4px;
        border-top: 0px;
        font-size: 14px;
      
         
    }


table#comp-table tbody td .material-icons {
       line-height: 0.15;
       font-size: 14px;
         
    }

select {
  color: blue !important;
}

label {
  color: black !important;
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
  .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
   /* border-top: 0; */
       empty-cells: hide;
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
  border:1px #979DD6 solid;
  border-right: none;
  border-left: none;
}
table#comp-table tbody tr {
        background: transparent;

    }
table#comp-table td, th {
  position: relative;
  vertical-align: middle;
  text-align: center !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  clear: both;
  border-collapse: collapse;
  word-wrap: break-word;
  max-width: 130px  !important;
  min-width: 130px  !important;
  height: 100% !important;
  white-space: nowrap ; 
  
}
    
h3 {
    text-align: center ;
    font-size: 32px;
   /* color: blue !important;*/
}


@keyframes blink {
  50% {
    opacity: 0.0;
  }
}
@-webkit-keyframes blink {
  50% {
    opacity: 0.0;
  }
}
.blink {
  animation: blink 1s step-start 0s infinite;
  -webkit-animation: blink 1s step-start 0s infinite;
}

/*.dataTables_scrollBody {
    overflow-x: scroll !important;
    overflow-y: scroll !important;
    
}*/

/*div.dataTables_wrapper {
        width: 1200px;
        margin: 0 auto;
    }
*/

/*.dataTables_info {
  color: white !important;
  font-weight: bold !important;
   font-style: 20px !important;
}

#comp-table_first
 {
   color:white;
   font-weight: bold !important; 

  }
*/
.paginate_button
 {
   font-weight: bold !important;
   font-style: 20px !important;
   background:  white;
   color: black;
  }


/*.paginate_button

 {
   font-weight: bold !important;
   font-style: 20px !important;
   background:  white;
   color: black;
  }


  span#comp-table_previous.previous.paginate_button
 {
   padding: 10px;
   position: relative;
   margin: 5px;
  
  }


  span#comp-table_next.next.paginate_button
 {
   padding: 10px;
   position: relative;
   margin: 5px;
  
  }

span#comp-table_last.last.paginate_button
 {
   padding: 10px;
   position: relative;
   margin: 5px;
  
  }



.previous.next.last {
  padding: 10px;
}
#comp-table_paginate.dataTables_paginate {
   padding: 20px;
   top: 20px;
}*/


.paginate_page {
  color: black;
 
}

.paginate_button {

   color: white;
}

#comp-table_paginate {
   color: black !important;
   font-weight: bold !important;
   font-style: 10px;
   font-weight: solid !important;
}

.paginate_input {
   width: 30px;
    color: blue !important;
   font-weight: bold !important;
   font-style: 10px;
   font-weight: solid !important;
}
table.dataTable>thead>tr>th, table.dataTable>thead>tr>td {
    padding: 0px !important;
    outline: 0;
   
   
   
}

table.dataTable>tbody>tr>th, table.dataTable>tbody>tr>td{
    padding: 15px !important;
    outline: 0;
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

</style>

@endsection

@section('content')
<!-- below code added as glyph symbol not displayed -->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 -->




<!--  <a href="#myModal" style="float: right" data-toggle="modal" class="btn btn-success">Create Client</a> -->
 
<!-- <h3 >Clients</h3>  -->


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- <div class="row"  > 
   <div class="col-md-2" style="float:left;">
   <a class="btn btn-primary" href="{{action("ClientController@getIndex") }}"> Back</a>
  
  </div> 

  <div class="col-md-1"  style="float: left;" >
          <button type="button" class="btn btn-primary clearsession" data-toggle="tooltip" 
                title="Clear Search" ><span class="glyphicon glyphicon-erase" > </span>
          </button>
    </div> 

   <div class="col-md-6 ctitle" ><center> Clients </center> </div>  

   
  <div class="col-md-2" style="float:right;">
      <a href="{{url('/clients/create')}}" style="float: right" class="btn btn-success">Create Client</a>
  </div>
</div> 
 -->
@php
$clientpage="true";
@endphp

<div class="container-fluid">
          
  
<div class="row ">
<div class="col-md-12 mt-2" align="center">
 @permission('show.all.clients') 
  <a href="javascript:void(0)" class="btn btn-primary btn-outline mr-2 statusFilter" value="All">All</a>
 @endpermission
 @permission('show.retail.clients') 
  <a href="javascript:void(0)" class="btn btn-success btn-outline mr-2 statusFilter active"  value="Retail">Retail</a>
 @endpermission
 @permission('show.fix.clients') 
  <a href="javascript:void(0)" class="btn btn-danger btn-outline statusFilter" value="Fix">Fix</a>
 @endpermission
</div>
<div  class="card-body table-responsive"> 

<table id="comp-table" class="table condensed data-table  row-border compact order-column">
    <thead class="fhead">
        <tr class="firstrow">
            <th>Company Id</th>            
            <th>Company Name</th>
            <th>Website</th>
          @permission('contact1.show')
            <th>Phone</th>
          @endpermission
            <th>Client Name</th>
          @permission('show.primary-email') 
            <th>Client Email</th>
          @endpermission
          @permission('contact1.show')
            <th>Client Contact</th>
          @endpermission
            <th>State</th>
            <th>Country</th>
            <th>Timezone Type</th>
            <th>Store Type</th>
          @permission('show.client.source')
            <th>Client Source</th>
          @endpermission
          @permission('show.csr.person')
            <th>Csr Person</th>
          @endpermission
            <th>Black List</th>
            <th>creationtime</th>   
        </tr>
         <tr class="secondrow">
            <th>Company Id</th>            
            <th>Company Name</th>
            <th>Website</th>
          @permission('contact1.show')
            <th>Phone</th>
          @endpermission
            <th>Client Name</th>
          @permission('show.primary-email') 
            <th>Client Email</th>
          @endpermission
          @permission('contact1.show')
            <th>Client Contact</th>
          @endpermission
            <th>State</th>
            <th>Country</th>
            <th>Timezone Type</th>
            <th>Store Type</th>
          @permission('show.client.source')
            <th>Client Source</th>
          @endpermission
          @permission('show.csr.person')
            <th>Csr Person</th>
          @endpermission
            <th>Black List</th>
            <th>creationtime</th> 
        </tr>
    </thead>
    <tbody></tbody>
</table>

  
 </div> 


 </div> 
</div> 


<!-- , , ['SubmitTextButton'=>'Add'] -->
@endsection



@section('script')


<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>

<script>


$(function() {


   // $.ajaxSetup({
   //          headers: {
   //              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
   //          }
   //  });
var form = $(this).parents('form:first');
var _token = form.find('input[name=_token]').val();
var $rowid = 0 ;
var currentPageIndex = 0;

 //New Code added on 11-07-18 for column searching
    $("#comp-table thead.fhead tr.firstrow th").each( function (i) {
        var title = $('#comp-table th').eq( $(this).index() ).text();
        //alert('hello');
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0 && title !== 'Edit') {
           
           $(this).html( '<input data-tip="Type and press <enter> to search" type="text"  name="'+titleclass+'"  placeholder=" " data-index="'+i+'"     class="'+titleclass+'"   />' );
    
        }
    } );
//New Code added on 11-07-18 for column searching
var table =   $('#comp-table').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        scrollCollapse: true, 
        serverSide: true,
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
        bStateSave: true,
        autowidth: false,
        scrollX: true,
        scrollY: true,
        scrollY: ($(window).height() - 245),
        search: {
               caseInsensitive: true
                },
        lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="25">25</option>'+
                      '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '<option value="-1">All</option>'+
                    '</select> Clients'
                    },
        //stateDuration: -1,  changes made on  04/08/18
        

        // changes made on  04/08/18
        ajax: "{{ route('clients.data',['id'=>'Retail']) }}",

        columnDefs: [
        
           
        ],
              
       
        columns: [
            { data: 'company_id' ,  name: 'company_id', class: 'idclass1 dt-body' ,  width: '2px', 
                    "render": function (data, type, full, meta) {
                                    urlclient="{{route('clients.show',':id')}}";
                                    urlclient = urlclient.replace(':id',full.id);

                                    data= '<a href="'+urlclient+'"  class="test" data-toggle="tooltip" title="' + data + '">' + data + '</a>';
                                    return data;
                            }},
              { data: 'client_company', name: 'client_company' , width: '5px', 
                    "render": function (data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                                       var tmp = full.id ;
                                       var urlclient= 'clients/'+tmp +'/showcompany';
                              return '<a href="'+urlclient+'"  class="test" data-toggle="tooltip" title="' + data + '">' + data + '</a>';
                            }
             },

             { data: 'website', name: 'website', width: '100px' },
          @permission('contact1.show')
             { data: 'phone', name: 'phone' , width: '200px'},
              { data: 'cdclient_name', name: 'client_dtls.client_name', 
                    "render": function (data, type, full, meta) {
                          
                                     data = data.replace(/,/g, '<br>');
                                     return data;
                            }
             },
          @endpermission
          @permission('show.primary-email') 
             { data: 'cdclient_email_primary', name:'client_dtls.client_email_primary', 
                    "render": function (data, type, full, meta) {
                          
                                     data = data.replace(/,/g, '<br>');
                                     return data;
                            }},
           @endpermission
          @permission('contact1.show')
             { data: 'cdclient_contact_1', name: 'client_dtls.client_contact_1', 
                    "render": function (data, type, full, meta) {
                          
                                     data = data.replace(/,/g, '<br>');
                                     return data;
                            }},
          @endpermission
             
             { data: 'client_state', name: 'client_state' , width: '50px' ,searchable: true},
             { data: 'client_country', name: 'client_country' , width: '50px',searchable: true},
             { data: 'timezone_type', name: 'timezone_type' , width: '50px'},
            
             { data: 'store_type', name: 'store_type' , width: '50px'},
          @permission('show.client.source')
             { data: 'client_source', name: 'client_source' , width: '50px'},
          @endpermission
          @permission('show.csr.person')
             { data: 'csr_person', name: 'csr_person' , width: '50px'},
          @endpermission
             
             { data: 'cdblack_list', name: 'client_dtls.black_list', 
                    "render": function (data, type, full, meta) {
                          
                                     data = data.replace(/,/g, '<br>');
                                     return data;
                            }},
           
             { data: 'cdclient_creation_date_time', name: 'client_dtls.client_creation_date_time', 
                    "render": function (data, type, full, meta) {
                          
                                     data = data.replace(/,/g, '<br>');
                                     return data;
                            }},
            
        
        ],
         pageLength: 25,
         pagination: true,
         responsive: true,
          order: [[ 0, "desc" ]]
         
        
    });


   
   
    var table = $('#comp-table').DataTable();

    //table.ajax.reload();  will refresh data never use on 18/04/17

    //New Code added on 11-07-18 for column searching

    table.columns.adjust().draw();
     //refresh data table
$(document).on("click", "#delsession", function(){
          event.preventDefault ;
          var table = $('#comp-table').DataTable();
          table.state.clear();

          // $('.Comp').val('');
           window.location.reload();
});
$('.statusFilter').on('click', function(){
        
          $('.statusFilter').removeClass('active');
           $(this).addClass('active');
  var filter_value = $(this).text();
  
  var new_url = "{{ route('clients.data',':id') }}";
  new_url = new_url.replace(':id',filter_value);

  table.ajax.url(new_url).load();
});
 //SERACH FILTER  REVISED

$('.dataTables_filter input').unbind().keyup(function(e) {
    var value = $(this).val();
    if (value.length>3) {
        //alert(value);
        table.search(value).draw();
    } else {     
        //optional, reset the search if the phrase 
        //is less then 3 characters long
        table.search('').draw();
    }        
});

 // SEARCH FILTER REVISED
 
 $( table.table().container() ).on( 'keyup', '.fhead tr.firstrow input', function (e) {
       if(e.keyCode == 13) {
        // table.state.clear();
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
        }
    } );
 

 // scroll top on pagination
$('#comp-table').on( 'page.dt', function () {
      $('html, body').animate({
          scrollTop: 0
      }, 300);
    });
// scroll top on pagination
  
    //New Code added on 11-07-18 for column searching


    $('#comp-table tbody').on( 'click', 'tr', function () {
        //alert('hello selected');
         
        $rowid = table.row( this ).index() ;
        var currentPageIndex = table.page.info().page; 

        // alert($rowid);
       // var currentPageIndex = table.page.info().page;
        var form = $(this).parents('form:first');
       
        $(this).find(".stamprow").val($rowid);
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    // $('#comp-table').dataTable( {
    //      initComplete: function(settings, json) {
    //        alert( 'DataTables has finished its initialisation.' );
    //         table.page(currentPageIndex).draw(false);
    //                           table.row( $rowid ).scrollTo();
    //        }
    //     } );

    
    @if(isset($j))
                    table.page( 1).draw(false);
                    table.row( 1 ).scrollTo();
                   
    @endif
      

     $('#comp-table').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 

                 if (currentPageIndex > 0)  {

                    table.page(currentPageIndex).draw(false);
                    table.row( $rowid ).scrollTo();
               }

      });
      
     $('#comp-table tbody tr td').each( function() {

         this.setAttribute( 'title', $(this).text());
     });  

     //$('#comp-table').dataTable({
      //  fnDrawCallback: function (oSettings) {
      //  alert( 'DataTables has redrawn the table' );
     //       }
       //   "fnInitComplete": function (oSettings, json) {
       //     alert('DataTables has finished its initialisation.');
      //  }
    // });

              
     

    
});




$(document).ready(function(){
        //  added above code  
         var table = $('#comp-table').DataTable();
        
      

     //$(".clearsession").click(function(event) {

     $(document).on("click", ".clearsession", function(e){
        
      //event.preventDefault ; removed on 20/10/17 as some users have problem in clear search
      var table = $('#comp-table').DataTable();
      table.state.clear();
      table.search( '' ).columns().search( '' ).draw();
      table.search('').draw();
      table.order([0, "desc"]);
      table.clear().draw();
      window.location.reload();

    });   
    

    $(".submitbutton").click(function (e) {
        var form = $(this).parents('form:first');

        var method = '';
        if (form.has('input[name=_method]')) {
            method = form.find('input[name=_method]').val();
            console.log(method);
        } 

        var table1 = $('#comp-table').DataTable();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        if(method != 'PATCH') {
            console.log("Post method detected, going to run this part of the script");
            $(this).html("<i class='fa fa-spinner fa-spin'></i>&nbsp;Wait!").attr('disabled', true);
            e.preventDefault();
            //var formdata = $('#contactusform').serializeArray();
            var _token = form.find('input[name=_token]').val();
       
            e.preventDefault(); 
         
        var client_name = form.find('input[name=client_name]').val();
        var client_email_primary = form.find('input[name=client_email_primary]').val();
        var client_company = form.find('input[name=client_company]').val();
        var client_state = form.find('input[name=client_state]').val();
        var _token = form.find('input[name=_token]').val();

        var url = '/clients';

        var formData = {
            client_name: client_name,
            client_email_primary: client_email_primary,
            client_company: client_company,
            client_state:  client_state,
            _token: _token
        }

        var url = form.attr('action');
        console.log(url);
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

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // console.log('hello');
                target.html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data[0].msg + "</p></div>");
                $('.submitbutton').html("<i class='fa fa-check'></i>&nbsp;Add More!").attr('disabled', false);
                //console.log(stat);
                //$( "#success" ).text("Successfully Added");

            
            },
            error: function (data) {
                console.log('Error:', data);
                var errors = data.responseJSON;
                var errorsHtml = " ";
                $.each( errors, function( key, value ) {
                    errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                });
                target.html(errorsHtml);
                $('.submitbutton').html("<i class='fa fa-flash'></i>&nbspResend").attr('disabled', false);
                }
        });
    }
    else if(method == 'PATCH') {
        $(this).html("<i class='fa fa-spinner fa-spin'></i>&nbspWait!").attr('disabled', true);
        e.preventDefault();
        var client_id = form.find('input[name=client_id]').val();
        var client_name = form.find('input[name=client_name]').val();
        var client_email_primary = form.find('input[name=client_email_primary]').val();
        var client_company = form.find('input[name=client_company]').val();
        var client_state = form.find('input[name=client_state]').val();
        var _method = form.find('input[name=_method]').val();
        var _token = form.find('input[name=_token]').val();
       // var client_id = $('.edit').parent('form:first').find('input[name=clientid]').val();
     
        var formData = {
                    client_id: client_id,
                    client_name: client_name,
                    client_email_primary: client_email_primary,
                    client_company: client_company,
                    client_state: client_state,
                    _token: _token,
                    _method: _method
                        }

        var url = '/clients/'+client_id ;
       // var url = form.attr('action');
        var target = form.find('.success');
       // console.log(url);
       // e.stopPropagation();
       // return false;
        
          $.ajax({
                url: url,
                type: 'PATCH',
                dataType: 'json',
                data: formData
              })
              .done(function(data) {
                console.log("hello updated");
                var success = data.responseJSON;
                target.html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data[0].msg + "</p></div>");
                $('.submitbutton').html("<i class='fa fa-check'></i>&nbsp;Done!").attr('disabled', false);
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
                console.log("complete");
              });
              $("#editmodalwindow").on('hidden.bs.modal', function () {
                    // window.location.reload();
              
                   

    });
    }

   
                            //  table.row( $rowid ).scrollTo();
    });
// });

// $(document).ready(function(){

    
$('#myModal div.block span.add').click(function() {
    $('.block:last').before('<div class="block"><input type="text" /><span class="remove">Remove Option</span></div>');
});
$('#myModal .optionBox').on('click','.remove',function() {
    $(this).parent().remove();
});    

 

  $(document).on("click", ".edit", function(e){
      // alert('hi edit');
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault();
        
        var _token = $(this).parents('form:first').find('input[name=_token]').val();
        var url = $(this).parents('form:first').attr('action');
        var client_id = $(this).parents('form:first').find('input[name=clientid]').val();
        
        // alert(window.location.pathname);
    
        if (window.location.pathname == '/clients') {
            // jQuery.noConflict();
            // alert(client_id);
            //var url = '/laravel/public/clients/'+client_id+ '/edit';
            //var url = '/laravel/public/datatables/'+client_id ;
            var url = '/clients';
            
            console.log(url);
            $.ajax({
                url: url ,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    _token: _token,
                    client_id: client_id
                },
                 // success: function (data) {
                 //   console.log(data);
                 // },
                // success: function (data) {
                //     console.log(data);
                //    // process_response_projects(data);
                // },
                success: process_response_projects,
                error: function (xhr) {
                    alert("AJAX request failed: " + xhr.status);
                }
            });
        }

        else if (window.location.pathname == ('/clients/' + client_id)) {
            console.log(url);
            // jQuery.noConflict();
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    _token: _token,
                    client_id: client_id,
                    
                },
                // success: process_response_tasks,
                success: process_response_projects,
                error: function (xhr) {
                    alert("AJAX request failed: " + xhr.status);
                }
            });
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
        // alert("hi");
        console.log("form default url is " + response[0].client_name);
        var client_name          = response[0].client_name;
        var client_id            = response[0].client_id;
        var client_email_primary = response[0].client_email_primary;
        var client_company       = response[0].client_company;
        var client_state         = response[0].client_state;
        console.log(client_name);
         
        var host = window.location.host;
        var pathname = window.location.pathname;
        // console.log("new projectslug is " +  client_id);
       // hide to overwrite client model
       // var updatedurl = 'http://' + host + pathname + '/' +  client_id;
        console.log("original url" + url);
        //console.log("updated url"+ updatedurl); //for debug
      

        // below is correct but as we have to update clients url

        var updatedurl = 'http://' + host +'/clients/'+client_id ;
          form.attr('action', updatedurl);
           console.log("updated url"+ updatedurl);
        form.find('#form-url').html(updatedurl);
        // var i;
         
        $("#modal-update #client_id").val(client_id);
        $("#modal-update #client_name").val(client_name);
        $("#modal-update #client_email_primary").val(client_email_primary);
        $("#modal-update #client_company").val(client_company);
        $("#modal-update #client_state").val(client_state);
        $("#editmodalwindow").modal('show');

    }
   
      
});



</script>

@endsection
