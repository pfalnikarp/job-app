<div class="">
        <br>
    <div class="row">
        <div class="col-md-3">
          <h5><b>Disable User</b></h5>
        </div>
          <div class="col-md-1">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
    @permission('user.create')
        <div class="col-md-6">
             <a class="btn btn-success btn-outline" href="{{route('user.liveuser')}}">Live User</a>
            <a class="btn btn-primary btn-outline" href="{{route('user.index')}}">Active User</a>
            <a class="btn btn-info btn-outline" href="{{route('user.alluser')}}">All User</a>
        </div>
        
        <div class="col-md-2">
            <a class="btn btn-warning btn-outline rightdiv" href="{{route('user.create')}}">Create User</a>
        </div>

    @endpermission
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="disableuserid" class="table table-bordered table-striped temcolor1 mb-0 disableuserclass"style="width:100%;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Deleted By</th> 
                <th>Deleted At</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>

</div>