<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function userRegister(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                
                'password' => ['required', 'string'],
                
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('Electronic Prescription System')->accessToken;

        return success('Successfully registered', ['token' => $token]);
    }

    public function userLogin(Request $request)
    {

        $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken('Electronic Prescription System')->accessToken;
            return success('Successfully Login', ['token' => $token]);
        }
        return fail('These credentials do not match our records', null);
    }

    public function userLogout()
    {
        $user = auth()->user();
        $user->token()->revoke();
        return success('Successfully Logout', null);
    }
}
