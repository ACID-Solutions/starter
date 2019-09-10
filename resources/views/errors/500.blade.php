@extends('layouts.front.empty')

@section('template')
    <div id="error" class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    @if($icon = $settings->getFirstMedia('icon'))
                        {{ $icon('auth') }}
                    @endif
                </div>
                <i class="fas fa-fw fa-5x fa-exclamation-triangle  text-danger"></i>
                <h1 class="h3 font-weight-normal mt-3">
                    @lang('errors.title') {{ $exception->getStatusCode() }}
                </h1>
                <p class="h5">
                    @lang('errors.message.' . $exception->getStatusCode())
                </p>
                @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()) && config('sentry.dsn_public'))
                    <div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>
                    <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>
                    <script>
                        Raven.showReportDialog({
                            eventId: '{{ Sentry::getLastEventID() }}',
                            dsn: '{{ config('sentry.dsn_public') }}',
                            user: {
                                'name': '{{ config('app.name') }}',
                                'email': '{{ $settings->email }}',
                            }
                        });
                    </script>
                @endif
                {{ bsBack()->route('home')->label(__('static.action.backHome'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
