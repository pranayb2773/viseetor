@props([
    'disabled' => false,
    'field' => '',
])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->twMerge([
    'class' =>
        'text-sm rounded-md shadow-sm dark:bg-secondary-900 dark:text-secondary-300 ' .
        ($errors->has($field)
            ? 'border-danger-400 dark:border-danger-700 focus:border-danger-500 dark:focus:border-danger-600 focus:ring-danger-500 dark:focus:ring-danger-600'
            : 'border-secondary-300 dark:border-secondary-700 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600'),
]) !!} />

@error($field)
    <span class="text-xs text-danger-600">{{ $message }}</span>
@enderror
