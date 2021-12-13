<!-- <h1>Add Order</h1> -->
<!-- <p class="lead">Add to your task list below.</p>
<hr> -->
<!-- form validation -->
       {{--  <script type="text/javascript" src="{{ URL::asset('js/form/jquery.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.js') }}"></script> --}}
        <!-- form validation over -->
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif


<?php

$dt = new DateTime();
$local1 = new DateTime();

$dt->setTimezone(new DateTimeZone('America/New_York'));
$dt1= $dt->format('Y-m-d H:i:s');

$local1->setTimezone(new DateTimeZone('Asia/Kolkata'));
$local= $local1->format('Y-m-d H:i:s');


$valid_dt = date('Y-m-d H:i:s', strtotime($dt1));
$local_dt = date('Y-m-d H:i:s', strtotime($local));


?>

<input type="hidden" name="id" id="id"  />

 {!! Form::hidden('file_count', null, ['class' => 'required fcount form-control' ]) !!}

<div class="inner">
 <p> </p>
 </div>

<div class="table-responsive">
<table class="table table-bordered"  id="orderdtls" >
    <thead class="tablehead">
    <tr>
         <th>Sr.No.</th>
         <th>Doc.Type</th>
         <th>File Type</th>
         <th>Filename</th>
         <th>File Note</th>
         <th>Allocation</th>
         <th>Status</th>
    </tr>
    </thead>
    <tbody>
       <?php $i=0 ; for($i=0; $i< 5; $i++ ) {    ?>
       <tr>
            <td>
              {{ Form::text('order_id') }}

               {{--   {!! Form::select('document_type[]', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], null, ['class' => 'form-control']) !!} --}}
            </td>
            <td>
                {!! Form::select('file_type[]', ['Vector' => 'Vector', 'Digitizing' => 'Digitizing','Photoshop' =>'Photoshop'] , 'Vector', 
                            ['class' => 'editftype form-control', 'required'=> 'required' ]) !!}
            </td>
           <td>
                {!! Form::text('file_name[]', null, ['class' => 'required form-control', 'required'=> 'required']) !!}
           </td>
           <td>
                {!! Form::textarea('note[]', null, ['class' => 'expand  form-control']) !!}
           </td>
           {{-- <td>
                {!! Form::select('allocation1[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId1', 'class' => 'fooalloc form-control',  'onfocus'=> 'this.size=4;'   ]) !!}

        
           </td>
           <td>
              {!! Form::select('status2', $status, null, [ 'multiple'=>'multiple', 'id'=>'status2', 'class' => 'fooalloc form-control']) !!}
               
           </td> --}}
       </tr>
       <?php } ?>
    </tbody>
</table>  


</div> 


<div class="row">

  


{{-- <div class="row">
   
  

    <div class="col-sm-3">
        <div class="form-group">
              {!! Form::label('stiches_count', 'Stiches', ['class' => 'control-label']) !!}
              {!! Form::number('stiches_count', 0, ['class' => 'form-control editscount', 'readonly' => 'readonly']) !!}
        </div>
    </div> 
    

   <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor :', ['class' => 'control-label']) !!}
            {!! Form::select('vendor', $vendors,  '', ['readonly' => 'readonly', 'class' => 'editvend required form-control'  
              ]) !!} 
        </div>
    </div>

     <div class="col-sm-3">
        <div class="form-group">
        @if (isset($var))
            @if (in_array('vend-file-price-modify', $var))
                {!! Form::label('vendor_digit_price', 'V.Digi Price', ['class' => 'control-label']) !!}
                {!! Form::number('vendor_digit_price', 0.00,
                 ['class' => 'edit_vendor_digit_price form-control']) !!}
            @else

                @if (in_array('vend-file-price-show', $var))
                    {!! Form::label('vendor_digit_price', 'V.Digi Price', ['class' => 'control-label']) !!}
                    {!! Form::number('vendor_digit_price', 0.00, ['class' => 'edit_vendor_digit_price form-control', 'readonly' => 'readonly']) !!}
           
                @else
                  
                    {!! Form::hidden('vendor_digit_price', 0.00, ['class' => 'edit_vendor_digit_price form-control']) !!}
                @endif
            @endif
           
        @endif      
          
        
        </div>
    </div>

 </div> --}}

{{-- <div class="row">

    <div class="col-sm-4">    
        <div class="form-group">
           
            @if (isset($var))
            @if (in_array('file-price-modify', $var))

                    {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
                    {!! Form::number('file_price', 0.00, ['readonly' => 'readonly', 'class' => 'edit_file_price form-control']) !!}  
                
            @else
                @if (in_array('file-price-show', $var))             

                    {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
                    {!! Form::number('file_price', 0.00, ['class' => 'form-control edit_file_price',
                    'readonly' => 'readonly'  ]) !!}  
              
                @else
                    {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
                       {!! Form::hidden('file_price', 0.00, ['readonly' => 'readonly', 'class' => 'form-control edit_file_price']) !!}  
        
                @endif
            @endif
            @endif  
        </div>
    </div>  

     <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('order_date_time', 'Order Date(India)', ['class' => 'control-label']) !!}
            {!! Form::text('order_date_time', $local_dt, ['readonly' => 'readonly', 'class' => 'form-control','id'=>'order_date_time']) !!}
        </div>
    </div>    

     <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('order_us_date', 'Order Date(US)', ['class' => 'control-label']) !!}
            {!! Form::text('order_us_date', $valid_dt, [ 'readonly' => 'readonly', 'class' => 'form-control', 'id' =>'order_us_date']) !!}
         
        </div>
    </div>    

  

    


    <div class="col-sm-3">
       <div class="form-group">
        @if (isset($var))
        @if (in_array('order-status-modify', $var))

        
                   {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                   {!! Form::select('status', $status, [ 'id'=>'status1', 'readonly'=> 'readonly','class' => 'finalstatus form-control']) !!}
        @else
           
                     {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                     {!! Form::select('status', $status, null, [ 'id'=>'status1', 
                     'readonly'=>'readonly', 'class' => 'finalstatus hidestatus form-control']) !!}
        
        @endif
        @endif
        </div>
    
    </div>

   

   

</div>
 --}}
{{-- <div class="row">
    <div class="col-sm-4">  
                {!! Form::label('target_completion_time', 'Target Date', ['class' => 'control-label']) !!}
                {!! Form::text('target_completion_time', null,  ['readonly'=>'readonly', 
                'class' => 'form-control', 'id' => 'target_completion_time' ]) !!}
    </div>
     <div class="col-sm-4">  
                {!! Form::label('approval_time', 'Approval time', ['class' => 'control-label']) !!}
                {!! Form::text('approval_time', null,  ['readonly'=>'readonly', 
                'class' => 'form-control', 'id' => 'approval_time' ]) !!}
    </div>
</div>
 --}}

