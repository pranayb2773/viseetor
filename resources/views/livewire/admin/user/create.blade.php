<div>
    <div class="space-y-4 mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-7xl">
        <!-- Bread crumbs -->
        <x-breadcrumbs.main>
            <x-breadcrumbs.link href="{{ route('admin.users') }}">{{ __('Users') }}</x-breadcrumbs.link>
            <x-breadcrumbs.link>{{ __('Create') }}</x-breadcrumbs.link>
        </x-breadcrumbs.main>

        <!-- Page Header -->
        <header class="items-end justify-between space-y-2 sm:flex sm:space-x-4 sm:space-y-0 sm:rtl:space-x-reverse">
            <!-- Page Title -->
            <div>
                <h1 class="text-2xl sm:text-3xl tracking-tight font-bold text-secondary-900 dark:text-secondary-100">{{ __('Create User') }}</h1>
            </div>
        </header>

        <!-- Form Details -->
        <div>
            <div class="grid auto-cols-fr gap-y-8">
                <form wire:submit.prevent="create" class="grid gap-y-6">
                    <div class="form-content grid gap-6">
                        <!-- User Details -->
                        <div class="">
                            <section
                                class="rounded-xl bg-white shadow-sm ring-1 ring-secondary-900/5 dark:bg-secondary-800 dark:ring-white/10">
                                <div class="p-6">
                                    <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
                                        <div class="col-span-2 lg:col-span-1">
                                            <x-label.main for="firstName"
                                                          :required="true"> {{ __('First Name') }}</x-label.main>
                                            <x-input.text wire:model.blur="firstName" id="firstName"
                                                          class="w-full mt-1" field="firstName"></x-input.text>
                                        </div>
                                        <div class="col-span-2 lg:col-span-1">
                                            <x-label.main for="lastName"
                                                          :required="true"> {{ __('Last Name') }}</x-label.main>
                                            <x-input.text wire:model.blur="lastName" id="lastName"
                                                          class="w-full mt-1" field="lastName"></x-input.text>
                                        </div>
                                        <div class="col-span-2 lg:col-span-1">
                                            <x-label.main for="email" :required="true"> {{ __('Email') }}</x-label.main>
                                            <x-input.text wire:model.blur="email" type="email" id="email"
                                                          class="w-full mt-1" field="email"></x-input.text>
                                        </div>
                                        <div class="col-span-2 lg:col-span-1">
                                            <x-label.main for="type" :required="true"> {{ __('Type') }}</x-label.main>
                                            <x-choices.main wire:model.live="type" id="type" multiple="{{ 'disable' }}"
                                                            :options="$typeOptions" field="type">
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
                                                <x-choices.main wire:model.live="roles" id="roles" multiple="{{ 'enable' }}"
                                                                :options="$rolesOptions" field="roles">
                                                </x-choices.main>
                                            </div>
                                            <div>
                                                <x-label.main for="permissions"> {{ __('Permissions') }}</x-label.main>
                                                <x-choices.main wire:model.live="permissions" id="permissions" multiple="{{ 'enable' }}"
                                                                :options="$permissionsOptions" field="permissions">
                                                </x-choices.main>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="form-actions">
                        <div class="gap-3 flex flex-wrap items-center justify-start">
                            <x-button.primary>{{ __('Create') }}</x-button.primary>
                            <x-button.secondary wire:click="createAnother"
                                                type="button">{{ __('Create & Create Another') }}</x-button.secondary>
                            <x-button.link-danger wire:navigate href="{{ route('admin.users') }}" alt="Cancel">{{ __('Cancel') }}</x-button.link-danger>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
