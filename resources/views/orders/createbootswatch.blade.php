@extends('layouts.maintemplate')
@section('third_party_stylesheets')
<style type="text/css">
div.row1 {
    padding-top: 0px;
    height: 80px;
    vertical-align: middle;
}

/*
div.delt {
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
/*input, select{
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}*/

.quotecolor {
  background: #0a17ec !important;
  color: white;
}

.allotedcolor {
  background: black !important;
  color: white;
}

.revisioncolor {
    background: #FA7C7C !important;
    color: black !important;
}

.unapprovedcolor {
    background: #FFAC5C !important;
    color: black !important;
}

.complaincolor {
    background: #FF0000 !important;
    color: white !important;
}

.followupcolor {
   background:  #E5ff28 !important ;
   color:  black !important;
}

.onholdcolor {
    background: #A606C8 !important;
    color: white !important;
}

.cancelcolor {
    background: #C9303F !important;
    color: white !important;
}



.qcpendingcolor {
  background: #FA4193 !important;
  color: black !important;
}

.completedcolor {
  background: #41E329 !important;
  color: black !important;
}

.qcokcolor {
  background: #DED641 !important;
  color: black !important;
}


.requotecolor {
  background: #4bc2f9 !important;
  color: #0a17ec !important;
}

.noresponsecolor {
  background: #FFFE0B !important;
  color: black !important;
}

.approvedcolor {
  background: #00F0E1 !important ;
  color: black !important ;
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

select.selectalloc {
   background: white ;
   color: blue ;
}

.updrow {
  width: 5px;
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

@include('pages.orders.modals.create.client_help')
<div class="row">
  <div class="col-md-8">
      <h4 class="mt-2">Add Order</h4>
  </div>
  <div class="col-md-4">
      <a href="{{route('orders.index')}}" class="btn btn-primary btn-outline mt-1 mb-1 rightdiv">Back</a>
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

<div class="row">
<!-- <div class ="col-md-1" style="float: left;" > 
             <a   class="btn btn-primary" href="{{ action("OrderController@index") }}"><span class="glyphicon glyphicon-arrow-left">Back</span></a>
</div>
 -->
{!! Form::open(['route'=>'orders.store' , 'id' =>'newformadd']) !!}

 <div class="card temcolor1">
    <div class="card-body">

<div class="row">

    <div class="col-md-2">
    <div class="form-group">
      <label class="control-label" style="color: #003d99;">Client Name:</label>
      
        {!! Form::text('client_name', "" ,['class' => 'form-control client-help clientinput', 
        'required'=>'required',  'autofocus' =>'autofocus','id'=>'client_name']) !!}
    </div>
    </div>

    <div class="col-md-2">
    <div class="form-group">
         <label class="control-label" style="color: #003d99;">Primary Email:</label>
        
        {!! Form::email('client_email_primary', "", ['class' => 'form-control','readonly'=>'readonly','id'=>'client_email_primary']) !!}
    </div>
    </div>


    <div class="col-md-2">
    <div class="form-group">
       <label class="control-label" style="color: #003d99;">Company:</label>
    
        {!! Form::text('client_company', "", ['class' => 'form-control', 'readonly'=>'readonly','id'=>'client_company']) !!}
    </div>
    </div>

     <div class="col-md-2">
        <div class="form-group">
          <label class="control-label" style="color: #CD5C5C;">Order Date(India):</label>
            
            {!! Form::text('order_date_time', $cdt, ['class' => 'form-control odt','id'=>'order_date_time']) !!}
        </div>
    </div>    

     <div class="col-md-2">
        <div class="form-group">
          <label class="control-label" style="color: #CD5C5C;">Order Date(US):</label>
            
            {!! Form::text('order_us_date', $us_time, ['class' => 'form-control', 'readonly' =>'readonly', 'id' =>'order_us_date']) !!}
         
        </div>
    </div>    

     <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="color: #CD5C5C;">BILL Date:</label>
         
            {!! Form::text('bill_dt', $us_time, ['class' => 'form-control', 'id' =>'bill_dt']) !!}
         
        </div>
    </div> 
</div>

           

        <div class="form-group">

            <!-- Hidden fields of Orders -->  
          
            <input type="hidden" name="client_creation_id" class='creationid'>
            <input type="hidden" name="other_contact" value=' '>
            
           

        </div>

<div class="row">
      <div class="col-md-1">
        <div class="form-group">
            {!! Form::label('Total Files', 'Files:', ['class' => 'control-label']) !!}
            {!! Form::number('file_count', 1, ['placeholder'=>'Enter File Count', 'class' => 'form-control fcount',
             'readonly'=>'readonly', 'id' =>'file_count']) !!}
         
        </div>
      </div> 
    <div class="col-md-2">
    <div class="form-group">
        {!! Form::label('file_type', 'File Type:', ['class' => 'control-label']) !!}
        {!! Form::select('file_type', [ 'Vector' => 'Vector', 'Digitizing' => 'Digitizing' ,'Photoshop' =>'Photoshop'] , 'Vector', ['class' => 'ftype form-control']) !!}
    </div>
    </div>

    
    <div class="col-md-2">

        <div class="form-group">
            {!! Form::label('Vendor', 'Vendor:', ['class' => 'control-label']) !!}
             {!! Form::select('vendor', $vendors, null,  ['class' => 'vend  form-control' ,'required'=>'required'
              ]) !!} 
           
        </div>
    </div>    

    <div class="col-md-1 show_stich">
        <div class="form-group">
   
              {!! Form::label('stiches_count', 'Stiches:', ['class' => 'control-label slabel']) !!}
                {!! Form::number('stiches_count', 0.00, ['class' => 'form-control scount', 'required'=>'required']) !!}
   
        </div>
    </div> 

    <div class="col-md-1  show_stich">
         <div class="form-group">
              {!! Form::label('digit_rate', 'Digitrate:', ['class' => 'control-label']) !!}
                 {!! Form::number('digit_rate', null, ['class' => 'form-control form-control3 digitrt', 'step' => 'any']) !!}
         </div>
    </div>

     <div class="col-md-1">    
        <div class="form-group">
            {!! Form::label('file_price', 'Price:', ['class' => 'control-label']) !!}
            {!! Form::number('file_price', 5.5, ['class' => 'valid_file_price form-control', 'required'=>'required' , 'step' => 'any']) !!}
        </div>
    </div>  
             <div class="col-md-2 form-group">
             <label class="control-label rdcolor">No. of Detail Rows:</label>
             <input type="text" name="norows"  class="form-control numrows" />
                 
          </div>
      
          <div class="col-md-2 form-group">
             <label class="control-label rdcolor">Detail Row Price:</label>
             <input type="text" name="dtlrowprice"  class="form-control dtlrowprice" />
                 
          </div>
          
          <div class="col-md-2 form-group ">
                <label class="control-label rdcolor" style="color: white">sadsdaasda</label>
              <input class="btn btn-primary btn-outline" type="button" value="Create Rows" onClick="calrow();">
          </div>

            <input type="hidden" name="client_specific"  class="form-control client_specific" />   
</div>

<div class="row">
   {{--  <div class="col-md-1">
         <div class="form-group">
              {!! Form::label('digit_rate', 'Digitize Rate', ['class' => 'control-label']) !!}
                 {!! Form::number('digit_rate', null, ['class' => 'form-control']) !!}
         </div>
    </div>
   </div> --}}
    
</div>
<hr>

<div class="row"  id="morefiles">
  <div class="col-md-1">
    <label class="control-label">Doc.Type:</label>
     <select  name="orddtls[document_type][]"  class=" form-control form-control3 doctype" value=" " autofocus="autofocus" required="required"><option value="Normal">Normal</option><option value="Rush">Rush</option><option value="SuperRush">SuperRush</option></select>
       <input type="hidden" name="npnameuse" value="firstdata">
  </div>
  <div class="col-md-2">
      <label class="control-label">File Name:</label>
     <input type="text" 
           name="orddtls[file_name][]"  class=" form-control " 
             value="{{ old('file_name.0') }}"  required="required"> 
  </div>
  <div class="col-md-1">
    <label class="control-label">price:</label>
       <input type="text"  name="orddtls[file_price][]"  class=" form-control dtl_fileprice"  value="{{ is_null(old('file_price.0')) ? 5.5 : old('file_price.0') }}"  
          required="required" step="any">
  </div>
  <div class="col-md-2">
    <label class="control-label">File Note:</label>
     <textarea class="form-control form-control2"   name="orddtls[note][]" required="required"></textarea>
  </div>
  @php
   $randomallo=rand();
                
  @endphp
  <div class="col-md-2">
        
            <label class="control-label">Allocation :</label><a class="btn btn-sm btn-round addalloacation">Change</a>
            <div class="modal fade bd-example-modal-md dddd" id="dddd{{$randomallo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                 <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8"><b>Select Designer</b></div>
                     <div class="col-md-4"><a class="btn btn-danger btn-sm mb-2 rightdiv closealloacation" id="" style="color: white;">X</a>
                     </div>
                  </div>
                      <select class="form-control selectalloc cc{{ $randomallo }}" name="orddtls[allocation1][]"  multiple="multiple" data-live-search="true" id="dropDownId" onchange="myFunctionallocation(this,'ordtls{{$randomallo}}','ordtlsid{{$randomallo}}','allocationshow{{ $randomallo }}')" > 
                       @foreach ($users as $key1=>$value1) 
                              <option value={{$key1}}>{{ $value1 }}.</option> 
                       @endforeach
                      </select>
                      <br><br>
                      <input type="hidden" name="orddtls[allocation][]" value="not allocated" id="ordtls{{$randomallo}}" class="updatealloc"><input type="hidden" name="orddtls[alloc_id][]" value="0" id="ordtlsid{{$randomallo}}" class="updateallocid"> <br><br><br><br><br><br><br><br><br><br>
                      <a class="btn btn-primary rightdiv submitalloacation" id="submitalloacation">Submit</a>
                    </div>
                  </div>
                </div>
              </div>
              <div id="allocationshow{{ $randomallo}}"> </div> 
  </div>
  <div class="col-md-2">
       <label class="control-label">Target-Time:</label>
       <input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime targettimeidfirstdata" value="{{ $target_date }}"  required="required">
       
           <label id="target_completion_time_error" class="target_completion_time_error" for="target_completion_time"></label>
           <label id="target_completion_time_success" class="success" for="target_completion_time"></label>
  </div>
  <div class="col-md-1">
    <label class="control-label">status:</label>
      <select  name="orddtls[status][]"  class=" form-control form-control3 fstatus quotecolor" 
                          value="{{ old('status.0') }}"  required="required" onchange="myStatuscolor(this)"> 
                      <option value="Quote">Quote</option>
                      <option value="Approved">Approved</option> 
                      <option value="Alloted">Alloted</option>
                     
            </select>    
           <label id="status_error" class="status_error" for="status"></label>
           <label id="status_success" class="success" for="status"></label>
  </div>
  <div class="col-md-1">
     <label class="control-label rdcolor" style="color: white">sadsdaas</label>
     
   <div style="text-align: center;"><input class="form-control mb-2 btn btn-danger btn-outline delete" type="submit" value="Delete"><span class="countre" style="color: white; background-color: #87B0D1; border-radius: 20px;padding: 5px 6px 5px 6px;"><b>1</b></span></div>
 </div>
</div>


<a id="addrow" href="#" class="btn btn-success btn-outline add">Add Order</a> 

<!-- <a id="addrow" href="#" class="btn btn-success btn-outline add">Add More</a> --> 
<div class="row"> 
  <div class="col-md-7"> 
{!! Form::submit('Submit',['class' => 'btn btn-warning rightdiv btn-wd']) !!}
</div>
</div>
{!! Form::close() !!}

</div>  

</div>
</div>
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

 //show selection box in allocation modal
  $(document).ready(function(){

     var multipleCancelButton = new Choices('#dropDownId', {
     removeItemButton: true,
     maxItemCount:15,
     // searchResultLimit:5,
     // renderChoiceLimit:5
     });
 
  });
  //show alloacation modal
  $(document).on("click", ".addalloacation", function(e){

     var nextSectionWithId =  $(this).next().attr("id");
 
      $('#'+nextSectionWithId).modal("show"); 
  });

  //close alloaction modal
  $(document).on("click", ".closealloacation", function(e){
    var as=$(this).next().val();
    
     $('.dddd').modal("hide"); 
  });

  //submit allocation modal
  $(document).on("click", ".submitalloacation", function(e){
     $('.dddd').modal("hide"); 
  });
$(document).ready(function ($) {

        //alert("hello order create ready");
        //$(".clientinput").focus();
        //$(".clientinput").blur();
        //document.newformadd.input.focus();

 $(".show_stich").hide()
   

$.fn.rowCount = function() {
    return $('tr', $(this).find('tbody')).length;
};

$(document).on("focusout", ".dtl_fileprice" , function(e){
      //alert(this.value);
      TotalPriceCalc();


});

  $(document).on("change", ".ftype", function(e){
    var file_type =  this.value ;
    //alert(file_type);
    if (file_type != "Digitizing"){
        // $(".scount").attr('readonly', 'readonly');
           $(".show_stich").hide()
           $(".valid_file_price").val(5.5);
    }
    else {
        $(".valid_file_price").val(0.00);
        $(".show_stich").show()
    }

  });     

  


// added below code on 27/09/17 
// token added on  01-feb-2020
$(document).on("keyup", "input#search.form-control.searchinput", function(e){
    //alert('mymodal2');
    e.preventDefault();
    
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    })
   
   var _token = $(this).parents('form:first').find('input[name=_token]').val(); 
    
    $value = $(this).val();
    // alert($value);
    if($value){
        //$("#myModal2").modal('show');
        $("#search").val($value);
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('orders/search') }}",
            data: {search: $value, _token: _token},
            success:function(data)
                  {
                    $("#clienthelp tbody").html(data);
                  }
        
        });
    }
    else
    {
       Swal.fire({
                         
                          text: 'Client Name cannot be Blank'
                                                    
                      })
    }

});


  // added above code on 27/09/17
   
        $(document).on("keyup", ".clientinput", function(e){
       //alert('mymodal2');
        //e.preventDefault();
         
        $value = $(this).val();
        //alert($value);
        if($value.length > 0 ){
                //alert($value);
                $("#myModal2").modal('show');
               

                $("#search").val($value);
                 // alert($value);
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "{{ URL::to('orders/search') }}",
                    data: {"search": $value},
                    success:function(data)
                    {
                        $("#clienthelp tbody").html(data);
                    }
        
                });
        }
        else
        {
            Swal.fire({
                         
                          text: 'Client Name cannot be Blank'
                                                    
                      })
            
        }
             
        });





      $(document).on("click", ".clienthelp tr", function(e){
      //     e.preventDefault();
      // $("#clienthelp  tr").click(function(){
        
        $(this).addClass('selected').siblings().removeClass('selected'); 

        //var tmp_var =$(this).find('td:eq(0)').html(); just to check firt column

        var vclient_creation_id=$(this).find('td:eq(1)').html();
        
        var vclient_name=$(this).find('td:eq(2)').html();
        var vprimary_email=$(this).find('td:eq(3)').html();
        // var vsecondary_email=$(this).find('td:eq(4)').html();
        var vcompany=$(this).find('td:eq(4)').html();
        var vclient_note=$(this).find('td:eq(5)').html();
        var vclient_contact_1=$(this).find('td:eq(6)').html();
        var vcompany_id=$(this).find('td:eq(7)').html();
        var vdel_flag=$(this).find('td:eq(8)').html();
        var vdigit_rate=$(this).find('td:eq(9)').html();
        var vclient_specific=$(this).find('td:eq(10)').html();
        
       
   

      });

     //$(".clienthelp tr").on("dblclick", function(){  
    $(document).on("dblclick", ".clienthelp tr", function(e){ 
         // alert('hi');
                //alert($( "OrderCreateModal input[name='client_name']").val()) ;
           
          // $(".clienthelp tr").unbind("click");
          // $(".clienthelp tr").unbind("dblclick");
           $(this).addClass('selected').siblings().removeClass('selected');    
          var vclient_creation_id=$(this).find('td:eq(1)').html();
          var vclient_name=$(this).find('td:eq(2)').html();
          var vprimary_email=$(this).find('td:eq(3)').html();
          // var vsecondary_email=$(this).find('td:eq(4)').html();
          var vcompany=$(this).find('td:eq(4)').html();
          var vclient_note=$(this).find('td:eq(5)').html();
          var vclient_contact_1=$(this).find('td:eq(6)').html();
          var vcompany_id=$(this).find('td:eq(7)').html();
          var vblack_list=$(this).find('td:eq(8)').html();
           var vdigit_rate=$(this).find('td:eq(9)').html();
            var vclient_specific=$(this).find('td:eq(10)').html();
           
          //alert(vcompany);
          //var n = vcompany.indexOf("Signs  ");
          //alert(n);

          //if (n >= 0)

          if (vclient_specific != '')
          {
            
                  $("#newformadd .client_specific").val(vclient_specific);
                  
                 //bootbox.alert("Client Specific Note\n " + vclient_specific);
                  Swal.fire({
                                           icon: 'error',
                                           title: 'Special Client Details',
                                           text: vclient_specific
                                          
                                     })
                    
          }

          if(vblack_list == 'Y') {
               
                Swal.fire({
                         
                          text: 'This Company is not willing to Pay, Please confirm for ordering with Patil prior to proceed'
                                                    
                      })
                
          }
          

          if (vcompany.trim() == 'Signs')  
          {
              
             $("#file_price").val(5);
            // debugger;
             //var row = $(".dtlbody").children('tr:first');
             //$(row).closest(".dtl_fileprice").val(5); 
             $(".dtlbody").children('tr:first').find('td.dtl_fileprice').val(5);
             $(".dtl_fileprice").val(5);
          }
          else {
               
              $("#file_price").val(5.5);
               $(".dtlbody").children('tr:first').find('td.dtl_fileprice').val(5.5);
             $(".dtl_fileprice").val(5.5);
          }
        
          //alert(vclient_creation_id);
          //alert(vclient_note);

          $("#myModal2").modal('hide');  
         
          //alert($(this).closest('div.modal.fade.nnds').attr('id'));
          $( "#newformadd #client_name" ).val(vclient_name.trim());
          $( "#newformadd #client_email_primary" ).val( vprimary_email );
          $( "#newformadd #client_company" ).val(vcompany.trim());
          // $( "#newformadd .clientcomp" ).css( 'text-align', 'left');
          // $( "#newformadd .clientcomp" ).css( 'float', 'left');
          
          $( "#newformadd  .creationid" ).val( vclient_creation_id );
          $("#newformadd #digit_rate").val(vdigit_rate);
            $( "#newformadd  .client_specific" ).val( vclient_specific );
          //$( "#newformadd  .cnote" ).val( vclient_note );
          //$( "#newformadd  #client_contact_1" ).val( vclient_contact_1 );
          //$( "#newformadd  .compid" ).val( vcompany_id );

         $("#newformadd .ftype").focus();

        // alert("data received");
        
         //$("input").blur();
           
        });

    

 $(".add").click(function(){

     $("#OrderDtlCreateModal").modal("show");
        var now = new Date();
        now.setDate(now.getDate()+1);

        var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn ;

              var  $option1 = '@foreach ($users as $user)<option value="{{ $user }}">{{ $user }}</option @endforeach' ;


              
                TotalPriceCalc();
                var countinc=cnt+1;
               var randomallo1= Math.floor(Math.random() * 100000);
      
             ord1='ordtls'+randomallo1;
             ord2='ordtlsid'+randomallo1;
             ord3='cc'+randomallo1;
             ord4='allocationshow'+randomallo1;
                $("#morefiles").append('<div class="row pr-3 pl-3 delclass"><div class="col-md-1"><label class="control-label">Doc.Type:</label><select  name="orddtls[document_type][]"  class="form-control form-control3 doctype" value=" " "autofocus"="autofocus" required="required"><option value="Normal">Normal</option><option value="Rush">Rush</option><option value="SuperRush">SuperRush</option></select><input type="hidden" name="npnameuse" value="'+randomallo1+'"></div><div class="col-md-2"><label class="control-label">File Name:</label><input type="text" name="orddtls[file_name][]"  class=" form-control filenamepop "  value=" "  required="required"> </div><div class="col-md-1"><label class="control-label">price:</label><input type="text" name="orddtls[file_price][]"  class=" form-control dtl_fileprice "  value=0 required="required"  step="any"></div><div class="col-md-2"><label class="control-label">File Note:</label><textarea class="form-control form-control2" name="orddtls[note][]" required="required"></textarea></div><div class="col-md-2"><label class="control-label">Allocation :</label><a class="btn btn-sm btn-round addalloacation">Change</a><div class="modal fade bd-example-modal-md dddd" id="dddd'+randomallo1+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-md" role="document"><div class="modal-content"><div class="modal-body"><div class="row"><div class="col-md-8"><b>Select Designer</b></div><div class="col-md-4"><a class="btn btn-danger btn-sm rightdiv closealloacation" id="" style="color: white;">X</a></div></div><select class="form-control selectalloc '+ord3+'" name="orddtls[allocation1][]"  multiple="multiple" data-live-search="true" id="dropDownId'+randomallo1+'" onchange="myFunctionDynamicallocation(this,'+ord1+','+ord2+','+ord4+')" > @php foreach ($users as $key1=>$value1) { @endphp <option value={{$key1}}>{{ $value1 }}.</option> @php    }  @endphp</select><input type="hidden" name="orddtls[allocation][]" value="not allocated" id="'+ord1+'"><input type="hidden" name="orddtls[alloc_id][]" value="0" id="'+ord2+'"> <br><br><br><br><br><br><br><br><br><br><a class="btn mt-5 btn-primary rightdiv submitalloacation" id="submitalloacation">Submit</a></div></div></div></div><div id="'+ord4+'"></div></div><div class="col-md-2"><label class="control-label">Target-Time:</label><input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime targettimeid'+randomallo1+'" value="{{ $target_date }}"  required="required"></div><div class="col-md-1"><label class="control-label">status:</label><select  name="orddtls[status][]"  class=" form-control form-control3 fstatus quotecolor" value=" "  required="required" onchange="myStatuscolor(this)"><option value="Quote">Quote</option><option value="Approved">Approved</option><option value="Alloted">Alloted</option></select></div><div style="text-align: center;" class="col-md-1"><label class="control-label" style="color: white">sadsdaas</label><input class="form-control mb-2 btn btn-danger btn-outline delete" type="submit" value="Delete"><span class="countre" style="font-weight: bold;;color:white; background-color: #87B0D1; border-radius: 20px;padding: 5px 6px 5px 6px;">'+ countinc +'</span></div></div>');
        // $(this).closest('tr').find('.targettime').val(tdate);
        // $(this).closest('tr').find('.doctype').focus();
        var multipleCancelButton = new Choices('#dropDownId'+randomallo1, {
                 removeItemButton: true,
                 maxItemCount:15,
                 // searchResultLimit:5,
                 // renderChoiceLimit:5
                 });
      TotalPriceCalc();
       
        

        return false;


     });  
 //delete new added row
    $("#morefiles").on("click",".delete",function () {
            var s=$(".fcount").val();
            $(".fcount").val(s-1);
            var ff=$(this).next('.countre').html();
            if(parseInt(ff) > 1){
              $('.countre').html(function(index, html) {
                  if(parseInt(html) >= parseInt(ff)){
                   
                   return html - 1;
                 } 
              });
            }
            else{
              Swal.fire({
              type:'info',
              text:'Delete Operation Not Perform on One File',
            })
              
            }
            $(this).closest('.delclass').remove();
             
    });
     
       

    $( ".dtlbody" ).on( "click", '.delete',  function() {
        // alert('delete');
        var n = ($('#orderdtltable .dtlbody tr').length-0);
        //alert(n);


         $("#newformadd .fcount").val(n);
        if(n==1) {
              alert("Delete Not Allowed");
               }
        else {
             
              $(this).closest('tr').remove();
              
         }

      var cnt= 1;
      var cnt = $(".dtlbody").children().length;
      
      //alert(cnt);
      $(".fcount").val(cnt);
        TotalPriceCalc();
  
    }); 


$(document).on("click", ".odt", function(e){  
    //alert('ok');
});

$("#order_date_time").datetimepicker();

$(".targettime").datetimepicker();

$("#bill_dt").datepicker( {dateFormat: 'yy-mm-dd'});


  // allocation logic
    $(document).on("change", "select.selectalloc", function(e){   
        var option_all = ''; 
        var option_all = $(this).closest('tr').find(".selectalloc option:selected").map(function() {     return $(this).text();
              
          }).get().join(',');

  //  alert(option_all);
  //var alloc =  $(".selectalloc option:selected").text(); for testing keep this working fine
        //$(".selectalloc option:selected").each(function () {
           // val.push(this.text);
         //  });
           // alert(val.join(','));
           // var alloctext =  val.join(',');
          // alert(alloctext);
  $(this).closest('tr').find('.updatealloc').val(option_all);

      var result = new Array();

      //$("select.selectalloc").each(function() {
            result.push($(this).val());
      //  });

      var output = result.join(", ");
      //alert(output);
         $(this).closest('tr').find('.updateallocid').val(output);

    });
//$("#orderdtltable td.doctype").focusout(function(event) {

$(document).on("focusout", "#orderdtltable select.doctype", function(e){   
  /* Act on the event */

    var  document_type =  this.value ;
     

    var now = new Date();
     // alert(document_type);
       
      if (document_type == 'Normal') {
              
            now.setDate(now.getDate()+1);
            //now.setMinutes(now.getMinutes() + 30);
            // alert(now);
            //var tdate = Date.parseDate(now, "Y-m-d g:i a");
 
             var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00';
            
            //alert(tdate);
            //$(".targettime").val(tdate);
            $(this).closest('tr').find('.targettime').val(tdate);

          }

});



//$("#orderdtltable td.doctype").change(function(event) {
$(document).on("change", "select.doctype", function(e){     
  /* Act on the event */

      var  document_type =  this.value ;
      var findtargetid=$(this).next().val();
      var now = new Date();
      //alert(document_type);
       
      if (document_type == 'Normal') {
              
            now.setDate(now.getDate()+1);
            //now.setMinutes(now.getMinutes() + 30);
            // alert(now);
            //var tdate = Date.parseDate(now, "Y-m-d g:i a");
 
             var d =   now,
               month = '' + (d.getMonth() + 1),
               day = '' + d.getDate(),
               year = d.getFullYear(),
               hr   = d.getHours(),
               mn   = d.getMinutes();

              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;

              var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn ;
            
            //alert(tdate);
            //$(".targettime").val(tdate);
            $('.targettimeid'+findtargetid).val(tdate);

          }
      else if (document_type == 'Rush') {
              
            var now = new Date();
            
            var now = new Date(now.setHours(now.getHours() + 3));
            //alert('new hour' +now);
            
            
            var now = new Date(now.setMinutes(now.getMinutes() + 30));
            //alert('new' + now);
            
            var d   =   now,
            month   = '' + (d.getMonth() + 1),
            day     = '' + d.getDate(),
            year    = d.getFullYear(),
            hr      = d.getHours() ,
            mn      = d.getMinutes();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00' ;
            
            //alert(tdate);
            //$(".targettime").val(tdate);
               $('.targettimeid'+findtargetid).val(tdate);

      } 
      else {

            var now = new Date();
            var now = new Date(now.setHours(now.getHours() + 1));
            var now = new Date(now.setMinutes(now.getMinutes() + 30));

            var d   =   now,
            month   = '' + (d.getMonth() + 1),
            day     = '' + d.getDate(),
            year    = d.getFullYear(),
            hr      = d.getHours() ,
            mn      = d.getMinutes() ;

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var tdate = year + '-' + month + '-' + day + ' '+ hr +':'+mn +':00';
            
            //alert(tdate);
            //$(".targettime").val(tdate);
                 $('.targettimeid'+findtargetid).val(tdate);

      }   

    });

});  


function TotalPriceCalc() {
    var total = 0.00;
    cnt=0 ;
    $(".dtl_fileprice").each(function() {
       //alert(this.value);
       if ($("#client_company").val() == "Signs")
        {
            
             $(this).val(5);
        }
         // else {
         //       $(this).val(5.5);
         //  }

       cnt= cnt + 1;
      //var cnt = $(".dtlbody").children().length;
      //alert(cnt);
      $(".fcount").val(cnt);
      
      
    total += parseFloat(this.value,2) || 0;
    $(this).closest('tr').find('.updrow').text(cnt);
  });
    //$("#lblTotalPrice").val(total);
    $("#file_price").val(total);

    // rowctr = $('#orderdtltable').rowCount();
    //alert(rowctr);
    //$(".updrow").text(rowctr);
}

function calrow() {
  // body...
  var cnt = $(".numrows").val();
  var dtlrowprice = $(".dtlrowprice").val();
  //alert("Click button" + cnt);
   var countinc=$(".fcount").val();
   
  for(i=0; i< cnt-1; i++) {
    var randomallo1= Math.floor(Math.random() * 100000);
      
             ord1='ordtls'+randomallo1;
             ord2='ordtlsid'+randomallo1;
             ord3='cc'+randomallo1;
             ord4='allocationshow'+randomallo1;
    countinc++;
                $("#morefiles").append('<div class="row pr-3 pl-3 delclass"><div class="col-md-1"><label class="control-label">Doc.Type:</label><select  name="orddtls[document_type][]"  class="form-control form-control3 doctype" value=" " "autofocus"            ="autofocus" required="required"><option value="Normal">Normal</option><option value="Rush">Rush</option><option value="SuperRush">SuperRush</option></select></div><div class="col-md-2"><label class="control-label">File Name:</label><input type="text" name="orddtls[file_name][]"  class=" form-control filenamepop "  value=" "  required="required"> </div><div class="col-md-1"><label class="control-label">price:</label><input type="text" name="orddtls[file_price][]"  class=" form-control dtl_fileprice "  value=0 required="required"  step="any"></div><div class="col-md-2"><label class="control-label">File Note:</label><textarea class="form-control form-control2" name="orddtls[note][]" required="required"></textarea></div><div class="col-md-2"><label class="control-label">Allocation :</label><a class="btn btn-sm btn-round addalloacation">Change</a><div class="modal fade bd-example-modal-md dddd" id="dddd'+randomallo1+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-md" role="document"><div class="modal-content"><div class="modal-body"><div class="row"><div class="col-md-8"><b>Select Designer</b></div><div class="col-md-4"><a class="btn btn-danger btn-sm rightdiv closealloacation" id="" style="color: white;">X</a></div></div><select class="form-control selectalloc '+ord3+'" name="orddtls[allocation1][]"  multiple="multiple" data-live-search="true" id="dropDownId'+randomallo1+'" onchange="myFunctionDynamicallocation(this,'+ord1+','+ord2+','+ord4+')" > @php foreach ($users as $key1=>$value1) { @endphp <option value={{$key1}}>{{ $value1 }}.</option> @php    }  @endphp</select><input type="hidden" name="orddtls[allocation][]" value="" id="'+ord1+'"><input type="hidden" name="orddtls[alloc_id][]" value="" id="'+ord2+'"> <br><br><br><br><br><br><br><br><br><br><a class="btn btn-primary rightdiv submitalloacation" id="submitalloacation">Submit</a></div></div></div></div><div id="'+ord4+'"></div></div><div class="col-md-2"><label class="control-label">Target-Time:</label><input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime" value="{{ $target_date }}"  required="required"></div><div class="col-md-1"><label class="control-label">status:</label><select  name="orddtls[status][]"  class=" form-control form-control3 fstatus quotecolor" value=" "  required="required" onchange="myStatuscolor(this)"><option value="Quote">Quote</option><option value="Approved">Approved</option><option value="Alloted">Alloted</option></select></div><div style="text-align: center;" class="col-md-1"><label class="control-label" style="color: white">sadsdaas</label><input class="form-control btn btn-danger btn-outline delete" type="submit" value="Delete"><span class="countre" style="font-weight: bold;;color:white; background-color: #87B0D1; border-radius: 20px;padding: 5px 6px 5px 6px;">'+ countinc +'</span></div></div>');
 

                 var multipleCancelButton = new Choices('#dropDownId'+randomallo1, {
                 removeItemButton: true,
                 maxItemCount:15,
                 // searchResultLimit:5,
                 // renderChoiceLimit:5
                 });
                 
         
  

    }
   
    $(".dtl_fileprice").each(function() {
                 $(".dtl_fileprice").val(dtlrowprice); 
      });   
    
    TotalPriceCalc();


}
function myFunctionallocation(cc,csf,csf2,allocationshowid) {
   var x =  $(cc).val();
   var y =  $(cc).text();

       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
   $('#'+csf).val(y);   
   $('#'+csf2).val(x); 
   $('#'+allocationshowid).html(dc);
}
function myFunctionDynamicallocation(cc,csf,csf2,allocationshowid) {
   var x =  $(cc).val();
   var y =  $(cc).text();

       y=y.split('.').join(',');
   var dc=y.replace(/,/g, '<br>');

  // $(cc).next().find('.updatealloc').val();  
   $('#'+csf.id).val(y);   
   $('#'+csf2.id).val(x); 
   $('#'+allocationshowid.id).html(dc);
}
function myStatuscolor(thisstatus) {

  var statusname=$(thisstatus).val()
  
  if(statusname == 'QC OK'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('qcokcolor');
  }
  else if(statusname == 'Quote'){
     var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('quotecolor');
  }
  else if(statusname == 'QC Pending'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('qcpendingcolor');
  }
  else if(statusname == 'No Response'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('noresponsecolor');
  }
  else if(statusname == 'Approved'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('approvedcolor');
  }
  else if(statusname == 'UnApproved'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('unapprovedcolor');
  }
  else if(statusname == 'Alloted'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('allotedcolor');
  }
  else if(statusname == 'Completed'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('completedcolor');
  }
  else if(statusname == 'On Hold'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('onholdcolor');
  }
  else if(statusname == 'Cancel'){
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('cancelcolor');
  }
  else{
    var lastClass = $(thisstatus).attr('class').split(' ').pop();
    $(thisstatus).removeClass(lastClass);
    $(thisstatus).addClass('nocolorclasscolor');
  }

}
</script> 


@endsection

