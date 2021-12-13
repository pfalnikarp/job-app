<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="myModalRow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <!--  @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif -->
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Client</h4>
      </div>

  {!! Form::open(['route'=>'clients.store', 'class' =>'form-horizontal']) !!}
      
      <div class="modal-body">
        @include('pages.clients.forms.client')
      </div>
      <div class="modal-footer">
         <a href="#" id="" class="btn btn-cyan submitbutton"><i class="fa fa-flash"></i>&nbsp;{{ $SubmitTextButton }}</a>
       <div class="success"> </div>

  {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />