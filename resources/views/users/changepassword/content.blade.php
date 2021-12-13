<div class="">
        <br>
    <div class="row">
        <div class="col-md-3">
          <h5><b>User Change Password</b></h5> 
        </div>
        <div class="col-md-1">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
   
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="userpasswordrequest" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>IP</th>
                <th>Request Time</th>
                <th>Change Time</th>
            @permission('user.update')
                <th>Change Password</th> 
            @endpermission
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
 </div>
 <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">  
                            <label>Name :&nbsp;</label><span id="usernamemodal"></span>
                      </div>
                      <div class="col-md-10">
                             <input type="text" name="newpassword" class="form-control" id="newpassword">
                             <input type="hidden" name="modaluser_id" id="useridmodal">
                             <input type="hidden" name="chngepasswordtab_id" id="chngepasswordtabid">
                      </div>
                 </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary updateclass">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>