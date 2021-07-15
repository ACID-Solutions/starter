@extends('laravel-brickables::admin.form.layout')
@php
    
@endphp
@section('form_body')
    <x-common.forms.notice class="mt-3"/>
    <div class="row mb-n3" data-masonry>
        @bind($brick->data)
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Configuration') }}">
                    <x-form::select name="background_color"
                                    :options="Arr::pluck(array_map(static fn(array $backgroundColor) => ['key' => $backgroundColor['key'], 'label' => __($backgroundColor['label'])], App\Brickables\ColoredBackgroundContainer::BACKGROUND_COLORS), 'label', 'key')"
                                    required/>
                    <x-form::select name="background_color"
                                    :options="Arr::pluck(array_map(static fn(array $alignment) => ['key' => $alignment['key'], 'label' => __($alignment['label'])], App\Brickables\ColoredBackgroundContainer::ALIGNMENTS), 'label', 'key')"
                                    required/>
                </x-admin.forms.card>
            </div>
        @endbind()
    </div>
@endsection
@section('append')
    <hr>
    <div class="mt-3">
        @if($brick)
            {!! $brick->displayAdminPanel() !!}
        @else
            @include('components.admin.brickables.manage-content-once-created')
        @endif
    </div>
@endsection
