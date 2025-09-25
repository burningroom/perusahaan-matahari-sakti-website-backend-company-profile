@props(['fixedCol' => false, 'sortable' => null, 'column' => null])

@php
    $class = 'px-6 py-4 text-sm font-semibold text-[var(--fg-2)] uppercase border border-[var(--border)] text-start text-nowrap';

    if ($fixedCol) {
        $class .= ' lg:sticky left-0 z-[1] bg-[var(--bg-2)] ';
    }
    if ($sortable !== null && $column !== null) {
        $class .= ' cursor-pointer';
    }
@endphp

<th scope="col" {{ $attributes->merge(['class' => $class]) }} @if($sortable !== null && $column !== null)
wire:click="sortingBy('{{ $column }}')" @endif>
    <div class="{{ $sortable ? 'flex items-center justify-center gap-2' : '' }}">
        {{ $slot }}
        @if ($sortable !== null)
            @if ($sortable == 'asc')
                <i class="ti ti-sort-ascending text-primary-500"></i>
            @else
                <i class="ti ti-sort-descending text-primary-500"></i>
            @endif
        @endif
    </div>
</th>