<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ManageTestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::orderby('id', 'desc')->paginate(15);
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Testimonial());
        return back()->with('success', __('Testimonial added successfully'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->storeData($request, $testimonial, $id);
        return back()->with('success', __('Testimonial updated successfully'));
    }

    public function destroy(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        MediaHelper::handleDeleteImage($testimonial->photo);
        $testimonial->delete();
        return back()->with('success', __('Testimonial deleted successfully'));
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:testimonials,name' . ($id ? ',' . $id : ''),
            'message' => 'required|string',
            'photo' => $id ? '' : 'required|' . 'image|mimes:jpeg,png,jpg|max:2048',
            'rating' => 'nullable'
        ]);

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

        $data->name = $request->name;
        $data->message = $request->message;
        $data->message = $request->message;
        $data->rating = $request->rating;
        $data->save();
    }
}
