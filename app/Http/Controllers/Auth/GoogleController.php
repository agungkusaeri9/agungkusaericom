<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect_to_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $user = Socialite::driver('google')->user();
            // cek user
            $findUser = User::where('google_id',$user->getId())->orWhere('email',$user->getEmail())->first();
            if($findUser)
            {
                Auth::login($findUser);
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('login')->with('error','Pengguna tidak terdaftar!');
            }
        // try {
        //     $user = Socialite::driver('google')->user();
        //     // cek user
        //     $findUser = User::where('google_id',$user->getId())->first();
        //     if($findUser)
        //     {
        //         Auth::login($findUser);
        //         return redirect()->intended('home');
        //     }else{
        //         $newUser = User::create([
        //             'name' => $user->getName(),
        //             'username' => \Str::replace(' ', $user->getName()) . rand(100,1000),
        //             'google_id' => $user->getId(),
        //             'email' => $user->getEmail(),
        //             'password' => bcrypt($user->getEmail() . $user->getId())
        //         ]);

        //         Auth::login($newUser);
        //         return redirect()->intended('home');
        //     }
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return redirect()->route('login')->with('error','Login Gagal!');
        // }
    }
}
