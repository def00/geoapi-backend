<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 2019-02-28
 * Time: 00:50
 */

namespace App\Services\Models;

/**
 * Class HostName
 * @package App\Services\Models
 */
class HostName
{
    /**
     * @var string
     */
    protected $address;

    /**
     * HostName constructor.
     * @param string $hostName
     * @throws \Exception
     */
    public function __construct(string $hostName)
    {
        $isValid = checkdnsrr($hostName , "A");
        if (! $isValid) {
            throw new \Exception('Hostname is invalid');
        }

        $this->address = $hostName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }

}