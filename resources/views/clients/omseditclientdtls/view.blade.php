@extends('layouts.maintemplate')
@section('third_party_stylesheets')
<style type="text/css">
 .form-control {
		    border: 1px solid #8294B8;
  }
  .from-control-3 {
    border: none;
    border-bottom: 1px solid ;  
  }
  input[type=time] {
     font-size: 12px;
}
  span.spantext{
    font-size: 12px;
    font-weight: 775;

}
  .form-check .form-check-sign::before, .form-check .form-check-sign::after{
    font-size: 23px;
    margin-left: -23px;
  }
.form-control:focus {
  box-shadow: 0 0 10px rgba(232, 126, 4, 1);
 /* padding: 3px 0px 3px 3px;*/
 /* margin: 5px 1px 3px 0px;*/
  border: 1px solid rgba(232, 126, 4, 1);
}


  label.labcolor{
  	color: #4F5155;
  }

  .first,.last,.designation {
     text-transform: capitalize;
  }
  .description {
     text-transform: capitalize;
  }
 
   .active{
    color:#1B1B1B !important;
   }
   .btn3 {
        background-color: gray;
        color: black;
        height: 40px; 
        padding: 6px 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 0px 0px;
        cursor: pointer;
        border-radius: 1px;
        border: 1px solid #495057;
   }
   .toggle-group label, .toggle-group span {
    cursor: pointer;
    color: white;
    font-size: 10px;
    padding-top: 8px;
    font-weight: bold;
    /*height: 40px;*/
}
</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
    
@include('clients.omseditclientdtls.content')

@endsection

@section('script')  

@include('clients.omseditclientdtls.script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endsection