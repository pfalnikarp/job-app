
{{-- {!! Form::open(array('method'=>'POST',  'action'=>['OrderController@edit1', $id])) !!}
                         
@include('partials.forms.edit.orderdtls', ['SubmitTextButton'=>'Edit' ,'id'=>$id, 'orderid'=>$orderid,
 'order'=>$order])


{!! Form::close() !!} --}}

<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

{{-- <input type="hidden" name="order_id" value = "{{ $order->order_id }}" />
<a href="{{ route('ordertables.edit1',$id) }}"  >{{ $orderid }}</a>   --}}

<button id="edit1" type="submit" class="editaction btn btn-sm "><span class="glyphicon glyphicon-edit"></span></button>
