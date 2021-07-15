<?php

namespace Database\Factories\News;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsArticleFactory extends Factory
{
    /** @var string */
    protected $model = NewsArticle::class;

    protected string $markdownText = <<<EOT
**Bold text.**

*Italic text.*

# Title 1
## Title 2
### Title 3
#### Title 4
##### Title 5
###### Title 6

> Quote.

Unordered list :
* Item 1.
* Item 2.

Ordered list :
1. Item 1.
2. Item 2.

[Link](http://www.google.com).
EOT;

    public function definition(): array
    {
        return [
            'slug' => null,
            'title' => ['fr' => $this->faker->catchPhrase, 'en' => $this->faker->catchPhrase],
            'description' => ['fr' => $this->markdownText, 'en' => $this->markdownText],
            'active' => true,
            'published_at' => Carbon::now(),
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (NewsArticle $page) {
            $page->slug = $page->slug
                ?: [
                    'fr' => Str::slug($page->getTranslation('title', 'fr')),
                    'en' => Str::slug($page->getTranslation('title', 'en')),
                ];
        })->afterCreating(function (NewsArticle $newsArticle) {
            $newsArticle->saveSeoMeta([
                'meta_title' => [
                    'fr' => $newsArticle->getTranslation('title', 'fr'),
                    'en' => $newsArticle->getTranslation('title', 'en'),
                ],
                'meta_description' => [
                    'fr' => $this->faker->text(150),
                    'en' => $this->faker->text(150),
                ],
            ]);
        });
    }

    public function withCategory(): self
    {
        return $this->afterCreating(function (NewsArticle $newsArticle) {
            $categoryId = NewsCategory::get()->random(1)->pluck('id');
            $newsArticle->categories()->sync($categoryId);
        });
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (NewsArticle $newsArticle) {
            $illustrationsCount = random_int(1, 3);
            for ($ii = 1; $ii <= $illustrationsCount; $ii++) {
                $newsArticle->addMedia($this->faker->image(null, 1140, 500))
                    ->toMediaCollection('illustrations');
            }
        });
    }
}
