<meta name="_token"  content="{!! csrf_token() !!}" />


	<input type="hidden" name="id" id="id" value="{{ $id }}" />

    
   @if ( $filecount  <=  1 )

    @switch($status)
    	@case("Completed")
      @case("Rev-Completed")
      @case('Ch-Completed')
       @role('Designer')
    	  <button  type="submit" class="btn btn-sm completedcolor btn-success mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>	
       @else
         <button id="editstatus" type="submit" class="editstatus btn btn-sm completedcolor btn-success mr-1 ml-1"><strong>{{ $status }}</strong></button>

       @endrole  

      @break

    	@case("QC Pending")
      @case('Rev-QC Pending')
      @case('Ch-QC Pending')
       @role('Designer')
         <button  class="blink_me btn btn-sm qcpendingcolor btn-warning mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
       @else
    	  <button id="editstatus" type="submit" class="editstatus blink_me btn btn-sm qcpendingcolor btn-warning mr-1 ml-1"><strong>{{ $status }}</strong></button>
       @endrole  
      @break

    	@case("QC OK")
      @case('Rev-QC OK')
      @case('Ch-QC OK')
        @role('Designer')
            	<button  class="blink_me qcokcolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
        @else
              <button id="editstatus" type="submit" class="editstatus blink_me qcokcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
        @endrole
      @break
               
    	@case("Quote")
          @role('Designer')
              <button class="quotecolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
          @else
               <button id="editstatus" type="submit" class="editstatus quotecolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
          @endrole
      @break
    	@case("Requote")
            <button id="editstatus" type="submit" class="editstatus requotecolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
            @break
    	@case("Approved")
           @role('Designer')
              <button class="approvedcolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
           @else
          	  <button id="editstatus" type="submit" class="editstatus approvedcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
           @endrole
            @break
    	@case("Alloted")
      @case("Rev-Alloted")
      @case("Ch-Alloted")
           <button id="editstatus" type="submit" class="editstatus allotedcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
           @break
    	@case("Followup")
            <button id="editstatus" type="submit" class="editstatus followupcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
            @break
    	@case("Revision")
          @role('Designer')
              <button class="revisioncolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
          @else
              <button id="editstatus" type="submit" class="editstatus revisioncolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
          @endrole
           @break
    	@case("On Hold")
         @role('Designer')
              <button class="onholdcolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
          @else
            <button id="editstatus" type="submit" class="editstatus onholdcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
          @endrole
         @break

    	@case("Cancel")
        @role('Designer')
              <button class="cancelcolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
        @else
    	       <button id="editstatus" type="submit" class="editstatus 	cancelcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
        @endrole  
      @break

    	@case("Complain")
        @role('Designer')
              <button class="complaincolor btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
        @else 
           <button id="editstatus" type="submit" class="editstatus 	complaincolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
        @endrole
      @break
    	@case("Followup")
           <button id="editstatus" type="submit" class="editstatus followupcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
           @break
    	@default
         @role('Designer')
              <button class="btn btn-sm btn-primary mr-1 ml-1" style="cursor:no-drop;" disabled><strong>{{ $status }}</strong></button>
         @else
            <button id="editstatus" type="submit" class="editstatus  	btn btn-sm 	btn-warning mr-1 ml-1"><strong>{{ $status }}</strong></button>
         @endrole

   @endswitch 	

   @else 

     @switch($status)
    	@case("Completed")
      @case("Rev-Completed")
      @case('Ch-Completed')
    	<button id="editstatus" type="submit" class=" btn btn-sm completedcolor btn-success mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>	
      @break
      
    	@case("QC Pending")
      @case('Rev-QC Pending')
      @case('Ch-QC Pending')
    	<button id="editstatus" type="submit" class=" blink_me btn btn-sm qcpendingcolor btn-warning mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
      @break

    	@case("QC OK")
         @case('Rev-QC OK')
      @case('Ch-QC OK')
            	<button id="editstatus" type="submit" class=" blink_me qcokcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
              @break
    	@case("Quote")
               <button id="editstatus" type="submit" class=" quotecolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
               @break
    	@case("Requote")
            <button id="editstatus" type="submit" class=" requotecolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
            @break
    	@case("Approved")
          	<button id="editstatus" type="submit" class=" approvedcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
            @break
    	@case("Alloted")
      @case("Rev-Alloted")
      @case("Ch-Alloted")
           <button id="editstatus" type="submit" class="allotedcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
           @break
    	@case("Followup")
            <button id="editstatus" type="submit" class=" followupcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
            @break
    	@case("Revision")
           <button id="editstatus" type="submit" class=" revisioncolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
           @break
    	@case("On Hold")
           <button id="editstatus" type="submit" class="editstatus onholdcolor btn btn-sm btn-primary mr-1 ml-1"><strong>{{ $status }}</strong></button>
           @break
    	@case("Cancel")
    	<button id="editstatus" type="submit" class=" 	cancelcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
      @break

    	@case("Complain")
    <button id="editstatus" type="submit" class=" 	complaincolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
      @break
    	@case("Followup")
           <button id="editstatus" type="submit" class=" followupcolor btn btn-sm btn-primary mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>
           @break
    	@default
            <button id="editstatus" type="submit" class="	btn btn-sm 	btn-warning mr-1 ml-1" disabled><strong>{{ $status }}</strong></button>

   @endswitch 	


   @endif

    	
	
<!-- <span class="glyphicon glyphicon-edit"> </span> <a href="#editmodalwindow"  data-toggle="modal"  role="button" class="edit btn btn-sm btn-white">{{ $SubmitTextButton }}</a> <span class="glyphicon glyphicon-edit"></span>
-->

