<div class="">
    <br>
    
<div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-4">
            <h5>Weekly Dashboard</h5>

        </div>
         <div class="col-md-5"><a href="{{route('monthdashboard.monthdashboard')}}" class="btn btn-primary btn-outline">Show Monthly Dasboard</a></div>
        <div class="col-md-3">
            <select class="form-control mb-2" id='weekid'><option>Current Week</option><option>Last Week</option><option>Custom</option></select>
        </div>
    </div>
     <div class="row weeklytable">
          @for($i=6;$i>=0;$i--)
    <div class="col-md-3">
        <div class="card sr">
           <table id="dashboardtab">
            <b align="center">{{$showdate[$i]}} ({{$showdatename[$i]}})</b>
     @permission('file.price.dashboard')
             <tr><td><td>File</td><td>Revenue</td></tr>
            <tr><td>Vector<td>{{$vfile_count[$i]}} </td><td> {{$vfile_price[$i]}}</td></tr>
            <tr><td>Digitize<td>{{$dfile_count[$i]}} </td><td> {{$dfile_price[$i]}}</td></tr>
            <tr><td>Image Editing<td>{{$pfile_count[$i]}} </td><td> {{$pfile_price[$i]}}</td></tr>
            <tr><td>Alloted<td>{{$allotedfile_count[$i]}} </td><td> {{$allotedfile_price[$i]}}</td></tr>
            <tr><td>QC-Pending  <td>{{$qcpendingfile_count[$i]}} </td><td> {{$qcpendingfile_price[$i]}}</td></tr>
            <tr><td>QC-OK<td>{{$qcokfile_count[$i]}} </td><td> {{$qcokfile_price[$i]}}</td></tr>
            <tr><td>Completed<td>{{$completedfile_count[$i]}} </td><td> {{$completedfile_price[$i]}}</td></tr>
            <tr><td>Revision<td>{{$totalrevesion[$i]}} </td><td> </td></tr>
            <tr><td>Changes<td>{{$totalchange[$i]}} </td><td></td></tr>
    @else
      <tr><td></td><td>File</td></tr>
            <tr><td>Vector<td>{{$totvectordata[$i][0]->totvect}} </td></tr>
            <tr><td>Digitize<td>{{$totdigitdata[$i][0]->totdigit}} </td></tr>
            <tr><td>Image Editing<td>{{$totphotodata[$i][0]->dtotphoto}} </td></tr>
            <tr><td>Alloted<td>{{$totalloted[$i][0]->totallot}} </td></tr>
            <tr><td>QC-Pending  <td>{{$totqcpending[$i][0]->totqcpend}} </td></tr>
            <tr><td>QC-OK<td>{{$totqc[$i][0]->totqcok}} </td></tr>
            <tr><td>Completed<td>{{$totcompl[$i][0]->totcompl}} </td></tr>
            <tr><td>Revision<td>{{$totalrevesion[$i]}} </td></tr>
            <tr><td>Changes<td>{{$totalchange[$i]}} </td></tr>
    @endpermission     
           </table>       
        </div>   
    </div>
    @endfor
    </div>
    <div class="row">
         <div class="col-md-4"></div>
        <div class="col-md-3">
            <select class="form-control selecttype mb-2" id="selecttype">
                <option value="All">All</option>
                <option value="Vector">Vector</option>
                <option value="Digitize">Digitize</option>
                <option value="Alloted">Alloted</option>
                <option value="QC-Pending">QC-Pending</option>
                <option value="QC-OK">QC-OK</option>
                <option value="Completed">Completed</option>
                <option value="Revision">Revision</option>
                <option value="Changes">Changes</option>
            </select>
        </div>
        <div class="col-md-3">
           <select class="form-control mb-2" id='graphyearid'><option>Current Week</option><option>Last Week</option><option>Custom</option></select>
        </div>
         <div class="col-md-1"><a href="javascript:void(0)" class="btn btn-primary" id="graphid">Graph</a></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="barchart_material"></div>
      </div>
    </div>
  </div>
</div>
