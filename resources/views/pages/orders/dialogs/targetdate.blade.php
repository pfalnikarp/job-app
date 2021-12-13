
<div id="targetdatedialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <div class="row">
     
     
         <div class="form-group">
            {!! Form::label('new_target_date2', 'Target Date:', ['class' => 'control-label']) !!}
            {!! Form::text('new_target_date2', null, ['class' => ' form-control new_target_date2', 'required'=>'required' , 'step' => 'any']) !!}
         </div>
    


   
   </div>
 	
 	<input type="hidden" class="statusid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
