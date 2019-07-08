@extends('master')
@section('content')
<div class="home" style="background-color: rgb(238,238,238);"> 
    <!-- section -->
    <div class="section" >
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!--  Product Details -->
                <div class="product product-details clearfix">
                    <div class="col-md-4">
                        <div id="product-main-view">
                            <div class="product-view">
                                <img width="60%" src="{{url('img/').'/'.$cat_url.'/'.$data['image']}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="product-body">
                            <h2 class="product-name">{{$data['name']}}</h2>
                            <h3 class="product-price">{{$data['price']}}&#8364 </h3>

                            <p><strong>Availability:</strong> In Stock</p>
                            <p>{!! nl2br(e($data['description'])) !!}</p>

                            <div class="product-btns">
                                <input type="button" class="btn add_to_cart primary-btn" data-id="{{$data['id']}}" value="Add To Cart +">

                                <div class="btn-group">
                                    <a onclick=" window.history.back();">
                                        <input type="button" class="btn main-btn" value="Back"></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="product-tab">
                            <ul class="tab-nav">
                                <li><a data-toggle="tab" href="#tab1">Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade in active">
                                    <p>{!! nl2br(e($data['details'])) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    @endsection('content')