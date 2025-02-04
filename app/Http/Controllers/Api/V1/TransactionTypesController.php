<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ReplaceTransactionTypeRequest;
use App\Http\Requests\Api\V1\StoreTransactionTypeRequest;
use App\Http\Requests\Api\V1\UpdateTransactionTypeRequest;
use App\Http\Resources\V1\TransactionTypeResource;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TransactionTypesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TransactionTypeResource::collection(Transaction::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionTypeRequest $request, User $user)
    {
        if (!Gate::allows('create-transaction-type', $user)) {
            return $this->notAuthorized('You are not allowed to create Transaction Types.');
        }
        return new TransactionTypeResource(TransactionType::create($request->mappedAttributes()));
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionType $transactionType)
    {
        return new TransactionTypeResource($transactionType);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionType $transactionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionTypeRequest $request, TransactionType $transactionType)
    {
        if (!Gate::allows('update-transaction-type', $transactionType)) {
            return $this->notAuthorized('You are not allowed to update Transaction Types.');
        }
        $transactionType->update($request->mappedAttributes());
        return new TransactionTypeResource($transactionType);
    }

    public function replace(ReplaceTransactionTypeRequest $request, TransactionType $transactionType)
    {
        if (!Gate::allows('update-transaction-type', $transactionType)) {
            return $this->notAuthorized('You are not allowed to replace Transaction Types.');
        }
        $transactionType->update($request->mappedAttributes());
        return new TransactionTypeResource($transactionType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionType $transactionType)
    {
        if (!Gate::allows('delete-transaction-type', $transactionType)) {
            return $this->notAuthorized('You are not allowed to delete Transaction Types.');
        }
        $transactionType->delete();
        return $this->ok('Transaction Type successfully deleted');
    }
}
