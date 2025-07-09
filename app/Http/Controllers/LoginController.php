<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CaptchaCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login()
    {
        $title = "Login";
        return view('auth.Login', compact('title'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->with('toast_success', 'Successfully logged out!');
    }
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            // 'captcha' => ['required', new CaptchaCheck]
        ])->validate();

        if (!Auth::attempt($request->only('name','password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'name' => trans('auth.failed')
            ]);
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->log_user = 'login';
        $user->tanggal_login = Carbon::now()->toDateTimeString();
        $user->update();

        $request->session()->regenerate();

        $route_get = User::GetFirstRoute()->first();

        return redirect(route($route_get->route))->with('toast_success', 'Welcome Back! ' . Auth::user()->name);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
