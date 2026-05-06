<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CaesarProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('caesar_products_variants.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found at: {$csvFile}");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header

        $brandId = 'caesar';
        
        // Ensure Brand exists
        Brand::updateOrCreate(
            ['id' => $brandId],
            [
                'name' => 'Caesar',
                'slug' => 'caesar',
                'description' => 'Caesar has been synonymous with high-quality Italian porcelain stoneware for over 30 years.',
            ]
        );

        $rowCount = 0;
        $this->command->info('Starting Caesar products import...');

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) < 6) continue;

            $collectionName = trim($row[3]);
            $section = trim($row[4]);
            $productNameInCsv = trim($row[5]);
            $sku = trim($row[6]);
            $sizeName = trim($row[7]);
            $thickness = trim($row[8]);
            $finish = trim($row[9]);
            $unit = trim($row[10]);
            $pricePl = trim($row[12]);
            $priceNpl = trim($row[13]);

            if (empty($collectionName) || empty($productNameInCsv)) {
                continue;
            }

            $collectionSlug = Str::slug($collectionName);
            $collectionId = "{$brandId}-{$collectionSlug}";
            
            // Determine category priority
            $sectionLower = strtolower($section);
            $finishLower = strtolower($finish);
            
            $rowCategory = 'tiles';
            if (str_contains($finishLower, 'aextra20') || str_contains($thickness, '20 mm')) {
                $rowCategory = 'outdoor-20mm';
            } elseif (str_contains($sizeName, '120x120') || str_contains($sizeName, '120x240') || str_contains($sizeName, '120x278') || str_contains($sizeName, '160x320')) {
                $rowCategory = 'large-slabs';
            } elseif (str_contains($sectionLower, 'accessories') || str_contains($sectionLower, 'decorations') || str_contains($sectionLower, 'mosaics')) {
                $rowCategory = 'decorative-finishing';
            }

            // Collection
            $collection = Collection::find($collectionId);
            if (!$collection) {
                $collection = Collection::create([
                    'id' => $collectionId,
                    'brand_id' => $brandId,
                    'category_id' => $rowCategory,
                    'name' => $collectionName,
                    'slug' => $collectionSlug,
                ]);
            } else {
                $currentCat = $collection->category_id;
                $priority = ['outdoor-20mm' => 4, 'large-slabs' => 3, 'tiles' => 2, 'decorative-finishing' => 1];
                if (($priority[$rowCategory] ?? 0) > ($priority[$currentCat] ?? 0)) {
                    $collection->update(['category_id' => $rowCategory]);
                }
            }

            // Product
            $fullProductName = "{$collectionName} {$productNameInCsv}";
            $productSlug = Str::slug($productNameInCsv);
            $productId = "{$collectionId}-{$productSlug}";

            $product = Product::find($productId);
            if (!$product) {
                $product = Product::create([
                    'id' => $productId,
                    'name' => $fullProductName,
                    'slug' => $productSlug,
                    'collection_id' => $collectionId,
                    'category_id' => $rowCategory,
                    'material' => 'Porcelain',
                    'look' => $collectionName,
                    'color' => $productNameInCsv,
                ]);
            } else {
                $currentCat = $product->category_id;
                $priority = ['outdoor-20mm' => 4, 'large-slabs' => 3, 'tiles' => 2, 'decorative-finishing' => 1];
                if (($priority[$rowCategory] ?? 0) > ($priority[$currentCat] ?? 0)) {
                    $product->update(['category_id' => $rowCategory]);
                }
            }

            // Size
            $sizeId = null;
            if (!empty($sizeName)) {
                $cleanSizeId = Str::slug($sizeName . '-' . $thickness);
                $sizeModel = Size::updateOrCreate(
                    ['id' => $cleanSizeId],
                    [
                        'name' => $sizeName,
                        'thickness' => $thickness,
                    ]
                );
                $sizeId = $sizeModel->id;
            }

            // Variant
            $variantData = [
                'product_id' => $productId,
                'size_id' => $sizeId,
                'sku' => $sku,
                'name' => "{$fullProductName} {$sizeName} {$finish}",
                'size' => $sizeName,
                'finish' => $finish,
                'thickness' => $thickness,
                'price_full_pallet' => is_numeric($pricePl) ? (float)$pricePl : null,
                'price_partial_pallet' => is_numeric($priceNpl) ? (float)$priceNpl : null,
                'is_active' => true,
            ];

            if (!empty($sku)) {
                Variant::updateOrCreate(['sku' => $sku], $variantData);
            } else {
                Variant::updateOrCreate(
                    [
                        'product_id' => $productId,
                        'size' => $sizeName,
                        'finish' => $finish,
                    ],
                    $variantData
                );
            }

            $rowCount++;
            if ($rowCount % 100 == 0) {
                $this->command->info("Processed {$rowCount} rows...");
            }
        }

        fclose($file);
        $this->command->info("Finished! Imported {$rowCount} rows.");
    }
}
