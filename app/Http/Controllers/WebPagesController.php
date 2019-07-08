<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeDetailsRequest;
use App\Categorie;
use App\Product;
use App\Content;
use Cart,
    Session;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Usermessage;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ContactUsRequest;

class WebPagesController extends MainController {

    public static $items_data;

    //======= Home Page =======
    public static function HomePage() {
        self::$data['title'] .= 'Home';
        return view('web.home', self::$data);
    }

    //======= Get Shop Content =======
    public static function GetContent($content) {
        if ($content_from_db = Content::where([
                    'title_url' => $content,
                ])->get()->toArray()) {
            self::$data['content'] = $content_from_db;
            return view('web.content_page', self::$data);
        } else {
            self::$data['content'] = $content_from_db;
            return view('web.home', self::$data);
        }
    }

    //======= Get Categories from DB =======
    public static function GetCategories() {
        self::$data['title'] .= 'Categories';
        return view('web.shop', self::$data);
    }

    //======= Get all Products by category and paginate by url query =======
    public static function GetAllProducts($cat_url) {
        $category = Categorie::where('cat_url', $cat_url)->get()->toArray();
        $filter = Input::get('filter');
        if ($filter == 'by_low') {
            $products = Product::where('cat_name', '=', $cat_url)
                            ->orderBy('price')->paginate(9);
        } elseif ($filter == 'by_high') {
            $products = Product::where('cat_name', '=', $cat_url)
                            ->orderBy('price', 'desc')->paginate(9);
        } elseif ($filter == 'by_new') {
            $products = Product::where('cat_name', '=', $cat_url)
                            ->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $products = Product::where('cat_name', '=', $cat_url)->paginate(9);
        }
        self::$data['products'] = $products;
        self::$data['title'] .= $category[0]['name'];
        self::$data['cat_url'] = $cat_url;
        self::$data['cat_name'] = $category[0]['name'];
        self::$data['gender'] = ' ';
        return view('web.products', self::$data);
    }

    //======= Get all Products by Gender =======
    public static function GetAllProductsByGender($cat_url, $gender) {
        $category = Categorie::where('cat_url', $cat_url)->get()->toArray();
        $filter = Input::get('filter');
        if ($filter == 'by_low') {
            $products = Product::where([
                        'cat_name' => $cat_url,
                        'gender' => $gender,
                    ])->orderBy('price')->paginate(9);
            ;
        } elseif ($filter == 'by_high') {
            $products = Product::where([
                        'cat_name' => $cat_url,
                        'gender' => $gender,
                    ])->orderBy('price', 'desc')->paginate(9);
        } elseif ($filter == 'by_new') {
            $products = Product::where([
                        'cat_name' => $cat_url,
                        'gender' => $gender,
                    ])->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $products = Product::where([
                        'cat_name' => $cat_url,
                        'gender' => $gender,
                    ])->paginate(9);
        }
        self::$data['title'] .= $category[0]['name'];
        self::$data['products'] = $products;
        self::$data['cat_url'] = $cat_url;
        self::$data['cat_name'] = $category[0]['name'];
        self::$data['gender'] = ' | ' . ucfirst($gender);
        return view('web.products', self::$data);
    }

    //======= View chosen Product =======
    public static function ViewProduct($cat_url, $product_url) {
        $product = Product::where('product_url', $product_url)->get()->toArray();
        self::$data['data'] = $product[0];
        self::$data['title'] = $product[0]['name'];
        self::$data['cat_url'] = $cat_url;
        return view('web.view_product', self::$data);
    }

    //======= Add Product To Cart =======
    public static function AddProductToCart(Request $request) {
        if ($request->product_id && is_numeric($request->product_id)) {
            Product::AddToCart($request->product_id);
        }
    }

    //======= View Cart Page  =======
    public static function ViewCart() {
        self::$data['title'] .= "Checkout";
        $items = Cart::getContent()->sort()->toArray();
        self::$items_data['items_data'] = $items;
        return view('web.viewcart', self::$data, self::$items_data);
    }

    //======= Update/Delete Items in Cart =======
    public static function UpdateCart(Request $request) {
        Product::UpdateCart($request);
    }

    //======= Delete Cart =======
    public function DeleteCart() {
        Cart::clear();
        Session::flash('success_msg', 'Cart Deleted');
        return redirect('/');
    }

    //======= Save Order =======
    public static function SaveOrder() {
        if (Session::has('user_id') && !Cart::isEmpty()) {
            if (Order::SaveNewOrder()) {
                Session::flash('success_msg', 'Order saved Succefully');
                self::$data['title'] .= "Home";
                return view('web.home', self::$data);
            }
        } else {
//            Session::flash('success_msg', 'You need to log in first!');
            self::$data['title'] .= "LogIn";
            return view('web.signin', self::$data)->withErrors('You must Log In First!');
        }
    }

    //======= Get Sign In Page =======
    public static function SignIn() {
        if (!Session::has('user_id')) {
            self::$data['title'] .= "LogIn";
            return view('web.signin', self::$data);
        } else {
            self::$data['title'] .= 'Home';
            return view('web.home', self::$data);
        }
    }

    //======= Get Sign Up Page =======
    public static function SignUp() {
        if (!Session::has('user_id')) {
            self::$data['title'] .= "SignUp";
            return view('web.signup', self::$data);
        } else {
            self::$data['title'] .= 'Home';
            return view('web.home', self::$data);
        }
    }

    //======= Sign in Request =======
    public static function SignInRequest(SignInRequest $request) {
        if (User::SignInRequest($request->email, $request->password)) {
            self::$data['title'] .= 'Home';
            return view('web.home', self::$data);
        } else {
            self::$data['title'] .= "LogIn";
            return view('web.signin', self::$data)->withErrors('Wrong Email OR Password');
        }
    }

    //======= Sign Up Request =======
    public function SignUpRequest(SignUpRequest $request) {
        if (User::SignUpNewUser($request)) {
            Session::flash('success_msg', 'You signed up successfully! Please Sign In!');
            return redirect('user/signin');
        }
    }

    //======= Get User Acount =======
    public static function GetAcount() {
        if (Session::has('user_id')) {
            $user_id = Session::get('user_id');
            $user = User ::where('id', '=', $user_id)->get()->toArray();
            $user = $user[0];
            self::$data['user'] = $user;
            self::$data['title'] .= 'My Acount';
            return view('web.useracount', self::$data);
        } else {
            self::$data['title'] .= "LogIn";
            return view('web.signin', self::$data)->withErrors('You must to Log In First');
        }
    }

    //======= Change User Password Request =======
    public function UserChangePassword(ChangePasswordRequest $request) {
        if (Session::has('user_id') && User::ChangePassword($request)) {
            Session::flash('success_msg', 'Your password changed successfully!');
            return redirect('/');
        }
    }

    //======= Change User Detailes Request =======
    public function UserChangeDetailes(Request $request) {
        if (Session::has('user_id') && User::ChangeDetailes($request)) {
            Session::flash('success_msg', 'Your Details Updated Successfully!');
            return redirect('/');
        }
    }

    //======= Change User Email Request =======
    public function UserChangeEmail(Request $request) {
        if (Session::has('user_id') && User::ChangeEmail($request)) {
            Session::flash('success_msg', 'Your Email Updated Successfully!');
            return redirect('/');
        } else {
            Session::flash('success_msg', 'This email already exist!');
            return redirect('user/useracount');
        }
    }

    //======= USER LOG OUT =======
    public function LogOut() {
        Session::flush();
        self::$data['title'] .= 'Home';
        return view('web.home', self::$data);
    }

    //======= Contact Us Request with Ajax from modal =======
    public static function ContactUs(ContactUsRequest $request) {
        if ($request) {
            if (Usermessage::AddMessage($request)) {
                $user['success'] = true;
                return Response::json($user);
            } else {
                $user['success'] = false;
                $user['errors'] = ['error' => 'failed'];
                return Response::json($user);
            }
        } else {
            $user['errors'] = ['error' => 'failed'];
            return Response::json($user);
        }
    }

}
