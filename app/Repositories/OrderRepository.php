<?php

namespace App\Repositories;

use App\Events\OrderCreated;
use App\Http\Requests\OrderStoreRequest;
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

    public function create(OrderStoreRequest $request)
    {
        $data = $request->merge(['total' => 0])->except('positions');
        $order = $this->model->create($data);

        $positions = collect($request->get('positions'))
            ->mapToGroups(function ($item) {
                return [$item['product_id'] => $item['quantity']];
            });

        foreach ($positions as $id => $quantities) {
            $order->positions()->attach($id, ['quantity' => $quantities->sum()]);
        }

        event(new OrderCreated($order));

        return $order->load('positions.image');
    }

    public function getUserOrders(User $user)
    {
        return $user->orders()
            ->with('positions', 'positions.image')
            ->get();
    }
}
