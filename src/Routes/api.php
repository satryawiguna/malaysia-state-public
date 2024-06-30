<?php

use Bersian\MalaysiaState\Http\Controllers\Api\MalaysiaStateController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::group(['prefix' => 'malaysia-states', 'namespace' => '\Bersian\MalaysiaState\Http\Controllers\Api'], function () {
        Route::get('/', [MalaysiaStateController::class, 'list'])->name('get.api.malaysia-state');
        Route::post('/search', [MalaysiaStateController::class, 'search'])->name('post.api.malaysia-state.search');
        Route::post('/search/page', [MalaysiaStateController::class, 'pagination'])->name('post.api.malaysia-state.search.page');
    });
});
