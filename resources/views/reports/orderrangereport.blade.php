@extends('layouts.newdashbord')

@section('content')
  
 
<style type="text/css">

#dformat   {
   color: blue !important;
   background: #FFFACD !important;

 }

 #option1 {
   color: blue !important;
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
<br>
    <h5>Completed Orders - Date Range in CSV format</h5> 
    <form class="" id="rp" role="form" method="POST" 
       action="orderreport">
<div class="card temcolor1">
  <div class="card-body">
    <div class="row">
     
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
             
             
              <div class="col-sm-4 col-md-offset-4">  
                  <div class="form-group">
                  
                     {!! Form::label('pfr_dt', 'From Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pfr_dt', null, ['class' => 'form-control pfrdt', 'id' =>'pfr_dt']) !!}
                  </div>
              </div>
         

              <div class="col-sm-4 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('pto_dt', 'To Date', ['class' => 'control-label']) !!}
                     {!! Form::text('pto_dt', null, ['class' => 'form-control ptodt', 'id' =>'pto_dt']) !!}
                  </div>
              </div>
              

              <div class="col-sm-6 col-md-offset-1">  
                  <div class="form-group">
                  
                    {!! Form::label('dformat', 'Print Format (CSV)', ['class' => 'control-label']) !!}
                    {!! Form::select("dformat", ["Preview"=>"Preview", "Download"=>"Download"],
                    ['class' => 'required dfoo form-control', 'id'=>'dformat', 'required'=>'required', 'onfocus'=> 'this.size=2;']) !!}
                  </div>
              </div>

           
              <div class="col-sm-4 col-md-offset-1">  
                  <div class="form-group">
                  
                     {!! Form::label('option1', 'Option', ['class' => 'control-label']) !!}
                     {!! Form::select('option1', ['0'=>'Order Date wise', '1'=>'Approval Date Wise' ,  '2'=>'Approval US Date Wise'],'1', ['class' => 'form-control', 'id' =>'option1']) !!}
                  </div>
              </div>
         

         
        

                    <div class="form-group">
                        <div class="col-sm-6">
                            <button id="pbutton" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      
                    </div>
                     <input type="hidden" class=".pr" name="pr" value="1" >
       
              <input type="hidden" class= ".download" name="download" >
             </div>
  
</div>
      </form>
   
<!-- second panel -->


<!-- third panel -->

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


 // $(".pfrdt").datetimepicker({ changeMonth: true, selectOtherMonths: true,
 //   changeYear: true});
 // $(".ptodt").datetimepicker({dateFormat: 'dd-mm-yyyy'});


 $(".pfrdt").datepicker({dateFormat: 'dd-mm-yy'});
 $(".ptodt").datepicker({dateFormat: 'dd-mm-yy'});
  
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
@endsection
