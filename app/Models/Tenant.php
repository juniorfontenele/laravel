<?php

namespace App\Models;

use App\Traits\HasActiveState;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Stancl\VirtualColumn\VirtualColumn;

class Tenant extends Model
{
    use HasActiveState;
    use HasCreator;
    use VirtualColumn;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'is_active',
            'created_by',
            'created_at',
            'updated_at',
        ];
    }
}
