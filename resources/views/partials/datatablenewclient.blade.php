
{!! Form::open(array('method'=>'GET', 'action'=>['GmailController@newclient', $id])) !!}
                         
@include('partials.forms.edit.gmailclients', ['SubmitTextButton'=>'Edit' ,'id'=>$id])


{!! Form::close() !!}