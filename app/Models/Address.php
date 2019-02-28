<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/***
 * Class Address
 * @property int $user_id
 * @property string $ip
 * @property string $type
 * @property string $continent_code
 * @property string $continent_name
 * @property string $country_code
 * @property string $country_name
 * @property string $region_code
 * @property string $city
 * @property string $zip
 * @property float $latitude
 * @property float $longitude
 * @property User $user
 * @package App\Models
 */
class Address extends Model
{
    protected $fillable = [
        'ip',
        'type',
        'continent_code',
        'continent_name',
        'country_code',
        'country_name',
        'region_code',
        'city',
        'zip',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
