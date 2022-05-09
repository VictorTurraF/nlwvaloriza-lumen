<?php

use App\Models\Compliment;
use App\Models\User;

class ListAllSentComplimentsTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testShouldRequiresAuthentication()
    {
        $this->get(route('compliments.sent'))
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldReturnAllSentCompliments()
    {
        $compliment = Compliment::factory()->create([
            'sender_user_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)
            ->get(route('compliments.sent'))
            ->seeStatusCode(200)
            ->seeJson($compliment->toArray());
    }
}
