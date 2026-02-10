<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class DataService
{
    public function getProducts()
    {
        return $this->loadJson('products.json');
    }

    public function getProjects()
    {
        return $this->loadJson('projects.json');
    }

    public function getCategories()
    {
        return $this->loadJson('categories.json');
    }

    public function getProductById($id)
    {
        return collect($this->getProducts())->firstWhere('id', $id);
    }

    public function getProjectById($id)
    {
        return collect($this->getProjects())->firstWhere('id', $id);
    }

    public function getFeaturedProducts($limit = 6)
    {
        return collect($this->getProducts())->where('featured', true)->take($limit);
    }

    public function getFeaturedProjects($limit = 3)
    {
        return collect($this->getProjects())->where('featured', true)->take($limit);
    }

    private function loadJson($filename)
    {
        $path = storage_path("app/data/{$filename}");
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }
}
