<?php

namespace Ryanxedi\CookieHttp;

use GuzzleHttp\Cookie\CookieJar;

class HttpCookieStore
{
    protected static $cookieJar;

    public static function jar(): CookieJar
    {
        return self::$cookieJar ??= new CookieJar();
    }

    public static function flush(): void
    {
        self::$cookieJar = new CookieJar();
    }

    public static function get(string $name): ?string
    {
        return collect(self::jar()->toArray())
            ->firstWhere('Name', $name)['Value'] ?? null;
    }

    public static function index(string $key = 'default'): array
    {
        return collect(self::jar($key)->toArray())
            ->mapWithKeys(fn ($cookie) => [$cookie['Name'] => $cookie['Value']])
            ->all();
    }
    
}