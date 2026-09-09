{{-- Step 2: Data Perusahaan --}}
@php
    $company = $user->customerProfile->company ?? null;
@endphp

<h2 class="text-lg font-bold text-[#06205E] mb-6">Data Perusahaan</h2>

<div x-data="companySelector()" x-init="init()">
    {{-- Company Selection --}}
    <div class="mb-6 p-4 bg-[#0736AA]/5 border border-[#0736AA]/15 rounded-xl">
        <label class="block text-sm font-semibold text-[#06205E] mb-2">Pilih Perusahaan</label>
        <p class="text-xs text-gray-500 mb-3">Pilih perusahaan yang sudah pernah digunakan atau masukkan data baru.</p>
        <div class="flex flex-col sm:flex-row gap-3">
            <select x-model="selectedCompany" @change="onCompanyChange()"
                class="flex-1 rounded-xl border border-gray-300 bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4">
                <option value="new">Perusahaan Baru</option>
                <template x-for="company in companies" :key="company.id">
                    <option :value="company.id" x-text="company.name"></option>
                </template>
            </select>
        </div>
    </div>

    {{-- Company Fields --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Nama Perusahaan --}}
        <div class="md:col-span-2">
            <label for="company_name" class="block text-sm font-semibold text-[#06205E] mb-1.5">Nama Perusahaan <span class="text-red-500">*</span></label>
            <input type="text" id="company_name" name="company_name"
                x-model="formData.name"
                value="{{ old('company_name', $draft['company_name'] ?? $company->name ?? '') }}"
                required
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Masukkan nama perusahaan">
            @error('company_name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="md:col-span-2">
            <label for="company_address" class="block text-sm font-semibold text-[#06205E] mb-1.5">Alamat</label>
            <textarea id="company_address" name="company_address" rows="3"
                x-model="formData.address"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4 resize-none"
                placeholder="Masukkan alamat perusahaan">{{ old('company_address', $draft['company_address'] ?? $company->address ?? '') }}</textarea>
        </div>

        {{-- Provinsi --}}
        <div>
            <label for="company_province" class="block text-sm font-semibold text-[#06205E] mb-1.5">Provinsi</label>
            <input type="text" id="company_province" name="company_province"
                x-model="formData.province"
                value="{{ old('company_province', $draft['company_province'] ?? $company->province ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Jawa Barat">
        </div>

        {{-- Kota/Kabupaten --}}
        <div>
            <label for="company_city" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kota / Kabupaten</label>
            <input type="text" id="company_city" name="company_city"
                x-model="formData.city"
                value="{{ old('company_city', $draft['company_city'] ?? $company->city ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Bandung">
        </div>

        {{-- Kecamatan --}}
        <div>
            <label for="company_district" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kecamatan</label>
            <input type="text" id="company_district" name="company_district"
                x-model="formData.district"
                value="{{ old('company_district', $draft['company_district'] ?? $company->district ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: Coblong">
        </div>

        {{-- Kode Pos --}}
        <div>
            <label for="company_postal_code" class="block text-sm font-semibold text-[#06205E] mb-1.5">Kode Pos</label>
            <input type="text" id="company_postal_code" name="company_postal_code"
                x-model="formData.postal_code"
                value="{{ old('company_postal_code', $draft['company_postal_code'] ?? $company->postal_code ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Contoh: 40132">
        </div>

        {{-- Telepon Perusahaan --}}
        <div>
            <label for="company_phone" class="block text-sm font-semibold text-[#06205E] mb-1.5">Telepon Perusahaan</label>
            <input type="tel" id="company_phone" name="company_phone"
                x-model="formData.phone"
                value="{{ old('company_phone', $draft['company_phone'] ?? $company->phone ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="022-xxxxxxx">
        </div>

        {{-- Email Perusahaan --}}
        <div>
            <label for="company_email" class="block text-sm font-semibold text-[#06205E] mb-1.5">Email Perusahaan</label>
            <input type="email" id="company_email" name="company_email"
                x-model="formData.email"
                value="{{ old('company_email', $draft['company_email'] ?? $company->email ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="info@perusahaan.com">
        </div>

        {{-- NIB --}}
        <div>
            <label for="company_nib" class="block text-sm font-semibold text-[#06205E] mb-1.5">NIB <span class="text-gray-400 font-normal">(opsional)</span></label>
            <input type="text" id="company_nib" name="company_nib"
                x-model="formData.nib"
                value="{{ old('company_nib', $draft['company_nib'] ?? $company->nib ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Nomor Induk Berusaha">
        </div>

        {{-- NPWP --}}
        <div>
            <label for="company_npwp" class="block text-sm font-semibold text-[#06205E] mb-1.5">NPWP <span class="text-gray-400 font-normal">(opsional)</span></label>
            <input type="text" id="company_npwp" name="company_npwp"
                x-model="formData.npwp"
                value="{{ old('company_npwp', $draft['company_npwp'] ?? $company->npwp ?? '') }}"
                class="w-full rounded-xl border border-gray-300 bg-gray-50/60 focus:bg-white focus:ring-4 focus:ring-[#0736AA]/15 focus:border-[#0736AA] outline-none transition-all text-sm py-2.5 px-4"
                placeholder="Nomor Pokok Wajib Pajak">
        </div>
    </div>
</div>

<script>
    function companySelector() {
        return {
            companies: [],
            selectedCompany: 'new',
            formData: {
                name: '{{ addslashes(old("company_name", $draft["company_name"] ?? $company->name ?? "")) }}',
                address: '{{ addslashes(old("company_address", $draft["company_address"] ?? $company->address ?? "")) }}',
                province: '{{ addslashes(old("company_province", $draft["company_province"] ?? $company->province ?? "")) }}',
                city: '{{ addslashes(old("company_city", $draft["company_city"] ?? $company->city ?? "")) }}',
                district: '{{ addslashes(old("company_district", $draft["company_district"] ?? $company->district ?? "")) }}',
                postal_code: '{{ addslashes(old("company_postal_code", $draft["company_postal_code"] ?? $company->postal_code ?? "")) }}',
                phone: '{{ addslashes(old("company_phone", $draft["company_phone"] ?? $company->phone ?? "")) }}',
                email: '{{ addslashes(old("company_email", $draft["company_email"] ?? $company->email ?? "")) }}',
                nib: '{{ addslashes(old("company_nib", $draft["company_nib"] ?? $company->nib ?? "")) }}',
                npwp: '{{ addslashes(old("company_npwp", $draft["company_npwp"] ?? $company->npwp ?? "")) }}',
            },

            async init() {
                try {
                    const response = await fetch('{{ route("customer.requests.companies") }}', {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    if (response.ok) {
                        this.companies = await response.json();
                    }
                } catch (e) {
                    console.error('Failed to load companies:', e);
                }
            },

            onCompanyChange() {
                if (this.selectedCompany === 'new') {
                    this.formData = { name: '', address: '', province: '', city: '', district: '', postal_code: '', phone: '', email: '', nib: '', npwp: '' };
                } else {
                    const company = this.companies.find(c => c.id === this.selectedCompany);
                    if (company) {
                        this.formData = {
                            name: company.name || '',
                            address: company.address || '',
                            province: company.province || '',
                            city: company.city || '',
                            district: company.district || '',
                            postal_code: company.postal_code || '',
                            phone: company.phone || '',
                            email: company.email || '',
                            nib: company.nib || '',
                            npwp: company.npwp || '',
                        };
                    }
                }
            }
        };
    }
</script>
