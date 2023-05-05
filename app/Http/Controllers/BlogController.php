<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\BlogModel;

class BlogController extends Controller
{
    public function postBlog(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }



        $title = $request->title;
        $body = $request->body;

        // create a new blog post with the given values

        // $post = BlogModel::create([
        //     'title' => $title,
        //     'body' => $body,
        //     'published' => $published,
        // ]);

        $post = new BlogModel();
        $post->title = $title;
        $post->body = $body;
        $status =  $post->save();

        // return a response indicating that the post was created
        if ($status) {
            return response()->json(['message' => 'Blog post created', 'post' => $post, 'success' => $status]);
        } else {
            return response()->json(['message' => 'Something went wrong']);
        }
    }

    public function index()
    {

        return BlogModel::all();
    }

    public function removePost($id)
    {
        $blog = BlogModel::find($id);
        if (!$blog->published) {
            return response()->json(['error' => "Blog post with id ${id} is already removed or doesn't exist"]);
        }
        $blog->published = 0;
        $blog->save();
        return response()->json(['message' => "Blog post with id $id removed", 'blog' => $blog]);
    }


    public function publishPost($id)
    {
        $blog = BlogModel::find($id);
        if ($blog->published) {
            return response()->json(['error' => "Blog post with id ${id} is already published"]);
        }
        $blog->published = 1;
        $blog->save();
        return response()->json(['message' => "Blog post with id $id published", 'blog' => $blog]);
    }
}
