
<?php
	$dt = new DateTime();
	$local1 = new DateTime();

	$dt->setTimezone(new DateTimeZone('America/New_York'));
	$dt1= $dt->format('Y-m-d H:i:s');

	$local1->setTimezone(new DateTimeZone('Asia/Kolkata'));
	$local= $local1->format('Y-m-d H:i:s');


	$valid_dt = date('Y-m-d H:i:s', strtotime($dt1));
	$local_dt = date('Y-m-d H:i:s', strtotime($local));

?> 
  
	
<div id="orderdatedialog" style="display:none;">

  
  <!--  {!! Form::label('order_date', 'Order Date(India)', ['class' => 'control-label']) !!} -->
   
   <!-- {!! Form::text('order_date', $local_dt, ['class' => 'form-control','id'=>'order_date']) !!} -->

   <input type="text" id= "order_date" name="order_date" value="">

    <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

	<!-- 	<input type="hidden" name="client_old_note_rowID" id="client_old_note_rowID" />
		<input type="text" name="porowID" id="porowID" />
 -->
 	
 	<input type="hidden" class="orderdateid" name="id" id="id" value=0 />
 		
<div class="success"> </div>

<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
