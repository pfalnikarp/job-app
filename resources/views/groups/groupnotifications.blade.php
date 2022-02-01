@extends('layouts.maintemplate')
@section('third_party_stylesheets')
<style type="text/css">
</style>
@endsection
@section('content')
<h4>Notifications </h4>
<table class="table table-bordered table-responsive">
  <thead>
    <th>Client Notification</th>
  </thead>
  <tbody>
    @foreach($cnotification as $note)
    <tr >
      <td ><input type="checkbox"  name="selected[]" value="{{ $note->value }}"> {{ $note->text }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<table class="table table-bordered table-responsive">
  <thead>
    <th>Order Status Notification</th>
  </thead>
  <tbody>
    <?php $row = 0; $n = 1;?>
    <tr>
      @foreach($notification1 as $note)
      <td> <input type="checkbox"  name="selected[]"> {{ $note->text }} </td>
      {{ $n++ }}
      @if($n> 3)
    </tr><tr>
    <?php $n = 1;?>
    @endif
    @endforeach
  </tr>
</tbody>
</table>
@endsection