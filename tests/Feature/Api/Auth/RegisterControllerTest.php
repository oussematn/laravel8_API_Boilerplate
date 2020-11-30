<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterControllerTest extends TestCase
{
	use WithoutMiddleware, RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();
	}

	public function testRegistrationUser()
	{
		$data = [
			'name'  => 'tony',
			'email' => 'tony_admin@laravel.it',
			'password' => 'secret123'
		];

		$response = $this->json('POST', route('api.auth.register'), $data)->assertJson([
            'status' => 'success'
        ])->assertStatus(200);
	}
}
