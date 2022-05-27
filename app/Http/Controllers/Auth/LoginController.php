<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)

    {

        $input = $request->all();

        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))

        {

            if (auth()->user()->role_id == 1) {

                return redirect()->route('admin.home');

            }
            if (auth()->user()->role_id == 2) {

                return redirect()->route('provider.home');

            }
            if (auth()->user()->role_id == 3) {

                return redirect()->route('customer.home');
            }

        }else{

            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();

    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
         dd($facebookUser);

        $appUser = User::firstOrCreate([
            'email' => $facebookUser->email()
        ], [
            'name' => $facebookUser->name(),
            'role_id' => 3,
            'provider_id' => $facebookUser->id
        ]);

        auth()->login($appUser);

        return redirect('/')->with('alert', "Bienvenido {$appUser->name}");

        // $user->token;
    }


}
