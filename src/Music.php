<?php

namespace Music;

class Music
{
    public static $providers = [
        'zing',
    ];

    public function __construct($provider, $url = null)
    {
        static::getAPI($provider, $url);
    }

    public static function getAPI($provider, $url = null)
    {
        switch ($provider) {
            case 'zing':
                return new ZingMp3($url);
            default:
                throw new ProviderNotFoundException('Provider only [%s] but got %s', implode(',', static::$providers), $provider);
        }
    }
}