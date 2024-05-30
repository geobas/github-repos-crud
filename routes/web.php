<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/github')->name('repositories.')->group(function () {
    Route::get('/{owner}/{name}', [GitHubController::class, 'show'])->name('show');
    Route::get('/languages/{owner}/{repoName}', [GitHubController::class, 'languages'])->name('languages');
    Route::post('/create/repository', [GitHubController::class, 'create'])->name('create');
    Route::patch('/update/repository', [GitHubController::class, 'update'])->name('update');
    Route::delete('/delete/repository', [GitHubController::class, 'delete'])->name('delete');
});
