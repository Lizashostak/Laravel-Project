<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Session;

class User extends Model {

    //----- SignInRequest -----
    public static function SignInRequest($email, $password) {
        $valid = FALSE;
        if ($user = self::where('email', '=', $email)->get()->toArray()) {
            $user = $user[0];
            if (Hash::check($password, $user['password'])) {
                if ($user['role'] == 6) {
                    Session::put('user_id', $user['id']);
                    Session::put('user_fname', ucfirst($user['first_name']));
                    Session::put('user_lname', ucfirst($user['last_name']));
                    Session::put('is_admin', 'true');
                    $valid = true;
                } else {
                    Session::put('user_id', $user['id']);
                    Session::put('user_fname', ucfirst($user['first_name']));
                    Session::put('user_lname', ucfirst($user['last_name']));
                    $valid = true;
                }
                return $valid;
            } else {
                return $valid;
            }
        } else {
            return $valid;
        }
    }

    //----- SignUpNewUser -----
    public static function SignUpNewUser($request) {
        $user = new self();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 1;
        $user->save();
        return true;
    }

    //----- ChangePassword -----
    public static function ChangePassword($request) {
        $user_id = Session::get('user_id');
        $user = self::find($user_id);
        $user->password = bcrypt($request->password);
        $user->save();
        return true;
    }

    //----- Change User Detailes -----
    public static function ChangeDetailes($request) {
        $user_id = Session::get('user_id');
        $user = self::find($user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        return true;
    }

    //----- Change User Email -----
    public static function ChangeEmail($request) {
        $email_check = true;
        $user_id = Session::get('user_id');
        $user = self::find($user_id);
        $user_email = $user->attributes['email'];
        $all_users = User::where('id', '!=', $user_id)->get()->toArray();

        foreach ($all_users as $all_users_email) {
            if ($all_users_email['email'] == $request->email) {
                $email_check = false;
            }
        }
        if ($email_check) {
            $user->email = $request->email;
            $user->save();
            return true;
        }
    }

    //----- Get All Users -----
    public static function GetAllUsers() {
        $users = self::all()->toArray();
        return $users;
    }

    // this model have one to many relationship with Order model
    public function orders() {
        return $this->hasMany('App\Order');
    }

}
