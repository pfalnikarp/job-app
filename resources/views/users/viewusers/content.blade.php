<div class="">
        <br>
    <div class="row">
        <div class="col-md-3">
          <h5><b>User's Roles & Permission  </b></h5> 
        </div>
        <div class="col-md-1">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
    @permission('user.create')
        <div class="col-md-6">
            <a class="btn btn-success btn-outline" href="{{route('user.liveuser')}}">Live User</a>
            <a class="btn btn-danger btn-outline" href="{{route('user.disableuser')}}">Disable User</a>
            <a class="btn btn-info btn-outline" href="{{route('user.alluser')}}">All User</a>
        </div>
        
        <div class="col-md-2">
            <a class="btn btn-warning btn-outline rightdiv" href="{{route('user.create')}}">Create User</a>
        </div>

    @endpermission
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsiveid">
    <table id="userwithrolesrecords" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Role</th> 
                <th>Permission</th>
            @permission('user.update')
                <th>Edit</th> 
            @endpermission
            @permission('user.show')
                <th>View</th>
            @endpermission
            @permission('user.delete')
                <th>Delete</th> 
            @endpermission

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>


</div>