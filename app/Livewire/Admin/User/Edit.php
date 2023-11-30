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
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Collection<Role> $getRoles
 * @property Collection<Permission> $getPermissions
 */
class Edit extends Component
{
    public User $user;
    public array $roles = [];
    public array $permissions = [];
    public array $typeOptions = [];
    public array $statusOptions = [];
    public array $rolesOptions = [];
    public array $permissionsOptions = [];

    protected function rules(): array
    {
        return [
            'user.first_name' => ['required', 'string', 'max:255'],
            'user.last_name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignoreModel($this->user)],
            'user.type' => ['required', Rule::enum(Type::class)],
            'user.status' => ['required', Rule::enum(Status::class)],
            'roles' => ['required', 'array'],
            'roles.*' => ['int'],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['int']
        ];
    }

    public function mount($id): void
    {
        $this->user = User::findOrFail($id);

        // Use it for dropdown in edit user page
        foreach (Type::cases() as $typeOption) {
            $this->typeOptions[] = ['value' => $typeOption->value, 'label' => $typeOption->label()];
        }

        // Use it for dropdown in edit user page
        foreach (Status::cases() as $statusOption) {
            $this->statusOptions[] = ['value' => $statusOption->value, 'label' => $statusOption->label()];
        }

        // Get user roles and permissions
        $this->roles = $this->user->roles()->select('id')->pluck('id')->toArray();
        $this->permissions = $this->user->permissions()->select('id')->pluck('id')->toArray();

        // Use it for roles and permissions dropdown in create user page
        $this->rolesOptions = $this->getRoles->toArray();
        $this->permissionsOptions = $this->getPermissions->toArray();
    }

    public function updated(string $property): void
    {
        $this->validateOnly($property);
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

    public function save(): void
    {
        // Validate data based on above rules
        $this->validate();

        // Save updated user information
        $this->user->save();

        // Assign roles & permissions to user
        $this->user->syncRoles($this->roles);
        $this->user->syncPermissions($this->permissions);

        // Dispatch event
        $this->dispatch('notify', [
            'type' => 'success',
            'content' => 'User Updated Successfully.'
        ]);
    }

    public function delete()
    {
        // Remove roles & permission from user
        $this->user->syncRoles();
        $this->user->syncPermissions();

        // Delete user
        $this->user->delete();

        // Dispatch event
        session()->flash('notify', [
            'type' => 'success',
            'content' => 'User Deleted Successfully.'
        ]);

        // Redirect Users listing page
        $this->redirectRoute('admin.users');
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.edit')
            ->layout('layouts.admin', [
                'title' => 'Edit User',
                'description' => 'In this page, we will edit existing user.',
            ]);
    }
}
