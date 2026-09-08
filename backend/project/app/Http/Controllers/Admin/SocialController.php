<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $socails = SocialLink::all();
        return view('admin.generalsetting.social', compact('socails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'name' => 'required',
            'icon' => 'required',
        ]);

        $social = new SocialLink;
        $social->link = $request->link;
        $social->name = $request->name;
        $social->icon = $request->icon;
        $social->save();
        return back()->with('success', 'Social Link Added Successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'name' => 'required',
            'icon' => 'required',
        ]);

        $social = SocialLink::findOrFail($request->id);
        $social->link = $request->link;
        $social->name = $request->name;
        $social->icon = $request->icon;
        $social->save();
        return back()->with('success', 'Social Link Updated Successfully!');
    }

    public function destroy(Request $request)
    {
        $social = SocialLink::findOrFail($request->id);
        $social->delete();
        return back()->with('success', 'Social Link Deleted Successfully!');
    }
}
