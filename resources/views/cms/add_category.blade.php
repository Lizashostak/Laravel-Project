@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">

                    <form class="form-signin" method="post" action="{{url('cms/categories')}}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="h3 mb-3 font-weight-normal">Add New Category to SkiExpert:</h1>
                        <label class="pull-left">Category name:</label>
                        <input name="cat_name" type="text" class="form-control"  required >

                        <input name="cat_url" type="hidden"  class="form-control"  value="" required >

                        <label class="pull-left">Category Description:</label>
                        <textarea name="description" class="form-control" rows="4"required ></textarea>

                        <label  class="pull-left">Choose Category Image</label>
                        <input name="image" type="file" class="form-control" >

                        <div style="margin: 10px" class="pull-left">
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