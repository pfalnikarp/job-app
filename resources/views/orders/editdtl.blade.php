<div class="modal fade" id="editdtlmodalwindow"  role="dialog" >
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
              </ul>
            </div>
        @endif

{{-- {!! Form::model($Order, ['method' => 'PATCH','route'=>['orders.update','id' => $Order->id]]) !!} --}}
<form id="updatedtl" method="POST" action="orders/updatedtl" accept-charset="UTF-8">

<input name="_method" type="hidden" value="PATCH">
{{ csrf_field() }}

      <div class="modal-header text-center">
	    <h4 class="modal-title" id="myModalLabel">Edit order</h4>
  
        <button type="button" class="btn-sm btn-danger btn-outline" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
        <h5 class="ml-4">Please click on checkbox to select and then after press on Submit Button</h5>
      <div id= "modal-update" class="modal-body" style="  height: 40vh;
    overflow-y: auto;">
       
          <div class="row">
          <div class="panel table-responsive">
            <table id="dtltable" class="table table-hover table-active table-condensed c fixed_header" >
            <thead class="thead-light">
              <tr>
               <th style="width:15px;">
                    <input type="checkbox" id="selectAll" />
               </th>
               <th style="width:70px;"> Priority</th>
               <th> File-Name</th>
               <th style="width: 140px;"> FileNote</th>
               <th> Allocation</th>
               <th style="width: 150px;"> Target Time</th>
               <th style="width: 140px;"> Status</th>
               </tr>
            </thead>
    
            <tbody class="dtlbody" >

            </tbody>
  
            </table>
          </div>
          </div>


 

      </div>
        <div class="modal-footer">

           <div class="card-body table-responsive">
            <table id="dtltable-footer" class="table">
            <tbody >

             

               @if (Auth::user()->hasRole('Designer') && Auth::user()->level()< 12)
               
          @else
            <tr class="table-light" style=" border-bottom:2pt solid white;border-top:2pt solid white;">
                
                <td id="allocationpopupmodalid">
                  </td>     
                   
                 
                     
                    <td colspan="2"></td>                

                <td >
                      
                    <div class="form-group" style="text-align: left;">
                           <input type="checkbox" class="statusshow" name="statusshow" value="no">
                          <label for="statusshow">Status Change </label>

                    </div>
                   

                </td>
                 
            </tr>

            <tr style=" border-bottom:2pt solid white;border-top:2pt solid white;">
               <td colspan="2">
              
                <div class="form-group finalalloc">
                    
                        
                </div>
                </td>  
                  <td></td>
               <td colspan="2">
                  <div class="form-group feditdtlstatus">
                    <!--   <label for="fstatus" class="control-label">Status</label> -->
                        {!! Form::select('fstatus',[],   null , [
                        'class' => 'required form-control feditstatus' , 'readonly'=>'readonly' ] ) !!} 

                  </div> 
                </td> 
              
                <td>
                  <div class="form-group" align="center">
                    {!! Form::submit('Submit',['class' => 'btn btn  btn-primary submitdtl']) !!}
                  </div> 
                </td>
              
            </tr>


         
          @endif

            </tbody>
  
            </table>
          </div>
         
         
          
        </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
