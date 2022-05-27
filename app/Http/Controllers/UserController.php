<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function users() {
        return view('admin.users');
    }

    public function extractUsers() {
        $users = User::all();
        return datatables()->of($users)->toJson();
    }

    public function updateUser(Request $request) {
        $user = User::where('id', $request->input('user_id'))->first();
        $user->name = $request->input('name');
        $user->email = $request->input('user');
        if(!empty($request->input('password')) && !empty($request->input('c_password'))) {
            if($request->input('password')==$request->input('c_password')) {
                $user->password = bcrypt($request->input('password'));
            } else {
                return response()->json([
                    'status' => 'invalid'
                ]);
            }
        }
        if ($user->save()) {
            return response()->json([
                'status' => 'saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
