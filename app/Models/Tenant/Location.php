<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'code',
        'territory_id',
        'address',
        'city',
        'postal_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function territory(): BelongsTo
    {
        return $this->belongsTo(Territory::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}