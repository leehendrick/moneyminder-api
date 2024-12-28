<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TransactionFilter;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
class TransactionController extends ApiController
{
    public function index(TransactionFilter $filters){
        return TransactionResource::collection(Transaction::filter($filters)->paginate());
    }

    public function show(Transaction $transaction){

        if ($this->include('author')) {
            return new TransactionResource($transaction->load('user'));
        }
        return new TransactionResource($transaction);
    }
}



