<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Choose;
use Illuminate\Http\Request;

class ChooseUsController extends Controller
{

    public function index()
    {
        $chooses = Choose::orderby('id', 'desc')->paginate(15);
        return view('admin.service.choose.index', compact('chooses'));
    }

    public function create()
    {
        return view('admin.choose.create');
    }

    public function store(Request $request)
    {
        $this->storeData($request, null);
        return back()->with('success', 'New choose has been created');
    }

    public function edit($id)
    {
        $choose = Choose::findOrFail($id);
        return view('admin.choose.edit', compact('choose'));
    }

    public function update(Request $request, $id)
    {
        $this->storeData($request, $id);
        return back()->with('success', 'choose has been updated');
    }

    public function destroy(Request $request)
    {
        $choose = Choose::findOrFail($request->id);
        MediaHelper::handleDeleteImage($choose->photo);
        $choose->delete();

        return back()->with('success', 'choose has been deleted');
    }

    public function storeData($request, $id)
    {
        $request->validate([
            'title' => 'required',
            'photo' => $id ? '' : 'required|' . 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($id) {
            $choose = Choose::findOrFail($id);
        } else {
            $choose = new Choose();
        }
        if (isset($request['photo'])) {
            $status = MediaHelper::ExtensionValidation($request['photo']);
            if (!$status) {
                return ['errors' => [0 => 'file format not supported']];
            }
            if ($id) {
                $choose->photo = MediaHelper::handleUpdateImage($request['photo'], $choose->photo);
            } else {
                $choose->photo = MediaHelper::handleMakeImage($request['photo']);
            }
        }

        $choose->title = $request->title;
        $choose->text = $request->text;

        $choose->save();
    }
}
