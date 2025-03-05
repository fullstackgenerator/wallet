<?php

namespace App\Http\Controllers;

use App\Exports\WalletsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WalletExportController extends Controller
{
    public function export()
    {
        return Excel::download(new WalletsExport(), 'wallets.xlsx');
    }
}
