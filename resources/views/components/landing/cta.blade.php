<section class="relative py-24 overflow-hidden bg-linear-to-br from-primary via-primary to-secondary" id="cta">
    <div class="absolute inset-0 pointer-events-none bg-[linear-gradient(to_right,#ffffff0F_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0F_1px,transparent_1px)] bg-size-[32px_32px]"></div>
    <div class="absolute top-0 -left-32 w-96 h-96 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -right-32 w-96 h-96 bg-accent/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-white text-sm font-semibold mb-6 backdrop-blur-sm">
            <i data-lucide="sparkles" class="w-4 h-4"></i> Mulai Konsultasi
        </div>

        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight tracking-tight mb-6">
            Diskusikan Proyek<br>
            <span class="text-white/80">Riset & Rekayasa Anda</span>
        </h2>

        <p class="text-lg text-white/70 max-w-2xl mx-auto mb-10 leading-relaxed">
            Konsultasikan kebutuhan riset terapan, kajian kebijakan, pengujian teknis, atau solusi engineering Anda kepada tim ahli NTU yang berpengalaman.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ config('company.contact.email') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-primary bg-white rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-xl shadow-black/10 group">
                Konsultasi dengan Ahli
                <i data-lucide="mail" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                Jelajahi Layanan
                <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="mt-12 flex flex-wrap justify-center gap-8 text-sm text-white/50">
            <span class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-white/70"></i> Tim Doktoral & Bersertifikat</span>
            <span class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-white/70"></i> Pengalaman Internasional</span>
            <span class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-white/70"></i> Berbasis Bukti</span>
            <span class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-white/70"></i> Respons Cepat</span>
        </div>
    </div>

    <style>
        #cta a:hover { transform: translateY(-2px); }
    </style>
</section>
