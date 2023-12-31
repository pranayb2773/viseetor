<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Providers\RouteServiceProvider;

new #[Layout("layouts.guest")] class extends Component {
    public function sendVerification(): void
    {
        if (
            auth()
                ->user()
                ->hasVerifiedEmail()
        ) {
            $this->redirect(
                session("url.intended", RouteServiceProvider::HOME),
                navigate: true
            );

            return;
        }

        auth()
            ->user()
            ->sendEmailVerificationNotification();

        session()->flash("status", "verification-link-sent");
    }

    public function logout(): void
    {
        auth()
            ->guard("web")
            ->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect("/", navigate: true);
    }
};
?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-button.primary wire:click="sendVerification">
            {{ __('Resend Verification Email') }}
        </x-button.primary>

        <button wire:click="logout" type="submit"
                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </div>
</div>
