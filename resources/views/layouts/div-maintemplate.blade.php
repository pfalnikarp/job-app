<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!--  link script added on 02--08-21  -->

      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <link href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" >

   <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"> 


     <!--  toastr css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{ asset('assets/choice.css') }}" rel="stylesheet" />

   <!--  link script added on 02-08-21 -->
<style type="text/css">
  

  .form-control2 {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
     padding: 3px 0px 3px 3px;
    height:70px;

    -webkit-box-shadow: none;
    box-shadow: none;
}
  .form-control3 {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
    padding: 3px 0px 3px 3px;
  
    -webkit-box-shadow: none;
    box-shadow: none;
}
 .rightdiv{
           float: right;
        }


    .btn-primary {
        background-color:#578af7;  
    }
    .btn-danger {
        background-color:#fa1825;  
    }
    .btn-info {
        background-color:#28b3c9;  
    }
    .btn-warning{
        color:white;  
    }
    table#roles th {

         text-align: center;

    }
    table#roles  td{
        text-align: center;
        border: 1px solid black;

  
    }

</style>
  @php 
         $d=\App\User::select('color','ext')->where('id',Auth::user()->id)->get();
          foreach($d as $v){
               $sidebarm=$v->ext;
       }
  @endphp
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed {{$sidebarm}}">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" id="minimizeSidebarcos"></i></a>
            </li>
            <li class="nav-item mt-2">
                 @if(isset($clientpage)) 
                      @permission('client.create')  
                        <a href="{{route('clients.create',['id'=>'noid'])}}">Create Client</a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-2 ml-5"  id="delsession" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                        @endpermission
                 @endif
                 @if(isset($orderpage))
                 @permission('order.create')
                           <a href="{{route('orders.create',['id'=>'noid'])}}">Create Order</a>
                           <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-4 ml-5"  id="delsession" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                 @endpermission
                 @endif
             @if(isset($orderpageedit))
                 @permission('show.delay.vector')
                       <a href="#" class="btn btn-info btn-outline delayorderv mr-2 ml-3"  title="Delay Orders Vectors">DV <span id="delayordersvcount"></span></a>
      @endpermission
      @permission('show.delay.photoshop')
                       <a href="#" class="btn btn-success delayorderp btn-outline mr-2 ml-3" title="Delay Orders Photoshop ">DP <span id="delayorderspcount"></span></a>
      @endpermission

      @permission('show.delay.digitizing')
                       <a href="#" class="btn btn-warning delayorderd btn-outline mr-2 ml-3" title="Delay Orders Digitizing">DD
                        <span id="delayordersdcount"></span></a>
      @endpermission
      @permission('show.company.count')
                       <a href="#" class="btn btn-primary btn-outline todayscompany mr-2 ml-3" title="company count">CC <span id="todayscompanycount"></span></a>
      @endpermission 
      
                       <a href="#" class="btn btn-primary btn-outline thismonthcompany mr-2 ml-3" title="company count">New CO <span id="thismonthcompanycount"></span></a>
     
                 @endif
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <!-- <img src="https://infyom.com/images/logo/blue_logo_150x150.jpg"
                         class="user-image img-circle elevation-2" alt="User Image"> -->
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <!-- <img src="https://infyom.com/images/logo/blue_logo_150x150.jpg"
                             class="img-circle elevation-2"
                             alt="User Image"> -->
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content') 
           
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>
</div>


<script src="{{ mix('js/app.js') }}" ></script>



<!--  script code added on 02-08-21 -->
<!-- <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script> -->

<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 -->


<!-- datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>
 <script src="{{asset('assets/choice.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<!--  Sweet Alert  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<!-- datatables-->

<!--  script code added on 02-08-21 -->


@yield('third_party_scripts')

  @yield('script')

@stack('page_scripts')
<script type="text/javascript">
  $(document).ready(function() {
        $("#minimizeSidebarcos").on('click',function(){

             $.ajax({
              
             type:"GET",
             url:'{{url('maxminsidebar')}}',
             success:function(data){
            
                 
            }
          });
        });

  });
</script>

</body>


</html>
