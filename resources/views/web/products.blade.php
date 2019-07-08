@extends('master')
@section('content')

<section class="jumbotron text-center" style="background-color:#FFFFFF">
    <div class="container">
        <h2 class="jumbotron-heading"> {{$cat_name}} Category {{$gender}}</h2>
    </div>


    <div class="album py-5 " style="background-color:#FFFFFF">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    @if($products)
                    <div class="col-md-2">
                        <select class="p-select"name="products_filter" id="products_filter">
                            <option vlaue="all">Sort By:</option>
                            <option value="by_new">The Newest</option>
                            <option value="by_low">Price: Low to High</option>
                            <option value="by_high">Price: High to Low</option>
                        </select>
                    </div>
                    @else
                    <h4>There Is No Products In This Category</h4>
                    @endif
                </div>

                <div class="prod_wrapper">
                    @foreach($products as $data)
                    <div class="col-md-4 product product-single">
                        <div class="product-thumb">
                            <a href="{{url('shop').'/'.$cat_url.'/'.$data['product_url']}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> VIEW</a>
                            <!--<a href="{{url('shop').'/'.$cat_url.'/'.$data['product_url']}}">-->
                            <div class="card mb-4 shadow-sm">
                                <h4> {{$data['name']}}</h4>
                                <img style="width: 80%" class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{url('img/').'/'.$cat_url.'/'.$data['image']}}" >
                            </div>
                            <!--</a>-->
                        </div>
                        <div class="product-body">
                            <div style="margin: 15px"class="d-flex justify-content-between align-items-center">
                                <span style="font-size: 18px"><b>Price: {{$data['price']}}&#8364 </b></span>
                                <!--                            <div class="product-btns">-->
                                <input type="button" class="btn add_to_cart primary-btn" data-id="{{$data['id']}}" value="Add To Cart +">
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            {{ $products->appends(request()->input())->links('pagination::default') }}
        </div>
    </div>
</section>
@endsection('content')