
{!! Form::open(array('method'=>'PUT', 'action'=>['UserController@show', $id])) !!}
 
   
                        
@include('partials.forms.show.users', ['SubmitTextButton'=>'Show' ,  'cid'=> $id  ])


{!! Form::close() !!}