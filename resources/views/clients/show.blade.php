@extends('layouts.newdashbord')


@section('style')

th {
   font-weight:  bold;
}

@endsection

@section('content')
<!-- @parent -->
 <script src="//code.jquery.com/jquery.js"></script>


<h1>Payment Details for {{ $company_name }} </h1>
<!-- <p class="lead">Add to your task list below.</p>
<hr> -->
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-2 col-md-offset-4">
        <a href="{{route('clients.index')}}" class="btn btn-primary btn-outline mt-3 rightdiv">Back</a> 
    </div>
<!-- {!! Form::open(['route'=>'clients.store', 'class'=>'form-horizontal']) !!} -->
</div>

<hr>


            
      <!--       <div class="row col-md-offset-4"><input type="button" class="btn btn-primary add" value="+"><b> Add   Details </b></div>
     
 -->
 <!-- <a class="add" href="#" > Add Rows</a> -->
<!-- <input id="addrow" type="button" class="btn btn-primary add" value="+">Add Rows -->

<!-- <div class="row">
 <a href="#myModalRow" style="float: left" data-toggle="modal" class="btn btn-success">Add Details</a>

 </div> -->


	
<div class="table-responsive">  
<table id= "showcompany"   class="table table-bordered table-hover">
        <thead>

            <tr>
	           
    	        <th>No</th>
        	    <th>Year Month </th>     
              <th>Invoice No</th> 
             	<th>Invoice Amount</th>
            	<th>Paid Amount</th>
             	<th>Remain Amount</th>
              <th>Total Amount</th>
            
            </tr>


        </thead>
        <tbody>
          
     @php $i=0;  @endphp
  @foreach ($inv_summary as $key )

  <tr>

      <td>{{ ++$i }}</td>
      <td>{{ $key->yr_month }}</td>
       <td>{{ $key->inv_no }}</td>
      <td>{{ $key->invamt }}</td>
      <td>{{ $key->amtrec }}</td>
      <td>{{ $key->invamt - $key->amtrec }}</td>
      <td>{{ $key->invamt }}</td>
      <td></td>
   
  @endforeach

        </tbody>
        
    </table>           
</div>

@endsection
