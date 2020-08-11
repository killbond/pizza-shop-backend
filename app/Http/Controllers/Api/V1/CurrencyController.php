<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;

/**
 * Class CurrencyController
 * @package App\Http\Controllers
 */
class CurrencyController extends Controller
{
    public function __invoke()
    {
        return CurrencyResource::collection(Currency::all());
    }
}
