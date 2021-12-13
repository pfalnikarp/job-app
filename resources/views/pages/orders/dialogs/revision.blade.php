
<div id="revisiondialog"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <table class="table  table-condensed ">
      <tbody>
        <tr>
          <td>
             <div class="form-group mr-3">
             {!! Form::label('target_completion_time2', 'Target Date:', ['class' => 'control-label']) !!}
            {!! Form::text('target_completion_time2', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
            </div>
          </td>
          <td>
             <div class="form-group mr-3">

        {!! Form::label('rev_mistake', 'Mistake Made by:', ['class' => 'control-label']) !!}
        {!! Form::select('rev_mistake', ['0'=>'Select' , 'Designer'=>'Designing Team', 'Customer Support' => 'Customer Support', 'Client' => 'Client'] , 'Select',
         ['class' => 'form-control getdesign']) !!}
   
             
            </div>
            
          </td>
          <td rowspan="2" colspan="2">
            <div class="form-group">
                  {!! Form::label('rev_mistake_reason', 'Details:', ['class' => 'control-label']) !!}
                {!! Form::textarea('rev_mistake_reason', null, ['class' => 'form-control', 'rows'=> 7 ]) !!}
              </div>  
          </td>

          
        </tr>
        <tr>
          <td>
             <div class="form-group mr-3">
            {!! Form::label('mistake_designer_name', 'Designer:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_designer_name', null, ['class' => ' form-control ', 'readonly'=>'readonly' ]) !!}
        </div>
            
          </td>
          <td>
              <div class="form-group mr-3">
            {!! Form::label('mistake_lead_name', 'QC DONE BY:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_lead_name', null, ['class' => ' form-control ', 'readonly'=>'readonly' ]) !!}
        </div>
            
          </td>
          <td></td>
          <td></td>

        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
                
          <td colspan="2">
            <div class="form-group mr-3">
                {!! Form::label('oldnotes', 'Present File Notes:', ['class' => 'control-label']) !!}
                {!! Form::textarea('oldnotes', null, ['tabindex'=>"1",'class' => ' form-control oldnotes ', 'rows'=>3 , 'readonly'=>'readonly' ]) !!}
            </div>

          </td>
 
          <td colspan="2">
              <div class="form-group" >
                {!! Form::label('revision_note', 'New Notes:', ['class' => 'control-label']) !!}
                  {!! Form::textarea('rev_note', null, ['class' => ' form-control rev_note ', 'rows'=>3 ,'required'=>'required' ]) !!}
              </div>
          
          </td>
   
        </tr>
       
      </tbody>
     

   </table>

   <!-- <div class="row">
    
       
        <div class="form-group col-md-4 targettime2">
            {!! Form::label('target_completion_time2', 'Target Date:', ['class' => 'control-label']) !!}
            {!! Form::text('target_completion_time2', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
          
        </div>
       

          <div class="form-group col-md-3">
            {!! Form::label('rev_mistake', 'Mistake Made by:', ['class' => 'control-label']) !!}
          
            {!! Form::select('rev_mistake', ['Designer'=>'Designing Team', 'Customer Support' => 'Customer Support', 'Client' => 'Client'  ], ['class' => ' form-control', 'required'=>'required' ]) !!}

          
          </div>
          <div class="col-md-1">
            
          </div>

        <div class="form-group col-md-4" >
                {!! Form::label('rev_mistake_reason', 'Details:', ['class' => 'control-label']) !!}
                {!! Form::textarea('rev_mistake_reason', null, ['class' => 'form-control', 'rows'=> 8 ]) !!}
         </div>

           <div class="form-group col-md-4">
            {!! Form::label('mistake_designer_name', 'Designer:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_designer_name', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
        </div>

          <div class="form-group col-md-3">
            {!! Form::label('mistake_lead_name', 'QC DONE BY:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_lead_name', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
        </div>
 

 </div>
 -->
     
              
          
 
 <!--  <div class="row">
          
           <div class="form-group col-md-4">
            {!! Form::label('mistake_designer_name', 'Designer:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_designer_name', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
        </div>

          <div class="form-group col-md-3">
            {!! Form::label('mistake_lead_name', 'QC DONE BY:', ['class' => 'control-label']) !!}
            {!! Form::text('mistake_lead_name', null, ['class' => ' form-control new_target_date2', 'required'=>'required' ]) !!}
        </div>

    
  </div> -->
     
    <!--  <div class="form-group  targettime2"   >
            <label for="target_completion_time2" class="control-label  w3-text-blue">Target  Time</label><input type="text" id="target_completion_time2" name="target_completion_time2"  class=" form-control w3-input w3-border"               value=""  required="required"> 
        
    </div>   -->

   
    

   
   
 
 	
 	<input type="hidden" class="statusid" name="id" id="id" value=0 />
 		


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />

	

 <!-- 	{!! Form::close() !!} -->

</div>
