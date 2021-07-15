@extends('layouts.admin.full')
@section('template')
    <h1 xmlns:x-form="http://www.w3.org/1999/html">
        <i class="fas fa-paper-plane fa-fw"></i>
        @if($article)
            {{ __('breadcrumbs.parent.edit', ['entity' => __('Articles'), 'detail' => $article->title, 'parent' => __('News')]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['entity' => __('Articles'), 'parent' => __('News')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$article ? 'PUT' : 'POST'"
          :action="$article ? route('news.article.update', $article) : route('news.article.store')"
          :bind="$article"
          enctype="multipart/form-data">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('news.articles.index')">
                <i class="fas fa-undo fa-fw"></i>
                {{ __('Back') }}
            </x-form::button.link>
            <x-form::button.submit>
                <i class="fas fa-save fa-fw"></i>
                {{ __('Save') }}
            </x-form::button.submit>
            @if($article?->active)
                <x-form::button.link class="btn-success ms-3" :href="route('news.article.show', $article)" target="_blank">
                    <i class="fas fa-external-link-square-alt fa-fw"></i>
                    {{ __('Display') }}
                </x-form::button.link>
            @endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Media') }}">
                    <x-admin.media.thumb :media="$article?->getFirstMedia('illustrations')"/>
                    {{-- {{ inputCheckbox()->name('remove_logo_squared') }}--}}
                    <x-form::input type="file"
                                   name="illustration"
                                   :caption="app(App\Models\News\NewsArticle::class)->getMediaCaption('illustrations')"/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Information') }}">
                    <x-form::input name="title" :locales="supportedLocaleKeys()" required/>
                    <x-form::input name="slug"
                                   :locales="supportedLocaleKeys()"
                                   :prepend="fn(string $locale) => route('news.article.show', '', false, $locale) . '/'"
                                   data-autofill-from="#text-title"
                                   data-kebabcase
                                   required/>
                    <x-form::select name="category_ids"
                                    :options="App\Models\News\NewsCategory::pluck('title', 'id')->sortBy('title')->toArray()"
                                    multiple
                                    required/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Content') }}">
                    <x-form::textarea name="description" :locales="supportedLocaleKeys()" data-editor/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.seo-meta-card :model="$article"/>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    <x-form::input name="published_at"
                                   prepend="<i class='far fa-calendar-alt'></i>"
                                   :value="$article?->published_at->toW3cString() ?: now()->toW3cString()"
                                   :caption="__('You can set a future publication date: this article will not be published until this date is reached.')"
                                   data-datetime-picker
                                   required/>
                    <x-form::toggle-switch name="active"/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
