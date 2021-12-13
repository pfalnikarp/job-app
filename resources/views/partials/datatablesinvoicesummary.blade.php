{!! Form::open(array('method'=>'POST',  'action'=>['InvoiceSummaryController@editdtl', $id])) !!}

<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />



{!! Form::submit( "$id",["class" => "btn btn-sm btn-primary editsummary "]) !!}




{!! Form::close() !!}
