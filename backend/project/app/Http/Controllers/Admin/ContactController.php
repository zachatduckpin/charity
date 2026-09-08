<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\ContactMessage;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = ContactPage::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email1' => 'required',
            'address' => 'required',
            'phone1' => 'required',
           
        ]);

        $contact = ContactPage::first();
        $contact->title = $request->title;
        $contact->text = $request->text;
        $contact->email1 = $request->email1;
        $contact->email2 = $request->email2;
        $contact->address = $request->address;
        $contact->phone1 = $request->phone1;
        $contact->phone2 = $request->phone2;
        $contact->address = $request->address;
        $contact->map_link = $request->map_link;

        $contact->save();
        return back()->with('success', 'Contact has been updated');
    }

    public function contactMessage()
    {
        $messages = ContactMessage::orderBy('id', 'desc')->paginate(15);
        return view('admin.contact.messages', compact('messages'));
    }
    
    public function contactMessageDelete (Request $request)
    {
        
        $message = ContactMessage::findOrFail($request->id);
        $message->delete();
        return back()->with('success', 'Message has been deleted');
    }
}
