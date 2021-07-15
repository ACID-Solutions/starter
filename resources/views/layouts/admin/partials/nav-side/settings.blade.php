<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('settings.edit') ? ' active' : null }}"
       href="{{ route('settings.edit') }}"
       title="{{ __('Settings') }}">
        <i class="fas fa-cogs fa-fw"></i>
        {{ __('Settings') }}
    </a>
</li>
