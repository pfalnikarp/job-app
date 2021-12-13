       
           
        @foreach($timers as $timer)

           <div  class="row parent" >
               <input type="hidden" name="timer_id[]" class="timerid" value="{{ $timer->id }}">

            <div class="form-group col-md-3">
               <LABEL class="form-label"> File Name </LABEL>
                <input  name="newTimerName" type="text" class="form-control" id="usrname" placeholder="What are you working on?"  value="{{ $timer->name }}">
                                              

            </div>

                 <div class="form-group col-md-2">
                <label class="form-label"> Allocated by </label>
                <input type="text" name="allocated_by" class="form-control" placeholder="Alloted By" value="{{ $timer->allocated_by }}">
              </div>
                <div class="form-group col-md-2">
                   <label class="form-label"> Allocated to</label>
                   @php  $allocated_to  =  App\User::find($timer->user_id);  @endphp
                 <input type="text" name="status" class="form-control"  value="{{ $allocated_to->name }}" readonly="readonly">
                </div>

                 @if($timer->stopped_at != null  &&   $timer->started_at != null)
                    @php
                  $date1 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timer->started_at);
                  $date2 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timer->stopped_at);

                   
                  $diff2 = $date1->diff($date2)->format('%H:%I:%S');

                  $diff = $date1->diffInSeconds($date2);

                  $diff_in_hours = $diff/3600;
                  $diff_in_minutes = $diff/60;
                 
                  @endphp

                @elseif($timer->started_at != null)
                   @php
                  $date1 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timer->started_at);
                  $date2 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::now());

                    $diff_in_hours = $date1->diffInHours($date2);
                  $diff_in_minutes = $date1->diffInMinutes($date2);

                  $diff = $date1->diffInSeconds($date2);
                   $diff2 = $date1->diff($date2)->format('%H:%I:%S');

                  
                       @endphp
                @else
                             @php
                    $diff2 = '';
                    @endphp

                @endif
            
           
               

            <div class="col-md-2">
              <label class="form-label">Time Taken</label>
               @if($timer->stopped_at != null)
              
                 <input id="timer1" name = "timer1[]" class="timer1 btn form-control " readonly="readonly" 
                 value = "{{ $diff2 }}">
               @elseif($timer->started_at != null)
                 
                  <input id="timer1" name = "timer1[]" class="timer1 btn starttimer form-control " readonly="readonly"
                 value = "{{ $diff2 }}">
               @else
                
                 <input id="timer1" name = "timer1[]" class="timer1 btn form-control "  readonly="readonly"
                 value = "{{ $diff2 }}">
               @endif
            </div>


            @if( $timer->stopped_at == null &&  $timer->started_at == null)
             
              <div class="col-md-1">
             <!--  <label> Start</label>
                    <button type="button" id="start" class="start btn btn-info"><i class="fa fa-start" aria-hidden="true"></i></button> -->
             </div> 
          
             @elseif( $timer->started_at != null &&  $timer->stopped_at != null)
             <div class="col-md-1">
              
             </div>

             @else 
                <div class="col-md-1">
             <!--  <label> Start</label>
                    <button type="button" id="stop" class="start btn btn-info"><i class="fa fa-start" aria-hidden="true"></i></button> -->
             </div>
            
            @endif
           
           
      
            </div>
          @endforeach



     