<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="cid" id="cid" value="{{ $cid }}" />
<input type="hidden" class="stamprow" name="rowid" id="rowid"  />


<!-- <button id="edit1" type="submit" class="edit btn btn-xs btn-white">{{ $SubmitTextButton }}</button>
 -->

<!--  <button id="edit1" type="submit" class="edit btn btn-xs btn-white"><span class="glyphicon glyphicon-edit"></span></button> -->
 
{{-- <a href="{{ route('clients.edit',$id) }}" class="btn btn btn-xs btn-white"><span class="glyphicon glyphicon-edit"></span></a> --}}

{{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> --}}
<a href="{{ route('users.edit', $id ) }}"  class="btn btn-sm btn-primary">Edit</a>

