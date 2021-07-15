<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\LibraryMediaCategoryStoreRequest;
use App\Http\Requests\LibraryMedia\LibraryMediaCategoryUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Tables\LibraryMediaCategoriesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LibraryMediaCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        $table = app(LibraryMediaCategoriesTable::class)->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.library-media.categories.index', compact('table'));
    }

    public function create(): View
    {
        $category = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.library-media.categories.edit', compact('category'));
    }

    public function store(LibraryMediaCategoryStoreRequest $request): RedirectResponse
    {
        $category = LibraryMediaCategory::create($request->validated());

        return redirect()->route('library-media.categories.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('Media library'),
                'entity' => __('Categories'),
                'name' => $category->title,
            ]));
    }

    public function edit(LibraryMediaCategory $category): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'detail' => $category->title,
        ]));

        return view('templates.admin.library-media.categories.edit', compact('category'));
    }

    public function update(
        LibraryMediaCategoryUpdateRequest $request,
        LibraryMediaCategory $category
    ): RedirectResponse {
        $category->update($request->validated());

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->title,
        ]));
    }

    public function destroy(LibraryMediaCategory $category): RedirectResponse
    {
        $category->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $category->title,
        ]));
    }
}
