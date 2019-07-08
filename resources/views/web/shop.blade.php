@extends('master')
@section('content')

<section class="jumbotron text-center" style="background-color:#FFFFFF">
    <div class="container">
        <h2 class="jumbotron-heading">Choose Category</h2>
    </div>
    <div class="album py-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($categories as $data)
                <div class="col-md-6 col-sm-6">
                    <a href="{{url('shop').'/'.$data['cat_url']}}">
                        <div class="card mb-4 shadow-sm">
                            <h3> <u><b>{{$data['name']}}</b></u></h3>
                            <img class="bd-placeholder-img card-img-top" width="80%" height="300" src="{{url('img/').'/'.$data['image']}}" >  
                        </div>
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <span><a href="{{url('shop').'/'.$data['cat_url']}}" class="category-link">Shop All</a></span>
                            <span><a href="{{url('shop').'/filter/'.$data['cat_url'].'/'.'men'}}" class="category-link">Shop for Men</a></span>
                            <span><a href="{{url('shop').'/filter/'.$data['cat_url'].'/'.'women'}}" class="category-link">Shop for Women</a></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection('content')