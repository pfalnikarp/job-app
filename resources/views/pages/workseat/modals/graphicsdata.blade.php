<!-- Modal -->
  <div class="modal fade" id="graphicsmodal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="departmentnameid"></h4>
          <button type="button" class="btn btn-danger btn-outline btn-sm mt-1" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          
        
        <table id="graphictableid" class="table table-hover table-bordered  orderhelp c">
        <thead>
            <tr>
              <th style="width: 5%;">Id</th>
                <th>Co Id</th>
                <th>Company Name</th>
                <th>No of Days</th>
                <th>Alloted Hours</th>
                <th>Work Time</th>
                <th style="width: 10%;">country</th>
              @permission('show.amont')
                <th>Revenue</th>
              @endpermission
                <th>Handler</th>
                <th>Resource</th>
               
              
              
            </tr>
        </thead>
        <tbody>
    
        </tbody>


        </table>
        

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
          <b>Total Revenue : <span id="totalrevenuid"></span></b>
        </div>
      </div>
    </div>
  </div>