<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RegisterRequest;
use App\Traits\RateLimitTrait;

class AdminAuthController extends Controller
{
    use RateLimitTrait;

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $throttleKey = 'login|' . $request->ip() . '|' . strtolower($request->input('name'));

        if ($response = $this->checkThrottle($throttleKey)) {
            return $response;
        }
        
        $credentials = $request->only('name', 'password');

        if(Auth::attempt($credentials, $request->filled('remember')))
        {
            $request->session()->regenerate();
            
            RateLimiter::clear($throttleKey);

            return redirect()->route('products.index');
        }

        return back()->withErrors(['name' => 'Неверный логин или пароль']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('auth.login');
    }
}