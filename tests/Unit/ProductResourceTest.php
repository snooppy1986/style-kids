<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductResourceTest extends TestCase
{
    protected ProductRepository $repository;
    public function setUp(): void
    {
        spl_autoload_call('App\Models\Product');
        parent::setUp();

        $productModel = $this->createMock(ProductRepository::class);

        $productModel->expects($this->once())
            ->method('getNewProducts')->with(new Product())           
            /* ->willReturn(new Collection([1,2,3,4,5,6])) */;
        dd($productModel->getNewProducts()->count());
        /* $product = Mockery::mock('App\Models\Product');

        $product->shouldReceive('whereHas->with->where->limit->get')
        ->once()
        ->andReturn(new Collection([1,2,3,4,5,6])); */

        /* $product->shouldReceive('whereHas')->andReturnSelf();
        $product->shouldReceive('with')->andReturnSelf();
        $product->shouldReceive('where')->andReturnSelf();
        $product->shouldReceive('limit')->andReturnSelf();
        $product->shouldReceive('get')->andReturn($this->createMock(Collection::class)); */
        //$this->app->instance(Product::class, $product);
        $this->repository = new ProductRepository($product);
    }   
    /**
     * A basic unit test example.
     */
    public function test_product_repository(): void
    {
        dd($this->repository->getNewProducts()->count());
        $newProduct = $this->repository->getNewProducts();
        $this->assertEquals(6, $newProduct->count());
    }
}
