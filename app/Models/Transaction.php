<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Filters\V1\QueryFilter;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'date',
        'description',
        'transaction_type_id',
        'category_id',
        'user_id',
    ];

    public function category(): HasMany
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function transaction_type(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters){
        return $filters->apply($builder);
    }

}
