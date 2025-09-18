<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductResourceTest extends TestCase
{
    protected $model;
    public function __construct(Product $product)  
    {
        $this->model = $product;
    }
    /**
     * A basic unit test example.
     */
    public function test_product_repository(): void
    {
        dd($this->model->get());       
    }
}
