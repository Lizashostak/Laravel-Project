@extends('cms.cmsmaster')
@section('content')

<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="table-responsive col-xs-12 col-md-12">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td>Shop Page</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($content as $item)
                            <tr>
                                <td> 
                                    <p>{{$item['title']}}</p>
                                </td>
                                <td>
                                    <a href="{{url('cms/contents').'/'.$item['id'].'/edit'}}"> <i class="fas fa-edit"></i> </a>
                                </td>
                                <td>
                                    <a href="{{url('cms/contents').'/'.$item['id']}}"> <i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <div style="padding: 5px;"> 
                            <a href="{{url('cms/contents/create')}}" class="btn primary-btn pull-left">ADD NEW <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

@endsection('content')