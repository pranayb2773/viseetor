<?php

namespace App\Models;

use App\Enums\SpatiePermission\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'guard_name' => Guard::class
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => ucwords($value),
        );
    }

    public function scopeSuperAdmin(Builder $query): Builder
    {
        return $query->where('name', 'Super Admin');
    }
}
