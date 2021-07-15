<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

// Todo: update this seeder if your app is not multilingual.

class NewsCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        NewsCategory::factory()->create(['title' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        NewsCategory::factory()->create(['title' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        NewsCategory::factory()->create(['title' => ['fr' => 'Site internet', 'en' => 'Website']]);
        NewsCategory::factory()->create(['title' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
        NewsCategory::factory()->count(6)->create();
    }
}
