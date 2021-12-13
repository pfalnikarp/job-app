@extends('layouts.tabledashboard')
@section('style')




@endsection

@section('content')



<div class="card-body  table-responsive" >

    <table id="timer-table" class="table condensed data-table row-border compact order-column" style="width:100%">

    <thead>
    	<th>id</th>
    
    	<th>Order ID</th>
    	<th>allocated By</th>
    	<th>Started At</th>
    	<th>Stopped At</th>

    </thead>	
    <tbody>
    	


    </tbody>


    </table>	

@endsection

@section('script')
<!--  timer function -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>


<!--  timer function -->
<script type="text/javascript">
  $(function () {

	
	  //datatable logic
    
    var table = $('#timer-table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true, 
        async: true,
		    responsive: true,
        scrollX: true,
		    scrollY: ($(window).height() - 260), 
        scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
        bStateSave: true,
      
        dom: "Rlfrtip",
        autowidth: false,
		     columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
      

        select: {
          style: 'multi'
        },
        lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="20" selected>20</option>'+
                      '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select> Orders'

                    },
        colReorder: true,
		
        scroller: {
           rowHeight: 1
        }, 
  
        ajax: '{!!  route('timers.index') !!}',
         "preDrawCallback": function (settings) {
            pageScrollPos = $('div.dataTables_scrollBody').scrollTop();
         },
         "drawCallback": function (settings) {
             $('div.dataTables_scrollBody').scrollTop(pageScrollPos);
        },

  
           
        columns: [
        
             { data: 'id', name: 'id',  class: 'dt-center',searchable: true
         
           },
        
           
           { data: 'order_id', name: 'order_id',  class: 'dt-center',searchable: true
         
           },
        
          
            { data: 'allocated_by', name: 'allocated_by' ,  class: 'dt-center',
             "render": function (data, type, full, meta) {
                           if (data == null) {
                           return '';
                             }
                             else {
                                return '<span class="test" data-toggle="tooltip" >' + data + '</span>';
                             } } },
            { data: 'started_at', name: 'started_at' ,  class: 'dt-center'},
            { data: 'stopped_at', name: 'stopped_at' ,  class: 'dt-center'},
        
                            ],
                         pageLength: 20,
              pagination: true,
         
                  order: [[ 0, "desc" ]]
          
          
              
         }); 

    });
  
</script>

@stop

