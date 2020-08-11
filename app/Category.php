<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
