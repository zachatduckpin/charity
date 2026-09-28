<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function __invoke(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:all,pending,running,closed'],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));
        $status = $filters['status'] ?? 'all';
        $statusMap = [
            'pending' => 0,
            'running' => 1,
            'closed' => 2,
        ];

        $campaigns = Campaign::query()
            ->with(['category:id,name', 'user:id,username'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($campaignQuery) use ($search) {
                    $campaignQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($status !== 'all', function ($query) use ($statusMap, $status) {
                $query->where('status', $statusMap[$status]);
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.campaigns.index', [
            'campaigns' => $campaigns,
            'filters' => [
                'search' => $search,
                'status' => $status,
            ],
            'summary' => [
                'all' => Campaign::count(),
                'pending' => Campaign::where('status', 0)->count(),
                'running' => Campaign::where('status', 1)->count(),
                'closed' => Campaign::where('status', 2)->count(),
            ],
        ]);
    }
}
