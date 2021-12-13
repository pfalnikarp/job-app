<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="cid" id="cid" value="{{ $cid }}" />
<input type="hidden" class="stamprow" name="rowid" id="rowid"  />


<a href="{{ route('clients.edit', $id ) }}" ><i  class="fa fa-pencil-square-o" style="color: black !important;"></i></a>

