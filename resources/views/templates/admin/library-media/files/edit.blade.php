@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @if($file)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Media library'), 'detail' => $file->name]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Media library')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$file ? 'PUT' : 'POST'"
                  :action="$file ? route('libraryMedia.file.update', $file) : route('libraryMedia.file.store')"
                  :bind="$file"
                  enctype="multipart/form-data">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('libraryMedia.files.index')">
                <i class="fas fa-undo fa-fw"></i>
                {{ __('Back') }}
            </x-form::button.link>
            <x-form::button.submit>
                <i class="fas fa-save fa-fw"></i>
                {{ __('Save') }}
            </x-form::button.submit>
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('File') }}">
                    <x-admin.library-media.thumb class="mb-2" :file="$file"/>
                    <x-form::input type="file"
                                   name="media"
                                   :caption="app(App\Models\LibraryMedia\LibraryMediaFile::class)->getMediaCaption('media')"
                                   required/>
                    <x-form::input name="name" :locales="supportedLocaleKeys()" required/>
                    <x-form::select name="category_id"
                                    :options="App\Models\LibraryMedia\LibraryMediaCategory::pluck('title', 'id')->sortBy('title')->toArray()"
                                    required/>
                </x-admin.forms.card>
            </div>
            @if($file)
                <div class="col-xl-6 mb-3">
                    <x-admin.forms.card title="{{ __('Clipboard copy') }}">
                        <p>{{ __('Click on buttons below to copy the related content to your clipboard.') }}</p>
                        <x-admin.library-media.clipboard-copy.buttons :file="$file"/>
                    </x-admin.forms.card>
                </div>
            @endif
        </div>
    </x-form::form>
@endsection
