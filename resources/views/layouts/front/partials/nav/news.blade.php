<li class="nav-item{{ currentRouteIs('news') || currentRouteIs('news.show') ? ' active' : null }}">
    <a class="nav-link"
       href="{{ route('news') }}"
       title="@lang('News')">
        @lang('News')
    </a>
</li>
