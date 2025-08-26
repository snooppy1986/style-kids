<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CompanyInfo
 *
 * @property int $id
 * @property string|null $company_name
 * @property array|null $phones
 * @property string|null $email
 * @property string|null $address
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo wherePhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'address_ru',
        'address_ua',
        'logo',
        'active'
    ];

    /*protected $casts = [
        'phones' => 'json'
    ];*/

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }



    public function getLogo()
    {
        if(str_starts_with($this->logo, 'http')){
            return $this->logo;
        }

        return asset('storage/'.$this->logo);
    }
}
