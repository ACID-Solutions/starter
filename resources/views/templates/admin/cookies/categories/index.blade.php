@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-tags fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Cookies'), 'entity' => __('Categories')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <p>
            {{ __('Cookie categories are gathering cookie services with similar purpose in order to allow users to easily identify them.') }}<br>
            {{ __('Only non-empty categories will be displayed on the user consent pop-in.') }}
        </p>
        <x-admin.table.drag-and-drop/>
        <div data-sortable
             data-draggable-container="#cookie-categories-table tbody"
             data-draggable-items="tr"
             data-reorder-url="{{ route('cookie.categories.reorder') }}">
            {{ $table }}
        </div>
    </x-admin.forms.card>
@endsection
