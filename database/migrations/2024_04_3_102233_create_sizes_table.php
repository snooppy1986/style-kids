<?php

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Sku;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->timestamps();
        });

       /* Schema::create('size_sku', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Size::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Sku::class)
                ->constrained()
                ->cascadeOnDelete();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('product_size');
    }
};
