@extends('cms.cmsmaster')
@section('content')


<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="h3 mb-3 font-weight-normal">Add New Product to SkiExpert:</h1>

                    <form class="form-signin" method="post" action="{{url('cms/products')}}" enctype="multipart/form-data" id="new_prod">
                        @csrf
                        <label class="pull-left">Category Name:</label>
                        <select  name="categorie_id" form="new_prod" class="form-control" required>
                            <option value="">Choose Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>

                        <input name="cat_name" type="hidden"  class="form-control" value="" required >
                        <input name="cat_url" type="hidden"  class="form-control" value="" required >

                        <label class="pull-left">Product Name:</label>
                        <input name="name" type="text" class="form-control" required >

                        <label class="pull-left">Product Description:</label>
                        <textarea name="description" class="form-control" rows="8" ></textarea>

                        <label class="pull-left">Product Details:</label>
                        <textarea name="details" class="form-control" rows="8" ></textarea>

                        <label class="pull-left">Gender:</label>
                        <select  name="gender" form="new_prod" class="form-control" required>
                            <option value=""></option>
                            <option value="women">Women</option>
                            <option value="men">Men</option>
                        </select>

                        <label class="pull-left">Price (&#8364):</label>
                        <input name="price" type="text"  class="form-control"  required >

                        <label class="pull-left">Choose Product Image</label>
                        <input name="image" type="file" class="form-control" required>

                        <div style="margin: 10px" class="pull-left">
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