<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Policies\V1\TransactionPolicy;
use App\Traits\ApiResponses;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends Controller
{
    use ApiResponses;
    use AuthorizesRequests;

    protected $policyClass = TransactionPolicy::class;

    public function include(string $relationship): bool {

        $param = request()->get('include');

        if (!asset($param)) {
            return false;
        }

        $includeValues = explode(',', strtolower($param));

        return in_array(strtolower($relationship), $includeValues);
    }

    public function isAble($ability, $targetModel): Response
    {
        return $this->authorize($ability, [$targetModel, $this->policyClass]);
    }
}
