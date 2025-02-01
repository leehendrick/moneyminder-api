<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Policies\V1\TransactionPolicy;
use App\Traits\ApiResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    use ApiResponses;
    use AuthorizesRequests;

    protected string $policyClass = TransactionPolicy::class;

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
        // Verifica se o modelo é uma instância de Transaction ou outro modelo válido
        if (is_object($targetModel) && $targetModel instanceof Transaction) {
            // Define a policy explicitamente
            Gate::policy(get_class($targetModel), $this->policyClass);
        } elseif (is_string($targetModel)) {
            // Verifica se é um nome de classe válido
            if (!class_exists($targetModel)) {
                throw new \InvalidArgumentException("The target model class '$targetModel' does not exist.");
            }
            Gate::policy($targetModel, $this->policyClass);
        } else {
            throw new \InvalidArgumentException("Invalid target model type.");
        }

        // Tenta autorizar com o Gate
        return Gate::authorize($ability, [$targetModel]);
    }

}
