<?php

namespace App\Models\Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'title',
        'description',
        'classification_id',
        'sub_classification_id',
        'status_id',
        'valid_from',
        'expires_at',
        'territory_id',
        'location_id',
        'organization_unit_id',
        'external_urls',
        'metadata',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'expires_at' => 'date',
        'external_urls' => 'array',
        'metadata' => 'array',
    ];

    public function classification(): BelongsTo
    {
        return $this->belongsTo(DocumentClassification::class, 'classification_id');
    }

    public function subClassification(): BelongsTo
    {
        return $this->belongsTo(DocumentClassification::class, 'sub_classification_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(DocumentStatus::class, 'status_id');
    }

    public function territory(): BelongsTo
    {
        return $this->belongsTo(Territory::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function organizationUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationUnit::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
