<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\V1\TransactionPolicy;
use App\Traits\ApiResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    use ApiResponses;
    use AuthorizesRequests;

    public function include(string $relationship): bool {

        $param = request()->get('include');

        if (!asset($param)) {
            return false;
        }

        $includeValues = explode(',', strtolower($param));

        return in_array(strtolower($relationship), $includeValues);
    }

    public function isAble($ability, $targetModel)
    {
        // Verifica se o modelo é um objeto e se é uma instância de User ou Transaction
        if (is_object($targetModel)) {
            // Se for uma instância de User ou Transaction, verifica autorização
            if ($targetModel instanceof User || $targetModel instanceof Transaction) {
                return Gate::allows($ability, $targetModel);
            }
        }

        // Se for um nome de classe, verifica se existe uma policy
        if (is_string($targetModel)) {
            if (!class_exists($targetModel)) {
                throw new \InvalidArgumentException("The target model class '$targetModel' does not exist.");
            }
            return Gate::allows($ability, $targetModel);
        }

        // Se o tipo do modelo for inválido
        throw new \InvalidArgumentException("Invalid target model type.");
    }

}
