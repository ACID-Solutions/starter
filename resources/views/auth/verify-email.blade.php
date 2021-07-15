@if(session('status') === 'verification-link-sent')
    @php
        alert()->html(__('Success'), __('A new verification link has been sent to the email address you provided during registration.'), 'success')->showConfirmButton()
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
        {{ __('Email address verification') }}
    </h1>
    <p>
        {{ __('We need to ensure that your email address is valid.') }}
    </p>
    <p>
        {{ __('Could you verify it by clicking on the link we just emailed to you?') }}
    </p>
    <p>
        {{ __('If you didn\'t receive the email, we will gladly send you another.') }}
    </p>
    <x-form::form method="POST" :action="route('verification.send')">
        <x-form::button.submit>
            <i class="fas fa-paper-plane fa-fw"></i>
            {{ __('Resend Verification Email') }}
        </x-form::button.submit>
    </x-form::form>
@endsection
