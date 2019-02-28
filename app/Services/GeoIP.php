<?php declare(strict_types=1);

namespace App\Services;


use App\Exceptions\CurlError;
use App\Services\Models\IPAdress;

/**
 * Class GeoIP
 * @package App\Services
 */
class GeoIP
{
    /***
     * @param IPAdress $ip
     * @return array
     * @throws CurlError
     */
    public function check(IPAdress $ip): array
    {
        $access_key = config('geolocation.API_KEY');

        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        // if no response, then throw an error
        if ($json === false) {
            throw new CurlError();
        }

        return json_decode($json, true);
    }

}