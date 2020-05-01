<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get(
    Lang::uri('dashboard'),
    [DashboardController::class, 'index']
)->name('dashboard.index');
