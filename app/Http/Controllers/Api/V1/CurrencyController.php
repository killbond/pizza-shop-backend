<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\Api\V1
 */
class CurrencyController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke()
    {
        return CurrencyResource::collection(Currency::all());
    }
}
