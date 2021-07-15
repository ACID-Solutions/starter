@php
    $cookieCategoriesActive = currentRouteIs('cookie.categories.index')
        || currentRouteIs('cookie.category.create')
        || currentRouteIs('cookie.category.edit');
    $cookieServicesActive = currentRouteIs('cookie.services.index')
        || currentRouteIs('cookie.service.create')
        || currentRouteIs('cookie.service.edit');
    $subMenuActive = $cookieCategoriesActive || $cookieServicesActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#cookies-menu"
       title="{{ __('Cookies') }}"
       data-bs-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="cookies-menu">
        <i class="fas fa-cookie-bite fa-fw"></i>
        {{ __('Cookies') }}
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="cookies-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- Categories --}}
        <li class="nav-item">
            <a class="nav-link{{ $cookieCategoriesActive ? ' active' : null }}"
               href="{{ route('cookie.categories.index') }}"
               title="{{ __('Categories') }}">
                <i class="fas fa-tags fa-fw"></i>
                {{ __('Categories') }}
            </a>
        </li>
        {{-- Services --}}
        <li class="nav-item">
            <a class="nav-link{{ $cookieServicesActive ? ' active' : null }}"
               href="{{ route('cookie.services.index') }}"
               title="{{ __('Services') }}">
                <i class="fas fa-laptop-code fa-fw"></i>
                {{ __('Services') }}
            </a>
        </li>
    </ul>
</li>
