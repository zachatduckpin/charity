<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeatureController extends Controller
{

    public function store(Request $request)
    {
        $this->storeData($request, new Feature());
        return back()->with('success', __('Feature added successfully'));
    }

    public function update(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);
        $this->storeData($request, $feature, $id);
        return back()->with('success', __('Feature updated successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data->title = $request->title;
        $data->text = $request->text;
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
        $feature = Feature::findOrFail($request->id);
        MediaHelper::handleDeleteImage($feature->photo);
        $feature->delete();
        return back()->with('success', __('Feature deleted successfully'));
    }
}
