
{!! Form::open(array('method'=>'POST', 'action'=>['GmailController@edit', $id])) !!}
                         
@include('partials.forms.edit.gmails', ['SubmitTextButton'=>'Edit' ,'id'=>$id])


{!! Form::close() !!}