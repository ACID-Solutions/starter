<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\ArticlesIndexRequest;
use App\Models\News\NewsArticle;
use App\Models\Pages\PageContent;
use App\Models\Pages\TitleDescriptionPageContent;
use App\Services\Seo\SeoService;

class NewsPageController extends Controller
{
    /**
     * @param \App\Http\Requests\News\ArticlesIndexRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(ArticlesIndexRequest $request)
    {
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->firstOrCreate(['slug' => 'news-page-content']);
        $pageContent->displaySeoMeta();
        $query = (new NewsArticle)->with(['media', 'categories'])
            ->where('active', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
        if ($request->category_id) {
            $query->whereHas('categories', fn($category) => $category->where('id', $request->category_id));
        }
        $articles = $query->paginate(6)->appends($request->only('category_id'));
        $css = mix('/css/news/index.css');

        return view('templates.front.news.page.show', compact('pageContent', 'articles', 'css'));
    }
}
