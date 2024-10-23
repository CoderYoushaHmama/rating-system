<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostRequest;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Get Posts Page Function
    public function getPostsPage(Request $request)
    {
        $user = Auth::guard('user')->user();
        if ($request->filter == 'yours') {
            $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->get();
        }

        return view('posts.posts', compact('user', 'posts'));
    }

    //Add Post Function
    public function addPost(AddPostRequest $addPostRequest)
    {
        $user = Auth::guard('user')->user();
        if ($addPostRequest->file('image')) {
            $path = $addPostRequest->file('image')->storePublicly('PostsImages', 'public');
        }
        Post::create([
            'user_id' => $user->id,
            'description' => $addPostRequest->description,
            'image' => 'storage/' . $path,
        ]);
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' published a post',
            'type' => 'insert',
        ]);

        return redirect()->back()->with('success', 'your post published successfully');
    }

    //Edit Post Finction
    public function editPost(Post $post, Request $request)
    {
        $user = Auth::guard('user')->user();
        $request->validate([
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
            $path = $request->file('image')->storePublicly('PostsImages', 'public');
            $post->update([
                'image' => 'storage/' . $path,
            ]);
        }
        $post->update([
            'description' => $request->description,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' edited his post information',
            'type' => 'update',
        ]);

        return redirect()->back()->with('success', 'your post updated successfully');
    }

    //Delete Post Function
    public function deletePost(Post $post)
    {
        $user = Auth::guard('user')->user();
        if (File::exists($post->image)) {
            File::delete($post->image);
        }
        $post->delete();
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' deleted his post',
            'type' => 'delete',
        ]);

        return redirect()->back()->with('success', 'your post deleted successfully');
    }
}