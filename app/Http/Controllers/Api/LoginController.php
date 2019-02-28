<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * Login user action
     * @param LoginUser $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function index(LoginUser $request)
    {
        // validate the request
        if (! $request->validated()) {
            return response()->json(['error' => $request->errors()], 401);
        }

        $params = $request->only('email', 'password');

        $email = $params['email'];
        $password = $params['password'];

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return Auth::user()->createToken('jwt', []);
        }

        return response()->json(['error' => 'Wrong email or password'], 401);
    }
}
