<meta name="_token"  content="{!! csrf_token() !!}" />


	<input type="hidden" name="id" id="id" value="{{ $id }}" />


	@if ( $send == "Y" )
   		<button id='sendstatus' type='submit' 
                      class='sendstatus followupcolor  btn btn-xs' value="Already Sent">Already Sent</button>
	@else
	   <button id='sendstatus' type='submit' 
                      class='sendstatus complaincolor  btn btn-xs ' value="Send Email">Send Email</button>

	@endif   

