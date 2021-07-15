@extends('laravel-brickables::admin.form.layout')
@section('form_body')
    <x-common.forms.notice class="mt-3"/>
    <div class="row mb-n3" data-masonry>
        @bind($brick->data)
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Content') }}">
                    <x-form::textarea name="text" :locales="supportedLocaleKeys()" data-editor required/>
                </x-admin.forms.card>
            </div>
        @endbind()
    </div>
@endsection
