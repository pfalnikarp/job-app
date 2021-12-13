
{!! Form::open(array('method'=>'POST', 'action'=>['ClientController@edit', $id])) !!}
    
                        
@include('partials.forms.edit.clients', ['SubmitTextButton'=>'Edit' ,  'cid'=> $id  ])


{!! Form::close() !!}