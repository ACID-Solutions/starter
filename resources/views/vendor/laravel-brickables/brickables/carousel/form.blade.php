@extends('laravel-brickables::admin.form.layout')
@section('title')
    {{ __('Carousel') }}
@endsection
@section('inputs')
    <x-form::toggle-switch name="full_width"/>
@endsection
@section('append')
    <x-admin.forms.card title="{{ __('Slides') }}" class="mt-3">
        @if($brick)
            <x-admin.table.drag-and-drop/>
            <div data-sortable
                 data-draggable-container="#carousel-brick-slides-table tbody"
                 data-draggable-items="tr"
                 data-reorder-url="{{ route('brick.carousel.slides.reorder') }}">
                {{ $table }}
            </div>
        @else
            <i class="fas fa-info-circle fa-fw text-info"></i>
            {{ __('Slides management will be available after the brick creation.') }}
        @endif
    </x-admin.forms.card>
@endsection
