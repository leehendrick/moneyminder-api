<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TransactionFilter;
use App\Http\Requests\Api\V1\ReplaceTransactionRequest;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserTransactionsController extends ApiController
{
    public function index($user_id, TransactionFilter $filters)
    {
        return TransactionResource::collection(Transaction::where('user_id', $user_id)
            ->filter($filters)
            ->paginate());
    }

    public function store($user_id, StoreTransactionRequest $request)
    {
        $model = [
            'value' => $request->input('data.attributes.value'),
            'date' => $request->input('data.attributes.date'),
            'description' => $request->input('data.attributes.description'),
            'transaction_type_id' => $request->input('data.relationships.transactionType.data.id'),
            'category_id' => $request->input('data.relationships.category.data.id'),
            'user_id' => $user_id,
        ];

        return new TransactionResource(Transaction::create($model));
    }

    public function replace(ReplaceTransactionRequest $request, $user_id, $transaction_id)
    {
        //PUT
        try {
            $transaction = Transaction::findOrFail($transaction_id);

            if($transaction->user_id == $user_id){
                $model = [
                    'value' => $request->input('data.attributes.value'),
                    'date' => $request->input('data.attributes.date'),
                    'description' => $request->input('data.attributes.description'),
                    'transaction_type_id' => $request->input('data.relationships.transactionType.data.id'),
                    'category_id' => $request->input('data.relationships.category.data.id'),
                    'user_id' => $request->input('data.relationships.author.data.id'),
                ];

                $transaction->update($model);

                return new TransactionResource($transaction);
            }

        } catch (ModelNotFoundException $exception){
            return $this->error('Transaction can not be found.', 404);
        }
    }

    public function destroy($user_id, $transaction_id)
    {
        try {
            $transaction = Transaction::findOrFail($transaction_id);


            if($transaction->user_id == $user_id){
                $transaction->delete();
                return $this->ok('Transaction sucessfully deleted.');
            }

            return $this->error('Transaction can not be found.', 404);
        } catch(ModelNotFoundException $exception) {
            return $this->error('Transaction can not be found.', 404);
        }
    }
}
