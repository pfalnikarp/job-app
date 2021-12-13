
<div id="newfiledialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <div class="card">
        <div class="card-body">
   <div class="row form-group" style="text-align: center;">
                 {!! Form::label('oldfilename', 'Old File Name:', ['class' => 'control-label']) !!}
                {!! Form::text('oldfilename',  null , ['class' => 'form-control w3-container filename1',
                'readonly'=> 'readonly'
                ]) !!}
    
	

   
   </div>

   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <div class="row form-group" style="text-align: center;">
                 {!! Form::label('newfilename', 'New File Name:', ['class' => 'control-label']) !!}
                {!! Form::text('newfilename',  null , ['class' => 'form-control w3-container filename2' ,'autofocus'=>'autofocus'
                ]) !!}
    
	

   
   </div>
    </div>

   </div>







  
 	<input type="hidden" class="fileid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
