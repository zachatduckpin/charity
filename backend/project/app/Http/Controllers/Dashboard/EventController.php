<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __invoke(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:all,active,inactive'],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));
        $status = $filters['status'] ?? 'all';

        $events = Event::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($eventQuery) use ($search) {
                    $eventQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('event_type', 'like', "%{$search}%")
                        ->orWhere('event_location', 'like', "%{$search}%")
                        ->orWhere('organizar_name', 'like', "%{$search}%")
                        ->orWhere('organizar_email', 'like', "%{$search}%");
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status === 'active' ? 1 : 0);
            })
            ->latest('date')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.events.index', [
            'events' => $events,
            'filters' => [
                'search' => $search,
                'status' => $status,
            ],
            'summary' => [
                'all' => Event::count(),
                'active' => Event::where('status', 1)->count(),
                'inactive' => Event::where('status', 0)->count(),
                'online' => Event::where('event_type', 'online')->count(),
            ],
        ]);
    }
}
