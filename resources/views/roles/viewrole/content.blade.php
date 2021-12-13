<div class="">
    <br>
    <div class="row">
        <div class="col-md-1">
               <a><h5><b>Roles</b></h5></a> 
        </div>
      
        <div class="col-md-9">
              <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger"  id="delsession" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
    @permission('role.create')
        <div class="col-md-2">
            <a class="btn btn-outline btn-primary rightdiv" href="{{route('role.create')}}">Create Role</a>
        
        </div>
    @endpermission
    </div>
  
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="rolerecords" class="table table-bordered table-striped temcolor1 mb-0" style="width:100%; border:2px solid;border-radius: 5px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Slug</th>
                <th>Level</th>
            @permission('role.modify')
                <th>Edit</th>
            @endpermission
            @permission('role.list')
                <th>View</th>
            @endpermission
            @permission('role.delete')
                <th>Delete</th>
            @endpermission
            </tr>
        </thead>
        <tbody>  
        </tbody>
    </table>
    
</div>
</div>

