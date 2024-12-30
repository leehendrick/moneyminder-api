<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TransactionFilter;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserTransactionsController extends Controller
{
    public function index($user_id, TransactionFilter $filters)
    {
        return TransactionResource::collection(Transaction::where('user_id', $user_id)
            ->filter($filters)
            ->paginate());
    }
}
