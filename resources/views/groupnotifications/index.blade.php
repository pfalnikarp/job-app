@extends('layouts.maintemplate')
@section('third_party_stylesheets')

<style type="text/css">

li {
  color: white !important;
  min-width: 100px !important;
}
</style>

@endsection

@section('content')
    @php
        $grouppage="true";
        $grouppageedit="true";
    @endphp

<div class="container">
                       <div class="row"><h2>Group Notification</h2></div>
                       <hr>
  <div class="row">
  <table  style="width:100%;" id="notificatonrecords" class="table table-bordered table-responsive">
   <thead>
      <tr>
       <th scope="col">Group ID</th>
       <th scope="col">Name </th>
       <th scope="col">User Names</th>
       <th scope="col">Notification Granted</th>
       <th scope="col">Edit</th>
      </tr>
   </thead>
   <tbody></tbody>

</table>
</div>

</div>

@endsection

@section('script')

<script type="text/javascript">

   $(function () {
     var table = $('#notificatonrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        scrollCollapse: true,
        stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
          autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
        //scrollY:($(window).height() - 305),//scroll vertically
        //lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
       ajax: {
        url: "{{ route('groupnotification.index') }}",
        type: "get",
        data: function (d) {
              d.user_info ="Activeuser";

        },
          },
        "preDrawCallback": function (settings) {
            pageScrollPos = $('div.dataTables_scrollBody').scrollTop();
         },
         "drawCallback": function (settings) {
             $('div.dataTables_scrollBody').scrollTop(pageScrollPos);
        },
        columnDefs: [
               {className: "dt-center", targets: "_all"},
               { searchable: false,
                 orderable: false,
                 targets: 0
               },
                  //{ width:40, targets: 0 },
                 // { width: 20, targets: 1 },
                 // { width: 20, targets: 2 },
                 // { width: 10, targets: 3 },
                 // { width:15, targets: 4 },

          ],
          columns: [
               // {data: null, name: null,width:'5%'},
               {data: 'groupid', name: 'groupid', class:"fooid dt-center"},
               {data:'groupname', name:'groupname',width:'150px', class:"username dt-left"},
                {data:'names',name:'names',width:'220px',  class: 'dt-left', "render": function (data, type, full, meta){
                          if(data != null){
                              data=data.replace(/,/g, '<br>');
                            return "<span class='btn btn-sm bg-dark rounded text-white'>"+data+"</span>";
                          }
                          else{
                            return data;
                          }
                  }

               },
               {data:'notify',name:'notify', width:'320px', class:"dt-left" ,"render": function (data, type, full, meta){
                  if(data != null){
                           data=data.replace(/,/g, '<br>');

                            return "<span class='btn btn-sm bg-dark rounded text-white'>"+data+"</span>";
                          }
                          else{
                            return data;
                          }

                  }

               },
               { data:'edit',name:'edit'}


           ],
           order: [[1, 'desc']]
      });
      table.on( 'draw.dt', function () {
       var PageInfo = $('#notificatonrecords').DataTable().page.info();
         table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
       });
  });

//refresh data table
$(document).ready(function () {


 $("#delsession").click(function(event) {

      event.preventDefault ;
      var table = $('#notificatonrecords').DataTable();
      table.state.clear();


      window.location.reload();

    });

});

</script>

@endsection

