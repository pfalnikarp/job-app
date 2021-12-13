
{!! Form::open(array('method'=>'POST',  'action'=>['EmailController@UpdateEmailStatus', $id])) !!}

@include('partials.forms.edit.emailstatus', ['id'=>$id , 'send' =>$send ])



{!! Form::close() !!}