<x-admin-layout>
    <div class="space-y-4 px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs.main>
            <x-breadcrumbs.link>Profile</x-breadcrumbs.link>
        </x-breadcrumbs.main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Profile</h1>
    </div>

    <div class="py-4">
        <div class="max-w-4xl space-y-6 px-4 sm:px-6">
            <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
