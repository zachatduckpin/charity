<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function __invoke(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:all,yes,no'],
        ]);

        $search = trim((string) ($filters['search'] ?? ''));
        $status = $filters['status'] ?? 'all';

        $donations = Donation::query()
            ->with(['campaign:id,slug,title', 'owner:id,username'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($donationQuery) use ($search) {
                    $donationQuery
                        ->where('txn_id', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('campaign_slug', 'like', "%{$search}%");
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status === 'yes' ? 1 : 0);
            })
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.donations.index', [
            'donations' => $donations,
            'filters' => [
                'search' => $search,
                'status' => $status,
            ],
            'summary' => [
                'all' => Donation::count(),
                'yes' => Donation::where('status', 1)->count(),
                'no' => Donation::where('status', 0)->count(),
            ],
        ]);
    }
}
