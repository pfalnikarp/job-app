<meta name="_token"  content="{!! csrf_token() !!}" />


	 <div class="modal fade cmodal-window" id="statusModal"  tabindex="-1"  role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Status</h4>
        </div>
        <div class="modal-body">
            <p> 
            	<input type="hidden" class="statusid" name="statusid" value=0>
          		<div  class="form-group">
               
              			{!! Form::select('status', $OrderStatus , $status  , ['class' => 'form-control ostatus'  ]) !!}
    			</div>	
            </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm submit_status">Submit</button> 	
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>


	<!-- <div id="statusdialog"  style="display:none; ">
   
  		<div  class="form-group">
               
              {!! Form::select('status', $OrderStatus , $status  , ['class' => 'form-control ostatus'  ]) !!}
    	</div>	

	    	
 	</div> -->
 		
	
    
	@if ( $status == "Completed" )
   		<button id="editstatus" type="submit" class="editstatus btn btn-xs completedcolor btn-success "><strong>{{ $status }}</strong></button>
	@else
	    @if ( $status == "QC Pending")
 			<button id="editstatus" type="submit" class="editstatus blink_me btn btn-xs qcpendingcolor btn-warning"><strong>{{ $status }}</strong></button>
 		@else
 		    @if ( $status == "QC OK")
 					<button id="editstatus" type="submit" class="editstatus blink_me qcokcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 			@else

 			    @if ( $status == "Quote")
 					<button id="editstatus" type="submit" class="editstatus quotecolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 				@else
 					
 					@if ( $status == "Requote")
 							<button id="editstatus" type="submit" class="editstatus requotecolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 					@else
 						@if ( $status == "No Response")
 							<button id="editstatus" type="submit" class="editstatus noresponsecolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						@else
 							@if ( $status == "Approved")
 									<button id="editstatus" type="submit" class="editstatus approvedcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 							@else		
 						  		@if ( $status == "Alloted")
 									<button id="editstatus" type="submit" class="editstatus allotedcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   		@else
 									@if ( $status == "Followup")
 										<button id="editstatus" type="submit" class="editstatus followupcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   			@else
 										@if ( $status == "Revision")
 											<button id="editstatus" type="submit" class="editstatus revisioncolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   				@else
 											
 											@if ( $status == "On Hold")
 												<button id="editstatus" type="submit" class="editstatus 	onholdcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   					@else
 												@if ( $status == "Cancel")
 													<button id="editstatus" type="submit" class="editstatus 	cancelcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   						@else
 													@if ( $status == "UnApproved")
 														<button id="editstatus" type="submit" class="editstatus 	unapprovedcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   							@else
 														@if ( $status == "Complain")
 															<button id="editstatus" type="submit" class="editstatus 	complaincolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   								@else
 															@if ( $status == "Followup")
 															<button id="editstatus" type="submit" class="editstatus 	followupcolor btn btn-xs btn-primary"><strong>{{ $status }}</strong></button>
 						   								@else
 															<button id="editstatus" type="submit" class="editstatus  	btn btn-xs 	btn-warning"><strong>{{ $status }}</strong></button>

	 							       					@endif


	 							       					@endif

	 							       				@endif

	 							       			@endif

	 							       		@endif

	 							       @endif

	 							    @endif

	 							@endif

	 						@endif

	 					@endif

	 				@endif

 				@endif
 				

 			@endif


 		@endif

	@endif   
<div><input class="updstatus1" type="hidden" name="id" id="id" value="{{ $id }}" /></div>
