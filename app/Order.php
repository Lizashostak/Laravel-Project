<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session,
    Cart;

class Order extends Model {

    //----- Save new Order in DB -----
    public static function SaveNewOrder() {
        $userd_id = Session::get('user_id');
        $order = new Self();
        $order->user_id = $userd_id;
        $order->data = serialize(Cart::getContent()->toArray());
        $order->save();
        if ($order->id) {
            Cart::clear();
            return true;
        }
    }

//----- GetAllOrders From DB -----
    public static function GetAllOrders() {
        $orders = self::all()->toArray();
        return $orders;
    }

}
