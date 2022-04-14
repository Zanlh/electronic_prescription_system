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
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:10', 'unique:users'],
                'password' => ['required', 'string'],
                'license_number' => ['required', 'string', 'max:11'],
            ]
        );

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->license_number = $request->license_number;
        // FIX: Location
        $user->location_id = 1;
        $user->subscribe = 0;
        $user->occupation = $request->occupation;
        $user->high_priority = 0;
        $user->save();

        $token = $user->createToken('Road Side Assistant')->accessToken;

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
            $token = $user->createToken('Road Side Assistant')->accessToken;
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
