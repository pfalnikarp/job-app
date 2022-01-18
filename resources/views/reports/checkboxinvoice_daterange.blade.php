@extends('layouts.newdashbord')

@section('content')
  
 
<style type="text/css">

#dformat   {
   color: blue !important;
   background: #FFFACD !important;

 }

/*.pfrdt {
  color: blue ;
 }

.clcomp {
  color: blue ;
 }

 .invopt {
   color: blue;
 }

.searchbutton {
  background: grey;
  border-style: none;
}

.searchcomp {
  color: blue;
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
*/
 
 th {
  color: white !important;
 }

  .border1 {
    border-style: solid;
    border-color: green;
  }


  .sel-comp-table-cont { width:100%; overflow-x:auto;  } 
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

{{-- @if (session('msg'))
    <div class="alert alert-danger">
        {{ session('msg') }}
    </div>
@endif --}}

@if(Session::has('alert-warning'))
    <div class="alert alert-warning">
        {{ Session::get('flash_message1') }}
    </div>
@endif



@php
      
    $local1 = new DateTime();
    $local= $local1->format('d-m-Y');

   // dd($month);die;
@endphp

<div class="container">
 <div class="row">
 <div class="panel-group">

<!-- second panel -->
<div  class="col-md-10 col-sm-10 ">
   <div class="panel panel-default">
    <div class="panel-heading">Invoice Date Range </div>
    
   
   <div class="panel-body border1">
      <form class="form-horizontal" id="rp1" role="form" method="POST" 
       action="inv_date_option">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
           
             <div class="row">
              {{-- <div class="col-sm-6 col-md-offset-1">   --}}
               
              <div class="form-group">
                  <div class="col-md-2">  
                     {!! Form::label('pfr_dt', 'From US Date', ['class' => 'control-label']) !!}
                  </div>
                  <div class="col-md-3">
                     {!! Form::text('pfr_dt', null, ['class' => 'form-control pfrdt', 'id' =>'pfr_dt']) !!}
                  </div>
            
                  <div class="col-md-2">   
                     {!! Form::label('pto_dt', 'To US Date', ['class' => 'control-label']) !!}
                  </div>
                  <div class="col-md-3">   
                     {!! Form::text('pto_dt', null, ['class' => 'form-control ptodt', 'id' =>'pto_dt']) !!}
                  </div>
             {{--  </div> --}}
            </div>
            </div>

            <div class="row">
             
              <div class="form-group">
                  <div class="col-md-2">   
                    {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
                  </div>
                  <div class="col-md-4">
                    {!! Form::select('file_type', [ 'Vector' => 'Vector', 'Digitizing' => 'Digitizing' ,'Photoshop' =>'Photoshop', 'ALL' => 'ALL'] , 'ALL', ['class' => 'ftype form-control']) !!}
                  </div>
             
              </div>    
             </div> 
              
          
            {{-- <div class="row">
              
              <div class="form-group">
                  <div class="col-sm-1 "></div>
                  <div class="col-sm-1 "> 
                     {!! Form::label('pyear', '  Year :', ['class' => 'control-label']) !!}
                  </div>  
                  <div class="col-sm-2 ">     
                     {!! Form::select('pyear', $year, '2017', ['class' => 'form-control yearclass']) !!}
                  </div>
                  <div class="col-sm-1 "></div> 
                  <div class="col-sm-1 "> 
                     {!! Form::label('pmonth', '  Month :', ['class' => 'control-label']) !!}
                  </div>
                  <div class="col-sm-2 ">  
                     {!! Form::select('pmonth', $month, 'JAN', ['class' => 'form-control monthclass']) !!}
                    
                  </div>
              </div>
            </div> 
            <div class="row ">
                <div class="form-group">
                   <div class="col-sm-1 "></div>
                  <div class="col-sm-3">
                    {!! Form::label('pinvdtoption', 'Create Invoice Datewise option:', ['class' => 'control-label']) !!}
                  </div>
                  <div class="col-sm-3">
                    {!! Form::select('pinvdtoption', ['0'=>'Us Order Date', '1'=>'Approval Date', '2'=>'Completion date'], 0, ['class' => 'form-control invopt ']) !!}
                  </div>
                </div> 
            </div>  --}}

          <div class="row">
                 
            <div class="col-sm-6">
              <div class="sel-comp-table-cont">
              <div class="table-responsive"> 

                  <div class="input-group col-sm-4 custom-search-form">
                             <input type="text" class="form-control searchcomp" id= "myInput" name="search" placeholder="Search...">
                              {{-- <span class="input-group-btn searchbutton">
                              <button class="btn btn-default-sm " type="submit">
                                      <i class="fa fa-search"></i>
                              </button>
                              </span> --}}
                  </div>
                  <table class="table  table-bordered table-hover sel-comp" id="myTable2" > 
                    <thead>
                       <th><INPUT id="example-select-all" value="1" type="checkbox" name="select_all"></th>
                       <th>  Company Name  </th>
                    </thead>
                    <tbody>
                    {{--   @foreach($company as $comp)
                            <tr>
                              <td>{{ Form::checkbox('client_company', 'yes') }}
                              <td>{{ $comp }}</td>
                            </tr>
                      @endforeach --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>  
            <div class="col-sm-4 col-md-offset-2">
                 <div>Status</div>
                  
                 <table class="table  table-bordered table-hover myTable3" id="myTable3" > 
                    <thead>
                  
                    @foreach($status as $st)
                   

                       <tr>
                       <th><input type="checkbox" name="st[{{ $st }}]" value ="{{ $st }}"></th>
                       <th >{{ $st }} </th>
                      </tr> 
                  
                    
                    @endforeach
                    {{--   <tr>
                       <th><input type="checkbox" name="st_completed" value ="Completed"></th>
                       <th >  Completed  </th>
                      </tr> 
                      <tr>
                       <th><input type="checkbox" name="st_revision" value ="Revision"></th>
                       <th >  Revision  </th>
                      </tr> 
                      <tr>
                       <th><input type="checkbox" name="st_alloted" value ="Alloted"></th>
                       <th >  Alloted  </th>
                      </tr> 
                      <tr>
                       <th><input type="checkbox" name="st_qcok" value ="QC OK"></th>
                       <th >  QC OK  </th>
                      </tr> 
                      <tr>
                       <th><input type="checkbox" name="st_qcpending" value ="QC Pending"></th>
                       <th >  QC Pending  </th>
                      </tr>  --}}
                    </thead>
                    <tbody>
                    {{--   @foreach($company as $comp)
                            <tr>
                              <td>{{ Form::checkbox('client_company', 'yes') }}
                              <td>{{ $comp }}</td>
                            </tr>
                      @endforeach --}}
                    </tbody>
                  </table>
                 {{-- <div class="form-group">
                     <div class="col-sm-1">
                          <input type="checkbox" name="st_completed" value ="Completed">
                     </div> 
                     <div class="col-sm-3 "> 
                       {!! Form::label('st_completed', 'Completed', ['class' => 'control-label']) !!}
                    </div>
                     
                      <br><input type="checkbox" name="st_revision" value ="Revision">Revision
                      <br><input type="checkbox" name="st_allocation" value ="Revision">Allocation
                       
                     </div> --}}

                 </div>

            </div>
                  
                             
                
        
      
            <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                    {!! Form::label('dformat', 'Print Format', ['class' => 'control-label']) !!}
                    {!! Form::select("dformat", ["Preview"=>"Preview", "Download"=>"Download"],
                    ['class' => 'required dfoo form-control', 'id'=>'dformat', 'required'=>'required', 'onfocus'=> 'this.size=2;']) !!}
                  </div>
              </div>
            </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button id="pbutton" type="submit" class="btn btn-primary">Print Invoice</button>
                        </div>
                       {{--  <div class="col-sm-6">
                            <button id="pdownload"  type="submit" class="btn btn-primary">Download</button>
                        </div> --}}
                    </div>
                     {{-- <input type="hidden" class=".pr" name="pr" value="1" >
                     <input type="hidden" class= ".download" name="download" > --}}
      </form>
    </div>  
    </div>

</div> 
 </div>


<!-- third panel -->

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


// added on 05/10/18
 $(".ptodt").datepicker({ dateFormat: 'yy/mm/dd'});
 $(".pfrdt").datepicker({ dateFormat: 'yy/mm/dd'});
// added on 05/10/18 

 // $(".pfrdt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
 //   changeYear: true});

 
 // $(".ptodt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
 //   changeYear: true});
  
});

$('.ptodt').change(function(event) {
  /* Act on the event */
   //alert(this.value);
  
   pfr_dt =  $(".pfrdt").val();
   pto_dt =  $(".ptodt").val();

   $(".sel-comp tbody >tr").remove();

   $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('jasper/search_dt') }}",
            data: {"pfr_dt": pfr_dt, "pto_dt" : pto_dt},
            success:function(data)
                  {  
                     console.log(data);
                    $(".sel-comp tbody").append(data);
                  }
        
        });
});


// $('.searchcomp').keyup(function(event) {
//   /* Act on the event */
//    //alert(this.value);
  
//    j  =  this.value ;
//    pmonth =  $('.monthclass').val();
//    pyear  =  $('.yearclass').val();

//    if ( pyear == '' ||  pmonth == '') {
//        //   alert(pyear);
//        alert('select first year and month');
//        event.preventDefault();
//        return false;
//     }

//     // alert(pyear);
//     $(".sel-comp tbody >tr").remove();

//     if(pcomp == '') {
//        alert('This cannot be blank');
//        return ;
//     }
//     else{
//         $.ajax({
//             type: "GET",
//             cache: false,
//             url: "{{ URL::to('jasper/search') }}",
//             data: {"pmonth": pmonth, 'pyear' : pyear , 'pcomp' : pcomp},
//             success:function(data)
//                   {  
//                      console.log(data);
//                     $(".sel-comp tbody").append(data);
//                   }
        
//         });
//     }
// });

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
 


</script>
@endpush
