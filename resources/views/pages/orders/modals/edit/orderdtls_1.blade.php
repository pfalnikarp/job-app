
<div class="modal fade" id="editmodalwindow1" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
 
 
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit order Details</h4>
      </div>
      <div id= "modal-update1" class="modal-body">
       
        @include('pages.orderdtls.forms.editorderdtls')
      </div>
      <div class="modal-footer">
       
      <div class="success"> </div>

 
      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />