<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TransactionFilter;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends ApiController
{
    public function index(TransactionFilter $filters){
        return TransactionResource::collection(Transaction::filter($filters)->paginate());
    }

    public function store(StoreTransactionRequest $request)
    {
        try {
            $user = User::findOrFail($request->input('data.relationships.author.data.id'));
        } catch (ModelNotFoundException $exception){
            return $this->ok('User not found', [
                'error' => 'The provided user id does not exist.'
            ]);
        }

        $model = [
            'value' => $request->input('data.attributes.value'),
            'date' => $request->input('data.attributes.date'),
            'description' => $request->input('data.attributes.description'),
            'transaction_type_id' => $request->input('data.relationships.transactionType.data.id'),
            'category_id' => $request->input('data.relationships.category.data.id'),
            'user_id' => $request->input('data.relationships.author.data.id'),
        ];

        return new TransactionResource(Transaction::create($model));
    }

    public function show(Transaction $transaction){

        if ($this->include('author')) {
            return new TransactionResource($transaction->load('user'));
        }
        return new TransactionResource($transaction);
    }

    public function destroy($transaction_id)
    {
        try {
            $transaction = Transaction::findOrFail($transaction_id);
            $transaction->delete();

            return $this->ok('Transaction sucessfully deleted.');
        } catch(ModelNotFoundException $exception) {
            return $this->error('Transaction can not be found.', 404);
        }
    }
}



