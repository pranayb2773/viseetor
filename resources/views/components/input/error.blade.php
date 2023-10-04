@props([
    'field' => ''
])


@error($field)
<div {{ $attributes->merge(['class' => 'text-sm text-danger-600 dark:text-danger-400 space-y-1']) }}>
    {{ $message }}
</div>
@enderror
