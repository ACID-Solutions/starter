<footer id="footer" class="navbar navbar-expand navbar-light bg-light py-3">
    <div class="container">
        <ul class="navbar-nav d-flex flex-fill flex-wrap justify-content-center justify-content-md-between">
            <li class="nav-item d-flex align-items-center">
                <a class="nav-link{{ currentUrlIs(route('home.page.show')) ? ' active' : null }}"
                   href="{{ route('home.page.show') }}"
                   title="{{ config('app.name') }}">
                    <i class="fas fa-copyright fa-fw"></i>
                    {{ config('app.name') }}
                </a>
            </li>
            @if($termsOfServicePage = pages()->where('unique_key', 'terms_of_service_page')->first())
                <li class="nav-item d-flex align-items-center">
                    {{-- ToDo: replace `currentUrlIs($url)` by `Request::url() === $url` if your app is not multilingual --}}
                    <a class="nav-link{{ currentUrlIs(route('page.show', $termsOfServicePage)) ? ' active' : null }}"
                       href="{{ route('page.show', $termsOfServicePage) }}"
                       title="{{ $termsOfServicePage->nav_title }}">
                        {{ $termsOfServicePage->nav_title }}
                    </a>
                </li>
            @endif
            @if($gdprPage = pages()->where('unique_key', 'gdpr_page')->first())
                <li class="nav-item d-flex align-items-center">
                    {{-- ToDo: replace `currentUrlIs($url)` by `Request::url() === $url` if your app is not multilingual --}}
                    <a class="nav-link{{ currentUrlIs(route('page.show', $gdprPage)) ? ' active' : ' text-body' }}"
                       href="{{ route('page.show', $gdprPage) }}"
                       title="{{ $gdprPage->nav_title }}">
                        {{ $gdprPage->nav_title }}
                    </a>
                </li>
            @endif
            <li class="nav-item d-flex align-items-center">
                @if($facebookUrl = settings()->facebook_url)
                    <a class="nav-link" href="{{ $facebookUrl }}" title="{{ __('Facebook') }}" target="_blank" rel="noopener">
                        <i class="fab fa-facebook fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($twitterUrl = settings()->twitter_url)
                    <a class="nav-link" href="{{ $twitterUrl }}" title="{{ __('Twitter') }}" target="_blank" rel="noopener">
                        <i class="fab fa-twitter fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($instagramUrl = settings()->instagram_url)
                    <a class="nav-link" href="{{ $instagramUrl }}" title="{{ __('Instagram') }}" target="_blank" rel="noopener">
                        <i class="fab fa-instagram fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($youtubeUrl = settings()->youtube_url)
                    <a class="nav-link" href="{{ $youtubeUrl }}" title="{{ __('Youtube') }}" target="_blank" rel="noopener">
                        <i class="fab fa-youtube fa-2x fa-fw"></i>
                    </a>
                @endif
            </li>
        </ul>
    </div>
</footer>
