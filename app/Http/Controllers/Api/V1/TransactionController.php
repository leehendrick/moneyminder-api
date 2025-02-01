<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TransactionFilter;
use App\Http\Requests\Api\V1\ReplaceTransactionRequest;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Requests\Api\V1\UpdateTransactionRequest;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use App\Policies\V1\TransactionPolicy;

class TransactionController extends ApiController
{
    protected string $policyClass = TransactionPolicy::class;

    public function index(TransactionFilter $filters){
        return TransactionResource::collection(Transaction::filter($filters)->paginate());
    }

    public function store(StoreTransactionRequest $request)
    {
        if ($this->isAble('store', Transaction::class)){
            return new TransactionResource(Transaction::create($request->mappedAttributes()));
        }

        return $this->notAuthorized('You are not authorized to store that resource');
    }

    public function show(Transaction $transaction){

        if ($this->include('author')) {
            return new TransactionResource($transaction->load('user'));
        }
        return new TransactionResource($transaction);
    }

    public function update(UpdateTransactionRequest $request,  Transaction $transaction){

        //PATCH
            if ($this->isAble('update', $transaction)){
                $transaction->update($request->mappedAttributes());
                return new TransactionResource($transaction);
            }

            return $this->notAuthorized('You are not authorized to update that resource');
    }

    public function replace(ReplaceTransactionRequest $request, Transaction $transaction)
    {
        //PUT
        if ($this->isAble('replace', $transaction)){
            $transaction->update($request->mappedAttributes());
            return new TransactionResource($transaction);
        }

        return $this->notAuthorized('You are not authorized to replace that resource');
    }

    public function destroy(Transaction $transaction)
    {
        if ($this->isAble('destroy', $transaction)){
            $transaction->delete();
            return $this->ok('Transaction sucessfully deleted.');
        }

        return  $this->notAuthorized('You are not authorized to delete that resource');
    }
}



