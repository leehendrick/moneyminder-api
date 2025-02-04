<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model
{
    use HasFactory;

    protected $table = 'transaction_types';
    protected $fillable = [
        'name',
    ];

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

}
