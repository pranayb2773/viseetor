<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSorting
{
    public string $sortColumn = '';
    public string $sortDirection = '';

    protected function queryStringWithSorting(): array
    {
        return [
            'sortColumn' => ['as' => 'sort'],
            'sortDirection' => ['as' => 'direction'],
        ];
    }

    public function sortBy(string $field): void
    {
        if ($this->sortColumn === $field && $this->sortDirection === 'desc') {
            $this->reset(['sortColumn', 'sortDirection']);
            return;
        } elseif ($this->sortColumn === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $field;
    }

    public function applySorting(Builder $query, string $default = 'updated_at'): Builder
    {
        return empty($this->sortColumn) ? $query->orderByDesc($default) : $query->orderBy($this->sortColumn, $this->sortDirection);
    }
}
