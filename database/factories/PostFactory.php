<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categori;
use App\Models\Menu;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{



    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categori_id = Categori::all()->random()->id;
        $t = fake()->sentence(3);

        return [
            'menu_id' =>fake()->numberBetween(7,8),
            'title' => $t,
            'sub_title' => fake()->sentence(3),
            'slug' => Str::slug($t),
            'content' => fake()->paragraphs(3, true),
            'image' => fake()->optional()->imageUrl(640, 480, 'posts'),
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'is_active' => fake()->boolean(90),

            'categori_id' => $categori_id,
            'created_by' => 1,
        ];
    }
}
