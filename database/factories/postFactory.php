<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;
    public function definition()
    {
        $user = User::inRandomOrder()
            ->limit(1)
            ->first(['id']);

        return [
            'title'=>$this->faker->title,
            'user_id'=>$user->id,
            'content'=>$this->faker->text,
        ];
    }
}
