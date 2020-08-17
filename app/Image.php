<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Image
 *
 * @property int $id
 * @property string $name
 * @property string $imagable_type
 * @property int $imagable_id
 * @property-read mixed $url
 * @property-read Model|Eloquent $imagable
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereImagableId($value)
 * @method static Builder|Image whereImagableType($value)
 * @method static Builder|Image whereName($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    protected $hidden = [
        'imagable_id',
        'imagable_type',
    ];

    protected $appends = [
        'url',
    ];

    public function imagable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        $base = env('IMAGES_PATH', false);
        if ($base) {
            return $base.'/'.$this->name;
        }
        return url(Storage::url($this->name));
    }
}
