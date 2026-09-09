<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SignUpController extends Controller
{
    public function create(): View
    {
        return view('auth.customer-sign-up');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
            'company_name' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            $companyId = null;

            if (! empty($validated['company_name'])) {
                $company = Company::create([
                    'name' => $validated['company_name'],
                ]);
                $companyId = $company->id;
            }

            CustomerProfile::create([
                'user_id' => $user->id,
                'company_id' => $companyId,
                'full_name' => $validated['name'],
                'phone' => $validated['phone'],
            ]);

            $user->assignRole('customer');
        });

        $user = User::where('email', $validated['email'])->first();

        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect()->route('customer.verification.notice')
            ->with('status', __('Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.'));
    }
}
