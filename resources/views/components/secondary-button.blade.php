<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2
 bg-sky-100 border border-sky-400 rounded-md font-semibold text-xs text-sky-800 uppercase
 tracking-widest shadow-sm hover:bg-sky-100 focus:outline-none focus:ring-2 focus:ring-indigo-500
 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
