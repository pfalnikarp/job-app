{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

        	{!! Form::close() !!}