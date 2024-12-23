<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function index(){
        return TransactionResource::collection(Transaction::all());
    }

    public function show(Transaction $transaction){
        return new TransactionResource($transaction);
    }
}



