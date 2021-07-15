@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($category)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('News'), 'entity' => __('Categories'), 'detail' => $category->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('News'), 'entity' => __('Categories')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$category ? 'PUT' : 'POST'"
          :action="$category ? route('news.category.update', $category) : route('news.category.store')"
          :bind="$category">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('news.categories.index')">
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
                <x-admin.forms.card title="{{ __('Informations') }}">
                    <x-form::input name="title" :locales="supportedLocaleKeys()" required/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
