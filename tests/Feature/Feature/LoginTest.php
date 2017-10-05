<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin() {
        $headers = ['Accept', 'application/json'];
        $this->json('POST', 'api/login', [], $headers)
            ->assetStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.']
            ]);
    }

    public function testUserLoginSuccessfully() {
        $user = factory(User::class)->create([
            'email' => 'hadm2@test.com',
            'password' => bcrypt('dkbndkmvkl')
        ]);

        $payload = ['email' => 'hadm2@test.com', 'password' => 'dkbndkmvkl'];
        $headers = ['Accept', 'application/json'];

        $this->json('POST', 'api/login', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'email', 'created_at', 'updated_at', 'api_token'
                ]
            ]);
    }
}
