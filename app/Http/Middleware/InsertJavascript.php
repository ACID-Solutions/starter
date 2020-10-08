<?php

namespace App\Http\Middleware;

use Closure;

class InsertJavascript
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
        share([
            'locale' => app()->getLocale(),
            'sweetalert' => __('sweetalert'),
            'cookieConsent' => __('cookieconsent'),
            'sumoSelect' => __('sumoselect'),
            'gdprPage' => ['route' => $gdprPage ? route('page.show', $gdprPage) : null],
        ]);

        return $next($request);
    }
}
