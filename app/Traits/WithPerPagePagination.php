<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public int $perPage = 10;
    public array $arrPerPage = [10, 25, 50];

    public function mountWithPerPagePagination(): void
    {
        $this->perPage = Session::get('perPage', $this->perPage);
    }

    public function updatedPerPage($value): void
    {
        Session::put('perPage', $value);
        $this->reset(['selected', 'selectAll', 'selectPage']);
        $this->resetPage();
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }
}
