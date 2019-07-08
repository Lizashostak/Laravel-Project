<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

    //----- Get All contentss from DB 
    public static function GetAllContents() {
        $content = self::all()->toArray();
        return $content;
    }

    //get specific content
//    public static function GetContent($content) {
//        $content_from_db = Content::where([
//                    'title' => $content,
//                ])->get();
//        return $content_from_db;
//    }
    //----- Save New Content In DB -----
    public static function SaveNewContent($request) {
        $content = new self();
        $content->title = ucwords($request->title);
        $content->title_url = trim($request->title);
        $content->title_url = str_replace(' ', '_', $request->title);
        $content->article = $request->article;
        $content->save();
        if ($content->id) {
            return true;
        } else {
            return false;
        }
    }

    //----- Save Content In DB After Editing -----
    public static function SaveEditContent($request, $id) {
        $content = self::find($id);
        $content->title = ucwords($request->title);
        $content->title_url = trim($request->title);
        $content->title_url = str_replace(' ', '_', $request->title);
        $content->article = $request->article;
        $content->save();
        if ($content->id) {
            return true;
        } else {
            return false;
        }
    }

}
