<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'items' => 'array',
        ];
    }

    public function income_category(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class);
    }
}
