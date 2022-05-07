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
            'password' => 'secret',
        ]);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'token',
            'user'
        ]);
    }
}
