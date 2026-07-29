<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary/90 focus:bg-primary/90 active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 transition ease-in-out duration-200 shadow-sm shadow-primary/20']) }}>
    {{ $slot }}
</button>
