<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class ManageCurrencyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $currencies = Currency::get();
        return view('admin.currency.index', compact('currencies', 'search'));
    }

    public function addCurrency()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:4',
            'symbol' => 'required|unique:currencies',
            'value' => 'required|gt:0',
            'status' => 'required|in:1,0',
        ]);

        $currency = new Currency();
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->value = $request->value;
        $currency->status = $request->status;
        $currency->default = $request->default;
        $currency->save();
        return back()->with('success', 'New currency has been added');
    }

    public function editCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit', compact('currency'));
    }

    public function updateCurrency(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:4',
            'symbol' => 'required',
            'value' => 'required|gt:0',
            'default' => 'in:1,0',
            'status' => 'required|in:1,0',
        ]);

        $curr = Currency::findOrFail($id);
        $curr->code = $request->code;
        $curr->symbol = $request->symbol;
        $curr->value = $request->value;
        $curr->status = $request->status;
        $curr->save();

        if ($request->default == 1) {
            if ($curr->status == 0) {
                return back()->with('error', 'Please active currency first');
            }
            $curr->default = 1;
            $curr->save();
            $currencies = Currency::where('id', '!=', $curr->id)->get();
            foreach ($currencies as $currency) {
                $currency->default = 0;
                $currency->save();
            }
        }

        return back()->with('success', 'Currency has been updated');
    }

    public function deleteCurrency(Request $request)
    {
        $curr = Currency::findOrFail($request->id);
        if ($curr->default == 1) {
            return back()->with('error', 'Default currency can not be deleted');
        }
        $curr->delete();
        return back()->with('success', 'Currency has been deleted');
    }

}
