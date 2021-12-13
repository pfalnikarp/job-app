
<div id="statusdialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->
    
             <div  class="form-group">    
                {!! Form::select('status', $status, null , ['class' => 'form-control w3-container ostatus', 'tabindex' =>'1'  ]) !!}
             </div>   
    

	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
    -->

   

    
 	<div class="form-group">
        <input type="hidden" class="ftype1"   name="filetype" value="" />
 	    <input type="hidden" class="statusid" name="id" id="id" value=0 />
        <input type="hidden" name="oldprice" id="oldprice" class="oldprice" value=0 />
        <input type="hidden" name="coldnotes" class="coldnotes" value="">
        <input type="hidden" name="oldstatus" id="oldstatus" class="oldstatus" value="">
        <input type="hidden" name="client_specific"  class="client_specific" value="">
    </div>
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
