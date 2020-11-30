<?php

namespace Tests\Feature\Api\Auth;

use Hash;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class RefreshControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $mock = new MockHandler([new Response(200, [])]);
        $handler = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);

		$this->user = User::factory()->times(1)->create();
    }

    public function testRefreshToken()
    {
        $response = $this->client->post(route('api.auth.refresh'), [
            'query' => [
                'token' => 'mytoken',
            ]
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testRefreshWithError()
    {
        $response = $this->get(route('api.auth.refresh'), [], [
            'Authorization' => 'Bearer Wrong'
        ]);

        $response->assertStatus(500);
    }
}
