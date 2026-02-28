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

        // 2. Brands
        if (file_exists(storage_path('app/data/brands.json'))) {
            $brandsJson = json_decode(file_get_contents(storage_path('app/data/brands.json')), true);
            foreach ($brandsJson as $brand) {
                \App\Models\Brand::updateOrCreate(['id' => $brand['id']], $brand);
            }
        }

        // 3. Collections
        if (file_exists(storage_path('app/data/collections.json'))) {
            $collectionsJson = json_decode(file_get_contents(storage_path('app/data/collections.json')), true);
            foreach ($collectionsJson as $coll) {
                \App\Models\Collection::updateOrCreate(['id' => $coll['id']], $coll);
            }
        }

        // 4. Products & Variants
        $productsJson = json_decode(file_get_contents(storage_path('app/data/products.json')), true);
        foreach ($productsJson as $prod) {
            $variants = $prod['variants'] ?? [];
            unset($prod['variants']);

            // Handle legacy category mapping if necessary
            if (isset($prod['category'])) {
                $category = \App\Models\Category::where('name', $prod['category'])->first();
                $prod['category_id'] = $category ? $category->id : $prod['category_id'] ?? null;
                unset($prod['category']);
            }

            $product = \App\Models\Product::updateOrCreate(['id' => $prod['id']], $prod);

            // Seed Variants
            if (!empty($variants)) {
                $product->variants()->delete(); // Clear existing variants for this product
                foreach ($variants as $variant) {
                    $product->variants()->create($variant);
                }
            }
        }

        // 5. Projects
        $projectsJson = json_decode(file_get_contents(storage_path('app/data/projects.json')), true);
        foreach ($projectsJson as $proj) {
            $productsUsed = $proj['products_used'] ?? [];
            unset($proj['products_used']);
            $project = \App\Models\Project::updateOrCreate(['id' => $proj['id']], $proj);
            $project->products()->sync($productsUsed);
        }
    }
}
