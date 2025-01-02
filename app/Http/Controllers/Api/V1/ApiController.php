<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Policies\V1\TransactionPolicy;
use App\Traits\ApiResponses;
use Illuminate\Auth\Access\Response;
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

    public function isAble($ability, $targetModel) {
        if ($targetModel instanceof Transaction) {
            $gate = Gate::policy($targetModel::class, $this->policyClass);
        }
            $gate = Gate::policy($targetModel, $this->policyClass);

        return $gate->authorize($ability, [$targetModel]);
    }
}
