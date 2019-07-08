<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use Session;
use App\Http\Requests\AddCategoryRequest;

class CategorieController extends MainController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ======= Get All Categories from the Shop =======
    public function index() {
        $categories = Categorie::all()->toArray();
        self::$data['title'] .= 'CMS';
        self::$data['data'] = $categories;
        self::$data['page_name'] = 'SSki Expert | Categories';
        return view('cms.get_categories', self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ======= Show Form - create new Category =======
    public function create() {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Add New Category';
        return view('cms.add_category', self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoryRequest $request) {
        // ======= Save new Category in DB =======
        if (Categorie::SaveNewCategory($request)) {
            Session::flash('success_msg', 'Category added to the Shop!');
            return redirect('cms/categories');
        } else {
            Session::flash('success_msg', 'There was a problem to add Category to the Shop!');
            return redirect('cms/categories');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ======= Show Form - Editing Category =======
    public function edit($id) {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Edit Category';
        self::$data['data'] = Categorie::find($id)->toArray();
        return view('cms.edit_category', self::$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ======= Save Category after Editing =======
    public function update(Request $request, $id) {
        if (Categorie::SaveEditCategory($request, $id)) {
            Session::flash('success_msg', 'Category Updated!');
            return redirect('cms/categories');
        } else {
            Session::flash('success_msg', 'Category could not be Updated!');
            return redirect('cms/categories');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ======= Show msg before deleting Category =======
    public function show($id) {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Delete Category';
        self::$data['data'] = Categorie::find($id)->toArray();
        return view('cms.delete_category', self::$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ======= Delete Category =======
    public function destroy($id) {
        Categorie::destroy($id);
        Session::flash('success_msg', 'Category Deleted!');
        return redirect('cms/categories');
    }

}
