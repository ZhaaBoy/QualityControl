<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerAction(Request $request)
    {
        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Contoh: Setidaknya 8 karakter, memiliki huruf besar, huruf kecil, dan angka
            $uppercase = preg_match('/[A-Z]/', $value);
            $lowercase = preg_match('/[a-z]/', $value);
            $number = preg_match('/[0-9]/', $value);

            return $uppercase && $lowercase && $number && strlen($value) >= 8;
        });

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['toast_error' => $validator->errors()->first()]);
        }

        $role = json_decode(Setting::first()->data)->role;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole($role);

        // Login pengguna setelah registrasi
        Auth::login($user);

        return redirect('dashboard')->with('toast_success', 'Anda Berhasil Mendaftar!');
    }
}
