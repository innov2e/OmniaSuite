<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentClassification extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(DocumentClassification::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(DocumentClassification::class, 'parent_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'classification_id');
    }

    public function subClassificationDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'sub_classification_id');
    }
}
