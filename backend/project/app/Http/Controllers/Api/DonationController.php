<?php

namespace App\Http\Controllers\Api;

use App\Models\Donation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DonationController extends ApiController
{
    public function donations(Request $request)
    {
        $txn = $request->txn_id;
        $donations = Donation::with(['owner', 'campaign'])->where('user_id', auth()->id())
            ->when($txn, function ($query) use ($txn) {
                return $query->where('txn_id', $txn);
            })
            ->latest()
            ->paginate(10);
        return $this->sendResponse($donations, 'Donations fetched successfully.');
    }

    public function fundRised(Request $request)
    {
        $txn = $request->txn_id;
        $donations = Donation::with(['owner', 'campaign'])->where('owner_id', auth()->id())
            ->when($txn, function ($query) use ($txn) {
                return $query->where('txn_id', $txn);
            })
            ->latest()
            ->paginate(10);
        return $this->sendResponse($donations, 'Donations fetched successfully.');
    }

    public function transactions(Request $request)
    {
        if ($request->limit) {
            $donations = Transaction::with(['user'])->where('user_id', auth()->id())
                ->latest()
                ->take($request->limit)
                ->get();
            return $this->sendResponse($donations, 'transactions fetched successfully.');
        }

        $txn = $request->txn_id;
        $donations = Transaction::with(['user'])->where('user_id', auth()->id())
            ->when($txn, function ($query) use ($txn) {
                return $query->where('txn_id', $txn);
            })
            ->latest()
            ->paginate(10);
        return $this->sendResponse($donations, 'transactions fetched successfully.');
    }


    

}
