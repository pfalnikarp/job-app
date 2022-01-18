@extends('layouts.bootswatchold030117')

@section('content')
  
 
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

</style>

@php
      
    $local1 = new DateTime();
    $local= $local1->format('d-m-Y');

   // dd($month);die;
@endphp

<div class="container">
 <div class="row">
 
<!-- second panel -->

      <form class="form-horizontal" id="rp1" role="form" method="POST" 
       action="reportallocmonthwise">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
           

            <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pyear', 'Year :', ['class' => 'control-label']) !!}
                     {!! Form::select('pyear', $year, null, ['class' => 'form-control ']) !!}
                  </div>
              </div>        

              <div class="col-sm-2 ">  
                  <div class="form-group">
                  
                     {!! Form::label('pmonth', 'Month :', ['class' => 'control-label']) !!}
                     {!! Form::select('pmonth', $month, null, ['class' => 'form-control ']) !!}
                    
                  </div>
              </div>
          
              {{-- <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                    {!! Form::label('dformat', 'Print Format', ['class' => 'control-label']) !!}
                    {!! Form::select("dformat", ["Preview"=>"Preview", "Download"=>"Download"], "Preview",
                    ['class' => 'required dfoo form-control', 'id'=>'dformat', 'required'=>'required', 'onfocus'=> 'this.size=2;']) !!}
                  </div>
              </div>
              --}}
             
              </div>

              <div class="row">
                
              
               <div class="form-group col-sm-2">
                            <button id="pbutton" type="submit" class="btn btn-primary">Submit</button>
              </div>  
              
              </div>  
             
    
    <!--  datatables -->

    

  </form>
</div>
</div>

@endsection

@push('scripts')


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

     // Handle click on "Select all" control
    $('#example-select-all').on('click', function(){
      // Get all rows with search applied
        var table = $('#select-order').DataTable();
        var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        
        var tabledt = table.$('input[type="checkbox"]').serialize();
    });
  
});


</script>
@endpush
