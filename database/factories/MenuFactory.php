<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = [ 'uil uil-home', 'uil uil-user', 'uil uil-envelope', 'uil uil-phone', 'uil uil-map-marker', 'uil uil-calendar-alt', 'uil uil-clock', 'uil uil-globe', 'uil uil-lock', 'uil uil-star', 'uil uil-camera', 'uil uil-cloud', 'uil uil-shopping-cart', 'uil uil-heart', 'uil uil-bell', 'uil uil-book', 'uil uil-music', 'uil uil-film', 'uil uil-image', 'uil uil-lightbulb', 'uil uil-microphone', 'uil uil-paperclip', 'uil uil-folder', 'uil uil-bar-chart', 'uil uil-chart-pie', 'uil uil-sun', 'uil uil-moon', 'uil uil-search', 'uil uil-trash-alt', 'uil uil-upload' ];
        $icon = fake()->randomElement($icons);
        $url = fake()->randomElement(['home', 'about','service', 'contact', 'blog','Informasi']);
        return [
            'name' => $url,
            'icon' => $icon,
            'slug' => Str::slug($url),
            'order' => fake()->randomNumber(1,10),
            'parent_id' => null,
            'is_active' => 1,
        ];
    }
}

