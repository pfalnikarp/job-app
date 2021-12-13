<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

<a href="{{ route('gmails.newclient',$id) }}" class="btn btn-xs btn-warning  ">New Client
</a>

<!-- btn btn-sm btn-warning  cadd glyphicon glyphicon-plus  <button id="edit1" type="submit" class="edit btn btn-xs btn-white">{{ $SubmitTextButton }}</button>
 -->

