@extends('layouts.front.empty')
@section('template')
    <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    {{-- Todo: remove this component call if your app is not multilingual --}}
                    @include('components.common.multilingual.lang-switcher', [
                        'containerClasses' => ['text-end'],
                        'dropdownLabelClasses' => ['btn', 'btn-link'],
                        'dropdownMenuClasses' => ['dropdown-menu-end']
                    ])
                    {{ settings()->getFirstMedia('logo_squared')->img('auth', ['alt' => config('app.name')]) }}
                </div>
                <h1 class="h3 text-info mt-3">
                    <i class="fas fa-tools fa-fw"></i>
                    {{ __('Maintenance in progress') }}
                </h1>
                <p class="h5">
                    {{ __('Service currently unavailable.') }}
                </p>
                <x-form::button.link class="mt-5" :href="route('home.page.show')">
                    <i class="fas fa-undo fa-fw"></i>
                    {{ __('Back to home page') }}
                </x-form::button.link>
            </div>
        </div>
    </div>
@endsection
