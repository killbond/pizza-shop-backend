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

    public function getUserOrders(User $user)
    {
        return $user->orders()
            ->with('positions')
            ->get();
    }
}
