<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 13/09/2018
 * Time: 12:31
 */

namespace App\Model;


class Token
{
    private $ip;
    private $userAgent;
    private $key;

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function __toString()
    {
        return $this->key;
    }

}