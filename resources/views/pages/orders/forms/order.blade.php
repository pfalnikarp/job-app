<!-- <h1>Add Order</h1> -->
<!-- <p class="lead">Add to your task list below.</p>
<hr> -->
<!-- form validation -->
      {{--   <script type="text/javascript" src="{{ URL::asset('js/form/jquery.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.js') }}"></script> --}}
        <!-- form validation over -->

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
        
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

<div class="row">
     
   
    <div class="col-sm-4">

        <div class="form-group">
        {!! Form::label('client_name', 'Client Name', ['class' => 'control-label']) !!}
        
    	{!! Form::text('client_name1', null,  ['class' => 'form-control required addclientinput clientinput', 'required'=>'required', 'autofocus' => 'autofocus' , 'placeholder' =>'Enter Client Name' ]) !!}
        </div>
      
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('client_creation_id', 'Client Id', ['class' => 'control-label']) !!}
            {!! Form::text('client_creation_id', null,  ['class' => 'form-control createid' , 'readonly' => 'true']) !!}
        </div>
    </div>

    <div class="col-sm-5">
    
        <div class="form-group">
        {!! Form::label('client_email_primary', 'Primary Email', ['class' => 'control-label']) !!}
        {!! Form::email('client_email_primary', null, ['class' => 'form-control clientpemail', 'readonly' => 'readonly']) !!}
         {!! Form::hidden('company_id', null, ['class' => 'form-control compid1']) !!}

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
    
    <div class="col-sm-5">

        <div class="form-group">
            {!! Form::hidden('client_address1', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_state', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_contact_1', null, ['class' => 'form-control contact1']) !!}
            {!! Form::hidden('client_contact_2', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('other_contact', null, ['class' => 'form-control']) !!}
            {!! Form::label('client_note', 'Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('client_note', null, ['class' => 'expand required cnote form-control','required'=>'required']) !!}
        </div>

    </div>

    <div class="col-sm-3">

        <div class="form-group">
           {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
           {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 'Normal', ['class' => 'required form-control dtype', 'required'=>'required']) !!}
                   
        </div>

   
    </div>

    

</div>


<div class="row">
    
    

    <div class="col-sm-3">
      <div class="form-group">
            {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
            {!! Form::select('file_type', ['0' =>'Select File Type', 'Vector' => 'Vector', 'Digitizing' => 'Digitizing' ,'Photoshop' =>'Photoshop'] , 'Select File Type', ['class' => 'ftype form-control']) !!}
            
       </div>
    </div>

      <div class="col-sm-3">
           <div class="form-group">
              {!! Form::label('file_name', 'File Name', ['class' => 'control-label']) !!}
              {!! Form::text('file_name', null, ['class' => 'required form-control','required'=>'required']) !!}
                   
            </div>

        </div>

         <div class="col-sm-2">
           <div class="form-group">
              {!! Form::label('file_count', 'File Count', ['class' => 'control-label']) !!}
              {!! Form::number('file_count', 1, ['class' => 'required form-control','required'=>'required']) !!}
                   
            </div>

        </div>

        <div class="col-sm-4">

        <div class="form-group">
          {!! Form::label('note', 'File Note', ['class' => 'control-label']) !!}
           {!! Form::textarea('note', null, ['class' => 'expand required form-control']) !!}
        </div>


       </div> 

</div>

<div class="row">
      
    
     {{-- <div class="col-sm-3">
        <div class="form-group">
            @if (isset($var))
            @if (in_array('priority-modify', $var))
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 'Normal', ['class' => 'form-control dtype']) !!}
            @else
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 'Normal', ['class' => 'form-control', 'disabled'=>'disabled']) !!}
            
            @endif
            @endif
        </div>
    </div>   --}}  

     <div class="col-sm-3">
        <div class="form-group">
              {!! Form::label('stiches_count', 'Stiches', ['class' => 'control-label slabel']) !!}
                {!! Form::number('stiches_count', 0.00, ['class' => 'form-control scount', 'required'=>'required']) !!}
        </div>
    

    </div>

      <div class="col-sm-3">

        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor :', ['class' => 'control-label']) !!}
            {!! Form::select('vendor', $vendors,  '', ['class' => 'vend  form-control' ,'required'=>'required' 
              ]) !!} 
        </div>


    </div>

      <div class="col-sm-3">
        <div class="form-group">
        @if (isset($var))
            @if (in_array('vend-file-price-modify', $var))
                {!! Form::label('vendor_digit_price', 'V.Digi Price', ['class' => 'control-label']) !!}
                {!! Form::number('vendor_digit_price', 0.00,
                 ['class' => 'add_vendor_digit_price  form-control', 'required'=>'required']) !!}
            @else

                @if (in_array('vend-file-price-show', $var))
                    {!! Form::label('vendor_digit_price', 'V.Digi Price', ['class' => 'control-label']) !!}
                    {!! Form::number('vendor_digit_price', 0.00, ['class' => 'add_vendor_digit_price  form-control', 'readonly' => 'readonly']) !!}
           
                @else
                  
                    {!! Form::hidden('vendor_digit_price', 0.00, ['class' => 'add_vendor_digit_price   form-control', 'required'=>'required']) !!}
                @endif
            @endif
           
        @endif      
          
        
        </div>
    </div>


</div>


<div class="row">
  
    <div class="col-sm-4">    
        <div class="form-group">
            {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
            {!! Form::number('file_price', 5.5, ['class' => 'valid_file_price form-control', 'required'=>'required']) !!}
        </div>
    </div>  

     <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('order_date_time', 'Order Date(India)', ['class' => 'control-label']) !!}
            {!! Form::text('order_date_time', $local_dt, ['class' => 'form-control ','id'=>'order_date_time']) !!}
        </div>
    </div>    

     <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('order_us_date', 'Order Date(US)', ['class' => 'control-label']) !!}
            {!! Form::text('order_us_date', $valid_dt, ['class' => 'form-control', 'readonly' =>'readonly', 'id' =>'order_us_date']) !!}
         
        </div>
    </div>    



  <!--   <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('digit_rate', 'Emb. Rate', ['class' => 'control-label']) !!}
            {!! Form::number('digit_rate', 0.00, ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
    </div>    -->         


   

   


    

</div>


<div class="row">
<!-- onfocus='this.size=10;' onblur='this.size=1;' 
        onchange='this.size=1; this.blur(); -->

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
            {!! Form::select('allocation1[]', $users,  'not allocated', ['multiple'=>'multiple' ,'class' => 'foo required form-control', 'id'=>'dropDownId1',  'onfocus'=> 'this.size=2;'
              ]) !!}
        </div>

    </div>

    <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                {!! Form::select('status', $status, [ 'id'=>'status1', 'class' => 'finalstatus required form-control','required'=>'required']) !!}
            </div>
    
    </div>

      <div class="col-sm-3">
            <div class="form-group">
                  {!! Form::label('vendor_digit_rate', 'V.Digit. Rate', ['class' => 'control-label']) !!}
                {!! Form::number('vendor_digit_rate', 0.00, ['class' => 'add_vendor_digit_rate form-control'
                ,'required'=>'required']) !!} 
            </div>

    </div>

    {{ Form::reset('Clear form', ['class' => 'form-button']) }}

</div>


