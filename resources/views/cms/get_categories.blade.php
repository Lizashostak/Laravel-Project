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
                                <td class="image"></td>
                                <td class=>ID</td>
                                <td>Category Name</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <img height="55em" src="{{url('img').'/'.$item['image']}}">
                                </td>
                                <td> 
                                    <p>{{$item['id']}}</p>
                                </td>
                                <td> 
                                    <p>{{$item['name']}}</p>
                                </td>
                                <td>
                                    <a href="{{url('cms/categories').'/'.$item['id'].'/edit'}}" > <i class="fas fa-edit"></i> </a>
                                </td>
                                <td>
                                    <a href="{{url('cms/categories').'/'.$item['id']}}"> <i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <div style="padding: 5px;"> 
                            <a href="{{url('cms/categories/create')}}" class="btn primary-btn pull-left">ADD NEW <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>-->

<!-- Modal -->
<!--<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="edeleteCategoryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalTitle">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                Are You sure you want to Delete this Category from the shop?
                This action is an irreversible!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>-->

@endsection('content')