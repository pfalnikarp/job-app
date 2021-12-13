@extends('Layouts.master_body')

@section('content')
<style type="text/css">
    

   table#comp-table tbody  td {
        
        background: transparent ;
       
    }
 
    table#comp-table tbody td {
         padding-top: 2px;
        padding-bottom: 2px;
         
    }



table#comp-table td, th {
  position: relative;
  
 
}

table#comp-table td:hover::after,
table#comp-table th:hover::after {
  content: "";
  position: absolute;
  left: 0;
  top: -5000px;
  height: 10000px;
  width: 100%;
  z-index: -1;
}    



</style>

<div class="container">

<h3 >List of Clients</h3>
<!--  <a href="#myModal" style="float: right" data-toggle="modal" class="btn btn-success">Create Client</a> -->
 
 <a href="{{url('/clients/create')}}" style="float: right" class="btn btn-success">Create Client</a>

<hr >
<div class="row"> 
<table class="table table-stripped table-bordered" id="comp-table"> 
{{-- <table class="table table-responsive" id="comp-table"> --}}
    <thead>
        <tr>
            <th>Id</th>  
            <th></th>
            <th>Company Name</th>
            <th>Website</th>
            <th>Phone</th>
            <th>Client Name</th>
            <th>Primary Email</th>
            <th>State</th>
            <th>Country</th>
            <th>Contact 1</th>
            
        </tr>
    </thead>
</table>
</div>
</div>

@include('pages.clients.modals.create.clients' , ['SubmitTextButton'=>'Add']  )
@include('pages.clients.modals.edit.clients' , ['SubmitTextButton'=>'Edit']  )
<!-- , , ['SubmitTextButton'=>'Add'] -->
@endsection


@push('scripts')
<script>
$(function() {
var table =   $('#comp-table').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'id' ,  name: 'id', 'visible': false},
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'client_company', name: 'client_company' },
            { data: 'website', name: 'website' },
            { data: 'phone', name: 'phone' },
            { data: 'client_name', name: 'client_name' },
            { data: 'client_email_primary', name: 'client_email_primary' },
            { data: 'client_state', name: 'client__state' },
            { data: 'client_country', name: 'client_country' },
            { data: 'client_contact_1', name: 'client_contact_1' }
           
        ]
    });
});


$(document).ready(function(){
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
                    table1.ajax.reload();
    });
    }
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
    
        if (window.location.pathname == '/datatables') {
            // jQuery.noConflict();
            // alert(client_id);
            //var url = '/laravel/public/clients/'+client_id+ '/edit';
            //var url = '/laravel/public/datatables/'+client_id ;
            var url = '/datatables';
            
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

        else if (window.location.pathname == ('/datatables/' + client_id)) {
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
@endpush