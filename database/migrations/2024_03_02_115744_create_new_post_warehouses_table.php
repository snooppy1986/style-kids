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
        Schema::create('new_post_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('SiteKey')->nullable();
            $table->string('Description')->nullable();
            $table->string('DescriptionRu')->nullable();
            $table->string('ShortAddress')->nullable();
            $table->string('ShortAddressRu')->nullable();
            $table->string('Phone')->nullable();
            $table->string('TypeOfWarehouse')->nullable();
            $table->string('Ref')->nullable();
            $table->string('Number')->nullable();
            $table->string('CityRef')->nullable();
            $table->string('CityDescription')->nullable();
            $table->string('CityDescriptionRu')->nullable();
            $table->string('SettlementRef')->nullable();
            $table->string('SettlementDescription')->nullable();
            $table->string('SettlementAreaDescription')->nullable();
            $table->string('SettlementRegionsDescription')->nullable();
            $table->string('SettlementTypeDescription')->nullable();
            $table->string('SettlementTypeDescriptionRu')->nullable();
            $table->string('Longitude')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('PostFinance')->nullable();
            $table->string('BicycleParking')->nullable();
            $table->string('PaymentAccess')->nullable();
            $table->string('POSTerminal')->nullable();
            $table->string('InternationalShipping')->nullable();
            $table->string('SelfServiceWorkplacesCount')->nullable();
            $table->string('TotalMaxWeightAllowed')->nullable();
            $table->string('PlaceMaxWeightAllowed')->nullable();
            $table->string('DistrictCode')->nullable();
            $table->string('WarehouseStatus')->nullable();
            $table->string('WarehouseStatusDate')->nullable();
            $table->string('WarehouseIllusha')->nullable();
            $table->string('CategoryOfWarehouse')->nullable();
            $table->string('Direct')->nullable();
            $table->string('RegionCity')->nullable();
            $table->string('WarehouseForAgent')->nullable();
            $table->string('GeneratorEnabled')->nullable();
            $table->string('MaxDeclaredCost')->nullable();
            $table->string('WorkInMobileAwis')->nullable();
            $table->string('DenyToSelect')->nullable();
            $table->string('CanGetMoneyTransfer')->nullable();
            $table->string('HasMirror')->nullable();
            $table->string('HasFittingRoom')->nullable();
            $table->string('OnlyReceivingParcel')->nullable();
            $table->string('PostMachineType')->nullable();
            $table->string('PostalCodeUA')->nullable();
            $table->string('WarehouseIndex')->nullable();
            $table->string('BeaconCode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_post_warehouses');
    }
};
