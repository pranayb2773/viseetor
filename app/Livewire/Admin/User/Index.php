<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use App\Traits\WithBulkActions;
use App\Traits\WithPerPagePagination;
use App\Traits\WithSorting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @property Collection<User> $rows
 * @property Builder $rowsQuery
 * @property Builder $selectedRows
 * @property Collection<Role> $roles
 */
class Index extends Component
{
    use WithSorting;
    use WithPerPagePagination;
    use WithBulkActions;

    public string $search = '';
    public string $updatedAt = '';
    public string $status = '';
    public string $type = '';
    public array $selectedRoles = [];

    public function deleteUsers(): void
    {
        $this->selectedRows->delete();
        $this->dispatch('close-modal', 'confirm-user-deletion');
        $this->reset(['selected', 'selectAll', 'selectPage']);
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['updatedAt', 'status', 'type', 'selectedRoles']);
        $this->resetPage();
    }

    #[Computed]
    public function rowsQuery(): Builder
    {
        $query = User::with(['roles'])
            ->when($this->search, fn(Builder $query, $search) => $query->whereLike(['first_name', 'last_name', 'roles.name'], $search))
            ->when($this->updatedAt, fn(Builder $query, $updatedAt) => $query->whereLike('updated_at', Carbon::parse($updatedAt)->format('Y-m-d')))
            ->when($this->status, fn(Builder $query, $status) => $query->where('status', $status))
            ->when($this->type, fn(Builder $query, $type) => $query->where('type', $type))
            ->when($this->selectedRoles, function (Builder $query) {
                $query->whereHas('roles', fn(Builder $query) => $query->whereIn('id', $this->selectedRoles));
            });

        return $this->applySorting($query);
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return $this->applyPagination($this->rowsQuery);
    }

    #[Computed]
    public function roles(): Collection
    {
        return Role::select(['id as value', 'name as label'])->whereGuardName('web')->orderBy('name')->get();
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.index', [
            'users' => $this->rows,
            'roles' => $this->roles,
        ])->layout('layouts.admin', [
            'title' => 'Users',
            'description' => 'In this page, we will get the all users information.',
        ]);
    }
}
