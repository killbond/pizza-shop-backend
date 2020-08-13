<?php

namespace App\Actions;

use App\Order;
use Closure;

class CalculateOrderPositions
{
    public function handle(Order $order, Closure $next)
    {
        foreach ($order->positions as $position) {
            $order->total += $position->pivot->quantity * $position->price;
        }
        $next($order);
    }
}
