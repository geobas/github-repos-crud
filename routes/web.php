<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/github')->name('repositories.')->group(function () {
    Route::get('/{owner}/{name}', [GitHubController::class, 'show'])->name('show');
    Route::get('/languages/{owner}/{repoName}', [GitHubController::class, 'languages'])->name('languages');
    Route::post('/create/repository', [GitHubController::class, 'create'])->name('languages');
});
