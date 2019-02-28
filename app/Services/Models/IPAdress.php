<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 2019-02-28
 * Time: 00:40
 */

namespace App\Services\Models;


/**
 * Class IPAdress
 * @package App\Services\Models
 */
class IPAdress
{
    /**
     * @var string
     */
    protected $address;

    /**
     * IPAdress constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        $isValid = filter_var($address, FILTER_VALIDATE_IP);
        if (! $isValid) {
            throw new Exception('IP Address is invalid');
        }

        $this->address = $address;
    }

    /**
     * @return string
     */
    public function __toString()
    {
       return $this->address;
    }
}