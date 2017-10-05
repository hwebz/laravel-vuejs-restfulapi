<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    #$ curl -X POST localhost:8000/api/login \
    #-H "Accept: application/json" \
    #-H "Content-type: application/json" \
    #-d "{\"email\": \"admin@test.com\", \"password\": \"toptal\" }"

    # Each login will render a new api_token for user
    # Send request with header: Authorization: Bearer OaeRNdw6nbqhfMMDB9aVmBweSUWPpfXWPh4t2pLiLe4n7444G84rF1l4OaSJ
    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray()
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json([
            'data' => 'User logged out.'
        ], 200);
    }
}
