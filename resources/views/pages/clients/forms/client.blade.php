
<!-- 
<div class="form-group">
    {!! Form::label('client_company', 'Company', ['class' => 'control-label']) !!}
    {!! Form::text('client_company', null, ['class' => 'form-control' ]) !!}
    {!! Form::label('tax_code', 'Tax Code', ['class' => 'control-label']) !!}
    {!! Form::text('irc_number', null, ['class' => 'form-control ']) !!}
    {!! Form::label('website', 'Website', ['class' => 'control-label']) !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div> -->




            
      <!--       <div class="row col-md-offset-4"><input type="button" class="btn btn-primary add" value="+"><b> Add   Details </b></div>
 -->
    
<div class="form-group">
    <!-- <div class="block"> -->
    {!! Form::hidden('client_id', null, ['class' => 'form-control','id'=>'client_id']) !!}
    {!! Form::label('client_name', 'Client Name :', ['class' => 'control-label']) !!}
    {!! Form::text('client_name', null, ['class' => 'form-control','id'=>'client_name']) !!}
</div>

<div class="form-group">
    {!! Form::label('client_email_primary', 'Email', ['class' => 'control-label']) !!}
    {!! Form::email('client_email_primary', null, ['class' => 'form-control']) !!}
</div>

<!-- <div class="form-group">
    {!! Form::label('client_email_secnodary', 'Other Email(CC)', ['class' => 'control-label']) !!}
    {!! Form::text('client_email_secondary', null, ['class' => 'tm-input txtinput form-control']) !!}
</div>    
 -->
 
<div class="form-group">
    {!! Form::label('client_address1', 'Address', ['class' => 'control-label']) !!}
    {!! Form::text('client_address1', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_state', 'State', ['class' => 'control-label']) !!}
    {!! Form::text('client_state', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('client_country', null, ['class' => 'form-control']) !!}
     {!! Form::label('timezone_type', 'TimeZone Type', ['class' => 'control-label']) !!}
    {!! Form::text('timezone_type', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_contact_1', 'Contact 1', ['class' => 'control-label']) !!}
    {!! Form::tel('client_contact_1', null, ['class' => 'form-control txtinput']) !!}
    <!-- </div> -->
</div>
    <!-- <div class="block">
            <input type="text" /><a href="#" <span class="remove">Remove Option</span></a>
        </div>
        <div class="block">
            <a href="#"> <span class="add">Add Option</span></a>
        </div>
    </div> -->
 
 <!-- 
<a href="#" >Add <i class="glyphicon glyphicon-plus"></i></a>
<a href="#" class="btn btn-danger delete">Delete</a> -->

<!-- <div class="form-group">
    {!! Form::label('timezone_type', 'TimeZone Type', ['class' => 'control-label']) !!}
    {!! Form::text('timezone_type', null, ['class' => 'form-control']) !!}
    {!! Form::label('client_contact_1', 'Contact 1', ['class' => 'control-label']) !!}
    {!! Form::tel('client_contact_1', null, ['class' => 'form-control txtinput']) !!}
</div>
 -->
<div class="form-group">
    {!! Form::label('client_contact_2', 'Contact 2', ['class' => 'control-label']) !!}
    {!! Form::tel('client_contact_2', null, ['class' => 'form-control txtinput']) !!}
</div>


<div class="form-group">
    {!! Form::label('other_contact', 'Other contact', ['class' => 'control-label']) !!}
    {!! Form::tel('other_contact', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('unit_price', 'Unit Price', ['class' => 'control-label']) !!}
    {!! Form::text('unit_price', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('digit_rate', 'Emb. Rate', ['class' => 'control-label']) !!}
    {!! Form::text('digit_rate', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('client_note', 'Note', ['class' => 'control-label']) !!}
    {!! Form::text('client_note', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('store_type', 'Store Type', ['class' => 'control-label']) !!}
    {!! Form::text('store_type', null, ['class' => 'form-control']) !!}
</div>


