<?php

namespace Tests\Feature;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login(): void
    {
        $this->withoutMiddleware(ValidateCsrfToken::class);

        \DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'AdminDescription'],
            ['name' => 'Funcionario', 'description' => 'FuncionarioDescription'],
            ['name' => 'Patient', 'description' => 'PatientDescription'],
        ]);

        $mockPassword = "test123";

        $mockUser = User::create([
            'name' => 'TEST',
            'surname' => 'USER',
            'email' => 'test@examplemail.test',
            'password' => Hash::make($mockPassword),
            'role_id' => 2,
        ]);

        $response = $this->postJson('/login', [
            'email' => $mockUser->email,
            'password' => $mockPassword
        ]);

        $response->assertStatus(200);

        $this->assertAuthenticatedAs($mockUser);
    }
}
