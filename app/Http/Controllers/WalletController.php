<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::orderBy('start_date', 'desc')->paginate(8);
        $wallet_sum = Wallet::sum('amount');
        return view('wallets.index', compact('wallets', 'wallet_sum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request)
    {
        $amount = $request->input('amount');
        Wallet::create([
            "amount" => $request->dropDownIncome ? abs($amount) : -abs($amount),
            "start_date" => $request->get('start_date'),
            "dropDownIncome" => $request->get('dropDownIncome'),
            "dropDownExpense" => $request->get('dropDownExpense'),
        ]);
        return redirect()->route('wallets.index');
    }

    public function show (Wallet $wallet)
    {
        return view('wallets.show', compact('wallet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        return view('wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        $dropDownIncome = $request->input('dropDownIncome');
        $dropDownExpense = $request->input('dropDownExpense');

        $wallet->update([
            'amount' => $request->input('amount'),
            'start_date' => $request->input('start_date'),
            'dropDownIncome' => $dropDownIncome ?: $wallet->dropDownIncome,
            'dropDownExpense' => $dropDownExpense ?: $wallet->dropDownExpense,
        ]);

        return redirect()->route('wallets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect(route('wallets.index'));
    }

    /**
     * Export wallets to an Excel file.
     */
}
