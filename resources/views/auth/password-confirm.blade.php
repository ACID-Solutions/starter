@extends('layouts.admin.auth')
@section('content')
    @if($errors->any())
        @php
            toast(__('notify.invalid'), 'error');
        @endphp
    @endif
    {{-- Todo: remove this component call if your app is not multilingual --}}
    @include('components.common.multilingual.lang-switcher', [
        'containerClasses' => ['text-end', 'mb-3'],
        'dropdownClass' => ['dropdown-menu-end'],
        'labelClass' => ['btn', 'btn-link']
    ])
    <div class="mx-auto mb-4" xmlns:x-form="http://www.w3.org/1999/html" xmlns:x-form="http://www.w3.org/1999/html">
        {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
    </div>
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-shield-alt fa-fw"></i>
        {{ __('Password verification') }}
    </h1>
    <x-form::form method="POST">
        <x-common.forms.notice class="mt-3"/>
        <p>{{ __('For security reasons, please confirm your password. You will not be asked for several hours.') }}</p>
        <x-form::input type="password" name="password" autocomplete="current-password" required/>
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-check fa-fw"></i>
                {{ __('Confirm password') }}
            </x-form::button.submit>
        </div>
        <x-form::button.link class="btn-secondary" :href="url()->previous()">
            <i class="fas fa-ban fa-fw"></i>
            {{ __('Cancel') }}
        </x-form::button.link>
    </x-form::form>
@endsection
