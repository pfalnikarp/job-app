@extends('layouts.newdashbord')
@section('style')
<style type="text/css">

#dformat   {
   color: blue !important;
   background: #FFFACD !important;

 }

.pfrdt {
  color: blue ;
 }

.clcomp {
  color: blue ;
 }

 .ptodt {
  color: blue ;
 }

#pyear {
  color: blue ;
 }

 #pmonth{
  color: blue ;
 }
   

  .border1 {
    border-style: solid;
    border-color: green;
  }



table#select-order td, th {
  position: relative;
  /*background: transparent ; removed on 02/05/17 */
  text-align: center;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
  border-top: 0px;
  font-size: 14px;
  /*color: white !important;*/
  color: blue !important;
  white-space: nowrap;  
  /*border-collapse: separate;
   empty-cells: hide;*/
  
}

.custom-search-form
{
   border: box;

}

  .sel-comp-table-cont { width:100%; height:70%; overflow-x:auto;  } 
  .sel-comp-table-cont .table-responsive { width:700px;  }
  .sel-comp { table-layout:fixed;  } 
  .sel-comp  thead, .sel-comp tbody { 
              display: block;
      }


/*
  .myTable3 {
    color: blue;
  }
*/
  .sel-comp  {
       width: 40%;
       border: 1px solid #ddd;
       border-color: #33ffec;
       font-size: 14px;
      
  }

  .sel-comp tbody { max-height:400px; overflow-y:auto; } 

</style>
@endsection
@section('content')
@php
      
    $local1 = new DateTime();
    $local= $local1->format('d-m-Y');

   // dd($month);die;
@endphp

@if(Session::has('flash_message1'))
    <div class="alert alert-warning  ">
        {{ Session::get('flash_message1') }}
    </div>
@endif

<div class="row blink_me1">
  
</div>

<br>
  <h5>Invoice Monthly </h5>
 <div class="row">

   <div class="col-md-12">
     <div class="card temcolor1">
  
    
   
    <div class="card-body">

      <form class="form-horizontal" id="rp1" role="form" method="POST" 
       action="postinvyrmonth">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
           

            <div class="row">
              <div class="col-sm-3 col-md-2">  
                  <div class="form-group">
                  
                     {!! Form::label('pyear', 'Year :', ['class' => 'control-label']) !!}
                     {!! Form::select('pyear', $year, null, ['class' => 'form-control yearclass']) !!}
                  </div>
              </div>  

              <div class="col-sm-1">
                
              </div>      

              <div class="col-sm-2 ">  
                  <div class="form-group">
                  
                     {!! Form::label('pmonth', 'Month :', ['class' => 'control-label']) !!}
                     {!! Form::select('pmonth', $month, null, ['class' => 'form-control monthclass']) !!}
                    
                  </div>
              </div>
          
            
              
              </div>
               
               <!--  select companies-->
              <div class="row">
                 <div class="col-sm-6">
              <div class="sel-comp-table-cont">
              <div class="table-responsive"> 

                  <div class="input-group col-sm-4 custom-search-form">
                             <input type="text" class="form-control searchcomp" id= "myInput" name="search" placeholder="Search...">
                           
                  </div>
                  <table class="table  table-bordered table-hover sel-comp" id="myTable2" > 
                    <thead>
                       <th><INPUT id="example-select-all" value="1" type="checkbox" name="select_all"></th>
                       <th>  Company Name (select all) </th>
                    </thead>
                    <tbody>
                  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>  
              </div>
               <!-- select companies --> 
              <div class="row">
                 <input type="hidden" name="pbutton" class="pbutton" value='1' >
                <!--  <div class="form-group col-md-3 ml-2">
                            <button id="pbutton1" type="submit" class="btn btn-primary pbutton1" data-toggle="tooltip" title="This Option will Create New Invoices if not generated" >Generate Invoice for the Month</button>
                  </div>   -->
              
                 <div class="form-group col-md-3 ">
                            <button id="pbutton2" type="submit" class="btn btn-primary pbutton2" data-toggle="tooltip" title="This Option will Overwrite Invoices Without any Notice">Overwrite  Invoice for the Month</button>
                  </div>  
              
                <!--  <div class="form-group col-md-3">
                            <button id="pbutton3" type="submit" class="btn btn-primary" data-toggle="tooltip" title="This Option will Update/Missing Invoices Without any Notice" >Update/Missing  Invoice for the Month</button>
                  </div>   -->
              </div> 



             
    
    <!--  datatables -->

    

  </form>
</div>
</div>
</div>
 </div> 



@endsection

@section('script')

<script>


$(document).ready(function(){

  //var formid = $(this).parents('form:first').attr('id');
  //var formid1 =  "#" + formid  ;
  //$("#rp").find('.pr').text("hello");
 //alert($("input[name='pr']").val()); 
 //perfectly identifying value;
 
 //$("#pbutton").click(function(event) {
//   /* Act on the event */
  //event.preventDefault();
 // debugger;
 
// });

 //$("#pdownload").click(function(event) {
   //* Act on the event */
 
 //});

$('[data-toggle="tooltip"]').tooltip();  

  $('#select-order').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        scrollX: true,
        scrollY: 400,  
        scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        bStateSave: true,
      
        scroller: {
           rowHeight: 1
        }, 
          ajax: '{!! route('jasperinvoice.data') !!}',
                  
        columns: [
         
           { data: 'id',  name: 'id'},
           { data: 'client_company', name: 'client_company' },
           { data: 'client_name', name: 'client_name'   },
           { data: 'order_id', name: 'order_id', 
                    "render": function (data, type, full, meta) {
                            return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
            },
            { data: 'order_date_time', name: 'order_date_time' , width: '100px' },
            { data: 'client_email_primary', name: 'client_email_primary',  orderable: true,             

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
            { data: 'id', name: 'id' , class: 'fooid idRow',  width: '2px', sortOrder: 'desc'},
           
            { data: 'status', name: 'status' ,   width: '2px', sortOrder: 'desc'}
           
            ]
             ,
          columnDefs: [{
                     targets: 0,
                     searchable:false,
                     orderable:false,
                    className: 'dt-body-center',
                    render: function (data, type, full, meta){
                      return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                  }
                }],
              pageLength: "25",
              pagination: true,
              responsive: true,
              order: [[ 10, "desc" ]]
     
        
    });



      $(".pfrdt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
         changeYear: true});
     $(".ptodt").datetimepicker({dateFormat: 'dd-mm-yyyy'});

     
    // $('#example-select-all').on('click', function(){
     
    //     var table = $('#select-order').DataTable();
    //     var rows = table.rows({ 'search': 'applied' }).nodes();
     
    //     $('input[type="checkbox"]', rows).prop('checked', this.checked);
        
    //     var tabledt = table.$('input[type="checkbox"]').serialize();


    // });

   
  
});

$(document).ready(function(){

 $(document).on('click', '.pbutton1', function(e) {
            // alert($(".pbutton").val());
        $(".pbutton").val(1);
        $(".blink_me1").css('color', 'blue');
        $(".blink_me1").text('Please keep this browser open , Dont Close browser or press any key, wait pdf is generating..., continue work on new tab');

         
       
    });

  

      $(document).on('click', '.pbutton2', function(e) {
             alert('2 selected');
        $(".pbutton").val(2);
          $(".blink_me1").css('color', 'blue');
        $(".blink_me1").text('Please keep this browser open , Dont Close browser or press any key, wait pdf is generating..., continue work on new tab');

        // $(".blink_me1").fadeIn(3000);
        // $(".blink_me1").delay(500);
        // $(".blink_me1").fadeOut( "slow" );
    });

    $("#pbutton3").on('click',function(){

        $(".pbutton").val(3);
    });


    $('.monthclass').change(function(event) {
  /* Act on the event */
  //alert(this.value);
   //debugger;
   pmonth =  this.value -1;
   pyear  =  $('.yearclass').val();

   $(".sel-comp tbody >tr").remove();

   $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('jasper/search') }}",
            data: {"pmonth": pmonth, 'pyear' : pyear},
            success:function(data)
                  {  
                     console.log(data);
                    $(".sel-comp tbody").append(data);
                  }
        
        });
     $('.searchcomp').focus();
});


$('.monthclass').select(function(event) {
  /* Act on the event */
   //alert(this.value);
   //debugger;
   pmonth =  this.value -1;
   pyear  =  $('.yearclass').val();

   $(".sel-comp tbody >tr").remove();

   $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('jasper/search') }}",
            data: {"pmonth": pmonth, 'pyear' : pyear},
            success:function(data)
                  {  
                     console.log(data);
                    $(".sel-comp tbody").append(data);
                  }
        
        });

     $('.searchcomp').focus();
});


$('.searchcomp').keyup(function(event) {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
});

 $('#example-select-all').click(function (e) {
           $(this).closest('table').find('td input.chk').prop('checked', this.checked);
          
  });

});

 function blink_text() {
    $('.blink_me1').fadeOut(1500);
    $('.blink_me1').fadeIn(500);
}
setInterval(blink_text, 10000);


</script>
@endsection
