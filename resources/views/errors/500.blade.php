@extends('layouts.front.empty')
@section('template')
    <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    @include('components.common.multilingual.lang-switcher', [
                        'containerClasses' => ['text-right'],
                        'dropdownLabelClasses' => ['btn', 'btn-link'],
                        'dropdownMenuClasses' => ['dropdown-menu-right']
                    ])
                    @if($icon = settings()->getFirstMedia('icons'))
                        {{ $icon('auth') }}
                    @endif
                </div>
                <h1 class="h3 font-weight-normal text-danger mt-3">
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
                                'name': '{{ config('app.name') }}',
                                'email': '{{ settings()->email }}',
                                'lang': '{{ app()->getLocale() }}'
                            }
                        });
                    </script>
                @endif
                {{ buttonBack()->route('home.page.show')->label(__('Back to home page'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
