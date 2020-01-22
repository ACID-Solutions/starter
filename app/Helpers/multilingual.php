<?php

if (! function_exists('multilingual')) {
    /**
     * @return bool
     */
    function multilingual(): bool
    {
        return count(supportedLocaleKeys()) > 1;
    }
}

if (! function_exists('supportedLocales')) {
    /**
     * @return array
     */
    function supportedLocales(): array
    {
        $locales = [];
        foreach (supportedLocaleKeys() as $localeKey) {
            $locales[$localeKey] = config('localized-routes.locales')[$localeKey];
        }

        return $locales;
    }
}

if (! function_exists('supportedLocaleKeys')) {
    /**
     * @return array
     */
    function supportedLocaleKeys(): array
    {
        return config('localized-routes.supported-locales');
    }
}

if (! function_exists('currentLocale')) {
    /**
     * @return array|string
     */
    function currentLocale()
    {
        return supportedLocales()[app()->getLocale()];
    }
}

if (! function_exists('translate')) {
    /**
     * @param array $data
     * @param string|null $locale
     *
     * @return array|string
     */
    function translate(?array $data = [], string $locale = null)
    {
        return multilingual() ? data_get($data, $locale ?: app()->getLocale()) : $data;
    }
}
