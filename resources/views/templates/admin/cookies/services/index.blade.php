@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-laptop-code fa-fw"></i>
        {{ __('breadcrumbs.parent.index', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
    </h1>
    <hr>
    <x-admin.forms.card title="{{ __('List') }}">
        <p>
            {{ __('Please note that you are responsible for complying with the GDPR law on this platform.') }}<br>
            {{ __('For this purpose, you must configure all services using cookies and collecting data from your users on this interface.') }}
        </p>
        <p>
            {{ __('To help you during this configuration process, you can read the documentation of the used CMP tool:') }}
            <a href="https://heyklaro.com/docs" title="GDPR" target="_blank" rel="noopener">https://heyklaro.com/docs</a>.<br>
            {{ __('You will also find all the necessary information about GDPR law on this resource:') }}
            <a href="https://gdpr.eu" title="GDPR" target="_blank" rel="noopener">https://gdpr.eu</a>.
        </p>
        <x-form::form class="d-flex justify-content-end" :action="route('cookie.services.index')" :bind="$request">
            @foreach($request->except('category_id') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <x-form::select class="mb-n3"
                            name="category_id"
                            hideLabel
                            :options="App\Models\Cookies\CookieCategory::pluck('title', 'id')->sortBy('title')->toArray()"/>
            <x-form::button.submit class="btn-primary ms-3">
                <i class="fas fa-filter fa-fw"></i>
                {{ __('Filter') }}
            </x-form::button.submit>
            @if($request->has(['category_id']))
                <x-form::button.link class="btn-secondary ms-3" :href="route('cookie.services.index')">
                    <i class="fas fa-undo fa-fw"></i>
                    {{ __('Reset') }}
                </x-form::button.link>
            @endif
        </x-form::form>
        {{ $table }}
    </x-admin.forms.card>
@endsection
