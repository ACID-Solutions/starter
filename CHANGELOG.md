# Changelog

## [1.0.3](https://github.com/ACID-Solutions/starter/compare/1.0.2...1.0.3)

2021-07-15

* Added `RateLimiter` facade => https://github.com/laravel/laravel/releases/tag/v8.5.22

## [1.0.2](https://github.com/ACID-Solutions/starter/compare/1.0.1...1.0.2)

2021-07-12

* Simplified side-menu on admin interface: multiple-levels-tabs with only one submenu have been transformed into single-level-tabs
* Changed Google Analytics tracking system by Matomo tracking by default
* Changed Google Map on contact page by Open Street Map
* Updated `.editorconfig` to follow Laravel standard => https://github.com/laravel/laravel/releases/tag/v8.5.21
* Updated `timezone` and `url` validation => https://github.com/laravel/laravel/releases/tag/v8.5.21
* Updated Sail `Dockerfile` to use Ubuntu 21.04 and to report fixes => https://github.com/laravel/sail/releases/tag/v1.8.4
* Updated composer JSON scripts to allow developers to launch single test instruction rather than the whole test suit every time
* Temporarily removed phpmd from test suit as it is not compatible with PHP 8 yet
* Fixed tests

## [1.0.1](https://github.com/ACID-Solutions/starter/compare/1.0.0...1.0.1)

2021-06-23

* Updated Sail Dockerfile to use node.js v16.x => https://github.com/laravel/sail/releases/tag/v1.8.0
* Upgraded realrashid/sweet-alert package to v4 => https://github.com/realrashid/sweet-alert/releases/tag/v4.0.0
* Added missing translation for current_password rule : https://github.com/laravel/laravel/releases/tag/v8.5.20
* Changed `OneColumnTextOneColumnImage` to `OneTextColumnOneImageColumn` to be consistent with other brickable names
* Inverted `withSeoMeta` method arguments order to position the title as first argument as it is the most used argument

## [1.0.0](https://github.com/ACID-Solutions/starter/releases/tag/1.0.0)

* First release
