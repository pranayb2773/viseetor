<button
    {{ $attributes->twMerge([
        'type' => 'submit',
        'class' =>
            'w-full relative flex items-center rounded px-2 py-1.5 text-sm leading-6 font-semibold group text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</button>
