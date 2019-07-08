<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

    //get all categories from DB 
    public static function GetAllCategories() {
        $categories = self::all()->toArray();
        return $categories;
    }

    // this model have one to many relationship with Product model
    public function products() {
        return $this->hasMany('App\Product');
    }

    public static function SaveNewCategory($request) {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $request->file('image')->move(public_path() . '\img', $file_name);
        } else {
            $file_name = 'noimage.jpg';
        }
        $category = new self();
        $category->name = ucfirst($request->cat_name);
        $category->cat_url = str_replace([':', '\\', '/', '*', '%', ' '], '_', $request->cat_url);
        $category->image = $file_name;
        $category->description = $request->description;
        $category->save();
        if ($category->id) {
            return true;
        } else {
            return false;
        }
    }

    public static function SaveEditCategory($request, $id) {
        $category_exist_check = true;
        $category_name = ucfirst($request->name);
        $all_categories = Categorie::where('id', '!=', $id)->get()->toArray();

        foreach ($all_categories as $cat_name) {
            if ($cat_name['name'] == $category_name) {
                $category_exist_check = false;
            }
        }

        if ($category_exist_check) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $file_name = time() . $file->getClientOriginalName();
                $request->file('image')->move(public_path() . '\img', $file_name);
            }
            $category = self::find($id);
            $category->name = ucfirst($request->name);
            if ($request->hasFile('image')) {
                $category->image = $file_name;
            }
            $category->description = $request->description;
            $category->save();
            if ($category->id) {
                return true;
            } else {
                return false;
            }
        }
    }

}
