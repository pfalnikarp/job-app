@extends('layouts.maintemplate')


@section('style')
<style type="text/css">
div.row1 {
    padding-top: 0px;
    height: 80px;
    vertical-align: middle;
}


/*
div.delt {%
   padding-top: 10px !important;
}
*/
select {
    border:1px solid #ccc;
    vertical-align:top;
    height:20px;
}


.form-control:focus{
  background-color: #D6EAF8;
}
input, select{
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}
/*
.container-fluid {
  border: 1px solid blue;
}*/

.dispinv {
  display: none;
  height: 100%;
  min-height: 100px;
}

/*  style added above on 17-05-20 */

.show_stich {
  display: hide;
}

/*  css added on 13/01/2020 */  

input:focus {
    background-color: #FFFF33;
  } 

select:focus {
    background-color: #FFFF33;
  } 

hr {
  border-style: solid;
}

.rdcolor {

  color: orange;

}

td {
	vertical-align: none !important;
}

.numrows {
   border: 1px solid;
   border-color: red;
}

.dtlrowprice {
   border: 1px solid;
   border-color: red;
}

.cbtn {
   width: 40px;
   height: 20px ;
}

.btn_primary1 {
   color: blue;
   margin-top: 20px;
   background: yellow;
   border-color: red;
}



  
.modal-dialog{
    overflow-y: initial !important;
}

.modal-body{
    max-height: calc(100vh - 100px) !important;
    overflow-y: auto  !important;
    /*background: #00bfa5 ;
    background:    #44703c   ; removed on 12/04/17  
    background: transparent !important ;  */
    scrollbar-face-color: #414340;
            scrollbar-shadow-color: #cccccc;
            scrollbar-highlight-color: #cccccc;
            scrollbar-3dlight-color: #cccccc;
            scrollbar-darkshadow-color: #cccccc;
            scrollbar-track-color: #cccccc;
            scrollbar-arrow-color: #000000;
}

table#clienthelp tr:hover {
    cursor: pointer;
    background-color: #ffab40 !important; 
    color: #311b92 !important;
  }
.s{
 box-shadow: 5px 5px 10px #23CCEF;
}
.choices__list--dropdown{display:block;}
</style>
@endsection
@section('content')

@include('payments.modals.invoice_selection')

<div class="row">
  <div class="col-md-8">
      <h3 style="">Add Payment</h3>
  </div>
  <div class="col-md-4">
      <a href="{{route('payments.index')}}" class="btn btn-primary btn-outline mt-3 rightdiv">Back</a>
  </div>
</div>

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container-fluid">


{!! Form::open(['route'=>'payments.store' , 'id' =>'payadd']) !!}

<div class="row">

   


    <div class="col-md-4">
    <div class="form-group">
       <label class="control-label" style="color: #003d99;">Company:</label>
    
        {!! Form::select('company_id', $companynames, null, ['class' => 'form-control', 'id'=>'company_id']) !!}
    </div>
    </div>

     <div class="col-md-2">
    <div class="form-group">
       <label class="control-label" style="color: #003d99;">Option:</label>
    
        {!! Form::select('pay_option', ['Direct'=>'Direct', 'Invoices'=>'Invoices'], null, ['class' => 'form-control payopt', 'id'=>'company_id']) !!}
    </div>
    </div>

    <div class="col-md-2 form-group">
       <label class="control-label" style="color: #003d99;">Invoices:</label>
         <input type="text" name="invoices" class="selectedinv" readonly="readonly">
    </div>


    <!--  <div class="col-md-4 dispinv">
    <div class="form-group">
       <label class="control-label" style="color: #003d99;">Invoices:</label>
    
        {!! Form::select('invoices[]', $invoices, null, ['class' => 'form-control inv',  'size'=>30, 'id'=>'company_id']) !!}
    </div>
    </div> -->


    <!--   <div class="col-md-2">
    <div class="form-group">
       <label class="control-label" style="color: #003d99;">Company:</label>
    
        {!! Form::select('pay_option', ['Direct'=>'Direct', 'Invoice'=>'Invoice'], null, ['class' => 'form-control', 'id'=>'company_id']) !!}
    </div>
    </div> -->

    

    
</div>

    

             <div class="row form-group">     

                     <div class="col-md-2">
                          <div class="form-group">
                                <label class="control-label" style="color: #CD5C5C;">Payment Date:</label>
         
                                {!! Form::text('payment_date', $cdt, ['class' => 'form-control', 'id' =>'payment_date']) !!}
         
                           </div>
                      </div>    


                      <div class="col-md-2">
                         <div class="form-group">
                            <label class="control-label" >Currency:</label>
                              <select name="currency" value = "US($)" >
                                    <option value="US($)">US($)</option>
                                    <option value="Canadian($)">Canadian($)</option> 
                                    <option value="Australia($)">Australia($)</option>
                                     <option value="GBP(£)">GBP(£)</option>
                              </select>
                              
         
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
       
        
 

<!-- <a id="addrow" href="#" class="btn btn-success btn-outline add">Add More</a> --> 
<div class="row"> 
  <div class="col-md-7"> 
{!! Form::submit('Submit',['class' => 'btn btn-warning rightdiv btn-wd']) !!}
</div>
</div>
{!! Form::close() !!}

</div>



@endsection


@section('script') 


<script type="text/javascript">

  // jQuery(document).ready(function ($) {
     
  //  });

//  Removed on 07/07/18  by kulind sir as implemented on same date
//   $(document).ready(function(){
//    $('input').on("cut copy paste",function(e) {
//       e.preventDefault();
//    });
// });

$(document).ready(function ($) {

  //  INVOICE SELECTION HELP MODAL

//     jQuery("."+x_class+":checked").each(function(){
//   str += jQuery(this).attr("value") + ',';
// });
     
     $(document).on("click", ".selectinv" , function(e){
          $("#invoice-selection-modal").modal('hide'); 
                        var result = 0 , total =0;
                        var inv = '';
          $("#inv-sel-help tr").each(function(){
                              var self = $(this);
                
                 if($(this).find("input.chkidctl").prop("checked") == true){
                    var col_2_value = self.find("td:eq(2)").text().trim();
                    var col_3_value = self.find("td:eq(4)").text().trim();
                    var col_4_value = self.find("td:eq(4)").text().trim();
                    var col_5_value = self.find("td:eq(5)").text().trim();
                    //alert(col_4_value);
                    
                    var result = (parseFloat(col_4_value) - parseFloat(col_5_value));
                    total  =  result + total;

                   

                    inv    +=   col_2_value + ',' ;
                    
                        //alert(inv);
                  }
                    
          });

                      console.log(total);
                      $(".selectedinv").val(inv);
                      $(".amtpaid").val(total);


     });

      // $(document).on("click", "input.chkidctl", function(e){
      //      //  debugger;
      // //     e.preventDefault();
      // // $("#clienthelp  tr").click(function(){
      //     if($(this).prop("checked") == true){
      //           console.log("Checkbox is checked.");
      //       }
      //       else if($(this).prop("checked") == false){
      //           console.log("Checkbox is unchecked.");       
      //          }

      //   $(this).addClass('selected').siblings().removeClass('selected'); 

      //   var vinvoice_no=$(this).find('td:eq(2)').html();
        
      //   var vinvoice_amount=$(this).find('td:eq(4)').html();
       
      // });



  // INVOICE SELECTION HELP MODAL  
 
  $(document).on("focusout", ".convrt", function(){
          //event.preventDefault ;

                 var convrt = this.value;
                 var paidamt =  $(".amtpaid").val();

                 var recinr =  parseFloat(convrt)* parseFloat(paidamt);

                 $(".amtrec").val(recinr.toFixed(2));

        });
   
    $(document).on("change", ".payopt", function(){
               //alert('ok');
              if ( $(".payopt").val() == 'Invoices')   {
                         // pmonth =  this.value;
                          pcompany  =  $('select[name=company_id] option').filter(':selected').val()

                        $("#invoice-selection-modal").modal('show');  

   $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('payments/searchinvoice') }}",
            data: {"pcompany": pcompany},
            success:function(data)
                  {  
                     console.log(data);
             
                      //   $('.inv').html(data);
                   $("#inv-sel-help tbody").html(data);
        
                     // $(".dispinv").css('display', 'block');
                  }
           });
 }

             else {
                     //$(".dispinv").css('display', 'none');
             }
             

    });
  
$("#payment_date").datepicker( {dateFormat: 'yy-mm-dd'});

});  


</script> 


@endsection

