<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Requests\Api\V1\UpdateTransactionRequest;

class TransactionController extends Controller
{
    public function index(){
        TransactionResource::collection(Transaction::paginate());
    }

    public function show(Transaction $transaction){
        return new TransactionResource($transaction);
    }
}



