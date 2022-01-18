@extends('layouts.master_body_tmp')

@section('content')
  
 
<style type="text/css">

#dformat   {
   color: blue !important;
   background: #FFFACD !important;

 }

.pfrdt {
  color: blue ;
 }

 .ptodt {
  color: blue ;
 }
  
</style>

@php
      
    $local1 = new DateTime();
    $local= $local1->format('d-m-Y');


@endphp

<div class="container">
 <div class="row">
  <div class="col-md-10 col-sm-10 col-md-offset-1">
   <div class="panel panel-default">
    <div class="panel-heading">Invoice Report</div>

   
   
   <div class="panel-body">
      <form class="form-horizontal" id="rp" role="form" method="POST" 
       action="invoicestatus">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
              {{-- <select name="dformat">
                  <option value="Preview">Preview</option>
                  <option value="Download">Download</option>
              </select>  --}}
             <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pfr_dt', 'From Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pfr_dt', null, ['class' => 'form-control pfrdt', 'id' =>'pfr_dt']) !!}
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


</script>
@endpush
