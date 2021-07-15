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
        <i class="fas fa-user-plus fa-fw"></i>
        {{ __('Registration area') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <x-form::form method="POST">
        <x-form::input name="first_name" autofocus autocomplete="given-name" required/>
        <x-form::input name="last_name" autocomplete="family-name" required/>
        <x-form::input type="email" name="email" autocomplete="email" required/>
        <x-form::input type="password" name="password" autocomplete="new-password" data-password-strength-meter required/>
        <x-form::input type="password" name="password_confirmation" autocomplete="new-password" required/>
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-check fa-fw"></i>
                {{ __('Create account') }}
            </x-form::button.submit>
        </div>
        <x-form::button.link class="btn-secondary" :href="route('login')">
            <i class="fas fa-ban fa-fw"></i>
            {{ __('Cancel') }}
        </x-form::button.link>
    </x-form::form>
@endsection
