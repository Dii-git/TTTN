<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    $factory->define(App\Models\Product::class, function (Faker $faker) {
        return [
            'name' => $name = $faker->sentence,
            'price' => $price = $faker->sentence,
            'description' => $description = $faker->sentence,
            'gallery' => $gallery = $faker->sentence,
            'category_id' => $category_id = $faker->sentence,
            'status' => $status = $faker->sentence,
            // 'slug' => str_slug($name),
            // 'type' => ['Simple', 'Grouped', 'Variable', 'Gift'][rand(0,3)],
            // 'categories' => ['Electronics', 'Books', 'Games', 'Garden'][rand(0,3)],   
        ];
    });
}
