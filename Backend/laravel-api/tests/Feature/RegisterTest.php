<?php

namespace Tests\Feature;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FakeDBRoleSeeder;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register(): void
    {
        $this->withoutMiddleware(ValidateCsrfToken::class);

        $fakeDB = new FakeDBRoleSeeder();
        $fakeDB->RoleSeeder();

        $response = $this->postJson('/register', [
            'name' => 'TEST',
            'surname' => 'USER',
            'email' => 'test@mail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);
    }
}
