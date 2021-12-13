<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="OrderDtlCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
    
      <div class="modal-header text-center">
             
        <h4 class="modal-title w-100 font-weight-bold" id="myModalLabel">New order Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      

      </div>
      <div class="modal-body ">
        @include('pages.orders.forms.order-dtl')
      </div>
      <div class="modal-footer">
         <a href="#" id="" class="btn btn-cyan submitbutton"><i class="fa fa-flash"></i>&nbsp;Create</a>
        
       <div class="success"> </div>

      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />