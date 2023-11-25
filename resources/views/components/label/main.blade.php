@props(['value', 'required' => false])

<label {{ $attributes->twMerge(['class' => 'block font-medium text-sm leading-6 text-secondary-700 dark:text-secondary-300']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <sup class="text-danger-600 font-bold text-xs">*</sup>
    @endif
</label>
