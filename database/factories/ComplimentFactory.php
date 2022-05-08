<?php

namespace Database\Factories;

use App\Models\Compliment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplimentFactory extends Factory
{
    protected $model = Compliment::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence,
            'receiver_user_id' => User::factory(),
            'sender_user_id' => User::factory(),
        ];
    }
}
