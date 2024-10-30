<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('title_ru', 2048);
            $table->string('title_ua', 2048);
            $table->string('slug_ru', 2048);
            $table->string('slug_ua', 2048);
            $table->string('thumbnail')->nullable();
            $table->longText('body_ru');
            $table->longText('body_ua');
            $table->boolean('active');
            $table->string('type')->default('cloth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
