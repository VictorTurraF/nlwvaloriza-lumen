<?php

use App\Models\Tag;
use App\Models\User;

class ListTagsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequireUsersAuthentication()
    {
        $this->get(route('tags.index'))
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
            ->get(route('tags.index'))
            ->seeStatusCode(200)
            ->seeJson($tag->toArray());
    }
}
