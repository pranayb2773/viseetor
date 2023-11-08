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
                        <x-table.main>
                            <!-- Table Headings -->
                            <x-slot name="head">
                                <x-table.heading class="w-8 pr-0">
                                    <x-input.checkbox wire:model="selectPage"></x-input.checkbox>
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('first_name')"
                                    :direction="$sortColumn === 'first_name' ? $sortDirection : ''" class="w-full">Name</x-table.heading>

                                <x-table.heading>Roles</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('status')"
                                    :direction="$sortColumn === 'status' ? $sortDirection : ''">Status</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('type')"
                                    :direction="$sortColumn === 'user_type' ? $sortDirection : ''">Type</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('updated_at')"
                                    :direction="$sortColumn === 'updated_at' ? $sortDirection : ''">Modified At</x-table.heading>

                                <x-table.heading>Action</x-table.heading>
                            </x-slot>

                            <!-- Table Body -->
                            <x-slot:body>
                                @foreach ($users as $user)
                                    <x-table.row wire:key="row-{{ $user->id }}" class="text-base">
                                        <x-table.cell class="pr-0">
                                            <x-input.checkbox wire:model="selected"
                                                value="{{ $user->id }}"></x-input.checkbox>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <dl>
                                                <dt class="sr-only">Display Name</dt>
                                                <dd class="font-medium text-gray-900 dark:text-gray-200">
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                </dd>
                                                <dt class="sr-only">Email</dt>
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $user->email }}
                                                </dd>
                                            </dl>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <div>
                                                <ul class="list-disc space-y-2">
                                                    @forelse($user->roles as $role)
                                                        <li class="px-2 text-sm font-medium">
                                                            {{ $role->name }}
                                                        </li>
                                                    @empty
                                                        <li>None</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <span
                                                class="{{ $user->status->color() }} inline-flex rounded-full px-2 text-xs font-medium leading-5">
                                                {{ $user->status->label() }}
                                            </span>
                                        </x-table.cell>

                                        <x-table.cell>{{ $user->type->label() }}</x-table.cell>

                                        <x-table.cell>
                                            <dl>
                                                <dt class="sr-only">Updated At</dt>
                                                <dd class="font-medium text-gray-700 dark:text-gray-200">
                                                    {{ $user->updated_at->format('F j, Y g:i a') }}
                                                </dd>
                                                <dt class="sr-only">Human readable</dt>
                                                <dd class="text-gray-500 dark:text-gray-400">
                                                    {{ $user->updated_at->diffForHumans() }}
                                                </dd>
                                            </dl>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <div class="flex items-center space-x-2">
                                                <x-icon.eye
                                                    wire:click="$emit('openModal', 'admin.user.view', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="cursor-pointer text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-300" />
                                                <x-icon.pencil
                                                    wire:click="$emit('openModal', 'admin.user.edit', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="cursor-pointer text-primary-600 hover:text-primary-500" />
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot:body>
                        </x-table.main>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
