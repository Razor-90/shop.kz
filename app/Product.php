<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'content',
        'image',
    ];
    /* ... */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Связь «товар принадлежит» таблицы `products` с таблицей `brands`
     */
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function baskets() {
        return $this->belongsToMany(Basket::class)->withPivot('quantity');
    }
}
