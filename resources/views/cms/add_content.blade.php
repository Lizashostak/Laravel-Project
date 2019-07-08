@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">

                    <form class="form-signin" method="post" action="{{url('cms/contents')}}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="h3 mb-3 font-weight-normal">Add New Page To SkiExpert:</h1>
                        <label class="pull-left">TITLE</label>
                        <input name="title" type="text" class="form-control"  required >

                        <input name="title_url" type="hidden"  class="form-control"  value="" required >

                        <label class="pull-left">ARTICLE</label>
                        <textarea name="article" class="form-control" rows="9"required ></textarea>


                        <div style="margin: 10px" class="pull-left">
                            <input name="submit" class="btn primary-btn btn-block" type="submit" value="SAVE">
                            <input type="button" class="btn main-btn btn-block" onclick="window.location.href ='{{url('cms/contents/')}}'" value="CANCEL">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>
@endsection('content')