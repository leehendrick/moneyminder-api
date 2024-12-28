<?php

namespace App\Http\Filters\V1;

class TransactionFilter extends QueryFilter
{
    public function createdAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function include($value) {
        return $this->builder->with($value);
    }

    public function title($value) {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
    }

    public function category($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->whereHas('category', function ($query) use ($likeStr) {
            $query->where('name', 'like', $likeStr);
        });
    }

    public function transaction_type($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->whereHas('transaction_type', function ($query) use ($likeStr) {
            $query->where('name', 'like', $likeStr);
        });
    }

    public function updatedAt($value) {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

}