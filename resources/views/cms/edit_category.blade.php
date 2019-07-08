@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">

                    <form class="form-signin" method="post" action="{{url('cms/categories').'/'.$data['id']}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h1 class="h3 mb-3 font-weight-normal">Edit Category:</h1>
                        <label class="pull-left">Category Name:</label>
                        <input name="name" type="text" id="" class="form-control" value="{{$data['name']}}" required >

                        <input name="cat_url" type="hidden"  class="form-control"  value="" required >

                        <label class="pull-left">Category Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{$data['description']}}</textarea>

                        <label class="pull-left">Category Image</label>
                        <input name="image" type="file" class="form-control" >
                        <div class="col-sm-9 col-md-9 col-lg-9 mx-auto">
                            <div class="col-sm-5 col-md-5 col-lg-5 mx-auto">
                                <img src="{{url('img').'/'.$data['image']}}">
                            </div>
                        </div>
                        <div style="margin: 60px" class="pull-left">
                            <input name="submit" class="btn primary-btn btn-block" type="submit" value="SAVE">
                            <input type="button" class="btn main-btn btn-block" onclick="window.location.href ='{{url('cms/categories/')}}'" value="CANCEL">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>
@endsection('content')