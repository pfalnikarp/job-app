<div class="">
        <br>
    <div class="row">
        <div class="col-md-4">
          <h5><b>VA - {{auth()->user()->name}}</b></h5> 
        </div>
        <div class="col-md-1">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
    
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="viewworkseat" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        
        <thead>
            <tr>
                <th>Co Id</th>
                <th>Company Name</th>
                <th>No of Days</th>
                <th>Alloted Hours</th>
                <th>Work Time</th>
                <th>Total Hours</th>
                <th>country</th>
                <th>Handler</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>


</div>