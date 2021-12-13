
<div id="filepricedialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <div class="row">
      <div  class="form-group col-md-3">
                 {!! Form::label('old_price', 'Present File Price:', ['class' => 'control-label']) !!}
                {!! Form::number('old_price',  null , ['class' => 'form-control w3-container old_price1 ', 'readonly'=>'readonly' ]) !!}
     </div>

	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
    -->

    <div  class="form-group col-md-2">
               {!! Form::label('add_price', 'Add Amount:', ['class' => 'control-label']) !!}
                {!! Form::number('add_price',  null , ['class' => 'form-control w3-container add_price ']) !!}
     </div>


       <div class="col-md-2">    
        <div class="form-group">
            {!! Form::label('file_price2', 'New File Price:', ['class' => 'control-label']) !!}
            {!! Form::number('file_price2', 0, ['class' => ' form-control file_price2', 'required'=>'required' , 'step' => 'any']) !!}
        </div>
    </div>  

       <div class="col-md-4">    
        <div class="form-group">
            {!! Form::label('new_target_date2', 'Target Date & Time:', ['class' => 'control-label']) !!}
            {!! Form::text('new_target_date2', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
        </div>
    </div>  


   
   </div>

     <div class="row">
         
        <div class="col-md-5"> 
            <div class="form-group ">
                 {!! Form::label('oldnotes', 'Present File Notes:', ['class' => 'control-label']) !!}
                  <!-- <textarea  id="oldnotes" tabindex="1" class="oldnotes"  readonly="readonly" ></textarea>  -->
                    {!! Form::textarea('oldnotes', null, ['class' => 'oldnotes form-control', 'readonly'=>'readonly'  ]) !!}
            </div>
        </div>
          
        <div class="col-md-5"> 
            <div class="form-group ">
                  {!! Form::label('revision_note', 'New Note:', ['class' => 'control-label']) !!}
                  {!! Form::textarea('rev_note', null, ['class' => ' form-control rev_note ', 'required'=>'required' ]) !!}
            </div>
        </div>
    

    </div>
 	
 	<input type="hidden" class="statusid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
