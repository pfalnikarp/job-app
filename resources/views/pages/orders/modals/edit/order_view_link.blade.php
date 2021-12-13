<!-- Modal -->
  <div class="modal fade" id="TodayOrderDetail_1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
         <!--  <button data-toggle="tooltip" title="Back" class="back-count_1 btn btn-sm btn-success  col-xs-1">
            <span class="glyphicon glyphicon-arrow-left"></span>
          </button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>View Order</center></h4>
        
        </div>
        <div class="modal-body">
          
        <!-- Code added  for  just view order -->
        <div class="row">

    <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('order_id', 'Order Id', ['class' => 'control-label']) !!}
        {!! Form::text('order_id', null,['class' => 'form-control ', 'readonly'=>'readonly', 'autofocus' =>'autofocus']) !!}
    </div>
    </div>

   <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('client_name', 'Client Name', ['class' => 'control-label']) !!}
        {!! Form::text('client_name', null ,['class' => 'form-control ', 'readonly'=>'readonly', 'autofocus' =>'autofocus']) !!}
    </div>
    </div>

    <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('client_email_primary', 'Primary Email', ['class' => 'control-label']) !!}
        {!! Form::email('client_email_primary', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
    </div>
    </div>


    <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('client_company', 'Company:', ['class' => 'control-label']) !!}
        {!! Form::text('client_company', null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
    </div>
    </div>
</div>

          

  
<div class="row">

    <div class="col-md-3">
    <div class="form-group">
        {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
        {!! Form::text('file_type',  null ,  ['class' => 'ftype form-control' , 'readonly'=>'readonly']) !!}
    </div>
    </div>

    
    <div class="col-md-3">

        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor', ['class' => 'control-label']) !!}
             {!! Form::text('vendor', null,   ['class' => 'form-control' 
              ]) !!} 
           
        </div>
    </div>    

    <div class="col-md-2 show_stich">
        <div class="form-group">
   
        {!! Form::label('stiches_count', 'Stiches', ['class' => 'control-label slabel']) !!}
        {!! Form::number('stiches_count', null, ['class' => 'form-control', 'required'=>'required']) !!}
   
        </div>
    </div>  

    <div class="col-md-2  show_stich">
         <div class="form-group">
              {!! Form::label('digit_rate', 'Digit Rate', ['class' => 'control-label']) !!}
                 {!! Form::number('digit_rate', null, ['class' => 'form-control digitrt']) !!}
         </div>
    </div>
   

     <div class="col-md-2 ">    
        <div class="form-group">
            {!! Form::label('file_price', 'File Price:', ['class' => 'control-label']) !!}
            {!! Form::number('file_price', null, ['class' => 'valid_file_price form-control', 'required'=>'required', 'step' => 'any']) !!}
              <input type="hidden" name="old_price" class="orig_old_price" value=0 />
        </div>
    </div>    
</div>

<div class="row">
   

     <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('order_date_time', 'Order Date(India)', ['class' => 'control-label']) !!}
            {!! Form::text('order_date_time', null, ['class' => 'form-control ', 'readonly' =>'readonly',  'id'=>'order_date_time']) !!}
        </div>
    </div>    

     <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('order_us_date', 'Order Date(US)', ['class' => 'control-label']) !!}
            {!! Form::text('order_us_date', null, ['class' => 'form-control', 'readonly' =>'readonly', 'id' =>'order_us_date']) !!}
         
        </div>
    </div>   

      <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('bill_dt', 'BILL Date', ['class' => 'control-label']) !!}
            {!! Form::text('bill_dt', null, ['class' => 'form-control', 'id' =>'bill_dt']) !!}
         
        </div>
    </div>    

      <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('approval_time', 'Appr Time', ['class' => 'control-label']) !!}
            {!! Form::text('approval_time', null, ['class' => 'form-control', 
            'readonly' =>'readonly', 'id' =>'approval_time']) !!}
         
        </div>
    </div>     

      <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('approval_us_time', 'Appr US Time', ['class' => 'control-label']) !!}
            {!! Form::text('approval_us_time', null, ['class' => 'form-control', 
            'readonly' =>'readonly', 'id' =>'approval_us_time']) !!}
         
        </div>
    </div>    

</div>

<div class="row">
      <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Total Files', 'Total Files', ['class' => 'control-label']) !!}
            {!! Form::number('file_count', null, ['placeholder'=>'Enter File Count', 'class' => 'form-control fcount', 'readonly'=>'readonly', 'id' =>'file_count']) !!}
         
        </div>
      </div>  
     
     <div class="col-sm-4">  
           <div class="form-group">
                {!! Form::label('created_byname', 'Created By', ['class' => 'control-label']) !!}
                {!! Form::text('created_byname', null,  ['readonly'=>'readonly', 
                'class' => 'form-control' ]) !!}
            </div>
    </div>
     <div class="col-sm-4">  
          <div class="form-group">

                {!! Form::label('updated_byname', 'Updated By', ['class' => 'control-label']) !!}
                {!! Form::text('updated_byname', null,  ['readonly'=>'readonly', 
                'class' => 'form-control' ]) !!}
          </div>
    </div>

    
</div>

<div class="row">
  

</div>

 <div class="table-responsive">
        <table id="ord_detail_1" class="table table-hover table-bordered  ">
        <thead>
            <tr>
              <th>Document</th>
              <th>File Name</th>
              <th>File Price</th>
              <th>File Note</th>
              <th>Allocation</th>
              <th>Target Time</th>
              <th>Status </th>
              
            </tr>
        </thead>
        <tbody>
    
        </tbody>


        </table>
        </div>
       
       

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

