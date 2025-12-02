@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 bg-gray-800 text-white border-l-4 border-indigo-500 transition-colors duration-200 group'
            : 'flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white transition-colors duration-200 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
