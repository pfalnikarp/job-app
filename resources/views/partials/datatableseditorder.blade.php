{{ Form::open(array('method'=>'POST',  'action'=>['OrderController@editdtl', $id])) }}

<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

<input type="hidden" name="fstatus1" class="fstatus1" value="{{ $status }}" />
<div class="row ml-2 mt-3"> 
{{ Form::submit( "$orderid",["class" => "btn btn-sm btn-link editdtl"]) }}
</div>
<div class="row ml-4"> 
	<div class="col-md-4">

		<sup class="super text-danger">FC : {{ $file_count }}</sup>

    </div>
	<div class="col-md-4"> 
			<sup class="super text-danger">RV : {{ $tot_revision }}</sup>

	</div>
</div>	

{{ Form::close() }}	
