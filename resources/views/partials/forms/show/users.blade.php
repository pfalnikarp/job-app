<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="cid" id="cid" value="{{ $cid }}" />

<a href="{{ route('users.show', $id ) }}"  class="btn btn-sm btn-info">Show</a>

