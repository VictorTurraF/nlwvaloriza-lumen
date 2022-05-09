<?php

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CreateComplimentTest extends TestCase
{
    private User $user;
    private User $receiverUser;
    private Collection $tags;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->receiverUser = User::factory()->create();
        $this->tags = Tag::factory()->count(2)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequiresAuthentication()
    {
        $this->post(route('compliments.create'))
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldCreateACompliment()
    {

        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
                'message' => 'You are awesome!',
                'receiver_user_id' => $this->receiverUser->id
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

        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
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
        User::destroy(10);

        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
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
        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
                'message' => '',
                'receiver_user_id' => $this->receiverUser->id
            ])
            ->seeStatusCode(422)
            ->seeJson([
                'message' => [
                    'The message field is required.'
                ]
            ]);
    }

    public function testShouldNotCreateIsSenderAndReceiverAreTheSame()
    {

        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
                'message' => 'You are awesome!',
                'receiver_user_id' => $this->user->id
            ])
            ->seeStatusCode(400)
            ->seeJson([
                'message' => 'You cannot send a compliment to yourself.'
            ]);
    }

    public function testShouldCanAttachManyTagsToACompliment()
    {
        $tagIds = $this->tags->pluck('id')->toArray();

        $this->actingAs($this->user)
            ->post(route('compliments.create'), [
                'message' => 'You are awesome!',
                'receiver_user_id' => $this->receiverUser->id,
                'tags' => $tagIds
            ])
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'tags' => [
                    [
                        'name',
                        'hashtag',
                    ]
                ],
            ]);
    }
}
