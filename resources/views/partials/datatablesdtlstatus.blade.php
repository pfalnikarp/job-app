
{!! Form::open(array('method'=>'POST',  'action'=>['OrderDtlsController@updateorderstatus', $id])) !!}
                         
@include('partials.forms.edit.status', ['SubmitTextButton'=>'Edit' ,'id'=>$id])


{!! Form::close() !!}