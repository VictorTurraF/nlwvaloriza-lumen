<?php

use App\Models\Tag;
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

    public function testShouldReturnErrorWhenTagNameIsNotProvided()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $requestBody = $this->generateTagRequestBody();
        $requestBody['name'] = '';

        $this->actingAs($user)
            ->post('/api/tags', $requestBody)
            ->seeStatusCode(422)
            ->seeJson([
                'name' => [
                    'The name field is required.'
                ]
            ]);
    }

    public function testShouldReturnErrorWhenTagNameIsNotUnique()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $this->actingAs($user)
            ->post('/api/tags', [
                'name' => $tag->name,
                'color' => $tag->color
            ])
            ->seeStatusCode(422)
            ->seeJson([
                'name' => [
                    'The name has already been taken.'
                ]
            ]);
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
