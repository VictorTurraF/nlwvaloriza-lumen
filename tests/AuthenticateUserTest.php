<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthenticateUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldAuthenticateAnUser()
    {
        $user = User::factory()->create();

        $this->post('/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'token',
            'user'
        ]);
    }

    public function testShouldReturnErrorWhenEmailIsNotFound()
    {
        $this->post('/auth/login', [
            'email' => 'any@email.com',
            'password' => 'secret',
        ]);

        $this->seeStatusCode(400);
        $this->seeJson([
            'message' => 'These credentials do not match our records.'
        ]);
    }

    public function testShouldReturnErrorWhenPasswordIsNotCorrect()
    {
        $user = User::factory()->create();

        $this->post('/auth/login', [
            'email' => $user->email,
            'password' => 'wrong_password',
        ]);

        $this->seeStatusCode(400);
        $this->seeJson([
            'message' => 'These credentials do not match our records.'
        ]);
    }
}
