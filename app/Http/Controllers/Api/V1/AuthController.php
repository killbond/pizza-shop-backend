<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->service->authorize($request);
        return response()->json(['data' => $token]);
    }

    public function logout()
    {
        $this->service->logout();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
