<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsArticle;
use App\Http\Controllers\Controller;
use App\Services\News\ArticlesService;
use App\Http\Requests\News\ArticleStoreRequest;
use App\Http\Requests\News\ArticleUpdateRequest;
use App\Services\Seo\SeoService;
use Artesaos\SEOTools\Facades\SEOTools;

class NewsArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new ArticlesService)->table();
        SEOTools::setTitle(__('admin.title.parent.index', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
        ]));

        return view('templates.admin.news.articles.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $article = null;
        SEOTools::setTitle(__('admin.title.parent.create', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param \App\Http\Requests\News\ArticleStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(ArticleStoreRequest $request)
    {
        $request->merge(['title' => ucfirst(strtolower($request->title))]);
        /** @var  NewsArticle $article */
        $article = (new NewsArticle)->create($request->all());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        (new SeoService)->saveMetaTagsFromRequest($request, $article);

        return redirect()->route('news.articles')
            ->with('toast_success', __('notifications.message.crud.parent.created', [
                'parent' => __('entities.news'),
                'entity' => __('entities.articles'),
                'name'   => $article->title,
            ]));
    }

    /**
     * @param \App\Models\NewsArticle $article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(NewsArticle $article)
    {
        SEOTools::setTitle(__('admin.title.parent.edit', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
            'detail' => $article->title,
        ]));

        return view('templates.admin.news.articles.edit', compact('article'));
    }

    /**
     * @param \App\Models\NewsArticle $article
     * @param \App\Http\Requests\News\ArticleUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(NewsArticle $article, ArticleUpdateRequest $request)
    {
        $request->merge(['title' => ucfirst(strtolower($request->title))]);
        $article->update($request->all());
        if ($request->file('illustration')) {
            $article->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }
        $article->categories()->sync($request->category_ids);
        (new SeoService)->saveMetaTagsFromRequest($request, $article);

        return back()->with('toast_success', __('notifications.message.crud.parent.updated', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
            'name'   => $article->title,
        ]));
    }

    /**
     * @param \App\Models\NewsArticle $article
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsArticle $article)
    {
        $name = $article->title;
        $article->delete();

        return back()->with('toast_success', __('notifications.message.crud.parent.destroyed', [
            'parent' => __('entities.news'),
            'entity' => __('entities.articles'),
            'name'   => $name,
        ]));
    }
}
