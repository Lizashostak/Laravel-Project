@extends('cms.cmsmaster')
@section('content')
<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="table-responsive cart_info col-xs-12 col-md-12">
                    <form method="post" action="{{url('cms/contents').'/'.$data['id']}}">
                        @csrf
                        @method('DELETE')
                        <h2>Are you sure you want to delete {{$data['title']}} Page?</h2>
                        <div class="row justify-content-center">
                            <div class="col-xs-5 col-md-5 ">
                                <div style="margin:50px">
                                    <input name="submit" class="btn primary-btn btn-block" type="submit" value="DELETE">
                                    <input type="button" class="btn main-btn btn-block" onclick="window.location.href ='{{url('cms/contents')}}'" value="CANCEL">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection('content')