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
                                <td>Customer</td>
                                <td>Email</td>
                                <td>Order</td>
                                <td>Price</td>
                                <td>Total</td>
                                <td>Ordered At</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td> 
                                    <p>{{ucfirst($order['first_name']).' '.ucfirst($order['last_name'])}}</p>
                                </td>
                                <td> 
                                    <p>{{$order['email']}}</p>
                                </td>

                                <td> 
                                    <p>
                                        @foreach($order['data'] as $data)
                                        {{$data['name']}}  <span><b>QTY:{{$data['quantity']}}</b></span><br>
                                        @endforeach
                                    </p>
                                </td>
                                <td> 
                                    <p>
                                        @foreach($order['data'] as $data)
                                        <b>{{$data['price']}} &#8364</b><br>
                                        @endforeach
                                    </p>
                                </td>
                                <td> 
                                    <p>
                                        <b> 
                                            @php($total = 0)
                                            @foreach($order['data'] as $data)
                                            @php($total += $data['price']*$data['quantity'])
                                            @endforeach
                                            {{$total}}&#8364
                                        </b>
                                    </p>

                                </td>
                                <td> 
                                    <p>{{$order['created_at']}}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $users_order->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection('content')