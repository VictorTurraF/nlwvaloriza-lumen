<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateUserTest extends TestCase
{
    private $createUserRequestBody = [
        'name' => 'John Doe',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldCreateAnUser()
    {
        $this->post('/users', $this->createUserRequestBody);

        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);
    }
}
