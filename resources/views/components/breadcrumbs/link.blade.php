@props([
    'current' => false,
])

<li>
    <div class="flex items-center">
        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
        </svg>
        <a
            {{$attributes->merge([
                'class' => 'ml-4 text-xs text-gray-500 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50'
            ]) }}
            {{ $current ? 'aria-current="page"' : '' }}>{{ $slot }}</a>
    </div>
</li>
