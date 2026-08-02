@extends('layouts.admin')

@section('breadcrumb')
    <x-admin.page-header title="Profil" subtitle="Kelola foto profil, nama, dan keahlian Anda.">
    </x-admin.page-header>
@endsection

@section('content')
    <form method="POST" action="{{ panel_route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <x-card>
                    <div class="p-6 flex flex-col items-center text-center">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-4xl font-bold border-4 border-white shadow-lg shadow-primary/20">
                                @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                @endif
                            </div>
                        </div>

                        <label for="avatar" class="mt-4 inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors cursor-pointer">
                            <i data-lucide="camera" class="w-4 h-4"></i> Upload Foto
                        </label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG, WEBP, atau GIF. Maks 2MB.</p>
                        @error('avatar') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                    </div>
                </x-card>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <x-card>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700" placeholder="Nama lengkap Anda...">
                            @error('name') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="email">Email</label>
                            <input type="email" id="email" value="{{ $user->email }}" disabled
                                   class="w-full py-2.5 px-4 text-sm bg-gray-100 border border-gray-200 rounded-lg text-gray-400 cursor-not-allowed">
                            <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah dari halaman ini.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="skills">Keahlian</label>
                            <textarea id="skills" name="skills" rows="4" placeholder="Tuliskan keahlian Anda, pisahkan dengan koma (contoh: Riset Kebijakan, K3, Analisis Data)..."
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">{{ old('skills', $user->skills) }}</textarea>
                            @error('skills') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary mb-2" for="skills_en">Keahlian (English)</label>
                            <textarea id="skills_en" name="skills_en" rows="4" placeholder="Write your skills, separated by commas (e.g. Policy Research, OHS, Data Analysis)..."
                                      class="w-full py-2.5 px-4 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 text-gray-700">{{ old('skills_en', $user->skills_en) }}</textarea>
                            @error('skills_en') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </x-card>

                <div class="flex items-center gap-3 justify-end">
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('avatar');
        const previewWrap = document.querySelector('.relative .w-32.h-32');

        input.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                previewWrap.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
