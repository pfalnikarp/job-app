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
<h2> VIEW ORDER </h2>
<div class="row">
      
    <div class="col-sm-4">

        <div class="form-group">
        {!! Form::label('client_name', 'Client Name', ['class' => 'control-label']) !!}
       
    	{!! Form::text('client_name', null,  ['required'=>'required', 'class' => 'form-control editclientinput' ]) !!}
        </div>
      
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('client_creation_id', 'Client Id', ['class' => 'control-label']) !!}
            {!! Form::text('client_creation_id', null,  ['class' => 'form-control ' , 'readonly' => 'true']) !!}
        </div>
    </div>
   

    <div class="col-sm-6">
    
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
    <div class="col-sm-5">

        <div class="form-group">
            {!! Form::hidden('client_address1', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_state', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_contact_1', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('client_contact_2', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('other_contact', null, ['class' => 'form-control']) !!}
            {!! Form::label('client_note', 'Client Note', ['class' => 'control-label']) !!}
            {!! Form::textarea('client_note', null, ['class' => 'expand required editcnote form-control','required'=>'required' ]) !!}
        </div>

    </div>

    <div class="col-sm-3">
        <div class="form-group">
            @if (isset($var))
            @if (in_array('priority-modify', $var))
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], null, ['class' => 'form-control']) !!}
            @else
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
            
            @endif
            @endif
        </div>
    </div>    

    

</div>


<div class="row">
   
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
            {!! Form::select('file_type', ['Vector' => 'Vector', 'Digitizing' => 'Digitizing','Photoshop' =>'Photoshop'] , 'Vector', 
            ['class' => 'editftype form-control', 'required'=> 'required' ]) !!}

        </div>
    </div>

    
    <div class="col-sm-3">
        <div class="form-group">
           {!! Form::label('file_name', 'File Name', ['class' => 'control-label']) !!}
           {!! Form::text('file_name', null, ['class' => 'required form-control', 'required'=> 'required']) !!}
        </div>
    </div>

    <div class="col-sm-6">
      
       <div class="form-group">
            {!! Form::label('note', 'File Note', ['class' => ' control-label']) !!}
            {!! Form::textarea('note', null, ['class' => 'expand  form-control']) !!}
        </div>
    </div>

</div>


<div class="row">
   
   {{--  <div class="col-sm-3">
        <div class="form-group">
            @if (isset($var))
            @if (in_array('priority-modify', $var))
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 'Normal', ['class' => 'form-control']) !!}
            @else
                {!! Form::label('document_type', 'Priority', ['class' => 'control-label']) !!}
                {!! Form::select('document_type', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 'Normal', ['class' => 'form-control', 'disabled'=>'disabled']) !!}
            
            @endif
            @endif
        </div>
    </div>    
 --}}

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

 </div>

<div class="row">

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

  


   
</div>


<div class="row">
<!-- onfocus='this.size=10;' onblur='this.size=1;' 
        onchange='this.size=1; this.blur(); -->
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
        {!! Form::select('allocation1[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId1', 'class' => 'fooalloc form-control', 'readonly'=>'readonly', 'onfocus'=> 'this.size=4;'   ]) !!}

      {{--   @if (isset($var))
            @if (in_array('allow-change-allocation', $var))
        
            {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
            {!! Form::select('allocation1[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId1', 'class' => 'fooalloc form-control', 'required'=>'required', 'onfocus'=> 'this.size=4;'   ]) !!}
      
            @else
            {!! Form::label('allocation1', 'Allocation', ['class' => 'control-label']) !!}
                   {!! Form::select('allocation1[]', $users,  null, [ 'multiple'=>'multiple' ,'id'=>'dropDownId1', 'class' => 'fooalloc hidealloc form-control', 'readonly'=>'readonly', 'onfocus'=> 'this.size=4;'     ]) !!}

            @endif
        @endif    --}} 
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

      <div class="col-sm-3">
        <div class="form-group">
                {!! Form::label('vendor_digit_rate', 'V.Digit. Rate', ['class' => 'control-label']) !!}
            @if (isset($var))    
                @if (in_array('v_emb_rate_modify', $var))
                       {!! Form::number('vendor_digit_rate', 0.00, ['readonly'=>'readonly' ,'class' => 'edit_vendor_digit_rate form-control']) !!}
                   
                
                @else
                    @if (in_array('v_emb_rate_show', $var))
                       {!! Form::number('vendor_digit_rate', 0.00, ['readonly'=>'readonly', 'class' => 'edit_vendor_digit_rate form-control', 'readonly' => 'readonly']) !!} 

                    @else
                        {!! Form::hidden('vendor_digit_rate', 0.00, ['class' => 'edit_vendor_digit_rate form-control']) !!} 
                  
                    @endif
                @endif  
            @endif
        </div>
    </div>
 

   

</div>

<div class="row">
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
<div class="row">
     <div class="col-sm-4">  
                {!! Form::label('created_byname', 'Created By', ['class' => 'control-label']) !!}
                {!! Form::text('created_byname', null,  ['readonly'=>'readonly', 
                'class' => 'form-control', 'id' => 'created_byname' ]) !!}
    </div>
     <div class="col-sm-4">  
                {!! Form::label('updated_byname', 'Updated By', ['class' => 'control-label']) !!}
                {!! Form::text('updated_byname', null,  ['readonly'=>'readonly', 
                'class' => 'form-control', 'id' => 'updated_byname' ]) !!}
    </div>

    
</div>
<div class="row">
     {!! Form::label('diffcolumns', 'Column Updated', ['class' => 'control-label']) !!}
     {!! Form::text('diffcolumns', null,  ['readonly'=>'readonly', 
                'class' => 'form-control', 'id' => 'diffcolumns' ]) !!}
</div>