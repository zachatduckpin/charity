<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeoSettingResource;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{

    public function __construct(SeoSettingResource $resource)
    {
        $this->resource = $resource;
    }

    public function index()
    {
        $seosetting = SeoSetting::first();
        return view('admin.seo.index', compact('seosetting'));
    }

    public function update(Request $request, SeoSetting $seoSetting)
    {

        $this->validate($request, [
            'meta_image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'title' => 'required|max:200',
            'meta_tag' => 'string',
            'meta_description' => 'string',
            'google_analytics' => 'string|max:250',
            'facebook_pixel' => 'string|max:250',
        ]);
        $this->resource->update($request->all(), $seoSetting);
        return redirect()->back()->with('success', 'Seo Setting Updated Successfully');
    }

}
