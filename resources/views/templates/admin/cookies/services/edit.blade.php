@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-cookie-bite fa-fw"></i>
        @if($cookieService)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Cookies'), 'entity' => __('Services'), 'detail' => $cookieService->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $cookieService ? route('cookie.service.update', $cookieService) : route('cookie.service.store') }}"
          novalidate>
        @csrf
        @if($cookieService)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('cookie.services.index')->containerClasses(['mr-3']) }}
            @if($cookieService){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Service') }}">
                    {{ select()->name('category_ids')
                        ->model($cookieService)
                        ->prepend('<i class="fas fa-tags"></i>')
                        ->disablePlaceholder()
                        ->options(App\Models\Cookies\CookieCategory::get()->map(fn(App\Models\Cookies\CookieCategory $category) => [
                            'id' => $category->id,
                            'title' => $category->title
                        ])->sortBy('name'), 'id', 'title')
                        ->multiple()
                        ->componentHtmlAttributes(['required', 'data-selector'])
                        ->caption(__('Define in which categories this service will be classified. A service can be attached to one or more categories.')) }}
                    {{ inputText()->name('title')
                        ->locales(supportedLocaleKeys())
                        ->model($cookieService)
                        ->componentHtmlAttributes(['required'])
                        ->caption(__('The displayed service title on the user consent pop-in.')) }}
                    {{ inputText()->name('unique_key')
                        ->model($cookieService)
                        ->componentHtmlAttributes(['required', 'data-kebabcase', 'data-autofill-from' => '#text-title'])
                        ->caption(__('The unique service name, which is used to associate the user consent with a third-party script in order to activate/deactivate it accordingly to the user consent.')) }}
                    {{ inputSwitch()->name('required')
                        ->model($cookieService)
                        ->caption(__('Whether this service is required by you app and should not be allowed to be shutdown.')) }}
                    {{ inputSwitch()->name('enabled_by_default')
                        ->model($cookieService)
                        ->caption(__('Whether this service is enabled by default, before asking users if they want to activate it or not.')) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Cookies') }}">
                    <p>
                        {{ __('Configure the cookies which are used by this service. If this service use is refused, these cookies will automatically be deleted.') }}
                    </p>
                    <p>
                        {{ __('To help you to decide how to configure this, an example is avaiblable here:') }}
                        <a href="https://heyklaro.com/docs/integration/annotated-configuration" target="_blank" rel="noopener">https://heyklaro.com/docs/integration/annotated-configuration</a>.
                    </p>
                    {{ textarea()->name('cookies')
                        ->model($cookieService)
                        ->value(json_encode($cookieService->cookies, JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR))
                        ->componentHtmlAttributes(['rows' => 20])
                        ->caption(__('This configuration must be declared in a valid JSON format.')) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Publication') }}">
                    {{ inputSwitch()->name('active')->model($cookieService) }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
