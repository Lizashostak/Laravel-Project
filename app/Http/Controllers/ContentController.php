<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Session;
use App\Http\Requests\AddCategoryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ContentController extends MainController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //======= Get All Shop Content =======
    public function index() {
        $content = Content::all()->toArray();
//        $content = Content::whereNotNull('title')->paginate(1);
        self::$data['title'] .= 'CMS';
        self::$data['content'] = $content;
        self::$data['page_name'] = 'Ski Expert | Pages';
        return view('cms.get_contents', self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //======= Show Form - create new Content =======
    public function create() {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Add New Page';
        return view('cms.add_content', self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //======= Save new Content in DB =======
        if (Content::SaveNewContent($request)) {
            Session::flash('success_msg', 'Page added to the Shop!');
            return redirect('cms/contents');
        } else {
            Session::flash('success_msg', 'There was a problem to add Page to the Shop!');
            return redirect('cms/contents');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Show Form - Editing Content =======
    public function edit($id) {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Edit Page';
        self::$data['data'] = Content::find($id)->toArray();
        return view('cms.edit_content', self::$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Save Content after Editing =======
    public function update(Request $request, $id) {
        if (Content::SaveEditContent($request, $id)) {
            Session::flash('success_msg', 'Content Updated!');
            return redirect('cms/contents');
        } else {
            Session::flash('success_msg', 'Content could not be Updated!');
            return redirect('cms/contents');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Show msg before deleting Content =======
    public function show($id) {
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Delete Page';
        self::$data['data'] = Content::find($id)->toArray();
        return view('cms.delete_content', self::$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //======= Delete Content =======
    public function destroy($id) {
        Content::destroy($id);
        Session::flash('success_msg', 'Page Deleted!');
        return redirect('cms/contents');
    }

}
