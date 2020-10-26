<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property float $price
 * @property float $is_published
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'is_published'];

    /**
     *
     */
    public function category()
    {
        return $this->hasMany(
            'App\Models\ProductCategory',
            'product_id',

        );
    }

    /**
     *
     */
    public function categories()
    {
        return $this->hasManyThrough(
            'App\Models\Category',
            'App\Models\ProductCategory',
            'product_id',
            'id',
            'id',
            'category_id'
        );
    }
}
