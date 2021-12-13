<script type="text/javascript">
 
	 $(function () {
     var table = $('#userwithrolesrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        scrollCollapse: true, 
        stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
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
        url: "{{ route('user.rolesdata') }}",
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
                {data:'rolename',name:'rolename',"render": function (data, type, full, meta){
                          if(data != null){
                              data=data.replace(/,/g, '<br>');
                            return "<span class='btn btn-sm bg-dark rounded text-white'>"+data+"</span>";
                          }
                          else{
                            return data;
                          }
                  }

               },
               {data:'permissionname',name:'permissionname',"render": function (data, type, full, meta){
                  if(data != null){
                           data=data.replace(/,/g, '<br>');
                            return "<span class='btn btn-sm bg-dark rounded text-white'>"+data+"</span>";
                          }
                          else{
                            return data;
                          }

                  }

               },
               
               
               // {data:'designation',name:'designation'},
               //  {data:'leadername',name:'leadername'},
               
              @permission('user.update')
                    {data:'edit',name:'edit'},
              @endpermission
              @permission('user.show')
                    {data:'view',name:'view'},
              @endpermission
              @permission('user.delete')
                    {data:'delete',name:'delete',class:'deleteuser dt-center'},
              @endpermission 
           ], 
           order: [[1, 'desc']]
      });
      table.on( 'draw.dt', function () {
       var PageInfo = $('#userwithrolesrecords').DataTable().page.info();
         table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
       });
  });

//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#userwithrolesrecords').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

});
//delete role
    $(document).on("click", ".deleteuser", function(){
      var name  = $(this).closest('tr').find('td.username').text();
      
       Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete "+name+"?",
        // text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })
    .then((result) => {
      if (result.value) { 
        var table = $('#userwithrolesrecords').DataTable();
        var id= $(this).closest('tr').find('td.fooid').text(); 
        var userid={user_id:id}
            $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('user.userdelete')}}",
                data: userid,
                 
                 success: function(data){    
                          
                            table.ajax.reload( null, false );               
                            toastr.success("Delete user succesfully");
                 },
                   
            });
        
    } 
    else 
    {
         toastr.warning('You canceled delete operetion');  
    }
      
    });
  });   
</script>