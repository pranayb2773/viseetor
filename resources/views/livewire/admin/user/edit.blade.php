<div>
    <div class="space-y-4 mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-7xl">
        <!-- Bread crumbs -->
        <x-breadcrumbs.main>
            <x-breadcrumbs.link href="{{ route('admin.users') }}">{{ __('Users') }}</x-breadcrumbs.link>
            <x-breadcrumbs.link>{{ $user->first_name . ' ' . $user->last_name }}</x-breadcrumbs.link>
            <x-breadcrumbs.link>{{ __('Edit') }}</x-breadcrumbs.link>
        </x-breadcrumbs.main>

        <!-- Page Header -->
        <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <!-- Page Title -->
            <div>
                <h1 class="text-2xl sm:text-3xl tracking-tight font-bold text-secondary-900 dark:text-secondary-100">{{ __('Edit') . ' ' . $user->first_name . ' ' . $user->last_name  }}</h1>
            </div>
            <div class="gap-3 flex flex-wrap items-center justify-start shrink-0">
                <x-button.danger type="button" @click="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete') }}</x-button.danger>
            </div>
        </header>

        <!-- Form Details -->
        <div>
            <div class="grid auto-cols-fr gap-y-8">
                <form wire:submit.prevent="save" class="grid gap-y-6">
                    <div class="form-content grid gap-6 grid-cols-1 lg:grid-cols-3">
                        <div class="col-span-3 lg:col-span-2 grid gap-6">
                            <!-- User Details -->
                            <div class="">
                                <section
                                    class="rounded-xl bg-white shadow-sm ring-1 ring-secondary-900/5 dark:bg-secondary-800 dark:ring-white/10">
                                    <div class="p-6">
                                        <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
                                            <div class="col-span-2 lg:col-span-1">
                                                <x-label.main for="firstName"
                                                              :required="true"> {{ __('First Name') }}</x-label.main>
                                                <x-input.text wire:model.blur="user.first_name" id="firstName"
                                                              class="w-full mt-1" field="user.first_name"></x-input.text>
                                            </div>
                                            <div class="col-span-2 lg:col-span-1">
                                                <x-label.main for="lastName"
                                                              :required="true"> {{ __('Last Name') }}</x-label.main>
                                                <x-input.text wire:model.blur="user.last_name" id="lastName"
                                                              class="w-full mt-1" field="user.last_name"></x-input.text>
                                            </div>
                                            <div class="col-span-2">
                                                <x-label.main for="email" :required="true"> {{ __('Email') }}</x-label.main>
                                                <x-input.text wire:model.blur="user.email" type="email" id="email"
                                                              class="w-full mt-1" field="user.email"></x-input.text>
                                            </div>
                                            <div class="col-span-2 lg:col-span-1">
                                                <x-label.main for="type" :required="true"> {{ __('Type') }}</x-label.main>
                                                <x-choices.main wire:model.live="user.type" id="type"
                                                                :options="$typeOptions" field="user.type">
                                                </x-choices.main>
                                            </div>
                                            <div class="col-span-2 lg:col-span-1">
                                                <x-label.main for="status" :required="true"> {{ __('Status') }}</x-label.main>
                                                <x-choices.main wire:model.live="user.status" id="status"
                                                                :options="$statusOptions" field="user.status">
                                                </x-choices.main>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <!-- Roles & Permissions Details -->
                            <div class="">
                                <section class="rounded-xl bg-white shadow-sm ring-1 ring-secondary-900/5 dark:bg-secondary-800 dark:ring-white/10">
                                    <header class="flex items-center gap-x-3 overflow-hidden px-6 py-4">
                                        <div class="grid gap-y-1 flex-1">
                                            <h3 class="text-base font-semibold leading-6 text-secondary-900 dark:text-white">Roles & Permissions</h3>
                                        </div>
                                    </header>
                                    <div class="border-t border-secondary-200 dark:border-secondary-700/50">
                                        <div class="p-6">
                                            <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
                                                <div>
                                                    <x-label.main for="roles" :required="true"> {{ __('Roles') }}</x-label.main>
                                                    <x-choices.main wire:model.live="roles" id="roles" multiple="multiple"
                                                                    :options="$rolesOptions" field="roles">
                                                    </x-choices.main>
                                                </div>
                                                <div>
                                                    <x-label.main for="permissions"> {{ __('Permissions') }}</x-label.main>
                                                    <x-choices.main wire:model.live="permissions" id="permissions" multiple="multiple"
                                                                    :options="$permissionsOptions" field="permissions">
                                                    </x-choices.main>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-span-3 lg:col-span-1">
                            <div>
                                <section
                                    class="rounded-xl bg-white shadow-sm ring-1 ring-secondary-900/5 dark:bg-secondary-800 dark:ring-white/10">
                                    <div class="p-6">
                                        <div class="grid gap-6 grid-cols-1">
                                            <div>
                                                <x-label.main for="createAt" class="font-semibold dark:text-white"> {{ __('Created At') }}</x-label.main>
                                                <div id="createAt" class="text-sm mt-1 text-gray-700 dark:text-white">{{ $user->created_at?->diffForHumans() }}</div>
                                            </div>
                                            <div>
                                                <x-label.main for="updatedAt" class="font-semibold dark:text-white"> {{ __('Last Modified At') }}</x-label.main>
                                                <div id="updatedAt" class="text-sm mt-1 text-gray-700 dark:text-white">{{ $user->updated_at?->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="form-actions">
                        <div class="gap-3 flex flex-wrap items-center justify-start">
                            <x-button.primary>{{ __('Save Changes') }}</x-button.primary>
                            <x-button.link-danger wire:navigate href="{{ route('admin.users') }}" alt="Cancel">{{ __('Cancel') }}</x-button.link-danger>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User(s) Delete Confirmation Modal -->
    <x-modal.main name="confirm-user-deletion" :show="false" focusable>
        <form wire:submit="delete" class="p-6">

            <div class="flex items-center justify-between pb-3">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete user: ' . $user->first_name . ' '. $user->last_name . '?') }}
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
                {{ __('Once user deleted, all of user data will be permanently deleted.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-button.danger class="ml-3">
                    {{ __('Delete') }}
                </x-button.danger>
            </div>
        </form>
    </x-modal.main>
</div>
