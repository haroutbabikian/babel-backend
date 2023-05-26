<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categories = ['أخبار', 'رياضة', 'ثقافة', 'اقتصاد', 'فيديو وصور', 'آراء'];

        $category = $this->faker->unique()->randomElement($categories);

        switch ($category) {
            case 'رياضة':
                $image = 'https://cdn.outsideonline.com/wp-content/uploads/2022/01/BiwaAyumi-Miyashita1.jpg';
                break;
            case 'أخبار':
                $image = 'https://cdn.cfr.org/sites/default/files/styles/immersive_image_3_2_desktop_2x/public/image/2020/09/rtr3hsmz.jpg.webp';
                break;
            case 'ثقافة':
                $image = 'https://cdn.britannica.com/51/194651-050-747F0C18/Interior-National-Gallery-of-Art-Washington-DC.jpg';
                break;
            case 'اقتصاد':
                $image = 'https://www.bruegel.org/sites/default/files/styles/og_image/public/wp_images/-For-the-euro-there-is-no-shortcut-to-becoming-a-dominant-currency-1.png?itok=Cis87kLr';
                break;
            case 'فيديو وصور':
                $image = 'https://www.360spin.com/wp-content/uploads/2015/05/Social-Media-Management.jpg';
                break;
            case 'آراء':
                $image = 'https://img.freepik.com/free-vector/opinion-concept-illustration_114360-4723.jpg?w=2000';
                break;
          }

        return [
            'name' => $category,
            'click_count' => $this->faker->numberBetween(1, 100),
            'imageURL' => $image ?? null,
        ];
    }
}
