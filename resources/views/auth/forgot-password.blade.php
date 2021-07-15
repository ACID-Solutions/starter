@extends('layouts.admin.auth')
@section('content')
    @if(session('status'))
        @php
            alert()->html(__('Success'), session('status'), 'success')->showConfirmButton()
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
        <i class="fas fa-unlock-alt fa-fw"></i>
        {{ __('Forgotten password') }}
    </h1>
    <p>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>
    <x-form::form method="POST" :action="route('password.email')">
        <x-common.forms.notice class="mt-3"/>
        <x-form::input type="email" name="email" autofocus autocomplete="email" required/>
        <div class="d-grid mb-3">
            <x-form::button.submit>
                <i class="fas fa-paper-plane fa-fw"></i>
                {{ __('Send reset email') }}
            </x-form::button.submit>
        </div>
        <x-form::button.link class="btn-secondary" :href="route('login')">
            <i class="fas fa-ban fa-fw"></i>
            {{ __('Cancel') }}
        </x-form::button.link>
    </x-form::form>
@endsection
