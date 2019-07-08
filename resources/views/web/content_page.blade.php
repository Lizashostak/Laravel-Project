@extends('master')
@section('content')
<section class="jumbotron text-center">
    @foreach($content as $data)
    <div class="container">
        <h3>{{$data['title']}}</h3>
    </div>


    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div>
                    <p style="text-align: left">{!! nl2br(e($data['article'])) !!}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>


@endsection('content')