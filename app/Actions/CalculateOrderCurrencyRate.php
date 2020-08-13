<?php

namespace App\Actions;

use Closure;
use App\Order;

class CalculateOrderCurrencyRate
{
    public function handle(Order $order, Closure $next)
    {
        $order->total *= $order->currency->usd_rate;
        $next($order);
    }
}
