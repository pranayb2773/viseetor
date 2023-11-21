@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 lg:hidden">
            <div class="w-10">
                @if ($paginator->onFirstPage())

                @else
                    <button title="Previous" type="button"
                            class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-secondary-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-secondary-300/5 w-10 h-10"
                            wire:click="previousPage('page')" rel="prev">
                    <span class="sr-only">
                        {!! __('pagination.previous') !!}
                    </span>

                        <svg wire:loading.remove.delay="1" wire:target="previousPage('page')"
                             class="filament-icon-button-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             class="animate-spin filament-icon-button-icon w-5 h-5"
                             wire:loading.delay="wire:loading.delay" wire:target="previousPage('page')">
                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                  fill="currentColor"></path>
                            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                  fill="currentColor"></path>
                        </svg>

                    </button>
                @endif

            </div>

            <div
                class="flex items-center space-x-2 filament-tables-pagination-records-per-page-selector rtl:space-x-reverse">
                <label>
                    <select wire:model="perPage"
                            class="h-8 text-sm pr-8 leading-none transition duration-75 border-secondary-300 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:text-white dark:bg-secondary-700 dark:border-secondary-600 dark:focus:border-primary-500">
                        @foreach($arrPerPage as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <span class="text-sm font-medium dark:text-white">
                    per page
                </span>
                </label>
            </div>

            <div class="w-10">
                @if ($paginator->hasMorePages())
                    <button title="Next" type="button"
                            class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-secondary-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-secondary-300/5 w-10 h-10"
                            wire:click="nextPage('page')" rel="next">
                    <span class="sr-only">
                        Next
                    </span>

                        <svg wire:loading.remove.delay="1" wire:target="nextPage('page')"
                             class="filament-icon-button-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             class="animate-spin filament-icon-button-icon w-5 h-5"
                             wire:loading.delay="wire:loading.delay" wire:target="nextPage('page')">
                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                  fill="currentColor"></path>
                            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                  fill="currentColor"></path>
                        </svg>

                    </button>
                @else

                @endif
            </div>
        </div>

        <div class="hidden flex-1 items-center lg:grid grid-cols-3">
            <div class="flex items-center">
                <div class="pl-2 text-sm font-medium dark:text-white">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </div>
            </div>

            <div class="flex items-center justify-center">
                <div
                    class="flex items-center space-x-2 filament-tables-pagination-records-per-page-selector rtl:space-x-reverse">
                    <label>
                        <select wire:model="perPage"
                                class="h-8 text-sm pr-8 leading-none transition duration-75 border-secondary-300 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:text-white dark:bg-secondary-700 dark:border-secondary-600 dark:focus:border-primary-500">
                            @foreach($arrPerPage as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        <span class="text-sm font-medium dark:text-white">
                        per page
                    </span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <div class="py-3 border rounded-lg dark:border-secondary-600">
                    <ol class="flex gap-px items-center text-sm text-secondary-500 divide-x rtl:divide-x-reverse divide-secondary-300 dark:text-secondary-400 dark:divide-secondary-600">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                        @else
                            <li>
                                <button type="button"
                                        class="filament-tables-pagination-item relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-secondary-500/5 focus:bg-primary-500/10 focus:ring-2 focus:ring-primary-500 dark:hover:bg-secondary-400/5 transition text-primary-600"
                                        wire:click="previousPage('page')" aria-label="Previous" rel="prev">
                                    <svg class="w-5 h-5 rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span></span>
                                </button>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li>
                                    <button disabled="" type="button"
                                            class="filament-tables-pagination-item relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none filament-tables-pagination-item-disabled cursor-not-allowed pointer-events-none opacity-70">
                                        <span>...</span>
                                    </button>
                                </li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li>
                                            <button type="button"
                                                    class="filament-tables-pagination-item relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none transition text-primary-600 filament-tables-pagination-item-active focus:underline bg-primary-500/10 ring-2 ring-primary-500"
                                                    wire:click="gotoPage({{ $page }}, 'page')" aria-label="Go to page 2"
                                                    wire:key="table.pagination.page.{{ $page }}">
                                                <span>{{ $page }}</span>
                                            </button>
                                        </li>
                                    @else
                                        <li>
                                            <button type="button"
                                                    class="filament-tables-pagination-item relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-secondary-500/5 focus:bg-primary-500/10 focus:ring-2 focus:ring-primary-500 dark:hover:bg-secondary-400/5 focus:text-primary-600 transition"
                                                    wire:click="gotoPage({{ $page }}, 'page')" aria-label="Go to page 3"
                                                    wire:key="table.pagination.page.{{ $page }}">
                                                <span>{{ $page }}</span>
                                            </button>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li>
                                <button type="button"
                                        class="filament-tables-pagination-item relative flex items-center justify-center font-medium min-w-[2rem] px-1.5 h-8 -my-3 rounded-md outline-none hover:bg-secondary-500/5 focus:bg-primary-500/10 focus:ring-2 focus:ring-primary-500 dark:hover:bg-secondary-400/5 transition text-primary-600"
                                        wire:click="nextPage('page')" aria-label="Next" rel="next">
                                    <svg class="w-5 h-5 rtl:scale-x-[-1]" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span></span>
                                </button>
                            </li>
                        @else
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </nav>
@endif
