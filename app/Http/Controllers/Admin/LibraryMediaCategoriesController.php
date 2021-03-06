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
        $libraryMediaCategory = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
        ]));

        return view('templates.admin.library-media.categories.edit', compact('libraryMediaCategory'));
    }

    public function store(LibraryMediaCategoryStoreRequest $request): RedirectResponse
    {
        $libraryMediaCategory = LibraryMediaCategory::create($request->validated());

        return redirect()->route('library-media.categories.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('Media library'),
                'entity' => __('Categories'),
                'name' => $libraryMediaCategory->title,
            ]));
    }

    public function edit(LibraryMediaCategory $libraryMediaCategory): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'detail' => $libraryMediaCategory->title,
        ]));

        return view('templates.admin.library-media.categories.edit', compact('libraryMediaCategory'));
    }

    public function update(
        LibraryMediaCategoryUpdateRequest $request,
        LibraryMediaCategory $libraryMediaCategory
    ): RedirectResponse {
        $libraryMediaCategory->update($request->validated());

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $libraryMediaCategory->title,
        ]));
    }

    public function destroy(LibraryMediaCategory $libraryMediaCategory): RedirectResponse
    {
        $libraryMediaCategory->delete();

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Media library'),
            'entity' => __('Categories'),
            'name' => $libraryMediaCategory->title,
        ]));
    }
}
