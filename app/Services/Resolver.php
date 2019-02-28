<?php declare(strict_types=1);


namespace App\Services;


use App\Services\Models\HostName;

/**
 * Class Resolver
 * @package App\Services
 */
class Resolver
{
    /**
     * @var HostName
     */
    protected $hostName;

    /**
     * Resolver constructor.
     * @param HostName $hostName
     */
    public function __construct(HostName $hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * @return string
     */
    public function resolve()
    {
        return gethostbyname((string) $this->hostName);
    }

}