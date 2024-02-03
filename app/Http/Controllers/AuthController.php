<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthFilterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function check(AuthFilterRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        } 

         return to_route('auth.login')->withErrors([
            'email' => 'Les identifiants ne correspondent pas',
         ])->onlyInput('email');
        
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return to_route('auth.login');
    }
}
