@extends('layouts.admin.auth')
@section('content')
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-end'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-sync fa-fw"></i>
        {{ __('Define new password') }}
    </h1>
    <x-common.forms.notice class="mt-3"/>
    <x-form::form method="POST" :action="route('password.update')">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-form::input type="email" name="email" autofocus autocomplete="username" required/>
        <x-form::input type="password" autocomplete="new-password" data-password-strength-meter required/>
        <x-form::input type="password_confirmation" autocomplete="new-password" required/>
        <div class="d-block mb-3">
            <x-form::button.submit>
                {{ __('Save new password') }}
            </x-form::button.submit>
        </div>
        <x-form::button.link class="btn-secondary" :href="route('login')">
            <i class="fas fa-undo fa-fw"></i>
            {{ __('Back') }}
        </x-form::button.link>
    </x-form::form>
@endsection
