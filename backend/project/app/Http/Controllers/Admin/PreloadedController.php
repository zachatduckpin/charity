<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preloaded;
use Illuminate\Http\Request;

class PreloadedController extends Controller
{
    public function index()
    {
        $preloadeds = Preloaded::get();
        return view('admin.preloaded.index', compact('preloadeds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $preloaded = new Preloaded();
        $preloaded->amount = adminStore($request->amount);
        $preloaded->save();

        return redirect()->route('admin.preloaded.index')->with('success', 'Data has been saved successfully!');
    }


    public function update(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $preloaded = Preloaded::find($request->id);
        $preloaded->amount = adminStore($request->amount);
        $preloaded->save();

        return redirect()->route('admin.preloaded.index')->with('success', 'Data has been updated successfully!');
    }

    public function destroy(Request $request)
    {
        $preloaded = Preloaded::find($request->id);
        $preloaded->delete();
        return redirect()->route('admin.preloaded.index')->with('success', 'Data has been deleted successfully!');
    }
}
