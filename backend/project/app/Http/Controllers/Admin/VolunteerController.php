<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{



    public function background()
    {
        return view('admin.volunteer.background');
    }

    public function index()
    {
        $volunteers = Volunteer::orderby('id', 'desc')->paginate(15);
        return view('admin.volunteer.index', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteer.create');
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Volunteer());
        return redirect()->route("admin.volunteer.index")->with('success', 'New Volunteer has been created');
    }

    public function edit($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $this->storeData($request, $volunteer, $volunteer->id);
        return redirect()->route("admin.volunteer.index")->with('success', 'Volunteer has been updated');
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->instagram = $request->instagram;
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


    function status($id, $status)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = $status;
        $volunteer->save();
        return back()->with('success', 'Volunteer status has been updated');
    }

    public function destroy(Request $request)
    {
        $volunteer = Volunteer::findOrFail($request->id);

        MediaHelper::handleDeleteImage($volunteer->photo);
        $volunteer->delete();
        return back()->with('success', 'Volunteer has been deleted');
    }
}
