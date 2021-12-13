<script type="text/javascript">
  //all user data  
     $(function () {
     var table = $('#alluserid').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
        stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
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
        url: "{{ route('user.rolesdata') }}",
        type: "get",
        data: function (d) {
              d.user_info ="Alluser";
           
        },
          },
        
        columnDefs: [
               {className: "dt-center", targets: "_all"},
               { searchable: false,
                 orderable: false,
                 targets: 0
               },
                  { width:40, targets: 0 },
                 // { width: 20, targets: 1 },
                 // { width: 20, targets: 2 },
                 // { width: 10, targets: 3 },
                 // { width:15, targets: 4 },
               
          ],
          columns: [ 
               {data: null, name: null,width:'5%'},
               {data: 'id', name: 'id',class:"fooid dt-center"},
               {data:'name', name:'name',class:"username dt-center"},
               {data:'email', name:'email',class:"dt-center"},
               {data:'Deleted', name:'Deleted',class:"dt-center"},
               {data:'created_at', name:'created_at',class:"dt-center"}
           ], 
           order: [[1, 'asc']]
      });
      table.on( 'draw.dt', function () {
       var PageInfo = $('#alluserid').DataTable().page.info();
         table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
       });
  });
//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#alluserid').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

});

</script>