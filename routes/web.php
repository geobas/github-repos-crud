<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/github/{owner}/{name}', [GitHubController::class, 'show'])->name('ebay_settings.index');
