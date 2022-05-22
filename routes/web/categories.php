<?php

    use App\Http\Controllers\CategoryController;


    Route::middleware('auth', 'role:admin')->group(function(){
        Route::resource('/categories', CategoryController::class);
    });
   
    Route::get('/categories/{category}/sort', [CategoryController::class, 'sort'])->name('category.sort');