<?php

namespace Database\Factories\Pages;

use App\Models\Pages\Page;
use Database\Factories\Traits\HasBricks;
use Database\Factories\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    use HasSeoMeta;
    use HasBricks;

    /** @var string */
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'nav_title' => ['fr' => $this->faker->unique()->catchPhrase, 'en' => $this->faker->unique()->catchPhrase],
            'active' => true,
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (Page $page) {
            $page->unique_key = $page->unique_key
                ?: Str::snake(Str::slug($page->getTranslation('nav_title', 'en'), '_'));
            $page->slug = $page->slug
                ?: [
                    'fr' => Str::slug($page->getTranslation('nav_title', 'fr')),
                    'en' => Str::slug($page->getTranslation('nav_title', 'en')),
                ];
        });
    }
}
