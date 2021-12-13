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

<div class="row">
      
    <div class="col-sm-4">

        <div class="form-group">
        {!! Form::label('client_name', 'Client Name', ['class' => 'control-label']) !!}
       
    	{!! Form::text('client_name', null,  ['required'=>'required', 'class' => 'form-control clientinput' ]) !!}
        </div>
      
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('client_creation_id', 'Client Creation-Id', ['class' => 'control-label']) !!}
            {!! Form::text('client_creation_id', null,  ['class' => 'form-control ' , 'readonly' => 'true']) !!}
        </div>
    </div>
   

    <div class="col-sm-4">
    
        <div class="form-group">
        {!! Form::label('client_email_primary', 'Primary Email', ['class' => 'control-label']) !!}
        {!! Form::email('client_email_primary', null, ['class' => 'form-control clientpemail']) !!}
        </div>
  
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('client_company', 'Company', ['class' => 'control-label']) !!}
            {!! Form::text('client_company', null, ['class' => 'form-control clientcomp']) !!}
        </div>

    </div>
    <div class="col-sm-8">

        <div class="form-group">
            {!! Form::hidden('client_address1', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_state', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_contact_1', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_contact_2', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('other_contact', null, ['class' => 'form-control']) !!}
            {!! Form::label('client_note', 'Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('client_note', null, ['class' => 'expand required editcnote form-control','required'=>'required' ]) !!}
        </div>

    </div>

    

</div>


<div class="row">
   
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
            {!! Form::select('file_type', ['Vector' => 'Vector', 'Digitizing' => 'Digitizing'] , 'Vector', 
            ['class' => 'editftype form-control', 'required'=> 'required' ]) !!}
            
        </div>
    </div>

    
    <div class="col-sm-4">
        <div class="form-group">
           {!! Form::label('file_name', 'File Name', ['class' => 'control-label']) !!}
           {!! Form::text('file_name', null, ['class' => 'required form-control', 'required'=> 'required']) !!}
        </div>
    </div>

    <div class="col-sm-4">
       <div class="form-group">
            {!! Form::label('note', 'File Note', ['class' => ' control-label']) !!}
            {!! Form::textarea('note', null, ['class' => 'expand  form-control']) !!}
        </div>
    </div>

</div>


<div class="row">
   

    <div class="col-sm-4">
        <div class="form-group">
              {!! Form::label('stiches_count', 'Stiches', ['class' => 'control-label']) !!}
              {!! Form::number('stiches_count', null, ['class' => 'form-control editscount', 'required'=>'required']) !!}
        </div>
    </div> 
    

   <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor :', ['class' => 'control-label']) !!}
            {!! Form::select('vendor', $vendors,  '', ['class' => 'editvend required form-control'  
              ]) !!} 
        </div>
    </div>

 </div>

<div class="row">
 
   
   
                         
    
    <div class="col-sm-3">
        <div class="form-group">
        @if (isset($var))
            @if (in_array('vend-file-price-show', $var))
                {!! Form::label('vendor_digit_price', 'V.Digit Price', ['class' => 'control-label']) !!}
                {!! Form::number('vendor_digit_price', 0.00,
                 ['class' => 'edit_vendor_digit_price form-control', 'readonly'=> 'readonly']) !!}
            @else

            @if (in_array('vend-file-price-modify', $var))
                {!! Form::label('vendor_digit_price', 'V.Digit Price', ['class' => 'control-label']) !!}
                {!! Form::number('vendor_digit_price', 0.00, ['class' => 'edit_vendor_digit_price form-control']) !!}
           
            @else
                {!! Form::label('vendor_digit_price', 'V.Digit Price', ['class' => 'control-label']) !!}
                {!! Form::hidden('vendor_digit_price', 0.00, ['class' => 'edit_vendor_digit_price form-control']) !!}
            @endif
            @endif
           
        @endif      
          
        
        </div>
    </div>
</div>


<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('order_date_time', 'Order Date(India)', ['class' => 'control-label']) !!}
            {!! Form::text('order_date_time', $local_dt, ['class' => 'form-control','id'=>'order_date_time']) !!}
        </div>
    </div>    

     <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('order_us_date', 'Order Date(US)', ['class' => 'control-label']) !!}
            {!! Form::text('order_us_date', $valid_dt, ['class' => 'form-control', 'id' =>'order_us_date']) !!}
         
        </div>
    </div>    
</div>    


<div class="row">
<!-- onfocus='this.size=10;' onblur='this.size=1;' 
        onchange='this.size=1; this.blur(); -->
    <div class="col-sm-4">
        <div class="form-group">
        @if (isset($var))
            @if (in_array('allow-change-allocation', $var))
        
            {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
            {!! Form::select('allocation1[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId1', 'class' => 'fooalloc form-control', 'required'=>'required', 'onfocus'=> 'this.size=4;'   ]) !!}
      
            @else
            {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
                   {!! Form::select('allocation1[]', $users,  null, [ 'multiple'=>'multiple' ,'id'=>'dropDownId1', 'class' => 'fooalloc hidealloc form-control', 'readonly'=>'readonly', 'onfocus'=> 'this.size=4;'     ]) !!}

            @endif
        @endif    
        </div>
    </div>


    <div class="col-sm-4">
       <div class="form-group">
        @if (isset($var))
        @if (in_array('order-status-modify', $var))

        
                   {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                   {!! Form::select('status', $status, [ 'id'=>'status1', 'required'=>'required','class' => 'finalstatus form-control']) !!}
        @else
           
                     {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                     {!! Form::select('status', $status, null, [ 'id'=>'status1', 
                     'readonly'=>'readonly', 'class' => 'hidestatus form-control']) !!}
        
        @endif
        @endif
        </div>
    
    </div>
    


</div>