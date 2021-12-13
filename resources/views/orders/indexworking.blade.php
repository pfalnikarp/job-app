<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <h1>Orders</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>OrderID</th>
                <th>client_name</th>
                <th>client_email_primary</th>
                <th>client_address1</th>
                <th>client_state</th>
                <th>client_contact_1</th>
                <th>other_contact</th>
                <th>client_note</th>
                <th>file_name</th>
                <th>file_type</th> 
                <th>vendor</th>
                <th>stiches_count</th>
                <th>order_date_time</th>
                <th>order_dt</th>
                <th>target_completion_time</th>
                <th>allocation</th>
                 <th>status</th>
                <th>document_type</th>
                <th>note</th>
                <th>unit_price</th>
                <th>order_us_date</th>
                <th>created_at</th>
                 <!--  <th></th>
                <th></th>
                <th></th> -->
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
          async: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'id', id: 'id'},
            {data: 'order_id', name: 'order_id'},
            {data: 'client_name', name: 'client_name'},
            {data: 'client_email_primary', name: 'client_email_primary'},
            {data: 'client_address1', name: 'client_address1'},
            {data: 'client_state', name: 'client_state'},
            {data: 'client_contact_1', name: 'client_contact_1'},
             {data: 'other_contact', name: 'other_contact'},
             {data: 'client_note', name: 'client_note'},
             {data: 'file_name', name: 'file_name'},
             {data: 'file_type', name: 'file_type'},
             {data: 'vendor', name: 'vendor'},
             {data: 'stiches_count', name: 'stiches_count'},
             {data: 'order_date_time', name: 'order_date_time'},
             {data: 'order_dt', name: 'order_dt'},
             {data: 'target_completion_time', name: 'target_completion_time'},
             {data: 'allocation', name: 'allocation'},
             {data: 'status', name: 'status'},
             {data: 'document_type', name: 'document_type'},
             {data: 'note', name: 'note'},
             {data: 'unit_price', name: 'unit_price'},
             {data: 'order_us_date', name: 'order_us_date'},
             {data: 'created_at', name: 'created_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
</html>