<?php

use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    #[Rule(["required", "string", "current_password"])]
    public string $password = "";

    public function deleteUser(): void
    {
        $this->validate();

        tap(auth()->user(), fn() => auth()->logout())->delete();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect("/", navigate: true);
    }
};
?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>

    <x-modal.main name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <div class="flex items-center justify-between pb-3">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
                <button type="button" x-on:click="$dispatch('close')"
                    class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 transition duration-150 ease-in-out hover:bg-gray-50 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:ring-offset-2 dark:focus:ring-offset-secondary-800">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-label.main for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-input.text wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" field="password" />

                <x-input.error field="password" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal.main>
</section>
