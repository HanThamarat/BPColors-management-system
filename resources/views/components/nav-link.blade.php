@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-sm text-white my-4 px-3 rounded bg-red-600 duration-100 ease-in-out'
            : 'inline-flex items-center text-sm text-white my-4 px-3 rounded hover:bg-red-500 duration-100 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
