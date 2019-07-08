@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">

                    <form class="form-signin" method="post" action="{{url('cms/products').'/'.$data['id']}}" enctype="multipart/form-data" id="edit_prod">
                        @csrf
                        @method('PUT')
                        <h1 class="h3 mb-3 font-weight-normal">Edit Product:</h1>

                        <label class="pull-left">Category Name:</label>
                        <input readonly="true"class="form-control" value="{{$data['cat_name']}}">

                        <input name="cat_url" type="hidden"  class="form-control" value="{{$data['cat_name']}}" required >

                        <label class="pull-left">Name:</label>
                        <input name="name" type="text" class="form-control" value="{{$data['name']}}" required >

                        <label class="pull-left">Gender:</label>
                        <select  name="gender" form="edit_prod" class="form-control" required>
                            @if($data['gender']=='women')
                            <option selected value="women">Women</option>
                            <option value="men">Men</option>
                            @else
                            <option  value="women">Women</option>
                            <option selected value="men">Men</option>
                            @endif
                        </select>


                        <label class="pull-left">Description:</label>
                        <textarea name="description" class="form-control" rows="8" required>{{$data['description']}}</textarea>

                        <label class="pull-left">Product Details:</label>
                        <textarea name="details" class="form-control" rows="8" required >{{$data['details']}}</textarea>

                        <label class="pull-left">Price (&#8364):</label>
                        <input name="price" type="text" class="form-control" value="{{$data['price']}}" required >

                        <label class="pull-left">Image:</label>
                        <input name="image" type="file" class="form-control" >
                        <div class="col-sm-9 col-md-9 col-lg-9 mx-auto">
                            <div class="col-sm-5 col-md-5 col-lg-5 mx-auto">
                                <img src="{{url('img').'/'.$data['cat_name'].'/'.$data['image']}}">
                            </div>
                        </div>
                        <div style="margin: 60px" class="pull-left">
                            <input name="submit" class="btn primary-btn btn-block" type="submit" value="SAVE">
                            <input type="button" class="btn main-btn btn-block" onclick="window.location.href ='{{url('cms/products/')}}'" value="CANCEL">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection('content')