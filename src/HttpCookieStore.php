
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
}
