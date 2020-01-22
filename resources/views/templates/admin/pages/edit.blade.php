@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-file-alt fa-fw"></i>
        @if($page)
            @lang('breadcrumbs.orphan.edit', ['entity' => __('Pages'), 'detail' => $page->slug])
        @else
            @lang('breadcrumbs.orphan.create', ['entity' => __('Pages')])
        @endif
    </h1>
    <hr>
    <form action="{{ $page ? route('page.update', $page) : route('page.store') }}"
          method="POST">
        @csrf
        @if($page)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Navigation')</h3>
                {{ inputText()->name('nav_title')
                    ->locales(supportedLocaleKeys())
                    ->model($page)
                    ->containerHtmlAttributes(['required']) }}
                @if(! $page)
                    {{ inputText()->name('slug')
                        ->model($page)
                        ->prepend('<i class="fas fa-key fa-fw"></i>')
                        ->componentClasses(['slugify'])
                        ->componentHtmlAttributes(['data-autofill-from' => '#text-nav-title'])
                        ->containerHtmlAttributes(['required'])}}
                @endif
                {{ inputText()->name('url')
                    ->locales(supportedLocaleKeys())
                    ->model($page)
                    ->prepend(route('page.show', '/') . '/')
                    ->componentClasses(['lowercase'])
                    ->componentHtmlAttributes(['data-autofill-from' => '#text-nav-title'])
                    ->containerHtmlAttributes(['required']) }}
                {{ inputToggle()->name('active')->model($page) }}
                @include('components.admin.seo.meta-tags', ['model' => $page])
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('pages.index')->containerClasses(['mr-2']) }}
                    @if($page){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
    @if($page)
        <div class="mt-3">
            {{ Brickables::adminPanel($page) }}
        </div>
    @endif
@endsection
