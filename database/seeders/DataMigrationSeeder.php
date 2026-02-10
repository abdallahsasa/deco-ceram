<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories
        $categoriesJson = json_decode(file_get_contents(storage_path('app/data/categories.json')), true);
        foreach ($categoriesJson as $cat) {
            \App\Models\Category::updateOrCreate(['id' => $cat['id']], $cat);
        }

        // 2. Products
        $productsJson = json_decode(file_get_contents(storage_path('app/data/products.json')), true);
        foreach ($productsJson as $prod) {
            // Map category name to ID if necessary, but JSON seems to have ID or Name?
            // products.json: "category": "Large Slabs"
            // categories.json: "id": "large-slabs", "name": "Large Slabs"
            $category = \App\Models\Category::where('name', $prod['category'])->first();
            $prod['category_id'] = $category ? $category->id : null;
            unset($prod['category']);
            \App\Models\Product::updateOrCreate(['id' => $prod['id']], $prod);
        }

        // 3. Projects
        $projectsJson = json_decode(file_get_contents(storage_path('app/data/projects.json')), true);
        foreach ($projectsJson as $proj) {
            $productsUsed = $proj['products_used'] ?? [];
            unset($proj['products_used']);
            $project = \App\Models\Project::updateOrCreate(['id' => $proj['id']], $proj);
            $project->products()->sync($productsUsed);
        }
    }
}
