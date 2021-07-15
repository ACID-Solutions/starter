@php
    $libraryMediaCategoriesActive = currentRouteIs('libraryMedia.categories.index')
        || currentRouteIs('libraryMedia.category.create')
        || currentRouteIs('libraryMedia.category.edit');
    $libraryMediaFilesActive = currentRouteIs('libraryMedia.files.index')
        || currentRouteIs('libraryMedia.file.create')
        || currentRouteIs('libraryMedia.file.edit');
    $subMenuActive = $libraryMediaCategoriesActive || $libraryMediaFilesActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
        href="#library-media-menu"
            title="{{ __('Media library') }}"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="library-media-menu">
        <i class="fas fa-photo-video fa-fw"></i>
        {{ __('Media library') }}
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="library-media-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link{{ $libraryMediaCategoriesActive ? ' active' : null }}"
                href="{{ route('libraryMedia.categories.index') }}"
                    title="{{ __('Categories') }}">
                <i class="fas fa-tags fa-fw"></i>
                {{ __('Categories') }}
            </a>
        </li>
        {{-- files --}}
        <li class="nav-item">
            <a class="nav-link{{ $libraryMediaFilesActive ? ' active' : null }}"
               href="{{ route('libraryMedia.files.index') }}"
               title="{{ __('Files') }}">
                    <i class="fas fa-copy fa-fw"></i>
                    {{ __('Files') }}
            </a>
        </li>
    </ul>
</li>
