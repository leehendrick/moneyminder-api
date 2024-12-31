<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TransactionFilter;
use App\Http\Requests\Api\V1\ReplaceTransactionRequest;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Requests\Api\V1\UpdateTransactionRequest;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\V1\TransactionPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends ApiController
{
    protected $policyClass = TransactionPolicy::class;

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


        return new TransactionResource(Transaction::create($request->mappedAttributes()));
    }

    public function show(Transaction $transaction){

        if ($this->include('author')) {
            return new TransactionResource($transaction->load('user'));
        }
        return new TransactionResource($transaction);
    }

    public function update(UpdateTransactionRequest $request,  $transaction_id){
        //PATCH
        try {
            $transaction = Transaction::findOrFail($transaction_id);

            $this->isAble('update', $transaction);

            $transaction->update($request->mappedAttributes());

            return new TransactionResource($transaction);
        } catch (ModelNotFoundException $exception){
            return $this->error('Transaction can not be found', 404);
        } catch (AuthorizationException $exception) {
            return $this->error('You are not authorized to update that resource', 403);
        }
    }

    public function replace(ReplaceTransactionRequest $request, $transaction_id)
    {
        //PUT
        try {
            $transaction = Transaction::findOrFail($transaction_id);

            $transaction->update($request->mappedAttributes());

            return new TransactionResource($transaction);

        } catch (ModelNotFoundException $exception){
            return $this->error('Transaction can not be found.', 404);
        }
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



