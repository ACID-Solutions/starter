@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        @if($cookieCategory)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Cookies'), 'entity' => __('Categories'), 'detail' => $cookieCategory->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Cookies'), 'entity' => __('Categories')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$cookieCategory ? 'PUT' : 'POST'"
          :action="$cookieCategory ? route('cookie.category.update', $cookieCategory) : route('cookie.category.store')"
          :bind="$cookieCategory">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('cookie.categories.index')">
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
                <x-admin.forms.card title="{{ __('Information') }}">
                    <x-form::input name="unique_key" data-snakecase required/>
                    <x-form::input name="title" :locales="supportedLocaleKeys()" required/>
                    <x-form::textarea name="description" :locales="supportedLocaleKeys()"/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
