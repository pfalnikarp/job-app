@extends('layouts.maintemplate')
@section('style')
<style type="text/css">
  body {
       
      }

  .dash-unit1 {
    color: white;
  }
  

  .dash-unit {
    height: 370px !important; 
  }

/*table { 
  table-layout: fixed;
  width: 100%
}
*/


.table>td {
  position: relative;
  background: transparent ; 
  overflow: hidden;
  vertical-align: middle;
  border-top: 0px;
  font-size: 14px;
  clear: both;
  border-collapse: collapse;
 
  word-wrap: break-word;
 max-width: 100px !important;
 color: white !important;
  color: blue !important; */
  white-space: pre;  
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  
}

.modal-dialog {
    width: 1200px !important;
   
}

.modal-header {
 
     background:  #9c9391;

}  

  
.modal-dialog{
    overflow-y: initial !important;
}

.modal-body{
    max-height: calc(100vh - 200px) !important;
    overflow-y: auto  !important;
    /*background: #00bfa5 ;
    background:    #44703c   ; removed on 12/04/17  
    background: transparent !important ;  */
    scrollbar-face-color: #414340;
            scrollbar-shadow-color: #cccccc;
            scrollbar-highlight-color: #cccccc;
            scrollbar-3dlight-color: #cccccc;
            scrollbar-darkshadow-color: #cccccc;
            scrollbar-track-color: #cccccc;
            scrollbar-arrow-color: #000000;
}

.modal-footer {
   /*background: #2196f3;*/
    background:  #9c9391;
}
#dformat   {
   color: blue !important;
   background: #FFFACD !important;
}
.boldtext {
    
    font-weight: bold;
    
  }

  .clienttab {
    line-height: 1px !important;
    border-bottom: 0px !important;

  }

  .rightval {
     text-align: right;
  }

  .pswd {
    padding: 0px !important;
  }

  .pass {
    color: blue;
  }

  .cpass {
    color: blue;
  }

    .tooltiptext {
      visibility: hidden;
      font-size: 12px;
      
    }
  .navbar-brand
    {
       padding: 1.5px 5px !important; 
    }

img.logo1 
{
  /*width: 50%;
  height: 10vh;*/
  padding: 12px;
} 
</style>
@endsection
@section('content')
    <div class="container">

    <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        

      <!-- DONUT CHART BLOCK  New Approval status included on 17/05/18 -->
    

    

  @if (Auth::user()->hasRole('Designer') ||  Auth::user()->hasRole('team.lead.designer')) 
           <div class="col-sm-4 col-lg-4">
          <div class="dash-unit">
          <dtitle class="boldtext">Designer Status</dtitle>
          <hr>
          
            <div id="load"> 
            <table class="table">
              <thead>
                  <tr>
                <th colspan="2"><h5>Current Month</h5></th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                <td>Vector</td>
                <td>@foreach($curr_mnth_vector as $val)
                    <span>{{ $val->totvect }}</span> 
                    @endforeach
                </td>
                </tr>
                <tr>
                <td>Digitize</td>
                <td>@foreach($curr_mnth_digit as $val)
                    <span>{{ $val->totdigit }}</span> 
                    @endforeach
                </td>
                </tr>
                <tr>
                  <td colspan="2"><h5>Previous Month</h5></td>
                  
                </tr>
                <tr>
                <td>Vector</td>
                <td>@foreach($prv_mnth_vector as $val)
                    <span>{{ $val->totvect }}</span> 
                    @endforeach
                </td>
                </tr>
                <tr>
                <td>Digitize</td>
                <td>@foreach($prv_mnth_digit as $val1)
                    <span>{{ $val1->totdigit }}</span> 
                    @endforeach
                </td>
                </tr>
              </tbody>
            </table>
            

                </div>
      </div>
        </div>


       @endif
       
      <!-- DONUT CHART BLOCK   Monthly status-->
       @if(   Auth::user()->email  == 'anis@patterns.com' ||
              Auth::user()->email  == 'jubbin@patterns.com' ||
              Auth::user()->email  == 'shraddha@patterns.com' ||
              Auth::user()->email  == 'kalyan@patterns.com' ||
              Auth::user()->email  == 'kulind@patterns.com' ||
              Auth::user()->email  == 'tallin@patterns.com' ||
              Auth::user()->email  == 'babul@patterns.com' ||
               Auth::user()->email  == 'pfalnikarp@patterns.com'    )
     
      <div class="col-sm-4 col-lg-4">
          <div class="dash-unit">
          <dtitle class="boldtext">Monthly Status for the <span class="mm"></span></dtitle>
          
          <hr>
        
          <table class="table table-bordered table-condensed montable">
            <thead>
              <th></th>
              <th>Count</th>
            @permission('file.price.dashboard')
              <th>Price</th>
            @endpermission
            </thead>
            <tbody>
            <tr>
              <td>Vector</td>
              <td>  <a class="vect" href="#"></a>  </td>
            @permission('file.price.dashboard')     
              <td><div class="vectprice"></div></td>
            @endpermission
            </tr>
            <tr>
              <td>Digitize</td>
              <td> <a class="digi" href="#"></a>  </td>
            @permission('file.price.dashboard')     
              <td><div class="digiprice"></div></td>
            @endpermission
            </tr>
             <tr>
              <td>Image Editing</td>
              <td> <a class="photo" href="#"></a>  </td>
            @permission('file.price.dashboard')      
              <td><div class="photoprice"></div></td>
            @endpermission 
            </tr>
           
            <tr>
              <td>Approved</td>
              <td><a class="approv" href="#"></a> </td>
            @permission('file.price.dashboard')    
              <td><div class="approvprice"></div></td>
            @endpermission
            </tr>
            <tr>
              <td>Alloted</td>
              <td><a class="allot" href="#"></a>  </td>
            @permission('file.price.dashboard')     
              <td><div class="allotprice"></div></td>
            @endpermission  
            </tr>
            <tr>
              <td>QC-Pending</td>
              <td><a class="qcpend" href="#"></a>  </td>
            @permission('file.price.dashboard')      
               <td><div class="qcpendprice"></div></td>
            @endpermission  
            </tr>
            <tr>
              <td>QC Ok</td>
              <td><a class="qcok" href="#"></a>  </td>
            @permission('file.price.dashboard')    
               <td><div class="qcokprice"></div></td>
            @endpermission  
            </tr>
            <tr>
              <td>Completed</td>
              <td><a class="compl" href="#"></a>  </td>
            @permission('file.price.dashboard')    
                <td><div class="complprice"></div></td>
            @endpermission
            </tr>
             </tbody>
          </table>
            
      </div>
        </div>
    @endif
  <!--  Monthly status  end -->      
        
        <div class="col-sm-4 col-lg-4">

     <div class="dash-unit">
          <dtitle class="boldtext">Daily Status (US Today) <span  class="dmm_td"> </span> </dtitle>
           <hr>
          <table class="table table-bordered table-condensed chgtable">
          <thead>
            <th></th>
            <th>Count</th>
          @permission('file.price.dashboard')
            <th>Price</th>
          @endpermission  
          </thead>
           <tbody>
            <tr>
            <td>Vector</td>
            <td> <div class="dvect_td"> </div> </td>
          @permission('file.price.dashboard')           
            <td><div class="dvectprice_td"></div></td>
          @endpermission
            </tr>
             <tr>
              <td>Digitize</td>
              <td> <div class="ddigi_td"> </div> </td>

          @permission('file.price.dashboard')       
                <td><div class="ddigiprice_td"> </div></td>
          @endpermission    
            </tr>
            <tr>
              <td>Image Editing</td>
              <td> <div class="dphoto_td"> </div> </td>
          @permission('file.price.dashboard')        
                <td><div class="dphotoprice_td"> </div></td>
          @endpermission
            </tr>
           
            
            <tr>
              <td>Approved:</td>
              <td><div class="dapprov_td"></div></td>
            @permission('file.price.dashboard') 
              <td><div class="dapprovprice_td" ></div></td>
            @endpermission  
            </tr>
            <tr>
              <td>Alloted:</td>

              <td><div class="dallot_td"> </div> </td>
            @permission('file.price.dashboard') 
              <td><div class="dallotprice_td"> </div></td>
            @endpermission  
            </tr>
            <tr>
              <td>QC-Pending:</td>
              <td><div class="dqcpend_td"></div></td>
            @permission('file.price.dashboard') 
              <td><div class="dqcpendprice_td" ></div></td>
            @endpermission
              
            </tr>
            <tr>
              <td>QC Ok:</td>
              <td><div class="dqcok_td"></div></td>
            @permission('file.price.dashboard') 
              <td><div class="dqcokprice_td" ></div></td>
            @endpermission 
            </tr>
            <tr>
              <td>Vect.Compl.:</td>
              <td><div class="dcompvect_td"></div></td>
            @permission('file.price.dashboard')  
              <td><div class="dcompvectprice_td" ></div></td>
            @endpermission  
            </tr>
            <tr>
              <td>Digit.Compl.:</td>
              <td><div class="dcompdigit_td"></div></td>
            @permission('file.price.dashboard')
              <td><div class="dcompdigitprice_td" ></div></td>
            @endpermission  
            </tr>
           
            <tr>
              <td>Tot. Completed:</td>
              <td><div class="dcompl_td"></div></td>
            @permission('file.price.dashboard')
              <td><div class="dcomplprice_td" ></div></td>
            @endpermission   
            </tr>
            
           </tbody>
            
          </table>
      
  </div>

    </div>

    <!--  NEW BOX -->

     <div class="col-sm-4 col-lg-4">

     <div class="dash-unit">
          <dtitle class="boldtext">Daily Status (US Yesterday) <span  class="dmm"> </span> </dtitle>
           <hr>
          <table class="table table-bordered table-condensed chgtable">
          <thead>
            <th></th>
            <th>Count</th>
          @permission('file.price.dashboard')
            <th>Price</th>
          @endpermission 
          </thead>
           <tbody>
            <tr>
            <td>Vector</td>
            <td> <div class="dvect"> </div> </td>
          @permission('file.price.dashboard')          
            <td><div class="dvectprice"></div></td>
          @endpermission
            </tr>
            <tr>
              <td>Digitize</td>
              <td> <div class="ddigi"> </div> </td>
          @permission('file.price.dashboard')        
                <td><div class="ddigiprice"> </div></td>
          @endpermission
            </tr>
            <tr>
              <td>Image Editing</td>
              <td> <div class="dphoto"> </div> </td>

          @permission('file.price.dashboard')         
                <td><div class="dphotoprice"> </div></td>
          @endpermission      
            
            </tr>
            <tr>
              <td>Approved:</td>
              <td><div class="dapprov"></div></td>
          @permission('file.price.dashboard') 
              <td><div   class="dapprovprice" ></div></td>
          @endpermission    
            </tr>
            <tr>
              <td>Alloted:</td>
              <td><div class="dallot"> </div> </td>
          @permission('file.price.dashboard')  
              <td><div class="dallotprice"> </div></td>
          @endpermission
            </tr>
            
            <tr>
              <td>QC-Pending:</td>
              <td><div class="dqcpend"></div></td>
          @permission('file.price.dashboard')  
              <td><div   class="dqcpendprice" ></div></td>
          @endpermission    
            </tr>
            <tr>
              <td>QC Ok:</td>
              <td><div class="dqcok"></div></td>
          @permission('file.price.dashboard') 
              <td><div   class="dqcokprice" ></div></td>
          @endpermission  
            </tr>
            <tr>
              <td>Vect.Compl.:</td>
              <td><div class="dcompvect"></div></td>
          @permission('file.price.dashboard')  
              <td><div   class="dcompvectprice" ></div></td>
          @endpermission     
            </tr>
            <tr>
              <td>Digit.Compl.:</td>
              <td><div class="dcompdigit"></div></td>
          @permission('file.price.dashboard') 
              <td><div   class="dcompdigitprice" ></div></td>
          @endpermission       
            </tr>
           
            <tr>
              <td>Tot. Completed:</td>
              <td><div class="dcompl"></div></td>
          @permission('file.price.dashboard') 
              <td><div   class="dcomplprice" ></div></td>
          @endpermission    
            </tr>
            
           </tbody>
            
          </table>
      
  </div>

    </div>


    <!--  nEW box -->
      </div><!-- /row -->
    
    <!-- inserted middle row for cuurent month data  second ROW -->  

    <div class="row">
   @permission('comp.revenue')
      <div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
          <div class="dash-unit">
      
            <table class="table table-condensed " id="clienttab">
              <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">  {{ $curr_month  }} &nbsp;Top 10 Companies  Revenue </th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach($topclients_curr as $val)
                      <tr>
                       <td>{{ $val->f1 }}</td>
                       <td>{{ $val->f2 }}</td>
                    </tr>
                @endforeach
                 
              </tbody>
            </table>
          
    
      </div><!-- /dash-unit -->
       </div><!-- /span3 -->
    @endpermission
    @permission('comp.filecount')
       <!-- second column -->
         <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
         
            <table class="table table-condensed " id="clienttab">
              <thead>
                  <tr>
                  <th colspan="2" >  {{ $curr_month  }} &nbsp;Top 10 Companies File Count </th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach($topclientsfilecount_curr as $val)
                      <tr>
                       <td>{{ $val->f1 }}</td>
                       <td style="text-align: right">{{ $val->f2 }}</td>
                    </tr>
                @endforeach
                 
              </tbody>
            </table>
       
        
          </div>
        </div>
    @endpermission
    @permission('designer.revenue')
     <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
  
           <table class="table table-condensed">
               <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">{{ $curr_month  }} &nbsp; Top 10 Designer Revenue</th>
                
                </tr>
              </thead>
               <tbody>
                       <?php $i=0 ; ?>
            @foreach($newdesign_c as $key=>$value)
                         
             <tr>
              <td>
                 {{ $key }} 
              </td>
              <td class="rightval">
                {{ number_format((float)$value, 2, '.', '') }}  
              </td>
             </tr>

            <?php   
                             if($i >= 9) {
                              break;
                              } 
                              $i++;

            ?> 
                        

            
            @endforeach
           
            </tbody>
            <tfoot> <tr><td colspan="2"> <span style="color: blue;">Updated on {{ $curr_date  }}</span>
             </td></tr></tfoot>
        </table>
        

          </div>
        </div>
    @endpermission   
    @permission('designer.count')
    <!-- 30 DAYS STATS - CAROUSEL FLEXSLIDER -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          
       
        <table class="table table-condensed">
               <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">{{ $curr_month  }} &nbsp; Top 10 Designer Count</th>
                
                </tr>
              </thead>
               <tbody>
                       <?php $i=0 ; ?>
            @foreach($newdesignf_c as $key=>$value)
                         
             <tr>
              <td>
                 {{ $key }} 
              </td>
              <td class="rightval">
                {{ number_format((float)$value, 2, '.', '') }}  
              </td>
             </tr>

            <?php   
                             if($i >= 9) {
                              break;
                              } 
                              $i++;

            ?> 
                        

            
            @endforeach
            </tbody>
        </table>
     
            
            <hr>
            <br>
            <br>
              
           
      
         
      </div>
        </div>

    @endpermission  

      
    </div>
</div>
    <!--   third row -->     
      
    <!-- Third ROW OF BLOCKS -->   
<div class="row">
    @permission('comp.revenue')
        <div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
          <div class="dash-unit">
        
            <table class="table table-condensed" id="clienttab">
              <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">  {{ $prv_month  }} &nbsp;Top 10 Companies  Revenue </th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach($topclients as $val)
                      <tr>
                       <td>{{ $val->f1 }}</td>
                       <td>{{ $val->f2 }}</td>
                    </tr>
                @endforeach
                 
              </tbody>
            </table>
          
   
      </div><!-- /dash-unit -->
       </div><!-- /span3 -->
    @endpermission 
    @permission('comp.filecount')
    <!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          
         
              <table class="table table-condensed" id="clienttab">
              <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">  {{ $prv_month  }} &nbsp;Top 10 Companies  File Count </th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach($topclientsfilecount as $val)
                      <tr>
                       <td>{{ $val->f1 }}</td>
                       <td style="text-align: right">{{ $val->f2 }}</td>
                    </tr>
                @endforeach
                 
              </tbody>
            </table>
        
        
           </div>
        </div>
    @endpermission
    @permission('designer.revenue')
    <!-- LAST MONTH REVENUE -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          <table class="table table-condensed">
               <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">{{ $prv_month  }} &nbsp; Top 10 Designer Revenue</th>
                
                </tr>
              </thead>
               <tbody>
                       <?php $i=0 ; ?>
            @foreach($newdesign as $key=>$value)
                         
             <tr>
              <td>
                 {{ $key }} 
              </td>
              <td class="rightval">
                {{ number_format((float)$value, 2, '.', '') }}  
              </td>
             </tr>

            <?php   
                             if($i >= 9) {
                              break;
                              } 
                              $i++;

            ?> 
                        

            
            @endforeach
            </tbody>
        </table>
        

      </div>
        </div>
    @endpermission 
    @permission('designer.count')   
    <!-- 30 DAYS STATS - CAROUSEL FLEXSLIDER -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          
      
        <table class="table table-condensed">
               <thead>
                  <tr>
                  <th colspan="2" style="text-align: center">{{ $prv_month  }} &nbsp; Top 10 Designer Count</th>
                
                </tr>
              </thead>
               <tbody>
                       <?php $i=0 ; ?>
            @foreach($newdesignf as $key=>$value)
                         
             <tr>
              <td>
                 {{ $key }} 
              </td>
              <td class="rightval">
                {{ number_format((float)$value, 2, '.', '') }}  
              </td>
             </tr>

            <?php   
                             if($i >= 9) {
                              break;
                              } 
                              $i++;

            ?> 
                        

            
            @endforeach
            </tbody>
        </table>
        @else
            
            <hr>
            <br>
            <br>
              
           
      
         
          </div>
        </div>
       @endpermission
      </div><!-- /row -->
  </div> <!-- /container -->
  <div id="footerwrap">
        <footer class="clearfix"></footer>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-lg-12">
         
          
            </div>

          </div><!-- /row -->
        </div><!-- /container -->   
  </div><!-- /footerwrap -->
          

@endsection
@section('script') 
<script type="text/javascript">
    $(document).ready(function () {

        $("#btn-blog-next").click(function () {
            $('#blogCarousel').carousel('next')
        });
        $("#btn-blog-prev").click(function () {
            $('#blogCarousel').carousel('prev')
        });

        $("#btn-client-next").click(function () {
            $('#clientCarousel').carousel('next')
        });
        $("#btn-client-prev").click(function () {
            $('#clientCarousel').carousel('prev')
        });

    });

    // $(window).on('load',function () {

    //     $('.flexslider').flexslider({
    //         animation: "slide",
    //         slideshow: true,
    //         start: function (slider) {
    //             $('body').removeClass('loading');
    //         }
    //     });
    // });
  


//   monthly dashboard  vector details
$(document).on('click', 'a.vect', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Vector");
        $("#dailytotalModal2 .filter1").val('Vector');
        //$("#search").val($value);
        var  search  = 'Vector';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});

$(document).on('click', 'a.photo', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Image Editing");
        $("#dailytotalModal2 .filter1").val('Photoshop');
        //$("#search").val($value);
        var  search  = 'Photoshop';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});


// monthly digitize   details
$(document).on('click', 'a.digi', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Digitizing");
        $("#dailytotalModal2 .filter1").val('Digitizing');
        
        //$("#search").val($value);
        var  search  = 'Digitizing';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});

//monthly approve
$(document).on('click', 'a.approv', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Approved");
                $("#dailytotalModal2 .filter1").val('Approved');

        //$("#search").val($value);
        var  search  = 'Approved';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});

//monthly alloted
$(document).on('click', 'a.allot', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Alloted");
                $("#dailytotalModal2 .filter1").val('Alloted');

        //$("#search").val($value);
        var  search  = 'Alloted';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});

//monthly qc pending
$(document).on('click', 'a.qcpend', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- QC-Pending");
                $("#dailytotalModal2 .filter1").val('QC Pending');

        //$("#search").val($value);
        var  search  = 'QC Pending';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});

//monthly qcok
$(document).on('click', 'a.qcok', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- QC-OK");
                $("#dailytotalModal2 .filter1").val('QC OK');

        //$("#search").val($value);
        var  search  = 'QC OK';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});



//monthly qcok
$(document).on('click', 'a.compl', function(){
      // alert('vector click');
        $("#dailytotalModal2").modal('show');
        $("#dailytotalModal2 .modal-title").text("List of Orders- Completed");
                $("#dailytotalModal2 .filter1").val('Completed');

        //$("#search").val($value);
        var  search  = 'Completed';
    
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailysummary') }}",
             data: {"search": search },
            success:function(data)
                  {
                    $("#dailytotal tbody").html(data);
                  }
        
        });
});


$(document).on('click', 'a.bill', function(){
      //alert($(this).text());
      var value  =  $(this).text();
      var filter1 = $("#dailytotalModal2 .filter1").val();
        $("#ModalDailyDetail").modal('show');
        
          
        $.ajax({
            type: "GET",
            cache: false,
            url: "{{ URL::to('dailydetail') }}",
             data: {"search": value , "filter1" : filter1},
            success:function(data)
                  {
                    $("#daily1 tbody").html(data);
                  }
        
        });
});

    

$(".li_key").hover(function() {
  /* Stuff to do when the mouse enters the element */
   $( this ).addClass( "hover" );
   $(".tooltiptext").css({"visibility" :'visible' , "opacity" : 1});
}, function() {
  /* Stuff to do when the mouse leaves the element */
   $( this ).removeClass( "hover" );
   $(".tooltiptext").css("visibility" , 'hidden');
});
      $(".li_key").click(function(event) {
        /* Act on the event */
        $("#UserChangePassword").modal("show");
  
      });


       function totalalFun ()
                {
         //   $.get('https://localhost/omsp/public/totalall',function(data,status) {
         // var url = "{{ url('/ajax/get_discount_code') }}";

        // var url = "{{ url('/totalall') }}";
         //var url1 =  JSON.parse(url);

          $.get("{{ url('/totalall') }}",function(data,status) {
                             console.log(data);
                             var obj = JSON.parse(data);
                             //alert(obj[0]["totvect"]);
                             //var obj = JSON.parse(data);
                             //var obj1 = obj.totdata ;
                             //console.log(obj.totdata);
                            // var obj1 = obj.totdata ;
                            // alert (obj[1]["totdigit"]);
                            //  alert (obj1);
                            var totvect       = obj[0]["totvect"];
                            var totvectprice  = obj[0]["totvectprice"];
                            var totdigit      = obj[1]["totdigit"];
                            var totdigitprice = obj[1]["totdigitprice"];
                            var monthYear     = obj[2]["monthYear"];
                            var totallot      = obj[3]['totallot'];
                            var totallotedprice = obj[3]['totallotedprice']; 
                            var totapprov      = obj[4]['totapprov'];
                            var totapprovprice = obj[4]['totapprovprice']; 
                            var totqcpend      = obj[5]['totqcpend'];
                            var totqcpendprice = obj[5]['totqcpendprice']; 
                            var totqcok      = obj[6]['totqcok'];
                            var totqcokprice = obj[6]['totqcokprice']; 
                            var totcompl      = obj[7]['totcompl'];
                            var totcomplprice = obj[7]['totcomplprice']; 

                            var totphoto       = obj[8]["totphoto"];
                            var totphotoprice  = obj[8]["totphotoprice"];
                          


                            //alert(totdigit);
                            
                            $(".mm").text(monthYear);
                            $(".vect").text(totvect).addClass('boldtext');
                            $(".vectprice").text(totvectprice).addClass('boldtext');
                            $(".digi").text(totdigit).addClass('boldtext');
                            $(".digiprice").text(totdigitprice).addClass('boldtext');

                            $(".photo").text(totphoto).addClass('boldtext');
                            $(".photoprice").text(totphotoprice).addClass('boldtext');
                           

                            $(".allot").text(totallot).addClass('boldtext');
                            $(".allotprice").text(totallotedprice).addClass('boldtext');

                            $(".qcok").text(totqcok).addClass('boldtext');
                            $(".qcokprice").text(totqcokprice).addClass('boldtext');

                            $(".qcpend").text(totqcpend).addClass('boldtext');
                            $(".qcpendprice").text(totqcpendprice).addClass('boldtext');

                          

                            $(".approv").text(totapprov).addClass('boldtext');
                            $(".approvprice").text(totapprovprice).addClass('boldtext');
                            $(".compl").text(totcompl).addClass('boldtext');
                            $(".complprice").text(totcomplprice).addClass('boldtext');

                                },'html');  
                     }
                     setInterval(totalalFun, 9000);   
                      
            
            function pendingorderFun ()
                {
                   //var url1 = "{{ url('/pendingorder') }}";
                   $.get("{{ url('/pendingorder') }}",function(data,status) {  

                                 console.log(data);
                   },'json');  
                     }
            setInterval(pendingorderFun, 3600000); 

            function dailytotaltodayFun()
                {
                   // var url2 = "{{ url('/dailytotaltoday') }}";
                   //$.get('http://192.168.0.30/dailytotaltoday',function(data,status) {  
           
           @role('Designer')
                    $.get("{{ url('/dailytotaltoday_d') }}",function(data,status) {
                                 console.log(data);
                                  var obj = JSON.parse(data);
                             //alert(obj[0]["totvect"]);
                             //var obj = JSON.parse(data);
                             //var obj1 = obj.totdata ;
                             //console.log(obj.totdata);
                            // var obj1 = obj.totdata ;
                            // alert (obj[1]["totdigit"]);
                            //  alert (obj1);
                            var dtotvect       = obj[0]["dtotvect"];
                            var dtotvectprice  = obj[0]["dtotvectprice"];
                            var dtotdigit      = obj[1]["dtotdigit"];
                            var dtotdigitprice = obj[1]["dtotdigitprice"];
                            var dmonthYear     = obj[2]["dmonthYear"];
                            var dtotallot      = obj[3]['dtotallot'];
                            var dtotallotedprice = obj[3]['dtotallotedprice']; 
                            var dtotapprov      = obj[4]['dtotapprov'];
                            var dtotapprovprice = obj[4]['dtotapprovprice']; 
                            var dtotqcpend      = obj[5]['dtotqcpend'];
                            var dtotqcpendprice = obj[5]['dtotqcpendprice']; 
                            var dtotqcok      = obj[6]['dtotqcok'];
                            var dtotqcokprice = obj[6]['dtotqcokprice']; 

                            var dtotcompl      = obj[7]['dcompl'];
                            var dtotcomplprice = obj[7]['dtotcomplprice']; 

                          
                var dcompvect      = obj[8]["dcompvect"];
                            var dcompvectprice = obj[8]["dcompvectprice"];

                            var dcompdigit      = obj[9]["dcompdigit"];
                            var dcompdigitprice = obj[9]["dcompdigitprice"];

                            var dtotphoto      = obj[10]["dtotphoto"];
                            var dtotphotoprice = obj[10]["dtotphotoprice"];


                           
                            
                            $(".dmm_td").text(dmonthYear);
                            $(".dvect_td").text(dtotvect).addClass('boldtext');
                            $(".dvectprice_td").text(dtotvectprice).addClass('boldtext');

                             $(".dphoto_td").text(dtotphoto).addClass('boldtext');
                            $(".dphotoprice_td").text(dtotphotoprice).addClass('boldtext');
                          
                           
                            $(".ddigi_td").text(dtotdigit).addClass('boldtext');
                            $(".ddigiprice_td").text(dtotdigitprice).addClass('boldtext');

                            $(".dallot_td").text(dtotallot).addClass('boldtext');
                            $(".dallotprice_td").text(dtotallotedprice).addClass('boldtext');

                            $(".dqcok_td").text(dtotqcok).addClass('boldtext');
                            $(".dqcokprice_td").text(dtotqcokprice).addClass('boldtext');

                            $(".dqcpend_td").text(dtotqcpend).addClass('boldtext');
                            $(".dqcpendprice_td").text(dtotqcpendprice).addClass('boldtext');

                          

                            $(".dapprov_td").text(dtotapprov).addClass('boldtext');
                            $(".dapprovprice_td").text(dtotapprovprice).addClass('boldtext');

                           

                            
                            $(".dcompvect_td").text(dcompvect).addClass('boldtext');
                            $(".dcompvectprice_td").text(dcompvectprice).addClass('boldtext');


              $(".dcompdigit_td").text(dcompdigit).addClass('boldtext');
                            $(".dcompdigitprice_td").text(dcompdigitprice).addClass('boldtext');

                            $(".dcompl_td").text(dtotcompl).addClass('boldtext');
                            $(".dcomplprice_td").text(dtotcomplprice).addClass('boldtext');




                   },'html');  
           
           @else
               $.get("{{ url('/dailytotaltoday') }}",function(data,status) {
                                 console.log(data);
                                  var obj = JSON.parse(data);
                             //alert(obj[0]["totvect"]);
                             //var obj = JSON.parse(data);
                             //var obj1 = obj.totdata ;
                             //console.log(obj.totdata);
                            // var obj1 = obj.totdata ;
                            // alert (obj[1]["totdigit"]);
                            //  alert (obj1);
                            var dtotvect       = obj[0]["dtotvect"];
                            var dtotvectprice  = obj[0]["dtotvectprice"];
                            var dtotdigit      = obj[1]["dtotdigit"];
                            var dtotdigitprice = obj[1]["dtotdigitprice"];
                            var dmonthYear     = obj[2]["dmonthYear"];
                            var dtotallot      = obj[3]['dtotallot'];
                            var dtotallotedprice = obj[3]['dtotallotedprice']; 
                            var dtotapprov      = obj[4]['dtotapprov'];
                            var dtotapprovprice = obj[4]['dtotapprovprice']; 
                            var dtotqcpend      = obj[5]['dtotqcpend'];
                            var dtotqcpendprice = obj[5]['dtotqcpendprice']; 
                            var dtotqcok      = obj[6]['dtotqcok'];
                            var dtotqcokprice = obj[6]['dtotqcokprice']; 

                            var dtotcompl      = obj[7]['dcompl'];
                            var dtotcomplprice = obj[7]['dtotcomplprice']; 

                          
                var dcompvect      = obj[8]["dcompvect"];
                            var dcompvectprice = obj[8]["dcompvectprice"];

                            var dcompdigit      = obj[9]["dcompdigit"];
                            var dcompdigitprice = obj[9]["dcompdigitprice"];

                            var dtotphoto      = obj[10]["dtotphoto"];
                            var dtotphotoprice = obj[10]["dtotphotoprice"];


                           
                            
                            $(".dmm_td").text(dmonthYear);
                            $(".dvect_td").text(dtotvect).addClass('boldtext');
                            $(".dvectprice_td").text(dtotvectprice).addClass('boldtext');

                             $(".dphoto_td").text(dtotphoto).addClass('boldtext');
                            $(".dphotoprice_td").text(dtotphotoprice).addClass('boldtext');
                          
                           
                            $(".ddigi_td").text(dtotdigit).addClass('boldtext');
                            $(".ddigiprice_td").text(dtotdigitprice).addClass('boldtext');

                            $(".dallot_td").text(dtotallot).addClass('boldtext');
                            $(".dallotprice_td").text(dtotallotedprice).addClass('boldtext');

                            $(".dqcok_td").text(dtotqcok).addClass('boldtext');
                            $(".dqcokprice_td").text(dtotqcokprice).addClass('boldtext');

                            $(".dqcpend_td").text(dtotqcpend).addClass('boldtext');
                            $(".dqcpendprice_td").text(dtotqcpendprice).addClass('boldtext');

                          

                            $(".dapprov_td").text(dtotapprov).addClass('boldtext');
                            $(".dapprovprice_td").text(dtotapprovprice).addClass('boldtext');

                           

                            
                            $(".dcompvect_td").text(dcompvect).addClass('boldtext');
                            $(".dcompvectprice_td").text(dcompvectprice).addClass('boldtext');


              $(".dcompdigit_td").text(dcompdigit).addClass('boldtext');
                            $(".dcompdigitprice_td").text(dcompdigitprice).addClass('boldtext');

                            $(".dcompl_td").text(dtotcompl).addClass('boldtext');
                            $(".dcomplprice_td").text(dtotcomplprice).addClass('boldtext');




                   },'html');  
           
                  @endrole
           }
                    setInterval(dailytotaltodayFun, 9000); 

            function dailytotalFun ()
                {
              
   //$.get('https://localhost/omsp/public/dailytotal',function(data,status) {
   // $.get('http://localhost:82/omslaravel56/public/dailytotal',function(data,status) {
      //var  url3 = {{ url('/dailytotal')   }};
     // url33 = JSON.parse(url3);
      //$.get('http://192.168.0.30/dailytotal',function(data,status) {
       
     
          @role('Designer')
                             
               
         $.get("{{ url('/dailytotal_d')   }}", function(data,status) {
                             console.log(data);
                             var obj = JSON.parse(data);
                             //alert(obj[0]["totvect"]);
                             //var obj = JSON.parse(data);
                             //var obj1 = obj.totdata ;
                             //console.log(obj.totdata);
                            // var obj1 = obj.totdata ;
                            // alert (obj[1]["totdigit"]);
                            //  alert (obj1);
                            var dtotvect       = obj[0]["dtotvect"];
                            var dtotvectprice  = obj[0]["dtotvectprice"];
                            var dtotdigit      = obj[1]["dtotdigit"];
                            var dtotdigitprice = obj[1]["dtotdigitprice"];
                            var dmonthYear     = obj[2]["dmonthYear"];
                            var dtotallot      = obj[3]['dtotallot'];
                            var dtotallotedprice = obj[3]['dtotallotedprice']; 
                            var dtotapprov      = obj[4]['dtotapprov'];
                            var dtotapprovprice = obj[4]['dtotapprovprice']; 
                            var dtotqcpend      = obj[5]['dtotqcpend'];
                            var dtotqcpendprice = obj[5]['dtotqcpendprice']; 
                            var dtotqcok      = obj[6]['dtotqcok'];
                            var dtotqcokprice = obj[6]['dtotqcokprice']; 

                            var dtotcompl      = obj[7]['dcompl'];
                            var dtotcomplprice = obj[7]['dtotcomplprice']; 

                          
                var dcompvect      = obj[8]["dcompvect"];
                            var dcompvectprice = obj[8]["dcompvectprice"];

                            var dcompdigit      = obj[9]["dcompdigit"];
                            var dcompdigitprice = obj[9]["dcompdigitprice"];

                            var appr_us_vect      = obj[10]["appr_us_vect"];
                            //var dcompdigitprice = obj[10]["dtotvectprice"];

                            var appr_ind_vect      = obj[11]["appr_ind_vect"];
                            //var dcompdigitprice = obj[11]["dtotvectprice"]; 
                             var dphoto       = obj[0]["dphoto"];
                            var dphotoprice  = obj[0]["dphotoprice"];
                            


                                 //alert(totdigit);
                            
                            $(".dmm").text(dmonthYear);
                            $(".dphoto").text(dphoto).addClass('boldtext');
                            $(".dphotoprice").text(dphotoprice).addClass('boldtext');
                          
                            $(".dvect").text(dtotvect).addClass('boldtext');
                            $(".dvectprice").text(dtotvectprice).addClass('boldtext');
                            $(".appusvect").text(appr_us_vect).addClass('boldtext');
                            $(".appindvect").text(appr_ind_vect).addClass('boldtext');
                            $(".ddigi").text(dtotdigit).addClass('boldtext');
                            $(".ddigiprice").text(dtotdigitprice).addClass('boldtext');

                            $(".dallot").text(dtotallot).addClass('boldtext');
                            $(".dallotprice").text(dtotallotedprice).addClass('boldtext');

                            $(".dqcok").text(dtotqcok).addClass('boldtext');
                            $(".dqcokprice").text(dtotqcokprice).addClass('boldtext');

                            $(".dqcpend").text(dtotqcpend).addClass('boldtext');
                            $(".dqcpendprice").text(dtotqcpendprice).addClass('boldtext');

                          

                            $(".dapprov").text(dtotapprov).addClass('boldtext');
                            $(".dapprovprice").text(dtotapprovprice).addClass('boldtext');

                           

                            
                            $(".dcompvect").text(dcompvect).addClass('boldtext');
                            $(".dcompvectprice").text(dcompvectprice).addClass('boldtext');


              $(".dcompdigit").text(dcompdigit).addClass('boldtext');
                            $(".dcompdigitprice").text(dcompdigitprice).addClass('boldtext');

                            $(".dcompl").text(dtotcompl).addClass('boldtext');
                            $(".dcomplprice").text(dtotcomplprice).addClass('boldtext');

                                },'html');

@else
          $.get("{{ url('/dailytotal')   }}", function(data,status) {
                             console.log(data);
                             var obj = JSON.parse(data);
                             //alert(obj[0]["totvect"]);
                             //var obj = JSON.parse(data);
                             //var obj1 = obj.totdata ;
                             //console.log(obj.totdata);
                            // var obj1 = obj.totdata ;
                            // alert (obj[1]["totdigit"]);
                            //  alert (obj1);
                            var dtotvect       = obj[0]["dtotvect"];
                            var dtotvectprice  = obj[0]["dtotvectprice"];
                            var dtotdigit      = obj[1]["dtotdigit"];
                            var dtotdigitprice = obj[1]["dtotdigitprice"];
                            var dmonthYear     = obj[2]["dmonthYear"];
                            var dtotallot      = obj[3]['dtotallot'];
                            var dtotallotedprice = obj[3]['dtotallotedprice']; 
                            var dtotapprov      = obj[4]['dtotapprov'];
                            var dtotapprovprice = obj[4]['dtotapprovprice']; 
                            var dtotqcpend      = obj[5]['dtotqcpend'];
                            var dtotqcpendprice = obj[5]['dtotqcpendprice']; 
                            var dtotqcok      = obj[6]['dtotqcok'];
                            var dtotqcokprice = obj[6]['dtotqcokprice']; 

                            var dtotcompl      = obj[7]['dcompl'];
                            var dtotcomplprice = obj[7]['dtotcomplprice']; 

                          
                var dcompvect      = obj[8]["dcompvect"];
                            var dcompvectprice = obj[8]["dcompvectprice"];

                            var dcompdigit      = obj[9]["dcompdigit"];
                            var dcompdigitprice = obj[9]["dcompdigitprice"];

                            var appr_us_vect      = obj[10]["appr_us_vect"];
                            //var dcompdigitprice = obj[10]["dtotvectprice"];

                            var appr_ind_vect      = obj[11]["appr_ind_vect"];
                            //var dcompdigitprice = obj[11]["dtotvectprice"]; 
                             var dphoto       = obj[0]["dphoto"];
                            var dphotoprice  = obj[0]["dphotoprice"];
                            


                                 //alert(totdigit);
                            
                            $(".dmm").text(dmonthYear);
                            $(".dphoto").text(dphoto).addClass('boldtext');
                            $(".dphotoprice").text(dphotoprice).addClass('boldtext');
                          
                            $(".dvect").text(dtotvect).addClass('boldtext');
                            $(".dvectprice").text(dtotvectprice).addClass('boldtext');
                            $(".appusvect").text(appr_us_vect).addClass('boldtext');
                            $(".appindvect").text(appr_ind_vect).addClass('boldtext');
                            $(".ddigi").text(dtotdigit).addClass('boldtext');
                            $(".ddigiprice").text(dtotdigitprice).addClass('boldtext');

                            $(".dallot").text(dtotallot).addClass('boldtext');
                            $(".dallotprice").text(dtotallotedprice).addClass('boldtext');

                            $(".dqcok").text(dtotqcok).addClass('boldtext');
                            $(".dqcokprice").text(dtotqcokprice).addClass('boldtext');

                            $(".dqcpend").text(dtotqcpend).addClass('boldtext');
                            $(".dqcpendprice").text(dtotqcpendprice).addClass('boldtext');

                          

                            $(".dapprov").text(dtotapprov).addClass('boldtext');
                            $(".dapprovprice").text(dtotapprovprice).addClass('boldtext');

                           

                            
                            $(".dcompvect").text(dcompvect).addClass('boldtext');
                            $(".dcompvectprice").text(dcompvectprice).addClass('boldtext');


              $(".dcompdigit").text(dcompdigit).addClass('boldtext');
                            $(".dcompdigitprice").text(dcompdigitprice).addClass('boldtext');

                            $(".dcompl").text(dtotcompl).addClass('boldtext');
                            $(".dcomplprice").text(dtotcomplprice).addClass('boldtext');

                                },'html');  
      
                 
                
                           
           @endrole      
    }
           
             setInterval(dailytotalFun, 9000);     
                  
</script>    
@endsection