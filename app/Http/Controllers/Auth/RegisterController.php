<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\CustomerWelcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);
        if ($data['role_id'] == 2) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:200'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'city' => ['required', 'string'],
                'role_id' => ['required', 'integer'],
                'telefono' => ['required', 'numeric'],
                'category_id' => ['required', 'integer'],
                'url' => ['required', 'url'],
                'adress' => ['required', 'string'],
                'contact' => ['required', 'string']
            ]);
        }
        if ($data['role_id'] == 3) if ($data['accept'] == 1) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'genre' => ['required', 'string'],
                'role_id' => ['required', 'integer']
            ]);
        } else {
            return redirect('home/dashboard');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if ($data['role_id'] == 3) {
           $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
            ]);

           $novia = $data['genre'] == 'novia' ? $data['name'] : null;
           $novio = $data['genre'] == 'novio' ? $data['name'] : null;

            $user->customer()->create([
                'boyfriend_name' => $novia,
                'girlfriend_name' => $novio,
            ]);

            Mail::to($user->email)->send(new CustomerWelcome($user));
        }

        if ($data['role_id'] == 2) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
            ]);
            $user->provider()->create([
                'category_id' => $data['category_id'],
            ]);
        }
        return $user;
    }

}
