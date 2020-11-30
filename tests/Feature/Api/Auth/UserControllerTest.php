<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class UserControllerTest extends TestCase
{
	use WithoutMiddleware, DatabaseMigrations;

	protected function setUp(): void
	{
		parent::setUp();

        $mock = new MockHandler([new Response(200, [])]);
        $handler = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);
	}

    public function testUserLogged()
    {
        $response = $this->client->post(route('api.auth.user'), [
            'query' => [
                'token' => 'mytoken',
            ]
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
}
