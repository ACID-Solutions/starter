@extends('layouts.admin.full')
@php
    if(Str::contains(request()->route()->getName(), 'user.create')) {
        $title = __('breadcrumbs.orphan.create', ['entity' => __('Users')]);
        $action = route('user.store');
    }
    if(Str::contains(request()->route()->getName(), 'user.edit')) {
        $title = __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name]);
            $action = route('user.update', $user);
    }
    if(Str::contains(request()->route()->getName(), 'profile.information')) {
        $title = __('Profile information');
        $action = route('user.update', $user);
    }
@endphp
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        {{ $title }}
    </h1>
    <hr>
    <form class="mb-3"
          action="{{ $action }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($user)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Identity')</h3>
                @php($profilePicture = optional($user)->getFirstMedia('profile_pictures'))
                {{ inputFile()->name('profile_picture')
                    ->value(optional($avatar)->file_name)
                    ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $profilePicture]))
                    ->caption((new \App\Models\Users\User)->getMediaCaption('profile_pictures')) }}
                {{ inputText()->name('last_name')->model($user)->containerHtmlAttributes(['required']) }}
                {{ inputText()->name('first_name')->model($user)->containerHtmlAttributes(['required']) }}
                <h3>@lang('Contact')</h3>
                {{ inputEmail()->name('email')->model($user)->containerHtmlAttributes(['required']) }}
                <h3>@lang('Security')</h3>
                @if(Str::contains(request()->route()->getName(), 'user.create'))
                    <p>
                        <i class="fas fa-exclamation-triangle fa-fw text-warning"></i>
                        @lang('If no password is defined for this user, he will be emailed a password creation link.')
                    </p>
                @endif
                {{ inputPassword()->name($user ? 'new_password' : 'password')->caption(__('passwords.fillForUpdate')) }}
                {{ inputPassword()->name($user ? 'new_password_confirmation' : 'password_confirmation')->model($user) }}
                <div class="d-flex pt-4">
                    {{ buttonCancel()->route('users.index')->containerClasses(['mr-2']) }}
                    @if($user){{ submitUpdate() }}@else{{ submitCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
