<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Video $video)
    {
        $video->Comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return back()->with('success', __('messages.your_comment_has_been_created'));
    }
}
