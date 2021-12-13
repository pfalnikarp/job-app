<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

<!-- <button id="edit1" type="submit" class="edit btn btn-xs btn-white">{{ $SubmitTextButton }}</button>
 -->
<a href="{{ route('gmails.edit',$id) }}" class="glyphicon glyphicon-edit"></a>

