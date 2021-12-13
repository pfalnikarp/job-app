
<div id="statusdialog1"  style="display:none; ">
    
  
 
    <div  class="form-group">
               
                {!! Form::select('status', $status, null, ['class' => 'form-control dstatus', 'tabindex' =>'1']) !!}
    </div>


 	
 	<input type="hidden" class="statusid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

</div>
