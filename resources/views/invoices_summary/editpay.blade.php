@extends('layouts.maintemplate')

@section('style')

<style type="text/css">
  

/*label.control-label.inline {
  margin: 10px -20px 1px 0;
  text-align: right;
  align-content: right;
}
*/
label {
    text-align: left;
}


</style>
@endsection
@section('content')
<br>
      @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
 
 
@if(Session::has('alert-warning'))
    <div class="alert alert-warning">
        {{ Session::get('flash_message1') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 

 	


<!-- <form method="POST"  action="../updatedtls" accept-charset="UTF-8"> -->
  {!! Form::model($invoicesummary,['method' => 'PATCH',  'route'=>['invoices-summary.updatepay', $invoicesummary->id]]) !!}


<input name="_method" type="hidden" value="PATCH">
{{ csrf_field() }}      

     
      
        <h5>Edit Invoice and Pay</h5>
     
   <div class="card temcolor1">
    
        <div class="card-body">

      
      <input type="hidden" class="myid" name="id" id="id" value="{{ $invoicesummary->id }}" />
       
            <fieldset>
              
             
               
                <div class="row form-group">
                     <div class="form-group col-md-6">
                     {!! Form::label('client_company', 'Company Name', ['class' => 'control-label ' ]) !!}
                    
                       {!! Form::text('client_company', $invoicesummary->client_company,  ['required'=>'required', 'class' => 'form-control clientcomp' ,'readonly' => 'true' ]) !!}

                       </div>

                       <div class="form-group col-md-2">
                      {!! Form::label('Invoice Amount', 'Invoice Amount', ['class' => 'control-label ']) !!}
                       
                       {!! Form::text('inv_amount', $invoicesummary->inv_amount,  ['class' => 'form-control iamt' , 'readonly' => 'true']) !!}
                     </div>

                  

              </div>
               


              
             <div class="row form-group">       
                     <div class="col-md-2">
                         <div class="form-group">
                            <label class="control-label" style="color: #CD5C5C;">Payment Date:</label>
         
                                 {!! Form::text('payment_date', null, ['class' => 'form-control', 'id' =>'payment_date']) !!}
         
                          </div>
                      </div> 

                    <div class="col-md-4">
                        {!! Form::label('amt_paid_usd', 'Amount Paid(USD)', ['class' => 'control-label inline']) !!}
                  
                       {!! Form::text('amt_paid_usd', null, 
                        ['class' => 'form-control amtpaid' , 'placeholder'=>'1.00' , 'step'=>'any', 'min'=>"1.00", 'id'=>"amt_paid_usd"]) !!}
                    </div> 
                   <!--  <div class="col-md-4">
                        {!! Form::label('remain_amount', 'Remaining Amount(USD)', ['class' => 'control-label ']) !!}
                   
                    {!! Form::text('net_amt', null,  ['class' => 'form-control netamt', 'step'=>'any', 'min'=>"0"  ]) !!}
                    </div>
 -->
                     <div class="col-md-4">
                        {!! Form::label('pay_channel', 'Amount Paid Thru', ['class' => 'control-label ']) !!}
                   
                       {!! Form::select('pay_channel', ['Credit/Debit Card Via Paypal'=>'Credit/Debit Card Via Paypal', 'PayPal'=>'PayPal', 'Wire Transfer'=>'Wire Transfer'], null ,['class' => 'form-control ' ]) !!}
                    </div>   
                </div>
        

        
                <div class="row form-group">
                    <div class="col-md-4">
                        {!! Form::label('bank_charges', 'Bank Charges', ['class' => 'control-label ']) !!}
                  
                       {!! Form::number('bank_charges',null,  ['class' => 'form-control ', 'step'=>'any', 'min'=>"0"  ]) !!}
                    </div>   
             
              
             
                  <div class="col-md-4">
                
                     {!! Form::label('conv_rate', 'Conversion Rate (INR) ', ['class' => 'control-label convrt ' ]) !!}
                
                  
                   {!! Form::number('conv_rate', null,  ['required'=>'required', 'class' => 'form-control convrt ' , 'placeholder'=>'1.00' , 'step'=>'any', 'min'=>"1.00" ]) !!}
                  </div>

                   <div class="col-md-4">
                        {!! Form::label('amt_received_inr', 'Amount Received(INR)', ['class' => 'control-label inline']) !!}
                  
                       {!! Form::text('amt_received_inr',null ,  ['class' => 'form-control amtrec' ]) !!}
                  
                </div>
              </div>

                     
     
              
         
              <div class="row form-group">
                   
               
                    <div class="col-md-10">
                        {!! Form::label('Remarks', 'Remarks', ['class' => 'control-label']) !!}
                    
                       {!! Form::textarea('remarks', null,  ['class' => 'form-control remarks' ,'placeholder'=>'Enter Remarks', 'required'=>'required' ]) !!}
                    </div>   
                </div>
       
          
 
     
              
         
                    
     
      <div class="modal-footer">
       
            {!! Form::submit('Submit',['class' => 'btn  btn-primary submitdtl']) !!}

        
      <div class="success"> </div>

      </div>
     </div>

   {!! Form::close() !!} 
      </div>
          </fieldset>  
      </div>
    </div>
 

@endsection


@section('script')


<script type="text/javascript">

$( document ).ready(function() {


   $(".amtpaid").change(function(){
                   //debugger;
                 var amtpaid = this.value;
                 var invamt  =  $(".iamt").val();

                  $(".netamt").val( invamt  - amtpaid);
 
             if( invamt - amtpaid < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Amount Paid Cannot be greater than Invoice Amount',
                        text: "Amount Paid Cannot be greater than Invoice Amount"
                                          
              })
               $(".amtpaid").val(0);
                $(".netamt").val( invamt);              
                            
             }

     });

       $(".convrt").change(function(){
        //debugger
                 var convrt = this.value;
                 var amtpaid  =  $(".amtpaid").val();
             $(".amtrec").val( amtpaid*convrt);
     });

          $(".amtpaid").change(function(){
                 var amtpaid = this.value;
                 var convrt  =  $(".convrt").val();
             $(".ramt").val( amtpaid*convrt);
     });

});

$("#payment_date").datepicker( {dateFormat: 'yy-mm-dd'});

</script>
@endsection