<div id="client_allocdialog" style="display:none;">
    

  
  {!! Form::select('allocation1[]', $alloc_id,  null, ['multiple'=>'multiple' , 'id'=>'dropDownId', 'class' => 'fooalloc form-control', 'onfocus'=> 'this.size=4;'     ]) !!}

 	
 	<input type="hidden" class="allocid" name="id" id="id" value=0 />
 	<input type="hidden" class="allocname" value="" />
 		
</div>