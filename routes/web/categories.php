<?php

    use App\Http\Controllers\CategoryController;

    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/{category}/sort', [CategoryController::class, 'sort'])->name('category.sort');