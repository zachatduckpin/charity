<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\About;
use App\Models\Feature;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::first();
        $features = Feature::get();
        return view('admin.about.index', compact('about', 'features'));
    }

    public function update(Request $request)
    {

        $about = About::first();

        if (
            isset($request['photo'])
        ) {
            $status = MediaHelper::ExtensionValidation($request['photo']);
            if (!$status) {
                return back()->with('error', 'Please upload a valid image');
            }
            $about->photo = MediaHelper::handleUpdateImage($request['photo'], $about->photo);
        }
        if (
            isset($request['photo2'])
        ) {
            $status = MediaHelper::ExtensionValidation($request['photo2']);
            if (!$status) {
                return back()->with('error', 'Please upload a valid image');
            }
            $about->photo2 = MediaHelper::handleUpdateImage($request['photo2'], $about->photo2);
        }

        if (
            isset($request['photo3'])
        ) {
            $status = MediaHelper::ExtensionValidation($request['photo3']);
            if (!$status) {
                return back()->with('error', 'Please upload a valid image');
            }
            $about->photo3 = MediaHelper::handleUpdateImage($request['photo3'], $about->photo3);
        }


        if (
            isset($request['photo4'])
        ) {
            $status = MediaHelper::ExtensionValidation($request['photo4']);
            if (!$status) {
                return back()->with('error', 'Please upload a valid image');
            }
            $about->photo4 = MediaHelper::handleUpdateImage($request['photo4'], $about->photo4);
        }

        if (
            isset($request['backgroud_photo'])
        ) {
            $status = MediaHelper::ExtensionValidation($request['backgroud_photo']);
            if (!$status) {
                return back()->with('error', 'Please upload a valid image');
            }
            $about->backgroud_photo = MediaHelper::handleUpdateImage($request['backgroud_photo'], $about->backgroud_photo);
        }

        $about->header_title = $request->header_title;

        $about->title = $request->title;
        $about->description = $request->description;
        $about->btn_text = $request->btn_text;
        $about->btn_url = $request->btn_url;
        $about->video_id = $request->video_id;
        $about->save();
        return back()->with('success', 'About has been updated');
    }
}
