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
</style>

@php
      
    $local1 = new DateTime();
    $local= $local1->format('d-m-Y');

   // dd($month);die;
@endphp

<div class="container">
 <div class="row">
 <div class="panel-group">
  <div class="col-md-4 col-sm-4">
   <div class="panel panel-default">
    <div class="panel-heading">Invoice Date-Wise Report</div>

   
   {{-- <div class="panel-body border1">
      <form class="form-horizontal" id="rp" role="form" method="POST" 
       action="printinvoice">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
             
             <div class="row">
              <div class="col-sm-6 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pfr_dt', 'From Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pfr_dt', null, ['class' => 'form-control pfrdt', 'id' =>'pfr_dt']) !!}
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pto_dt', 'To Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pto_dt', null, ['class' => 'form-control ptodt', 'id' =>'pto_dt']) !!}
                  </div>
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
                      
                    </div>
                     <input type="hidden" class=".pr" name="pr" value="1" >
              <input type="hidden" class= ".download" name="download" >
      </form>
    </div> --}}
  
</div>
</div>
<!-- second panel -->
<div  class="col-md-6 col-sm-6 ">
   <div class="panel panel-default">
    <div class="panel-heading">Invoice Monthly- CompanyWise </div>
    
   
   <div class="panel-body border1">
      <form class="form-horizontal" id="rp1" role="form" method="POST" 
       action="printinvoicecompanywise">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
           

            <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pyear', 'Year :', ['class' => 'control-label']) !!}
                     {!! Form::select('pyear', $year, '2017', ['class' => 'form-control yearclass']) !!}
                  </div>
              </div>        

              <div class="col-sm-3 ">  
                  <div class="form-group">
                  
                     {!! Form::label('pmonth', 'Month :', ['class' => 'control-label']) !!}
                     {!! Form::select('pmonth', $month, 'JAN', ['class' => 'form-control monthclass']) !!}
                    
                  </div>
              </div>
            </div>

            <div class="row">
                  {{-- <div class="form-group col-sm-10" >
                  
                     {!! Form::label('client_company', 'Company :', ['class' => 'control-label']) !!}
                  
                    <div class="compupd"></div>
                  </div> --}}
                   <table class="table  table-bordered table-hover myTable3" id="myTable3" > 
                   <tbody>
                  @foreach($status as $st)
                   

                       <tr>
                       <td><input type="checkbox" name="st[{{ $st }}]" value ="{{ $st }}"></td>
                       <td >{{ $st }} </td>
                      </tr> 
                  
                    
                    @endforeach
                   </tbody>
                   </table>          
                
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
                     <input type="hidden" class=".pr" name="pr" value="1" >
              <input type="hidden" class= ".download" name="download" >
      </form>
    </div>  

</div> 
 </div>


<!-- third panel -->
<div  class="col-md-3 col-sm-3 ">
   <div class="panel panel-default">
    <div class="panel-heading">Invoice Monthly</div>
   {{--  <p>Files generated path is var/wwww/html/blognew/public/report/ & yr mon (eg. 2001707) </p> --}}
   
   {{-- <div class="panel-body border1">
      <form class="form-horizontal" id="rp1" role="form" method="POST" 
       action="printinvoicemonthly">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
   
            <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pyear', 'Year :', ['class' => 'control-label']) !!}
                     {!! Form::select('pyear', $year, ['class' => 'form-control', 'id' =>'pyear']) !!}
                  </div>
                </div>        
                <div class="col-sm-3 ">  
                  <div class="form-group">
                  
                     {!! Form::label('pmonth', 'Month :', ['class' => 'control-label']) !!}
                     {!! Form::select('pmonth', $month, ['class' => 'form-control ', 'id' =>'pmonth']) !!}
                  </div>
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
                      
                    </div>
                     <input type="hidden" class=".pr" name="pr" value="1" >
              <input type="hidden" class= ".download" name="download" >
      </form>
    </div>   --}}

</div> 
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


 $(".pfrdt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
   changeYear: true});
 $(".ptodt").datetimepicker({dateFormat: 'dd-mm-yyyy'});
  
});

$('.monthclass').change(function(event) {
  /* Act on the event */
   //alert(this.value);
   pmonth =  this.value;
   pyear  =  $('.yearclass').val();
   //alert(pyear);
   $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('jasper/searchcompany') }}",
            data: {"pmonth": pmonth, 'pyear' : pyear},
            success:function(data)
                  {  
                     console.log(data);
                    $(".compupd").html(data);
                  }
        
        });
});

 


</script>
@endpush
