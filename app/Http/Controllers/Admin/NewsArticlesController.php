<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsArticlesIndexRequest;
use App\Http\Requests\News\NewsArticleStoreRequest;
use App\Http\Requests\News\NewsArticleUpdateRequest;
use App\Models\News\NewsArticle;
use App\Tables\NewsArticlesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewsArticlesController extends Controller
{
    /**
     * @param \App\Http\Requests\News\NewsArticlesIndexRequest $request
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(NewsArticlesIndexRequest $request): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));
        $table = app(NewsArticlesTable::class, compact('request'))->setup();

        return view('templates.admin.news.articles.index', compact('request', 'table'));
    }

    public function create(): View
    {
        $article = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('News'),
            'entity' => __('Articles'),
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param \App\Http\Requests\News\NewsArticleStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(NewsArticleStoreRequest $request): RedirectResponse
    {
        /** @var \App\Models\News\NewsArticle $article */
        $article = NewsArticle::create($request->validated());
        $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        $article->categories()->sync($request->category_ids);
        $article->saveSeoMetaFromRequest($request);

        return redirect()->route('news.articles.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('News'),
                'entity' => __('Articles'),
                'name' => $article->title,
            ]));
    }

    public function edit(NewsArticle $article): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'detail' => $article->title,
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param \App\Models\News\NewsArticle $article
     * @param \App\Http\Requests\News\NewsArticleUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(NewsArticleUpdateRequest $request, NewsArticle $article): RedirectResponse
    {
        $article->update($request->validated());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        $article->saveSeoMetaFromRequest($request);

        return redirect()->route('news.article.edit', $article)
            ->with('toast_success', __('crud.parent.updated', [
                'parent' => __('News'),
                'entity' => __('Articles'),
                'name' => $article->title,
            ]));
    }

    /**
     * @param \App\Models\News\NewsArticle $article
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsArticle $article): RedirectResponse
    {
        $article->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Articles'),
            'name' => $article->title,
        ]));
    }
}
