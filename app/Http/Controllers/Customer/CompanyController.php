<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function edit(): View
    {
        $user = auth()->user();
        $user->load('customerProfile.company');

        return view('customer.company', [
            'user' => $user,
            'company' => $user->customerProfile->company ?? null,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $profile = $user->customerProfile;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'province' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'nib' => ['nullable', 'string', 'max:255'],
            'npwp' => ['nullable', 'string', 'max:255'],
        ]);

        if ($profile && $profile->company_id) {
            $company = Company::find($profile->company_id);
            $company->update($validated);
        } else {
            $validated['slug'] = Str::slug($validated['name']);
            $company = Company::create($validated);

            if ($profile) {
                $profile->update(['company_id' => $company->id]);
            } else {
                $user->customerProfile()->create([
                    'full_name' => $user->name,
                    'company_id' => $company->id,
                ]);
            }
        }

        return back()->with('status', 'Profil perusahaan berhasil diperbarui.');
    }
}
