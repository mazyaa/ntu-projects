@extends('layouts.landing')

@section('title', 'Riset')

@section('content')
    @php
        $allProjects = [];
        foreach ($personnel as $p) {
            foreach ($p['projects'] as $pr) {
                $allProjects[] = $pr;
            }
        }
        $uniqueClients = count(array_unique(array_column($allProjects, 'client')));
    @endphp

    <x-landing.page-hero
        :title="'Rekam Jejak Riset & Kajian'"
        :subtitle="'Riset terapan dan kajian kebijakan berbasis bukti yang telah dikerjakan personil kunci NTU untuk pemerintah, industri, dan organisasi internasional.'"
    />

    <section class="py-24 bg-white relative overflow-hidden"
        x-data="{
            open: null,
            search: '',
            matchProject(p) {
                const q = this.search.trim().toLowerCase();
                if (!q) return true;
                return [p.title, p.client, p.year, p.role].some(v => String(v).toLowerCase().includes(q));
            },
            personMatch(projects) {
                return projects.some(p => this.matchProject(p));
            },
            hasResults() {
                const q = this.search.trim().toLowerCase();
                if (!q) return true;
                return {{ json_encode($allProjects) }}.some(p => {
                    return [p.title, p.client, p.year, p.role].some(v => String(v).toLowerCase().includes(q));
                });
            }
        }">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-primary/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-14" data-aos="fade-up">
                <div class="glass-card rounded-3xl p-6 text-center">
                    <div class="text-4xl font-bold text-primary mb-1">{{ count($allProjects) }}</div>
                    <p class="text-sm text-gray-500 font-medium">Total Kajian & Proyek</p>
                </div>
                <div class="glass-card rounded-3xl p-6 text-center">
                    <div class="text-4xl font-bold text-accent mb-1">{{ $uniqueClients }}</div>
                    <p class="text-sm text-gray-500 font-medium">Mitra & Pemberi Kerja</p>
                </div>
                <div class="glass-card rounded-3xl p-6 text-center">
                    <div class="text-4xl font-bold text-secondary mb-1">{{ count($personnel) }}</div>
                    <p class="text-sm text-gray-500 font-medium">Personil Kunci</p>
                </div>
            </div>

            <div class="relative max-w-xl mx-auto mb-16" data-aos="fade-up">
                <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"></i>
                <input type="text" x-model="search" placeholder="Cari kajian, mitra, tahun, atau peran..."
                    class="w-full pl-12 pr-12 py-4 rounded-2xl border border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-sm outline-none">
                <button type="button" x-show="search !== ''" @click="search = ''" style="display: none;"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors" aria-label="Bersihkan pencarian">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="space-y-6">
                @foreach($personnel as $index => $person)
                <div class="glass-card rounded-3xl overflow-hidden transition-shadow duration-300 hover:shadow-xl hover:shadow-gray-200/50" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <button @click="open = open === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center gap-4 p-6 lg:p-8 text-left hover:bg-white/40 transition-colors">
                        <div class="w-14 h-14 shrink-0 rounded-full overflow-hidden ring-2 ring-primary/20">
                            <img src="{{ asset($person['image']) }}" alt="{{ $person['name'] }}" loading="lazy" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg lg:text-xl font-bold text-secondary leading-tight">{{ $person['name'] }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $person['role'] }}</p>
                        </div>
                        <span class="hidden sm:inline-flex shrink-0 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold whitespace-nowrap">
                            {{ count($person['projects']) }} Proyek
                        </span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 transition-transform duration-300 shrink-0" :class="open === {{ $index }} ? 'rotate-180' : ''"></i>
                    </button>

                    <div class="grid transition-all duration-500 ease-in-out" :class="(open === {{ $index }} || search !== '') ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                        <div class="overflow-hidden min-h-0">
                            <div class="px-6 lg:px-8 pb-8">
                            <p class="text-sm text-gray-500 leading-relaxed mb-6">{{ $person['summary'] }}</p>

                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-sm min-w-[720px]">
                                    <thead>
                                        <tr class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                            <th class="py-3 pr-4 w-10">No</th>
                                            <th class="py-3 pr-4">Uraian Kajian / Proyek</th>
                                            <th class="py-3 pr-4 w-52">Pemberi Kerja / Pendana</th>
                                            <th class="py-3 pr-4 w-24">Tahun</th>
                                            <th class="py-3 w-44">Peran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($person['projects'] as $pIndex => $project)
                                        <tr class="border-b border-gray-50 last:border-0" x-show='matchProject({{ json_encode($project) }})'>
                                            <td class="py-4 pr-4 text-gray-400 font-medium">{{ $pIndex + 1 }}</td>
                                            <td class="py-4 pr-4 text-secondary font-medium leading-relaxed">{{ $project['title'] }}</td>
                                            <td class="py-4 pr-4 text-gray-500">{{ $project['client'] }}</td>
                                            <td class="py-4 pr-4">
                                                <span class="inline-flex px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-bold whitespace-nowrap">{{ $project['year'] }}</span>
                                            </td>
                                            <td class="py-4">
                                                <span class="inline-flex px-2.5 py-1 rounded-full bg-{{ $person['color'] }}/10 text-{{ $person['color'] }} text-xs font-bold whitespace-nowrap">{{ $project['role'] }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="md:hidden space-y-4">
                                @foreach($person['projects'] as $pIndex => $project)
                                <div class="glass-card rounded-2xl p-5" x-show='matchProject({{ json_encode($project) }})'>
                                    <div class="flex items-start justify-between gap-3 mb-2">
                                        <span class="text-xs font-bold text-gray-400">No. {{ $pIndex + 1 }}</span>
                                        <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-bold whitespace-nowrap">{{ $project['year'] }}</span>
                                    </div>
                                    <p class="text-sm font-semibold text-secondary leading-relaxed mb-3">{{ $project['title'] }}</p>
                                    <p class="text-xs text-gray-500 mb-2"><span class="font-bold text-gray-600">Pemberi Kerja:</span> {{ $project['client'] }}</p>
                                    <p class="text-xs text-gray-500"><span class="font-bold text-gray-600">Peran:</span> <span class="font-semibold text-{{ $person['color'] }}">{{ $project['role'] }}</span></p>
                                </div>
                                @endforeach
                            </div>

                            <p class="text-sm text-gray-400 text-center pt-4" x-show='!personMatch({{ json_encode($person['projects']) }})'>
                                Tidak ada kajian yang cocok dengan pencarian ini.
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center py-16" x-show='search !== "" && !hasResults()' style="display: none;">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                    <i data-lucide="search-x" class="w-8 h-8"></i>
                </div>
                <h3 class="text-lg font-bold text-secondary mb-1">Tidak ada hasil</h3>
                <p class="text-gray-500 text-sm mb-5">Coba kata kunci lain atau bersihkan pencarian.</p>
                <button type="button" @click="search = ''" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-primary text-white text-sm font-semibold hover:bg-primary/90 transition-colors">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Bersihkan Pencarian
                </button>
            </div>
        </div>
    </section>

    <x-landing.cta />
@endsection
