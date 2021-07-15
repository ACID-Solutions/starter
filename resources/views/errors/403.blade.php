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
                <h1 class="h3 fw-normal text-danger mt-3">
                    <i class="far fa-times-circle fa-fw"></i>
                    {{ __($exception->getMessage()) }}
                </h1>
                <x-form::button.link class="mt-5" :href="route('home.page.show')">
                    <i class="fas fa-undo fa-fw"></i>
                    {{ __('Back to home page') }}
                </x-form::button.link>
            </div>
        </div>
    </div>
@endsection
