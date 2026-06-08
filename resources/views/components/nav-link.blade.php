@props(['active' => false])

@php
    $classes = ($active ?? false)
                ? 'flex items-center gap-4 w-full px-4 py-3 text-[15px] font-semibold text-[var(--color-primary)] bg-[#F0F7FF] rounded-xl transition duration-200'
                : 'flex items-center gap-4 w-full px-4 py-3 text-[15px] font-medium text-[#6B7A99] hover:text-[var(--color-primary)] hover:bg-[#F8FAFC] rounded-xl transition duration-200';
@endphp

<li class="list-none">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>