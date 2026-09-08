<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $datas = Faq::orderBy('id', 'desc')->get();
        return view('admin.faq.index', compact('datas'));
    }
    public function faqImage()
    {
        return view('admin.faq.image');
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
        ]);
        $faq = new Faq();
        $faq->title = $request->title;
        $faq->details = $request->details;
        $faq->save();

        return back()->with('success', 'FAQ created successfully');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'details' => 'required',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->title = $request->title;
        $faq->details = $request->details;
        $faq->save();

        return back()->with('success', 'FAQ updated successfully'); 
    }

    public function destroy(Request $request)
    {
        $faq = Faq::findOrFail($request->id);
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully');
    }
}
