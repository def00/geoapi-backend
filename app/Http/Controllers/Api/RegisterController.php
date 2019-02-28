<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /***
     * Register user method
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RegisterUser $request)
    {
        if (! $request->validated()) {
            return response()->json(['error' => $request->errors()], 401);
        }

        $input = $request->all();

        // hash password
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        Auth::login($user);
        // create and response with JWT token
        return Auth::user()->createToken('jwt', []);
    }
}
