@extends('layouts.maintemplate')


@section('content')


    <div class="col-12 mb-2 text-end">
    	     <a href="/groups/create" class="btn btn-primary">Create</a>

    </div>

     <div class="card">
                <div class="card-header">
                    <h4>Group List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
    <table id="groupindex" class="table table-bordered ">
    	<thead>
    		<th>Id</th>
    		<th>Group Name</th>
    		<th>Total Users</th>
    		<th>Users</th>
    		<th>Actions</th>
    	</thead>
    	<tbody>
    		  @foreach( $groupmaster as $gm)
    		     <tr>
    		  <td>{{ $gm->groupid }}</td>
    		  <td>{{ $gm->groupname }}</td>
    		  <td>{{ $gm->totuser }}</td>
    		  <td>{{ $gm->names }}</td>
    		  <td>
    		  	 <a class="btn btn-info btn-sm" href="{{ route('groups.show',$gm->groupid) }}"><i class="glyphicon glyphicon-th-large"></i>Show</a>

        <a class="btn btn-primary btn-sm" href="{{ route('groups.edit',$gm->groupid) }}"><i class="glyphicon glyphicon-pencil"></i>Edit</a>

        {!! Form::open(['method' => 'DELETE','route' => ['groups.destroy', $gm->groupid],'style'=>'display:inline']) !!}

        <button type="submit" style="display: inline;" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i>Delete</button>

        {!! Form::close() !!}
    		  </td>
    		  </tr>
    		  @endforeach
    	</tbody>
    </table>
    			</div>
    			</div>
    			    			</div>



@endsection