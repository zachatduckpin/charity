<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(15);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Blog());
        return back()->with('success', 'New blog has been created');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $this->storeData($request, $blog, $blog->id);
        return back()->with('success', 'Blog has been updated');
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $id,
            'category_id' => 'required|integer',
            'sort_text' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|integer',
        ]);

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category_id = $request->category_id;
        $data->sort_text = $request->sort_text;
        $data->description = clean($request->description);
        $data->status = $request->status;
        if (isset($request['photo'])) {
            $status = MediaHelper::ExtensionValidation($request['photo']);
            if (!$status) {
                return ['errors' => [0 => 'file format not supported']];
            }
            if ($id) {
                $data->photo = MediaHelper::handleUpdateImage($request['photo'], $data->photo);
            } else {
                $data->photo = MediaHelper::handleMakeImage($request['photo']);
            }
        }
        $data->save();
    }

    public function destroy(Blog $blog)
    {
        MediaHelper::handleDeleteImage($blog->photo);
        $comments = BlogComment::where('blog_id', $blog->id)->get();
        foreach ($comments as $comment) {
            $comment->delete();
        }
        $blog->delete();

        return back()->with('success', 'Blog has been deleted');
    }

    public function comment()
    {
        $comments = BlogComment::with('blog')->paginate(15);
        return view('admin.blog.comment', compact('comments'));
    }

    public function commentDelete(BlogComment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment has been deleted');
    }
}
