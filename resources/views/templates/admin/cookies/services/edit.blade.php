@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-laptop-code fa-fw"></i>
        @if($cookieService)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Cookies'), 'entity' => __('Services'), 'detail' => $cookieService->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$cookieService ? 'PUT' : 'POST'"
          :action="$cookieService ? route('cookie.service.update', $cookieService) : route('cookie.service.store')"
          :bind="$cookieService">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('cookie.services.index')">
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
                <x-admin.forms.card title="{{ __('Service') }}">
                    <x-form::select name="category_ids"
                                    :options="App\Models\Cookies\CookieCategory::pluck('title', 'id')->sortBy('title')->toArray()"
                                    :caption="__('Define in which categories this service will be classified. A service can be attached to one or more categories.')"
                                    multiple
                                    required/>
                    <x-form::input name="unique_key"
                                   :caption="__('The unique service key, which is used to associate the user consent with a third-party script in order to enable or disable it accordingly to the user choice.')"
                                   data-snakecase
                                   required/>
                    <x-form::input name="title"
                                   :locales="supportedLocaleKeys()"
                                   required/>
                    <x-form::textarea name="description" :locales="supportedLocaleKeys()"/>
                    <x-form::toggle-switch name="required"
                                           :caption="__('Define whether this service is required by your application and should not be allowed to be disabled.')"/>
                    <x-form::toggle-switch name="enabled_by_default"
                                           :caption="__('Define whether this service is enabled by default, before asking users if they want to activate it or not.')"/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Cookies') }}">
                    <p>
                        {{ __('Configure the cookies which are used by this service. If this service use is refused, these cookies will automatically be deleted.') }}
                    </p>
                    <p>
                        {{ __('To help you to configure this, an example is available here:') }}
                        <a href="https://heyklaro.com/docs/integration/annotated-configuration" target="_blank" rel="noopener">https://heyklaro.com/docs/integration/annotated-configuration</a>.
                    </p>
                    <x-form::textarea name="cookies"
                                      :value="$cookieService?->cookies ? json_encode($cookieService->cookies, JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR) : null"
                                      :caption="__('This configuration must be declared in a valid JSON format.')"
                                      rows="20"/>
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
