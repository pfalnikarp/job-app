{!! Form::open(array('method'=>'get',  'action'=>['InvoiceSummaryController@SummarygetIndex', 'yr_month'=>$yr_month])) !!}



<button>{{ $yr_month  }}</button>


{!! Form::close() !!}

