<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('pages.index')
        || currentRouteIs('page.create')
        || currentRouteIs('page.edit')
        || Brickables::getModelFromRequest()?->getMorphClass() === App\Models\Pages\Page::class ? ' active' : null }}"
       href="{{ route('pages.index') }}"
       title="{{ __('Free pages') }}">
        <i class="fas fa-file-alt fa-fw"></i>
        {{ __('Free pages') }}
    </a>
</li>
