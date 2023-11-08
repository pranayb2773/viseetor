@props([
    'disabled' => false,
    'field' => '',
])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->twMerge([
    'class' =>
        'h-4 w-4 rounded shadow-sm dark:checked:bg-primary-500 dark:bg-gray-900 border-gray-300 dark:border-gray-700 dark:focus:ring-offset-gray-800' .
        ($errors->has($field)
            ? ' text-danger-500 focus:ring-danger-500'
            : ' text-primary-500 focus:border-primary-500 focus:ring-primary-500'),
]) !!}>
