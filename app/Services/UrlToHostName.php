<?php declare(strict_types=1);

namespace App\Services;


use App\Services\Models\URLAddress;

/**
 * Class UrlToHostName
 * @package App\Services
 */
class UrlToHostName
{
    /**
     * @var mixed
     */
    protected $address;

    /**
     * UrlToHostName constructor.
     * @param URLAddress $url
     */
    public function __construct(URLAddress $url)
    {
        $hostName = parse_url((string) $url, PHP_URL_HOST);
        $this->address = $hostName;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->address;
    }

}