<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title></title>
    <!-- icon added on  14-01-2020 -->
    <link rel="icon" href="{{ URL::asset('img/patterns_icon.png') }}"  type="image/png"> 


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">

   {{--  <link rel="stylesheet" type="text/css" 
     href="{{ URL::asset('themes/SinglePageAdmin/bootstrap/css/bootstrap.min.css') }}" /> --}}


    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('themes/SinglePageAdmin/css/main.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('themes/SinglePageAdmin/css/font-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('themes/SinglePageAdmin/css/flexslider.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}"></script>

{{--     <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/jquery.js') }}"></script>     --}}
  {{-- <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- Removed below javascrip pieece                                                                                                                                                                                                                                                            on 21/06/17 for optimization
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/lineandbars.js') }}"></script>
     --}}
  {{-- <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/dash-charts.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/gauge.js') }}"></script> --}}
  
  <!-- NOTY JAVASCRIPT -->
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/jquery.noty.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/layouts/top.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/layouts/topLeft.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/layouts/topRight.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/layouts/topCenter.js') }}"></script>
  
  <!-- You can add more layouts if you want -->
  <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/noty/themes/default.js') }}"></script>
    <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->
  
  <script src="{{ URL::asset('themes/SinglePageAdmin/js/jquery.flexslider.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ URL::asset('themes/SinglePageAdmin/js/admin.js') }}"></script>
     <script type="text/javascript" src="{{ URL::asset('js/datetimepicker.js') }}"></script>

    <!--  socket notification added -->
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script> 
      
    <style type="text/css">
      body {
        padding-top: 60px;
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


    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   

    <!-- Google Fonts call. Font Used Open Sans & Raleway -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

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

    $(window).load(function () {

        $('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });

</script>    
<style type="text/css">
  

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
  </head>
  <body>
  
    <!-- NAVIGATION MENU -->

    <div class="navbar-nav navbar-inverse navbar-fixed-top">
      <picture>
                  <a class="navbar-brand topnav" href="{{ url ('/') }}"><img  class="logo1" src="{{ URL::asset('img/logo_dark.png') }}" alt="no found"> </a>
      </picture>
         
        <div class="container">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{-- <a class="navbar-brand" href="index.html"><img src="{{ URL::asset('themes/SinglePageAdmin/images/logo30.png') }}" alt=""> User Dashboard</a> --}}
         {{--  <picture>
                  <a class="navbar-brand topnav" href="{{ url ('/') }}"><img  src="{{ URL::asset('img/Untitled-11.png') }}" alt="no found"> </a>
          </picture> --}}
        </div> 
          <div class="navbar-collapse collapse" style="float: right;">
            <ul class="nav navbar-nav">
              <li class="active"><a href="{{ url ('/') }}"><i class="icon-home icon-white"></i> Home</a></li>
            
                @role('super.super.admin')
                    <li>
                        <a href="{{ url ('/monthlytotal') }}">Dashboard</a>
                    </li>
                    <li class="dropdown">
                        <a id="themes" href="#" data-toggle="dropdown" class="dropdown-toggle">Masters <span class="caret"></span></a>
                        <ul aria-labelledby="themes" class="dropdown-menu">
                          
                            <li class="divider"></li>
                            
                            
                        </ul>
                    </li>
                @endrole          

              <li class="dropdown">
                        <a id="themes" href="#" data-toggle="dropdown" class="dropdown-toggle">Clients <span class="caret"></span></a>
                        <ul aria-labelledby="themes" class="dropdown-menu">
                            <li><a href="{{action("ClientController@getIndex") }}">Clients</a></li>
                            <li class="divider"></li>
                      
                          
                           
                                                     
                        </ul>
                      </li>   

              
               <li class="dropdown">
                         <a id="themes1" href="#" data-toggle="dropdown" class="dropdown-toggle">
                          Transaction
                          <span class="caret"></span></a>
                        <ul aria-labelledby="themes" class="dropdown-menu">
                           <!--  <li><a href="{{action("ClientController@getIndex") }}">Client</a></li> -->
                            <li class="divider"></li>
                             <li> <a href="{{ action("OrderController@index") }}">Orders</a></li>

                       
                              


                         
                           
                        </ul>
                </li>

              @role('admin')
                  {{-- <li><a target="_new" href="{{ action("JasperInvoiceController@istatus") }}"><i class="icon-th icon-white"></i> Orders Status </a></li>
                  <li><a target="_new" href="{{ action("JasperInvoiceController@ostatus") }}"><i class="icon-th icon-white"></i> Orders Status Completed </a></li>
                  <li><a target="_new" href="{{ action("JasperInvoiceController@dtlstatus") }}"><i class="icon-th icon-white"></i> Orders Details</a></li> 
                  
                  
                  <li> <a href="{{ action("JasperInvoiceController@AllReport") }}">Reports &#9662;</a>  </li> 
                    <li><a target="_new" href="{{ action("JasperDailyReportController@DailyReportParameters") }}"><i class="icon-th icon-white"></i> Daily Orders Report</a></li>  
                       <li><a target="_new" href="{{ action("JasperInvoiceController@newclientlist") }}"><i class="icon-th icon-white"></i> Company Wise Client List</a></li>  
                 <li><a target="_new" href="{{ action("JasperInvoiceController@index") }}"><i class="icon-th icon-white"></i> Inv-Date Wise</a></li> 
                     
                  
                <li><a target="_new" href="{{ action("JasperInvoiceController@CheckBoxInv") }}"><i class="icon-th icon-white"></i>Cust-Inv-criteria</a></li>  
               
                        
                 
            <li> <a  href="{{ action("EmailController@getIndex") }}">Campaigns</a>  </li>  --}}
                 
              @endrole
                     

             
              
                <li class="dropdown">
                        <a id="themes1" href="#" data-toggle="dropdown" class="dropdown-toggle">Reports <span class="caret"></span></a>

                        

                        <ul aria-labelledby="themes" class="dropdown-menu">
                            <li><a class="dropdown-submenu" target="_new" href="{{ action("JasperDailyReportController@DailyReportParameters") }}"><i class="icon-th icon-white"></i> Daily Orders Report</a>
                            
                              <!--  
                           <ul class="dropdown-menu1">
                                    <li><a href="#">Second level link</a></li>
                                    <li><a href="#">Second level link</a></li>
                                    <li><a href="#">Second level link</a></li>
                                    <li><a href="#">Second level link</a></li>
                                    <li><a href="#">Second level link</a></li>
                                </ul>

                          -->
                            </li>
                            <li class="divider"></li>
                    @role('core.group')
                            <li><a target="_new" 
                                    href="{{ action("JasperInvoiceController@orderdaterange") }}"><i class="icon-th icon-white"></i>  Orders Date Range Report</a> 
                            </li>
                            <li><a target="_new" 
                                        href="{{ action("JasperInvoiceController@CompanyOrderParam") }}"><i class="icon-th icon-white"></i>Company Who have  Order in this Range(CSV)</a>
                            </li> 
                             <li><a target="_new" 
                                        href="{{ action("JasperInvoiceController@CompanyNotOrderParam") }}"><i class="icon-th icon-white"></i>Company Who have not Order in this Range(CSV) </a>
                            </li> 
                              <li><a target="_new" 
                                    href="{{ action("JasperInvoiceController@CheckBoxInv") }}"><i class="icon-th icon-white"></i>Cust-Inv-criteria</a>
                            </li> 

               @endrole
		                             
                           
                        </ul>
                </li>
                <li class="dropdown">
                        <a id="themes1" href="#" data-toggle="dropdown" class="dropdown-toggle">Support <span class="caret"></span></a>

                       

                        <ul aria-labelledby="themes" class="dropdown-menu">
                            <li><a class="dropdown-submenu" target="_new" href=""><i class="icon-th icon-white"></i> Admin Support</a>
                            
                            
                            </li>
                            <li class="divider"></li>
                            <li><a target="_new" 
                                    href=""><i class="icon-th icon-white"></i>  HR support</a> 
                            </li>
                          
                            <li><a target="_new" 
                                        href=""><i class="icon-th icon-white"></i>IT Support</a>
                            </li> 
                         
                        </ul>
                </li>
              

              <li><a href="{{ url('/logout') }}"><i class="icon-lock icon-white"></i> Logout</a></li>
             

            </ul>
          </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

    <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
            <dtitle>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUser Profile</dtitle>
            <hr>
        <div class="thumbnail">
          <img src="{{ URL::asset('themes/SinglePageAdmin/images/face80x80.jpg') }}" alt="{{ Auth::user()->name }}" class="img-circle">
        </div><!-- /thumbnail -->
        <h1>{{ Auth::user()->name }}</h1>
        
        <br>
          <div class="info-user">
            <span aria-hidden="true" class="li_user fs1"></span>
            <span aria-hidden="true" class="li_settings fs1"></span>
            <span aria-hidden="true" class="li_mail fs1"></span>
            <span aria-hidden="true" class="li_key fs1"><i class="tooltiptext">Change Password</i></span>
            
          </div>
        </div>
        </div>

      <!-- DONUT CHART BLOCK  New Approval status included on 17/05/18 -->
       @role('admin')

      <!--<div class="col-sm-3 col-lg-3">
           <table class="table table-bordered table-condensed chgtable">
          <thead>
            <th></th>
            <th class="dash-unit1">Count</th>
           
          </thead>
           <tbody>
            <tr >
            <td class="dash-unit1" ><b> Vector Approved (Curr.US Date) </b></td>
            <td> <div class="appusvect dash-unit1"> </div> </td>
                     
           
            </tr>
             <tr >
            <td class="dash-unit1" ><b> Vector Approved (Curr.Ind Date) </b></td>
            <td> <div class="appindvect dash-unit1"> </div> </td>
                     
           
            </tr>
            </tbody>
          </table> 


      </div>  -->


       @else
           <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          <dtitle class="boldtext">Designer Status</dtitle>
          <hr>
          
            <div id="load">
            {{-- <h2>45%</h2> --}}
            
            <table class="table">
              <thead>
                  <tr>
                <th colspan="2"><h3>Current Month</h3></th>
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
                  <td colspan="2"><h3>Previous Month</h3></td>
                  
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


       @endrole

       
      <!-- DONUT CHART BLOCK   Monthly status-->
       @if(   Auth::user()->email  == 'anis@patterns.com' ||
              Auth::user()->email  == 'jubbin@patterns.com' ||
              Auth::user()->email  == 'shraddha@patterns.com' ||
              Auth::user()->email  == 'kalyan@patterns.com' ||
              Auth::user()->email  == 'kulind@patterns.com' ||
              Auth::user()->email  == 'tallin@patterns.com' ||
              Auth::user()->email  == 'babul@patterns.com' ||
               Auth::user()->email  == 'pfalnikarp@patterns.com'    )
     
      <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          <dtitle class="boldtext">Monthly Status for the <span class="mm"></span></dtitle>
          
          <hr>
        
          <table class="table table-bordered table-condensed montable">
            <thead>
              <th></th>
              <th>Count</th>
              <th>Price</th>
            </thead>
            <tbody>
            <tr>
              <td>Vector</td>
              <td>  <a class="vect" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="vectprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>Digitize</td>
              <td> <a class="digi" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="digiprice"></div> @endrole </td>
            </tr>
             <tr>
              <td>Image Editing</td>
              <td> <a class="photo" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="photoprice"></div> @endrole </td>
            </tr>
           
            <tr>
              <td>Approved</td>
              <td><a class="approv" href="#"></a><!--  <div class="approv"> </div> --> </td>
                 
            <td>@role('admin') <div class="approvprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>Alloted</td>
              <td><a class="allot" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="allotprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>QC-Pending</td>
              <td><a class="qcpend" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="qcpendprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>QC Ok</td>
              <td><a class="qcok" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="qcokprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>Completed</td>
              <td><a class="compl" href="#"></a>  </td>
                 
            <td>@role('admin') <div class="complprice"></div> @endrole </td>
            </tr>
             </tbody>
          </table>
            
      </div>
        </div>
    @endif
  <!--  Monthly status  end -->      
        
        <div class="col-sm-3 col-lg-3">

     <div class="dash-unit">
          <dtitle class="boldtext">Daily Status (US Today) <span  class="dmm_td"> </span> </dtitle>
          <table class="table table-bordered table-condensed chgtable">
          <thead>
            <th></th>
            <th>Count</th>
            <th>Price</th>
          </thead>
           <tbody>
            <tr>
            <td>Vector</td>
            <td> <div class="dvect_td"> </div> </td>
                     
            <td>@role('admin') <div class="dvectprice_td"></div> @endrole </td>
            </tr>
             <tr>
              <td>Digitize</td>
              <td> <div class="ddigi_td"> </div> </td>

                @role('admin')
                        
                <td><div class="ddigiprice_td"> </div></td>
                
                @endrole
            </tr>
            <tr>
              <td>Image Editing</td>
              <td> <div class="dphoto_td"> </div> </td>

                @role('admin')
                        
                <td><div class="dphotoprice_td"> </div></td>
                
                @endrole
            </tr>
           
            
            <tr>
              <td>Approved:</td>
              <td><div class="dapprov_td"></div></td>
              
              <td>@role('admin')        <div   class="dapprovprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Alloted:</td>
              <td><div class="dallot_td"> </div> </td>
              
              <td>
              @role('admin')
                       
                <div class="dallotprice_td"> </div>
                
                @endrole
                </td>

            </tr>
            <tr>
              <td>QC-Pending:</td>
              <td><div class="dqcpend_td"></div></td>
              
              <td>@role('admin')        <div   class="dqcpendprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>QC Ok:</td>
              <td><div class="dqcok_td"></div></td>
              
              <td>@role('admin')        <div   class="dqcokprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Vect.Compl.:</td>
              <td><div class="dcompvect_td"></div></td>
              
              <td>@role('admin')        <div   class="dcompvectprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Digit.Compl.:</td>
              <td><div class="dcompdigit_td"></div></td>
              
              <td>@role('admin')        <div   class="dcompdigitprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
           
            <tr>
              <td>Tot. Completed:</td>
              <td><div class="dcompl_td"></div></td>
              
              <td>@role('admin')        <div   class="dcomplprice_td" ></div>
                  @endrole
                </td>
              
            </tr>
            
           </tbody>
            
          </table>
      
  </div>

    </div>

    <!--  NEW BOX -->

     <div class="col-sm-3 col-lg-3">

     <div class="dash-unit">
          <dtitle class="boldtext">Daily Status (US Yesterday) <span  class="dmm"> </span> </dtitle>
          <table class="table table-bordered table-condensed chgtable">
          <thead>
            <th></th>
            <th>Count</th>
            <th>Price</th>
          </thead>
           <tbody>
            <tr>
            <td>Vector</td>
            <td> <div class="dvect"> </div> </td>
                     
            <td>@role('admin') <div class="dvectprice"></div> @endrole </td>
            </tr>
            <tr>
              <td>Digitize</td>
              <td> <div class="ddigi"> </div> </td>

                @role('admin')
                        
                <td><div class="ddigiprice"> </div></td>
                
                @endrole
            </tr>
            <tr>
              <td>Image Editing</td>
              <td> <div class="dphoto"> </div> </td>

                @role('admin')
                        
                <td><div class="dphotoprice"> </div></td>
                
                @endrole
            </tr>
            <tr>
              <td>Approved:</td>
              <td><div class="dapprov"></div></td>
              
              <td>@role('admin')        <div   class="dapprovprice" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Alloted:</td>
              <td><div class="dallot"> </div> </td>
              
              <td>
              @role('admin')
                       
                <div class="dallotprice"> </div>
                
                @endrole
                </td>

            </tr>
            
            <tr>
              <td>QC-Pending:</td>
              <td><div class="dqcpend"></div></td>
              
              <td>@role('admin')        <div   class="dqcpendprice" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>QC Ok:</td>
              <td><div class="dqcok"></div></td>
              
              <td>@role('admin')        <div   class="dqcokprice" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Vect.Compl.:</td>
              <td><div class="dcompvect"></div></td>
              
              <td>@role('admin')        <div   class="dcompvectprice" ></div>
                  @endrole
                </td>
              
            </tr>
            <tr>
              <td>Digit.Compl.:</td>
              <td><div class="dcompdigit"></div></td>
              
              <td>@role('admin')        <div   class="dcompdigitprice" ></div>
                  @endrole
                </td>
              
            </tr>
           
            <tr>
              <td>Tot. Completed:</td>
              <td><div class="dcompl"></div></td>
              
              <td>@role('admin')        <div   class="dcomplprice" ></div>
                  @endrole
                </td>
              
            </tr>
            
           </tbody>
            
          </table>
      
  </div>

    </div>


    <!--  nEW box -->
      </div><!-- /row -->
    
    <!-- inserted middle row for cuurent month data  second ROW -->  

    <div class="row">

      <div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
          <div class="dash-unit">
          @role('admin')
            <table class="table table-condensed clienttab" id="clienttab">
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
          
      @endrole
      </div><!-- /dash-unit -->
       </div><!-- /span3 -->

       <!-- second column -->
         <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          {{-- <dtitle>Top 10 Clients</dtitle> --}}
          @role('admin')
              <table class="table table-condensed clienttab" id="clienttab">
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
          @endrole  
        
      </div>
        </div>
    

     <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
       
    
    @role('admin')
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
        @endrole

      </div>
        </div>
        
    <!-- 30 DAYS STATS - CAROUSEL FLEXSLIDER -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          
        @role('admin')
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
        @else
            
            <hr>
            <br>
            <br>
              
           
        @endrole
         
      </div>
        </div>



      
    </div>

    <!--   third row -->     
      
    <!-- Third ROW OF BLOCKS -->   

      <div class="row">
        <div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
          <div class="dash-unit">
          @role('admin')
            <table class="table table-condensed clienttab" id="clienttab">
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
          
      @endrole
      </div><!-- /dash-unit -->
       </div><!-- /span3 -->

    <!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          {{-- <dtitle>Top 10 Clients</dtitle> --}}
          @role('admin')
              <table class="table table-condensed clienttab" id="clienttab">
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
          @endrole  
        
      </div>
        </div>

    <!-- LAST MONTH REVENUE -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
            {{-- <dtitle>Last Month Revenue</dtitle>
            <hr>
            <div class="cont">
          <p><bold>$879</bold> | <ok>Approved</ok></p>
          <br>
          <p><bold>$377</bold> | Pending</p>
          <br>
          <p><bold>$156</bold> | <bad>Denied</bad></p>
          <br>
          <p><img src="{{ URL::asset('themes/SinglePageAdmin/images/up-small.png') }}" alt=""> 12% Compared Last Month</p>

        </div> --}}
        @role('admin')
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
        @endrole

      </div>
        </div>
        
    <!-- 30 DAYS STATS - CAROUSEL FLEXSLIDER -->     
        <div class="col-sm-3 col-lg-3">
          <div class="dash-unit">
          
        @role('admin')
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
              
           
        @endrole
         
      </div>
        </div>
      </div><!-- /row -->
     
 
    <!-- THIRD ROW OF BLOCKS -->     
      <div class="row">
        <div class="col-sm-3 col-lg-3">
    
    <!-- BARS CHART - lineandbars.js file -->     
          

    <!-- TO DO LIST -->     
          
            
                 {{-- <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;"><span class="sr-only">60% Complete</span>
                  
                </div>
             </div> --}}
          
        </div>

        <div class="col-sm-3 col-lg-3">

    <!-- LIVE VISITORS BLOCK -->     
          
          
    <!-- PAGE VIEWS BLOCK -->     
          
        </div>

        <div class="col-sm-3 col-lg-3">
    <!-- TOTAL SUBSCRIBERS BLOCK -->     
          
    <!-- FOLLOWERS BLOCK -->     
          
        </div>

    <!-- LATEST NEWS BLOCK -->     
        <div class="col-sm-3 col-lg-3">
        
        </div>
      </div><!-- /row -->
      
    <!-- FOURTH ROW OF BLOCKS -->     
  <div class="row">
  
    <!-- TWITTER WIDGET BLOCK -->     
    <div class="col-sm-3 col-lg-3">
      
    </div>

    <!-- NOTIFICATIONS BLOCK -->     
    <div class="col-sm-3 col-lg-3">
      
    </div>

    <!-- SWITCHES BLOCK -->     
    <div class="col-sm-3 col-lg-3">
      
    </div>

    <!-- GAUGE CHART BLOCK -->     
    <div class="col-sm-3 col-lg-3">
      {{-- <div class="dash-unit">
            <dtitle>Gauge Chart</dtitle>
            <hr>
            <div class="info-user">
          <span aria-hidden="true" class="li_lab fs2"></span>
        </div>
        <canvas id="canvas" width="300" height="300">
      </canvas></div> --}}
    </div>
  
  </div><!--/row -->     
      
    <!-- FOURTH ROW OF BLOCKS -->     
    <div class="row">

    <!-- ACCORDION BLOCK -->     
      <div class="col-sm-3 col-lg-3">
      </div>
    
      
      <div class="col-sm-3 col-lg-3">

        <!-- LAST USER BLOCK -->     
        
        
        <!-- MODAL BLOCK -->     
        
      </div>
      <!-- Modal -->
      
        <!-- FAST CONTACT BLOCK -->     
      <div class="col-sm-3 col-lg-3">
        
      </div>

        <!-- INFORMATION BLOCK -->     
      <div class="col-sm-3 col-lg-3">
        
            {{-- <div class="info-user">
          <span aria-hidden="true" class="li_display fs2"></span>
        </div> --}}
        
      </div>

    </div><!--/row -->
     
      
      
  </div> <!-- /container -->
  <div id="footerwrap">
        <footer class="clearfix"></footer>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-lg-12">
            {{-- <p><img src="{{ URL::asset('themes/SinglePageAdmin/images/logo.png') }}" alt=""></p> --}}
            <p>Patterns</p>
            </div>

          </div><!-- /row -->
        </div><!-- /container -->   
  </div><!-- /footerwrap -->
          
</body>
@include('pages.orders.modals.total_daily_count')
@include('pages.orders.modals.dashboard_daily_detail')
<!-- change password modal-->
<!-- Modal -->
<div class="modal fade" id="UserChangePassword" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
        @endif
  {!! Form::open(['route'=>'users.changepass', 'id'=>'changepass']) !!}
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalLabel">Change Password</h4>
      </div>
      <div class="modal-body pswd">
        {{-- @include('pages.orders.forms.order') --}}
            <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Password:</strong>

                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control pass')) !!}

            </div>

            </div> 

            <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Confirm Password:</strong>

                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control cpass')) !!}

            </div>

            </div>
      </div>
      <div class="modal-footer">
         <a href="#" id="" class="btn btn-cyan submitpass"><i class="fa fa-flash"></i>&nbsp;Submit</a>
        
       <div class="success"> </div>

  {!! Form::close() !!}
      </div>

    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />


</html>


  <!-- notification toastr code added below -->   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

<script type="text/javascript">

$(document).ready(function() {

    $(".submitpass").click(function(event) {
  
  $id = {{ Auth::user()->id }}
  //alert($id);
  myUrl = "{{ route('users.changepass') }}";

   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

  $pass = $(".pass").val();
  $cpass = $(".cpass").val();

  if($pass != $cpass) {
    alert("Password and not same");
  }
  else {

   $.ajax({

            type: 'POST',
            url:  myUrl,
            data:  {'id' : $id, 'password' : $pass , 'confirm-password' : $cpass },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#UserChangePassword").modal("hide");
            },
            error: function (data) {
                      console.log(data);
             }

    });
   }
  });

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
  

  

//$(function(){

   
setInterval(
            function ()
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
                     }, 9000);   

setInterval(
            function ()
                {
                   //var url1 = "{{ url('/pendingorder') }}";
                   $.get("{{ url('/pendingorder') }}",function(data,status) {  

                                 console.log(data);
                   },'json');  
                     }, 3600000);  


setInterval(
            function ()
                {
                   // var url2 = "{{ url('/dailytotaltoday') }}";
                   //$.get('http://192.168.0.30/dailytotaltoday',function(data,status) {  
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
                     }, 9000);  


setInterval(
            function ()
                {
              
   //$.get('https://localhost/omsp/public/dailytotal',function(data,status) {
   // $.get('http://localhost:82/omslaravel56/public/dailytotal',function(data,status) {
      //var  url3 = {{ url('/dailytotal')   }};
     // url33 = JSON.parse(url3);
      //$.get('http://192.168.0.30/dailytotal',function(data,status) {
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
                     }, 9000);   



//});

});

</script>