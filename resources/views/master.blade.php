<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$title}}</title>
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="{{asset('tamplate/css/bootstrap.min.css')}}" />
        <link rel="icon" type="image/png" sizes="96x96" href="{{url('/img/favicon.png')}}">
        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="{{asset('tamplate/css/slick.css')}}" />
        <link type="text/css" rel="stylesheet" href="{{asset('tamplate/css/slick-theme.css')}}" />

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="{{asset('tamplate/css/nouislider.min.css')}}" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{asset('tamplate/css/font-awesome.min.css')}}">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="{{asset('tamplate/css/style.css')}}" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->

        <script>
            var BASE_URL = "{{url('')}}";
        </script>
    </head>

    <body>

        <!-- HEADER -->
        <header>
            <!-- top Header -->
            <div id="top-header">
                <div class="container">
                    <div class="pull-left">
                        @if(Session::has('user_id'))
                        <span>{{Session::get('user_fname')}} {{Session::get('user_lname')}} Welcome Back to SkiExpert!</span>
                        @else
                        <span>Welcome to SkiExpert!</span>
                        @endif
                    </div>
                </div>                                                                                      
            </div>
            <!-- /top Header -->

            <!-- header -->
            <div id="header">
                <div class="container">
                    <div class="pull-left">
                        <!-- Logo -->
                        <div class="header-logo">
                            <a class="logo" href="#">
                                <img src="{{asset('img/logo2.png')}}" alt="">
                            </a>
                        </div>
                        <!-- /Logo -->
                    </div>
                    @if(Session::has('success_msg'))
                    <div class="alert alert-success success_msg text-center pull-left">
                        {{Session::get('success_msg')}}
                    </div>
                    @endif
                    @foreach($errors->all() as $message)
                    <div class="alert alert-danger text-center pull-left">
                        {{$message}}
                    </div>
                    @endforeach

                    <div class="pull-right">
                        <ul class="header-btns">
                            <!-- Account -->
                            <li class="header-account dropdown default-dropdown">
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                                </div>
                                @if(!Session::has('user_id'))
                                <a href="{{url('user/signin')}}" class="text-uppercase">LOGIN</a> / 
                                <a href="{{url('user/signup')}}" class="text-uppercase">JOIN</a>
                                @else
                                @if(Session::has('is_admin'))
                                <a href="{{url('cms/dashboard')}}" class="text-uppercase">CMS</a> / 
                                @endif
                                <a href="{{url('user/logout')}}" class="text-uppercase">LOGOUT</a>
                                @endif
                                <ul class="custom-menu">
                                    @if(!Session::has('user_id'))
                                    <li><a href="{{url('user/signin')}}"><i class="fa fa-unlock-alt"></i> LogIn</a></li>
                                    <li><a href="{{url('user/signup')}}"><i class="fa fa-user-plus"></i> Create An Account</a></li>
                                    @else
                                    <li><a href="{{url('user/useracount')}}"><i class="fa fa-user-o"></i> My Account</a></li> 
                                    @if(Session::has('is_admin'))
                                    <li><a href="{{url('cms/dashboard')}}"><i class="fas fa-tasks"></i>CMS</a></li>
                                    @endif
                                    <li><a href="{{url('user/logout')}}"><i class="fas fa-sign-out-alt"></i>Log Out</a></li>
                                    @endif
                                </ul>
                            </li>
                            <!-- /Account -->

                            <!-- Cart -->
                            <li class="header-cart dropdown default-dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if(!Cart::isEmpty())
                                        <span class="qty">{{Cart::getTotalQuantity()}}</span>
                                    </div>
                                    <strong class="text-uppercase">My Cart:</strong>
                                    <br>
                                    <span>
                                        {{Cart::getTotal()}}&#8364
                                    </span>
                                    @endif
                                </a>
                                <div class="custom-menu">
                                    <div id="shopping-cart">
                                        @if(!Cart::isEmpty())
                                        <div class="shopping-cart-list">
                                            @foreach(Cart::getContent()->sort()->toArray() as $item)
                                            <div class="product product-widget">
                                                <div class="product-thumb">
                                                    <img src="{{url('img').'/'.$item['attributes'][2].'/'.$item['attributes'][0]}}">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-price">{{$item['price']}}&#8364 <span class="qty">x{{$item['quantity']}}</span></h3>
                                                    <h2 class="product-name">{{$item['name']}}</h2>
                                                </div>
                                                <button class="cancel-btn update_cart cart_quantity_delete" data-id="{{$item['id']}}" data-op="remove_item"><i class="fa fa-trash"></i></button>
                                                <!--<a onMouseOver="this.style.cursor = 'pointer'" class="update_cart cart_quantity_delete" data-id="{{$item['id']}}" data-op="remove_item"><i class="fa fa-trash"></i></a>-->
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="shopping-cart-btns">
                                            <!--<a href="#" class="primary-btn pull-right">Checkout <i class="fa fa-arrow-circle-right"></i></a>-->
                                            <a href="{{url('cart/viewcart')}}" class="main-btn pull-right">Checkout</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <!--/Cart -->                                                                                                     

                            <!-- Mobile nav toggle-->
                            <li class="nav-toggle">
                                <button class="nav-toggle-btn main-btn icon-btn">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </li>
                            <!-- / Mobile nav toggle -->
                        </ul>
                    </div>
                </div>
                <!-- header -->
            </div>
            <!-- container -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
        <div id="navigation">
            <!-- container -->
            <div class="container">
                <div id="responsive-nav">

                    <!-- menu nav -->
                    <div class="menu-nav">
                        <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                        <ul class="menu-list">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/shop')}}">Shop</a></li>
                            <li class="dropdown mega-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Women <i class="fa fa-caret-down"></i></a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-4" style="width:50%">
                                            <ul class="list-links">
                                                @foreach($categories as $category)
                                                <li><a href="{{url('shop').'/filter/'.$category['cat_url'].'/'.'women'}}">{{$category['name']}}</a></li>
                                                @endforeach
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown mega-dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Men <i class="fa fa-caret-down"></i>
                                </a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-4"  style="width:50%">
                                            <ul class="list-links">
                                                @foreach($categories as $category)
                                                <li><a href="{{url('shop').'/filter/'.$category['cat_url'].'/'.'men'}}">{{$category['name']}}</a></li>
                                                @endforeach
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="dropdown mega-dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">More Info <i class="fa fa-caret-down"></i>
                                </a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-4"  style="width:100%">
                                            <ul class="list-links">
                                                @foreach($content_data as $data)
                                                <li><a href="{{url($data['title_url'])}}">{{$data['title']}}</a></li>
                                                @endforeach
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                    </div>
                                </div>
                        </ul>
                    </div>
                    <!-- menu nav  -->
                </div>
            </div>                             

            <!-- HOME-->
            <!--  <div id="home">  -->
            @yield('content')
            <!-- </div>-->
            <!-- /HOME -->

            <div class="section">
                <div class="container">
                    <div class="row">

                    </div>                
                </div>
            </div>

            <!-- FOOTER -->
            <footer id="footer" class="section section-grey">
                <!-- container-->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- footer widget -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="footer">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

                                <!-- footer social -->
                                <ul class="footer-social">
                                    <li><a class="social" style="cursor: pointer" data-toggle="modal" data-target="#socialModal"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="social" style="cursor: pointer" data-toggle="modal" data-target="#socialModal"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="social" style="cursor: pointer" data-toggle="modal" data-target="#socialModal"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                                <!-- /footer social -->                                                                                                                                                                                                        
                            </div>

                        </div>
                        <!-- /footer widget -->

                        <!-- footer widget -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-header">My Account</h3>
                                <ul class="list-links">
                                    @if(!Session::has('user_id'))
                                    <li><a href="{{url('user/signin')}}">LogIn</a></li>
                                    <li><a href="{{url('user/signup')}}">Create An Account</a></li>
                                    @else
                                    <li><a href="{{url('user/useracount')}}"> My Account</a></li> 
                                    @if(Session::has('is_admin'))
                                    <li><a href="{{url('cms/dashboard')}}">CMS</a></li>
                                    @endif
                                    <li><a href="{{url('user/logout')}}">Log Out</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- /footer widget -->

                        <div class="clearfix visible-sm visible-xs"></div>

                        <!-- footer widget -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-header">Customer Service</h3>
                                <ul class="list-links">
                                    @foreach($content_data as $data)
                                    <li><a href="{{url($data['title_url'])}}">{{$data['title']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- /footer widget -->

                        <!-- footer Contact Us -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-header">Contact Us</h3>
                                <ul class="list-links">
                                    <li>
                                        <a style="cursor: pointer" data-toggle="modal" data-target="#ContactUsModal">Instant Message</a>
                                    </li>
                                    <li>
                                        <a href="https://m.me/liza.minster">Facebook Messenger  <i class="fab fa-facebook-messenger "></i> </a>
                                    </li>
                                    <li>
                                        <a href="https://t.me/LizaShostak">Telegram  <i class="fab fa-telegram"></i> </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /footer Contact Us -->
                        </div>
                        <!-- /row -->
                        <hr>
                        <!-- row -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center">
                                <!-- footer copyright -->
                                <div class="footer-copyright">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a                                                                                                                                                                                                         href="https://colorlib.com" tar                                                                                                                                                                                                        get="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
                                <!-- /footer copyright -->
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
            </footer>
            <!-- /FOOTER -->

            <!--Social Modal-->
            <div class="modal fade" id="socialModal" tabindex="-1" role="dialog" aria-labelledby="socialModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h3>Coming Soon...</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn primary-btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Us Modal -->
            <div id="ContactUsModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Contact Us</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" id="reused_form" >
                                <h5>
                                    Send your message in the form below and we will get back to you as early as possible.
                                </h5>
                                <div class="form-group">
                                    <label for="name"> Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required maxlength="50">

                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="name">Message:</label>
                                    <textarea class="form-control" type="textarea" name="message"
                                              id="message" placeholder="Your Message Here"
                                              maxlength="3000" rows="7"></textarea>
                                </div>
                                <button type="submit" class="btn btn-lg primary-btn btn-block" id="btnContactUs">Send</button>
                            </form>
                            <div id="success_message" style="width:100%; height:100%; display:none; ">
                                <h3>Your message successfully sent!</h3>
                            </div>
                            <div id="error_message"
                                 style="width:100%; height:100%; display:none; ">
                                <h3>Error</h3>
                                Sorry there was an error sending your form.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===== Scroll to Top Button =====-->
            <a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a> 

            <!-- jQuery Plugins -->

            <script src="{{asset('tamplate/js/jquery.min.js')}}"></script>
            <script src="{{asset('tamplate/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('tamplate/js/slick.min.js')}}"></script>
            <script src="{{asset('tamplate/js/nouislider.min.js')}}"></script>
            <script src="{{asset('tamplate/js/jquery.zoom.min.js')}}"></script>
            <script src="{{asset('tamplate/js/main.js')}}"></script>
            <script src="{{asset('js/ajax.js')}}"></script>
            <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->

    </body>
</html>

