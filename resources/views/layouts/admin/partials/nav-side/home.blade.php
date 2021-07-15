<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('home.page.edit')
        || Brickables::getModelFromRequest()?->unique_key === 'home_page_content'
        || currentRouteIs('brick.carousel.slide.create')
        || currentRouteIs('brick.carousel.slide.edit') ? ' active' : null }}"
       href="{{ route('home.page.edit') }}"
       title="{{ __('Home Page') }}">
        <i class="fas fa-home fa-fw"></i>
        {{ __('Home Page') }}
    </a>
</li>
