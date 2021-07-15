{{-- Todo: remove this component if your app is not multilingual --}}
<li class="nav-item">
    @include('components.common.multilingual.lang-switcher', [
        'dropdownLabelIconClasses' => ['text-success'],
        'dropdownLabelClasses' => ['nav-link'],
        'dropdownMenuClasses' => ['dropdown-menu-end'],
    ])
</li>
