<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title}}</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport"content="width=device-width, initial-scale=1">

        <!--        <link rel="apple-touch-icon" href="apple-icon.png">
                <link rel="shortcut icon" href="favicon.ico">-->

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('cms/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('cms/vendors/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('cms/vendors/themify-icons/css/themify-icons.css')}}">
        <link rel="stylesheet" href="{{asset('cms/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('cms/vendors/selectFX/css/cs-skin-elastic.css')}}">
        <link rel="stylesheet" href="{{asset('cms/assets/css/style.css')}}">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <style>
            .primary-btn {
                color: #FFF;
                background-color: rgb(231,76,60);
            }

            .primary-btn:hover, .primary-btn:focus {
                color: #FFF;
                background-color: #30323A;
            }
            .main-btn:hover, .primary-btn:focus {
                color: #FFF;
                background-color: #30323A;
            }

        </style>
        <script>
            var BASE_URL = "{{url('')}}";
        </script>
    </head>

    <body>
        <!--Left Panel -->

        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
<!--                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>-->
                </div>

                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{url('cms/dashboard')}}"> <i class="menu-icon fa fa-dashboard"></i>CMS Home </a>
                        </li>
                        <h3 class="menu-title">SHOP Goods</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-fw fa-cog"></i>Edit SHOP</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fas fa-caret-right"></i><a href="{{url('cms/categories')}}">Categories</a></li>
                                <li><i class="fas fa-caret-right"></i><a href="{{url('cms/products')}}">Products</a></li>
                            </ul>
                        </li>
                        <h3 class="menu-title">Pages</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fas fa-images"></i>Content</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fas fa-caret-right"></i><a href="{{url('cms/contents')}}">View All</a></li>
                                <li><i class="fas fa-caret-right"></i><a href="{{url('cms/contents/create')}}">Add New</a></li>
                            </ul>
                        </li>
                        <h3 class="menu-title">Orders</h3><!-- /.menu-title -->
                        <li>
                            <a href="{{url('cms/orders')}}" class="dropdown-toggle" > <i class="menu-icon fa fa-table"></i>View Orders</a>
                        </li>
                        <h3 class="menu-title">Messages</h3><!-- /.menu-title -->
                        <li>
                            <a href="{{url('cms/messages')}}" class="dropdown-toggle" ><i class="menu-icon far fa-envelope"></i>View Messages</a>
                        </li>
                        <h3 class="menu-title">Go To</h3>
                        <li>
                            <a href="{{url('')}}"><i class="menu-icon fas fa-sign-out-alt"></i>SkiExpert</a>
                        </li>
                        <li>
                            <a href="{{url('cms/logout')}}"><i class="menu-icon fa fa-power-off"></i>Log Out</a>
                        </li>

                        <!--                        <h3 class="menu-title">Manage Customers</h3> /.menu-title 
                                                <li class="menu-item-has-children dropdown">
                                                    <a href="#" class="dropdown-toggle"><i class="menu-icon fas fa-users"></i>Customers</a>
                                                </li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel -->

        <!-- Left Panel -->

        <!-- Right Panel -->

        <div id="right-panel" class="right-panel">

            <!-- Header-->
            <header id="header" class="header">
                <div class="header-menu">
                    <div class="col-sm-7">
                        <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>

                        <div class="header-left">
                            @section('head')
                            <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="message"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-envelope"></i>
                                    @if(count($msgs)>0)
                                    <span id="notification" class="count bg-danger">{{count($msgs)}}</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="message">
                                    <a href="{{url('cms/messages')}}" class="red">You have {{count($msgs)}} Unread Massages</a>
                                </div>
                            </div>
                            @show
                        </div>
                    </div>
            </header>
            <!-- Header-->

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{$page_name}}</h1>
                        </div>
                        @if(Session::has('success_msg'))
                        <div class="alert alert-success success_msg text-center align-content-lg-center">
                            {{Session::get('success_msg')}}
                        </div>
                        @endif
                        @foreach($errors->all() as $message)
                        <div class="alert alert-danger text-center align-content-lg-center">
                            {{$message}}
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <!--            <div class="content mt-3">
                            <div class="animated fadeIn">
                                <div class="row">
                                 
                                </div>
                            </div>
                        </div>
                    </div>-->
            <!--===== Scroll to Top Button =====-->
            <a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a> 


            <script src="{{asset('cms/vendors/jquery/dist/jquery.min.js')}}"></script>
            <script src="{{asset('cms/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
            <script src="{{asset('cms/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('cms/assets/js/main.js')}}"></script>

            <!--  Chart js -->
            <script src="{{asset('cms/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
            <script src="{{asset('cms/assets/js/widgets.js')}}"></script>
            <!--<script src="{{asset('cms/assets/js/init-scripts/chart-js/chartjs-init.js')}}"></script>-->
            @yield('content')



    </body>

</html>
