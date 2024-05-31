<?php

use App\Http\Controllers\GitHubCrudController;
use App\Http\Controllers\GitHubLanguagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/github')->name('repositories.')->group(function () {
    Route::get('/{owner}/{name}', [GitHubCrudController::class, 'show'])->name('show');
    Route::get('/languages/{owner}/{repoName}', GitHubLanguagesController::class)->name('languages');
    Route::post('/create/repository', [GitHubCrudController::class, 'create'])->name('create');
    Route::patch('/update/repository', [GitHubCrudController::class, 'update'])->name('update');
    Route::delete('/delete/repository', [GitHubCrudController::class, 'delete'])->name('delete');
});
