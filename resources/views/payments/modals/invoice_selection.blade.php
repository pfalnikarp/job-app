<!-- Modal -->
  <div class="modal fade" id="invoice-selection-modal" role="dialog">
    <div class="modal-dialog modal-lg">
       <h4 class="modal-title">Invoice List</h4>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        
        </div>
        <div class="modal-body">
           <p>Select Row</p> 
           {{--  <div class="form-group">
          		  <input type="text" name="search" class="form-control searchinput" 
                		id="search"></input>
          	</div> --}}
       
        
        <table id="inv-sel-help" class="table table-hover table-bordered ">
        <thead>
            <tr class="sel-inv">
              <th></th>
              <th>SrNo</th>
              <th>Invoice No</th>
              <th>Bill Date</th>
              <th>Invoice Amt</th>
              <th>Paid Amt</th>
             
            </tr>
        </thead>
        <tbody>
          
    
        </tbody>


        </table>
        

        </div>

        <div class="modal-footer">
          <button type="button" class="btn selectinv btn-primary">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>