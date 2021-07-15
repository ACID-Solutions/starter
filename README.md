<!-- ToDo: Search every `ToDo:` occurrence in starter and customize what needs to be -->
<!-- ToDo: Remove .github directory once the project has been cloned -->
<!-- ToDo: Execute the following actions if your app is not multilingual -->
<!-- * Remove `spatie/laravel-translatable` package -->
<!-- * Remove `codezero/laravel-localized-routes` package -->
<!-- * Remove `codezero/laravel-unique-translation` -->
<!-- * Remove every `:locales` attributes on blade views -->
<!-- * Replace uses of `currentRouteIs` by `Route::is` -->
<!-- * Replace uses of `translatedData` by `data_get` -->
<!-- * Replace uses of `UniqueTranslationRule` by `Unique` -->
<!-- * Remove multilingual handling in factories -->

# Web app prebuilt base on Laravel 8, PHP 8.0 and MySQL 8.0

<!-- ToDo: replace by project badges -->
`<build-status-badge>` `<coverage-report-badge>`

## Team

<!-- ToDo: replace by project team members -->
* Lead dev: [Okipa](https://github.com/Okipa)
* Quality: [Okipa](https://github.com/Okipa)
* Management: [Okipa](https://github.com/Okipa)
* Devs: https://github.com/ACID-Solutions/starter/graphs/contributors

## Table of Contents

* [Installation](#installation)
  * [Requirements](#requirements)
  * [Import and git setup](#import-and-git-setup)
  * [DNS setup](#dns-setup)
  * [Project configuration and dependencies installation](#project-configuration-and-dependencies-installation)
* [Docker](#docker)
* [Database](#database)
* [Building resources](#building-resources)
* [IDE helper](#ide-helper)
* [Testing](#testing)
* [Debugging](#debugging)
* [Changelog](#changelog)

## Installation

### Requirements

* Latest Git stable version
* Latest Composer stable version
* Latest Docker Community Edition stable version: https://docs.docker.com/install
* Latest Node stable version
* Latest Yarn stable version

### Import and git setup

<!-- ToDo: set git repo URL -->
Clone the project from <project-repository-url>.

### DNS setup

Set your project domain resolution in your virtualhost: `sudo vim /etc/hosts`.

<!-- ToDo: Replace `starter.test` by your project local DNS -->
```sh
    # Add these lines in your /etc/hosts file
    127.0.0.1   starter.test
```

### Project configuration and dependencies installation

* `cp .env.example .env`. Then set the environment variables according to your project needs.
* `composer install --no-scripts --ignore-platform-reqs`
* `sail up -d`
* `sail artisan key:generate`
* `sail artisan storage:link`
* `yarn install`
* `yarn upgrade`
* `yarn dev` or `yarn watch`
* `sail composer update`
* `sail artisan migrate:refresh --seed`

## Docker

This project uses a Docker local development environment provided by [Laravel Sail](https://laravel.com/docs/sail).

See how to use it on the [official documentation](https://laravel.com/docs/sail#executing-sail-commands).

## Database

Execute a database reset with the following command: `sail artisan migrate:refresh --seed`. This will execute all migrations and seeds.

## Building resources

Compile all your project resources (mainly sass and javascript) by executing the following commands.
You can run these commands from your docker workspace, Node and Yarn are being installed. However, running them from your host machine will be quicker.

* `yarn dev` (does merge but does not minify resources).
* `yarn prod` (does merge **and** minify).
* `yarn watch` (recompile automatically when a change is being detected in a resource file).

## Previewing emails

Laravel Sail provides Mailhog to intercept and render emails in a web interface.

You can access the Mailhog interface at http://localhost:8025 when Laravel Sail is running.

## IDE helper

To manually generate IDE helper files, run the following command: `sail composer ide-helper`.

## Testing

To launch the project test, run the following command: `sail composer test`.

## Debugging

Laravel Telescope and Laravel Horizon are pre-installed:
* To open the `telescope` dashboard, add `/telescope` to the base URL
* To open the `horizon` dashboard, add `/horizon` to the base URL

## Changelog

See the [CHANGELOG](CHANGELOG.md) for more information on what has been pushed in production.
