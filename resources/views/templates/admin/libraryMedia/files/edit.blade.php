@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($file)
            @lang('admin.title.orphan.edit', ['entity' => __('entities.libraryMedia'), 'detail' => $file->name])
        @else
            @lang('admin.title.orphan.create', ['entity' => __('entities.libraryMedia')])
        @endif
    </h1>
    <hr>
    <form action="{{ $file ? route('libraryMedia.file.update', $file) : route('libraryMedia.file.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($file)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('library-media.labels.file')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('library-media.labels.media')</h3>
                {{ bsFile()->name('media')
                    ->value(optional(optional($file)->getFirstMedia('medias'))->file_name)
                    ->uploadedFile(function() use($file) {
                        return $file
                            ? '<div class="mb-2">' . view('components.admin.table.library-media.thumb', compact('file')) . '</div>'
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\LibraryMediaFile)->constraintsLegend('medias')) }}
                <h3 class="pt-4">@lang('library-media.labels.data')</h3>
                {{ bsText()->name('name')->model($file)->containerHtmlAttributes(['required']) }}
                {{ bsSelect()->name('category_id')
                    ->model($file)
                    ->options((new \App\Models\LibraryMediaCategory)->orderBy('name')->get(), 'id', 'name')
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                @if(! $file || optional($file)->canBeDisplayed)
                    {{ bsToggle()->name('downloadable')
                        ->checked(optional($file)->downloadable ?? false)
                        ->containerClasses(['form-group', 'mt-4']) }}
                @endif
                @if($file)
                    <h3 class="pt-4">@lang('library-media.labels.clipboardCopy')</h3>
                    {{ bsText()->name('url')
                        ->label(__('library-media.labels.url'))
                        ->prepend(false)
                        ->value($file->getFirstMedia('medias')->getFullUrl())
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['disabled']) }}
                    <div class="form-group">
                        <button type="button"
                                class="btn btn-outline-primary clipboard-copy"
                                data-library-media-id="{{ $file->id }}"
                                data-type="url">
                            <i class="fas fa-link fa-fw"></i> @lang('library-media.labels.clipboardCopy')
                        </button>
                    </div>
                    {{ bsTextarea()->name('html')
                        ->label(__('library-media.labels.html'))
                        ->prepend(false)
                        ->value(trim(view('components.admin.table.library-media.html-clipboard-content', compact('file'))->toHtml()))
                        ->containerClasses(['mb-1'])
                        ->componentHtmlAttributes(['rows' => 6, 'disabled']) }}
                    <div class="form-group">
                        <button type="button"
                                class="btn btn-outline-primary clipboard-copy"
                                data-library-media-id="{{ $file->id }}"
                                data-type="html">
                            <i class="fas fa-link fa-fw"></i> @lang('library-media.labels.clipboardCopy')
                        </button>
                    </div>
                @endif
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('libraryMedia.files.index')->containerClasses(['mr-2']) }}
                    @if($file){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
