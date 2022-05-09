<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthenticateUserTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldAuthenticateAnUser()
    {

        $this->post('/auth/login', [
            'email' => $this->user->email,
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
        $this->post('/auth/login', [
            'email' => $this->user->email,
            'password' => 'wrong_password',
        ]);

        $this->seeStatusCode(400);
        $this->seeJson([
            'message' => 'These credentials do not match our records.'
        ]);
    }
}
