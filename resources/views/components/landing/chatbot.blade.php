@php
    $servicesList = collect(company('categories', 'company-services'))->map(fn($s) => $s['title'])->implode("\n• ");
    $teamNames = collect(company('people', 'company-leadership'))->map(fn($p) => $p['name'])->implode(', ');
    $experienceList = collect(company('projects', 'company-experience'))->map(fn($p) => "• {$p['title']} ({$p['institution']}, {$p['year']})")->implode("\n");
    $faqList = collect(company(null, 'company-faq'))->map(fn($f) => $f['question'])->implode("\n• ");

    $contactInfo = company('contact');

    $chatbotUi = __('ui.chatbot');

    $chatReplacements = [
        ':services' => $servicesList,
        ':team' => $teamNames,
        ':experience' => $experienceList,
        ':faq' => $faqList,
        ':intro' => company('overview.intro'),
        ':founded' => company('legal')[2]['value'],
        ':address' => $contactInfo['address'],
        ':city' => $contactInfo['city'],
        ':email' => $contactInfo['email'],
        ':phone' => $contactInfo['phone'],
        ':name' => company('short_name'),
    ];

    $knowledge = array_map(fn($item) => [
        'keywords' => $item['keywords'],
        'reply' => strtr($item['reply'], $chatReplacements),
    ], $chatbotUi['knowledge']);

    $quickReplies = $chatbotUi['quick_replies'];
    $greeting = strtr($chatbotUi['greeting'], $chatReplacements);
    $fallback = strtr($chatbotUi['fallback'], $chatReplacements);
    $chatName = $chatbotUi['name'];
    $chatStatus = $chatbotUi['status'];
    $chatPlaceholder = $chatbotUi['placeholder'];
    $chatFooter = strtr($chatbotUi['footer'], [':name' => company('short_name')]);
@endphp

<div x-data="chatbot()" class="fixed bottom-6 right-6 z-60 flex flex-col items-end">
    <!-- Chat Panel -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-6 scale-95"
         class="mb-4 w-[calc(100vw-3rem)] sm:w-80 lg:w-88 h-120 lg:h-128 bg-white rounded-3xl shadow-2xl shadow-black/25 border border-gray-100 overflow-hidden flex flex-col">

        <!-- Header -->
        <div class="relative bg-linear-to-br from-primary via-primary to-secondary px-5 py-4 mb-2 flex items-center gap-3 shrink-0">
            <span class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff14_1px,transparent_1px),linear-gradient(to_bottom,#ffffff14_1px,transparent_1px)] bg-size-[20px_20px] pointer-events-none"></span>
            <div class="relative flex items-center gap-3">
                <div class="relative shrink-0">
                    <div class="w-11 h-11 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center text-white">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-accent border-2 border-white"></span>
                </div>
                <div class="relative">
                    <p class="text-white font-bold text-sm leading-tight">{{ $chatName }}</p>
                    <p class="text-white/70 text-xs flex items-center gap-1.5 mt-0.5">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3 h-3"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12c0 1.821.487 3.53 1.338 5L2.5 21.5l4.5-.838A9.955 9.955 0 0 0 12 22z"></path><path d="m9 12 2 2 4-4"></path></svg>
                        {{ $chatStatus }}
                    </p>
                </div>
                <button @click="open = false" class="absolute left-70 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-white/70 hover:text-white hover:bg-white/10 transition-colors" aria-label="{{ __('ui.chatbot.close_aria') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Messages -->
        <div id="chat-scroll" class="flex-1 overflow-y-auto px-4 space-y-2 bg-linear-to-b from-slate-50 to-white">
            <template x-for="(msg, i) in messages" :key="i">
                <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                    <div :class="msg.role === 'user'
                        ? 'bg-linear-to-br from-primary to-secondary text-white rounded-2xl rounded-br-md px-4 py-1.5 max-w-[85%] text-sm leading-relaxed shadow-md shadow-primary/20'
                        : 'bg-white border border-gray-100 rounded-2xl rounded-bl-md px-4 py-1.5 max-w-[85%] text-sm leading-relaxed shadow-sm text-gray-700'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <template x-if="msg.role === 'bot' && msg.avatar">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="w-5 h-5 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3"><rect width="18" height="10" x="3" y="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                </span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary/70">{{ $chatName }}</span>
                            </div>
                        </template>
                        <span x-text="msg.text" style="white-space: pre-line"></span>
                    </div>
                </div>
            </template>
            <!-- Typing indicator -->
            <div x-show="typing" class="flex justify-start" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div class="bg-white border border-gray-100 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm">
                    <div class="flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-primary/40 animate-bounce" style="animation-delay:0ms"></span>
                        <span class="w-2 h-2 rounded-full bg-primary/60 animate-bounce" style="animation-delay:150ms"></span>
                        <span class="w-2 h-2 rounded-full bg-primary/80 animate-bounce" style="animation-delay:300ms"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick replies -->
        <div class="px-4 pb-2 flex flex-wrap gap-1.5 shrink-0">
            <template x-for="(q, i) in quickReplies" :key="i">
                <button @click="ask(q.reply)" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-primary/5 text-primary border border-primary/15 hover:bg-primary hover:text-white transition-all duration-200 flex items-center gap-1">
                    <span x-text="q.label"></span>
                </button>
            </template>
        </div>

        <!-- Input -->
        <div class="p-3 pt-1 border-t border-gray-100 bg-white shrink-0">
            <div class="flex items-center gap-2 bg-slate-50 border border-gray-300 rounded-2xl px-3 py-1.5">
                <input x-model="input" @keydown.enter="send()" type="text" placeholder="{{ $chatPlaceholder }}" class="flex-1 bg-transparent rounded-xl border border-gray-300 focus:bg-white focus:ring-4 focus:ring-primary/15 focus:border-primary outline-none transition-all text-sm">
                <button @click="send()" :disabled="!input.trim()" :class="input.trim() ? 'bg-primary hover:bg-primary/90 shadow-md shadow-primary/30' : 'bg-gray-200 text-gray-400 cursor-not-allowed'" class="w-9 h-9 rounded-xl flex items-center justify-center text-white transition-all duration-200 shrink-0" aria-label="{{ __('ui.chatbot.send_aria') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5"><path d="m22 2-7 20-4-9-9-4z"></path><path d="M22 2 11 13"></path></svg>
                </button>
            </div>
            <p class="text-center text-[10px] text-gray-400 mt-1.5">{{ $chatFooter }}</p>
        </div>
    </div>

    <!-- Toggle Button -->
    <button @click="toggle()" class="relative w-14 h-14 rounded-full bg-white shadow-xl shadow-primary/25 ring-1 ring-primary/10 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center overflow-hidden group">
        <img x-show="!open" src="{{ asset('images/chat-bot.gif') }}" alt="{{ $chatName }}" class="w-full h-full object-cover">
        <svg x-show="open" style="display:none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-primary"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <script>
        function chatbot() {
            return {
                open: false,
                typing: false,
                input: '',
                quickReplies: {{ Js::from($quickReplies) }},
                knowledge: {!! json_encode($knowledge) !!},
                messages: [],
                greeting: {{ Js::from($greeting) }},
                init() {
                    this.messages.push({ role: 'bot', text: this.greeting, avatar: true });
                },
                toggle() {
                    this.open = !this.open;
                    if (this.open) {
                        this.$nextTick(() => this.scrollDown());
                    }
                },
                ask(q) {
                    this.messages.push({ role: 'user', text: q });
                    this.respond(q);
                },
                send() {
                    const text = this.input.trim();
                    if (!text) return;
                    this.input = '';
                    this.messages.push({ role: 'user', text });
                    this.respond(text);
                },
                respond(text) {
                    this.typing = true;
                    this.scrollDown();
                    const reply = this.match(text);
                    setTimeout(() => {
                        this.typing = false;
                        this.messages.push({ role: 'bot', text: reply, avatar: true });
                        this.scrollDown();
                    }, 700);
                },
                match(text) {
                    const t = text.toLowerCase().replace(/[^\w\s]/gi, ' ');
                    for (const item of this.knowledge) {
                        const hit = item.keywords.some(k => t.includes(k));
                        if (hit) return item.reply;
                    }
                    return {!! json_encode($fallback) !!};
                },
                scrollDown() {
                    this.$nextTick(() => {
                        const el = document.getElementById('chat-scroll');
                        if (el) el.scrollTop = el.scrollHeight;
                    });
                }
            };
        }
    </script>
</div>
