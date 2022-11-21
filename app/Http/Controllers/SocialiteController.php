<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function loginWithFacebook()
    {

        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $isUser = User::where('email', $user->email)->first();

            if($isUser){
                $isUser->id = $user->id;
                $isUser->save();
                auth()->login($isUser);
                session()->flash('flash.banner', 'Facebook login success!');
                session()->flash('flash.bannerStyle', 'success');
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt(Str::random(10)),
                ]);
                auth()->login($createUser);

                session()->flash('flash.banner', 'Facebook login success! Your password was emailed to you.');
                session()->flash('flash.bannerStyle', 'success');

                return redirect('/dashboard');
            }
    
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function twitterRedirect()
    {
        return Socialite::driver('twitter-oauth-2')->redirect();
    }

    public function loginWithTwitter()
    {
        try {
            $user = Socialite::driver('twitter-oauth-2')->user();
            $isUser = User::where('email', $user->email)->first();
            if($isUser){
                $isUser->id = $user->id;
                $isUser->save();
                auth()->login($isUser);
                session()->flash('flash.banner', 'Twitter login success!');
                session()->flash('flash.bannerStyle', 'success');
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'twitter_id' => $user->id,
                    'password' => bcrypt(Str::random(10)),
                ]);
                auth()->login($createUser);
                session()->flash('flash.banner', 'Twitter login success! Your password was emailed to you.');
                session()->flash('flash.bannerStyle', 'success');

                return redirect('/dashboard');
            }
    
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $isUser = User::where('email', $user->email)->first();
            if($isUser){
                $isUser->id = $user->id;
                $isUser->save();
                auth()->login($isUser);
                session()->flash('flash.banner', 'Google login success!');
                session()->flash('flash.bannerStyle', 'success');
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt(Str::random(10)),
                ]);
                auth()->login($createUser);
                session()->flash('flash.banner', 'Google login success! Your password was emailed to you.');
                session()->flash('flash.bannerStyle', 'success');

                return redirect('/dashboard');
            }
    
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
