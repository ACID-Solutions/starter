<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Abstracts\SeoRequest;
use App\Models\News\NewsArticle;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends SeoRequest
{
    public function rules(): array
    {
        $rules = [
            'illustration' => app(NewsArticle::class)->getMediaValidationRules('illustration'),
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', Rule::exists(NewsArticle::class, 'id')],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for('news_articles')->ignore($this->article->id),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge([
            'published_at' => $this->published_at ? rescue(
                fn() => Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString(),
                'XXX',
                false
            ) : null,
            'active' => (bool) $this->active,
        ]);
    }
}
