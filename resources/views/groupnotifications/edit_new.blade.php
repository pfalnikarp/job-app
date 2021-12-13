
@extends('layouts.maintemplate')
@section('third_party_stylesheets')

<style type="text/css">
</style>

@endsection

@section('content')


<div class="container">
                  <div class="row"><h2>Update Group Notification</h2></div>
                    <hr>
  <div class="row">
    <div class="col-8">

      	<form action="{{route('groupnotification.update' ,['id'=> $groupid ])}}" method="POST"  >
		    @csrf
        @method('PUT')
			<input type="hidden" name="id" value="{{ $groupid }}">

        <div class="form-row">
          <div class="col form-group">
          	 <label for="groupname">Group Name</label>
            <input type="text"  name="groupname" class="form-control" placeholder="Group name" value="{{ $groupname }}">
          </div>
          <div class="col form-group">
          	<label for="ucount">Total Users</label><br>
          	<input type="hidden" name="unames" class="unames" value="{{ $usernames }}">
              <a href="#" data-toggle="tooltip" title="Click to display Users"  class="button ucount">{{ $ucount }}</a>
           
            
          </div>
          <div class="col">
          	  <button type="submit" class="btn btn-info">Submit</button>
          </div>
           
        </div>
       <!--  <div class="form-row">   THIS IS SAMPLE BOOTSTRAP-4  CODE
          <div class="col-sm-12 col-md-4 form-group">
            <input type="text" class="form-control" placeholder="City">
          </div>            
           <div class="col-sm-12 col-md-4 form-group">
            <input type="text" class="form-control" placeholder="Zipcode">
          </div>  
          <div class="col-sm-12 col-md-4 form-group">
            <input type="text" class="form-control" placeholder="Country">
          </div>
        </div> -->
            </div>
  </div>
     
  <div class="row">        
            <h4> Notification</h4>
             
        <table  style="width:100%;" id="notificatonrecords" class="table table-bordered table-responsive">
  
   <tbody>
   	 @php $n=1; @endphp
     <tr><td><b>Basic Status</b></td></tr>
   	 <tr>
   	@foreach($snotification as  $snote)
        @php  $n++;  @endphp
   	<td>
                   
                     
               @if( in_array($snote->value, $groupnotification) )
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ $snote->text }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ $snote->text }}</td>
              @endif
                   
      
         @if($n>3) 
            @php $n=1; @endphp
     </tr><tr>@endif

   	@endforeach
   </tr>
       @php $n=1; @endphp
    <tr><td><b>Revision Status </b></td></tr>
     <tr>
    @foreach($revnotification as  $snote)
        @php  $n++;  @endphp
    <td>
                   
                     
               @if( in_array($snote->value, $groupnotification) )
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ $snote->text }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ $snote->text }}</td>
              @endif
                   
      
         @if($n>3) 
            @php $n=1; @endphp
     </tr><tr>@endif

    @endforeach
   </tr>
          @php $n=1; @endphp
   <tr><td><b>Change Status</b></td></tr>
     <tr>
    @foreach($chnotification as  $snote)
        @php  $n++;  @endphp
    <td>
                   
                     
               @if( in_array($snote->value, $groupnotification) )
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ $snote->text }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ $snote->text }}</td>
              @endif
                   
      
         @if($n>3) 
            @php $n=1; @endphp
     </tr><tr>@endif

    @endforeach
   </tr>

   </tbody>
                          
</table>      
</div>  
       
      </form>

</div>


@endsection

@section('script')
	

<script type="text/javascript">
  $(document).ready(function () {        
        var job = $('.unames').val();

 $( ".ucount" ).click(function(e) {
 	 
         Swal.fire(job);
});
       

});


</script>                      

@endsection