@extends('layouts.maintemplate')

<style type="text/css">
	
	body {

		font-family: arial;
		font-size: 12px;
	}

label, select {
    display: inline-block;
    vertical-align: top;
}


</style>



@section('content')

<form action="{{route('mail.store')}}" method="post" onsubmit="return checkForm(this);">
	 @csrf
<div class="">
    <div class="row">
        <div class="col-md-8">
          <h5>Send Mail</h5> 
        </div>
 <div class="row">
 	@if(Session::has('message'))
    <div class="alert alert-warning  ">
        {{ Session::get('flash_message1') }}
    </div>
@endif
      
 	
 </div>       
  <div class="col-md-4" style="text-align: right;">
                    
            
            <a class="btn btn-info btn-outline rightdiv" href="javascript:history.go(-1)" title="Return to the previous page">Back</a>
            <input type="submit" name="myButton" class="btn btn-success btn-outline rightdiv mr-2" value="Send">
          

        </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card mt-1">
	<div class="card-body">
<div class="row">
	<input type="hidden" name="company_id"  value="{{   $company_id }}">
	<input type="hidden" name="year"   value="{{ $year  }}">

	<input type="hidden" name="month"   value="{{ $month  }}">

	<div class="col-md-5 pr-1">
	<label><b>Company Name </b></label>
	   <input type="text" name="company_name" class="form-control" value="{{  $company_name  }}" required="" id="companynameid">
    </div>

    <div class="col-md-2">
    	
    </div>
    <div class="col-md-5 px-1">
	   <label><b>To email</b></label>
		
	
		    <select name="toemail[]" multiple id="toemail">
		    	@foreach($emaillist as $list)

                      <option value="{{ $list->client_email_primary}}">
                      	            {{ $list->client_email_primary}}
                      </option>
		    	@endforeach
		    	
		    </select>

		  
		 
    </div>
   


</div>		

 <div class="row col-md-12  pr-1">
           <label><b>Attachment   </b></label>
              
    </div>
    <div  class="row col-md-12  pr-1">
    	       @foreach($fileurl as $key)
                  {{ $key->file_url }}
			<a href="{{ $key->file_url }}" download> </a>
			<input type="hidden" name="fileurl" value="{{ $key->file_url }}">
			@endforeach
    </div>


<div class="row mt-2">
	<div class="col-md-5 pr-1">
		 <div class="form-group">
		 	<label><b>User Name</b></label>
		
		 	    <input type="text" name="emailusername" class="form-control" value="{{ Auth::user()->name}}" required=""  id="BDEid" >
		 
		</div>	
	</div>
	<div class="col-md-2">
		
	</div>
	<div class="col-md-5 px-1">														
		<div class="form-group">
		   <label><b>From</b></label>
		
		     <input type="email" name="from" class="form-control" value="hello@patterns247.com" required="" readonly="">
		
	    </div>
	</div>

</div>
	<!--<div class="row">
		<div class="col-md-12">
			<div class="form-group">
		 		 <label><b>Subject</b></label>
		 		 <input type="text" name="subject" class="form-control" required="">
			</div>
	    </div>
			
	</div>
 <div class="row">
	<div class="col-md-12">
		
		<div class="form-group">
	   
		  <label><h5><b>Body</b></h5></label>
	
		  <textarea name="body" class="form-control form-control2" id="mailtextbox"  required=""></textarea>
		 
		</div>

	</div>	
</div> -->
<div class="row">
	<div class="col-md-2">
	   
    </div>
</div>
 </div>
</div>
</div>
</form>
@endsection