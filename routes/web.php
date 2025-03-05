<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WalletExportController;
use Illuminate\Support\Facades\Route;

Route::get('wallets', [WalletController::class, 'index'])->name('wallets.index');
Route::get('wallets/create', [WalletController::class, 'create'])->name('wallets.create');
Route::get('wallets/{wallet:id}', [WalletController::class, 'show'])->name('wallets.show');
Route::post('wallets', [WalletController::class, 'store'])->name('wallets.store');
Route::get('wallets/{wallet}/edit', [WalletController::class, 'edit'])->name('wallets.edit');
Route::put('wallets/{wallet}', [WalletController::class, 'update'])->name('wallets.update');
Route::delete('wallets/{wallet}', [WalletController::class, 'destroy'])->name('wallets.destroy');

Route::get('charts', [ChartController::class, 'index'])->name('charts.index');

Route::get('export-wallets', [WalletExportController::class, 'export'])->name('wallets.export');
