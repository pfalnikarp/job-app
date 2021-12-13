@extends('layouts.dashboard')

 
@section('style')


@endsection

@section('content')
<!-- below code added as glyph symbol not displayed -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 -->
<style type="text/css">
    


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

table {   
  margin: 0 auto;
    width: 100% !important;
    clear: both;
  border-collapse: collapse;
  table-layout: fixed; 
  word-wrap:break-word;
}

div.dataTables_wrapper {
  width: 100% !important;
}

/* added above code for full size scrolling for clients on 02/11/18*/

table#comp-table tbody tr {
        background: transparent; ;
    }

table#comp-table tbody tr.selected {
    background-color: #e57373 !important;
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


/*table#comp-table  th {
 
  text-align: center;
  vertical-align: middle;

  background: transparent ;
   white-space: nowrap !important; 

}
*/


table#comp-table td {
 /* position: relative;*/
  background: transparent ;
  overflow: hidden;
  text-overflow: ellipsis;
  border-top: 0px;
  font-size: 14px;
  white-space: nowrap !important;  
   border-collapse: collapse;
    table-layout: fixed;

}


.table>thead>tr>th {
    border-bottom: 2px solid #464545;
    text-align: center;

}    

th>input[type='text']
 {
    font-size: 14px;
    border: 2px solid;
  /*  border-color: green;*/
    width: 80% !important;
   /* color: blue !important;*/
    text-align: center;
 }




/*th input{
   width: 90%;
}*/

/*.table-striped>tbody>tr:nth-child(odd)>td,
.table-striped>tbody>tr:nth-child(odd)>th {
  background-color: #CBC3C2 !important;
}*/

.table-striped>tbody>tr:nth-child(odd)>td {
  background: #CBC3C2 ;
}

table#comp-table td a.glyphicon-edit:hover {
     color: orange !important;
}

/*table#comp-table td:hover::after,
table#comp-table th:hover::after {
  content: "";
  position: absolute;
  left: 0;
  top: -5000px;
  height: 10000px;
  width: 100%;
  z-index: -1;
 
}    */

/*table#comp-table table.dataTable tbody tr{background-color:blueviolet !important;}*/

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

.dataTables_scrollBody {
    overflow-x: scroll !important;
    overflow-y: hidden !important;
    
}

div.dataTables_wrapper {
        width: 1200px;
        margin: 0 auto;
    }


.dataTables_info {
  color: white !important;
  font-weight: bold !important;
   font-style: 20px !important;
}

#comp-table_first
 {
   color:white;
   font-weight: bold !important; 

  }

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
  color: white;
 
}

.paginate_button {

   color: white;
}

#comp-table_paginate {
   color: white !important;
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


</style>



<!--  <a href="#myModal" style="float: right" data-toggle="modal" class="btn btn-success">Create Client</a> -->
 
<!-- <h3 >Clients</h3>  -->
<br>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row"  > <!-- style="height:10vh" -->
   <div class="col-md-2" style="float:left;">
   <a class="btn btn-primary" href="{{action("ClientController@getIndex") }}"> Back</a>
  
  </div> 

  <div class="col-md-1"  style="float: left;" >
          <button type="button" class="btn btn-primary clearsession" data-toggle="tooltip" 
                title="Clear Search" ><span class="glyphicon glyphicon-erase" > </span>
          </button>
    </div> 

   <div class="col-md-6 ctitle" ><center> Clients </center> </div>  

   {{--  {{  isset($j) ? $j :0}} --}}
  <div class="col-md-2" style="float:right;">
      <a href="{{url('/clients/create')}}" style="float: right" class="btn btn-success">Create Client</a>
  </div>
</div> 

  <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
             

   

<div class="container">
  
  
<div class="row "><br>

<div id= "client_client_id" class="table-responsive"> 

<table id="comp-table" class="table table-responsive table-striped table-hover condensed table-bordered" >
    <thead class="fhead">
        <tr class="firstrow">
            <th style="width: 15px;">Id -1</th>  
            <th style="width: 15px;"></th>
            <th>Client Name</th>
            <th>Primary Email </th>
            <th>Company Name</th>
            <th>Contact</th>
            <th>Website</th>
            <th>Phone</th>
            <th>State</th>
            <th>Country</th>
            <th>Client Note</th>
           
            
            
        </tr>
         <tr class="secondrow">
            <th>Id</th>  
            <th></th>
            <th>Client Name</th>
            <th>Primary Email </th>
            <th>Company Name</th>
            <th>Contact</th>
            <th>Website</th>
            <th>Phone</th>
            <th>State</th>
            <th>Country</th>
            <th>Client Note</th>
          
            
            
        </tr>
    </thead>
    <tbody class="fbody"></tbody>
</table>

  
 </div> 


 </div> 
</div> 
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
        //scrollX: true,
        search: {
               caseInsensitive: true
                },
       
        //stateDuration: -1,  changes made on  04/08/18
        

        // changes made on  04/08/18
        ajax: '{!! route('clients.data') !!}',
             stateSaveCallback: function(settings,data) {
               localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
              },
            stateLoadCallback: function(settings) {
                   return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
            },

         createdRow: function ( row, data, index ) {
                
            @if(isset($j))     
                   if ( data.id == {{ $j }} ) {
                      //alert(data.id);
                      $(row).addClass( 'selected' );
                  }
                 //alert(row.id);
            @elseif(isset($urledit))     
                  if ( data.id == {{ $urledit }} ) {
                      //alert(data.id);
                      $(row).addClass( 'selected' );
                  }
            @endif
        },
        initComplete: function() {

         $('#comp-table_filter input').attr('data-toggle', 'tooltip')
                             .attr('data-placement', 'top')
                             .attr('title', 'Type here to search and press <Enter>')
                             .tooltip();

        $('#comp-table_filter input').unbind();
        $('#comp-table_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                //alert(this.value);
                table.state.clear();
                table .search(this.value).draw();

                }
            });
        },

        columnDefs: [
            { width: 10, targets: 0 },
            { width: 10, targets: 1 },
        ],
              
       
        columns: [
            { data: 'id' ,  name: 'id', class: 'idclass1 dt-body-right' ,  width: '2px'},
            { data: 'action', name: 'action', orderable: false, class: 'actsize1', searchable: false ,  width: '3px'},
            { data: 'client_name', name: 'client_name', class: 'dt-body-left',  width: '100px' , orderable: 'false'  },
            { data: 'client_email_primary', name: 'client_email_primary' ,  width: '100px' , orderable: 'false', 
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
            },
            
            { data: 'client_company', name: 'client_company' , width: '100px', 
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
            },
            
            { data: 'client_contact_1', name: 'client_contact_1', class: 'dt-head-right, dt-body-left' },
            { data: 'website', name: 'website', width: '200px' },
            { data: 'phone', name: 'phone' , width: '200px'},
            { data: 'client_state', name: 'client_state' , width: '50px' ,searchable: true},
            { data: 'client_country', name: 'client_country' , width: '50px',searchable: true},
            { data: 'client_note', name: 'client_note',  width: '20px', 
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
           
             },
            
          
           
        ],
         pageLength: 25,
         pagination: true,
         responsive: true,
          order: [[ 1, "desc" ]]
         
         // scrollY: '50vh',  

         //scrollCollapse: false, 
         // scroller: {
         //    rowHeight: 1
         // }, 
    });


   
   
    var table = $('#comp-table').DataTable();

    //table.ajax.reload();  will refresh data never use on 18/04/17

    //New Code added on 11-07-18 for column searching

    table.columns.adjust().draw();
  
 
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

        // debugger;    

        

         var table = $('#comp-table').DataTable();
        
        
       $(window).load(function() { 
         //alert("pageload event fired - the external page has been successfully loaded and inserted into the DOM!");
          var table = $('#comp-table').DataTable();

           @if(isset($skipno))
             var skipno = {{ $skipno }} ;
              /// alert('loaded');
             
             
                  //  table.page( pageno ).draw(false);
                 //   table.row( skipno ).scrollTo();
            @endif

            

             
        });


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
