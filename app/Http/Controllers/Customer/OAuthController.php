<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerProfile;
use App\Models\User;
use App\Models\UserOauthAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            $oauthAccount = UserOauthAccount::where('provider', 'google')
                ->where('provider_user_id', $socialUser->getId())
                ->first();

            if ($oauthAccount) {
                Auth::login($oauthAccount->user);
            } else {
                $existingUser = User::where('email', $socialUser->getEmail())->first();

                if ($existingUser) {
                    if (is_null($existingUser->email_verified_at)) {
                        $existingUser->update(['email_verified_at' => now()]);
                    }

                    $existingUser->oauthAccounts()->create([
                        'provider' => 'google',
                        'provider_user_id' => $socialUser->getId(),
                        'provider_email' => $socialUser->getEmail(),
                    ]);

                    Auth::login($existingUser);
                } else {
                    $user = User::create([
                        'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                        'email' => $socialUser->getEmail(),
                        'email_verified_at' => now(),
                        'password' => Str::random(60),
                    ]);

                    CustomerProfile::create([
                        'user_id' => $user->id,
                        'full_name' => $socialUser->getName(),
                    ]);

                    $user->oauthAccounts()->create([
                        'provider' => 'google',
                        'provider_user_id' => $socialUser->getId(),
                        'provider_email' => $socialUser->getEmail(),
                    ]);

                    $user->assignRole('customer');

                    Auth::login($user);
                }
            }

            $request = request();
            $request->session()->regenerate();

            return redirect()->intended(route('customer.dashboard'));
        } catch (\Exception $e) {
            Log::error('Google OAuth error: '.$e->getMessage());

            return redirect()->route('customer.login')
                ->withErrors(['email' => __('Terjadi kesalahan saat login dengan Google.')]);
        }
    }
}
