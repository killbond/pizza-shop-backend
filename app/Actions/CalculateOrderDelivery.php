<?php

namespace App\Actions;

use App\Delivery;
use App\Order;
use Closure;

class CalculateOrderDelivery
{
    public function handle(Order $order, Closure $next)
    {
        $delivery = $order->delivery;
        if ($delivery->isDelivery()) {
            $price = $this->getPrice($delivery);
            $delivery->update(['price' => $price]);
            $order->total += $price;
        }
        $next($order);
    }

    protected function getPrice(Delivery $delivery)
    {
        return 5;
    }
}
