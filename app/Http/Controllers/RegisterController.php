<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {

        // dd($request);

        if(Auth::check()) return redirect(route('admin'));

        $validate = $request->validate([
            'login' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password2'
        ]);

        $user = new User;
        $user->name = $validate['login'];
        $user->email = $validate['email'];
        $user->password = Hash::make($validate['password']);

        if($user->save()) {
            Auth::login($user);
            return redirect(route('admin'));
        }

        return redirect()->back();
    }
}
