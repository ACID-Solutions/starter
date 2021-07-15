<?php

namespace App\Models\News;

use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Parsedown;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class NewsArticle extends Model implements HasMedia, Feedable
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;
    use HasSeoMeta;

    public array $translatable = ['slug', 'title', 'description'];

    /** @var string */
    protected $table = 'news_articles';

    /** @var array */
    protected $fillable = ['title', 'slug', 'description', 'active', 'published_at'];

    /** @var array */
    protected $casts = ['active' => 'boolean', 'published_at' => 'datetime'];

    public static function getFeedItems(): Collection
    {
        return app(self::class)->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->with(['media', 'categories'])
            ->get();
    }

    // Todo: to remove if your app is not multilingual.
    public function resolveRouteBinding($value, $field = null): Model|null
    {
        return $this->where($field ? $field . '->' . app()->getLocale() : $this->getRouteKeyName(), $value)->first();
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('illustrations')
            ->singleFile()
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('cover')
                    ->fit(Manipulations::FIT_CROP, 1140, 500)
                    ->withResponsiveImages()
                    ->format('webp');
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 350, 250)
                    ->withResponsiveImages()
                    ->format('webp');
            });
        $this->registerSeoMetaMediaCollection();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(NewsCategory::class, 'news_article_category')->withTimestamps();
    }

    public function getCategoryIdsAttribute(): array
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function toFeedItem(): FeedItem
    {
        $media = $this->getFirstMedia('illustrations');

        return FeedItem::create()
            ->id((string) $this->id)
            ->title($this->getTranslation('title', app()->getLocale()))
            ->summary(Str::limit(strip_tags((new Parsedown())->text($this->description))))
            ->link(route('news.article.show', [$this]))
            ->authorName(config('app.name'))
            ->authorEmail(settings()->email)
            ->category($this->categories->pluck('name'))
            ->enclosure($media?->getUrl())
            ->enclosureType($media?->mime_type)
            ->enclosureLength($media?->size)
            ->updated($this->updated_at);
    }
}
