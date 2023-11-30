<?php

namespace App\Livewire\Admin\User;

use App\Enums\User\Status;
use App\Enums\User\Type;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Collection<Role> $getRoles
 * @property Collection<Permission> $getPermissions
 */
class Create extends Component
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public Type $type;
    public array $roles = [];
    public array $permissions = [];
    public array $typeOptions = [];
    public array $rolesOptions = [];
    public array $permissionsOptions = [];

    protected function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'type' => ['required', Rule::enum(Type::class)],
            'roles' => ['required', 'array'],
            'roles.*' => ['int'],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['int']
        ];
    }

    public function mount(): void
    {
        // Use it for dropdown in create user page
        foreach (Type::cases() as $typeOption) {
            $this->typeOptions[] = ['value' => $typeOption->value, 'label' => $typeOption->label()];
        }

        // Use it for roles and permissions dropdown in create user page
        $this->rolesOptions = $this->getRoles->toArray();
        $this->permissionsOptions = $this->getPermissions->toArray();
    }

    public function updated(string $property): void
    {
        $this->validateOnly($property);
    }

    public function create(): void
    {
        // Validate
        $this->validate();

        // Create user
        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'type' => $this->type,
            'status' => Status::PENDING,
            'password' => Str::random(8)
        ]);

        // Assign roles & permissions to user
        $user->syncRoles($this->roles);
        $user->syncPermissions($this->permissions);

        // Reset all properties
        $this->reset();

        // Dispatch event
        session()->flash('notify', [
            'type' => 'success',
            'content' => 'User Created Successfully.'
        ]);

        $this->redirectRoute('admin.users');
    }

    public function createAnother(): void
    {
        // validate data based on above rules
        $this->validate();

        // Create user
        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'type' => $this->type,
            'status' => Status::PENDING,
            'password' => Str::random(8)
        ]);

        // Assign roles & permissions to user
        $user->syncRoles($this->roles);
        $user->syncPermissions($this->permissions);

        // Reset properties
        $this->reset();

        // Dispatch event
        session()->flash('notify', [
            'type' => 'success',
            'content' => 'User Created Successfully.'
        ]);

        // Redirect Users create page
        $this->redirectRoute('admin.users.create');
    }

    #[Computed]
    public function getRoles(): Collection
    {
        return Role::select(['id as value', 'name as label'])
            ->when(!auth()->user()->isSuperAdmin(), fn(Builder $query) => $query->whereNot('name', 'Super Admin'))
            ->orderBy('name')->get();
    }

    #[Computed]
    public function getPermissions(): Collection
    {
        return Permission::select(['id as value', 'name as label'])->orderBy('name')->get();
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
