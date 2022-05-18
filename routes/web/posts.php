<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PostController;

    // posts route
    Route::get('/post/{post}', [PostController::class, 'show'])->name('post');
    Route::post('/post/search', [PostController::class, 'searchByContent'])->name('posts.search');
    Route::post('/post/author/search', [PostController::class, 'searchByAuthor'])->name('posts.author.search');

    Route::middleware(['auth'])->group(function(){
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::patch('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
    });

