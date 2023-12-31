<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
    
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('home');
            } else {
                $newUser = User::updateOrCreate([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('UnaContraseniaCualquiera')
                ]);
    
                Auth::login($newUser);
                return redirect()->intented('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
