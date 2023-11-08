<a {{ $attributes->merge([
    'class' =>
        'relative flex items-center rounded px-2 py-1.5 text-sm leading-6 text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out',
]) }}
    role="menuitem">{{ $slot }}</a>
{{--
relative flex cursor-default select-none hover:bg-neutral-100 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50 --}}
