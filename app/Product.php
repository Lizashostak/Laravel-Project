<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cart,
    Session;
use Illuminate\Support\Facades\File;

class Product extends Model {

    //get all products from DB 
    public static function GetProducts() {
        $products = self::all()->toArray();
    }

    //Add Product To Cart by ID
    public static function AddToCart($product_id) {
        $product = self::find($product_id);
        $product = $product->toArray();
        if ($product['id']) {
            Cart::add($product['id'], $product['name'], $product['price'], 1, array($product['image'], $product['description'], $product['cat_name']));
            Session::flash('success_msg', "{$product['name']} added to the cart");
            return true;
        }
    }

    //update/delete items in cart
    public static function UpdateCart($request) {
        $product_id = $request->product_id;
        $product_op = $request->product_op;
        if (is_numeric($product_id) && Cart::get($product_id)) {
            if (trim($product_op) == '+') {
                Cart::update($product_id, array('quantity' => 1,));
                Session::flash('success_msg', 'Item has been updated');
            } elseif (trim($product_op) == '-' && Cart::get($product_id)->quantity > 1) {
                Cart::update($product_id, array('quantity' => -1,));
                Session::flash('success_msg', 'Item has been updated');
            } elseif (trim($product_op) === 'remove_item') {
                Cart::remove($product_id);
                Session::flash('success_msg', 'Product removed from cart');
            }
        }
    }

    // ----- Save New Product From CMS
    public static function SaveNewProduct($request) {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $request->file('image')->move(public_path() . '\img' . '\\' . $request->cat_url, $file_name);
        } else {
            $file_name = "noimage.jpg";
//            $destinationPath = public_path() . '\img' . '\\' . $request->cat_url;
//            $success = \File::copy($destinationPath, $file_name);
        }
        $product = new self();
        $product->categorie_id = $request->categorie_id;
        $product->cat_name = $request->cat_url;
        $product->name = ucwords($request->name);
        $product->product_url = str_replace([':', '\\', '/', '*', '%', ' '], '_', $request->name);
        $product->description = $request->description;
        $product->details = $request->details;
        $product->image = $file_name;
        $product->price = $request->price;
        $product->gender = $request->gender;
        $product->save();
        if ($product->id) {
            return true;
        } else {
            return false;
        }
    }

    public static function SaveEditProduct($request, $id) {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $request->file('image')->move(public_path() . '\img' . '\\' . $request->cat_url, $file_name);
        }
        $product = self::find($id);
        $product->name = ucfirst($request->name);
        $product->product_url = str_replace(' ', '_', $request->name);
        if ($request->hasFile('image')) {
            $product->image = $file_name;
        }
        $product->description = $request->description;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->gender = $request->gender;
        $product->save();
        if ($product->id) {
            return true;
        } else {
            return false;
        }
    }

}
