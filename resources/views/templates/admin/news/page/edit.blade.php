@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-desktop fa-fw"></i>
        {{ __('breadcrumbs.orphan.edit', ['entity' => __('News'), 'detail' => __('Page')]) }}
    </h1>
    <hr>
    <x-form::form method="PUT" :action="route('news.page.update')" enctype="multipart/form-data">
        <div class="d-flex">
            <x-form::button.submit>
                <i class="fas fa-save fa-fw"></i>
                {{ __('Save') }}
            </x-form::button.submit>
            <x-form::button.link class="btn-success ms-3" :href="route('news.page.show')" target="_blank">
                <i class="fas fa-external-link-square-alt fa-fw"></i>
                {{ __('Display') }}
            </x-form::button.link>
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.seo-meta-card :model="$pageContent"/>
            </div>
        </div>
    </x-form::form>
    <hr>
    @if($pageContent)
        {!! $pageContent->displayAdminPanel() !!}
    @else
        @include('components.admin.brickables.manage-content-once-created')
    @endif
@endsection
