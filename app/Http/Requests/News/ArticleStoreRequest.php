<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Abstracts\SeoRequest;
use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class ArticleStoreRequest extends SeoRequest
{
    /**
     * @return array
     * @throws \Okipa\MediaLibraryExt\Exceptions\CollectionNotFound
     */
    public function rules(): array
    {
        $rules = [
            'illustration' => array_merge(
                ['required'],
                app(NewsArticle::class)->getMediaValidationRules('illustrations')
            ),
            'category_ids' => ['required', 'array', Rule::in(NewsCategory::pluck('id'))],
            'published_at' => ['required', 'date_format:Y-m-d H:i'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'slug',
                'max:255',
                UniqueTranslationRule::for('news_articles'),
            ],
            'description' => ['nullable', 'string', 'max:4294967295'],
        ]);

        return array_merge($rules, $localizedRules, parent::rules());
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();
        $this->merge(['active' => (bool) $this->active]);
    }

    public function messages(): array
    {
        return [];
    }
}
