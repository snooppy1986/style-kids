<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPostWarehouse extends Model
{
    use HasFactory;
    public $fillable = [
        'SiteKey',
        'Description',
        'DescriptionRu',
        'ShortAddress',
        'ShortAddressRu',
        'Phone',
        'TypeOfWarehouse',
        'Ref',
        'Number',
        'CityRef',
        'CityDescription',
        'CityDescriptionRu',
        'SettlementRef',
        'SettlementDescription',
        'SettlementAreaDescription',
        'SettlementRegionsDescription',
        'SettlementTypeDescription',
        'SettlementTypeDescriptionRu',
        'Longitude',
        'Latitude',
        'PostFinance',
        'BicycleParking',
        'PaymentAccess',
        'POSTerminal',
        'InternationalShipping',
        'SelfServiceWorkplacesCount',
        'TotalMaxWeightAllowed',
        'PlaceMaxWeightAllowed',
        'DistrictCode',
        'WarehouseStatus',
        'WarehouseStatusDate',
        'WarehouseIllusha',
        'CategoryOfWarehouse',
        'Direct',
        'RegionCity',
        'WarehouseForAgent',
        'GeneratorEnabled',
        'MaxDeclaredCost',
        'WorkInMobileAwis',
        'DenyToSelect',
        'CanGetMoneyTransfer',
        'HasMirror',
        'HasFittingRoom',
        'OnlyReceivingParcel',
        'PostMachineType',
        'PostalCodeUA',
        'WarehouseIndex',
        'BeaconCode'
    ];
}
