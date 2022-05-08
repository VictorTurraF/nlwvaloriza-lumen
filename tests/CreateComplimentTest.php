<?php

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
}
