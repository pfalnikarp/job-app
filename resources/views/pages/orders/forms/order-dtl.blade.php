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






        <div class="form-group row">
          
        <label for="document_type" class="col-sm-4 control-label">Doc.Type</label>
         
        <div class="col-sm-8">
         {!! Form::select('orddtls[document_type][]', ['Normal' => 'Normal', 'Rush' => 'Rush','SuperRush' => 'SuperRush'], 
         'Normal' , ['class' => 'required form-control doctype',  'required'=>'required']) !!}
          </div>
        </div>
           


    
        <div class="form-group row">
           <label for="file_name" class="col-sm-4 control-label">File Name</label>
          <div class="col-sm-8">

           <input type="text" 
           name="orddtls[file_name][]"  class=" form-control " 
             value="{{ old('file_name.0') }}"  required="required"> 
            </div>
           <label id="file_name_error" class="file_name_error" for="file_name"></label>
           <label id="file_name_success" class="success" for="file_name"></label>
        </div>  
    

   
      <div class="form-group row">
          <label for="file_price" class="col-sm-4 control-label">File Price</label>
           <div class="col-sm-8" >
          <input type="text"  name="orddtls[file_price][]"  class=" form-control dtl_fileprice"  value="{{ is_null(old('file_price.0')) ? 5.5 : old('file_price.0') }}"  
          required="required" step="any">
            
      </div>
    </div>

    
        <div class="form-group row ">
            <label for="note" class="col-sm-4 control-label">File Note</label>
            <div class="col-sm-8">

            <textarea class="form-control" name="orddtls[note][]" required="required"></textarea>
            </div>
        </div>

    
        <div class="form-group row ">
             {!! Form::label('allocation1', 'Allocation', ['class' => 'col-sm-4 control-label']) !!}
             {!! Form::select('orddtls[allocation1][]', $users,  '0', ['multiple'=>'multiple' ,'class' => 'col-sm-8 form-control selectalloc'   
              ]) !!}
            {!! Form::hidden('orddtls[allocation][]','0' , ['class' => 'form-control updatealloc']) !!}
            {!! Form::hidden('orddtls[alloc_id][]', '0' , ['class' => 'form-control updateallocid']) !!}
        </div>  

    </div>           

    
    <div class="form-group row ">
            <label for="target_completion_time" class="col-sm-4 control-label">Target  Time</label>
            <div class="col-sm-8">
            <input type="text" name="orddtls[target_completion_time][]"  class=" form-control targettime" 
              value="{{ $target_date }}"  required="required"> 
        
           <label id="target_completion_time_error" class="target_completion_time_error" for="target_completion_time"></label>
           <label id="target_completion_time_success" class="success" for="target_completion_time"></label>
        </div>  

    </div>

      
        <div class="form-group row">
            <label for="status" class="col-sm-8 control-label">Status</label>
            <div class="col-sm-8">
            <select  name="orddtls[status][]"  class=" form-control fstatus" 
                          value="{{ old('status.0') }}"  required="required"> 
                      <option value="Quote">Quote</option>
                      <option value="Approved">Approved</option> 
                      <option value="Alloted">Alloted</option>
                     
            </select>    
           <label id="status_error" class="status_error" for="status"></label>
           <label id="status_success" class="success" for="status"></label>
           </div>  

        </div>
  

    <div class="row">  
       <input class="btn btn-danger delete" type="submit" value="Delete"></input>
    </div>
     

    {{ Form::reset('Clear form', ['class' => 'form-button']) }}

</div>


