<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Content;
use App\Categorie;
use App\Usermessage;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class MainController extends Controller {

    public static $data;
    public static $items_data;

    public function __construct() {
        //======= gests/clients messages =======
        $messages = [];
        $users_messages_p = DB::table('usermessages')
                        ->select('*')
                        ->orderBy('created_at', 'desc')->paginate(10);
        foreach ($users_messages_p as $new_users_messages) {
            $messages[] = (array) $new_users_messages;
        }
        self::$data['messages'] = $messages;
        self::$data['messages_p'] = $users_messages_p;

        self::$data['title'] = 'SkiExpert | ';
        //======= get shop content =======
        $content = Content::GetAllContents();
        self::$data['content_data'] = $content;

        //======= get all shop categories =======
        $categories = Categorie::GetAllCategories();
        self::$data['categories'] = $categories;

        //======= get all items from cart =======
        $msgs = Usermessage::where('status', '0')->get()->toArray();
        self::$data['msgs'] = $msgs;
    }

}
