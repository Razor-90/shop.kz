<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index() {
        // корневые категории
        $roots = Category::where('parent_id', 0)->get();
        // популярные бренды
        $brands = Brand::popular();
        return view('catalog.index', compact('roots', 'brands'));
    }

    public function category(Request $request, $slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        // получаем всех потомков этой категории
        $descendants = $category->getAllChildren($category->id);
        $descendants[] = $category->id;

        $builder = Product::whereIn('category_id', $descendants);

        // дешевые или дорогие товары
        if ($request->has('price') && in_array($request->price, ['min', 'max'])) {
            $products = $builder->get();
            $count = $products->count();
            if ($count > 1) {
                $max = $builder->get()->max('price'); // цена самого дорогого товара
                $min = $builder->get()->min('price'); // цена самого дешевого товара
                $avg = ($min + $max) * 0.5;
                if ($request->price == 'min') {
                    $builder->where('price', '<=', $avg);
                } else {
                    $builder->where('price', '>=', $avg);
                }
            }
        }
        // отбираем только новинки
        if ($request->has('new')) {
            $builder->where('new', true);
        }
        // отбираем только лидеров продаж
        if ($request->has('hit')) {
            $builder->where('hit', true);
        }
        // отбираем только со скидкой
        if ($request->has('sale')) {
            $builder->where('sale', true);
        }

        $products = $builder->paginate(6)->withQueryString();

        return view('catalog.category', compact('category', 'products'));
    }

    public function brand($slug) {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = $brand->products()->paginate(6);
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('catalog.product', compact('product'));
    }


}
