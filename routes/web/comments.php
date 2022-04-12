<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\CommentController;
    use App\Http\Controllers\CommentReplyController;

    Route::resource('/comments', CommentController::class);
    Route::resource('/comments/replies',CommentReplyController::class);
?>