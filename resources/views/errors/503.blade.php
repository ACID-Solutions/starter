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
                <h1 class="h3 font-weight-normal text-info mt-3">
                    <i class="fas fa-tools fa-fw"></i>
                    @lang('Maintenance in progress')
                </h1>
                @if($exception->getMessage())
                    <p class="h5">
                        {{ $exception->getMessage() }}
                    </p>
                @endif
                {{ buttonBack()->route('home')->label(__('Retry'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection
