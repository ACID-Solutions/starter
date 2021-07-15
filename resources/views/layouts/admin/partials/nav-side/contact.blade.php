<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('contact.page.edit')
        || Brickables::getModelFromRequest()?->unique_key === 'contact_page_content' ? ' active' : null }}"
       href="{{ route('contact.page.edit') }}"
       title="{{ __('Contact Page') }}">
        <i class="fas fa-envelope fa-fw"></i>
        {{ __('Contact Page') }}
    </a>
</li>
