@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-cogs fa-fw"></i>
        {{ __('breadcrumbs.orphan.index', ['entity' => __('Settings')]) }}
    </h1>
    <hr>
    <x-form::form method="PUT" :action="route('settings.update')" :bind="$settings" enctype="multipart/form-data">
        <x-form::button.submit>
            <i class="fas fa-save fa-fw"></i>
            {{ __('Save') }}
        </x-form::button.submit>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Media') }}">
                    <x-admin.media.thumb :media="$settings?->getFirstMedia('logo_squared')"/>
                    {{-- {{ inputCheckbox()->name('remove_logo_squared') }}--}}
                    <x-form::input type="file"
                                   name="logo_squared"
                                   :caption="$settings->getMediaCaption('logo_squared')"/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Contact') }}">
                    <x-form::input type="email" name="email" autofocus autocomplete="email" required/>
                    <x-form::input type="tel" name="phone_number" autocomplete="tel" required/>
                    <x-form::input name="address" autocomplete="street-address" required/>
                    <x-form::input name="zip_code" autocomplete="postal-code" required/>
                    <x-form::input name="city" autocomplete="locality" required/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Links') }}">
                    <x-form::input name="facebook_url"/>
                    <x-form::input name="twitter_url"/>
                    <x-form::input name="instagram_url"/>
                    <x-form::input name="youtube_url"/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Tracking and property') }}">
                    <x-form::input type="url" name="matomo_url"/>
                    <x-form::input name="matomo_id_site"/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
