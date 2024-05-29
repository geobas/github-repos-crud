<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/github/{owner}/{name}', [GitHubController::class, 'show'])->name('repository.show');
Route::get('/github/languages/{owner}/{repoName}', [GitHubController::class, 'languages'])->name('repository.languages');
