<!-- <a href="{{route('orders.edit',$id )}}" class=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  style="color: #6880D5;"-->
{{ Form::open(array('method'=>'get',  'route'=>['orders.edit', $id])) }}

<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />


<br>

{{ Form::button('<i class="fa fa-pencil-square-o" ></i>', ['type' => 'submit', 'class' => 'btn btn-primary editmain btn-link'] )  }}
{{ Form::close() }}
<br>



<a href="#" class="opentimer"><i class="fa fa-book" style="color: #6880D5;"></i>
      <input type="hidden" class ="orderindexid" name="orderindexid" value="{{ $id }}">
</a>