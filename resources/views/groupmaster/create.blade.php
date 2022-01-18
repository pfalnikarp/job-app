@extends('layouts.maintemplate')


@section('content')



<div class="row">
  <div class="col-md-8">
      <h3 style="">Add Group</h3>
  </div>
  <div class="col-md-4">
      <a href="{{route('groups.index')}}" class="btn btn-primary btn-outline mt-3 rightdiv">Back</a>
  </div>
</div>

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container-fluid">


{!! Form::open(['route'=>'groups.store' , 'id' =>'payadd']) !!}



@endsection