<?php

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
        Schema::table('products', function (Blueprint $table) {
            $table->string('canonical_url_ru')->nullable();
            $table->string('canonical_url_ua')->nullable();
            $table->string('seo_title_ru')->nullable();
            $table->string('seo_title_ua')->nullable();
            $table->text('keywords_ru')->nullable();
            $table->text('keywords_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_ua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->drop('canonical_url');
            $table->drop('seo_title');
            $table->drop('keywords');
            $table->drop('description');
        });
    }
};
