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
        Schema::create('new_post_cities', function (Blueprint $table) {
            $table->id();
            $table->string("Description")->nullable();
            $table->string("DescriptionRu")->nullable();
            $table->string("Ref")->nullable();
            $table->string("Delivery1")->nullable();
            $table->string("Delivery2")->nullable();
            $table->string("Delivery3")->nullable();
            $table->string("Delivery4")->nullable();
            $table->string("Delivery5")->nullable();
            $table->string("Delivery6")->nullable();
            $table->string("Delivery7")->nullable();
            $table->string("Area")->nullable();
            $table->string("SettlementType")->nullable();
            $table->string("IsBranch")->nullable();
            $table->string("PreventEntryNewStreetsUser")->nullable();
            $table->string("CityID" )->nullable();
            $table->string("SettlementTypeDescription")->nullable();
            $table->string("SettlementTypeDescriptionRu")->nullable();
            $table->string("SpecialCashCheck")->nullable();
            $table->string("AreaDescriptionRu")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_post_cities');
    }
};
