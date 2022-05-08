<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateComplimentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequiresAuthentication()
    {
        $this->post('/api/compliments')
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldCreateACompliment()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/compliments', [
                'message' => 'You are awesome!',
                'receiver_user_id' => 1
            ])
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'id',
                'message',
                'receiver_user_id',
                'created_at',
                'updated_at',
            ]);
    }
}
