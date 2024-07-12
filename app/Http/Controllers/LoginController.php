<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function autherticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('accunt.dashboard');
            } else {
                return redirect()->route('account.login')->with('error', 'Either Email or Password is Incorrect.');
            }

        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    public function register()
    {

        return view('register');
    }

    public function ProcessRegister(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->passes()) {
            // Insert Data 
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('account.login')->with('success', 'You have Registered Successfully.');

        } else {
            return redirect()->route('accunt.register')->withInput()->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

}
