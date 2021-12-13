
@extends('Layouts.master')

@section('content')
<!-- @parent -->
 <script src="//code.jquery.com/jquery.js"></script>


<h1>Add Client</h1>
<!-- <p class="lead">Add to your task list below.</p>
<hr> -->
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif


<!-- {!! Form::open(['route'=>'clients.store', 'class'=>'form-horizontal']) !!} -->





<div class="form-group">
   <div class="col-md-3 col-sm-6 col-xs-12">
    {!! Form::label('client_company', 'Company', ['class' => 'control-label']) !!}
    {!! Form::text('client_company', null, ['class' => 'form-control' ]) !!}
    </div>
    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
    {!! Form::label('tax_code', 'Tax Code', ['class' => 'control-label']) !!}
    {!! Form::text('irc_number', null, ['class' => 'form-control ']) !!}
    </div> -->
    <div class="col-md-3 col-sm-6 col-xs-12">
    {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<hr>


            
      <!--       <div class="row col-md-offset-4"><input type="button" class="btn btn-primary add" value="+"><b> Add   Details </b></div>
     
 -->
 <!-- <a class="add" href="#" > Add Rows</a> -->
<!-- <input id="addrow" type="button" class="btn btn-primary add" value="+">Add Rows -->

<hr>

<div class="row">
 <a href="#myModalRow" style="float: left" data-toggle="modal" class="btn btn-success">Add Rows</a>

 </div>


	
<div class="table-responsive">  
<table id= "clienttable"   class="table table-bordered table-hover">
        <thead>

            <tr>
	           
    	        <th>No</th>
        	    <th>Client Name  </th>      
             	<th>Primary Email</th>
            	<th>Other Email</th>
             	<th>Address</th>
            	<th>State</th>
            	<th>Country</th>
            	<th>TimeZone Type</th>
            	<th>Contact 1</th>
            	<th>Contact 2</th>
            	<th>Other Contact</th>
            	<th>Unit Price</th>
            	<th>Digit Rate</th>
            	<th>Client Note</th>
            	<th>Store Type</th>
            </tr>


        </thead>
        <!-- <tbody class="body">
            <tr>
            <td></td>
            <td class="no">1</td>
            <td  > 
          
    {!! Form::text('client_name', null, ['class' => 'form-control','id'=>'client_name']) !!} </td>
            
           
            
            <td >  {!! Form::text('client_email_primary', null, ['class' => 'form-control','id'=>'client_email_primary']) !!}</td>
            <td>{!! Form::text('client_email_secondary', null, ['class' => 'form-control','id'=>'client_email_secondary']) !!}
                
            </td>
            <td> {!! Form::text('client_address1', null, ['class' => 'form-control']) !!}</td>
            <td> {!! Form::text('client_state', null, ['class' => 'form-control']) !!}</td>
            <td>  {!! Form::text('client_country', null, ['class' => 'form-control']) !!}</td>
            <td>     {!! Form::text('timezone_type', null, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::tel('client_contact_1', null, ['class' => 'form-control ']) !!}</td>
            <td>{!! Form::tel('client_contact_2', null, ['class' => 'form-control ']) !!}</td>
            <td>{!! Form::tel('other_contact', null, ['class' => 'form-control']) !!}</td>
            <td> {!! Form::text('unit_price', null, ['class' => 'form-control']) !!}</td>
            <td> {!! Form::text('unit_price', null, ['class' => 'form-control']) !!}</td>
            <td>
             {!! Form::text('digit_rate', null, ['class' => 'form-control']) !!}	
            </td>
            <td>
            	  {!! Form::text('client_note', null, ['class' => 'form-control']) !!}
            </td>
            <td>
            	 {!! Form::text('store_type', null, ['class' => 'form-control']) !!}
            </td>
            </tr>
        </tr>
        </tbody> -->
        
    </table>           
</div>

<!-- <div class="form-group">
    <div class="block">
    {!! Form::hidden('client_id', null, ['class' => 'form-control','id'=>'client_id']) !!}
    {!! Form::label('client_name', 'Client Name :', ['class' => 'control-label']) !!}
    {!! Form::text('client_name', null, ['class' => 'form-control','id'=>'client_name']) !!}
    {!! Form::label('client_email_primary', 'client email primary:', ['class' => 'control-label']) !!}
    {!! Form::email('client_email_primary', null, ['class' => 'txtinput form-control']) !!}
    {!! Form::label('client_address1', 'Address', ['class' => 'control-label']) !!}
    {!! Form::text('client_address1', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_state', 'State', ['class' => 'control-label']) !!}
    {!! Form::text('client_state', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('client_country', null, ['class' => 'form-control']) !!}
    </div>
    

</div>
 --> 
 <!-- 
<a href="#" >Add <i class="glyphicon glyphicon-plus"></i></a>
<a href="#" class="btn btn-danger delete">Delete</a> -->


 @include('pages.clients.modals.create.clients' , ['SubmitTextButton'=>'Add']  )

<!-- {!! Form::submit('Submit',['class' => 'tn btn-primary']) !!}

{!! Form::close() !!}
 -->
<script type="text/javascript">

$(function(){    

	    

var table1 = $('#clienttable').DataTable({
	
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columnDefs: [{
              defaultContent: "-",
              targets: "_all"
        }],
        
	columns: [
            // { data: 'action', name: 'action', orderable: false, searchable: false} ,
            { data: 'id', name: 'id'  },
            { data: 'client_name', name: 'client_name', width: '300px' ,
                    "render": function (data, type, full, meta) {
                            return '<span  data-toggle="tooltip" title="' + data + '"></span><input type="text"  class="mclient" name="client_name[]" class="form-control" value="'+ data +'">';
                      }

             },
            
            { data: 'client_email_primary', name: 'client_email_primary',width: '200px' ,
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_email_primary[]" placeholder="Enter Spacebar or comma for Multiple Emails" class="tm-input"/>';
                      }

             },
            { data: 'client_email_secondary', name: 'client_email_secondary', width: '200px' ,
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_email_secondary[]" placeholder="Enter Spacebar or comma for Multiple Emails" class="tm-input"/>';
                       }

             },
            { data: 'client_address1', name: 'client_address1',width: '300px',
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_address1[]" placeholder="Enter Address" />';  
                          }
            },
            { data: 'client_state', name: 'client_state' , 
                       "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_state[]" placeholder="Enter State" />'; 
                          }
            },
            { data: 'client_country', name: 'client_country',
                        "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_state[]" placeholder="Enter Country" />'; 
                          }
             },
            { data: 'timezone_type', name: 'timezone_type',
                      "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="timezone_type[]" placeholder="Enter Timezone" />'; 
                        }

            },
            { data: 'client_contact_1', name: 'client_contact_1',
                      "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_contact_1[]" placeholder="Enter State" />'; 
                        }

             },
            { data: 'client_contact_2', name: 'client_contact_2',
                      "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_contact_1[]" placeholder="Enter State" />'; 
                        }

            },
            { data: 'other_contact', name: 'other_contact' ,
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="other_contact[]" placeholder="Enter State" />'; 
                      }
            },
            { data: 'unit_price', name: 'unit_price' ,
                      "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="unit_price[]" placeholder="Enter Unit Price" />'; 
                        }
            },
            { data: 'digit_rate', name: 'digit_rate',
                      "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="digit_rate[]" placeholder="Enter Unit Price" />'; 
                        }
             },
            
            { data: 'client_note', name: 'client_note', orderable: false, searchable: false ,
                        "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="client_note[]" placeholder="Enter Unit Price" />'; 
                          }
                       
             },
             { data: 'store_type', name: 'store_type' ,
                        "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '"></span><input type="text" name="store_type[]" placeholder="Enter stoe_type" />'; 
                           }
              }
            ]

});
 


//$('#clienttable tbody td .tm-input').multipleInput();

$('#clienttable tbody').on( 'keyup', 'td .tm-input', function () {
    
     //alert('hello');
     $(this).multipleInput();
});
  
    $('.add').on( 'click', function () {
    //$('#clienttable thead').on( 'click', 'th .add', function () {

      $('#clienttable tbody').addClass('body');
		alert('hello');
		//var product = $('.product_id').html();
    var table = $('#clienttable').DataTable( {processing: false,serverSide: false});
    
		var counter =2 ;

  table.rows.add( [
      {
             id :    counter,
          client_name : '<input type="text" name="client_name[]" value ="1" class=" form-control">',
          client_email_primary :   '<input type="text" name="client_email_primary[]" value ="1" class="form-control">',
 
          client_email_secondary :  '<input type="text" name="client_email_secondary[]" value ="1" class="form-control">',

          client_address1 :
            '<input type="text" name="client_address1[]" value ="1" class="form-control">',
          client_state :
            '<input type="text" name="client_state[]" value ="1" class="form-control">',
           client_country : 
            '<input type="text" name="client_country[]" value ="1" class="form-control">',
           timezone_type : 

            '<input type="text" name="timezone_type[]" value ="1" class="form-control">',
            client_contact_1 :
            '<input type="text" name="client_contact_1[]" value ="1" class="form-control">',
            client_contact_2 :
            '<input type="text" name="client_contact_2[]" value ="1" class="form-control">',
            other_contact :
            '<input type="text" name="other_contact[]" value ="1" class="form-control">',
            unit_price :
            '<input type="text" name="unit_price[]" value ="1" class="form-control">',
            digit_rate :
            '<input type="text" name="digit_rate[]" value ="1" class="form-control">',
            client_note :
            '<input type="text" name="client_note[]" value ="1" class="form-control">',
            store_type :
            '<input type="text" name="store_type[]" value ="1" class="form-control">'
          }

        ] ).draw( false );



        counter++;
        // var n = ($('.body tr').length-0)+1;'<tr><th class="no">'+n+'</th>'
        // var tr = '</tr>'+
        //          '<td><input type="text" name="client_name[]" class=" form-control"></td>' +
        //          '<td><input type="text" name="client_email_primary[]" class="form-control"></td>' +
        //          '<td><input type="text" name="client_email_secondary[]" class="form-control"></td>' +
        //          '<td><input type="text" name="client_address1[]" class="form-control"></td>' +
        //         '<td><input type="text" name="client_state[]" class="form-control"></td>' +
        //         '<td><input type="text" name="client_country[]" class="form-control"></td>' +
        //          '<td><input type="text" name="timezone_type[]" class="form-control"></td>' +
        //         '<td><input type="text" name="client_contact_1[]" class="form-control"></td>' +
        //        '<td><input type="text" name="client_contact_2[]" class="form-control"></td>' +
        //         '<td><input type="text" name="other_contact[]" class="form-control"></td>' +
        //          '<td><input type="text" name="unit_price[]" class="form-control"></td>' +
        //           '<td><input type="text" name="digit_rate[]" class="form-control"></td>' +
        //         '<td><input type="text" name="client_note[]" class="form-control"></td>' +
        //        '<td><input type="text" name="store_type[]" class="form-control"></td>' + '</tr>';
        //           // '<td><a href="#" class="btn btn-danger delete value="-""></a></td></tr>';
        // $('.body').append(tr);
    });
  
	
  // var table =  $('#clienttable').removeAttr('width').DataTable( {
  //         "scrollX": true,
  //         //scrollY: 600,
  //         "scrollCollapse": true,
  //         "sScrollY": ($(window).height() - 200),
  // 		  "bPaginate": false,
  // 		  "bJQueryUI": true,

  //         "autowidth": false,
  //        // fixedColumns:   {
  //        //   leftColumns: 1
  //        // },
  //         processing: true,
  //         serverSide: true,
  //         scroller: {
  //         rowHeight: 1
  //         },
  //         columnDefs: [
                    
  //           { width: 600, targets: 1 },
  //           { width: 600, targets: 2 },
  //           { width: 300, targets: 3 },
  //           { width: 300, targets: 4 },
  //           { width: 300, targets: 5 },
  //           { width: 300, targets: 6 }
  //       ],
       
  //   });

  	

	// $('#clienttable').dataTable({
 //  		"sScrollY": ($(window).height() - 200),
 //  		"bPaginate": false,
 //  		"bJQueryUI": true
	// });


(function( $ ){
 
     $.fn.multipleInput = function() {
 
          return this.each(function() {
 
               // create html elements
 
               // list of email addresses as unordered list
               $list = $('<ul />');
 
               // input
               //alert('hello');

               var $input = $('<input type="text" />').keyup(function(event) {
 
                    if(event.which == 32 || event.which == 188) {
                         // key press is space or comma
                         var val = $(this).val().slice(0, -1); // remove space/comma from value
 
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
  

    
 // $('#myModalRow input#client_email_primary .tm-input').multipleInput();
  $('#client_name').focusin(
      function(){
        $(this).css('background-image', 'none');
    });

 $('.tm-input').multipleInput();
    
   
}); 



$(".submitbutton").click(function (e) {
        var form = $(this).parents('form:first');

        var method = '';
        if (form.has('input[name=_method]')) {
            method = form.find('input[name=_method]').val();
            console.log(method);
        } 

        var table1 = $('#clienttable').DataTable();

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

         $("#myModalRow").on('hidden.bs.modal', function () {
                    // window.location.reload();
                    table1.ajax.reload();
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


              $("#myModalRow").on('hidden.bs.modal', function () {
                    // window.location.reload();
                    table1.ajax.reload();
              });

              
    }
  });
 

</script>

<script type="text/javascript">

 

</script>


@stop