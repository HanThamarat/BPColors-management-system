@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-sm text-white my-4 px-3 rounded bg-sky-800'
            : 'inline-flex items-center text-sm text-white my-4 px-3 rounded hover:bg-sky-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
