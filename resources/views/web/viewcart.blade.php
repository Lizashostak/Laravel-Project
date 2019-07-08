@extends('master')
@section('content')


<div class="section" style="background-color: rgb(238,238,238);">
    <div class="container">
        <div class="row">
            @if(!Cart::isEmpty())
            <div class="col-md-12">
                <div class="order-summary clearfix">
                    <div class="section-title">
                        <h3 class="title">Order Review</h3>
                    </div>
                    <table class="shopping-cart-table table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items_data as $item)
                            <tr>
                                <td class="thumb">
                                    <img src="{{url('img').'/'.$item['attributes'][2].'/'.$item['attributes'][0]}}">
                                </td>
                                <td class="details">{{$item['name']}}</td>
                                <td class="price text-center"><strong>{{$item['price']}}&#8364</strong></td>
                                <td class="qty text-center">
                                    <div class="cart_quantity_button">
                                        <div>
                                            <a onMouseOver="this.style.cursor = 'pointer'" class="update_cart cart_quantity_up" data-id="{{$item['id']}}" data-op="+"> <i class="fas fa-plus"></i> </a>
                                        </div>
                                        <input class="cart_quantity_input text-center" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2" readonly="true">
                                        <div>
                                            <a onMouseOver="this.style.cursor = 'pointer'" class="update_cart cart_quantity_down" data-id="{{$item['id']}}" data-op="-"> <i class="fas fa-minus"></i> </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="total text-center"><strong class="primary-color">{{$item['quantity']*$item['price']}}&#8364</strong></td>
                                <td class="text-right">
                                    <a onMouseOver="this.style.cursor = 'pointer'" class="update_cart cart_quantity_delete" data-id="{{$item['id']}}" data-op="remove_item"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="empty" colspan="3"></th>
                                <th>TOTAL</th>
                                <th colspan="2" class="total">{{Cart::getTotal()}}&#8364</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="pull-right">
                        <div style="padding: 5px; "> <a href="{{url('cart/saveorder')}}" class="btn primary-btn" style="width: 192px;">Save Order</a></div>
                        <div style="padding: 5px;"> <a href="{{url('cart/deletecart')}}" class="btn main-btn" style="width: 192px;">Delete Cart</a></div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center">
                <h3>There is no Items in the Cart</h3>
            </div>
            @endif
        </div>
    </div>
</div>




<!--<section class="jumbotron text-center">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @if(!Cart::isEmpty())
                <div class="table-responsive cart_info col-xs-12 col-md-8">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image"></td>
                                <td class="item">Item</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items_data as $item)
                            <tr>
                                <td class="cart_product">
                                    <img height="110px" src="{{url('img').'/'.$item['attributes'][2].'/'.$item['attributes'][0]}}">
                                </td>

                                <td class="cart_description"> 
                                    <p>{{$item['name']}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{$item['price']}}&#8364</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="update_cart cart_quantity_up" data-id="{{$item['id']}}" data-op="+"> <i class="fas fa-plus"></i> </a>
                                        <input class="cart_quantity_input text-center" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2" readonly="true">

                                        <a class="update_cart cart_quantity_down" data-id="{{$item['id']}}" data-op="-"> <i class="fas fa-minus"></i> </a>
                                    </div>
                                </td>
                                <td class="cart_price">
                                    <p>{{$item['quantity']*$item['price']}}&#8364</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="update_cart cart_quantity_delete" data-id="{{$item['id']}}" data-op="remove_item"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="total_area">
                        <div>
                            <p>Total Cost: {{Cart::getTotal()}}&#8364</p>
                        </div>
                        <div style="padding: 5px; "> <a href="{{url('cart/saveorder')}}" class="btn primary-btn" style="width: 192px;">Proceed To CheckOut</a></div>
                        <div style="padding: 5px;"> <a href="{{url('cart/deletecart')}}" class="btn main-btn" style="width: 192px;">Delete Cart</a></div>
                    </div>
                </div>
                @else
                <div>
                    <h6>There is no Items in the Cart</h6>
                </div>
                @endif
            </div>
        </div>
    </div>

</section>-->

@endsection('content')