@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        @if($user)
            {{ __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name]) }}
        @else
            {{ __('breadcrumbs.orphan.create', ['entity' => __('Users')]) }}
        @endif
    </h1>
    <hr>
    <x-form::form :method="$user ? 'PUT' : 'POST'"
          :action="$user ? route('user.update', $user) : route('user.store')"
          :bind="$user"
          enctype="multipart/form-data">
        <div class="d-flex">
            <x-form::button.link class="btn-secondary me-3" :href="route('users.index'">
                <i class="fas fa-undo fa-fw"></i>
                {{ __('Back') }}
            </x-form::button.link>
            <x-form::button.submit>
                <i class="fas fa-save fa-fw"></i>
                {{ __('Save') }}
            </x-form::button.submit>
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Civil status') }}">
                    <x-admin.media.thumb :media="$user?->getFirstMedia('profile_pictures')"/>
                    {{-- {{ inputCheckbox()->name('remove_profile_pictures') }}--}}
                    <x-form::input type="file"
                           name="profile_picture"
                           :caption="app(App\Models\Users\User::class)->getMediaCaption('profile_pictures')"/>
                    <x-form::input name="last_name" required/>
                    <x-form::input name="first_name" required/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Contact') }}">
                    <x-form::input type="tel" name="phone_number"/>
                    <x-form::input type="email" name="email" autocomplete="email" required/>
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Security') }}">
                    <p>
                        @if(currentRouteIs('user.create'))
                            <i class="fas fa-exclamation-triangle fa-fw text-warning"></i>
                            {{ __('If no password is defined for this user, he will be emailed a password creation link.') }}
                        @else
                            {{ __('Only fill if you want to change the current password.') }}
                        @endif
                    </p>
                    <x-form::input type="password" :name="$user ? 'new_password' : 'password'" value="" data-password-strength-meter/>
                    <x-form::input type="password" :name="$user ? 'new_password_confirmation' : 'password_confirmation'" value=""/>
                </x-admin.forms.card>
            </div>
        </div>
    </x-form::form>
@endsection
