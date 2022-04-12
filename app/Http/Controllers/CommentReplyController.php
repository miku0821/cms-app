<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReply;
use App\Models\Comment;

class CommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reply' => "required|max:250",
        ]);

        $user = Auth()->user();
        $image = $user->avatar;

        $image = $user->avatar === 'blank-profile-picture.png' ? NULL : $user->avatar;

        CommentReply::create([
            'reply' => $request->reply,
            'user_id' => $user->id,
            'image' => $image,
            'email' => $user->email,
            'comment_id' => $request->comment,
        ]);
        
        session()->flash('reply_creation_status', "You replied to $request->receiver's message");
        return redirect()->to(url()->previous() . "#comment_session");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;

        return view('admin.comments.replies.show', ['replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $reply = CommentReply::findOrFail($id);
        $reply->update($request->all());
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        return back();
    }
}
