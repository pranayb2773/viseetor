<?php

namespace App\Livewire\Admin\User;

use App\Enums\User\Status;
use App\Enums\User\Type;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public Type $type;
    public array $typeOptions = [];

    protected function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'type' => ['required', Rule::enum(Type::class)],
        ];
    }

    public function mount(): void
    {
        // Use it for dropdown in create user page
        foreach (Type::cases() as $typeOption) {
            $this->typeOptions[] = ['value' => $typeOption->value, 'label' => $typeOption->label()];
        }
    }

    public function cancel()
    {
        // Dispatch event
        session()->flash('notify', [
            'type' => 'success',
            'content' => 'User Created Successfully.'
        ]);

        redirect(route('admin.auth.profile'));
    }

    public function create(): void
    {
        // Validate
        $this->validate();

        // Create user
        User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'type' => $this->type,
            'status' => Status::PENDING,
            'password' => Str::random(8)
        ]);

        $this->reset();

        // Dispatch event
        session()->flash('notify', [
            'type' => 'success',
            'content' => 'User Created Successfully.'
        ]);

        $this->redirect(route('admin.users'));
    }

    public function createAnother(): void
    {
        $this->validate();

        User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'type' => $this->type,
            'status' => Status::PENDING,
            'password' => Str::random(8)
        ]);

        // Reset properties
        $this->reset();

        // Dispatch event
        $this->dispatch('notify', [
            'type' => 'success',
            'content' => 'User Created Successfully.'
        ]);

        // Redirect Users listing page
        $this->redirect(route('admin.users.create'));
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.create')
            ->layout('layouts.admin', [
                'title' => 'Create User',
                'description' => 'In this page, we will create new user.',
            ]);
    }
}
