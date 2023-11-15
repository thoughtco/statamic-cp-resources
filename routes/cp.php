<?php

use Illuminate\Support\Facades\Route;
use Thoughtco\StatamicCpresources\Http\Controllers\ResourcesController;

Route::name('cpresources.')->group(function () {
    Route::get('resources', ResourcesController::class)->name('index');
});
