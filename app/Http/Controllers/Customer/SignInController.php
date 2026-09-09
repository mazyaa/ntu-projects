<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignInController extends Controller
{
    public function create(Request $request): View
    {
        if ($request->has('redirect')) {
            $redirect = $request->query('redirect');
            if (str_starts_with($redirect, '/') && ! str_starts_with($redirect, '//')) {
                $request->session()->put('login_redirect', $redirect);
                $request->session()->flash('toast', [
                    'type' => 'info',
                    'message' => 'Silakan login terlebih dahulu untuk melanjutkan.',
                ]);
            }
        }

        return view('auth.customer-sign-in');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => __('Kredensial yang diberikan tidak valid.'),
            ])->onlyInput('email');
        }

        $user = Auth::user();

        if ($user->hasAnyRole(['super_admin', 'admin', 'editor'])) {
            Auth::logout();

            return back()->withErrors([
                'email' => __('Akun ini tidak memiliki akses customer.'),
            ])->onlyInput('email');
        }

        if (! $user->hasVerifiedEmail()) {
            Auth::logout();

            return redirect()->route('customer.verification.notice');
        }

        $request->session()->regenerate();

        $redirect = $request->session()->pull('login_redirect', route('customer.dashboard'));

        return redirect($redirect);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
