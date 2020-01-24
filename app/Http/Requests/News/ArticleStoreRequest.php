<?php

namespace App\Http\Requests\News;

use App\Http\Requests\Request;
use App\Models\News\NewsArticle;
use App\Services\Seo\SeoService;
use Carbon\Carbon;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class ArticleStoreRequest extends Request
{
    protected $exceptFromSanitize = ['url'];

    protected $safetyChecks = ['active' => 'boolean', 'category_ids' => 'array'];

    /**
     * Execute a pre-validation treatment.
     *
     * @return void
     */
    public function before()
    {
        $this->merge([
            'published_at' => $this->published_at ? rescue(
                fn() => Carbon::createFromFormat('d/m/Y H:i', $this->published_at)->toDateTimeString(),
                'XXX',
                false
            ) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'illustration' => array_merge(['required'], (new NewsArticle)->validationConstraints('illustration')),
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:news_categories,id'],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'active' => ['required', 'boolean'],
        ];
        $localizedRules = localizeRules([
            'title' => ['required', 'string', 'max:255'],
            'url' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('news_articles'),
            ],
            'description' => ['string', 'max:4294967295'],
        ]);
        $seoMetaRules = (new SeoService)->getSeoMetaRules();

        return array_merge($rules, $localizedRules, $seoMetaRules);
    }
}
