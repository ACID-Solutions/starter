<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShareJavascriptToView
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
    public function handle(Request $request, Closure $next): mixed
    {
        $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
        share([
            'locale' => app()->getLocale(),
            'notify' => __('notify'),
            'gdpr_page_url' => $gdprPage ? route('page.show', $gdprPage) : null,
        ]);

        return $next($request);
    }
}
