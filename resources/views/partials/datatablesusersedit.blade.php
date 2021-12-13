
{!! Form::open(array('method'=>'POST', 'action'=>['UserController@edit', $id])) !!}
    
                        
@include('partials.forms.edit.users', ['SubmitTextButton'=>'Edit' ,  'cid'=> $id  ])


{!! Form::close() !!}