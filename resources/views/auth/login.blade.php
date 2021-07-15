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
    <h1 class="h3 mb-3">
        <i class="fas fa-sign-in-alt fa-fw"></i>
        {{ __('Sign in area') }}
    </h1>
    <x-form::form method="POST">
        <x-common.forms.notice class="mt-3"/>
        <x-form::input type="email" name="email" autofocus autocomplete="email" required/>
        <x-form::input type="password" name="password" autocomplete="current-password" required/>
        <x-form::toggle-switch name="remember"/>
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-check fa-fw"></i>
                {{ __('Log in') }}
            </x-form::button.submit>
        </div>
        @php
            $registrationEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration());
            $resetPasswordsEnabled = Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::resetPasswords());
        @endphp
        @if($registrationEnabled || $resetPasswordsEnabled)
            <div class="d-flex justify-content-between mb-3">
                @if($registrationEnabled)
                    <a href="{{ route('register') }}" title="{{ __('Create account') }}">
                        {{ __('Create account') }}
                    </a>
                @endif
                @if($resetPasswordsEnabled)
                    <a href="{{ route('password.request') }}" title="{{ __('Forgotten password') }}">
                        {{ __('Forgotten password') }}
                    </a>
                @endif
            </div>
        @endif
        <x-form::button.link class="btn-secondary" :href="route('home.page.show')">
            <i class="fas fa-undo fa-fw"></i>
            {{ __('Back') }}
        </x-form::button.link>
    </x-form::form>
@endsection
