<div class="">
    <br>
   <!--  
   <button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-info">Info</button>




<br>
<hr>
 <button type="button" class="btn btn-primary" style="background-color: #447DF7;border-color: #447DF7;">Primary</button>
<button type="button" class="btn btn-success" style="background-color: #78b414;border-color: #78b414;" >Success</button>
<button type="button" class="btn btn-danger" style="background-color:#fa1825;border-color: #fa1825;">Danger</button>
<button type="button" class="btn btn-warning" style="background-color:#ff9510 ;border-color:#ff9510 ;">Warning</button>
<button type="button" class="btn btn-info" style="background-color:#23CCEF;border-color:#23CCEF ;">Info</button>




<br><hr> -->
<!--  <button type="button" class="btn btn-primary" style="background-color: #578af7;border-color:#578af7 ;">Primary</button>
<button type="button" class="btn btn-success" style="background-color:#2e9445 ;border-color:#2e9445 ;">Success</button>
<button type="button" class="btn btn-danger" style="background-color:#c43341 ;border-color:#c43341 ;">Danger</button>
<button type="button" class="btn btn-warning" style="background-color:#deac18 ;border-color:#deac18 ;">Warning</button>
<button type="button" class="btn btn-info" style="background-color:#28b3c9 ;border-color:#28b3c9 ;">Info</button>




<br><hr>
 <button type="button" class="btn btn-primary" style="background-color: #4f7cdb;border-color:#4f7cdb ;">Primary</button>
<button type="button" class="btn btn-success" style="background-color:#37bf56 ;border-color:#37bf56 ;">Success</button>
<button type="button" class="btn btn-danger" style="background-color:#c94451 ;border-color:#c94451 ;">Danger</button>
<button type="button" class="btn btn-warning" style="background-color:#edc345 ;border-color:#edc345 ;">Warning</button>
<button type="button" class="btn btn-info" style="background-color:#68afba ;border-color:#68afba ;">Info</button>





<br><br> -->
    <div class="row">
        <div class="col-md-2">
          <h5><b>Permissions</b></h5> 
        </div>
        <div class="col-md-8">
              <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-2">
              
            <a class="btn btn-warning  rightdiv createpermission" href="#">Create Permission</a>
                 </div>
    </div>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsiveid  mt-2">
    <table id="permissionrecords" class="table table-bordered table-striped mb-0 temcolor1"style="width:100%; border:2px solid;border-radius: 5px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>  
        </tbody>
    </table>
    
</div>
</div>

<div class="modal fade right" id="CreatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                  <label  class="btn btn-danger btn-outline btn-sm closepermission"><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>

            <div class="modal-body">
              
                 <!-- <input type="hidden" value="" name="leadid" id="leadid">
                 <input type="hidden" value="" id="currentPageIndexid"> -->
                 
               <div class="row">

                    <div class="col-md-3 pr-1">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="" id="name"required="">
                            </div>
                    </div>
                    <div class="col-md-3 px-1">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="" id="slug" required="">
                            </div>
                    </div> 
                    <div class="col-md-2 px-1">
                            <div class="form-group ">
                                <label>Model</label>
                                <input type="text" class="form-control mt-0" name="model" value="Permission" id="model" required="">
                            </div>
                    </div> 
                     <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label >Description</label>
                                <textarea class="form-control form-control2 mt-0" name="description" id="description"  required=""></textarea>
                               
                            </div>
                    </div> 
               </div>
               <div class="row">
                    <div class="col-md-4 pr-1">
                                <div class="form-group ">
                                     <a class="btn btn-info btn-outline submitpermission" href="#">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>

<!-- update permission model -->
<div class="modal fade right" id="UpdatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading1"></h4>
                  <label  class="btn btn-danger btn-outline btn-sm closeupadepermission"><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>

            <div class="modal-body">
              
                 <input type="hidden" value="" name="permissionid" id="permissionid">
                 <input type="hidden" value="" name="currentPageIndexid" id="currentPageIndexid">
                 
               <div class="row">

                    <div class="col-md-4 pr-1">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="" id="updatename" required="">
                            </div>
                    </div>
                    <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="" id="updateslug" required="">
                            </div>
                    </div> 
                 <!--     <div class="col-md-2 px-1">
                            <div class="form-group ">
                                <label>Model</label>
                                <input type="text" class="form-control mt-0" name="model" value="" id="updatemodel" required="">
                            </div>
                    </div>  -->
                     <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea class="form-control form-control2 mt-0" name="description" id="updatedescription" value=""  required=""></textarea>
                            </div>
                    </div> 
               </div>
               <div class="row">
                    <div class="col-md-4 pr-1">
                                <div class="form-group ">
                                     <a class="btn btn-info btn-outline submitupdatepermission" href="#">Update</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>