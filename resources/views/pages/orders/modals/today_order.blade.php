<!-- Modal -->
  <div class="modal fade" id="todayordModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Today's Company List</h4>
          <input type="text" name="startdatecount" id="startdatecount">
          <input type="text" name="enddatecount" id="enddatecount">
          <a class="btn btn-sm btn-info btn-outline mt-1" id="datecompanycount">search</a>
          <button type="button" class="btn btn-danger btn-outline btn-sm mt-1" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          
        
        <table id="todayorder" class="table table-hover table-bordered  orderhelp">
        <thead>
            <tr>
              <th>Company ID</th>
              <th>Client Company</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>File Type</th>
              <th>File Count</th>
              
              
            </tr>
        </thead>
        <tbody>
    
        </tbody>


        </table>
        

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>