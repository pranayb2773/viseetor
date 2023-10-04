<?php

namespace App\Models;

use App\Enums\SpatiePermission\Guard;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
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
            get: fn ($value) => str($value)->lower()->replace(' ', '-'),
            set: fn ($value) => str($value)->lower()->replace(' ', '-'),
        );
    }
}
