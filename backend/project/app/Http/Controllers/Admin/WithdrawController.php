<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    public function index()
    {
        $curr = Currency::where('default', 1)->first();
        return view('admin.withdraw.index', compact('curr'));
    }

    public function withdrawRequest()
    {
        $withdraws = Withdraw::orderBy('id', 'desc')->paginate(10);
        return view('admin.withdraw.request', compact('withdraws'));
    }

    public function withdrawApprove($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 1;
        $withdraw->save();

        $transaction = new Transaction();
        $transaction->txn_id = Str::random(12);
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->total;
        $transaction->type = "-";
        $transaction->remark = "Withdraw";
        $transaction->created_at = now();
        $transaction->save();

        return redirect()->back()->with('success', 'Withdraw request approved successfully');
    }

    public function withdrawReject($id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 2;
        $withdraw->save();

        
        $user = User::find($withdraw->user_id);
        $user->balance += $withdraw->total;
        $user->save();

        $transaction = new Transaction();
        $transaction->txn_id = Str::random(12);
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->total;
        $transaction->type = "+";
        $transaction->remark = "Withdraw Return";
        $transaction->created_at = now();
        $transaction->save();

        return redirect()->back()->with('success', 'Withdraw request rejected successfully');
    }
}
