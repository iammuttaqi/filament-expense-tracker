<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'items' => 'array',
        ];
    }

    public function expense_category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
