<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment_id',
        'reply',
        'email',
        'is_active',
        'image',
    ];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
