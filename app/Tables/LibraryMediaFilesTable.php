<?php

namespace App\Tables;

use App\Http\Requests\LibraryMedia\LibraryMediaFilesIndexRequest;
use App\Models\LibraryMedia\LibraryMediaFile;
use App\View\Components\Admin\LibraryMedia\ClipboardCopy\Buttons;
use App\View\Components\Admin\LibraryMedia\Thumb;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class LibraryMediaFilesTable extends AbstractTable
{
    protected LibraryMediaFilesIndexRequest $request;

    public function __construct(LibraryMediaFilesIndexRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(LibraryMediaFile::class)
            ->routes([
                'index' => ['name' => 'libraryMedia.files.index'],
                'create' => ['name' => 'libraryMedia.file.create'],
                'edit' => ['name' => 'libraryMedia.file.edit'],
                'destroy' => ['name' => 'libraryMedia.file.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(LibraryMediaFile $file) => [
                'data-confirm' => __('crud.orphan.destroy_confirm', [
                    'entity' => __('Media library'),
                    'name' => $file->name,
                ]),
            ])
            ->query(function (Builder $query) {
                $query->with('media', 'category');
                $query->select('library_media_files.*');
                // Todo: replace select by `'library_media_categories.title as category_title'`
                // if your app is not multilingual.
                $query->addSelect('library_media_categories.title->' . app()->getLocale() . ' as category_title');
                $query->addSelect('media.mime_type');
                $query->join('media', 'media.model_id', '=', 'library_media_files.id');
                $query->join(
                    'library_media_categories',
                    'library_media_categories.id',
                    '=',
                    'library_media_files.category_id'
                );
                $query->where('model_type', \App\Models\LibraryMedia\LibraryMediaFile::class);
                if ($this->request->has('category_id')) {
                    $query->where('library_media_categories.id', $this->request->category_id);
                }
            })
            ->appendData($this->request->validated());
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
        $table->column('thumb')
            ->html(fn(LibraryMediaFile $file) => app(Thumb::class)->render()->with(compact('file')));
        $table->column('name')->stringLimit(25)->sortable()->searchable();
        $table->column('category_title')
            ->link(fn(LibraryMediaFile $file) => route('libraryMedia.files.index', [
                'category_id' => $file->category->id,
            ]))
            ->value(fn(LibraryMediaFile $file) => $file->category->title)
            ->stringLimit(25)
            ->sortable();
        $table->column('mime_type')
            ->title(__('MIME types'))
            ->html(fn(LibraryMediaFile $file) => '<a href="https://slick.pl/kb/htaccess/complete-list-mime-types" '
                . 'target="_blank" rel="noopener">'
                . $file->getFirstMedia('media')->mime_type . '</a>')
            ->sortable()
            ->searchable('media');
        $table->column()
            ->title(__('Clipboard copy'))
            ->html(fn(LibraryMediaFile $file) => app(Buttons::class)->render()->with(compact('file')));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
