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

    protected function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'type' => ['required', Rule::enum(Type::class)],
        ];
    }

    public function cancel(): void
    {
        $this->redirect(route('admin.users'));
    }

    public function create(): void
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
