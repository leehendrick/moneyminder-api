<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TransactionFilter;
use App\Http\Requests\Api\V1\ReplaceTransactionRequest;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Requests\Api\V1\UpdateTransactionRequest;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use Illuminate\Auth\Access\AuthorizationException;
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
        try {
            $this->isAble('store', Transaction::class);

            return new TransactionResource(Transaction::create($request->mappedAttributes([
                'user_id' => $user_id,
            ])));

        } catch (AuthorizationException $ex) {
            return $this->error('You are not authorized to create that resource.', 401);
        }
    }

    public function update(UpdateTransactionRequest $request, $user_id, $transaction_id){
        //PATCH
        try {
            $transaction = Transaction::where('id', $transaction_id)
                ->where('user_id', $user_id)
                ->firstOrFail();

            $this->isAble('update', $transaction);

            $transaction->update($request->mappedAttributes());

            return new TransactionResource($transaction);

        } catch (ModelNotFoundException $exception) {
            return $this->error('Transaction can not be found', 404);
        } catch (AuthorizationException $ex) {
            return $this->error('You are not authorized to update that resource.', 401);
        }
    }

    public function replace(ReplaceTransactionRequest $request, $user_id, $transaction_id)
    {
        //PUT
        try {
            $transaction = Transaction::where('id', $transaction_id)
                ->where('user_id', $user_id)
                ->firstOrFail();

            $this->isAble('replace', $transaction);

            $transaction->update($request->mappedAttributes());

            return new TransactionResource($transaction);

        } catch (ModelNotFoundException $exception){
            return $this->error('Transaction can not be found.', 404);
        } catch (AuthorizationException $exception){
            return $this->error('You are not authorized to update that resource', 401);
        }
    }

    public function destroy($user_id, $transaction_id)
    {
        try {
            $transaction = Transaction::where('id', $transaction_id)
                ->where('user_id', $user_id)
                ->firstOrFail();

            $this->isAble('delete', $transaction);

            $transaction->delete();

            return $this->ok('Ticket sucessfully deleted.');

        } catch(ModelNotFoundException $exception) {
            return $this->error('Transaction can not be found.', 404);
        } catch (AuthorizationException $ex) {
            return $this->error('You are not authorized to update delete that resource.', 401);
        }
    }
}
