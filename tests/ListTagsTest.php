<?php

use App\Models\Tag;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ListTagsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequireUsersAuthentication()
    {
        $this->json('GET', '/api/tags')
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldReturnTagsList()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $this->actingAs($user)
            ->get('/api/tags')
            ->seeStatusCode(200)
            ->seeJson($tag->toArray());
    }
}
