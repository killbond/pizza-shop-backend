<?php

namespace App\Actions;

use App\Coordinates;
use App\Order;
use Closure;

class CalculateOrderDelivery
{
    public function handle(Order $order, Closure $next)
    {
        $delivery = $order->delivery;
        if ($delivery->isDelivery()) {
            $price = $this->getPrice($delivery->coordinates);
            $delivery->update(['price' => $price]);
            $order->total += $price;
        }
        $next($order);
    }

    protected function getPrice(Coordinates $coordinates)
    {
        return 5;
    }
}
