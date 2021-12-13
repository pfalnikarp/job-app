<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editmodalwindow1" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
 
 
 {!! Form::model($order, ['method' => 'PATCH', 'id'=>'orderedit1','route'=>['orders.updatedtls', $order->id ]]) !!}

     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit order Details</h4>
      </div>
      <div id= "modal-update1" class="modal-body">
       
        @include('pages.orderdtls.forms.editorderdtls')
      </div>
      <div class="modal-footer">
        <!-- REMOVED ON  10/08/17 for just view order -->
        {{--  <a href="#" id="" class="btn btn-cyan submitbutton"><i class="fa fa-flash"></i>&nbsp;{{ $SubmitTextButton }}</a> --}}
        <!-- REMOVED ON  10/08/17 for just view order -->
      <div class="success"> </div>

   {!! Form::close() !!} 
      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />