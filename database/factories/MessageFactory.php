<?php

namespace Database\Factories;

use App\Models\{User, Message, Category, Day};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'message' => $this->faker->paragraph,
            'to_moderator' => rand(0, 1),
            'to_speaker' => rand(0, 1),
            'moderator_readed' => rand(0, 1),
            'speaker_readed' => rand(0, 1),
            'category_id' => rand(1, 6),
            'day_id' => rand(1, 5),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
