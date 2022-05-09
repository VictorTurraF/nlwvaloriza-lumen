<?php

use App\Models\Compliment;
use App\Models\User;

class ListAllComplimentsTest extends TestCase
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
    public function testShouldRequireAuthentication()
    {
        $this->get('/api/compliments')
            ->seeStatusCode(401)
            ->seeJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testShouldReturnAllCompliments()
    {
        $compliment = Compliment::factory()->create();

        $this->actingAs($this->user)
            ->get('/api/compliments')
            ->seeStatusCode(200)
            ->seeJson($compliment->toArray());
    }
}
