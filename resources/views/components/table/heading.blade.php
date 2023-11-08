@props([
    'sortable' => null,
    'direction' => null,
    'textAlign' => 'text-left',
])

<th {{ $attributes->merge(['class' => 'px-6 py-3 whitespace-nowrap'])->only('class') }}>
    @unless ($sortable)
        <span
            class="{{ $textAlign }} flex items-center space-x-1 text-xs font-bold uppercase leading-4 text-secondary-600 dark:text-secondary-200">{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }}
            class="{{ $textAlign }} group flex items-center space-x-1 text-xs font-bold uppercase leading-4 text-secondary-600 focus:underline focus:outline-none dark:text-secondary-200">
            <span>{{ $slot }}</span>

            <span class="relative flex items-center">
                @if ($direction === 'asc')
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                @elseif ($direction === 'desc')
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                @endif
            </span>
        </button>
        @endif
    </th>
