<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('news.page.show') || currentRouteIs('news.article.show') ? ' active' : null }}"
       href="{{ route('news.page.show') }}"
       title="{{ __('News') }}">
        {{ __('News') }}
    </a>
</li>
