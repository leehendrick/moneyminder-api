<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
class TransactionController extends ApiController
{
    public function index(){

        if ($this->include('author')) {
            return TransactionResource::collection(Transaction::with('user')->paginate());
        }
        return TransactionResource::collection(Transaction::paginate());
    }

    public function show(Transaction $transaction){

        if ($this->include('author')) {
            return new TransactionResource($transaction->load('user'));
        }
        return new TransactionResource($transaction);
    }
}



