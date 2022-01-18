@extends('layouts.maintemplate')
@section('style')
<style type="text/css">
	.modal-lg {
    max-width: 80%;
}
.modal {
    position: fixed;
    top: 10;
}
.bd-example-modal-lg .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(50% - 24px);
  }
  
  .bd-example-modal-lg .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
  }
	.my-custom-scrollbar1 {
	position: relative;
	height: 450px;
	overflow: auto;
	}

.card{
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,0.7), 0 0 6px rgba(0,0,0,0.7);
      transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
 
  cursor: pointer;
}
.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

</style>
@endsection
@section('content')
    
@include('dashboard.showmonthlydashboard.content')

@endsection

@section('script')  

@include('dashboard.showmonthlydashboard.script')

@endsection