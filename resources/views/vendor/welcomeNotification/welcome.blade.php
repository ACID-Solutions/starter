@extends('layouts.admin.auth')
@section('content')
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end'],
        'dropdownClass' => ['dropdown-menu-end'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-hand-spock fa-fw"></i>
        {{ __('Welcome') }}
    </h1>
    <x-form::form method="POST">
        <input type="hidden" name="email" value="{{ $user->email }}"/>
        <x-common.forms.notice class="mt-3"/>
        <p>{{ __('Welcome on :app ! To be able to login to your new account please define a secured password with the fields bellow.', ['app' => config('app.name')]) }}</p>
        <x-form::input type="password" name="password" autofocus autocomplete="new-password" data-password-strength-meter required/>
        <x-form::input type="password" name="password_confirmation" autocomplete="new-password" required/>
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-check fa-fw"></i>
                {{ __('Save new password') }}
            </x-form::button.submit>
        </div>
        <x-form::button.link class="btn-secondary" :href="route('home.page.show')">
            <i class="fas fa-ban fa-fw"></i>
            {{ __('Cancel') }}
        </x-form::button.link>
    </x-form::form>
@endsection
