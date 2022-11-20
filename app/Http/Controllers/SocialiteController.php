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
                Auth::login($isUser);
                return redirect()->route('dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt($user->name . Str::random(5)),
                ]);
    
                Auth::login($createUser);
                return redirect('/dashboard')->with('success', 'Facebook login success! Please save your password. Password: ' . $createUser->password);
            }
    
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
