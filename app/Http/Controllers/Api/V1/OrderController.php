<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(OrderStoreRequest $request)
    {
        $order = $this->repository->create($request);
        return OrderResource::make($order)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function list(User $user)
    {
        $orders = $this->repository->getUserOrders($user);
        return OrderResource::collection($orders);
    }
}
