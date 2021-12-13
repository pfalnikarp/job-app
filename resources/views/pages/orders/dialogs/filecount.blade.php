
<div id="filecountdialog" style="display:none;">

  
    {!! Form::label('file_count', 'File Count', ['class' => 'control-label']) !!}

    {!! Form::number('file_count', 1, ['class' => 'required form-control fcountval','required'=>'required']) !!}
               
 	
 	<input type="hidden" class="filecountid" name="id" id="id" value=0 />
 		
	<div class="success"> </div>

	<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />


</div>
