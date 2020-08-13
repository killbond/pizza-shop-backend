<?php

namespace App\Listeners;

use App\Actions\CalculateOrderCurrencyRate;
use App\Actions\CalculateOrderPositions;
use App\Events\OrderCreated;
use App\Order;
use Illuminate\Pipeline\Pipeline;

class CalculateOrderTotal
{
    protected $pipes = [
        CalculateOrderPositions::class,
        CalculateOrderCurrencyRate::class
    ];

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        /** @var Pipeline $pipeline */
        $pipeline = app(Pipeline::class);
        $pipeline->send($event->order)
            ->through($this->pipes)
            ->via('handle')
            ->then(function (Order $order) {
                return $order->update();
            });
    }
}
