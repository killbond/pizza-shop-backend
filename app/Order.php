<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Order
 *
 * @property int $id
 * @property int $currency_id
 * @property string $phone
 * @property float $total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Product[] $positions
 * @property-read int|null $positions_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereCurrencyId($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order wherePhone($value)
 * @method static Builder|Order whereTotal($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    protected $hidden = [
        'pivot'
    ];

    protected $casts = [
        'total' => 'float',
    ];

    public function positions()
    {
        return $this->belongsToMany(Product::class, 'order_position')
            ->withPivot('quantity');
    }
}
