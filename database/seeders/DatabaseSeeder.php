<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Filament\Resources\OrderResource;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Color;
use App\Models\Comment;
use App\Models\CompanyInfo;
use App\Models\Customer;
use App\Models\DeliveryCompany;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCharacteristics;
use App\Models\ProductGallery;
use App\Models\Size;
use App\Models\Sku;
use App\Models\Slider;
use App\Models\User;
use Closure;
use Filament\Notifications\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

        // Clear images
        Storage::deleteDirectory('public/images');
        //create directory to image
        Storage::makeDirectory('public/images/products');
        Storage::makeDirectory('public/images/categories');
        Storage::makeDirectory('public/images/sliders');

        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '1111'
        ]));
        $this->command->info('Admin user created.');

        /*$this->command->warn(PHP_EOL . 'Creating shop delivery companies...');
            DeliveryCompany::factory(2)->create();
        $this->command->info('Shop delivery companies created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating shop info...');
            CompanyInfo::factory(1)->create();
        $this->command->info('Shop info created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating product attributes...');
           Attribute::factory()->count(2)->create();
        $this->command->info('Shop product attributes created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating shop product option...');
            $attributeOptions = AttributeOption::factory()->count(10)->create();
        $this->command->info('Shop product option created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating shop categories...');
        $categories = $this->withProgressBar(6, fn () => Category::factory(1)
            ->has(
                $children = Category::factory()->count(3),
                'children'
            )->create());
        $this->command->info('Shop categories created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating shop customers...');
        $customers = $this->withProgressBar(1000, fn () => Customer::factory(1)
            ->has(Address::factory()->count(rand(1, 3)))
            ->create());
        $this->command->info('Shop customers created.');*/

        /*$this->command->warn(PHP_EOL . 'Creating shop products...');
        $products = $this->withProgressBar(50, fn () => Product::factory(1)
            ->hasAttached($categories->random(rand(1, 3)), ['created_at' => now(), 'updated_at' => now()])
            ->has(ProductGallery::factory()->count(rand(1, 4)))
            ->has(ProductCharacteristics::factory(1))
            ->has(
                Comment::factory()->count(rand(2, 7)),
            )
            ->has(Sku::factory()
                ->has(Size::factory()->count(rand(1, 3)))
                ->count(rand(1, 4)))
            ->create());
        $this->command->info('Shop products created.');*/

       /* $this->command->warn(PHP_EOL . 'Creating orders...');
        $orders = $this->withProgressBar(1000, fn () => Order::factory(1)
            ->sequence(fn ($sequence) => ['customer_id' => $customers->random(1)->first()->id])
            ->has(
                OrderProduct::factory()->count(rand(2, 5))
                    ->state(fn (array $attributes, Order $order) => ['product_id' => $products->random(1)->first()->id]),
                'order_products'
            )
            ->create());*/

        /*$this->command->warn(PHP_EOL . 'Creating shop slider option...');
            Slider::factory(6)->create();
        $this->command->info('Shop slider created.');*/
        /*foreach ($orders->random(rand(5, 8)) as $order) {
            Notification::make()
                ->title('New order')
                ->icon('heroicon-o-shopping-bag')
                ->body("{$order->customer->name} ordered {$order->items->count()} products.")
                ->actions([
                    Action::make('View')
                        ->url(OrderResource::getUrl('edit', ['record' => $order])),
                ])
                ->sendToDatabase($user);
        }*/
        /*$this->command->info('Shop orders created.');*/

       /* CompanyInfo::factory(1)->create();
        DeliveryCompany::factory(2)->create();

        $attribute = Attribute::factory(2)
            ->has(AttributeOption::factory(6))
            ->create();
        $attributeOptions = AttributeOption::factory(10)->create();
        Category::factory(14)
            ->has(
                Product::factory(10)
                    ->has(Comment::factory(4))
                    ->has(ProductCharacteristics::factory(1))
                    ->has(ProductGallery::factory(4))
                    ->has(
                        Sku::factory(3)
                            ->hasAttached($attributeOptions)
                    )

            )
            ->create();

        Slider::factory(6)->create();*/
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
