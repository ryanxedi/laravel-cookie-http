<?php declare(strict_types=1);

namespace Ryanxedi\CookieHttp\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Http;
use Ryanxedi\CookieHttp\CookieHttpServiceProvider;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ryanxedi\CookieHttp\HttpCookieStore;

class CookieHttpTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [CookieHttpServiceProvider::class];
    }

    public function test_cookie_jar_can_store_and_retrieve_cookie(): void
    {
        Http::cookieStore();
        $request = new Request('GET', 'https://example.com');
        $response = new Response(200, ['Set-Cookie' => 'testcookie=value; Path=/; Domain=example.com']);
        HttpCookieStore::jar()->extractCookies($request, $response);
        $this->assertEquals('value', Http::cookieGet('testcookie'));
    }
}
