<div>
    <div class="space-y-4 px-4 sm:px-6">
        <!-- Bread crumbs -->
        <x-breadcrumbs.main>
            <x-breadcrumbs.link>{{ __('Users') }}</x-breadcrumbs.link>
        </x-breadcrumbs.main>

        <!-- Page Header -->
        <header class="items-end justify-between space-y-2 sm:flex sm:space-x-4 sm:space-y-0 sm:rtl:space-x-reverse">
            <!-- Page Title -->
            <div>
                <h1 class="text-2xl font-bold text-secondary-900 dark:text-secondary-100">{{ __('Users') }}</h1>
            </div>

            <!-- Add Action -->
            <div class="flex shrink-0 flex-wrap items-center justify-start gap-4">
                <x-button.primary class="text-sm normal-case">
                    {{ __('New User') }}
                </x-button.primary>
            </div>
        </header>

        <!-- Page Body -->
        <div class="flex flex-col pt-2">
            <div
                class="rounded-xl border border-secondary-300 bg-white shadow-sm dark:border-secondary-700 dark:bg-secondary-800">
                <!-- Users Table -->
                <div>
                    @if ($users->isEmpty())
                        <div class="flex items-center justify-center border-t p-4 dark:border-secondary-700">
                            <div
                                class="mx-auto flex flex-1 flex-col items-center justify-center space-y-6 bg-white p-6 text-center dark:bg-secondary-800">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-50 text-primary-500 dark:bg-secondary-700">
                                    <svg wire:loading.remove.delay="1" wire:target="search" class="h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                        </path>
                                    </svg>
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 animate-spin" wire:loading.delay="wire:loading.delay"
                                        wire:target="search">
                                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor"></path>
                                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>

                                <div class="max-w-md space-y-1">
                                    <h2 class="text-xl font-bold tracking-tight dark:text-white">
                                        No records found
                                    </h2>
                                    <p
                                        class="whitespace-normal text-sm font-medium text-secondary-500 dark:text-secondary-400">
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
