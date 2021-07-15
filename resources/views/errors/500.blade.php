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
                    <i class="fas fa-exclamation-triangle fa-fw"></i>
                    {{ __('Error') }} {{ $exception->getStatusCode() }}
                </h1>
                <p class="h5">
                    {{ __($exception->getMessage()) }}
                </p>
                @if(app()->bound('sentry') && app('sentry')->getLastEventId() && config('sentry.dsn'))
                    <div class="subtitle">{{ __('Error ID:') }} {{ app('sentry')->getLastEventId() }}</div>
                    <script src="https://browser.sentry-cdn.com/5.12.1/bundle.min.js"
                            integrity="sha384-y+an4eARFKvjzOivf/Z7JtMJhaN6b+lLQ5oFbBbUwZNNVir39cYtkjW1r6Xjbxg3"
                            crossorigin="anonymous"></script>
                    <script>
                        Sentry.init({dsn: '{{ config('sentry.dsn') }}'});
                        Sentry.showReportDialog({
                            eventId: '{{ app('sentry')->getLastEventId() }}',
                            user: {
                                name: '{{ Auth::user()?->full_name }}',
                                email: '{{ Auth::user()?->email }}',
                            },
                            lang: '{{ app()->getLocale() }}'
                        });
                    </script>
                @endif
                <x-form::button.link class="mt-5" :href="route('home.page.show')">
                    <i class="fas fa-undo fa-fw"></i>
                    {{ __('Back to home page') }}
                </x-form::button.link>
            </div>
        </div>
    </div>
@endsection
