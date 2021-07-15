@if (session('status') === 'two-factor-authentication-enabled')
    @php
        alert()->html(__('Success'), __('Two factor authentication has been enabled.'), 'success')->showConfirmButton()
    @endphp
@endif
@if (session('status') === 'recovery-codes-generated')
    @php
        alert()->html(__('Success'), __('Two factor recovery codes have been generated.'), 'success')->showConfirmButton()
    @endphp
@endif
@if (session('status') === 'two-factor-authentication-disabled')
    @php
        alert()->html(__('Success'), __('Two factor authentication has been disabled.'), 'success')->showConfirmButton()
    @endphp
@endif
@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-user fa-fw"></i>
        {{ __('breadcrumbs.orphan.index', ['entity' => __('Profile')]) }}
    </h1>
    <hr>
    <x-common.forms.notice class="mt-3"/>
    <div class="row mb-n3" data-masonry>
        <div class="col-xl-6 mb-3">
            <x-admin.forms.card title="{{ __('Profile Information') }}">
                <p>
                    {{ __('Update your account\'s profile and contact information.') }}
                </p>
                <x-form::form method="PUT"
                              :action="route('user-profile-information.update')"
                              :bind="$user"
                              errorBag="updateProfileInformation"
                              enctype="multipart/form-data">
                    <x-admin.media.thumb :media="$user?->getFirstMedia('profile_pictures')"/>
                    {{-- {{ inputCheckbox()->name('remove_meta_image') }}--}}
                    <x-form::input type="file"
                                   name="profile_picture"
                                   :caption="app(App\Models\Users\User::class)->getMediaCaption('profile_pictures')"/>
                    <x-form::input name="last_name" autocomplete="family-name" required/>
                    <x-form::input name="first_name" autocomplete="given-name" required/>
                    <x-form::input type="tel" name="phone_number" autocomplete="tel"/>
                    <x-form::input type="email" name="email" autocomplete="email" required/>
                    <x-form::button.submit>
                        <i class="fas fa-save fa-fw"></i>
                        {{ __('Save') }}
                    </x-form::button.submit>
                </x-form::form>
            </x-admin.forms.card>
        </div>
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Update Password') }}" errorBag="updatePassword">
                    <p>
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                    <x-form::form method="PUT" :action="route('user-password.update')">
                        <x-form::input type="password" name="current_password" autocomplete="current-password" required/>
                        <x-form::input type="password" name="new_password" autocomplete="new-password" data-password-strength-meter required/>
                        <x-form::input type="password" name="new_password_confirmation" autocomplete="new-password" required/>
                        <x-form::button.submit>
                            <i class="fas fa-save fa-fw"></i>
                            {{ __('Save') }}
                        </x-form::button.submit>
                    </x-form::form>
                </x-admin.forms.card>
            </div>
        @endif
        @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Two Factor Authentication') }}">
                    @if($user->two_factor_secret)
                        <h5 class="card-title">
                            {{ __('You have enabled two factor authentication.') }}
                        </h5>
                    @else
                        <h5 class="card-title">
                            {{ __('You have not enabled two factor authentication.') }}
                        </h5>
                    @endif
                    <p>
                        {{ __('Add additional security to your account using two factor authentication.') }}
                    </p>
                    <p>
                        {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                    </p>
                    @if($user->two_factor_secret)
                        <div class="my-3">
                            <p>
                                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                            </p>
                            <div>
                                {!! $user->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                        <div class="my-3">
                            <p>
                                {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                            </p>
                            <pre class="bg-light p-3 small">@foreach ($user->recoveryCodes() as $code)<div>{{ $code }}</div>@endforeach</pre>
                        </div>
                        <div class="d-flex mt-3">
                            <x-form::form method="POST" :action="route('two-factor.recovery-codes')">
                                <x-form::button.submit class="btn-secondary" data-confirm="{{ __('Are you sure you want to regenerate recovery codes?') }}">
                                    <i class="fas fa-redo fa-fw"></i>
                                    {{ __('Regenerate Recovery Codes') }}
                                </x-form::button.submit>
                            </x-form::form>
                            <x-form::form class="ms-3" method="DELETE" :action="route('two-factor.disable')">
                                <x-form::button.submit class="btn-danger" data-confirm="{{ __('Are you sure you want to disable two factor authentication?') }}">
                                    <i class="fas fa-ban fa-fw"></i>
                                    {{ __('Disable') }}
                                </x-form::button.submit>
                            </x-form::form>
                        </div>
                    @else
                        <x-form::form method="POST" :action="route('two-factor.enable')">
                            <x-form::button.submit class="btn-success" data-confirm="{{ __('Are you sure you want to enable two factor authentication?') }}">
                                <i class="fas fa-check fa-fw"></i>
                                {{ __('Enable') }}
                            </x-form::button.submit>
                        </x-form::form>
                    @endif
                </x-admin.forms.card>
            </div>
        @endif
        <div class="col-xl-6 mb-3">
            <x-admin.forms.card title="{{ __('Delete Account') }}">
                <h5 class="card-title text-danger">
                    <i class="fas fa-exclamation-triangle fa-fw text-danger"></i>
                    {{ __('Beware, this action is irreversible.') }}
                </h5>
                <p>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
                <x-form::form method="POST" :action="route('profile.deleteAccount')" errorBag="deleteAccount">
                    <x-form::input type="password" name="password" autocomplete="current-password" required/>
                    <x-form::button.submit class="btn-danger" data-confirm="{{ __('Are you sure you want to delete your account?') }}">
                        <i class="fas fa-trash fa-fw"></i>
                        {{ __('Delete Account') }}
                    </x-form::button.submit>
                </x-form::form>
            </x-admin.forms.card>
        </div>
    </div>
@endsection
