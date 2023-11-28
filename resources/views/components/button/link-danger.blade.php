<a
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-danger-600 dark:bg-danger-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-danger-500 dark:hover:bg-danger-500 focus:bg-danger-500 dark:focus:bg-danger-500 active:bg-danger-500 dark:active:bg-danger-500 focus:outline-none focus:ring-2 focus:ring-danger-500 focus:ring-offset-2 dark:focus:ring-offset-danger-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
