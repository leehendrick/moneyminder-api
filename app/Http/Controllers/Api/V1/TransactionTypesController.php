<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TransactionTypeResource;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TransactionTypeResource::collection(Transaction::all());
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, TransactionType $transactionType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionType $transactionType)
    {
        //
    }
}
