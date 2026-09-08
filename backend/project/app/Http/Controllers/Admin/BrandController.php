<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function index()
    {
        $brands = Brand::latest('id')->paginate(15);
        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Brand());
        return back()->with('success', __('Brand added successfully'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $this->storeData($request, $brand, $id);
        return back()->with('success', __('Brand updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
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
        $brand = Brand::findOrFail($request->id);
        MediaHelper::handleDeleteImage($brand->photo);
        $brand->delete();
        return back()->with('success', __('Brand deleted successfully'));
    }
}
