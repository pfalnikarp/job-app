
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

   
    <!-- Bootstrap Core CSS -->
    <!--<link rel="stylesheet" href="public/css/bootstrap.min.css" type="text/css">-->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css"> -->
    <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
   
    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="public/css/animate.min.css" type="text/css"> -->
    <link href="{{ URL::asset('css/animate.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- Custom CSS -->
<!--     <link rel="stylesheet" href="public/css/creative.css" type="text/css">
 -->   
    <link href="{{ URL::asset('css/creative.css') }}" rel="stylesheet" type="text/css" >


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
       <title>App Name - @yield('title')</title>

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Fergusion</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- <a class="page-scroll" href="{{ action("CommentController@create") }}">About</a> -->
                        <a class="page-scroll" href="{{ action("CustomerController@index") }}">Customers</a>

                    </li>
                    <li>
                      <!--   <a class="page-scroll" href="#services">Services</a> -->
                        <a class="page-scroll" href="{{ action("ProposalController@create") }}">Proposals</a>
                    </li>
                    <li>
                       <!--  <a class="page-scroll" href="#portfolio">Portfolio</a> -->
                          <a class="page-scroll" href="#quotation">Quotation</a>
                    </li>
                    <li>
                        <!-- <a class="page-scroll" href="#contact">Contact</a> -->
                           <a class="page-scroll" href="#exit">Exit</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
               <!--  <h1>Welcome All</h1> -->
                <center>
            <a href="aboutModal" data-toggle="modal" data-target="#mymodal" class="btn btn-circle btn-primary">1 </a> 
                           </center>
                          
                <hr>
               
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div  style="height:600px;" class="container">
            <div class="row">
               
                <div style="color:#0101DF" class="container">
                 @yield('content')
                </div>
            </div>
        </div>
    </section>

           

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                         <img src="img/portfolio/1.jpg" class="img-responsive" alt="">
                     <!--    <img src="{{ asset('img/portfolio/1.jpg') }}" class="img-responsive" alt=""> -->
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                       <!--  <img src="img/portfolio/2.jpg" class="img-responsive" alt=""> -->
                        <img src="{{ asset('img/portfolio/2.jpg') }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <!-- <img src="img/portfolio/3.jpg" class="img-responsive" alt=""> -->
                         <img src="{{ asset('img/portfolio/3.jpg') }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <!-- <img src="img/portfolio/4.jpg" class="img-responsive" alt=""> -->
                         <img src="{{ asset('img/portfolio/4.jpg') }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <!-- <img src="img/portfolio/5.jpg" class="img-responsive" alt=""> -->
                         <img src="{{ asset('img/portfolio/5.jpg') }}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <!-- <img src="img/portfolio/6.jpg" class="img-responsive" alt=""> -->
                         <img src="{{ asset('img/portfolio/6.jpg')}}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
                </div>
            </div>
        </div>
    </section>
  
       
   


    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
   <!--  <script src="js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Plugin JavaScript -->
   <!--  <script src="js/jquery.easing.min.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.easing.min.js') }}"></script>
    <!-- <script src="js/jquery.fittext.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.fittext.js') }}"></script>
    <!-- <script src="js/wow.min.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/wow.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
  <!--   <script src="js/creative.js"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/creative.js') }}"></script>

</body>

</html>
