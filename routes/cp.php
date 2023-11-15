<?php

use Illuminate\Support\Facades\Route;
use Thoughtco\StatamicCpResources\Http\Controllers\ResourcesController;

Route::name('cpresources.')->group(function () {
    Route::get('resources', ResourcesController::class)->name('index');
});
