@extends('layouts.newdashbord')


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
<br>
  <h5>Clients Generated - Date Range</h5>
<form class="form-horizontal" id="rp" role="form" method="POST" action="clientlist">
     <div class="card temcolor1">
      <div class="card-body">
        <div class="row">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
            
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pfr_dt', 'From Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pfr_dt', null, ['class' => 'form-control pfrdt', 'id' =>'pfr_dt']) !!}
                  </div>
              </div>
        

        
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pto_dt', 'To Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pto_dt', null, ['class' => 'form-control ptodt', 'id' =>'pto_dt']) !!}
                  </div>
              </div>

                <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('bulk order', 'bulk order', ['class' => 'control-label']) !!}
                   <input checked="checked" name="bulk" type="checkbox" value="yes">
                  </div>
              </div>
          </div>

            <div class="row">
              <div class="col-sm-3 col-md-offset-1">  
                  <div class="form-group">
                  
                    {!! Form::label('dformat', 'Print Format', ['class' => 'control-label']) !!}
                    {!! Form::select("dformat", [  "csv" =>"csv", "Preview"=>"Preview", "Download"=>"Download", "Ods"=>"Ods", "HTML"=>"HTML", "Docx"=>"Docx"],
                    ['class' => 'required dfoo form-control', 'id'=>'dformat', 'required'=>'required', 'onfocus'=> 'this.size=2;']) !!}
                  </div>
              </div>
            </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button id="pbutton" type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                       {{--  <div class="col-sm-6">
                            <button id="pdownload"  type="submit" class="btn btn-primary">Download</button>
                        </div> --}}
                    </div>
                     <input type="hidden" class=".pr" name="pr" value="1" >
              <input type="hidden" class= ".download" name="download" >
              </div>
  

   
 </div>
</form>
    
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

 $(".pfrdt").datepicker({dateFormat: 'yy/mm/dd'});
 $(".ptodt").datepicker({dateFormat: 'yy/mm/dd'});


 //$(".pfrdt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
  // changeYear: true});
 //$(".ptodt").datetimepicker({dateFormat: 'dd-mm-yyyy'});
  
});


</script>
@endsection
