<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class DataService
{
    public function getProducts()
    {
        return \App\Models\Product::with('category')->get();
    }

    public function getProjects()
    {
        return \App\Models\Project::all();
    }

    public function getCategories()
    {
        return \App\Models\Category::all();
    }

    public function getProductById($id)
    {
        return \App\Models\Product::with('category', 'projects')->find($id);
    }

    public function getProjectById($id)
    {
        return \App\Models\Project::with('products')->find($id);
    }

    public function getFeaturedProducts($limit = 6)
    {
        return \App\Models\Product::where('featured', true)->take($limit)->get();
    }

    public function getFeaturedProjects($limit = 3)
    {
        return \App\Models\Project::where('featured', true)->take($limit)->get();
    }

    private function loadJson($filename)
    {
        // No longer needed, but kept as placeholder if required
        return [];
    }
}
