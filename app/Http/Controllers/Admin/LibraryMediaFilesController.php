<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\FilesIndexRequest;
use App\Http\Requests\LibraryMedia\FileStoreRequest;
use App\Http\Requests\LibraryMedia\FileUpdateRequest;
use App\Models\LibraryMediaFile;
use App\Services\LibraryMedia\FilesService;
use Artesaos\SEOTools\Facades\SEOTools;
use ErrorException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Log;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param FilesIndexRequest $request
     *
     * @return Factory|View
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function index(FilesIndexRequest $request)
    {
        $table = (new FilesService)->table($request);
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Media library')]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/index.js');

        return view('templates.admin.libraryMedia.files.index', compact('table', 'request', 'js'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $file = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Media library')]));

        return view('templates.admin.libraryMedia.files.edit', compact('file'));
    }

    /**
     * @param FileStoreRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(FileStoreRequest $request)
    {
        /** @var LibraryMediaFile $file */
        $file = (new LibraryMediaFile)->create($request->validated());
        $file->addMediaFromRequest('media')->toMediaCollection('medias');

        return redirect()->route('libraryMedia.files.index')
            ->with('toast_success', __('notifications.orphan.created', [
                'entity' => __('Media library'),
                'name'   => $file->name,
            ]));
    }

    /**
     * @param LibraryMediaFile $file
     *
     * @return Factory|View
     * @throws Exception
     */
    public function edit(LibraryMediaFile $file)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Media library'),
            'detail' => $file->name,
        ]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/edit.js');

        return view('templates.admin.libraryMedia.files.edit', compact('file', 'js'));
    }

    /**
     * @param LibraryMediaFile $file
     * @param FileUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(LibraryMediaFile $file, FileUpdateRequest $request)
    {
        $file->update($request->validated());
        if ($request->file('media')) {
            $file->addMediaFromRequest('media')->toMediaCollection('medias');
        }

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Media library'),
            'name'   => $file->name,
        ]));
    }

    /**
     * @param LibraryMediaFile $file
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(LibraryMediaFile $file)
    {
        $name = $file->name;
        $file->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Media library'),
            'name'   => $name,
        ]));
    }

    /**
     * @param LibraryMediaFile $file
     * @param string $type
     *
     * @return JsonResponse
     */
    public function clipboardContent(LibraryMediaFile $file, string $type)
    {
        try {
            $clipboardContent = $type === 'url'
                ? $file->getFirstMedia('medias')->getFullUrl()
                : trim(view('components.admin.table.library-media.html-clipboard-content', compact('file'))->toHtml());
            $message = __('Media « :name » :type copied in clipboard.', [
                'type' => strtoupper($type),
                'name' => $file->name,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            $message = __('An unexpected error occurred. If the problem persists, please contact support.');
        }

        return response()->json(compact('clipboardContent', 'message'));
    }
}
