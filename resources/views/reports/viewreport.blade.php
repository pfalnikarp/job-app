@extends('layouts.appnew')

<style type="text/css" >
/*	#hlp {
    background-color: #eee;
    width:  1000px !important;
    max-height: 750px   !important;
    border: 1px dotted black;
    overflow-y:scroll;
    
    }*/

    /*#hlp:hover {
        overflow: visible; 
	    
    }*/

</style>
@section('content')



<div  class="container">
  {{--   <div id="hlp"> --}}
    	  {!! $external !!}
  {{--   </div>
     --}}

</div>


@endsection
