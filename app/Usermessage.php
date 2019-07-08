<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Session;

class Usermessage extends Model {

// ----- Add User Message to DB -----
    public static function AddMessage($request) {
        if ($request) {
            $message = new self();
            $message->name = str_replace([':', '\\', '/', '*', '%', ' \'', '\"', '<', '>'], ' ', $request->name);
            $message->email = $request->email;
            $message->message = str_replace([':', '\\', '/', '*', '%', ' \'', '\"', '<', '>'], ' ', $request->message);
            $message->status = 0;
            $message->save();
            if ($message->id) {
                return true;
            } else {
                return false;
            }
        }
    }

    // ----- Update Msg Status -----
    public static function UpdateStatus($request) {
        if ($request->new_status == 'read') {
            $msg = self::find($request->msg_id);
            $msg->status = 1;
            $msg->save();
            return true;
        }
    }

    public static function getUnreadMsg() {
        $msgs = Usermessage::where('status', '0')->get()->toArray();
        $msgs = count($msgs);
        return $msgs;
    }

}
