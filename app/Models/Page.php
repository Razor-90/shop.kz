<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
    //
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'content',
        'parent_id',
    ];

    /**
     * Связь «один ко многим» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Связь «страница принадлежит» таблицы `pages` с таблицей `pages`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(Page::class);
    }
    /**
     * Если мы в панели управления — страница будет получена из
     * БД по id, если в публичной части сайта — то по slug
     *
     * @return string
     */
    public function getRouteKeyName() {
        $current = Route::currentRouteName();
        if ('page.show' == $current) {
            return 'slug'; // мы в публичной части сайта
        }
        return 'id'; // мы в панели управления
    }
    /* ... */
    /**
     * Если мы в панели управления — страница будет получена из
     * БД по id, если в публичной части сайта — то по slug
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null) {
        $current = Route::currentRouteName();
        if ('page.show' == $current) {
            // мы в публичной части сайта
            return $this->whereSlug($value)->firstOrFail();
        }
        // мы в панели управления
        return $this->findOrFail($value);
    }
    /* ... */
}
