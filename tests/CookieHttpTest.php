
<?php

declare(strict_types=1);

namespace Ryanxedi\CookieHttp\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Http;
use Ryanxedi\CookieHttp\CookieHttpServiceProvider;

class CookieHttpTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [CookieHttpServiceProvider::class];
    }

    public function test_cookie_jar_can_store_and_retrieve_cookie(): void
    {
        Http::cookieStore();
        Http::withCookies()->get('https://httpbin.org/cookies/set?testcookie=value');

        $value = Http::cookieGet('testcookie');

        \$this->assertEquals('value', $value);
    }
}
