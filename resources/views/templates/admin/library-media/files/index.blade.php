@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Media library'), 'entity' => __('Files')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <x-form::form class="d-flex justify-content-end" :action="route('libraryMedia.files.index')" :bind="$request">
            @foreach($request->except('category_id') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <x-form::select class="mb-n3"
                            name="category_id"
                            hideLabel
                            :options="App\Models\LibraryMedia\LibraryMediaCategory::pluck('title', 'id')->sortBy('title')->toArray()"/>
            <x-form::button.submit class="btn-primary ms-3">
                <i class="fas fa-filter fa-fw"></i>
                {{ __('Filter') }}
            </x-form::button.submit>
            @if($request->has(['category_id']))
                <x-form::button.link class="btn-secondary ms-3" :href="route('libraryMedia.files.index')">
                    <i class="fas fa-undo fa-fw"></i>
                    {{ __('Reset') }}
                </x-form::button.link>
            @endif
        </x-form::form>
        {{ $table }}
    </x-admin.forms.card>
@endsection
