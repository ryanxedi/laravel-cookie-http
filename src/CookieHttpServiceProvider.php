
<?php

namespace Ryanxedi\CookieHttp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class CookieHttpServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Http::macro('cookieStore', function () {
            HttpCookieStore::flush();
            return Http::withOptions(['cookies' => HttpCookieStore::jar()]);
        });

        Http::macro('withCookies', function () {
            return Http::withOptions(['cookies' => HttpCookieStore::jar()]);
        });

        Http::macro('cookieGet', function (string $name) {
            return HttpCookieStore::get($name);
        });
    }
}
