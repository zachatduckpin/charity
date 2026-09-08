<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderby('id', 'desc')->paginate(15);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->storeData($request, new Category());
        return back()->with('success', __('Category added successfully'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $this->storeData($request, $category, $id);
        return back()->with('success', __('Category updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status;
        if ($id) {
            if ($request->photo) {
                $data->photo = MediaHelper::handleUpdateImage($request->photo, $data->photo);
            }
        } else {
            if ($request->photo) {
                $data->photo = MediaHelper::handleMakeImage($request->photo);
            }
        }
        $data->save();
    }

    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        MediaHelper::handleDeleteImage($category->photo);
        $category->delete();
        return back()->with('success', __('Category deleted successfully'));
    }
}
