<footer class="bg-secondary text-white pt-20 pb-10" id="contact">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <div class="lg:col-span-1">
                <img src="{{ asset('images/logo/footer-logo.png') }}" alt="NTU Logo White" class="h-12 w-auto mb-6 brightness-0 invert opacity-90" onerror="this.src='https://ui-avatars.com/api/?name=NTU&background=0736AA&color=fff&rounded=true'">
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    {{ config('company.tagline') }}
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.linkedin.com/company/{{ config('company.slug') }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white hover:scale-110 transition-all duration-300">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zM7.119 20.452H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/{{ config('company.slug') }}" target="_blank" rel="noopener" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white hover:scale-110 transition-all duration-300">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/{{ config('company.slug') }}" target="_blank" rel="noopener" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white hover:scale-110 transition-all duration-300">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-white mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Layanan</a></li>
                    <li><a href="{{ route('leadership') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Tim Kami</a></li>
                    <li><a href="{{ route('research') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Riset</a></li>
                    <li><a href="{{ route('articles') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Artikel</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-white mb-6">Pilar Layanan</h3>
                <ul class="space-y-3">
                    @foreach(config('company-services.categories') as $cat)
                    <li><a href="{{ route('services.show', $cat['slug']) }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> {{ $cat['short_title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-white mb-6">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-gray-400 text-sm">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary shrink-0 mt-0.5"></i>
                        <span>{{ config('company.contact.address') }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <i data-lucide="phone" class="w-5 h-5 text-primary shrink-0"></i>
                        <a href="tel:+6281807138156" class="hover:text-primary transition-colors">{{ config('company.contact.phone') }}</a>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <i data-lucide="mail" class="w-5 h-5 text-primary shrink-0"></i>
                        <a href="mailto:{{ config('company.contact.email') }}" class="hover:text-primary transition-colors">{{ config('company.contact.email') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm mb-4 md:mb-0">
                &copy; {{ date('Y') }} {{ config('company.name') }}. Hak Cipta Dilindungi.
            </p>
            <div class="flex space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
