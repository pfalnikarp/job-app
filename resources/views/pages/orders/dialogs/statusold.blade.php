
<div id="statusdialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->
    <div  class="form-group">
                {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                {!! Form::select('status', $status, null, ['class' => 'form-control ', 'tabindex' =>'1']) !!}
    </div>

	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
 -->
 	
 	<input type="hidden" class="statusid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
