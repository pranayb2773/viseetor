<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        auth()
            ->user()
            ->update([
                'password' => Hash::make($validated['password']),
            ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-label.main for="current_password" :value="__('Current Password')" />
            <x-input.text wire:model="current_password" id="current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" field="current_password" />
            <x-input.error field="current_password" class="mt-2" />
        </div>

        <div>
            <x-label.main for="password" :value="__('New Password')" />
            <x-input.text wire:model="password" id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" field="password" />
            <x-input.error field="password" class="mt-2" />
        </div>

        <div>
            <x-label.main for="password_confirmation" :value="__('Confirm Password')" />
            <x-input.text wire:model="password_confirmation" id="password_confirmation" name="password_confirmation"
                type="password" class="mt-1 block w-full" autocomplete="new-password" field="password_confirmation" />
            <x-input.error field="password_confirmation" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-button.primary>{{ __('Save') }}</x-button.primary>

            <x-action-message class="mr-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
