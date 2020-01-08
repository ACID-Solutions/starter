<?php

use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use Symfony\Component\HttpKernel\Exception\HttpException;

// localized ***********************************************************************************************************
Route::localized(function () {
    // auth
    require('web/auth/login.php');
    require('web/auth/password.php');
    require('web/auth/register.php'); // todo : comment if this feature is not needed
    require('web/auth/verification.php'); // todo : uncomment if this feature is not needed
    require('web/auth/welcome.php');
    // admin
    Route::prefix('admin')->middleware([
        'auth',
        'verified', // todo : comment if this feature is not needed
    ])->group(function () {
        require('web/admin/admin.php');
        require('web/admin/dashboard.php');
        require('web/admin/home.php');
        require('web/admin/news.php');
        require('web/admin/contact.php');
        require('web/admin/simplePages.php');
        require('web/admin/libraryMedia.php');
        // password reconfirm protection
        Route::middleware(['password.confirm'])->group(function () {
            require('web/admin/users.php');
            require('web/admin/settings.php');
        });
    });
    // front
    require('web/front/home.php');
    require('web/front/news.php');
    require('web/front/contact.php');
    require('web/front/simplePages.php');
});

// not localized *******************************************************************************************************
// utils
require('web/utils/seo.php');
require('web/utils/download.php');

// 404 fallback catch : do not not place any route declaration under this one ******************************************
Route::fallback(function () {
    return response()->view('errors.default', ['exception' => new HttpException(404)], 404);
})->middleware(SetLocale::class)->name('404');
