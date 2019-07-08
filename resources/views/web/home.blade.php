@extends('master')
@section('content')

<div class="home" style="background-color: rgb(238,238,238);"> 
    <!-- container -->
    <div class="container">
        <!-- home wrap -->
        <div class="home-wrap">

            <!-- home slick -->
            <div id="home-slick">
                <!-- banner -->
                <div class="banner banner-1">
                    <img src="{{url('img/home_banner/home_b_1.jpg')}}" alt="">
                    <div class="banner-caption">
                        <h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
                        <a href="{{url('/shop')}}"class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <!-- /banner -->

                <!-- banner -->
                <div class="banner banner-1">
                    <img src="{{url('img/home_banner/home_b_2.jpg')}}" alt="">
                    <div class="banner-caption">
                        <h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
                        <a href="{{url('/shop')}}"class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <!-- /banner -->

                <!-- banner -->
                <div class="banner banner-1">
                    <img src="{{url('img/home_banner/home_b_3.jpg')}}" alt="">
                    <div class="banner-caption">
                        <h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
                        <a href="{{url('/shop')}}"class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <!-- /banner -->
                <!-- banner -->
                <div class="banner banner-1">
                    <img src="{{url('img/home_banner/home_b_4.jpg')}}" alt="">
                    <div class="banner-caption">
                        <h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
                        <a href="{{url('/shop')}}"class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <!-- /banner -->
            </div>
        </div>
    </div>

</div>

@endsection('content')