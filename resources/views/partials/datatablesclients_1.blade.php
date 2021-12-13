
{!! Form::open(array('method'=>'POST', 'action'=>['Client_1Controller@edit', $id])) !!}
    
                        
@include('partials.forms.edit.clients_1', ['SubmitTextButton'=>'Edit' ,  'cid'=> $id  ])


{!! Form::close() !!}