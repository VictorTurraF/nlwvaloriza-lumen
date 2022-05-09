<?php

use App\Models\Tag;
use App\Models\User;

class CreateTagsTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

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

        $requestBody = $this->generateTagRequestBody();

        $this->actingAs($this->user)
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

        $requestBody = $this->generateTagRequestBody();
        $requestBody['name'] = '';

        $this->actingAs($this->user)
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
        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
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

    public function testShouldReturnErrorWhenTagColorIsNotProvided() {


        $requestBody = $this->generateTagRequestBody();
        $requestBody['color'] = '';

        $this->actingAs($this->user)
            ->post('/api/tags', $requestBody)
            ->seeStatusCode(422)
            ->seeJson([
                'color' => [
                    'The color field is required.'
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
