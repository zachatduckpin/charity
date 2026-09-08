<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaHelper;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::latest()->paginate(15);
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $this->storeData($request, new Event());
        return back()->with('success', 'New event has been created');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $this->storeData($request, $event, $event->id);
        return back()->with('success', 'Event has been updated');
    }

    public function storeData($request, $data, $id = null)
    {
        $photo = $id ? '' : 'required';
        $request->validate([
            'title' => 'required|string|max:255|unique:events,title,' . $id,
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'event_type' => 'required|string',
            'organizar_name' => 'required|string',
            'description' => 'required|string',
            'photo' => $photo . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|integer',
        ]);

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->date = $request->date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->event_type = $request->event_type;
        $data->event_link = $request->event_link;
        $data->event_location = $request->event_location;
        $data->organizar_name = $request->organizar_name;
        $data->organizar_email = $request->organizar_email;
        $data->organizar_phone = $request->organizar_phone;
        $data->website = $request->website;
        $data->map_link = $request->map_link;
        $data->description =  clean($request->description);
        $data->status = $request->status;
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

    public function destroy(Request $request)
    {
        $event = Event::findOrFail($request->id);
        MediaHelper::handleDeleteImage($event->photo);
        $event->delete();

        return back()->with('success', 'Event has been deleted');
    }

}
