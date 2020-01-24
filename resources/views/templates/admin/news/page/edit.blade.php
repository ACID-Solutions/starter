@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-desktop fa-fw"></i>
        @lang('breadcrumbs.orphan.edit', ['entity' => __('News'), 'detail' => __('Page')])
    </h1>
    <hr>
    <form method="POST" class="w-100" action="{{ route('news.page.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Content')</h3>
                {{ inputText()->name('title')
                    ->locales(supportedLocaleKeys())
                    ->value(fn($locale) => translatedData($pageContent->getFirstBrick(\App\Brickables\TitleH1::class), 'data.title'))
                    ->containerHtmlAttributes(['required']) }}
                {{ textarea()->name('description')
                    ->locales(supportedLocaleKeys())
                    ->prepend(false)
                    ->value(fn($locale) => translatedData($pageContent->getFirstBrick(\App\Brickables\OneTextColumn::class), 'data.text'))
                    ->componentClasses(['editor']) }}
                @include('components.admin.seo.meta-tags', ['model' => $pageContent])
                <div class="d-flex pt-4">
                    {{ submitUpdate() }}
                </div>
            </div>
        </div>
    </form>
@endsection
