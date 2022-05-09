<?php

use App\Models\Compliment;
use App\Models\User;

class ListAllReceivedComplimentsTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRequiresAuthentication()
    {
        $this->get('/api/compliments/received')
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldReturnAllReceivedCompliments()
    {
        $compliment = Compliment::factory()->create([
            'receiver_user_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)
            ->get('/api/compliments/received')
            ->seeStatusCode(200)
            ->seeJson($compliment->toArray());
    }
}
