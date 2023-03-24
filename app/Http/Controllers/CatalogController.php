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

    public function category($slug) {
        $category = Category::where('slug', $slug)->firstOrFail();
        // получаем всех потомков этой категории
        $descendants = $category->getAllChildren($category->id);
        $descendants[] = $category->id;
        $products = Product::whereIn('category_id', $descendants)->paginate(6);
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
