<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Product;
use Session;
use App\Http\Requests\AddCategoryRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\ProductRequest;

class ProductController extends MainController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //======= Get All Products from the Shop All/Filltered by Category =======
    public function index() {
        if ($category_filter = Input::get('category')) {
//            $products = Product::where('cat_name', '=', $category_filter)->get();
            $products = Product::where('cat_name', '=', $category_filter)->paginate(10);
            self::$data['selected'] = $category_filter;
        } else {
//            $products = Product::all()->toArray();
            $products = Product::whereNotNull('id')->paginate(10);
        }
        $categories = Categorie::all()->toArray();
        self::$data['title'] .= 'CMS';
        self::$data['data'] = $products;
//        self::$data['products'] = $products_p;
        self::$data['page_name'] = 'Ski Expert | Products';
        self::$data['categories'] = $categories;
        return view('cms.get_products', self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //======= Show Form - create new Product =======
    public function create() {
        $categories = Categorie::all()->toArray();
        self::$data['categories'] = $categories;
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Add New Product';
        return view('cms.add_product', self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //======= Save new Product in DB =======
    public function store(ProductRequest $request) {
        if (Product::SaveNewProduct($request)) {
            Session::flash('success_msg', 'Product added to the Shop!');
            return redirect('cms/products');
        } else {
            Session::flash('success_msg', 'There was a problem to add Product to the Shop!');
            return redirect('cms/products');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Show Form - Editing Product =======
    public function edit($id) {
        $categories = Categorie::all()->toArray();
        self::$data['categories'] = $categories;
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Edit Product';
        self::$data['data'] = Product::find($id)->toArray();
        return view('cms.edit_product', self::$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Save Product after Editing =======
    public function update(Request $request, $id) {
        if (Product::SaveEditProduct($request, $id)) {
            Session::flash('success_msg', 'Product Updated!');
            return redirect('cms/products');
        } else {
            Session::flash('success_msg', 'Product could not be Updated!');
            return redirect('cms/products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Show msg before deleting Product =======
    public function show($id) {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Delete Product';
        self::$data['data'] = Product::find($id)->toArray();
        return view('cms.delete_product', self::$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Delete Product =======
    public function destroy($id) {
        Product::destroy($id);
        Session::flash('success_msg', 'Product Deleted!');
        return redirect('cms/products');
    }

}
