<!-- Modal -->
  <div class="modal fade" id="TodayOrderDetail" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
         <!--  <button data-toggle="tooltip" title="Back" class="back-count btn btn-sm btn-success  col-xs-1">
            <span class="glyphicon glyphicon-arrow-left"></span>
          </button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>Today's Order Details</center></h4>
        
        </div>
        <div class="modal-body">
          
           {{--  <div class="form-group">
                <input type="text" name="search" class="form-control searchinput" 
                    id="search"></input>
            </div> --}}
       
        <div class="table-responsive">
        <table id="table3_1" class="table table-hover table-bordered  ">
        <thead>
            <tr>
              <th>Order Id</th>
              <th>Order Us Date</th>
              <th>Target Date</th>
              <th>File Name</th>
              <th>File Type</th>
              <th>Status</th>
              <th>Allocation </th>
              
            </tr>
        </thead>
        <tbody>
    
        </tbody>


        </table>
        </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

 