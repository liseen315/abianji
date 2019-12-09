<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\SocialiteUser;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(15);
        foreach ($comments as $comment) {
            $comment['nick_name'] = SocialiteUser::where('openid', $comment->socialite_user_id)->first()->nick_name;
        }
        return view('admin.comment.index', compact('comments'));
    }

    public function users() {
        $users = SocialiteUser::orderBy('created_at','desc')->simplePaginate(15);

        return view('admin.comment.users',compact('users'));
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment.index')->with('success', '删除评论成功');
    }
}
