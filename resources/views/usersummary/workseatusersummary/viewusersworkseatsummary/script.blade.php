<script type="text/javascript">
 
	 $(function () {
     var table = $('#workseatusersummary').DataTable({
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
        url: "{{ route('workseat.userworkseatsummary') }}",
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
           {data:'id',name:'id'},
           {data:'name',name:'name'},
         @if(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show'))  
           {data:'workdeatildepartment',name:'work_details.department', 
                    "render": function (data, type, full, meta) {
                      if(data == null){
                                     return data;

                                   }
                                   else{
                                      var obj=data.split(",");
                                      var i;
                                      var text1="";
                              
                                      for (i = 0; i < obj.length; i++) {
                      
                                        text1 += '<span>'+obj[i]+'</span><br>';
                                      }
                                        return  text1; 
                                                    
                                      
                                   }
                                     return separeted;
                    }},
          @elseif(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show')) 
                {data:'workdeatildepartment',name:'work_details.department', 
                    "render": function (data, type, full, meta) {
                      if(data == null){
                                     return data;

                                   }
                                   else{
                                      var obj=data.split(",");
                                      var i;
                                      var text1="";
                              
                                      for (i = 0; i < obj.length; i++) {
                      
                                        text1 += '<span>'+obj[i]+'</span><br>';
                                      }
                                        return  text1; 
                                                    
                                      
                                   }
                                     return separeted;
                    }},
          @elseif(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.graphics.show'))
              {data:'workdeatildepartment',name:'work_details.department', 
                    "render": function (data, type, full, meta) {
                      if(data == null){
                                     return data;

                                   }
                                   else{
                                      var obj=data.split(",");
                                      var i;
                                      var text1="";
                              
                                      for (i = 0; i < obj.length; i++) {
                      
                                        text1 += '<span>'+obj[i]+'</span><br>';
                                      }
                                        return  text1; 
                                                    
                                      
                                   }
                                     return separeted;
                    }},
          @elseif(Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show'))
              {data:'workdeatildepartment',name:'work_details.department', 
                    "render": function (data, type, full, meta) {
                      if(data == null){
                                     return data;

                                   }
                                   else{
                                      var obj=data.split(",");
                                      var i;
                                      var text1="";
                              
                                      for (i = 0; i < obj.length; i++) {
                      
                                        text1 += '<span>'+obj[i]+'</span><br>';
                                      }
                                        return  text1; 
                                                    
                                      
                                   }
                                     return separeted;
                    }},
          @endif

           {data:'totalhour',name:'totalhour'}, 
           {data:'workdeatilhours',name:'work_details.hours', 
                    "render": function (data, type, full, meta) {

                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   else{
                                     var separeted = data.split(",");
                                      var sum = 0;
                                        for (var i = 0; i < separeted.length; i++) {
                                          if(separeted[i] != ""){
                                            sum += parseInt(separeted[i].toString().match(/(\d+)/));
                                          }
                                        }
                                        separeted=sum;
                                   }
                                   // if(full.sumnoofhours != null){
                                   //      separeted+=full.sumnoofhours;
                                   // }
                                     return separeted;
                            }},
            {data:'workdeatilid', name:'work_details.id',class:"username dt-center", 
                    "render": function (data, type, full, meta) {
                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   else{
                                     var separeted = data.split(",");
                                      
                                        separeted=separeted.length;
                                   }
                                     return separeted;
                            }},
            {data:'pendinghours',name:'pendinghours'},
            {data:'view',name:'view'},
              
           ], 
           order: [[0, 'desc']]
      });
      
  });

//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#workseatusersummary').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

   $(".kk").click(function(event) {
        $("#graphicsmodal").modal('show');
        var value=$(this).attr('id');
        
        $("#departmentnameid").html("");
        
        $("#todayorder tbody").html('<h2>Please wait ... </h2>');
      $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('workseatgraphics') }}",
             data: {"search": value},
            success:function(data)
                  {
                    console.log(data[1]);
                    $("#departmentnameid").html(value);
                    $("#graphictableid tbody").html(data[0]);
                    $("#totalrevenuid").text(data[1]);
                  }
        
        });

    });


});

   
</script>