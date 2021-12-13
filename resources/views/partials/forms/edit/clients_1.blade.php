<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="cid" id="cid" value="{{ $cid }}" />
<input type="hidden" class="stamprow" name="rowid" id="rowid"  />


<!-- <button id="edit1" type="submit" class="edit btn btn-xs btn-white">{{ $SubmitTextButton }}</button>
 -->

<!--  <button id="edit1" type="submit" class="edit btn btn-xs btn-white"><span class="glyphicon glyphicon-edit"></span></button> -->
 
{{-- <a href="{{ route('clients.edit',$id) }}" class="btn btn btn-xs btn-white"><span class="glyphicon glyphicon-edit"></span></a> --}}

<a href="{{ route('clients_1.edit', $id ) }}"  class="glyphicon glyphicon-edit"></a>

