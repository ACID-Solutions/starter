<li class="nav-item">
    {{-- ToDo: replace `currentUrlIs($url)` by `Request::url() === $url` if your app is not multilingual --}}
    <a class="nav-link{{ currentRouteIs('home.page.show') ? ' active' : null }}"
       href="{{ route('home.page.show') }}"
       title="{{ __('Home') }}">
        {{ __('Home') }}
    </a>
</li>
