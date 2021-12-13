
{!! Form::open(array('method'=>'POST',  'action'=>['OrdertablesController@edit', $id])) !!}
                         
@include('partials.forms.edit.orders', ['SubmitTextButton'=>'Edit' ,'id'=>$id])


{!! Form::close() !!}