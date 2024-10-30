<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPostCity extends Model
{
    use HasFactory;
    public $fillable = [
        'Description',
        'DescriptionRu',
        'Ref',
        'Delivery1',
        'Delivery2',
        'Delivery3',
        'Delivery4',
        'Delivery5',
        'Delivery6',
        'Delivery7',
        'Area',
        'SettlementType',
        'IsBranch',
        'PreventEntryNewStreetsUser',
        'CityID',
        'SettlementTypeDescription',
        'SettlementTypeDescriptionRu',
        'SpecialCashCheck',
        'AreaDescriptionRu'
    ];
}
