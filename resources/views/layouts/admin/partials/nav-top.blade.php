<ul id="topnav" class="navbar-nav nav bg-dark flex-column flex-grow-1 align-content-end align-items-end">
    {{-- language --}}
    <li class="nav-item">
        @include('components.common.language.selector', [
            'dropdownLabelClass'    => 'nav-link',
            'dropdownMenuClass'     => 'dropdown-menu-right',
        ])
    </li>
    {{-- top menu --}}
    <li {{ classTag('nav-item', $route === 'user.profile' ? 'active' : null) }}>
        <div class="dropdown">
            <a href=""
               class="dropdown-toggle nav-link"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                <i class="fas fa-user-check fa-fw text-success"></i>
                <span class="d-none d-sm-inline-block">
                    {{ $user->name }}
                </span>
            </a>
            <div {{ classTag('dropdown-menu', 'dropdown-menu-right') }}>
                <a href="{{ route('user.profile.edit') }}"
                   {{ classTag('dropdown-item', 'spin-on-click', $route === 'user.profile' ? 'active' : null) }}
                   title="{{ __('nav.admin.profile') }}">
                    <i class="fas fa-fw fa-user-circle"></i>
                    @lang('nav.admin.profile')
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" class="p-0" action="{{ route('logout') }}" method="POST">
                    @csrf()
                    <button type="submit"
                            class="dropdown-item btn btn-link"
                            title="{{ __('nav.admin.logout') }}"
                            data-confirm="@lang('notifications.message.logout.confirmation')">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        @lang('nav.admin.logout')
                    </button>
                </form>
            </div>
        </div>
    </li>
</ul>
