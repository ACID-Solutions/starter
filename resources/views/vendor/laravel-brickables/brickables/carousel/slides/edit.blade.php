@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-chalkboard-teacher fa-fw"></i>
        @if($slide)
            {{ __('breadcrumbs.parent.edit', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides'),
                'detail' => $slide->label
            ]) }}
        @else
            {{ __('breadcrumbs.parent.create', [
                'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
                'entity' => __('Slides')
            ]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$slide ? 'PUT' : 'POST'"
                  :action="$slide ? route('brick.carousel.slide.update', $slide) : route('brick.carousel.slide.store', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url])"
                  :bind="$slide"
                  enctype="multipart/form-data">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('brick.edit', ['brick' => $brick, 'admin_panel_url' => request()->admin_panel_url])">
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
                    <x-admin.media.thumb :media="$slide?->getFirstMedia('images')"/>
                    <x-form::input type="file"
                                   name="illustration"
                                   :caption="app(App\Models\Brickables\CarouselBrickSlide::class)->getMediaCaption('images')"
                                   required/>
                    <x-form::input name="label" :locales="supportedLocaleKeys()"/>
                    <x-form::input name="caption" :locales="supportedLocaleKeys()"/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    <x-form::toggle-switch name="active"/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
