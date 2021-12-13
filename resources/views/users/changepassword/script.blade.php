<script type="text/javascript">
 
	 $(function () {
     var table = $('#userpasswordrequest').DataTable({
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
        scrollY:($(window).height() - 305),//scroll vertically
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
              d.user_info ="Changepassword";
           
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
               {data: 'id', name: 'id',class:"dooid dt-center" ,width:'5%'},
               {data: 'fuser_id', name: 'fuser_id',class:"fooid dt-center"},
               {data:'fname', name:'fname',class:"username dt-center"},
               {data:'fip', name:'fip',class:"dt-center"},
               {data:'created_at',name:'created_at'},
               {data:'updated_at',name:'updated_at',
             "render": function (data, type, full, meta)
            {
                          if(full.flag == 'Y'){
                             return '<span data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
                            else{
                              return "Pending";
                            }
                          } 
                           

            },
               {data:'edit',name:'edit'}
                       
           ], 
          // order: [[0, 'desc']]
      });
      
  });

//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#userpasswordrequest').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

  

});



//Change Password
  $(document).on("click", ".changeclass", function(){
      var name  = $(this).closest('tr').find('td.username').text();
      var user_id  = $(this).closest('tr').find('td.fooid').text();
      var chanhepasswordtab_id  = $(this).closest('tr').find('td.dooid').text();
      
      $('#usernamemodal').text(name);
      $('#useridmodal').val(user_id);
      $('#chngepasswordtabid').val(chanhepasswordtab_id);
        $("#myModal").modal('show');
  });
//send data to user controller

  $(document).on("click", ".updateclass", function(){
        var user_id=$('#useridmodal').val()
        var newpassword=$('#newpassword').val();  
        var changepasswordid=$('#chngepasswordtabid').val();
        var table = $('#userpasswordrequest').DataTable();

     $.ajax({
        url: "{{route('user.updaterequestuserpassword')}}",
        type:"POST",
        data:{
          user_id:user_id,
          newpassword:newpassword, 
          changepasswordid:changepasswordid,  
          _token: "{{ csrf_token() }}",
        },
        success:function(response){
          console.log(response);
          if(response=="true") {
            toastr.success('Password Update Sucessfully.'); 
            $('#myModal').modal('hide');
             table.ajax.reload( null, false ); 
          }
        },
       });
  });   
</script>