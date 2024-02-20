<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $user = Socialite::driver($driver)->user();

        Auth::login($this->findOrCreate($driver, $user));

        return redirect()->intended();
    }

    public function findOrCreate($driver, $user)
    {
        return User::firstOrCreate([
            'email' => $user->getEmail()
        ],
        [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'provider' => $driver,
            'provider_id' => $user->user['id'],
            'email_verified_at' => now(),
        ]);
    }
}
