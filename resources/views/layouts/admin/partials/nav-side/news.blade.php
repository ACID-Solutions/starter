@php
    $newsPageActive = currentRouteIs('news.page.edit')
        || Brickables::getModelFromRequest()?->unique_key === 'news_page_content';
    $newsCategoriesActive = currentRouteIs('news.categories.index')
        || currentRouteIs('news.category.create')
        || currentRouteIs('news.category.edit');
    $newsArticlesActive = currentRouteIs('news.articles.index')
        || currentRouteIs('news.article.create')
        || currentRouteIs('news.article.edit');
    $subMenuActive = $newsPageActive
        || $newsArticlesActive
        || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#news-menu"
       title="{{ __('News') }}"
       data-bs-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="news-menu">
        <i class="fas fa-newspaper fa-fw"></i>
        {{ __('News') }}
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="news-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsPageActive ? ' active' : null }}"
               href="{{ route('news.page.edit') }}"
               title="{{ __('Page') }}">
                <i class="fas fa-desktop fa-fw"></i>
                {{ __('Page') }}
            </a>
        </li>
        {{-- Categories --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsCategoriesActive ? ' active' : null }}"
               href="{{ route('news.categories.index') }}"
               title="{{ __('Categories') }}">
                <i class="fas fa-tags fa-fw"></i>
                {{ __('Categories') }}
            </a>
        </li>
        {{-- Articles --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsArticlesActive ? ' active' : null }}"
               href="{{ route('news.articles.index') }}"
               title="{{ __('Articles') }}">
                <i class="fas fa-paper-plane fa-fw"></i>
                {{ __('Articles') }}
            </a>
        </li>
    </ul>
</li>
