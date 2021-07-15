<?php

namespace Database\Factories\News;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsCategoryFactory extends Factory
{
    /** @var string */
    protected $model = NewsCategory::class;

    public function definition(): array
    {
        return [
            'title' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }
}
