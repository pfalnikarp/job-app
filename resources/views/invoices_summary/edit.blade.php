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
  {!! Form::model($invoicesummary,['method' => 'PATCH',  'route'=>['invoices-summary.updatedtls', $invoicesummary->id]]) !!}


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

                     <div class="col-md-2">
                        {!! Form::label('discount', 'Discount', ['class' => 'control-label ']) !!}
                  
                       {!! Form::number('discount', $invoicesummary->discount,  ['class' => 'form-control ', 'step'=>'any', 'min'=>"0"  ]) !!}
                    </div>

              </div>
               

              <div class="row form-group">
                   
                     <div class="col-md-10">
                        {!! Form::label('discount_reason', 'Discount Reaon', ['class' => 'control-label ']) !!}
                  
                       {!! Form::text('discount_reason', $invoicesummary->discount_reason,  ['class' => 'form-control ', 'step'=>'any', 'min'=>"0"  ]) !!}
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

</script>
@endsection