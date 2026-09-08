<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function index(Request $request)
    {
        $txn = $request->txn_id;
        $donations = Donation::with('campaign')
            ->when($txn, function ($query, $txn) {
                return $query->where('txn_id', $txn);
            })
            ->latest()->paginate(12);
        return view('admin.donation.index', compact('donations'));
    }

    public function status($id, $status)
    {
        $donation = Donation::find($id);
        $donation->status = $status;
        $donation->save();
        return back()->with('success', 'Donation status updated successfully');

    }

    public function destroy(Request $request)
    {
        Donation::destroy($request->id);
        return back()->with('success', 'Donation deleted successfully');
    }

}
