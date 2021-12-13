
{!! Form::open(array('method'=>'Get', 'action'=>['EmailController@edit', $id])) !!}
    

<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

{!! Form::submit( "Edit",["class" => "btn btn-sm btn-primary "]) !!}


{!! Form::close() !!}