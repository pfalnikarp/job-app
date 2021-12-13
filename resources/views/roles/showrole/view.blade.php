@extends('layouts.maintemplate')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}

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
    
@include('roles.showrole.content')

@endsection

@section('script')  

@include('roles.showrole.script')

@endsection