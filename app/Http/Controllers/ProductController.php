<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($locale)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $featuredCollections = Collection::take(3)->get(); // Example featured

        return view('pages.products.index', compact('brands', 'categories', 'featuredCollections'));
    }

    public function brandShow($locale, $brandSlug)
    {
        $brand = Brand::where('slug', $brandSlug)->with('collections')->firstOrFail();
        return view('pages.products.brand', compact('brand'));
    }

    public function collectionShow($locale, $brandSlug, $collectionSlug)
    {
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();
        $collection = Collection::where('slug', $collectionSlug)
            ->where('brand_id', $brand->id)
            ->with(['products', 'brand'])
            ->firstOrFail();

        // Basic filtering logic
        $products = $collection->products();

        if (request('look')) {
            $products->where('look', request('look'));
        }
        if (request('finish')) {
            $products->where('finish', request('finish'));
        }
        if (request('size')) {
            $products->where('size', request('size'));
        }

        $products = $products->paginate(12);

        // Get filter options from products in this collection
        $looks = $collection->products()->distinct()->pluck('look')->filter()->values();
        $finishes = $collection->products()->distinct()->pluck('finish')->filter()->values();
        $sizes = $collection->products()->distinct()->pluck('size')->filter()->values();

        return view('pages.products.collection', compact('brand', 'collection', 'products', 'looks', 'finishes', 'sizes'));
    }

    public function productShow($locale, $brandSlug, $collectionSlug, $productSlug)
    {
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();
        $collection = Collection::where('slug', $collectionSlug)->where('brand_id', $brand->id)->firstOrFail();
        $product = Product::where('slug', $productSlug)
            ->where('collection_id', $collection->id)
            ->with(['collection.brand', 'variants'])
            ->firstOrFail();

        return view('pages.products.show', compact('brand', 'collection', 'product'));
    }
}
