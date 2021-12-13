
	
<div id="allocdialog" style="display:none;">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->
  
  {!! Form::select('allocation1[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId', 'class' => 'fooalloc form-control ', 'onfocus'=> 'this.size=4;'     ]) !!}


	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
 -->
 	
 	<input type="hidden" class="allocid" name="id" id="id" value=0 />
 	<input type="hidden" class="allocname" value="" />
 		
</div>

<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
