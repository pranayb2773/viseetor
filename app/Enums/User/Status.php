<?php

namespace App\Enums\User;

enum Status: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::PENDING => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'bg-success-100 text-success-800',
            self::INACTIVE => 'bg-danger-100 text-danger-800',
            self::PENDING => 'bg-pending-100 text-pending-800',
        };
    }
}
