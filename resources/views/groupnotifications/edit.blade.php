
@extends('layouts.maintemplate')
@section('third_party_stylesheets')

<style type="text/css">
</style>

@endsection

@section('content')


<div class="container">
                  <div class="row"><h2>Update Group Notification</h2></div>
                    <hr>
 


<form action="{{route('groupnotification.update' ,['id'=> $groupid ])}}" method="POST" >
		    @csrf
        @method('PUT')
        <div class="row">
             <div class="col">
                 <a href="/groupnotification"> Back </a>
             </div>
              
              <div class="col">
                <button type="submit" class="btn btn-info">Submit</button>
              </div>
        </div>
          

     <div class="row">
    <div class="col-8">		
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
        
           
        </div>
      
    </div>
  </div>
        <h4> Notification</h4>
  <div class="row">        
           
             
        <table  style="width:100%;" id="notificatonrecords" class="table table-bordered table-responsive">
          <thead><tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr></thead>
  
   <tbody>
   	 @php $n=1; @endphp
     <tr><td><b>Basic Status</b></td></tr>
   	 <tr>
   	@foreach($snotification as  $snote)
        @php  $n++;  @endphp
   	<td>
                   
                     
               @if( in_array($snote->value, $groupnotification) )
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ str_replace('Notify', '', $snote->text)}}</td>
              @endif
                   
      
         @if($n>4) 
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
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @endif
                   
      
         @if($n>4) 
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
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @endif
                   
      
         @if($n>4) 
            @php $n=1; @endphp
     </tr><tr>@endif

    @endforeach
   </tr>
    
         @php $n=1; @endphp
   <tr><td><b>Misc Changes</b></td></tr>
     <tr>
    @foreach($miscnotification as  $snote)
        @php  $n++;  @endphp
    <td>
                   
                     
               @if( in_array($snote->value, $groupnotification) )
      <input type="checkbox" name="sel[]" value="{{ $snote->value }}" checked="checked"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @else
                    <input type="checkbox" name="sel[]" value="{{ $snote->value }}"> {{ str_replace('Notify', '', $snote->text) }}</td>
              @endif
                   
      
         @if($n>4) 
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