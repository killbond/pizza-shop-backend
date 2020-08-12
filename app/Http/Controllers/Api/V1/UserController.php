<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @param  RegistrationRequest  $request
     * @return JsonResponse
     */
    public function __invoke(RegistrationRequest $request)
    {
        return response()->json(
            ['data' => User::create($request->validated())],
            Response::HTTP_CREATED
        );
    }
}
