
<div id="filereason"  style="display:none; ">
    
  
   <!--  {!! Form::open(['route'=>'orders.updatenotes']) !!} -->

   <div class="row">
    
       

        <div class="col-md-4">
           {!! Form::label('rev_mistake', 'Mistake Made by:', ['class' => 'control-label']) !!}
            {!! Form::select('rev_mistake', ['0'=>'Select' ,'Designer'=>'Designing Team', 'Customer Sales' => 'Customer Sales'   ], [ 'id' =>'rev_mistake', 'class' => ' form-control',  'required'=>'required' ]) !!}
          
        </div>

        <div class="col-md-4">
              {!! Form::label('rev_mistake_reason', 'Details:', ['class' => 'control-label']) !!}
              {!! Form::textarea('rev_mistake_reason', null, [ 'id' =>'rev_mistake_reason', 'class' => 'form-control revmistake_reason_index ', 'rows'=> 7 ]) !!}
          
        </div>
    
  </div>  
     
      <input type="hidden" class="statusid" name="id" id="id" value=0 />


<meta name="_token" id="token" class="token" content="{!! csrf_token() !!}" />
    
   </div>
 	
 

