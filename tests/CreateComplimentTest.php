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
        $receiverUser = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/compliments', [
                'message' => 'You are awesome!',
                'receiver_user_id' => $receiverUser->id
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

    public function testShouldReturnErrorIfReceiverUserIdIsNotValid()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/compliments', [
                'message' => 'You are awesome!',
                'receiver_user_id' => 'invalid'
            ])
            ->seeStatusCode(422)
            ->seeJson([
                'receiver_user_id' => [
                    'The selected receiver user id is invalid.'
                ]
            ]);
    }

    public function testShouldReturnErrorIfReceiverUserIdIsNotExisting()
    {
        /** @var User $user */
        $user = User::factory()->create();

        User::destroy(10);

        $this->actingAs($user)
            ->post('/api/compliments', [
                'message' => 'You are awesome!',
                'receiver_user_id' => 10
            ])
            ->seeStatusCode(422)
            ->seeJson([
                'receiver_user_id' => [
                    'The selected receiver user id is invalid.'
                ]
            ]);
    }

    public function testShouldReturnErrorIfMessageIsEmpty()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $receiverUser = User::factory()->create();

        $this->actingAs($user)
            ->post('/api/compliments', [
                'message' => '',
                'receiver_user_id' => $receiverUser->id
            ])
            ->seeStatusCode(422)
            ->seeJson([
                'message' => [
                    'The message field is required.'
                ]
            ]);
    }
}
