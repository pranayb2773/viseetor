<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Traits\WithSorting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Collection<User> $users
 */
class Index extends Component
{
    use WithSorting;

    public string $search = '';
    public string $updated_at = '';

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return User::with(['roles' => function ($query) {
            $query->orderByDesc('name');
        }])
            ->when($this->search, fn(Builder $query, $search) => $query->whereLike(['first_name', 'last_name'], $search))
            ->when($this->updated_at, fn(Builder $query, $updated_at) => $query->whereLike('updated_at', Carbon::parse($updated_at)->format('Y-m-d')))
            //->when($this->sortColumn, fn(Builder $query, $sortColumn) => $query->orderBy($sortColumn, $this->sortDirection), fn(Builder $query) => $query->orderByDesc('updated_at'))
            ->paginate();
    }
    public function render(): Application|Factory|View
    {
        return view('livewire.admin.user.index', [
            'users' => $this->users,
        ])->layout('layouts.admin', [
            'title' => 'Users',
            'description' => 'In this page, we will get the all users information.',
        ]);
    }
}
