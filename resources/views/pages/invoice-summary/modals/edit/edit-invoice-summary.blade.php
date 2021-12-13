<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editmodalinvsummary" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
 
 
 {{-- {!! Form::model($InvoiceSummary, ['method' => 'PATCH', 'id'=>'invsummary','route'=>['invoices-summary.updatedtls', $InvoiceSummary->id ]]) !!} --}}

 {{-- <form class="form-horizontal" id="invsummary" role="form" method="POST" 
       action="invoice-summary/updatedtls"> --}}

<form method="POST" class="form-horizontal" action="invoice-summary/updatedtls" accept-charset="UTF-8">

<input name="_method" type="hidden" value="PATCH">
{{ csrf_field() }}      

     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Invoice Summary Details</h4>
      </div>
      <div id= "modal-invoice-summary" class="modal-body">
       
       {{--  @include('pages.orderdtls.forms.editorderdtls') --}}

      <input type="hidden" class="myid" name="id" id="id"  />
             
          <div class="row">
              
              
              <div class="form-group">
                  <div class="col-md-2">
                
                     {!! Form::label('client_company', 'Company Name', ['class' => 'control-label' ]) !!}
                  </div>   
                     
                  <div class="col-md-8">
                    
                  
                   {!! Form::text('client_company', null,  ['required'=>'required', 'class' => 'form-control clientcomp' ,'readonly' => 'true' ]) !!}
              </div>

              </div>
          </div>    

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Year Month', 'Year Month', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('yr_month', null,  ['class' => 'form-control yrmn' , 'readonly' => 'true']) !!}
                    </div>   
                </div>
          </div>

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Invoice Amount', 'Invoice Amount', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('inv_amount', null,  ['class' => 'form-control iamt' , 'readonly' => 'true']) !!}
                    </div>   
                </div>
          </div>

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Paid Amount', 'Paid Amount', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::number('paid_amt', null,  ['class' => 'form-control pamt' , 'required'=>'required', 'min'=>0.5 ]) !!}
                    </div>   
                </div>
          </div>

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Out Amount', 'Out Amount', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('out_amt', null,  ['class' => 'form-control oamt' , 'readonly' => 'true']) !!}
                    </div>   
                </div>
          </div>

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Bank Charges', 'Bank Charges', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('bank_charges', null,  ['class' => 'form-control bnkchrg' ]) !!}
                    </div>   
                </div>
          </div>

          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Paid Date', 'Paid Date', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('paid_dt', null,  ['class' => 'form-control paiddt' , 'required'=>'required' ]) !!}
                    </div>   
                </div>
          </div>

          
          <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        {!! Form::label('Remarks', 'Remarks', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-md-8">
                   
                       {!! Form::text('remarks', null,  ['class' => 'form-control remarks' , 'required'=>'required' ]) !!}
                    </div>   
                </div>
          </div>



      </div>
      <div class="modal-footer">
       
            {!! Form::submit('Submit',['class' => 'btn btn-lg btn-primary submitdtl']) !!}

          {{-- <a href="#" id="" class="btn btn-cyan paysubmit "><i class="fa fa-flash"></i>&nbsp;Submit</a>  --}}
        
      <div class="success"> </div>

   {!! Form::close() !!} 
      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />