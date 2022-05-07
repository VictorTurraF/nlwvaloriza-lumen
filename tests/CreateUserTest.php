<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldCreateAnUser()
    {
        $requestBody = $this->generateUserRequestBody();

        $this->post('/users', $requestBody);

        $this->seeStatusCode(201);
        $this->seeJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);
    }

    public function testShouldReturnErrorWhenPasswordConfirmationIsNotEqualToPassword()
    {
        $requestBody = $this->generateUserRequestBody();
        $requestBody['password_confirmation'] = 'wrong_password';

        $this->post('/users', $requestBody);

        $this->seeStatusCode(422);
        $this->seeJson([
            'password' => [
                'The password confirmation does not match.'
            ]
        ]);
    }

    public function testShouldRequireEmail() {
        $requestBody = $this->generateUserRequestBody();
        $requestBody['email'] = '';

        $this->post('/users', $requestBody);

        $this->seeStatusCode(422);
        $this->seeJson([
            'email' => [
                'The email field is required.'
            ]
        ]);
    }

    public function testShouldRequireName() {
        $requestBody = $this->generateUserRequestBody();
        $requestBody['name'] = '';

        $this->post('/users', $requestBody);

        $this->seeStatusCode(422);
        $this->seeJson([
            'name' => [
                'The name field is required.'
            ]
        ]);
    }


    private function generateUserRequestBody()
    {
        $faker = Faker\Factory::create();

        $password = $faker->password();
        $requestBody = [
            'name' => $faker->name(),
            'email' => $faker->email(),
            'password' => $password,
            'password_confirmation' => $password,
        ];

        return $requestBody;
    }
}
