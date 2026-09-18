<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'type',
        'category',
        'transaction_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    //newCode
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format(
            $this->amount,
            0,
            ',',
            '.'
        );
    }
}
