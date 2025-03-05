<?php

namespace App\Exports;

use App\Models\Wallet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WalletsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Return the collection of wallets and append a row for the total.
     */
    public function collection()
    {
        $wallets = Wallet::all();

        // Get the total amount
        $totalAmount = Wallet::sum('amount');

        // Add a row for the total
        $wallets->push((object) [
            'start_date' => 'Total', // Label for the total row
            'dropDownIncome' => null,
            'dropDownExpense' => null,
            'amount' => $totalAmount, // Total amount
        ]);

        return $wallets;
    }

    /**
     * Define column headings.
     */
    public function headings(): array
    {
        return [
            'Date',
            'Details',
            'Transaction Type',
            'Amount',
        ];
    }

    /**
     * Map the data to match the headers (with the total row).
     */
    public function map($wallet): array
    {
        // If this is the total row, we don't need to map other details
        if ($wallet->start_date === 'Total') {
            return [
                $wallet->start_date,  // 'Total' label
                '-',                  // Empty details column
                '-',                  // Empty transaction type column
                number_format($wallet->amount, 2) . '€', // Total amount
            ];
        }

        return [
            $wallet->start_date,
            $wallet->dropDownIncome ?: $wallet->dropDownExpense ?: '-',
            $wallet->dropDownIncome ? 'Income' : 'Expense',
            number_format($wallet->amount, 2) . '€',
        ];
    }
}
