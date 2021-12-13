@extends('layouts.maintemplate')
@section('style')
<style type="text/css">
	
.ts{
 text-shadow: 1px 2px 10px black;

}
.form-check .form-check-label {
    display: inline-block;
    position: relative;
    cursor: pointer;
    padding-left: 35px;
    line-height: 20px;
    margin-bottom: inherit;
    text-transform: capitalize;
}
</style>
@endsection

@section('content')
    
@include('roles.addrole.content')

@endsection

@section('script')  

@include('roles.addrole.script')

@endsection