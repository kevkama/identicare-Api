<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user"=>User::all()->random()->id,
            "content"=> fake()-> sentence(),
            "image"=> "https://images.pexels.com/photos/8428396/pexels-photo-8428396.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        ];
    }
}
