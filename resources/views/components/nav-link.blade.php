@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm
            font-medium leading-5 text-sky-950 focus:outline-none focus:border-indigo-700
            transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm
            font-medium leading-5 text-sky-600 hover:text-sky-800 hover:border-sky-400
            focus:outline-none focus:text-sky-800 focus:border-sky-400 transition duration-150
            ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
