<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Delivery
 *
 * @method static Builder|Delivery newModelQuery()
 * @method static Builder|Delivery newQuery()
 * @method static Builder|Delivery query()
 * @mixin Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $type_id
 * @property float $price
 * @property-read Coordinates|null $coordinates
 * @method static Builder|Delivery whereId($value)
 * @method static Builder|Delivery whereOrderId($value)
 * @method static Builder|Delivery wherePrice($value)
 * @method static Builder|Delivery whereTypeId($value)
 */
class Delivery extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'type_id',
        'price',
    ];

    protected $hidden = [
        'order_id',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function coordinates()
    {
        return $this->hasOne(Coordinates::class);
    }

    public function isTakeaway()
    {
        return 2 == $this->type_id;
    }

    public function isDelivery()
    {
        return 1 == $this->type_id;
    }
}
