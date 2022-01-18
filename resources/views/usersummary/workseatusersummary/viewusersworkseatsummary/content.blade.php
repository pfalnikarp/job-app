<div class="">
        <br>
    <div class="row">
        <div class="col-md-4">
          <h5><b>Virtual Assistant User Summary</b></h5> 
        </div>
        <div class="col-md-4">
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-4">
            @permission('va.operations.show')
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-primary rightdiv ml-2 kk" data-toggle="tooltip" data-placement="top" title="Operations" id="Operations">Operations ({{$scrcount}})</a>
            @endpermission
            @permission('va.data.show')
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-warning rightdiv ml-2 kk" data-toggle="tooltip" data-placement="top" title="Data" id="Data">Data ({{$datacount}})</a>
            @endpermission
            @permission('va.graphics.show')
             <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-success rightdiv kk" data-toggle="tooltip" data-placement="top" title="Graphics" id="Graphics">Graphics ({{$graphicscount}})</a>
            @endpermission

        </div>
    
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="workseatusersummary" class="table table-bordered table-striped temcolor1 mb-0 activeuserclass"style="width:100%;">
        
        <thead>
            <tr>
                <th>No</th>
                <th>User Name</th>
            @if(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show'))
                <th>Department</th>
            @elseif(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.operations.show')) 
                <th>Department</th>
            @elseif(Auth::user()->hasPermission('va.data.show') && Auth::user()->hasPermission('va.graphics.show'))
                <th>Department</th>
            @elseif(Auth::user()->hasPermission('va.operations.show') && Auth::user()->hasPermission('va.graphics.show'))
                <th>Department</th>
            @endif
                <th>Total Hours</th>
                <th>Alloted Hours</th> 
                <th>Alloted Project</th>
                <th>Pending Hours</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
@include('pages.workseat.modals.graphicsdata')

</div>