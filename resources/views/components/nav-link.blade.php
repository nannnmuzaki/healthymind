@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 underline decoration-2 underline-offset-8 border-healthymind-dark text-sm font-medium leading-5 text-healthymind-dark focus:outline-none focus:border-healthymind-dark transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 hover:underline hover:decoration-2 hover:underline-offset-8 border-transparent text-sm font-medium leading-5 text-healthymind-dark hover:text-healthymind-dark hover:border-healthymind-light focus:outline-none focus:text-healthymind-dark focus:border-healthymind-dark transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
