<?php

namespace App\Traits;

use Livewire\Attributes\Computed;

trait WithBulkActions
{
    public array $selected = [];
    public bool $selectPage = false;
    public bool $selectAll = false;

    public function renderingWithBulkActions(): void
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }
    }

    public function updatedSelected(): void
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value): void
    {
        if (empty($value)) {
            $this->selectAll = false;
            $this->selected = [];

            return;
        }

        $this->selectPageRows();
    }

    public function selectPageRows(): void
    {
        $this->selected = $this->rows
            ->pluck("id")
            ->map(fn($id) => (string)$id)
            ->toArray();
    }

    #[Computed]
    public function selectedRows()
    {
        return (clone $this->rows)->unless(
            $this->selectAll,
            fn($query) => $query->find($this->selected)
        );
    }
}
