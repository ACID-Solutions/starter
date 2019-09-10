@extends('layouts.admin.auth')
@section('content')
    @include('components.common.language.selector', [
        'containerClasses'    => 'text-right',
        'dropdownClass'     => 'dropdown-menu-right',
        'labelClass'        => ['btn', 'btn-link']
    ])
    @if($icon = $settings->getFirstMedia('icon'))
        <div class="mx-auto mb-4">
            {{ $icon('auth') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">
        <i class="fas fa-fw fa-unlock-alt"></i>
        @lang('auth.title.forgottenPassword')
    </h1>
    <form method="POST" class="w-100" action="{{ route('password.email') }}">
        @csrf
        @include('components.common.form.notice')
        {{ bsEmail()->name('email')
            ->legend(__('static.legend.password.forgotten'))
            ->componentHtmlAttributes(['autofocus'])
            ->containerHtmlAttributes(['required']) }}
        {{ bsValidate()->label(__('auth.label.sendEmail'))
            ->componentClasses(['btn', 'btn-block', 'btn-primary', 'spin-on-click']) }}
    </form>
    {{ bsCancel()->route('login') }}
@endsection
