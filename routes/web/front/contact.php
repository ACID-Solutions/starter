<?php

use App\Http\Controllers\Front\ContactPageController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get(
    '/contact',
    [ContactPageController::class, 'show']
)->name('contact');
Route::post(
    '/contact/message/send',
    [ContactPageController::class, 'sendMessage']
)->name('contact.sendMessage')->middleware(ProtectAgainstSpam::class);
