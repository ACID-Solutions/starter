@extends('laravel-brickables::admin.form.layout')
@section('form_body')
    <x-common.forms.notice class="mt-3"/>
    <div class="row mb-n3" data-masonry>
        @bind($brick->data)
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Configuration') }}">
                    <x-form::select name="type"
                                    :options="Arr::pluck(App\View\Components\Front\Spacer::TYPES, 'label', 'key')"
                                    required/>
                </x-admin.forms.card>
            </div>
        @endbind()
    </div>
@endsection
