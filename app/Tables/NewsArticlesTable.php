<?php

namespace App\Tables;

use App\Http\Requests\News\NewsArticlesIndexRequest;
use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use App\View\Components\Admin\Media\Thumb;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class NewsArticlesTable extends AbstractTable
{
    public function __construct(protected NewsArticlesIndexRequest $request)
    {
        //
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(NewsArticle::class)
            ->routes([
                'index' => ['name' => 'news.articles.index'],
                'create' => ['name' => 'news.article.create'],
                'edit' => ['name' => 'news.article.edit'],
                'destroy' => ['name' => 'news.article.destroy'],
            ])
            ->query(function (Builder $query) {
                $query->with(['media', 'categories']);
                if ($this->request->has('category_id')) {
                    $query->whereHas(
                        'categories',
                        fn(Builder $categories) => $categories->where('id', $this->request->category_id)
                    );
                }
            })
            ->destroyConfirmationHtmlAttributes(function (NewsArticle $article) {
                return [
                    'data-confirm' => __('crud.parent.destroy_confirm', [
                        'parent' => __('News'),
                        'entity' => __('Articles'),
                        'name' => $article->title,
                    ]),
                ];
            });
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable();
        $table->column('thumb')->html(fn(NewsArticle $article) => app(Thumb::class)->render()->with([
            'media' => $article->getFirstMedia('illustrations'),
        ]));
        $table->column('title')->stringLimit(25)->sortable()->searchable();
        $table->column()
            ->title(__('Categories'))
            ->value(fn(NewsArticle $article) => $article->categories->map(function (NewsCategory $category) {
                $category->title = Str::limit($category->title, 25);

                return $category;
            })->implode('title', ', '));
        $table->column()->title(__('Display'))->html(fn(NewsArticle $article) => view(
            'components.admin.table.display',
            ['url' => route('news.article.show', [$article]), 'active' => $article->active]
        ));
        $table->column('active')
            ->sortable()
            ->html(fn(NewsArticle $article) => view('components.admin.table.bool', ['bool' => $article->active]));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('published_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
