@if($url && $active)
    <x-form::button.link class="btn-outline-primary btn-sm" :url="$url" target="_blank">
        <i class="fas fa-external-link-square-alt fa-fw"></i>
        {{ __('Display') }}
    </x-form::button.link>
@endif
