<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\User;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(OrderStoreRequest $request)
    {
        $order = $this->service->handleOrder($request);
        return OrderResource::make($order)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function list(User $user)
    {
        $orders = $this->service->getUserOrders($user);
        return OrderResource::collection($orders);
    }
}
