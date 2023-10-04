<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Enums\User\Type;
use App\Enums\User\Status;

new #[Layout('layouts.guest', [
    'title' => 'Register',
    'header' => 'Create your account'
])] class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'type' => Type::EXTERNAL,
            'status' => Status::ACTIVE,
        ]);

        event(new Registered($user));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- First Name -->
        <div>
            <x-label.main for="first_name" :value="__('First Name')" />
            <x-input.text
                wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                required autofocus autocomplete="first_name"
                field="first_name"
            />
            <x-input.error field="first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-label.main for="last_name" :value="__('Last Name')" />
            <x-input.text
                wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                required autofocus autocomplete="last_name"
                field="last_name"
            />
            <x-input.error field="last_name" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label.main for="email" :value="__('Email')" />
            <x-input.text
                wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="username"
                field="email"
            />
            <x-input.error field="email" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label.main for="password" :value="__('Password')" />

            <x-input.text
                wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password"
                field="password"
            />

            <x-input.error field="password" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label.main for="password_confirmation" :value="__('Confirm Password')" />

            <x-input.text
                wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation"
                required autocomplete="new-password"
                field="password_confirmation"
            />

            <x-input.error field="password_confirmation" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-button.primary class="ml-4">
                {{ __('Register') }}
            </x-button.primary>
        </div>
    </form>
</div>
