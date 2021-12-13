@extends('layouts.maintemplate')
@section('third_party_stylesheets')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}

  .form-check .form-check-sign1::after{
    color:#FE5961;
  }
  .form-check .form-check-sign1::before{
    color:#FE5961;
  }
.form-check-input {
     position: sticky !important; 
     margin-top: 0.3rem; 
     margin-left: -1.25rem; 
}

.direct_perm {
background-color: red;  
color: #ffffff;}

.direct_perm,  .greenBackground{
background-color: red;  
color: #ffffff;}




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
    
@include('users.edituserrole.content')

@endsection

@section('script')  

@include('users.edituserrole.script')

@endsection