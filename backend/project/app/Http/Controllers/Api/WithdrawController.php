<?php

namespace App\Http\Controllers\Api;

use App\Models\Generalsetting;
use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawController extends ApiController
{

    public function getWithdraws(Request $request)
    {

        $txn = $request->txn_id;
        $datas = Withdraw::where('user_id', auth()->id())
            ->when($txn, function ($query) use ($txn) {
                return $query->where('txn_id', $txn);
            })
            ->latest()
            ->paginate(10);

        return $this->sendResponse($datas, 'Withdraws fetched successfully.');
    }

    public function withdrawStore(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'details' => 'required',
        ]);

        $user = auth()->user();
        $gs = Generalsetting::first();

        if ($request->amount < $gs->withdraw_min) {
            return $this->sendError('Minimum withdraw amount is ' . $gs->withdraw_min);
        }

        if ($request->amount > $gs->withdraw_max) {
            return $this->sendError('Maximum withdraw amount is ' . $gs->withdraw_max);
        }

        $total_amount = $request->amount + $gs->withdraw_charge;

        if ($total_amount > $user->balance) {
            return $this->sendError('You do not have enough balance to withdraw');
        }

        $user->balance -= $total_amount;
        $user->save();

        $transaction = new Transaction();
        $transaction->txn_id = Str::random(12);
        $transaction->user_id = $user->id;
        $transaction->amount = $total_amount;
        $transaction->type = "-";
        $transaction->remark = "Withdraw Request";
        $transaction->created_at = now();
        $transaction->save();

        $withdraw = $user->withdraws()->create([
            'amount' => $request->amount,
            'txn_id' => Str::random(12),
            'total' => $total_amount,
            'charge' => $gs->withdraw_charge,
            'details' => $request->details,
            'status' => 0,
        ]);

        return $this->sendResponse($withdraw, 'Withdraw request submitted successfully');
    }
}
