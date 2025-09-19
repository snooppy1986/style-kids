<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductResourceTest extends TestCase
{
    public function test_product_repository(): void
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'stock' => 10,
        ]);

        $this->assertIsArray($product->toArray());    
    }
}
