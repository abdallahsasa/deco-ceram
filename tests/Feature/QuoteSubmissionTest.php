<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_quote_request_with_meters_and_variant(): void
    {
        // Set up mock brand, category, collection, product
        $brand = Brand::create([
            'id' => 'caesar',
            'name' => 'Caesar',
            'slug' => 'caesar',
        ]);
        
        $category = Category::create([
            'id' => 'tiles',
            'name' => 'Tiles',
            'slug' => 'tiles',
        ]);

        $collection = Collection::create([
            'id' => 'caesar-anima',
            'brand_id' => 'caesar',
            'category_id' => 'tiles',
            'name' => 'Anima',
            'slug' => 'anima',
        ]);

        $product = Product::create([
            'id' => 'caesar-anima-statuario',
            'name' => 'Anima Statuario',
            'slug' => 'statuario',
            'collection_id' => 'caesar-anima',
            'category_id' => 'tiles',
        ]);

        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'company' => 'Decor Corp',
            'message' => 'Need quick delivery.',
            'items' => [
                [
                    'product_id' => $product->id,
                    'variant_name' => '60x120 cm (Matt)',
                    'meters' => 12.50,
                    'quantity' => 18,
                    'boxes' => 5,
                    'pcs' => 18,
                    'pcs_per_box' => 4,
                    'sqm_per_box' => 2.50,
                ]
            ]
        ];

        $response = $this->postJson('/en/quote', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('quote_request_items', [
            'product_id' => $product->id,
            'variant_name' => '60x120 cm (Matt)',
            'meters' => 12.50,
            'quantity' => 18,
            'boxes' => 5,
            'pcs' => 18,
            'pcs_per_box' => 4,
            'sqm_per_box' => 2.50,
        ]);
    }
}
