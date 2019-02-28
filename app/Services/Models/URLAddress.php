<?php
namespace App\Services\Models;


use \Exception;

/***
 * Class URLAddress
 * @description Simple model to validate if URL is valid to comply DDD rules
 * @package App\Services\Models
 */
class URLAddress
{
    /**
     * @var string
     */
    protected $address;

    /***
     * URLAddress constructor.
     * @param string $url
     * @throws \Exception
     */
    public function __construct(string $url)
    {
        $isValid = filter_var($url, FILTER_VALIDATE_URL);
        if (! $isValid) {
            throw new Exception('URL is not valid');
        }

        $this->address = $url;
    }

    /***
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }

}