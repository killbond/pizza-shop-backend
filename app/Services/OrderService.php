<?php

namespace App\Services;

use App\Delivery;
use App\Events\OrderCreated;
use App\Http\Requests\OrderStoreRequest;
use App\Order;
use App\Repositories\OrderRepository;
use App\User;

class OrderService
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserOrders(User $user)
    {
        return $this->repository->getByUser($user);
    }

    public function handleOrder(OrderStoreRequest $request)
    {
        $order = $this->createOrder($request->only('currency_id', 'phone'));
        $this->attachPositionsToOrder($order, $request->positions);
        $this->attachUserToOrder($order, $request->user());
        $this->attachDeliveryToOrder($order, $request->delivery);

        event(new OrderCreated($order));

        return $order->load('positions.image', 'delivery.coordinates');
    }

    protected function createOrder(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    protected function attachPositionsToOrder(Order $order, array $positions)
    {
        foreach ($this->groupPositionsByProductId($positions) as $id => $quantity) {
            $order->positions()
                ->attach($id, ['quantity' => $quantity]);
        }
    }

    protected function groupPositionsByProductId(array $positions)
    {
        return collect($positions)
            ->mapToGroups(function ($item) {
                return [$item['product_id'] => $item['quantity']];
            })->transform(function ($item) {
                return $item->sum();
            });
    }

    protected function attachUserToOrder(Order $order, User $user = null)
    {
        if (isset($user)) {
            $user->orders()
                ->attach($order->id);
        }
    }

    protected function attachDeliveryToOrder(Order $order, array $attributes)
    {
        $delivery = Delivery::make($attributes);

        $order->delivery()
            ->save($delivery);

        if ($delivery->isDelivery()) {
            $delivery->coordinates()
                ->make($attributes['coordinates'])
                ->save();
        }
    }
}
