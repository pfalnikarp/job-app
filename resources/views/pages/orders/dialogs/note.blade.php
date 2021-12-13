
	
<div id="notedialog" style="display:none;">
    {!! Form::open(['route'=>'orders.updatenotes']) !!}
  <!-- <p id="oldnotes"></p> -->
  	<!-- <p  id="oldnotes"   readonly="readonly" style="width:99%; height:160px;"></p> -->
  	<textarea  id="oldnotes" tabindex="1" class="oldnotes"  readonly="readonly" style="width:99%; height:160px;"></textarea>
  	
    

	<textarea autofocus id="newnotes" tabindex ="2" class="newnotes" placeholder="Enter new notes to update old notes...."  style="width:99%; height:100px;" required></textarea>

	
   
    
    <p class="success" style="color:blue;" > </p>

	<div style="display:none;">
	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
 -->
 		<input type="hidden" class="noteid" name="id" id="id" value=0 />
 		
	</div>

	<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 	{!! Form::close() !!}

</div>
