<script type="text/javascript">
 
	 $(function () {
     var table = $('#viewworkseat').DataTable({
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
        url: "{{ route('workseat.viewworkseatuserajax',['id'=>$id]) }}",
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
           {data:'company_id',name:'clients.company_id', 
                    "render": function (data, type, full, meta) {
                                    urlclient="{{route('workseat.viewworkseatcompany',':id')}}";
                                    urlclient = urlclient.replace(':id',full.id);

                                    data= '<a href="'+urlclient+'"  class="test" data-toggle="tooltip" title="' + data + '">' + data + '</a>';
                                    return data;
                            }},
           {data:'client_company',name:'clients.client_company'},
           
           {data:'days', name:'days',class:"username dt-center", 
                    "render": function (data, type, full, meta) {
                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   else{
                                     var separeted = data.split(",");
                                      var sum = "";
                                      for (var i = 0; i < separeted.length; i++) {
                                          if(separeted[i] != ""){
                                            sum +=separeted[i]+"<br>" ;
                                          }
                                        }
                                        
                                   }
                                     return sum;
                            }},
               {data:'hours',name:'work_details.hours', 
                    "render": function (data, type, full, meta) {
                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   // else if(full.noofhours != null ){
                                   //   var separeted = full.noofhours;
                                   // }

                                   else{
                                     var separeted = data.split(",");
                                      var sum = "";
                                        for (var i = 0; i < separeted.length; i++) {
                                          if(separeted[i] != ""){
                                            sum += separeted[i]+"<br>";
                                          }
                                        }
                                        separeted=sum;
                                   }
                                     return separeted;
                            }},
                {data:'worktime',name:'work_details.worktime', 
                    "render": function (data, type, full, meta) {
                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   // else if(full.noofhours != null ){
                                   //   var separeted = full.noofhours;
                                   // }

                                   else{
                                     var separeted = data.split(",");
                                      var sum = "";
                                        for (var i = 0; i < separeted.length; i++) {
                                          if(separeted[i] != ""){
                                            sum += separeted[i]+"<br>";
                                          }
                                        }
                                        separeted=sum;
                                   }
                                     return separeted;
                            }},
               {data:'hours',name:'work_details.hours', 
                    "render": function (data, type, full, meta) {
                                   if(data == null){
                                     var separeted = 0;

                                   }
                                   // else if(full.noofhours != null ){
                                   //   var separeted = full.noofhours;
                                   // }
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
                                     return separeted;
                            }},
            {data:'wtimezone',name:'work_details.wtimezone',"render": function (data, type, full, meta) {
               data=full.wcountry+"<br>("+data+")";
               return data;
            }},
            {data:'handler1',name:'handler1'},
            {data:'view',name:'view'},
              
           ], 
           order: [[0, 'desc']]
      });
      
  });

//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#viewworkseat').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

});

   
</script>