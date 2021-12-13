<div class="">
        <br>
    <div class="row">
       
        <div class="col-md-4">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
         <div class="col-md-3" >
         
           <h5 align="center" style="color: DodgerBlue;"><b>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Live User  </b></h5>
        </div>
    @permission('user.create')
        <div class="col-md-5" align="right">
            <a class="btn btn-primary btn-outline" href="{{route('user.index')}}">Active User</a>
            <a class="btn btn-danger btn-outline" href="{{route('user.disableuser')}}">Disable User</a>
            <a class="btn btn-info btn-outline" href="{{route('user.alluser')}}">All User</a>
        </div>

    @endpermission
    </div>
 <br>


<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table id="userwithrolesrecords" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>role</th> 
                <th>IP</th>
                <th>last act</th>
              
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
 <h5 align="center" style="color: DodgerBlue;"><b>Failed Login Attempts</b></h5>
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table id="loginattempttableid" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>user name</th>
                <th>login Name</th>
                <th>IP</th> 
                <th>time</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>