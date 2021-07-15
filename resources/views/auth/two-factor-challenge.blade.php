@if(session('status'))
    @php
        alert()->html(__('Success'), session('status'), 'success')->showConfirmButton();
    @endphp
@endif
@extends('layouts.admin.auth')
@section('content')
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownLabelClasses' => ['btn', 'btn-link'],
        'dropdownMenuClasses' => ['dropdown-menu-end']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        {{ __('Two Factor Authentication') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <p>
        @if(request()->recovery)
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        @else
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        @endif
    </p>
    <x-form::form method="POST">
        @if(request()->recovery)
            <x-form::input name="last_name" autofocus autocomplete="one-time-code" required/>
        @else
            <x-form::input name="code" autofocus autocomplete="one-time-code" required/>
        @endif
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-sign-in-alt fa-fw"></i>
                {{ __('Log in') }}
            </x-form::button.submit>
        </div>
        <div class="d-flex mb-3">
            @if(request()->recovery)
                <a href="{{ route(Request::route()->getName()) }}" title="{{ __('Use an authentication code') }}">
                    <i class="fas fa-exchange-alt fa-fw"></i>
                    {{ __('Use an authentication code') }}
                </a>
            @else
                <a href="{{ route(Request::route()->getName(), ['recovery' => true]) }}" title="{{ __('Use a recovery code') }}">
                    <i class="fas fa-exchange-alt fa-fw"></i>
                    {{ __('Use a recovery code') }}
                </a>
            @endif
        </div>
        <x-form::button.link :href="route('home.page.show')">
            <i class="fas fa-undo fa-fw"></i>
            {{ __('Back') }}
        </x-form::button.link>
    </x-form::form>
@endsection
