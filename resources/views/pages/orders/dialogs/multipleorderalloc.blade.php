
	
<div id="mallocdialog" style="display:none;">
    
{{ csrf_field() }}
   
  
  {!! Form::select('allocation2[]', $users,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId2', 'class' => 'fooalloc form-control', 'onfocus'=> 'this.size=4;'     ]) !!}


	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
 -->
 	
 	{{-- <input type="hidden" class="allocid" name="id" id="id" value=0 /> --}}
 		
</div>

<meta name="_token1" class="token1" content="{!! csrf_token() !!}" />

	


</div>
