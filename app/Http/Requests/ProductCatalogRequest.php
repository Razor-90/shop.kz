<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCatalogRequest extends FormRequest
{
    protected $entity = [
        'name' => 'product',
        'table' => 'products'
    ];

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required',
        ];
    }

    /**
     * Объединяет дефолтные правила и правила, специфичные для товара
     * для проверки данных при добавлении нового товара
     */
    protected function createItem() {
        $rules = [
            'category_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'brand_id' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
        return array_merge(parent::createItem(), $rules);
    }

    /**
     * Объединяет дефолтные правила и правила, специфичные для товара
     * для проверки данных при обновлении существующего товара
     */
    protected function updateItem() {
        $rules = [
            'category_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'brand_id' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
        return array_merge(parent::updateItem(), $rules);
    }
}
