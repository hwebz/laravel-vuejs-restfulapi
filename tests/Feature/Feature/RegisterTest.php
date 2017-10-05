<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testsRegistersSuccessfully() {
        $payload = [
            'name' => 'John',
            'email' => 'john@test.com',
            'password' => 'dkbndkmvkl',
            'password_confirmation' => 'dkbndkmvkl'
        ];
        $headers = ['Accept', 'application/json'];

        $this->json('post', '/api/register', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'email', 'created_at', 'updated_at', 'api_token'
                ]
            ]);
    }

    public function testsRequiresPasswordEmailAndName() {
        $headers = ['Accept', 'application/json'];

        $this->json('post', '/api/register', [], $headers)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    public function testsRequirePasswordConfirmation() {
        $payload = [
            'name' => 'John',
            'email' => 'john@test.com',
            'password' => 'dkbndkmvkl'
        ];
        $headers = ['Accept', 'application/json'];

        $this->json('POST', '/api/register', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => [
                        "The password confirmation does not match."
                    ]
                ]
            ]);
    }
}
