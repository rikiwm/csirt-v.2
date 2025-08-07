<?php

namespace Database\Factories;

use App\Models\Categori;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        $categori = Categori::all();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->text(),
            'type_id' => 1,
            'categori_id' => $categori->random()->id,
            'created_by' => 1,
        ];
    }
}
