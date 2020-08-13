<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\User;

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

    public function store()
    {
    }

    public function list(User $user)
    {
        $orders = $this->repository->getUserOrders($user);
        return OrderResource::collection($orders);
    }
}
