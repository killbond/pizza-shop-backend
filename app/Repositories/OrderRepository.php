<?php

namespace App\Repositories;

use App\Order;
use App\User;

class OrderRepository
{
    /**
     * @var Order
     */
    protected $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function getByUser(User $user)
    {
        return $user->orders()
            ->with('positions', 'positions.image', 'delivery.coordinates')
            ->get();
    }
}
