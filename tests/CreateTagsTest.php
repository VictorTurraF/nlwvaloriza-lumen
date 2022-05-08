<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateTagsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequireUserAuthentication()
    {
        $this->json('POST', '/api/tags')
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldCreatesNewTag()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $requestBody = $this->generateTagRequestBody();

        $this->actingAs($user)
            ->post('/api/tags', $requestBody)
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'id',
                'name',
                'color',
                'hashtag',
                'created_at',
                'updated_at'
            ])
            ->seeJson($requestBody);
    }

    private function generateTagRequestBody()
    {
        $faker = Faker\Factory::create();

        return [
            'name' => $faker->slug(2),
            'color' => $faker->hexColor()
        ];
    }
}
