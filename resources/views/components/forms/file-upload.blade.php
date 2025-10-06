

@props(['required' => false, 'multiple' => false])
<div class="flex flex-col gap-1">
    @php
        $wireModel =
            $attributes['wire:model'] ??
            ($attributes['wire:model.defer'] ??
                ($attributes['wire:model.lazy'] ?? ($attributes['wire:model.live'] ?? '')));
        $hasError = false;

        if ($wireModel) {
            if ($errors->has($wireModel)) {
                $hasError = true;
            }
            foreach ($errors->keys() as $errorKey) {
                if (str_starts_with($errorKey, $wireModel . '.')) {
                    $hasError = true;
                    break;
                }
            }
        }
    @endphp

    <label for="{{ $attributes['id'] }}"
        class="text-sm font-semibold block {{ $hasError ? 'text-red-500' : 'text-gray-600 dark:text-dark-400' }}">
        {{ $attributes['label'] }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <x-filepond::upload wire:model="{{ $wireModel }}" id="{{ $attributes['id'] }}" :multiple="$multiple" />

    @if ($hasError)
        @if ($errors->has($wireModel))
            <span class=" text-sm text-red-500">{{ $errors->first($wireModel) }}</span>
        @else
            @foreach ($errors->keys() as $errorKey)
                @if (str_starts_with($errorKey, $wireModel . '.'))
                    <span class=" text-sm text-red-500">{{ $errors->first($errorKey) }}</span>
                    @break
                @endif
            @endforeach
        @endif
    @endif
</div>
