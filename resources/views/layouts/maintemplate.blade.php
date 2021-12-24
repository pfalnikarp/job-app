<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <meta name="user-id" content="{{ Auth::user()->id }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!--  link script added on 02--08-21  -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css" rel="stylesheet"
          type="text/css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css">

    <!--  toastr css -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- style added by divyaraj copied by prashant on 19-08-21-->
    <link href="{{ asset('assets/choice.css') }}" rel="stylesheet"/>
    <!--  link script added on 02-08-21 -->
    <style type="text/css">


        .form-control2 {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            color: #565656;
            padding: 3px 0px 3px 3px;
            height: 70px;

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

        .rightdiv {
            float: right;
        }


        .btn-primary {
            background-color: #578af7;
        }

        .btn-danger {
            background-color: #fa1825;
        }

        .btn-info {
            background-color: #28b3c9;
        }

        .btn-warning {
            color: white;
        }

        table#roles th {

            text-align: center;

        }

        table#roles td {
            text-align: center;
            border: 1px solid black;


        }

        /* <!--  style added by prashant for notification notify.js from http://bootstrap-notify.remabledesigns.com/-->*/

        .alert-minimalist {
            /* background-color: rgb(241, 242, 240);*/
            background-color: rgb(255, 255, 238);
            border-color: rgba(149, 149, 149, 0.3);
            border-radius: 3px;
            color: rgb(149, 149, 149);
            padding: 10px;
        }

        .alert-minimalist > [data-notify="icon"] {
            height: 50px;
            margin-right: 12px;
        }

        .alert-minimalist > [data-notify="title"] {
            color: rgb(51, 51, 51);
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .alert-minimalist > [data-notify="message"] {
            font-size: 80%;
            color: blue;
            font-weight: bold;
        }

        /*  notificatoin css added on 12-09-21 */

        .note-scroll {
            height: 200px;
            overflow-y: scroll;
        }

        .notification-box {
            list-style-type: none;
        }

        #close-btn {
            position: absolute;
            background: #fff;
            border: 2px solid #999;
            color: #555;
            border-radius: 12px;
            height: 25px;
            width: 25px;
            padding: 1px;
            top: -10px;
            right: -10px;
            box-shadow: 2px 2px 10px #555;
            font-weight: bold;
            cursor: pointer;
        }


        /* .select2-container {
           min-width: 300px;
         }*/
        /*  css  for  vue js multi select */
        /*.multiselect {
          height: 200px;
          overflow: scroll;
        }*/

        /*
    .multiselect__tag {
      background-color: #bfbfbf;
    }

    .multiselect__option--disabled{
      background: purple;
      color: white;
      font-style: italic;
    }

    .multiselect__option--highlight {
      background: #bfbfbf;
    }

    .multiselect__content {
       background: #D5DBDB;
    }
    */

        /*  style added below for group user table css */

        #grouptable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        #grouptable td, #grouptable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #grouptable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #grouptable tr:hover {
            background-color: #ddd;
        }

        #grouptable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }


        /* style added above on 25-oct-21 for group user table css */

        td.fstat {
            vertical-align: middle;
        }

    </style>
    <!-- style added by divyaraj -->


    @yield('third_party_stylesheets')

    @stack('page_css')

    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div id="app" class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <!--  <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
             </li>
         </ul>  commented this link  for navbar and top bar menu as per discussion with divyaraj on 21-06-21-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                                                                                     id="minimizeSidebarcos"></i></a>
            </li>
            <li class="nav-item mt-2">
                @if(isset($clientpage))
                    @permission('client.create')
                    <a href="{{route('clients.create',['id'=>'noid'])}}">Create Client</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-2 ml-5" id="delsession"
                       data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh"
                                                                                           aria-hidden="true"></i></a>

                    @endpermission
                @endif

                @if(isset($grouppage))

                        <a href="/groupmenu">Groups</a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-4 ml-5" id="delsession"
                           data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh"
                                                                                               aria-hidden="true"></i></a>

                @endif

                @if(isset($orderpage))
                    @permission('order.create')
                    <a href="{{route('orders.create',['id'=>'noid'])}}">Create Order</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-4 ml-5" id="delsession"
                       data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh"
                                                                                           aria-hidden="true"></i></a>
                    @endpermission
                @endif
                @if(isset($orderpageedit))
                    @permission('show.delay.vector')
                    <a href="#" class="btn btn-info btn-outline delayorderv mr-2 ml-3" title="Delay Orders Vectors">DV
                        <span id="delayordersvcount"></span></a>
                    @endpermission
                    @permission('show.delay.photoshop')
                    <a href="#" class="btn btn-success delayorderp btn-outline mr-2 ml-3"
                       title="Delay Orders Photoshop ">DP <span id="delayorderspcount"></span></a>
                    @endpermission

                    @permission('show.delay.digitizing')
                    <a href="#" class="btn btn-warning delayorderd btn-outline mr-2 ml-3"
                       title="Delay Orders Digitizing">DD
                        <span id="delayordersdcount"></span></a>
                    @endpermission
                    @permission('show.company.count')
                    <a href="#" class="btn btn-primary btn-outline todayscompany mr-2 ml-3" title="company count">CC
                        <span id="todayscompanycount"></span></a>
                    @endpermission

                    <a href="#" class="btn btn-primary btn-outline thismonthcompany mr-2 ml-3" title="company count">New
                        CO <span id="thismonthcompanycount"></span></a>

                @endif
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <a class="opennotify" href="#">
                <bell></bell>
            </a>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('img/person-icon.png')}}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{asset('img/person-icon.png')}}"
                             class="img-circle elevation-2"
                             alt="User Image">
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

@include('pages.notifications.edit-notifications')

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


<!-- <script src="{{ mix('js/app.js') }}" ></script> -->

<script src="{{ asset('js/app.js?version='.date("ymdhis").'') }}"></script>


<!--  script code added on 02-08-21 -->
<!-- <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script> -->

<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 -->


<!-- datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>
<!-- script added by divyaraj for date -->

<script src="{{asset('assets/choice.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>


<!-- script added by divyaraj for date -->


<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<!--  Sweet Alert  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"
        type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<!-- datatables-->

<!--  script code added on 02-08-21 -->


@yield('third_party_scripts')

@yield('script')

@stack('page_scripts')

</body>
<script>
    window.laravel_echo_port = '{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/bootstrap-notify.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    var i = 0;
    // window.Echo.channel('user-channel')
    //  .listen('.UserEvent', (data) => {
    //     i++;
    //     $("#notification").append('<div class="alert alert-success">'+i+'.'+data.title+'</div>');
    //     var mess1 =  data.title;
    //     // $.notify({
    //     //            icon: 'glyphicon glyphicon-star',
    //     //            message: mess1
    //     //     });

    //          Notification.requestPermission( permission => {
    //       let notification = new Notification('New post alert!', {
    //         body: mess1, // content for the alert
    //         icon: "http://localhost/img/invoicepng.png" // // optional image url
    //       });


    // });
    //      });
</script>

<script>
    window.Laravel = {!! json_encode([
        'user' => auth()->check() ? auth()->user()->id : null,
          'username' => auth()->check() ? auth()->user()->name : null,
    ]) !!};

    //alert(window.Laravel.user);
</script>
<script type="text/javascript">

    function showNotification() {
        const notification = new Notification('NEW MESSAGE INCOMING', {
            body: 'hi, how you are doing',
            url: 'https://codeseven.github.io/toastr/demo.html',
            icon: 'https://randomuser.me/api/portraits/med/men/77.jpg'
        })
    }


    function showNotification1(title1, mess1, url1) {
        const notification = new Notification(title1, {
            body: mess1,
            url: url1,
            icon: 'https://randomuser.me/api/portraits/med/men/77.jpg'
        })
    }

    console.log(Notification.permission);

    if (Notification.permission === 'granted') {
        showNotification();
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(permission => {
            if (permission == 'granted') {
                showNotification();
            }
        })
    }

</script>

<script type="text/javascript">
    //var userId = 1;


    //  Echo.private('App.User.1')
    // window.Echo.private('App.Models.User.' + window.Laravel.user)
    // .notification((notification) => {
    //     console.log('hello');
    //     console.log(notification.order_id);
    // });

    // Echo.private('groups.' + window.Laravel.user)
    // .notification((notification) => {
    //     console.log('hello');
    //     console.log(notification.order_id);
    // });

    //  Echo.channel('private-users.' +  window.Laravel.user)
    //   // Echo.channel('private-groups.' + this.group.id)
    //   //  Echo.channel('groups.' + window.Laravel.user)
    // .notification((notification) => {
    //     console.log('hello');
    //     console.log(notification.order_id);
    //      var mess1 = notification.order_id + window.Laravel.username;
    //         $.notify({
    //                    icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
    //                    message: mess1
    //             });
    // });


    // Echo.channel('private-users.' +   window.Laravel.user)
    window.Echo.private('App.Models.User.' + window.Laravel.user)
        .notification((notification) => {
            console.log('hello');
            console.log(notification);
            //var mess1 = notification.order_id + window.Laravel.username;
            var mess1 = notification.detail;
            var url1 = notification.url;
            var title1 = notification.title;
            var footer1 = notification.footer;
            dangerClick(mess1, url1, title1, footer1);
            // showNotification1( title1, mess1, url1);

        });


    var dangerClick = function (mess1, url1, title1, footer1) {
        $.notify({
            // options
            title: '<strong>' + title1 + '</strong><br>',
            url: url1,
            message: mess1 + '\n' + footer1,
            // icon: 'https://randomuser.me/api/portraits/med/men/77.jpg'
            icon: 'http://job-app.com/img/logo-dark.png'
        }, {
            // settings
            element: 'body',
            position: null,
            type: "minimalist",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "bottom",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            //autoHideDelay: 50000,
            //hideDuration: 700,
            delay: 33000,
            //timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated flipInY',
                exit: 'animated flipOutX'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'img',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    }

    $(document).ready(function () {
        $("#minimizeSidebarcos").on('click', function () {

            $.ajax({

                type: "GET",
                url: '{{url('maxminsidebar')}}',
                success: function (data) {


                }
            });
        });

        $(document).on('click', "a.opennotify", function (e) {
            //debugger;
            e.preventDefault();
            $('#editmodalwindow').modal('show');
        });

    });


</script>


</html>
