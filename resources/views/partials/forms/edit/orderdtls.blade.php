<meta name="_token"  content="{!! csrf_token() !!}" />

<input type="hidden" name="id" id="id" value="{{ $id }}" />

<input type="hidden" name="order_id" value = "{{ $order->order_id }}"

<a href="http://www.google.co.in"    >{{ $orderid }}</a> 
{{-- <a href="{{route('orders.edit1',$order->id)}}"    >{{ $orderid }}</a>   --}}



{{-- <button id="edit2" type="submit" class="editaction btn btn-sm">{{ $orderid }}</button> --}}