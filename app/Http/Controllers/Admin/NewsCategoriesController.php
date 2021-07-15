<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsCategoryStoreRequest;
use App\Http\Requests\News\NewsCategoryUpdateRequest;
use App\Models\News\NewsCategory;
use App\Tables\NewsCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewsCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = app(NewsCategoriesTable::class)->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.index', compact('table'));
    }

    public function create(): View
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('News'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    public function store(NewsCategoryStoreRequest $request): RedirectResponse
    {
        $category = NewsCategory::create($request->validated());

        return redirect()->route('news.categories.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('News'),
                'entity' => __('Categories'),
                'name' => $category->title,
            ]));
    }

    public function edit(NewsCategory $category): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'detail' => $category->title,
        ]));

        return view('templates.admin.news.categories.edit', compact('category'));
    }

    public function update(NewsCategoryUpdateRequest $request, NewsCategory $category): RedirectResponse
    {
        $category->update($request->validated());

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $category->title,
        ]));
    }

    /**
     * @param \App\Models\News\NewsCategory $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(NewsCategory $category): RedirectResponse
    {
        $category->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('News'),
            'entity' => __('Categories'),
            'name' => $category->title,
        ]));
    }
}
