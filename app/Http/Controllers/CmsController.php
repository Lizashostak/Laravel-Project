<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Content;
use App\Categorie;
use App\Usermessage;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class CmsController extends MainController {

    public static function GetDashboard() {
        //======= Get Orders from last month - Chart From DB =======
        $date = [];
        $num_orders = [];
        $last_month = \Carbon\Carbon::today()->subDays(30);
        $orders = Order::where('created_at', '>=', $last_month)->get()
                        ->groupBy(function($item) {
                            return $item->created_at->format('d-m-y');
                        })->toArray();
        foreach ($orders as $key => $value) {
            $date[] = $key;
            $num_orders[] = count($value);
        }

        //======= Get income from last month - Chart From DB =======
        $last_month_income = \Carbon\Carbon::today()->subDays(30);
        $all_orders = [];
        $orders_income = [];
        $income = [];
        $income_date = [];
        $users_orders = DB::table('users')
                        ->join('orders', 'users.id', '=', 'orders.user_id')
                        ->select('users.*', 'orders.*')
                        ->where('orders.created_at', '>=', $last_month_income)->get();
        foreach ($users_orders as $new_user_order) {
            $all_orders[] = (array) $new_user_order;
        }
        foreach ($all_orders as &$orders_data) {
            $orders_data['data'] = unserialize($orders_data['data']);
        }
        foreach ($all_orders as $order) {
            $order['created_at'] = (new \DateTime($order['created_at']))->format('Y-m-d');
            $income_date[] = $order['created_at'];
            $sum = 0;
            foreach ($order['data'] as $price) {
                $sum += ($price['price'] * $price['quantity']);
            }
            $income[] = $sum;
        }

        for ($i = count($income_date) - 1; $i > 0; $i--) {
            if ($income_date[$i] == $income_date[$i - 1]) {
                unset($income_date[$i]);
                $income[$i - 1] = $income[$i] + $income[$i - 1];
                unset($income[$i]);
            }
        }
        $income = array_values($income);
        $income_date = array_values($income_date);

        self::$data['income'] = json_encode($income);
        self::$data['income_date'] = json_encode($income_date);

        //======= Get last week new users =======
        $last_week = \Carbon\Carbon::today()->subDays(7);
        $weekly_users = User::where('created_at', '>=', $last_week)->get()->toArray();

        //======= Get all users except admin =======
        $all_users = User::where('role', '!=', '6')->get()->toArray();

        //======= Get last day new orders =======
        $last_day = \Carbon\Carbon::today();
        $daily_orders = Order::where('created_at', '>=', $last_day)->get()->toArray();

        self::$data['weekly_new_users'] = count($weekly_users);
        self::$data['all_users'] = count($all_users);
        self::$data['daily_orders'] = count($daily_orders);
        self::$data['date'] = json_encode($date);
        self::$data['num_orders'] = json_encode($num_orders);
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Ski Expert | Main';
        return view('cms.dashboard', self::$data);
    }

    //======= Get Orders From DB =======
    public static function GetOrders() {
        $orders = [];
        $users_order = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->select('users.*', 'orders.*')
                ->orderBy('orders.created_at', 'desc')
                ->paginate(8);
        foreach ($users_order as $new_users_order) {
            $orders[] = (array) $new_users_order;
        }
        foreach ($orders as &$orders_data) {
            $orders_data['data'] = unserialize($orders_data['data']);
        }

        self::$data['orders'] = $orders;
        self::$data['users_order'] = $users_order;
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Ski Expert | Orders';
        return view('cms.orders', self::$data);
    }

    //======= Admin LogOut =======
    public static function LogOut() {
        Session::flush();
        self::$data['title'] .= 'Home';
        $categories = Categorie::GetAllCategories();
        $content = Content::GetAllContents();
        self::$data['content_data'] = $content;
        self::$data['categories'] = $categories;
        return view('web.home', self::$data);
    }

    //======= Get Messages From DB =======
    public static function GetMessages() {
        $messages = [];
        $users_messages_p = DB::table('usermessages')
                        ->select('*')
                        ->orderBy('created_at', 'desc')->paginate(15);
        foreach ($users_messages_p as $new_users_messages) {
            $messages[] = (array) $new_users_messages;
        }
        self::$data['messages'] = $messages;
        self::$data['messages_p'] = $users_messages_p;
        self::$data['title'] .= 'CMS';
        self::$data['page_name'] = 'Ski Expert | Messages';
        return view('cms.messages', self::$data);
    }

    //======= Update Read Messages Request =======
    public static function ReadMessages(Request $request) {
        if (Usermessage::UpdateStatus($request)) {
            $msgs = Usermessage::where('status', '0')->get()->toArray();
            return Response::json($msgs);
        }
    }

    //======= Delete client message =======
    public static function DeleteMessage(Request $request) {
        if ($request->msg_id) {
            Usermessage::destroy($request->msg_id);
        }
    }

}
