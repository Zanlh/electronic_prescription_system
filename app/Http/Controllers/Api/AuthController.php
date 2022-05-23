<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\medicine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function doctorRegister(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                
                'password' => ['required', 'string'],
                
            ]
        );

        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->save();

        $token = $doctor->createToken('Electronic Prescription System')->accessToken;

        return success('Successfully registered', ['token' => $token]);
    }

    public function doctorLogin(Request $request)
    {

        $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]
        );

        if (auth()->guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {
             $doctor = auth()->guard('doctor')->user();
            $token = $doctor->createToken('Electronic Prescription System')->accessToken;
            return success('Successfully Login', ['token' => $token]);
        }
        return fail('These credentials do not match our records', null);
    }


    public function doctorLogout(Request $request)
    {
        $request->user('doctor-api')->token()->revoke();
        return success('Successfully Logout', null);
    }

   
}
