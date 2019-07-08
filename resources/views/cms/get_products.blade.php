@extends('cms.cmsmaster')
@section('content')


<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class=" col-xs-1 col-md-1">
                        <p>Choose Category</p>
                    </div>
                    <div class=" col-xs-1 col-md-1">
                        <select name="category" id="category">
                            <option value='all'>All Products</option>
                            @foreach($categories as $category)
                            @if(!empty($selected) && $selected == $category['cat_url'])
                            <option selected value="{{$category['cat_url']}}">{{$category['name']}}</option>
                            @else
                            <option value="{{$category['cat_url']}}">{{$category['name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive col-xs-12 col-md-12">

                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image"></td>
                                <td>Category</td>
                                <td>Gender</td>
                                <td>Product Name</td>
                                <td>Price</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr data-categoryId='{{$item['categorie_id']}}' class="product_row">
                                <td>
                                    <img height="55em" src="{{url('img').'/'.$item['cat_name'].'/'.$item['image']}}">
                                </td>
                                <td> 
                                    <p>{{$item['cat_name']}}</p>
                                </td>
                                <td> 
                                    <p>{{$item['gender']}}</p>
                                </td>
                                <td> 
                                    <p>{{$item['name']}}</p>
                                </td>
                                <td>
                                    <p>{{$item['price']}}&#8364</p>
                                </td>
                                <td>
                                    <a href="{{url('cms/products').'/'.$item['id'].'/edit'}}" > <i class="fas fa-edit"></i> </a>
                                </td>
                                <td>
                                    <a href="{{url('cms/products').'/'.$item['id']}}"> <i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $data->appends(request()->input())->links() }}
                    </div>
                    <div>
                        <div style="padding: 5px;"> 
                            <a href="{{url('cms/products/create')}}" class="btn primary-btn pull-left">ADD NEW <i class="fas fa-plus"></i></a>
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