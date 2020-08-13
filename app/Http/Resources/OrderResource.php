<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $order = parent::toArray($request);
        foreach ($order['positions'] as &$position) {
            $position['quantity'] = $position['pivot']['quantity'];
            unset($position['pivot']);
        }
        return $order;
    }
}
