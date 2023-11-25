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
                <h1 class="text-2xl sm:text-3xl tracking-tight font-bold text-secondary-900 dark:text-secondary-100">{{ __('Users') }}</h1>
            </div>

            <!-- Add Action -->
            <div class="flex shrink-0 flex-wrap items-center justify-start gap-4">
                <x-button.link-primary
                    wire:navigate
                    href="{{ route('admin.users.create') }}"
                    class="text-sm normal-case"
                >
                    {{ __('New User') }}
                </x-button.link-primary>
            </div>
        </header>

        <!-- Page Body -->
        <div class="flex flex-col pt-2">
            <div
                class="border border-secondary-300 bg-white shadow-sm dark:border-secondary-700 dark:bg-secondary-800">
                <!-- Table Header Container -->
                <div class="table-header-container flex justify-between p-2 h-14 gap-2">
                    <!-- Bulk Actions -->
                    <div class="flex items-center gap-2">
                        @if(!empty($selected))
                            <div class="table-bulk-action">
                                <x-dropdown.main align="left" width="w-48">
                                    <x-slot:trigger>
                                        <button title="Open actions" type="button"
                                                class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-600 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                                        >
                                            <span class="sr-only">Open actions</span>
                                            <svg
                                                class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" aria-hidden="true"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                            </svg>
                                        </button>
                                    </x-slot:trigger>

                                    <x-slot:content>
                                        <x-dropdown.button
                                            @click="$dispatch('open-modal', 'confirm-user-deletion')"
                                            type="button" class="space-x-2 hover:bg-danger-500 dark:hover:bg-danger-500"
                                        >
                                            <x-icon.trash class="text-danger-500 group-hover:text-gray-100"/>
                                            <span class="group-hover:text-gray-100">Delete Selected</span>
                                        </x-dropdown.button>
                                    </x-slot:content>
                                </x-dropdown.main>
                            </div>
                        @endif
                    </div>

                    <!-- Search Filters -->
                    <div class="flex items-center justify-end gap-2">
                        <div class="relative rounded-md group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" aria-hidden="true"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </div>
                            <x-input.text
                                wire:model.live.debounce.500ms="search"
                                type="search" placeholder="Search"
                                class="block w-full rounded-md border-0 py-1.5 pl-10 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-500 sm:text-sm sm:leading-6"
                            />
                        </div>
                        <div wire:ignore>
                            <x-dropdown.main align="right" width="w-72" is-filter="true">
                                <x-slot:trigger>
                                    <button title="Open actions" type="button"
                                            class="filament-icon-button flex items-center justify-center rounded-full relative outline-none hover:bg-gray-500/5 disabled:opacity-70 disabled:cursor-not-allowed disabled:pointer-events-none text-primary-600 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10"
                                    >
                                        <span class="sr-only">Open actions</span>
                                        <svg
                                            class="filament-icon-button-icon w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                        </svg>
                                    </button>
                                </x-slot:trigger>

                                <x-slot:content>
                                    <div class="py-1 flex flex-col" role="none" wire:ignore>
                                        <div class="w-full px-2 py-2 text-sm text-secondary-700 dark:text-secondary-300"
                                             role="menuitem">
                                            <div class="flex justify-between">
                                                <h1 class="font-medium text-lg">Filters</h1>
                                                <button
                                                    type="button"
                                                    wire:click="resetFilters"
                                                    class="inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-sm text-danger-600 hover:text-danger-500 dark:text-danger-500 dark:hover:text-danger-400"
                                                    aria-label="clear date" tabindex="-1"
                                                >Reset
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-full px-2 py-2 text-sm text-secondary-700" role="menuitem">
                                            <x-label.main for="filter-updated_at">Modified At
                                            </x-label.main>
                                            <x-date.main wire:model.live="updatedAt" id="filter-updated_at"
                                                         placeholder="MM/DD/YYYY"></x-date.main>
                                        </div>
                                        <div class="w-full px-2 py-2 text-sm text-secondary-700" role="menuitem">
                                            <x-label.main for="filter-status">Status
                                            </x-label.main>
                                            <select wire:model.live="status" id="filter-status"
                                                    class="w-full mt-1 text-sm rounded-md shadow-sm dark:bg-secondary-900 dark:text-secondary-300 border-secondary-300 dark:border-secondary-700 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600">
                                                <option value="">Select user status</option>
                                                @foreach(\App\Enums\User\Status::cases() as $status)
                                                    <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-full px-2 py-2 text-sm text-secondary-700" role="menuitem">
                                            <x-label.main for="filter-type">Type
                                            </x-label.main>
                                            <select wire:model.live="type" id="filter-type"
                                                    class="w-full mt-1 text-sm rounded-md shadow-sm dark:bg-secondary-900 dark:text-secondary-300 border-secondary-300 dark:border-secondary-700 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600">
                                                <option value="">Select user type</option>
                                                @foreach(\App\Enums\User\Type::cases() as $type)
                                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-full px-2 py-2 text-sm text-secondary-700" role="menuitem">
                                            <x-label.main for="filter-selectedRoles">Type
                                            </x-label.main>
                                            <x-choices.main wire:model.live="selectedRoles" id="filter-roles"
                                                            class="w-full mt-1"
                                                            :options="$roles->toArray()"
                                                            multiple="true"></x-choices.main>
                                        </div>
                                    </div>
                                </x-slot:content>
                            </x-dropdown.main>
                        </div>
                    </div>
                </div>

                @if(!empty($selected))
                    <!-- Multi Rows Selection Info -->
                    <div
                        wire:key="rows-selected-info"
                        class="bg-primary-500/10 px-4 py-2 whitespace-nowrap text-sm border-t dark:border-gray-700 flex justify-between"
                    >
                        @unless ($selectAll)
                            <div class="flex gap-x-3">
                                <svg
                                    wire:loading wire:target="selectAll"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="animate-spin inline-block w-4 h-4 mr-3 rtl:mr-0 rtl:ml-3 text-primary-500"
                                    style="display: none;"
                                >
                                    <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                          fill="currentColor"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                          fill="currentColor"></path>
                                </svg>
                                <span class="dark:text-white">{{ count($selected) }} records selected.</span>
                            </div>
                            <div class="flex gap-x-3">
                            <span>
                                <button type="button" wire:click="$set('selectAll', true)"
                                        class="text-sm font-medium text-primary-600">
                                    Select all {{ $users->total() }}
                                </button>
                            </span>
                                <span>
                                <button type="button" wire:click="$set('selectPage', false)"
                                        class="text-sm font-medium text-danger-600">
                                    Deselect all
                                </button>
                            </span>
                            </div>
                        @else
                            <div class="flex gap-x-3">
                                <span class="dark:text-white">{{ $users->total() }} records selected.</span>
                            </div>
                            <div class="flex gap-x-3">
                                <span>
                                    <button wire:click="$set('selectPage', false)"
                                            class="text-sm font-medium text-primary-600">
                                        Deselect all
                                    </button>
                                </span>
                            </div>
                        @endif
                    </div>
                @endif
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
                                    <x-input.checkbox wire:model.live="selectPage"></x-input.checkbox>
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('first_name')"
                                                 :direction="$sortColumn === 'first_name' ? $sortDirection : ''"
                                                 class="w-full">Name
                                </x-table.heading>

                                <x-table.heading>Roles</x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('status')"
                                                 :direction="$sortColumn === 'status' ? $sortDirection : ''">Status
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('type')"
                                                 :direction="$sortColumn === 'user_type' ? $sortDirection : ''">Type
                                </x-table.heading>

                                <x-table.heading sortable wire:click="sortBy('updated_at')"
                                                 :direction="$sortColumn === 'updated_at' ? $sortDirection : ''">
                                    Modified At
                                </x-table.heading>

                                <x-table.heading>Action</x-table.heading>
                            </x-slot>

                            <!-- Table Body -->
                            <x-slot:body>
                                @foreach ($users as $user)
                                    <x-table.row wire:key="row-{{ $user->id }}" class="text-base">
                                        <x-table.cell class="pr-0">
                                            <x-input.checkbox wire:model.live="selected"
                                                              value="{{ $user->id }}"></x-input.checkbox>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <dl>
                                                <dt class="sr-only">Display Name</dt>
                                                <dd class="font-medium text-secondary-900 dark:text-secondary-200">
                                                    {{ $user->first_name . ' ' . $user->last_name }}
                                                </dd>
                                                <dt class="sr-only">Email</dt>
                                                <dd class="text-secondary-500 dark:text-secondary-400">
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
                                                <dd class="font-medium text-secondary-700 dark:text-secondary-200">
                                                    {{ $user->updated_at->format('F j, Y g:i a') }}
                                                </dd>
                                                <dt class="sr-only">Human readable</dt>
                                                <dd class="text-secondary-500 dark:text-secondary-400">
                                                    {{ $user->updated_at->diffForHumans() }}
                                                </dd>
                                            </dl>
                                        </x-table.cell>

                                        <x-table.cell>
                                            <div class="flex items-center space-x-2">
                                                <x-icon.eye
                                                    wire:click="$emit('openModal', 'admin.user.view', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="cursor-pointer text-secondary-400 hover:text-secondary-500 dark:text-secondary-400 dark:hover:text-secondary-300"/>
                                                <x-icon.pencil
                                                    wire:click="$emit('openModal', 'admin.user.edit', {{ json_encode(['user' => $user->id], JSON_THROW_ON_ERROR) }})"
                                                    class="cursor-pointer text-primary-600 hover:text-primary-500"/>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot:body>
                        </x-table.main>
                    @endif
                </div>
                @if($users->isNotEmpty())
                    <!-- Pagination -->
                    <div>
                        {{ $users->onEachSide(0)->links('vendor.livewire.tailwind', ['arrPerPage' => $arrPerPage]) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- User(s) Delete Confirmation Modal -->
    <x-modal.main name="confirm-user-deletion" :show="false">
        <form wire:submit="deleteUsers" class="p-6">

            <div class="flex items-center justify-between pb-3">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete selected user(s)?') }}
                </h2>
                <button type="button" x-on:click="$dispatch('close')"
                        class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 transition duration-150 ease-in-out hover:bg-gray-50 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:ring-offset-2 dark:focus:ring-offset-secondary-800">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once selected user(s) deleted, all of their data will be permanently deleted.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal.main>
</div>
